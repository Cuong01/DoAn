@extends('layout')
@section('content')


<!-- feature_part start-->
<section class="feature_part section_padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section_tittle text-center">
                    <h2>Danh mục nổi bật</h2>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-between">
            @foreach($category as $key => $cate )
            <div class="col-lg-6 col-sm-6">
                <div class="single_feature_post_text" style="background: #9bebb3;">
                    <div style="width: 180px">
                        <p>Chất lượng tốt</p>
                        <h3>{{$cate->category_name}}</h3>
                        <a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}" class="feature_btn">Xem ngay <i class="fas fa-play"></i></a>
                    </div>

                    @foreach($img_product as $key => $img)
                    @if($img->category_id==$cate->category_id)
                    <img src="{{URL::to('public/Upload/Product/'.$img->product_image)}}" height="350px" width="300px">
                    @endif
                    @endforeach

                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- upcoming_event part start-->

<!-- product_list start-->
<section class="product_list section_padding" style="background: #cefcf7;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section_tittle text-center">
                    <h2>Sản phẩm mới <span>shop</span></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="product_list_slider owl-carousel">
                    <div class="single_product_list_slider">
                        <div class="row align-items-center justify-content-between">
                            @foreach($product as $key => $pro)
                            <div class="col-lg-3 col-sm-6">
                                <div class="single_product_item">
                                    <form>
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{$pro->product_id}}" class="cart_product_id_{{$pro->product_id}}">
                                        <input type="hidden" value="{{$pro->product_name}}" class="cart_product_name_{{$pro->product_id}}">
                                        <input type="hidden" value="{{$pro->product_image}}" class="cart_product_image_{{$pro->product_id}}">
                                        <input type="hidden" value="{{$pro->product_price}}" class="cart_product_price_{{$pro->product_id}}">
                                        @if($pro->product_quantity > 0)
                                        <input type="hidden" value="1" class="cart_product_qty_{{$pro->product_id}}">
                                        @else
                                        <input type="hidden" value="0" class="cart_product_qty_{{$pro->product_id}}">
                                        @endif
                                        <a href="{{URL::to('/chi-tiet-san-pham/'.$pro->product_id)}}">
                                            <img src="{{URL::to('public/Upload/Product/'.$pro->product_image)}}" alt="" height="260px" width="260px">
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
                    <div class="single_product_list_slider">
                        <div class="row align-items-center justify-content-between">
                            @foreach($product as $key => $pro)
                            <div class="col-lg-3 col-sm-6">
                                <div class="single_product_item">
                                    <form>
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{$pro->product_id}}" class="cart_product_id_{{$pro->product_id}}">
                                        <input type="hidden" value="{{$pro->product_name}}" class="cart_product_name_{{$pro->product_id}}">
                                        <input type="hidden" value="{{$pro->product_image}}" class="cart_product_image_{{$pro->product_id}}">
                                        <input type="hidden" value="{{$pro->product_price}}" class="cart_product_price_{{$pro->product_id}}">
                                        @if($pro->product_quantity > 0)
                                        <input type="hidden" value="1" class="cart_product_qty_{{$pro->product_id}}">
                                        @else
                                        <input type="hidden" value="0" class="cart_product_qty_{{$pro->product_id}}">
                                        @endif
                                        <a href="{{URL::to('/chi-tiet-san-pham/'.$pro->product_id)}}">
                                            <img src="{{URL::to('public/Upload/Product/'.$pro->product_image)}}" alt="" height="260px" width="260px">
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
            </div>
        </div>
    </div>
</section>
<!-- product_list part start-->




@endsection