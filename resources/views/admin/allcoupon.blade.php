@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
    <div class="panel-heading">
        Liệt kê mã giảm giá
    </div>
    <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
                <tr>
                    <th>Tên mã giảm giá</th>
                    <th>Mã giảm giá</th>
                    <th>Số lượng mã</th>
                    <th>Tính năng mã</th>
                    <th>Số giảm</th>
                    <th style="width:30px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($all_coupon as $key => $coupon)
                <tr>
                    <td>{{$coupon->coupon_name}}</td>
                    <td>{{$coupon->coupon_code}}</td>
                    <td>{{$coupon->coupon_time}}</td>
                    <td><span class="text-ellipsis">
                            <?php
                            if ($coupon->coupon_condition == 1) {
                            ?>
                                Giảm theo phần trăm
                            <?php
                            } else {
                            ?>
                                Giảm theo số tiền
                            <?php
                            }
                            ?></td>
                    </td>
                    <td><span class="text-ellipsis">
                            <?php
                            if ($coupon->coupon_condition == 1) {
                            ?>
                                Giảm {{$coupon->coupon_number}} %
                            <?php
                            } else {
                            ?>
                                Giảm {{$coupon->coupon_number}} VNĐ
                            <?php
                            }
                            ?></td>
                    </td>
                    <td>
                        <a onclick="return confirm('Bạn có muốn xóa ?')" href="{{URL::to('/deletecoupon/'.$coupon->coupon_id)}}" class="active" ui-toggle-class="">
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
                    {{$all_coupon->links()}}
                </ul>
            </div>
        </div>
    </footer>
</div>
@endsection