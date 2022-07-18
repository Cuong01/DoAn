@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
    <div class="panel-heading">
        Năm sản phẩm bán chạy nhất
    </div>
    <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
                <tr>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình sản phẩm</th>
                    <th>Số lượng còn</th>
                    <th>Số lượng đã bán</th>
                </tr>
            </thead>
            <tbody>
                @foreach($product as $key => $pro)
                <tr>
                    <td>{{$pro->product_id}}</td>
                    <td>{{$pro->product_name}}</td>
                    <td><img src="public/Upload/Product/{{$pro->product_image}}" height="100px" width="100px"></td>
                    <td>{{$pro->product_quantity}}</td>
                    <td>{{$pro->product_sold}}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>


@endsection