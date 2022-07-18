@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
    <div class="panel-heading">
        Liệt kê bình luận
    </div>
    <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
                <tr>
                    <th>Trạng thái</th>
                    <th>Tên người gửi</th>
                    <th>Bình luận</th>
                    <th>Ngày gửi</th>
                    <th>Sản phẩm</th>


                    <th style="width:30px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($comment as $key => $com)
                <tr>
                    <td>
                        @if($com->comment_status==1)
                        <input type="button" data-comment_status="0" data-comment_id="{{$com->comment_id}}" id="{{$com->comment_product_id}}" class="btn btn-primary comment_status_btn" value="Hiển thị">
                        @elseif($com->comment_status==0)
                        <input type="button" data-comment_status="1" data-comment_id="{{$com->comment_id}}" id="{{$com->comment_product_id}}" class="btn btn-danger comment_status_btn" value="Ẩn">
                        @endif
                    </td>
                    <td>{{$com->comment_name}}</td>
                    <td>{{$com->comment_content}}
                        <style>
                            ul.list_rep li {
                                list-style-type: decimal;
                                color: rgb(0, 115, 255);
                                margin: 5px 40px;
                            }
                        </style>
                        <ul class="list_rep">
                            <p>Trả lời:</p>
                            @foreach($comment_rep as $key => $comm_reply)
                            @if($comm_reply->comment_parent_comment == $com->comment_id)
                            <li> {{$comm_reply->comment_content}}</li>

                            @endif
                            @endforeach
                        </ul>
                        @if($com->comment_status==1)
                        <br /><textarea class="form-control reply_comment_{{$com->comment_id}}" rows="4"></textarea>
                        <br /><button class="btn btn-default btn-reply-comment" data-comment_id="{{$com->comment_id}}" data-product_id="{{$com->comment_product_id}}">Trả lời</button>
                        @endif
                    </td>
                    <td>{{$com->comment_date}}</td>
                    <td>{{$com->product->product_name}}</td>
                    <td>
                        <a onclick="return confirm('Bạn có muốn xóa không?')" href="{{URL::to('/delete-comment/'.$com->comment_id)}}" class="active" ui-toggle-class="">
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
                {{$comment->links()}}
            </div>
    </footer>
</div>
@endsection