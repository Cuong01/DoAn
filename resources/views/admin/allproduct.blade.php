@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
    <div class="panel-heading">
        Liệt kê sản phẩm
    </div>
    <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Số lượng đã bán</th>
                    <th>Giá</th>
                    <th>Hình sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Thương hiệu</th>
                    <th>Trạng thái</th>
                    <th style="width:30px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($all_product as $key => $pro)
                <tr>
                    <td>{{$pro->product_name}}</td>
                    <td>{{$pro->product_quantity}}</td>
                    <td>{{$pro->product_sold}}</td>
                    <td>{{number_format($pro->product_price,0,',','.')}} VNĐ</td>
                    <td><img src="public/Upload/Product/{{$pro->product_image}}" height="100px" width="100px"></td>
                    <td>{{$pro->category_name}}</td>
                    <td>{{$pro->brand_name}}</td>
                    <td><span class="text-ellipsis">
                            <?php
                            if ($pro->product_status == 0) {
                            ?>
                                <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}"><span>Ẩn</span></a>
                            <?php
                            } else {
                            ?>
                                <a href="{{URL::to('/active-product/'.$pro->product_id)}}"><span>Hiển thị</span></a>
                            <?php
                            }
                            ?></td>
                    <td>
                        <a href="{{URL::to('/editproduct/'.$pro->product_id)}}" class="active" ui-toggle-class="">
                            <i class="fa fa-pencil-square-o text-success text-active"></i>
                        </a>
                        <a onclick="return confirm('Bạn có muốn xóa ?')" href="{{URL::to('/deleteproduct/'.$pro->product_id)}}" class="active" ui-toggle-class="">
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
                {{$all_product->links()}}
            </div>
    </footer>
</div>
@endsection