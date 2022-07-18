<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $cate_product = DB::table('tbl_category')->where('category_status', '1')->orderBy('category_id', 'desc')->limit(4)->get();

        $cate_all = DB::table('tbl_category')->orderBy('category_id', 'desc')->get();

        $new_product = DB::table('tbl_product')->where('product_status', '1')->orderBy('product_sold', 'desc')->limit(8)->get();

        $img_product = DB::table('tbl_product')->where('product_status', '1')->orderBy('product_id', 'desc')->get();

        return view('pages.home')->with('category', $cate_product)->with('product', $new_product)->with('img_product', $img_product)->with('cate_all', $cate_all);
    }

    public function showcategory($category_id)
    {
        $new_product = DB::table('tbl_product')->where('product_status', '1')->orderBy('product_sold', 'desc')->limit(4)->get();

        $cate_all = DB::table('tbl_category')->orderBy('category_id', 'desc')->get();

        $brand_all = DB::table('tbl_brand')->where('brand_status', '1')->orderBy('brand_id', 'desc')->get();


        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            if ($sort_by == 'kytu_za') {
                $category_by_id = DB::table('tbl_product')->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')->where('tbl_product.category_id', $category_id)->orderBy('product_name', 'DESC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == 'kytu_az') {
                $category_by_id = DB::table('tbl_product')->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')->where('tbl_product.category_id', $category_id)->orderBy('product_name', 'ASC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == 'tang_dan') {
                $category_by_id = DB::table('tbl_product')->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')->where('tbl_product.category_id', $category_id)->orderBy('product_price', 'ASC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == 'giam_dan') {
                $category_by_id = DB::table('tbl_product')->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')->where('tbl_product.category_id', $category_id)->orderBy('product_price', 'DESC')->paginate(6)->appends(request()->query());
            }
        } else $category_by_id = DB::table('tbl_product')->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')->where('tbl_product.category_id', $category_id)->paginate(6);

        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            if ($sort_by == '<5') {
                $category_by_id = DB::table('tbl_product')->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')->where('tbl_product.category_id', $category_id)->whereBetween('tbl_product.product_price', [0, 4999999])->orderBy('product_price', 'ASC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == '5_10') {
                $category_by_id = DB::table('tbl_product')->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')->where('tbl_product.category_id', $category_id)->whereBetween('tbl_product.product_price', [5000000, 10000000])->orderBy('product_price', 'ASC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == '10_20') {
                $category_by_id = DB::table('tbl_product')->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')->where('tbl_product.category_id', $category_id)->whereBetween('tbl_product.product_price', [10000000, 20000000])->orderBy('product_price', 'ASC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == '>20') {
                $category_by_id = DB::table('tbl_product')->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')->where('tbl_product.category_id', $category_id)->whereNotBetween('tbl_product.product_price', [0, 20000000])->orderBy('product_price', 'ASC')->paginate(6)->appends(request()->query());
            }
        } else $category_by_id = DB::table('tbl_product')->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')->where('tbl_product.category_id', $category_id)->paginate(6);



        $category_name = DB::table('tbl_category')->where('tbl_category.category_id', $category_id)->limit(1)->get();

        return view('pages.showcategory')->with('cate_all', $cate_all)->with('product', $new_product)->with('brand_all', $brand_all)->with('category_by_id', $category_by_id)->with('category_name', $category_name);
    }

    public function showbrand($brand_id)
    {
        $new_product = DB::table('tbl_product')->where('product_status', '1')->orderBy('product_sold', 'desc')->limit(4)->get();

        $cate_all = DB::table('tbl_category')->orderBy('category_id', 'desc')->get();

        $brand_all = DB::table('tbl_brand')->where('brand_status', '1')->orderBy('brand_id', 'desc')->get();

        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            if ($sort_by == 'kytu_za') {
                $brand_by_id = DB::table('tbl_product')->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->where('tbl_product.brand_id', $brand_id)->orderBy('product_name', 'DESC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == 'kytu_az') {
                $brand_by_id = DB::table('tbl_product')->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->where('tbl_product.brand_id', $brand_id)->orderBy('product_name', 'ASC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == 'tang_dan') {
                $brand_by_id = DB::table('tbl_product')->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->where('tbl_product.brand_id', $brand_id)->orderBy('product_price', 'ASC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == 'giam_dan') {
                $brand_by_id = DB::table('tbl_product')->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->where('tbl_product.brand_id', $brand_id)->orderBy('product_price', 'DESC')->paginate(6)->appends(request()->query());
            }
        } else $brand_by_id = DB::table('tbl_product')->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->where('tbl_product.brand_id', $brand_id)->paginate(6);

        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            if ($sort_by == '<5') {
                $brand_by_id = DB::table('tbl_product')->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->where('tbl_product.brand_id', $brand_id)->whereBetween('tbl_product.product_price', [0, 4999999])->orderBy('product_price', 'ASC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == '5_10') {
                $brand_by_id = DB::table('tbl_product')->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->where('tbl_product.brand_id', $brand_id)->whereBetween('tbl_product.product_price', [5000000, 10000000])->orderBy('product_price', 'ASC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == '10_20') {
                $brand_by_id = DB::table('tbl_product')->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->where('tbl_product.brand_id', $brand_id)->whereBetween('tbl_product.product_price', [10000000, 20000000])->orderBy('product_price', 'ASC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == '>20') {
                $brand_by_id = DB::table('tbl_product')->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->where('tbl_product.brand_id', $brand_id)->whereNotBetween('tbl_product.product_price', [0, 20000000])->orderBy('product_price', 'ASC')->paginate(6)->appends(request()->query());
            }
        } else $brand_by_id = DB::table('tbl_product')->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->where('tbl_product.brand_id', $brand_id)->paginate(6);

        $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_id', $brand_id)->limit(1)->get();

        return view('pages.showbrand')->with('cate_all', $cate_all)->with('product', $new_product)->with('brand_all', $brand_all)->with('brand_by_id', $brand_by_id)->with('brand_name', $brand_name);
    }

    public function detailsproduct($product_id)
    {
        $new_product = DB::table('tbl_product')->where('product_status', '1')->orderBy('product_sold', 'desc')->limit(4)->get();

        $cate_all = DB::table('tbl_category')->orderBy('category_id', 'desc')->get();

        $details_product = DB::table('tbl_product')
            ->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_product.product_id', $product_id)->get();

        foreach ($details_product as $key => $value) {
            $category_id = $value->category_id;
        }

        $related_product = DB::table('tbl_product')
            ->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
            ->where('tbl_category.category_id', $category_id)
            ->whereNotIn('tbl_product.product_id', [$product_id])->limit(4)->get();


        return view('pages.detailsproduct')->with('cate_all', $cate_all)->with('product', $new_product)->with('details_product', $details_product)->with('related_product', $related_product);
    }

    public function tim_kiem()
    {
        $keyword = request()->keyword_submit;

        $new_product = DB::table('tbl_product')->where('product_status', '1')->orderBy('product_sold', 'desc')->limit(4)->get();

        $cate_all = DB::table('tbl_category')->orderBy('category_id', 'desc')->get();

        $brand_all = DB::table('tbl_brand')->where('brand_status', '1')->orderBy('brand_id', 'desc')->get();

        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            if ($sort_by == 'kytu_za') {
                $search_product = DB::table('tbl_product')->where('product_name', 'like', '%' . $keyword . '%')->orderBy('product_name', 'DESC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == 'kytu_az') {
                $search_product = DB::table('tbl_product')->where('product_name', 'like', '%' . $keyword . '%')->orderBy('product_name', 'ASC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == 'tang_dan') {
                $search_product = DB::table('tbl_product')->where('product_name', 'like', '%' . $keyword . '%')->orderBy('product_price', 'ASC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == 'giam_dan') {
                $search_product = DB::table('tbl_product')->where('product_name', 'like', '%' . $keyword . '%')->orderBy('product_price', 'DESC')->paginate(6)->appends(request()->query());
            }
        } else $search_product = DB::table('tbl_product')->where('product_name', 'like', '%' . $keyword . '%')->paginate(6);

        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            if ($sort_by == '<5') {
                $search_product = DB::table('tbl_product')->where('product_name', 'like', '%' . $keyword . '%')->whereBetween('tbl_product.product_price', [0, 4999999])->orderBy('product_price', 'ASC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == '5_10') {
                $search_product = DB::table('tbl_product')->where('product_name', 'like', '%' . $keyword . '%')->whereBetween('tbl_product.product_price', [5000000, 10000000])->orderBy('product_price', 'ASC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == '10_20') {
                $search_product = DB::table('tbl_product')->where('product_name', 'like', '%' . $keyword . '%')->whereBetween('tbl_product.product_price', [10000000, 20000000])->orderBy('product_price', 'ASC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == '>20') {
                $search_product = DB::table('tbl_product')->where('product_name', 'like', '%' . $keyword . '%')->whereNotBetween('tbl_product.product_price', [0, 20000000])->orderBy('product_price', 'ASC')->paginate(6)->appends(request()->query());
            }
        } else $search_product = DB::table('tbl_product')->where('product_name', 'like', '%' . $keyword . '%')->paginate(6);

        return view('pages.search')->with('cate_all', $cate_all)->with('product', $new_product)->with('brand_all', $brand_all)->with('search_product', $search_product);
    }

    public function history()
    {
        $new_product = DB::table('tbl_product')->where('product_status', '1')->orderBy('product_sold', 'desc')->limit(4)->get();

        $cate_all = DB::table('tbl_category')->orderBy('category_id', 'desc')->get();

        if (Session::get('customer') == true) {
            foreach (Session::get('customer') as $key => $cus) {
                $getorder = DB::table('tbl_order')->where('customer_id', $cus['customer_id'])->orderBy('order_id', 'desc')->get();
            }
        }

        return view('pages.history')->with('cate_all', $cate_all)->with('product', $new_product)->with('getorder', $getorder);
    }

    public function view_history_order($order_id)
    {
        $new_product = DB::table('tbl_product')->where('product_status', '1')->orderBy('product_sold', 'desc')->limit(4)->get();
        $cate_all = DB::table('tbl_category')->orderBy('category_id', 'desc')->get();

        $order = DB::table('tbl_order')->where('order_id', $order_id)->get();
        $order_customer = DB::table('tbl_order')
            ->join('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_order.customer_id')
            ->select('tbl_order.*', 'tbl_customer.*')
            ->where('tbl_order.order_id', $order_id)->first();

        $order_shpping = DB::table('tbl_order')
            ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_order.shipping_id')
            ->select('tbl_order.*', 'tbl_shipping.*')
            ->where('tbl_order.order_id', $order_id)->first();

        $order_by_id = DB::table('tbl_order')
            ->join('tbl_order_detail', 'tbl_order_detail.order_id', '=', 'tbl_order.order_id')
            ->select('tbl_order.*', 'tbl_order_detail.*')
            ->where('tbl_order.order_id', $order_id)->get();

        return view('pages.view_history_order')->with('cate_all', $cate_all)->with('product', $new_product)->with('order_by_id', $order_by_id)->with('order_customer', $order_customer)->with('order_shipping', $order_shpping)->with('order', $order);;
    }
}
