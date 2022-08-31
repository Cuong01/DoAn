<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Order;
use App\Models\Coupon;

class CheckoutController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function login_checkout()
    {
        $cate_all = DB::table('tbl_category')->orderBy('category_id', 'desc')->get();

        $new_product = DB::table('tbl_product')->where('product_status', '1')->orderBy('product_sold', 'desc')->limit(4)->get();

        return view('pages.login_checkout')->with('cate_all', $cate_all)->with('product', $new_product);
    }

    public function dang_ky()
    {
        $cate_all = DB::table('tbl_category')->orderBy('category_id', 'desc')->get();

        $new_product = DB::table('tbl_product')->where('product_status', '1')->orderBy('product_sold', 'desc')->limit(4)->get();

        return view('pages.dangky')->with('cate_all', $cate_all)->with('product', $new_product);
    }

    public function add_customer(Request $request)
    {

        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;

        $customer_id = DB::table('tbl_customer')->insertGetId($data);

        $cus[] = array(
            'customer_id' => $customer_id,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone
        );
        Session::put('customer', $cus);

        return Redirect::to('/trang-chu');
    }

    public function doi_mk()
    {
        $cate_all = DB::table('tbl_category')->orderBy('category_id', 'desc')->get();

        $new_product = DB::table('tbl_product')->where('product_status', '1')->orderBy('product_sold', 'desc')->limit(4)->get();

        return view('pages.doi_mk')->with('cate_all', $cate_all)->with('product', $new_product);
    }

    public function update_customer(Request $request, $customer_id)
    {
        $password_old = md5($request->customer_password);
        $cus = DB::table('tbl_customer')->where('customer_id', $customer_id)->first();
        if ($request->customer_email == $cus->customer_email) {
            if ($password_old == $cus->customer_password) {
                if ($request->customer_password1 == $request->customer_password2) {
                    $data = array();
                    $data['customer_password'] = md5($request->customer_password1);
                    DB::table('tbl_customer')->where('customer_id', $customer_id)->update($data);
                    return Redirect()->back()->with('message', 'Đổi mật khẩu thành công');
                } else {
                    return Redirect()->back()->with('message', 'Mật khẩu không trùng nhau');
                }
            } else {
                return Redirect()->back()->with('message', 'Mật khẩu không đúng');
            }
        } else return Redirect()->back()->with('message', 'Tài khoản Email không đúng');
    }


    public function check_out()
    {
        $cate_all = DB::table('tbl_category')->orderBy('category_id', 'desc')->get();

        $new_product = DB::table('tbl_product')->where('product_status', '1')->orderBy('product_sold', 'desc')->limit(4)->get();

        return view('pages.checkout')->with('cate_all', $cate_all)->with('product', $new_product);
    }
    public function save_checkout(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_notes'] = $request->shipping_notes;

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id', $shipping_id);

        //insert payment method
        $data1 = array();
        $data1['payment_method'] = $request->payment_option;
        $data1['payment_status'] = 'Dang cho xu ly';
        $payment_id = DB::table('tbl_payment')->insertGetId($data1);

        //insert order
        $total = 0;
        $total_coupon = 0;
        foreach (Session::get('cart') as $key => $cart) {
            $subtotal = $cart['product_price'] * $cart['product_qty'];
            $total += $subtotal;
        }
        if (Session::get('coupon') == true) {
            foreach (Session::get('coupon') as $key => $cou) {
                $coupon = Coupon::where('coupon_code', $cou['coupon_code'])->first();
                $coupon->coupon_time = $coupon->coupon_time - 1;
                $coupon->save();
                if ($cou['coupon_condition'] == 1) {
                    $total_coupon = ($total * $cou['coupon_number']) / 100;
                } else {
                    $total_coupon =  $cou['coupon_number'];
                }
            }
            $money = ($total - $total_coupon);
        } else $money = $total;

        $order_data = array();
        foreach (Session::get('customer') as $key => $cus) {
            $order_data['customer_id'] = $cus['customer_id'];
        }

        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_subtotal'] = $total;
        $order_data['order_code'] = $total_coupon;
        $order_data['order_total'] = $money;
        $order_data['order_status'] = 1;
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //insert order detail

        foreach ($content = Session::get('cart') as $key => $v_content) {
            if ($v_content['product_qty'] > 0) {
                $order_d_data['order_id'] = $order_id;
                $order_d_data['product_id'] = $v_content['product_id'];
                $order_d_data['product_name'] = $v_content['product_name'];
                $order_d_data['product_price'] = $v_content['product_price'];
                $order_d_data['product_sale_quantity'] = $v_content['product_qty'];
                $result = DB::table('tbl_order_detail')->insert($order_d_data);
            }
        }

        if ($data1['payment_method'] == 1) {
            Session::forget('cart');
            Session::forget('coupon');

            $cate_all = DB::table('tbl_category')->orderBy('category_id', 'desc')->get();

            $new_product = DB::table('tbl_product')->where('product_status', '1')->orderBy('product_sold', 'desc')->limit(4)->get();

            return view('pages.handcash')->with('cate_all', $cate_all)->with('product', $new_product);
        } elseif ($data1['payment_method'] == 2) {
            Session::forget('cart');
            Session::forget('coupon');

            $cate_all = DB::table('tbl_category')->orderBy('category_id', 'desc')->get();

            $new_product = DB::table('tbl_product')->where('product_status', '1')->orderBy('product_sold', 'desc')->limit(4)->get();

            return view('pages.handcash')->with('cate_all', $cate_all)->with('product', $new_product);
        }
    }

    public function logout_checkout()
    {
        Session::flush();
        return Redirect::to('/login-checkout');
    }

    public function dang_nhap(Request $request)
    {
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customer')->where('customer_email', $email)->where('customer_password', $password)->first();
        if ($result) {
            $cus[] = array(
                'customer_id' => $result->customer_id,
                'customer_name' => $result->customer_name,
                'customer_email' => $result->customer_email,
                'customer_phone' => $result->customer_phone
            );
            Session::put('customer', $cus);

            return Redirect::to('/trang-chu');
        } else {
            return Redirect::to('/login-checkout');
        }
    }

    public function manage_order()
    {
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
            ->join('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_order.customer_id')
            ->select('tbl_order.*', 'tbl_customer.customer_name')
            ->orderBy('tbl_order.order_id', 'desc')->paginate(10);
        $coupon = DB::table('tbl_coupon')->get();
        $manager_order = view('admin.manage_order')->with('all_order', $all_order)->with('coupon', $coupon);
        return view('admin_layout')->with('admin.manager_order', $manager_order);
    }

    public function view_order($orderId)
    {
        $this->AuthLogin();
        $order = DB::table('tbl_order')->where('order_id', $orderId)->get();
        $order_customer = DB::table('tbl_order')
            ->join('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_order.customer_id')
            ->select('tbl_order.*', 'tbl_customer.*')
            ->where('tbl_order.order_id', $orderId)->first();

        $order_shpping = DB::table('tbl_order')
            ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_order.shipping_id')
            ->select('tbl_order.*', 'tbl_shipping.*')
            ->where('tbl_order.order_id', $orderId)->first();

        $order_by_id = DB::table('tbl_order')
            ->join('tbl_order_detail', 'tbl_order_detail.order_id', '=', 'tbl_order.order_id')
            ->select('tbl_order.*', 'tbl_order_detail.*')
            ->where('tbl_order.order_id', $orderId)->get();
        $manager_order_by_Id = view('admin.view_order')->with('order_by_id', $order_by_id)->with('order_customer', $order_customer)->with('order_shipping', $order_shpping)->with('order', $order);
        return view('admin_layout')->with('admin.view_order', $manager_order_by_Id);
    }
    public function DeleteOrder($order_id)
    {
        $this->AuthLogin();
        DB::table('tbl_order')->where('order_id', $order_id)->delete();
        return Redirect::to('manage-order');
    }

    public function update_qty(Request $request)
    {
        //update status order
        $data = $request->all();
        $order = Order::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();

        if ($order->order_status == 2) {
            foreach ($data['order_product_id'] as $key => $product_id) {
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                foreach ($data['quantity'] as $key2 => $qty) {
                    if ($key == $key2) {
                        $pro_remail = $product_quantity - $qty;
                        $product->product_quantity = $pro_remail;
                        $product->product_sold = $product_sold + $qty;
                        $product->save();
                    }
                }
            }
        } elseif ($order->order_status == 1) {
            foreach ($data['order_product_id'] as $key => $product_id) {
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                foreach ($data['quantity'] as $key2 => $qty) {
                    if ($key == $key2) {
                        $pro_remail = $product_quantity + $qty;
                        $product->product_quantity = $pro_remail;
                        $product->product_sold = $product_sold - $qty;
                        $product->save();
                    }
                }
            }
        }
    }

    public function huydon(Request $request)
    {
        $data = $request->all();
        $order = Order::find($data['order_id']);
        $order->order_status = 3;
        $order->save();
    }
}
