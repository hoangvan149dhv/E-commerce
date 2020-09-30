@extends('layout')
@Section('content')
<div class="contact-form">
    <h2 class="title text-center">Thông Tin Khách Hàng</h2>
    <div class="status alert alert-success" style="display: none"></div>
    <form action="{{URL::to('/hien-thi-thong-tin')}}" method="post">
        {{ csrf_field() }}
        <div class="form-group col-md-12"><h3>Nhập Số Điện Thoại</h3></div>
        <div class="form-group col-md-12">
            <input type="text" name="phone" class="form-control" placeholder="Số Điện Thoại">
        </div>
        <div class="form-group col-md-12">
            <input type="submit" name="submit" class="btn btn-primary pull-right" style="border-radius:5px" value="Tìm">
        </div>
    </form>
</div>

@endsection
@section('script')
    <script>$(document).ready(function name(params) {
        $('.home, active').removeClass('active');
        $('.info-customer').addClass('active')
    });
    </script>
@endsection
