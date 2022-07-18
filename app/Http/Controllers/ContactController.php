<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function contact()
    {
        $new_product = DB::table('tbl_product')->where('product_status', '1')->orderBy('product_sold', 'desc')->limit(4)->get();

        $cate_all = DB::table('tbl_category')->orderBy('category_id', 'desc')->get();
        return view('pages.contact')->with('cate_all', $cate_all)->with('product', $new_product);
    }
}
