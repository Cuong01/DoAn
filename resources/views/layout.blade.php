<!doctype html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <title>aranoz</title>
    <link rel="icon" href="{{asset('public/Frontend/img/favicon.png')}}"> -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('public/Frontend/css/bootstrap.min.css')}}">
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{asset('public/Frontend/css/animate.css')}}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{asset('public/Frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/Frontend/css/lightslider.min.css')}}">
    <!-- nice select CSS -->
    <link rel="stylesheet" href="{{asset('public/Frontend/css/nice-select.css')}}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{asset('public/Frontend/css/all.css')}}">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{asset('public/Frontend/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('public/Frontend/css/themify-icons.css')}}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{asset('public/Frontend/css/magnific-popup.css')}}">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="{{asset('public/Frontend/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('public/Frontend/css/price_rangs.css')}}">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{asset('public/Frontend/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('public/Frontend/css/sweetalert.css')}}">
</head>

<body>
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="{{URL::to('/trang-chu')}}"> <img src="{{asset('public/Frontend/img/logo.png')}}" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="menu_icon"><i class="fas fa-bars"></i></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{URL::to('/trang-chu')}}">Trang ch???</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Danh m???c s???n ph???m
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                                        @foreach($cate_all as $key =>$cate)
                                        <a class="dropdown-item" href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}"> {{$cate->category_name}}</a>
                                        @endforeach

                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Kh??ch h??ng
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown_2">
                                        <?php

                                        use Illuminate\Support\Facades\Session;


                                        if (Session::get('customer') == true) {
                                        ?>
                                            <a class="dropdown-item" href="{{URL::to('/logout-checkout')}}">????ng xu???t</a>
                                            <a class="dropdown-item" href="{{URL::to('/history')}}">L???ch s??? mua h??ng</a>
                                        <?php
                                        } else {
                                        ?>
                                            <a class="dropdown-item" href="{{URL::to('/login-checkout')}}">????ng nh???p</a>
                                        <?php
                                        }
                                        ?>
                                        <a class="dropdown-item" href="{{URL::to('/show-cart')}}">Gi??? h??ng</a>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{URL::to('/contact')}}">Li??n h???</a>
                                </li>
                            </ul>
                        </div>
                        <div class="hearer_icon d-flex">
                            <a id="search_1" href="javascript:void(0)"><i class="ti-search"></i></a>

                            <a href="{{URL::to('/show-cart')}}">
                                <i class="fas fa-cart-plus"></i>
                            </a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="search_input" id="search_input_box">
            <div class="container ">
                <form class="d-flex justify-content-between search-inner" action="{{URL::to('/tim-kiem')}}">
                    {{ csrf_field() }}
                    <input type="text" class="form-control" id="search_input" name="keyword_submit" placeholder="T??m ki???m">
                    <button type="submit" class="btn"></button>
                    <span class="ti-close" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </header>
    <!-- Header part end-->

    <!-- banner part start-->
    <section class="banner_part" style="background: #86d7dd;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-11">
                    <div class="banner_slider owl-carousel">
                        @foreach($product as $key => $pro)
                        <div class="single_banner_slider">
                            <div class="row">
                                <div class="col-lg-6 col-md-8">
                                    <div class="banner_text">
                                        <div class="banner_text_iner">
                                            <h3>{{$pro->product_name}}</h3>
                                            <p>{!!$pro->product_desc!!}</p>
                                            <h4>Gi?? ch???: <span>{{number_format($pro->product_price,0,',','.')}} VN??</span></h4>
                                            <a href="{{URL::to('/chi-tiet-san-pham/'.$pro->product_id)}}" class="btn_2">Xem ngay</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="banner_img d-none d-lg-block">
                                    <img src="{{URL::to('public/Upload/Product/'.$pro->product_image)}}" height="350px" width="500px">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->

    @yield('content')


    <!--::footer_part start::-->
    <footer class="footer_part">
        <div class="container">
            <div class="row justify-content-around">

                <div class="col-sm-6 col-lg-3">
                    <div class="single_footer_part">
                        <h3>Tr??? gi??p kh??ch h??ng</h3>
                        <h5>
                            <ul class="list-unstyled">
                                <li><a href="">H?????ng d???n thanh to??n</a></li>
                                <li><a href="">Ch??nh s??ch giao h??ng</a></li>
                                <li><a href="">B???o h??nh - ?????i tr???</a></li>
                                <li><a href="">Ch??nh s??ch b???o m???t th??ng tin</a></li>
                            </ul>
                        </h5>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="single_footer_part">
                        <h3>T??i kho???n c???a b???n</h3>
                        <h5>
                            <ul class="list-unstyled">
                                <li><a href="">Gi??? h??ng</a></li>
                                <li><a href="">Danh s??ch y??u th??ch</a></li>
                                <li><a href="">Theo d??i ????n h??ng</a></li>
                            </ul>
                        </h5>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-6">
                    <div class="single_footer_part">
                        <h3>Li??n h???</h3>
                        <h5>
                            <ul class="list-unstyled">
                                <li><a href="">??ia ch???: Ng?? 1194 ???????ng L??ng, L??ng Th?????ng, ?????ng ??a, H?? N???i</a></li>
                                <li><a href="">S??? ??i???n tho???i: 0369418208</a></li>
                                <li><a href="">Email: cuongds12000@gmail.com</a></li>
                                <li><a href="https://www.facebook.com/nguyen.trungcuong.1">Facebook: Nguy???n Trung C?????ng</a></li>
                            </ul>
                        </h5>
                    </div>
                </div>

            </div>

        </div>
        <div class="copyright_part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="copyright_text">
                            <P>

                                Ch??ng t??i xin cam k???t s??? ??em ?????n nh???ng d???ch v??? t???t nh???t cho kh??ch h??ng. &copy
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>

                            </P>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer_icon social_icon">
                            <ul class="list-unstyled">
                                <li><a href="https://www.facebook.com/nguyen.trungcuong.1" class="single_social_icon"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" class="single_social_icon"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#" class="single_social_icon"><i class="fas fa-globe"></i></a></li>
                                <li><a href="#" class="single_social_icon"><i class="fab fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!--::footer_part end::-->

    <!-- jquery plugins here-->
    <script src="{{asset('public/Frontend/js/jquery-1.12.1.min.js')}}"></script>
    <!-- popper js -->
    <script src="{{asset('public/Frontend/js/popper.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{asset('public/Frontend/js/bootstrap.min.js')}}"></script>
    <!-- easing js -->
    <script src="{{asset('public/Frontend/js/jquery.magnific-popup.js')}}"></script>
    <!-- swiper js -->
    <script src="{{asset('public/Frontend/js/swiper.min.js')}}"></script>
    <!-- swiper js -->
    <script src="{{asset('public/Frontend/js/masonry.pkgd.js')}}"></script>
    <!-- particles js -->
    <script src="{{asset('public/Frontend/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('public/Frontend/js/jquery.nice-select.min.js')}}"></script>
    <!-- slick js -->
    <script src="{{asset('public/Frontend/js/slick.min.js')}}"></script>
    <script src="{{asset('public/Frontend/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('public/Frontend/js/waypoints.min.js')}}"></script>
    <script src="{{asset('public/Frontend/js/contact.js')}}"></script>
    <script src="{{asset('public/Frontend/js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('public/Frontend/js/jquery.form.js')}}"></script>
    <script src="{{asset('public/Frontend/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('public/Frontend/js/mail-script.js')}}"></script>
    <script src="{{asset('public/Frontend/js/stellar.js')}}"></script>
    <script src="{{asset('public/Frontend/js/price_rangs.js')}}"></script>
    <!-- custom js -->
    <script src="{{asset('public/Frontend/js/theme.js')}}"></script>
    <script src="{{asset('public/Frontend/js/custom.js')}}"></script>

    <script src="{{asset('public/Frontend/js/sweetalert.min.js')}}"></script>
    <script src=" //cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js "> </script>
    <script type="text/javascript">
        $.validate({});
    </script>
