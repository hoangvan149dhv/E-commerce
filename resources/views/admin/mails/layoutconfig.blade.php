@extends('admin.admin_layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cấu Hình Mail (Mail mà bạn muốn nhận)
            </header>
            <?php
                //MESSAGE SEND TEST MAIL SUCCESS
                $message  = \Illuminate\Support\Facades\Session::get('send-mail-success');
                 if($message){
                     echo "<script>alert('".$message."')</script>";
                     Session::put('send-mail-success',null);
                 }
            ?>
            <div class="panel-body">
                <div class="position-center">
                    <form action="{{ URL::to('/save-config-mail') }}" method="POST">
                    {{ csrf_field() }}  {{-- Token --}}
                        @foreach ($configmail as $item)
                        <div class="form-group">
                            <label for="exampleInputEmail1">Địa chỉ Email</label>
                                <input value="{{ $item->Email }}"  data-validation="length" data-validation-length="5-120" data-validation-error-msg='vui lòng điền 5- 120 kí tự' type="email" class="form-control" name="Email"id="exampleInputEmail1">
                            <input type="hidden" name="ID" value="1">
                        </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên mail để gửi</label>
                                <input value="{{ $item->name_email }}"  data-validation="length" data-validation-length="1-120" data-validation-error-msg='vui lòng điền 5- 120 kí tự' type="text" class="form-control" name="name"id="exampleInputEmail1">
                            </div>
                        @endforeach
                        <?php
                        //Add info config mail success
                        $configmail_success  = \Illuminate\Support\Facades\Session::get('add-config-mail-success');
                        if($configmail_success){
                            echo "<script>alert('".$configmail_success."')</script>";
                            Session::put('add-config-mail-success',null);
                        }
                        ?>
                        <div class="checkbox">
                            <div class="checkbox">
                                <div class="form-group">
                                    <span>Trạng thái gửi mail</span>
                                    <input type="checkbox" style="margin-left: 20px" @if ($item->publish == 1) checked="checked" @endif  value="1"  name="publish"  ></label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="submit"  class="btn  btn-info">Lưu</button>
                    </form>
                </div>
                <a href="{{URL::to('/send-test-mail')}}"><button type="submit" name="submit"  class="btn  btn-info ">Test mail</button></a>
            </div>
        </section>
    </div>
</div>
@endsection
@section('mail')
     class="active"
@endsection
