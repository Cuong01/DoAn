@extends('layout')
@section('content')
<!--================login_part Area =================-->
<section class="login_part section_padding" style="background: #cefcf7;">

    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="login_part_form">
                    <div class="login_part_form_iner">
                        <h3 style="margin-bottom: 40px; text-align: center; font-size: 40px;">Đổi mật khẩu</h3>
                        <h3 style="color:red; margin-bottom: 40px;">
                        <?php

                            use Illuminate\Support\Facades\Session;

                            $message = Session::get('message');
                            if ($message) {
                                echo $message;
                                Session::get('message', null);
                            }
                            ?>
                        </h3>
                        @foreach(Session::get('customer') as $key => $cus)
                        <form class="row contact_form" action="{{URL::to('/update-customer/'.$cus['customer_id'])}}" method="post" novalidate="novalidate">
                            {{ csrf_field() }}
                            <div class="col-md-12 form-group p_star">
                                <input type="email" class="form-control" id="name" name="customer_email" value="{{$cus['customer_email']}}" data-validation="email" data-validation-error-msg="Bạn đã không cung cấp một địa chỉ e-mail chính xác" placeholder="Địa chỉ email">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="password" class="form-control" id="password" name="customer_password" value="" data-validation="length" data-validation-length="min8" data-validation-error-msg="Bạn hãy điền vào mật khẩu có số ký tự >=8" placeholder="Mật khẩu">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="password" class="form-control" id="password1" name="customer_password1" value="" data-validation="length" data-validation-length="min8" data-validation-error-msg="Bạn hãy điền vào mật khẩu có số ký tự >=8" placeholder="Mật khẩu mới">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="password" class="form-control" id="password2" name="customer_password2" value="" data-validation="length" data-validation-length="min8" data-validation-error-msg="Bạn hãy điền vào mật khẩu có số ký tự >=8" placeholder="Nhập lại mật khẩu mới">
                            </div>
                            
                            <div class="col-md-12 form-group">
                        
                                <button type="submit" value="submit" class="btn_3" style="width:300px; margin: 20px 0 0 160px; font-size: 20px;">
                                    Đổi Mật Khẩu
                                </button>
                                
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================login_part end =================-->
@endsection