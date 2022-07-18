@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/savecategory')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" data-validation="length" data-validation-length="min1" data-validation-error-msg="Bạn hãy điền vào tên danh mục" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none;" rows="7" name="category_desc" class="form-control" id="ckeditor1" data-validation="length" data-validation-length="min1" data-validation-error-msg="Bạn hãy điền vào mô tả danh mục" placeholder="Mô tả danh mục"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Hiển thị</label>
                            <select name="category_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>

                        <button type="submit" name="add_category" class="btn btn-info">Thêm danh mục</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>

@endsection