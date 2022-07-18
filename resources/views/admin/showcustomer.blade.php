@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
    <div class="panel-heading">
        Liệt kê khách hàng
    </div>

    <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
                <tr>
                    <th>Mã khách hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Địa chỉ email</th>
                    <th>Số điện thoại</th>
                </tr>
            </thead>
            <tbody>
                @foreach($all_customer as $key => $cus)
                <tr>
                    <td>{{$cus->customer_id}}</td>
                    <td>{{$cus->customer_name}}</td>
                    <td>{{$cus->customer_email}}</td>
                    <td>{{$cus->customer_phone}}</td>
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
                <ul class="pagination pagination-sm m-t-none m-b-none">
                    {{$all_customer->links()}}
                </ul>
            </div>
        </div>
    </footer>
</div>
@endsection