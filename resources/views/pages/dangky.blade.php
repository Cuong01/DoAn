@extends('layout')
@section('content')
<!--================login_part Area =================-->
<section class="login_part section_padding" style="background: #cefcf7;">

    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="login_part_form">
                    <div class="login_part_form_iner">
                        <h3 style="margin-bottom: 40px; text-align: center; font-size: 40px;">Đăng ký tài khoản</h3>
                        <form class="row contact_form" action="{{URL::to('/add-customer')}}" method="post" novalidate="novalidate">
                            {{ csrf_field() }}
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="name" name="customer_name" value="" data-validation="length" data-validation-length="min1" data-validation-error-msg="Bạn hãy điền vào họ và tên" placeholder="Họ và tên">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="email" class="form-control" id="name" name="customer_email" value="" data-validation="email" data-validation-error-msg="Bạn đã không cung cấp một địa chỉ e-mail chính xác" placeholder="Địa chỉ email">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="password" class="form-control" id="password" name="customer_password" value="" data-validation="length" data-validation-length="min8" data-validation-error-msg="Bạn hãy điền vào mật khẩu có số ký tự >=8" placeholder="Mật khẩu">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="name" name="customer_phone" value="" data-validation="number" data-validation-error-msg="Bạn hãy điền vào số điện thoại" placeholder="Số điện thoại">
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="btn_3" style="width:300px; margin: 20px 0 0 160px; font-size: 20px;">
                                    Đăng ký
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================login_part end =================-->
@endsection