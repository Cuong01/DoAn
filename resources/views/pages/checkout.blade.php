@extends('layout')
@section('content')
<!--================Checkout Area =================-->
<section class="checkout_area section_padding" style="background: #cefcf7;">
    <div class="container">
        <form action="{{URL::to('/save-checkout')}}" method="POST">
            {{csrf_field()}}
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h2>Điền thông tin gửi hàng</h2>

                        <form class="row contact_form" action="{{URL::to('/save-checkout')}}" method="post" novalidate="novalidate">
                            {{csrf_field()}}
                            @foreach(Session::get('customer') as $key => $email)
                            <div class="col-md-12 form-group p_star">
                                <input type="email" class="form-control" id="email" name="shipping_email" data-validation="email" data-validation-error-msg="Bạn đã không cung cấp một địa chỉ e-mail chính xác" placeholder="Địa chỉ email" value="{{$email['customer_email']}}" />
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="first" name="shipping_name" data-validation="length" data-validation-length="min1" data-validation-error-msg="Bạn hãy điền vào họ và tên" placeholder="Họ và tên" value="{{$email['customer_name']}}" />
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="number" name="shipping_phone" data-validation="number" data-validation-error-msg="Bạn hãy điền vào số điện thoại" placeholder="Số điện thoại" value="{{$email['customer_phone']}}" />
                            </div>
                            @endforeach
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="email" name="shipping_address" data-validation="length" data-validation-length="min1" data-validation-error-msg="Bạn hãy điền vào địa chỉ" placeholder="Địa chỉ" />
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <h3>Ghi chú đơn hàng</h3>
                                </div>
                                <input type="text" class="form-control" name="shipping_notes" id="message" data-validation="length" data-validation-length="min1" data-validation-error-msg="Bạn hãy điền vào ghi chú" placeholder="Ghi chú đơn hàng của bạn">
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-8">
                        <div class="order_box">
                            <h2>Xem lại giỏ hàng</h2>
                            <ul class="list">
                                <li>
                                    <a href="#">Sản phẩm
                                        <span>Giá</span>
                                    </a>
                                </li>
                                <?php
                                $total = 0;

                                ?>
                                @foreach(Session::get('cart') as $key => $cart)
                                <?php
                                $subtotal = $cart['product_price'] * $cart['product_qty'];
                                $total += $subtotal;
                                ?>
                                @if($cart['product_qty']>0)
                                <li>
                                    <a href="#">{{$cart['product_name']}}
                                        <span class="middle">x {{$cart['product_qty']}}</span>
                                        <span class="last">{{number_format($subtotal,0,',','.')}} VNĐ</span>
                                    </a>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                            <ul class="list ">
                                <li>
                                    <a href="#">Tổng tiền
                                        <span>{{number_format($total,0,',','.')}} VNĐ</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Phí vận chuyển
                                        <span>Miễn phí</span>
                                    </a>
                                </li>
                                @if(Session::get('coupon')==true)
                                @foreach(Session::get('coupon') as $key => $cou)
                                @if($cou['coupon_condition']==1)
                                <li><a>Mã giảm: <span>{{$cou['coupon_number']}} %</span></a></li>
                                @php
                                $total_coupon=($total*$cou['coupon_number'])/100;
                                @endphp

                                <li><a>Số giảm: <span>{{number_format($total_coupon,0,',','.')}} VNĐ</span></a></li>
                                @elseif($cou['coupon_condition']==2)
                                <li><a>Mã giảm: <span>{{number_format($cou['coupon_number'],0,',','.')}} VNĐ</span></a></li>

                                @php
                                $total_coupon=$cou['coupon_number'];
                                @endphp

                                <li><a>Số giảm: <span>{{number_format($total_coupon,0,',','.')}} VNĐ</span></a></li>

                                @endif
                                <li>
                                    <a href="#">Thành tiền
                                        <span>{{number_format($total-$total_coupon,0,',','.')}} VNĐ</span>
                                    </a>
                                </li>

                                @endforeach
                                @else
                                <li>
                                    <a href="#">Thành tiền
                                        <span>{{number_format($total,0,',','.')}} VNĐ</span>
                                    </a>
                                </li>
                                @endif

                            </ul>
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option5" name="payment_option" value="1" />
                                    <label for="f-option5">Trả bằng tiền mặt</label>
                                    <div class="check"></div>
                                </div>
                            </div>
                            <div class="payment_item active">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option6" name="payment_option" value="2" />
                                    <label for="f-option6">Trả bằng thẻ </label>
                                    <img src="{{asset('public/Frontend/img/product/single-product/card.jpg')}}" alt="" />
                                    <div class="check"></div>
                                </div>
                            </div>
                            <div>
                                <input type="submit" class="btn_3" value="Đặt hàng">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!--================End Checkout Area =================-->
@endsection