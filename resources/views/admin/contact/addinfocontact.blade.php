@extends('admin.admin_layout')
@section('content-layout')  {{--QUAN TRỌNG DÒNG YEIL dòng 294--}}
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thông tin liên hệ
                </header>
                @foreach ($contactinfoModel as $contact)
                <div class="panel-body">
                    <div class="position-center">
                    <form role="form" action="{{URL::to('/save-info-contact')}}" method="post">
                       {{ csrf_field() }}  {{-- CÂU LỆNH token BẢO MẬT --}}
                       <div class="form-group">
                            <label for="exampleInputPassword1">Bản đồ</label>
                            <input type="text" class="form-control" name="googlemap"id="exampleInputEmail1" value="{{ $contact->google_map }}" placeholder="Địa chỉ">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Địa chỉ</label>
                            <input  data-validation="length" data-validation-length="5-120" data-validation-error-msg='vui lòng điền 5- 120 kí tự' type="text" class="form-control" name="add"id="exampleInputEmail1" value="{{ $contact->info_contact_add }}" placeholder="Địa chỉ">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">SĐT</label>
                            <input  data-validation="number" data-validation-length="4-10" data-validation-error-msg='vui lòng điền 10 kí tự' type="text" class="form-control" value="{{ $contact->info_contact_phone }}" name="phone"id="exampleInputEmail1" placeholder="Số điện thoại">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $contact->info_contact_mail }}" required="required" placeholder="Email">
                        </div>
                        <div class="checkbox">
                        </div>
                        <button type="submit" name="submit" class="btn btn-info">Thêm</button>
                        </form>
                    </div>

                </div>
                @endforeach
            </section>
    </div>
</div>
@endsection
@section('brand')
     class="active"
@endsection
