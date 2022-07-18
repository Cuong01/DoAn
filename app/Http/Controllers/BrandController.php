<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
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

    public function AddBrand()
    {
        $this->AuthLogin();
        return view('admin.addbrand');
    }

    public function AllBrand()
    {
        $this->AuthLogin();
        $all_brand = DB::table('tbl_brand')->orderBy('brand_id', 'desc')->paginate(10);
        $manager_brand = view('admin.allbrand')->with('all_brand', $all_brand);
        return view('admin_layout')->with('admin.allbrand', $manager_brand);
    }

    public function SaveBrand(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_desc'] = $request->brand_desc;
        $data['brand_status'] = $request->brand_status;

        DB::table('tbl_brand')->insert($data);
        return Redirect::to('allbrand');
    }
    public function unactive_brand($brand_id)
    {
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_id)->update(['brand_status' => 1]);
        return Redirect::to('allbrand');
    }

    public function active_brand($brand_id)
    {
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_id)->update(['brand_status' => 0]);
        return Redirect::to('allbrand');
    }

    public function EditBrand($brand_id)
    {
        $this->AuthLogin();
        $edit_brand = DB::table('tbl_brand')->where('brand_id', $brand_id)->get();
        $manager_brand = view('admin.editbrand')->with('edit_brand', $edit_brand);
        return view('admin_layout')->with('admin.editbrand', $manager_brand);
    }

    public function UpdateBrand(Request $request, $brand_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_desc'] = $request->brand_desc;
        DB::table('tbl_brand')->where('brand_id', $brand_id)->update($data);
        return Redirect::to('allbrand');
    }

    public function DeleteCategory($brand_id)
    {
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_id)->delete();
        return Redirect::to('allbrand');
    }
}
