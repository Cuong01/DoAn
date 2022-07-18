<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
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

    public function insert_coupon()
    {
        $this->AuthLogin();
        return view('admin.addcoupon');
    }

    public function save_coupon(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['coupon_name'] = $request->coupon_name;
        $data['coupon_code'] = $request->coupon_code;
        $data['coupon_time'] = $request->coupon_time;
        $data['coupon_condition'] = $request->coupon_condition;
        $data['coupon_number'] = $request->coupon_number;

        DB::table('tbl_coupon')->insert($data);

        return Redirect::to('all-coupon');
    }
    public function all_coupon()
    {
        $this->AuthLogin();
        $all_coupon = DB::table('tbl_coupon')->orderBy('coupon_id', 'desc')->paginate(10);
        $manager_coupon = view('admin.allcoupon')->with('all_coupon', $all_coupon);
        return view('admin_layout')->with('admin.allcoupon', $manager_coupon);
    }
    public function delete_coupon($coupon_id)
    {
        $this->AuthLogin();
        DB::table('tbl_coupon')->where('coupon_id', $coupon_id)->delete();
        return Redirect::to('all-coupon');
    }
}
