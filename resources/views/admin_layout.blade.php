<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{asset('public/Backend/css/bootstrap.min.css')}}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{asset('public/Backend/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('public/Backend/css/style-responsive.css')}}" rel="stylesheet" />
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{asset('public/Backend/css/font.css')}}" type="text/css" />
    <link href="{{asset('public/Backend/css/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/Backend/css/morris.css')}}" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{asset('public/Backend/css/monthly.css')}}">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="{{asset('public/Backend/js/jquery2.0.3.min.js')}}"></script>
    <script src="{{asset('public/Backend/js/raphael-min.js')}}"></script>
    <script src="{{asset('public/Backend/js/morris.js')}}"></script>


</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="{{URL::to('/dashboard')}}" class="logo">
                    Trang chủ
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->

                <!--  notification end -->
            </div>
            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">

                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{asset('public/Backend/images/2.png')}}">
                            <span class="Name">
                                <?php

                                use Illuminate\Support\Facades\Session;

                                $name = Session::get('admin_name');
                                if ($name) {
                                    echo $name;
                                }
                                ?>
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">

                            <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> Đăng xuất</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="active" href="{{URL::to('/dashboard')}}">
                                <i class="fa fa-dashboard"></i>
                                <span>Quản lý</span>
                            </a>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Đơn hàng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{asset('/manage-order')}}">Quản lý đơn hàng</a></li>

                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Mã giảm giá</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{asset('/insert-coupon')}}">Thêm mã giảm giá</a></li>
                                <li><a href="{{asset('/all-coupon')}}">Liệt kê mã giảm giá</a></li>

                            </ul>
                        </li>


                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh mục sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{asset('/addcategory')}}">Thêm danh mục</a></li>
                                <li><a href="{{asset('/allcategory')}}">Liệt kê danh mục</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Thương hiệu sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{asset('/addbrand')}}">Thêm thương hiệu sản phẩm</a></li>
                                <li><a href="{{asset('/allbrand')}}">Liệt kê thương hiệu sản phẩm</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{asset('/addproduct')}}">Thêm sản phẩm</a></li>
                                <li><a href="{{asset('/allproduct')}}">Liệt kê sản phẩm</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Bình luận</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{asset('/comment')}}">Quản lý bình luận</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Khách hàng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{asset('/show-customer')}}">Thông tin khách hàng</a></li>
                            </ul>
                        </li>


                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <section id="main-content">
            <section class="wrapper">
                @yield('admin_content')
            </section>
        </section>

    </section>
    <script src="{{asset('public/Backend/js/bootstrap.js')}}"></script>
    <script src="{{asset('public/Backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('public/Backend/js/scripts.js')}}"></script>
    <script src="{{asset('public/Backend/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('public/Backend/js/jquery.nicescroll.js')}}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{asset('public/Backend/js/jquery.scrollTo.js')}}"></script>
    <script src=" //cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js "> </script>
    <script src="//cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $('.comment_status_btn').click(function() {
            var comment_status = $(this).data('comment_status');
            var comment_id = $(this).data('comment_id');
            var comment_product_id = $(this).attr('id');
            console.log(comment_status, comment_product_id, comment_id);
            $.ajax({
                url: "{{url('/allow-comment')}}",

                method: 'POST',

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                data: {
                    comment_status: comment_status,
                    comment_id: comment_id,
                    comment_product_id: comment_product_id
                },

                success: function(data) {
                    alert('Cập nhật trạng thái thành công');
                    location.reload();
                }
            });

        });
    </script>
    <script type="text/javascript">
        $('.btn-reply-comment').click(function() {
            var comment_id = $(this).data('comment_id');
            var comment_content = $('.reply_comment_' + comment_id).val();
            var comment_product_id = $(this).data('product_id');


            $.ajax({
                url: "{{url('/reply-comment')}}",

                method: 'POST',

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    comment_id: comment_id,
                    comment_content: comment_content,
                    comment_product_id: comment_product_id
                },

                success: function(data) {
                    alert('Trả lời bình luận thành công');
                    $('.reply_comment_' + comment_id).val('');
                }
            });

        });
    </script>
    <script type="text/javascript">
        $('.order_details').change(function() {
            var order_status = $(this).val();
            var order_id = $(this).children(":selected").attr("id");
            var _token = $('input[name="_token"]').val();

            quantity = [];
            $('input[name="product_sale_quantity"]').each(function() {
                quantity.push($(this).val());
            });

            order_product_id = [];
            $('input[name="order_product_id"]').each(function() {
                order_product_id.push($(this).val());
            });

            $.ajax({
                url: "{{url('/update-qty')}}",

                method: 'POST',

                data: {
                    _token: _token,
                    order_status: order_status,
                    order_product_id: order_product_id,
                    quantity: quantity,
                    order_id: order_id
                },
                // dataType:"JSON",
                success: function(data) {

                    alert('Cập nhật trạng thái đơn hàng thành công');

                    location.reload();

                }
            });
        });
    </script>
    <script type="text/javascript">
        $.validate({});
    </script>
    <script>
        CKEDITOR.replace('ckeditor1');
        CKEDITOR.replace('ckeditor2');
    </script>

</body>

</html>