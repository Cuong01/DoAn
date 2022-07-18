@extends('layout')
@section('content')
<!--================Cart Area =================-->
<section class="cart_area section_padding" style="background: #cefcf7;">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <h1>Lịch sử mua hàng</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">
                                <h4>Mã đơn hàng</h4>
                            </th>
                            <th scope="col">
                                <h4>Tổng tiền</h4>
                            </th>
                            <th scope="col">
                                <h4>Ngày đặt hàng</h4>
                            </th>
                            <th scope="col">
                                <h4>Trạng thái</h4>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($getorder as $key => $or)


                        <tr>
                            <td>
                                {{$or->order_id}}
                            </td>
                            <td>
                                {{number_format($or->order_total,0,',','.')}} VNĐ
                            </td>
                            <td>
                                {{$or->created_at}}
                            </td>

                            @if($or->order_status==1)
                            <td>Chưa xử lý</td>
                            @elseif($or->order_status==2)
                            <td>Đã xử lý-Đã giao hàng</td>
                            @else
                            <td>Hủy đơn hàng</td>
                            @endif


                            <td>
                                <a class="cart_quantity_delete" href="{{URL::to('/view-history-order/'.$or->order_id)}}"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table><!-- End .table table-summary -->
                </tbody>
                </table>


            </div>
        </div>
</section>
<!--================End Cart Area =================-->
@endsection