<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CommentController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//frontend
Route::get('/', [HomeController::class, 'index']);

Route::get('/trang-chu', [HomeController::class, 'index']);
Route::get('/tim-kiem', [HomeController::class, 'tim_kiem']);

Route::get('/danh-muc-san-pham/{category_id}', [HomeController::class, 'showcategory']);
Route::get('/thuong-hieu-san-pham/{brand_id}', [HomeController::class, 'showbrand']);
Route::get('/chi-tiet-san-pham/{product_id}', [HomeController::class, 'detailsproduct']);
Route::get('/history', [HomeController::class, 'history']);
Route::get('/view-history-order/{order_id}', [HomeController::class, 'view_history_order']);

Route::get('/contact', [ContactController::class, 'contact']);

//cart
Route::post('/save_cart', [CartController::class, 'savecart']);
Route::post('/update-cart', [CartController::class, 'update_cart']);
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax']);
Route::get('/show-cart', [CartController::class, 'show_cart']);
Route::get('/delete-product/{session_id}', [CartController::class, 'delete_product']);
Route::get('/delete-all-product', [CartController::class, 'delete_all_product']);
Route::post('/check-coupon', [CartController::class, 'check_coupon']);

//checkout
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout']);
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout']);
Route::get('/dang-ky', [CheckoutController::class, 'dang_ky']);
Route::post('/dang-nhap', [CheckoutController::class, 'dang_nhap']);
Route::post('/add-customer', [CheckoutController::class, 'add_customer']);
Route::post('/save-checkout', [CheckoutController::class, 'save_checkout']);
Route::get('/check-out', [CheckoutController::class, 'check_out']);

//backend
Route::get('/admin', [AdminController::class, 'index']);

Route::get('/dashboard', [AdminController::class, 'showdashboard']);
Route::get('/logout', [AdminController::class, 'log_out']);
Route::post('/admin_dashboard', [AdminController::class, 'dashboard']);
Route::get('/show-customer', [AdminController::class, 'show_customer']);

//category product
Route::get('/addcategory', [CategoryController::class, 'AddCategory']);
Route::get('/editcategory/{category_id}', [CategoryController::class, 'EditCategory']);
Route::get('/deletecategory/{category_id}', [CategoryController::class, 'DeleteCategory']);
Route::get('/allcategory', [CategoryController::class, 'AllCategory']);

Route::get('/unactive-category/{category_id}', [CategoryController::class, 'unactive_category']);
Route::get('/active-category/{category_id}', [CategoryController::class, 'active_category']);

Route::post('/savecategory', [CategoryController::class, 'SaveCategory']);
Route::post('/updatecategory/{category_id}', [CategoryController::class, 'UpdateCategory']);

//brand product
Route::get('/addbrand', [BrandController::class, 'AddBrand']);
Route::get('/editbrand/{brand_id}', [BrandController::class, 'EditBrand']);
Route::get('/deletebrand/{brand_id}', [BrandController::class, 'DeleteBrand']);
Route::get('/allbrand', [BrandController::class, 'AllBrand']);

Route::get('/unactive-brand/{brand_id}', [BrandController::class, 'unactive_brand']);
Route::get('/active-brand/{brand_id}', [BrandController::class, 'active_brand']);

Route::post('/savebrand', [BrandController::class, 'SaveBrand']);
Route::post('/updatebrand/{brand_id}', [BrandController::class, 'UpdateBrand']);

//product
Route::get('/addproduct', [ProductController::class, 'AddProduct']);
Route::get('/editproduct/{product_id}', [ProductController::class, 'EditProduct']);
Route::get('/deleteproduct/{product_id}', [ProductController::class, 'DeleteProduct']);
Route::get('/allproduct', [ProductController::class, 'AllProduct']);

Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive_product']);
Route::get('/active-product/{product_id}', [ProductController::class, 'active_product']);

Route::post('/saveproduct', [ProductController::class, 'SaveProduct']);
Route::post('/updateproduct/{product_id}', [ProductController::class, 'UpdateProduct']);


//comment
Route::post('/comment-product', [CommentController::class, 'comment_product']);
Route::get('/comment', [CommentController::class, 'comment']);
Route::post('/send-comment', [CommentController::class, 'send_comment']);
Route::post('/reply-comment', [CommentController::class, 'reply_comment']);
Route::post('/allow-comment', [CommentController::class, 'allow_comment']);
Route::get('/delete-comment/{comment_id}', [CommentController::class, 'delete_comment']);

//Order
Route::get('/manage-order', [CheckoutController::class, 'manage_order']);
Route::get('/view-order/{orderId}', [CheckoutController::class, 'view_order']);
Route::post('/update-qty', [CheckoutController::class, 'update_qty']);
Route::get('/delete-order/{order_id}', [CheckoutController::class, 'DeleteOrder']);
Route::post('/huydon', [CheckoutController::class, 'huydon']);

//Coupon
Route::get('/insert-coupon', [CouponController::class, 'insert_coupon']);
Route::get('/all-coupon', [CouponController::class, 'all_coupon']);
Route::post('/save-coupon', [CouponController::class, 'save_coupon']);
Route::get('/deletecoupon/{coupon_id}', [CouponController::class, 'delete_coupon']);
