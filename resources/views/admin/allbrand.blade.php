@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
    <div class="panel-heading">
        Liệt kê thương hiệu sản phẩm
    </div>
    <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
                <tr>
                    <th>Tên danh mục</th>
                    <th>Trạng thái</th>
                    <th style="width:30px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($all_brand as $key => $brand_pro)
                <tr>
                    <td>{{$brand_pro->brand_name}}</td>
                    <td><span class="text-ellipsis">
                            <?php
                            if ($brand_pro->brand_status == 0) {
                            ?>
                                <a href="{{URL::to('/unactive-brand/'.$brand_pro->brand_id)}}"><span>Ẩn</span></a>
                            <?php
                            } else {
                            ?>
                                <a href="{{URL::to('/active-brand/'.$brand_pro->brand_id)}}"><span>Hiển thị</span></a>
                            <?php
                            }
                            ?></td>
                    <td>
                        <a href="{{URL::to('/editbrand/'.$brand_pro->brand_id)}}" class="active" ui-toggle-class="">
                            <i class="fa fa-pencil-square-o text-success text-active"></i>
                        </a>
                        <a onclick="return confirm('Bạn có muốn xóa ?')" href="{{URL::to('/deletebrand/'.$brand_pro->brand_id)}}" class="active" ui-toggle-class="">
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
                <ul class="pagination pagination-sm m-t-none m-b-none">
                    {{$all_brand->links()}}
                </ul>
            </div>
        </div>
    </footer>
</div>
@endsection