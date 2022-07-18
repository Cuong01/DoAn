@extends('layout')
@section('content')
<!--================Cart Area =================-->
<section class="cart_area section_padding" style="background: #cefcf7;">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <?php

                use Illuminate\Support\Facades\Session;

                $message = Session::get('message');
                if ($message) {
                    echo $message;
                    Session::get('message', null);
                }
                ?>
                <form method="POST" action="{{URL::to('/update-cart')}}">
                    {{ csrf_field() }}
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <h4>Sản phẩm</h4>
                                </th>
                                <th scope="col">
                                    <h4>Giá</h4>
                                </th>
                                <th scope="col">
                                    <h4>Số lượng</h4>
                                </th>
                                <th scope="col">
                                    <h4>Thành tiền</h4>
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $total = 0;
                            $cou1 = Session::get('coupon');

                            ?>
                            @if(Session::get('cart')==true)
                            @foreach(Session::get('cart') as $key => $cart)

                            <?php
                            $subtotal = $cart['product_price'] * $cart['product_qty'];
                            $total += $subtotal;

                            ?>
                            @if($cart['product_qty']>0)
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="{{URL::to('public/Upload/Product/'.$cart['product_image'])}}" height="200px" width="200px" alt="{{$cart['product_name']}}" />
                                        </div>
                                        <div class="media-body">
                                            <h4>{{$cart['product_name']}}</h4>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h4>{{number_format($cart['product_price'],0,',','.')}} VNĐ</h4>
                                </td>
                                <td>
                                    @foreach($all_product as $key => $pro)
                                    @if($pro->product_id == $cart['product_id'])

                                    <div class="product_count">
                                        <input type="number" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}" min="1" max="{{$pro->product_quantity}}">
                                    </div>

                                    @endif
                                    @endforeach
                                </td>
                                <td>
                                    <h4>{{number_format($subtotal,0,',','.')}} VNĐ</h4>
                                </td>
                                <td>
                                    <a class="cart_quantity_delete" href="{{URL::to('/delete-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td>
                                    <h2>Sản phẩm hết hàng</h2>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @endif
                            @endforeach
                            <tr class="bottom_button">
                                <td>

                                </td>
                                <td></td>
                                <td></td>

                                <td>
                                    <input type="submit" class="btn_1" value="Cập nhật vào giỏ">
                                </td>

                            </tr>


                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>

                                    <li>

                                        Tổng tiền: <span>{{number_format($total,0,',','.')}} VNĐ</span>

                                    </li>
                                    @if($cou1==true)
                                    @foreach($cou1 as $key => $cou)
                                    @if($cou['coupon_condition']==1)
                                    <li>Mã giảm: {{$cou['coupon_number']}} %</li>
                                    @php
                                    $total_coupon=($total*$cou['coupon_number'])/100;
                                    @endphp

                                    <li>Số giảm: {{number_format($total_coupon,0,',','.')}} VNĐ</li>

                                    @elseif($cou['coupon_condition']==2)
                                    <li>Mã giảm: {{number_format($cou['coupon_number'],0,',','.')}} VNĐ</li>

                                    @php
                                    $total_coupon=$cou['coupon_number'];
                                    @endphp

                                    <li>Số giảm: {{number_format($total_coupon,0,',','.')}} VNĐ</li>

                                    @endif
                                    <li>
                                        Thành tiền: <span>{{number_format($total-$total_coupon,0,',','.')}} VNĐ</span>

                                    </li>

                                    @endforeach
                                    @else
                                    <li>
                                        Thành tiền: <span>{{number_format($total,0,',','.')}} VNĐ</span>
                                    </li>
                                    @endif

                                </td>
                            </tr>
                            @endif

                        </tbody>
                    </table><!-- End .table table-summary -->
                    </tbody>
                    </table>
                </form>
                @if(Session::get('cart')==true)
                <table class="table">
                    <form action="{{URL::to('/check-coupon')}}" method="POST">
                        {{ csrf_field() }}

                        <body>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá">
                                </td>
                                <td></td>
                                <td>
                                    <input type="submit" class="btn_1" name="check_coupon" value="Tính mã giảm giá">
                                </td>


                            </tr>
                        </body>
                    </form>
                </table>
                @endif
                <div class="checkout_btn_inner float-right">
                    <a class="btn_1" href="{{asset('/trang-chu')}}">Mua tiếp</a>
                    @if(Session::get('cart')==true)
                    <a class="btn_1" href="{{URL::to('/delete-all-product')}}">Xóa tất cả giỏ hàng</a>
                    <?php

                    if (Session::get('customer') == true) {
                    ?>
                        <a class="btn_1 checkout_btn_1" href="{{asset('/check-out')}}">Thanh toán</a>
                    <?php
                    } else {
                    ?>
                        <a class="btn_1 checkout_btn_1" href="{{asset('/login-checkout')}}">Thanh toán</a>
                    <?php
                    }
                    ?>


                    @endif

                </div>
            </div>
        </div>
</section>
<!--================End Cart Area =================-->
@endsection