<!DOCTYPE html>
<html lang="en"><head>
@include('admin.sections.head')
<div class="log-w3">
    <div class="w3layouts-main">
        <h2>Đăng Nhập</h2>
    <form action="{{URL::to('/admin/admin-quanly')}}" method="post">{{ csrf_field() }}
                <input type="text" class="ggg" name="Email" value="{{ $result->user_name ?? '' }}" placeholder="Tên Đăng Nhập" required="">
                <input type="text" class="ggg" value="" name="Password" placeholder="Mật Khẩu..." required="">

                <h6><a href="{{ URL::to('/admin/quen-mat-khau') }}">Quên Mật Khẩu?</a></h6>
                    <div class="clearfix"></div>
                    <input type="submit" value="Đặng NHập" name="login">
            </form>
            <p>Chưa Có Tài Khoản?<a href="/">Tạo Tài khoản</a></p>
    </div>
</div>
