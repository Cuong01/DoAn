@extends('layout')
@section('content')
<section class="cart_area section_padding" style="background: #cefcf7;">
    <div class="container">
        <div class="cart_inner">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Thông tin khách hàng</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th>
                                    <h4>Tên khách hàng</h4>
                                </th>
                                <th>
                                    <h4>Số điện thoại<h4>
                                </th>
                                <th>
                                    <h4>Email<h4>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$order_customer->customer_name}}</td>
                                <td>{{$order_customer->customer_phone}}</td>
                                <td>{{$order_customer->customer_email}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Thông tin vận chuyển</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th>
                                    <h4>Tên người mua</h4>
                                </th>
                                <th>
                                    <h4>Email</h4>
                                </th>
                                <th>
                                    <h4>Địa chỉ</h4>
                                </th>
                                <th>
                                    <h4>Số điện thoại</h4>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$order_shipping->shipping_name}}</td>
                                <td>{{$order_shipping->shipping_email}}</td>
                                <td>{{$order_shipping->shipping_address}}</td>
                                <td>{{$order_shipping->shipping_phone}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Chi tiết đơn hàng</h3>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>

                                <th>
                                    <h4>Tên sản phẩm</h4>
                                </th>
                                <th>
                                    <h4>Số lượng</h4>
                                </th>
                                <th>
                                    <h4>Giá</h4>
                                </th>
                                <th>
                                    <h4>Thành tiền</h4>
                                </th>


                            </tr>
                        </thead>
                        @foreach($order_by_id as $key => $value)
                        <tbody>
                            <tr>
                                <td>{{$value->product_name}}</td>
                                <td>
                                    <input type="number" disabled min="1" value="{{$value->product_sale_quantity}}" name="product_sale_quantity">
                                    <input type="hidden" name="order_product_id" class="order_product_id" value="{{$value->product_id}}">
                                </td>
                                <td>{{number_format($value->product_price,0,',','.')}} VNĐ</td>
                                <td>{{number_format($value->product_sale_quantity*$value->product_price,0,',','.')}} VNĐ</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    <table class="table table-striped b-t b-light">
                        <tr>
                            @foreach($order as $key => $or)
                            @if($or->order_status==1)
                            <h4>Trạng thái: Chưa xử lý</h4>
                            <form>
                                {{ csrf_field() }}

                                <body>
                                    <td>
                                        <input type="button" class="btn_1 huydon" data-id="{{$or->order_id}}" value="Hủy đơn hàng">
                                    </td>
                                </body>
                            </form>
                            @elseif($or->order_status==2)
                            <h4>Trạng thái: Đã xử lý-Đã giao hàng</h4>
                            @else
                            <h4>Trạng thái: Hủy đơn hàng</h4>
                            @endif
                            @endforeach
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection