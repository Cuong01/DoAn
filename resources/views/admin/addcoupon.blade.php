@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mã giảm giá
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-coupon')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên mã giảm giá</label>
                            <input type="text" name="coupon_name" class="form-control" id="exampleInputEmail1" data-validation="length" data-validation-length="min1" data-validation-error-msg="Bạn hãy điền vào tên mã giảm giá" placeholder="Tên mã giảm giá">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mã giảm giá</label>
                            <input type="text" name="coupon_code" class="form-control" id="exampleInputEmail1" data-validation="length" data-validation-length="min1" data-validation-error-msg="Bạn hãy điền vào mã giảm giá" placeholder="Mã giảm giá">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Số lượng mã</label>
                            <input type="text" name="coupon_time" class="form-control" id="exampleInputEmail1" data-validation="number" data-validation-error-msg="Bạn hãy điền vào số lượng mã" placeholder="Số lượng mã">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Tính năng mã</label>
                            <select name="coupon_condition" class="form-control input-sm m-bot15">
                                <option>------chọn------</option>
                                <option value="1">Giảm theo phần trăm</option>
                                <option value="2">Giảm theo tiền</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Nhập số % hoặc tiền giảm</label>
                            <input type="text" name="coupon_number" class="form-control" id="exampleInputEmail1" data-validation="number" data-validation-error-msg="Bạn hãy điền vào số % hoặc tiền giảm" placeholder="Nhập số % hoặc tiền giảm">
                        </div>

                        <button type="submit" name="add_category" class="btn btn-info">Thêm mã</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>

@endsection