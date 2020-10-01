@foreach($item_detail_order as $item)
Tài khoản: {{$item->user_name}}
<br>Mật khẩu: {{$item->pass}}
@endforeach