</body>
<script>
    $(document).ready(function() {
        $('#sort').on('change', function() {
            var url = $(this).val();
            if (url) {
                window.location = url;
            } else false;
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#search_price').on('change', function() {
            var url = $(this).val();
            if (url) {
                window.location = url;
            } else false;
        });
    });
</script>
<script>
    $(document).ready(function() {
        load_comment();

        function load_comment() {
            var product_id = $('.comment_product_id').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/comment-product')}}",
                method: "POST",
                data: {
                    product_id: product_id,
                    _token: _token
                },
                success: function(data) {
                    $('#comment_show').html(data);
                }
            });
        }
        $('.send_comment').click(function() {
            var product_id = $('.comment_product_id').val();
            var comment_name = $('.comment_name').val();
            var comment_content = $('.comment_content').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{url('/send-comment')}}",
                method: "POST",
                data: {
                    product_id: product_id,
                    comment_name: comment_name,
                    comment_content: comment_content,
                    _token: _token
                },
                success: function() {
                    alert('Th??m comment th??nh c??ng th??nh c??ng');
                    load_comment();
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.add-to-cart').click(function() {
            var id = $(this).data('id_product');
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_price = $('.cart_product_price_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{url('/add-cart-ajax')}}",
                method: "POST",
                data: {
                    cart_product_id: cart_product_id,
                    cart_product_name: cart_product_name,
                    cart_product_image: cart_product_image,
                    cart_product_price: cart_product_price,
                    cart_product_qty: cart_product_qty,
                    _token: _token
                },
                success: function() {
                    swal({
                            title: "S???n ph???m ???? ???????c th??m v??o gi??? c???a b???n",
                            showCancelButton: true,
                            cancelButtonText: "Ti???p t???c",
                            confirmButtonClass: "btn",
                            confirmButtonText: "Xem gi??? h??ng",
                            closeOnConfirm: false
                        },
                        function() {
                            window.location.href = "{{URL::to('/show-cart')}}";
                        });
                }
            });
        })
    });
</script>
<script type="text/javascript">
    $('.huydon').click(function() {
        var order_id = $(this).data('id');
        var _token = $('input[name="_token"]').val();


        $.ajax({
            url: "{{url('/huydon')}}",

            method: 'POST',

            data: {
                order_id: order_id,
                _token: _token
            },

            success: function(data) {
                alert('H???y ????n h??ng th??nh c??ng th??nh c??ng');
                location.reload();
            }
        });


    });
</script>

< /html>