<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

session_start();

class AdminController extends Controller
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

    public function index()
    {
        return view('admin_login');
    }

    public function showdashboard()
    {
        $this->AuthLogin();
        $product = DB::table('tbl_product')->orderBy('product_sold', 'desc')->limit(5)->get();
        return view('admin.dashboard')->with('product', $product);
    }

    public function dashboard(Request $request)
    {
        $Email = $request->Email;
        $Password = $request->Password;

        $result = DB::table('tbl_admin')->where('admin_email', $Email)->where("admin_password", $Password)->first();
        if ($result) {
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard');
        } else {
            Session::put('message', 'Tài khoản hoặc mật khẩu không chính xác!');
            return Redirect::to('/admin');
        }
    }

    public function log_out()
    {
        $this->AuthLogin();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }

    public function show_customer()
    {
        $all_customer = DB::table('tbl_customer')->paginate(10);
        return view('admin.showcustomer')->with('all_customer', $all_customer);
    }
}
