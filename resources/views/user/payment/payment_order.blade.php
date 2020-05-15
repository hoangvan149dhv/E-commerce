@extends('layout')   {{-- "triệu gọi trang layout như include"  LƯU Ý:TRONG LARAVEL ĐẶT FILE PHẢI CÓ .BLADE.PHP --}}
        {{-- GỌI folder routes/web.php dòng 15 --}}
@Section('content')  {{--Đặt 'content bên trang welcome.blade.php dòng 355' --}}
<div class="row" style="text-align:justify">
        <div style="padding-left:25px;border:1px solid #F7F7F0;padding:50px 10px;border-radius:15px;" >
        <p style="font-size:19px">Qúy Khách Đã Đặt Hàng Thành Công, Cảm ơn quý khách đã tin tưởng sản phẩm của công ty chúng tôi,quý khách có thể nhấn <a href="{{URL::to('thong-tin-khach-hang')}}">VÀO ĐÂY </a>để xem thông tin của mình</p>
        </div>
</div>
@endsection 