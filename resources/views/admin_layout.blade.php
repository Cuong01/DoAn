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
                    Trang ch???
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

                            <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> ????ng xu???t</a></li>
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
                                <span>Qu???n l??</span>
                            </a>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>????n h??ng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{asset('/manage-order')}}">Qu???n l?? ????n h??ng</a></li>

                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>M?? gi???m gi??</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{asset('/insert-coupon')}}">Th??m m?? gi???m gi??</a></li>
                                <li><a href="{{asset('/all-coupon')}}">Li???t k?? m?? gi???m gi??</a></li>

                            </ul>
                        </li>


                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh m???c s???n ph???m</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{asset('/addcategory')}}">Th??m danh m???c</a></li>
                                <li><a href="{{asset('/allcategory')}}">Li???t k?? danh m???c</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Th????ng hi???u s???n ph???m</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{asset('/addbrand')}}">Th??m th????ng hi???u s???n ph???m</a></li>
                                <li><a href="{{asset('/allbrand')}}">Li???t k?? th????ng hi???u s???n ph???m</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>S???n ph???m</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{asset('/addproduct')}}">Th??m s???n ph???m</a></li>
                                <li><a href="{{asset('/allproduct')}}">Li???t k?? s???n ph???m</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>B??nh lu???n</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{asset('/comment')}}">Qu???n l?? b??nh lu???n</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Kh??ch h??ng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{asset('/show-customer')}}">Th??ng tin kh??ch h??ng</a></li>
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
                    alert('C???p nh???t tr???ng th??i th??nh c??ng');
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
                    alert('Tr??? l???i b??nh lu???n th??nh c??ng');
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

                    alert('C???p nh???t tr???ng th??i ????n h??ng th??nh c??ng');

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