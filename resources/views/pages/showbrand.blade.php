@extends('layout')
@section('content')

<section class="cat_product_area section_padding" style="background: #cefcf7;">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="left_sidebar_area">
                    <aside class="left_widgets p_filter_widgets">
                        <div class="l_w_title">
                            <h3>Danh mục sản phẩm</h3>
                        </div>
                        <div class="widgets_inner">
                            @foreach($cate_all as $key =>$cate)
                            <ul class="list">
                                <li>
                                    <a class="dropdown-item" href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}"> {{$cate->category_name}}</a>
                                </li>
                            </ul>
                            @endforeach
                        </div>
                    </aside>

                    <aside class="left_widgets p_filter_widgets">
                        <div class="l_w_title">
                            <h3>Thương hiệu sản phẩm</h3>
                        </div>
                        <div class="widgets_inner">
                            @foreach($brand_all as $key => $brand)
                            <ul class="list">
                                <li>
                                    <a class="dropdown-item" href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_id)}}">{{$brand->brand_name}}</a>
                                </li>
                            </ul>
                            @endforeach
                        </div>
                    </aside>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product_top_bar d-flex justify-content-between align-items-center">
                            <div class="single_product_menu">
                                @foreach($brand_name as $key => $brand)
                                <h3>{{$brand->brand_name}}</h3>
                                @endforeach
                            </div>
                            <div class="col-md-5 d-flex">
                                <h3>Sắp xếp với : </h3>
                                <form>
                                    @csrf

                                    <select name="sort" id="sort">
                                        <option value="{{Request::url()}}?sort_by=none">------Lọc------</option>
                                        <option value="{{Request::url()}}?sort_by=giam_dan">Giảm dần theo giá</option>
                                        <option value="{{Request::url()}}?sort_by=tang_dan">Tăng dần theo giá</option>
                                        <option value="{{Request::url()}}?sort_by=kytu_az">Theo tên A-Z</option>
                                        <option value="{{Request::url()}}?sort_by=kytu_za">Theo tên Z-A</option>
                                    </select>
                                </form>

                            </div>
                            <div class="col-md-5 d-flex">
                                <h3>Lọc giá : </h3>
                                <form>
                                    @csrf

                                    <select name="search_price" id="search_price">
                                        <option value="{{Request::url()}}?sort_by=none">------Khoảng giá------</option>
                                        <option value="{{Request::url()}}?sort_by=<5">Dưới 5 triệu</option>
                                        <option value="{{Request::url()}}?sort_by=5_10">Từ 5-10 triệu</option>
                                        <option value="{{Request::url()}}?sort_by=10_20">Từ 10-20 triệu</option>
                                        <option value="{{Request::url()}}?sort_by=>20">Trên 20 triệu</option>
                                    </select>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center latest_product_inner">
                    @foreach($brand_by_id as $key => $pro)
                    <a href="{{URL::to('/chi-tiet-san-pham/'.$pro->product_id)}}">
                        <div class="col-lg-4 col-sm-6">
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
                                    <img src="{{URL::to('public/Upload/Product/'.$pro->product_image)}}" alt="" height="260px" width="260px">
                                    <div class="single_product_text">
                                        <h4>{{$pro->product_name}}</h4>
                                        <h3>{{number_format($pro->product_price,0,',','.')}} VNĐ</h3>

                                        <a><button type="button" class="btn_3 add-to-cart" data-id_product="{{$pro->product_id}}" name="add-to-cart">Thêm vào giỏ</button></a>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </a>
                    @endforeach
                    <div class="col-lg-12">
                        <div class="pageination">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    {{$brand_by_id->links()}}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection