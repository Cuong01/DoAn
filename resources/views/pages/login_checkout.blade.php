@extends('layout')
@section('content')
<!--================login_part Area =================-->
<section class="login_part section_padding" style="background: #cefcf7;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="login_part_text text-center">
                    <div class="login_part_text_iner">
                        <h2>Chào mừng quý khách đã đến với web của chúng tôi</h2>
                        <p>Hãy đăng kí tài khoản mới để có thể thanh toán đơn hàng</p>
                        <a href="{{URL::to('/dang-ky')}}" class="btn_3">Thêm tài khoản</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="login_part_form">
                    <div class="login_part_form_iner">
                        <h3>Đăng nhập tài khoản</h3>
                        <form class="row contact_form" action="{{URL::to('/dang-nhap')}}" method="post" novalidate="novalidate">
                            {{csrf_field()}}
                            <div class="col-md-12 form-group p_star">
                                <input type="email" class="form-control" id="name" name="email_account" value="" data-validation="email" data-validation-error-msg="Bạn đã không cung cấp một địa chỉ e-mail chính xác" placeholder="Tài khoản">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="password" class="form-control" id="password" name="password_account" value="" data-validation="length" data-validation-length="min1" data-validation-error-msg="Bạn hãy điền vào mật khẩu" placeholder="Mật khẩu">
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account d-flex align-items-center">
                                    <input type="checkbox" id="f-option" name="selector">
                                    <label for="f-option">Ghi nhớ đăng nhập</label>
                                </div>
                                <button type="submit" value="submit" class="btn_3">
                                    Đăng nhập
                                </button>
                                <a class="lost_pass" href="#">Quên mật khẩu</a>
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