@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
    <div class="panel-heading">
        Thông tin khách hàng
    </div>
    <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
                <tr>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>

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
        Thông tin vận chuyển
    </div>
    <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
                <tr>
                    <th>Tên người mua</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>

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
        Chi tiết đơn hàng
    </div>

    <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>

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
                <td>
                    <h4>
                        @foreach($order as $key => $or)

                        @if($value->order_status==1)
                        <form>
                            {{csrf_field()}}
                            <select class="form-control order_details">
                                <option value="">--------Chọn hình thức đơn hàng---------</option>
                                <option id="{{$or->order_id}}" selected value="1">Chưa xử lý</option>
                                <option id="{{$or->order_id}}" value="2">Đã xử lý-Đã giao hàng</option>
                                <option id="{{$or->order_id}}" value="3">Hủy đơn hàng</option>
                            </select>
                        </form>
                        @elseif($value->order_status==2)
                        <form>
                            {{csrf_field()}}
                            <select class="form-control order_details">
                                <option value="">--------Chọn hình thức đơn hàng--------</option>
                                <option disabled id="{{$or->order_id}}" value="1">Chưa xử lý</option>
                                <option id="{{$or->order_id}}" selected value="2">Đã xử lý-Đã giao hàng</option>
                                <option disabled id="{{$or->order_id}}" value="3">Hủy đơn hàng</option>
                            </select>
                        </form>

                        @else
                        <form>
                            {{csrf_field()}}
                            <select class="form-control order_details">
                                <option value="">--------Chọn hình thức đơn hàng---------</option>
                                <option disabled id="{{$or->order_id}}" value="1">Chưa xử lý</option>
                                <option disabled id="{{$or->order_id}}" value="2">Đã xử lý-Đã giao hàng</option>
                                <option id="{{$or->order_id}}" selected value="3">Hủy đơn hàng</option>
                            </select>
                        </form>

                        @endif
                        @endforeach
                    </h4>

                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

            </tr>
        </table>
    </div>

</div>
@endsection