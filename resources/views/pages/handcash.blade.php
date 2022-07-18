@extends('layout')
@section('content')
<!--================Handcash =================-->
<section class="cart_area section_padding" style="background: #cefcf7;">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <div>
                    <h2>Bạn đã đặt hàng thàng công.</h2>
                </div>

                <div class="checkout_btn_inner float-right">
                    <a class="btn_1" href="{{asset('/trang-chu')}}">Mua tiếp</a>
                </div>
            </div>
        </div>
</section>
<!--================End Handcash =================-->
@endsection