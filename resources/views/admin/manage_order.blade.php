@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
    <div class="panel-heading">
        Liệt kê đơn hàng
    </div>
    <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
            <div class="input-group">
                <input type="text" class="input-sm form-control" placeholder="Search">
                <span class="input-group-btn">
                    <button class="btn btn-sm btn-default" type="button">Go!</button>
                </span>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
                <tr>
                    <th>Tên khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Giảm giá</th>
                    <th>Thành tiền</th>
                    <th>Tình trạng</th>
                    <th>Thời gian</th>
                    <th style="width:30px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($all_order as $key => $order)
                <tr>
                    <td>{{$order->customer_name}}</td>
                    <td>{{number_format($order->order_subtotal,0,',','.')}} VNĐ</td>
                    <td>{{number_format($order->order_code,0,',','.')}} VNĐ</td>
                    <td>{{number_format($order->order_total,0,',','.')}} VNĐ</td>

                    @if($order->order_status==1)
                    <td>Chưa xử lý</td>
                    @elseif($order->order_status==2)
                    <td>Đã xử lý-Đã giao hàng</td>
                    @else
                    <td>Hủy đơn hàng</td>
                    @endif
                    <td>{{$order->created_at}}</td>


                    <td>
                        <a href="{{URL::to('/view-order/'.$order->order_id)}}" class="active" ui-toggle-class="">
                            <i class="fa fa-pencil-square-o text-success text-active"></i>
                        </a>
                        <a onclick="return confirm('Bạn có muốn xóa ?')" href="{{URL::to('/delete-order/'.$order->order_id)}}" class="active" ui-toggle-class="">
                            <i class="fa fa-times text-danger text"></i>
                        </a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <footer class="panel-footer">
        <div class="row">

            <div class="col-sm-5 text-center">
                <small class="text-muted inline m-t-sm m-b-sm"></small>
            </div>
            <div class="col-sm-7 text-right text-center-xs">
                {{$all_order->links()}}
            </div>
        </div>
    </footer>
</div>
@endsection