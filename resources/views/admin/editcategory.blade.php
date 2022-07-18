@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật danh mục sản phẩm
            </header>
            <div class="panel-body">
                @foreach($edit_category as $key => $edit_value)
                <div class="position-center">
                    <form role="form" action="{{URL::to('/updatecategory/'.$edit_value->category_id)}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" value="{{$edit_value->category_name}}" name="category_name" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none;" rows="5" name="category_desc" class="form-control" id="ckeditor1">{{$edit_value->category_desc}}</textarea>
                        </div>
                        <button type="submit" name="update_category" class="btn btn-info">Cập nhật danh mục</button>
                    </form>
                </div>
                @endforeach
            </div>
        </section>

    </div>
    @endsection