<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Coupon;
use Illuminate\Support\Arr;
use Nette\Utils\Strings;

class CartController extends Controller
{
    public function savecart(Request $request)
    {
        $cate_all = DB::table('tbl_category')->orderBy('category_id', 'desc')->get();

        $new_product = DB::table('tbl_product')->where('product_status', '1')->orderBy('product_sold', 'desc')->limit(4)->get();

        $productId = $request->productid_hidden;
        $quantity = $request->qty;

        $product_info = DB::table('tbl_product')->where('product_id', $productId)->get();

        return view('pages.showcart')->with('cate_all', $cate_all)->with('product', $new_product);
    }

    public function show_cart(Request $request)
    {
        $cate_all = DB::table('tbl_category')->orderBy('category_id', 'desc')->get();

        $all_product = DB::table('tbl_product')->where('product_status', '1')->get();

        $new_product = DB::table('tbl_product')->where('product_status', '1')->orderBy('product_sold', 'desc')->limit(4)->get();

        return view('pages.showcart')->with('cate_all', $cate_all)->with('product', $new_product)->with('all_product', $all_product);
    }

    public function add_cart_ajax(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart');
        if ($cart == true) {
            $is_avaiable = 0;
            foreach ($cart as $key => $val) {
                if ($val['product_id'] == $data['cart_product_id']) {
                    $is_avaiable++;
                }
            }
            if ($is_avaiable == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart', $cart);
            }
        } else {
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
            );
            Session::put('cart', $cart);
        }
        Session::save();
    }

    public function delete_product($session_id)
    {
        $cart = Session::get('cart');
        if ($cart == true) {
            foreach ($cart as $key => $val) {
                if ($val['session_id'] == $session_id) {
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function delete_all_product()
    {
        $cart = Session::get('cart');
        if ($cart = true) {
            Session::forget('cart');
            Session::forget('coupon');
            return redirect()->back();
        }
    }

    public function update_cart(Request $request)
    {
        $data = $request->all();
        $cart = Session::get('cart');
        if ($cart == true) {
            foreach ($data['cart_qty'] as $key => $qty) {
                foreach ($cart as $session => $val) {
                    if ($val['session_id'] == $key) {
                        $cart[$session]['product_qty'] = $qty;
                    }
                }
            }
            Session::put('cart', $cart);
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function check_coupon(Request $request)
    {
        $data = $request->all();
        $coupon = Coupon::where('coupon_code', $data['coupon'])->first();
        if ($coupon) {
            $count_coupon = $coupon->count();
            if ($count_coupon > 0) {
                $coupon_session = Session::get('coupon');
                if ($coupon_session == true) {
                    $is_avaiable = 0;
                    if ($is_avaiable == 0) {
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,
                        );
                        Session::put('coupon', $cou);
                    }
                } else {
                    $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,
                    );
                    Session::put('coupon', $cou);
                }
                Session::save();
                return Redirect()->back()->with('message', 'Thêm mã giảm giá thành công');
            }
        } else {
            return Redirect()->back()->with('message', 'Mã giảm giá không đúng');
        }
    }
}
