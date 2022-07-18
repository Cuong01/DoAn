<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
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

    public function AddCategory()
    {
        $this->AuthLogin();
        return view('admin.addcategory');
    }

    public function AllCategory()
    {
        $this->AuthLogin();
        $all_category = DB::table('tbl_category')->orderBy('category_id', 'desc')->paginate(10);
        $manager_category = view('admin.allcategory')->with('all_category', $all_category);
        return view('admin_layout')->with('admin.allcategory', $manager_category);
    }

    public function SaveCategory(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_desc'] = $request->category_desc;
        $data['category_status'] = $request->category_status;

        DB::table('tbl_category')->insert($data);
        return Redirect::to('allcategory');
    }
    public function unactive_category($category_id)
    {
        $this->AuthLogin();
        DB::table('tbl_category')->where('category_id', $category_id)->update(['category_status' => 1]);
        return Redirect::to('allcategory');
    }

    public function active_category($category_id)
    {
        $this->AuthLogin();
        DB::table('tbl_category')->where('category_id', $category_id)->update(['category_status' => 0]);
        return Redirect::to('allcategory');
    }

    public function EditCategory($category_id)
    {
        $this->AuthLogin();
        $edit_category = DB::table('tbl_category')->where('category_id', $category_id)->get();
        $manager_category = view('admin.editcategory')->with('edit_category', $edit_category);
        return view('admin_layout')->with('admin.editcategory', $manager_category);
    }

    public function UpdateCategory(Request $request, $category_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_desc'] = $request->category_desc;
        DB::table('tbl_category')->where('category_id', $category_id)->update($data);
        return Redirect::to('allcategory');
    }

    public function DeleteCategory($category_id)
    {
        $this->AuthLogin();
        DB::table('tbl_category')->where('category_id', $category_id)->delete();
        return Redirect::to('allcategory');
    }
}
