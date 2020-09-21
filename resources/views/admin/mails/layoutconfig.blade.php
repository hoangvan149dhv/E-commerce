@extends('admin_layout')
@section('content')  {{--QUAN TRỌNG DÒNG YEIL dòng 294--}}
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cấu Hình Mail (Mail mà bạn muốn nhận)
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ URL::to('/save-config-mail') }}" method="POST">
                       {{ csrf_field() }}  {{-- CÂU LỆNH token BẢO MẬT --}}
                            @foreach ($configmail as $item)
                            <div class="form-group">
                                <label for="exampleInputEmail1">Địa chỉ Email</label>
                                    <input value="{{ $item->Email }}"  data-validation="length" data-validation-length="5-120" data-validation-error-msg='vui lòng điền 5- 120 kí tự' type="email" class="form-control" name="Email"id="exampleInputEmail1" placeholder="Tên Sản Phẩm">
                                <input type="hidden" name="ID" value="1">
                            </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên mail để gửi</label>
                                    <input value="{{ $item->name_email }}"  data-validation="length" data-validation-length="1-120" data-validation-error-msg='vui lòng điền 5- 120 kí tự' type="text" class="form-control" name="name"id="exampleInputEmail1" placeholder="Tên Sản Phẩm">

                                </div>
                            @endforeach
                            <div class="checkbox">
                            </div>
                            <button type="submit" name="submit"  class="btn btn-info-mail">Lưu</button>
                        </form>
                    </div>

                </div>
            </section>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function name(params) {
            $('.btn-info-mail').click(function () {
                var Email = $('#exampleInputEmail1').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url : '{{url('') }}',
                    method : 'POST',
                    data:{ Email:Email,_token:_token },
                    success:function(data){
                        alert('Thêm thành công');
                        var s = $('#exampleInputEmail1').val(data);
                    }
                });
            });
        });
    </script>
@endsection
@section('mail')
     class="active"
@endsection
