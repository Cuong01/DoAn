@extends('layout')
@section('content')
<!--================Single Product Area =================-->
<div class="product_image_area section_padding">
    <div class="container">
        <div class="row s_product_inner justify-content-between">
            @foreach($details_product as $key => $detail)
            <div class="col-lg-7 col-xl-7">
                <div class="product_slider_img">
                    <div id="vertical">
                        <img src="{{URL::to('public/Upload/Product/'.$detail->product_image)}}" />
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-5">
                <div class="s_product_text">
                    <form method="POST" action="{{asset('/save_cart')}}">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{$detail->product_id}}" class="cart_product_id_{{$detail->product_id}}">
                        <input type="hidden" value="{{$detail->product_name}}" class="cart_product_name_{{$detail->product_id}}">
                        <input type="hidden" value="{{$detail->product_image}}" class="cart_product_image_{{$detail->product_id}}">
                        <input type="hidden" value="{{$detail->product_price}}" class="cart_product_price_{{$detail->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$detail->product_id}}">
                        <h1>Chi tiết sản phẩm</h1>
                        <h2>{{$detail->product_name}}</h2>
                        <h3>{{number_format($detail->product_price,0,',','.')}} VNĐ</h3>

                        <ul class="list">

                            <li>
                                <h4>Danh mục sản phẩm : {{$detail->category_name}}</h4>
                            </li>
                            <li>
                                <h4>Thương hiệu sản phẩm : {{$detail->brand_name}}</h4>
                            </li>
                            @if($detail->product_quantity > 0)
                            <li>
                                <h4> Trạng thái : còn hàng</h4>
                            </li>
                            @else
                            <li>
                                <h4> Trạng thái : hết hàng</h4>
                            </li>
                            @endif

                        </ul>

                        <p>
                            {!!$detail->product_desc!!}
                        </p>
                        @if($detail->product_quantity > 0)
                        <div class="card_area d-flex justify-content-between align-items-center">
                            <a><button type="button" class="btn_3 add-to-cart" data-id_product="{{$detail->product_id}}" name="add-to-cart">Thêm vào giỏ</button></a>
                            <a href="#" class="like_us"> <i class="ti-heart"></i> </a>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!--================End Single Product Area =================-->

<!--================Product Description Area =================-->
<section class="product_description_area">
    <div class="container">
        @foreach($details_product as $key => $detail)
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Thông số kĩ thuật</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Thương hiệu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Bình luận sản phẩm</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                <p>
                    {!!$detail->product_content!!}
                </p>
            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <p>
                    {!!$detail->brand_desc!!}
                </p>
            </div>

            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">
                    <div class="col-lg-6">
                        <form>
                            {{ csrf_field() }}
                            <div class="comment_list">
                                <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$detail->product_id}}">
                                <div id="comment_show"></div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <div class="review_box">
                            <h4>Đánh giá sản phẩm</h4>
                            <form class="row contact_form" id="contactForm" novalidate="novalidate">
                                {{ csrf_field() }}
                                <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$detail->product_id}}">
                                <div class="col-md-12">
                                    @if(Session::get('customer')==true)
                                    @foreach(Session::get('customer') as $key => $cus)
                                    <div class="form-group">
                                        <input type="text" class="form-control comment_name" data-validation="length" data-validation-length="min1" data-validation-error-msg="Bạn hãy điền vào họ và tên" name="comment_name" placeholder="Tên bình luận" value="{{$cus['customer_name']}}" />
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="form-group">
                                        <input type="text" class="form-control comment_name" data-validation="length" data-validation-length="min1" data-validation-error-msg="Bạn hãy điền vào họ và tên" name="comment_name" placeholder="Tên bình luận" />
                                    </div>
                                    @endif
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control comment_content" data-validation="length" data-validation-length="min1" data-validation-error-msg="Bạn hãy điền vào nội dung" name="comment_content" rows="4" placeholder="Nội dung"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button type="submit" value="submit" class="btn_3 send_comment">
                                        Gửi đánh giá
                                    </button>
                                </div>
                                <div id="notify_comment">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
<!-- product_list part start-->
<section class="product_list section_padding" style="background: #dff3af;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section_tittle text-center">
                    <h2>Sản phẩm liên quan</h2>
                </div>
            </div>
        </div>

        <div class="single_product_list_slider">
            <div class="row align-items-center justify-content-between">
                @foreach($related_product as $key => $pro)
                <div class="col-lg-3 col-sm-6">
                    <div class="single_product_item">
                        <form>
                            {{ csrf_field() }}
                            <input type="hidden" value="{{$pro->product_id}}" class="cart_product_id_{{$pro->product_id}}">
                            <input type="hidden" value="{{$pro->product_name}}" class="cart_product_name_{{$pro->product_id}}">
                            <input type="hidden" value="{{$pro->product_image}}" class="cart_product_image_{{$pro->product_id}}">
                            <input type="hidden" value="{{$pro->product_price}}" class="cart_product_price_{{$pro->product_id}}">
                            <input type="hidden" value="1" class="cart_product_qty_{{$pro->product_id}}">
                            <a href="{{URL::to('/chi-tiet-san-pham/'.$pro->product_id)}}">
                                <img src="{{URL::to('public/Upload/Product/'.$pro->product_image)}}" alt="" height="260px" width="262,5px">
                            </a>
                            <div class=" single_product_text">
                                <h4>{{$pro->product_name}}</h4>
                                <h3>{{number_format($pro->product_price,0,',','.')}} VNĐ</h3>
                                <a><button type="button" class="btn_3 add-to-cart" data-id_product="{{$pro->product_id}}" name="add-to-cart">Thêm vào giỏ</button></a>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- product_list part end-->
<!--================End Product Description Area =================-->
@endsection