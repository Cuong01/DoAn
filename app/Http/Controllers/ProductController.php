<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Comment;


class ProductController extends Controller
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

    public function AddProduct()
    {
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id', 'desc')->get();
        return view('admin.addproduct')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }

    public function AllProduct()
    {
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
            ->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->orderBy('product_id', 'desc')->paginate(10);
        $manager_product = view('admin.allproduct')->with('all_product', $all_product);
        return view('admin_layout')->with('admin.allproduct', $manager_product);
    }

    public function SaveProduct(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_sold'] = 0;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;

        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalExtension();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 1000) . '.' . $get_name_image;
            $get_image->move('public/Upload/Product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            return Redirect::to('/allproduct');
        }
        $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);
        return Redirect::to('allproduct');
    }

    public function unactive_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 1]);
        return Redirect::to('allproduct');
    }

    public function active_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 0]);
        return Redirect::to('allproduct');
    }

    public function EditProduct($product_id)
    {
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id', 'desc')->get();
        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        $manager_product = view('admin.editproduct')->with('edit_product', $edit_product)->with('cate_product', $cate_product)->with('brand_product', $brand_product);
        return view('admin_layout')->with('admin.editproduct', $manager_product);
    }

    public function UpdateProduct(Request $request, $product_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalExtension();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 1000) . '.' . $get_name_image;
            $get_image->move('public/Upload/Product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            return Redirect::to('/allproduct');
        }
        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        return Redirect::to('/allproduct');
    }

    public function DeleteProduct($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        return Redirect::to('allproduct');
    }
}
