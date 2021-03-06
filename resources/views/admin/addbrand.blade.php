@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm thương hiệu sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/savebrand')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" data-validation="length" data-validation-length="min1" data-validation-error-msg="Bạn hãy điền vào tên thương hiệu" placeholder="Tên thương hiệu">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                            <textarea style="resize: none;" rows="7" name="brand_desc" class="form-control" id="ckeditor1" data-validation="length" data-validation-length="min1" data-validation-error-msg="Bạn hãy điền vào mô tả thương hiệu" placeholder="Mô tả thương hiệu"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Hiển thị</label>
                            <select name="brand_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>

                        <button type="submit" name="add_brand" class="btn btn-info">Thêm thương hiệu</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>

@endsection