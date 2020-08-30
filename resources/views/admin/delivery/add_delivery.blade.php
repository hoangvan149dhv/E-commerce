@extends('admin_layout')
@section('content')  {{--QUAN TRỌNG DÒNG YEIL dòng 294--}}
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Phí Ship
                </header>

                <div class="panel-body">
                    <div class="position-center">

                        <form >
                            @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">Chọn thành phố</label>
                            <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                <option value="0"><--Chọn tỉnh thành phố--></option>
                                @foreach ($city as $key=>$City)
                                <option value ="{{$City->matp}}">{{$City->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Quận huyên</label>
                            <select name="province" id="province" class="form-control input-sm m-bot15 choose province">
                                <option value="0" ><--Chọn Quận huyện--></option>
                                {{-- @foreach ($province as $key=>$Province)
                                <option value ="{{$Province->maqh}}">{{$Province->name}}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phường xã</label>
                            <select name="wards" id="wards" class="form-control input-sm m-bot15  wards">
                                <option value="0" ><-- Chọn phường xã --></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phí ship</label>
                            <input name="fee_ship" id="fee_ship" data-validation="length" data-validation-length="5-120" data-validation-error-msg='vui lòng điền 5- 120 kí tự' type="text" class="form-control" placeholder="Tên Sản Phẩm">
                        </div>  
                        <div class="alert-success">
                             
                        </div>
                        <button type="button"  class="btn btn-info add_delivery">Thêm Sản Phẩm</button>
                        {{-- <button type="button" name="submit" class="">Thêm Sản Phẩm</button> --}}
                        </form>
                    </div>
                    <div id="show_info_feeship">
                    </div>
                </div>
            </section>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function name(params) {
        
            fetch_delivery();
        //UPDATE FEE SHIP
        $(document).on('focus','.fee_ship',function name(params) {
                var text_fee_ship = $(this).val();
                
                var replace_string = text_fee_ship.split('.').join('').replace(' VNĐ','');
                $(this).val(replace_string);
            })
            $(document).on('blur','.fee_ship',function name(params) {
                var id_fee_ship = $(this).data('feeship');
                var fee_ship = $(this).val();
                // alert(id_fee_ship);
                // alert(fee_ship);
                $.ajax({
                    url : '{{url('/update-fee-delivery') }}',
                    method : 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:{ id_fee_ship:id_fee_ship, fee_ship:fee_ship},
                    success:function(data){
                        fetch_delivery();
                    }
                });
            })


            //SHOW FEE_SHIP
            function  fetch_delivery(){
                $.ajax({
                    url : '{{url('/select-info-delivery') }}',
                    method : 'GET',
                    success:function(data){
                        //data (pâramenter)
                        $('#show_info_feeship').html(data);
                    }
                });
             }
            //remove success insert
            $(document).on('blur','.btn.btn-info.add_delivery',function name(params) { 
                $('.alert-success.alert').remove();
            })
        // Insert data feeship
            $('.btn.btn-info.add_delivery').click(function name(params){
                var city = $('#city').val();
                var province = $('#province').val();
                var wards = $('#wards').val();
                var fee = $('#fee_ship').val();
                // var token = $('input[name="_token"]').val();
                console.log(city);
                console.log(province);
                console.log(wards);
                console.log(fee);
                // console.log(token);
                $.ajax({
                    url : '{{url('/add-fee-delivery') }}',
                    method : 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:{ city:city, province:province ,wards:wards , fee:fee},
                    success:function(data){
                        $('.alert-success').html('<div class="alert-success alert">Thêm phí ship thành công</div>');
                        fetch_delivery();
                    }
                });
            });
        //AJAX Find city , province, wards
            $('.choose').on('change',function name(params) {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                // console.log(action);
                // console.log(ma_id);
                // console.log(_token);

                
                if(action == 'city'){ 
                    result = 'province';
                    //résult_wards
                    result_ward ='wards';
                }else{
                    result = 'wards';
                }
                $.ajax({
                    url : '{{url('/select-delivery') }}',
                    method : 'POST',
                    data:{ action:action,ma_id:ma_id,_token:_token },
                    success:function(data){
                        //data (pâramenter)
                        var s = $('#'+result).html(data);
                        if(action == 'city'){
                            $('#'+result_ward).html('<option value="0"><--Vui lòng chọn quận huyện trước--></option>');
                        }
                        // console.log(s);
                    }
                });
            });
        });
    </script>
@endsection