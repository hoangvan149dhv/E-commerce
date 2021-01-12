@extends('admin.index')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Phí Ship
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Chọn thành phố</label>
                                <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                    <option value="0"><--Chọn tỉnh thành phố--></option>
                                    @foreach ($city as $key=>$City)
                                        <option value="{{$City->matp}}">{{$City->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Quận huyên</label>
                                <select name="province" id="province"
                                        class="form-control input-sm m-bot15 choose province">
                                    <option value="0"><--Chọn Quận huyện--></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phường xã</label>
                                <select name="wards" id="wards" class="form-control input-sm m-bot15  wards">
                                    <option value="0"><-- Chọn phường xã --></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phí ship</label>
                                <input name="fee_ship" id="fee_ship" data-validation="number"
                                       data-validation-length="5-120" data-validation-error-msg='vui lòng điền phí ship'
                                       type="number" class="form-control" placeholder="Tên Sản Phẩm">
                            </div>
                            <div class="alert-success">

                            </div>
                            <button type="button" class="btn btn-info add_delivery">Thêm Phí Ship</button>
                        </form>
                    </div>
                    {{-- SEARCH-FEE-DELIVERY --}}
                    <div class="row w3-res-tb">
                        <div class="col-sm-5 m-b-xs">
                        </div>
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-3">
                            <form>
                                <div class="input-group">
                                    <input type="text" name="search"
                                           class="input-sm form-control input_search_fee_ship">
                                    <span class="input-group-btn">
                          <button class="btn btn-sm btn-default search_fee_ship" type="button"
                                  name="submit">Tìm</button>
                        </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- LIST-FEE-DELIVERY-AJAX --}}
                    <div id="show_info_feeship">
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div id="background" style="text-align: center;
    position: fixed;
    z-index: 9999999999;
    background-color: rgba(0, 0, 0, 0.7);
    width: 100%;
    height: 100%;
    border: 0;
    padding: calc( 50vh - 50px)  0;
    top: 0;
    left: 0;
    display: none;"><img src="public/upload/reloading.gif" class="load-page"></div>
@endsection
@section('script')
    <script>
        $(document).ready(function name(params) {
            fetch_delivery();
            //UPDATE FEE SHIP
            $(document).on('focus', '.fee_ship', function name(params) {
                var text_fee_ship = $(this).val();
                $(this).attr({"type": "number", "min": "1"});
                var id_fee_ship = $(this).data('feeship');
                var replace_string = text_fee_ship.split('.').join('').replace(' VNĐ', '').trim();
                $(this).val(replace_string);
            })
            //remove fee deli
            $(document).on('blur', '.fee_ship', function name(params) {
                var id_fee_ship = $(this).data('feeship');
                var fee_ship = $(this).val();

                if (fee_ship == 0) {
                    $.ajax({
                        url: '{{url('/del-fee-delivery') }}',
                        method: 'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {id_fee_ship: id_fee_ship},
                        success: function (data) {
                            fetch_delivery();
                        }
                    });
                }
                $.ajax({
                    url: '{{url('/update-fee-delivery') }}',
                    method: 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {id_fee_ship: id_fee_ship, fee_ship: fee_ship},
                    success: function (data) {
                        fetch_delivery();
                    }
                });
            })

            //SHOW FEE_SHIP
            function fetch_delivery() {
                $.ajax({
                    url: '{{url('/select-info-delivery') }}',
                    method: 'GET',
                    success: function (data) {
                        //data (pâramenter)
                        $('#show_info_feeship').html(data);
                    }
                });
            }

            //remove success insert
            $(document).on('blur', '.btn.btn-info.add_delivery', function name(params) {
                $('.alert-success.alert').remove();
                $('.alert-danger.alert').remove();
            })
            // Insert data feeship
            $('.btn.btn-info.add_delivery').click(function name(params) {
                var city = $('#city option:selected').text();
                var province = $('#province option:selected').text();
                var wards = $('#wards option:selected').text();
                var fee = $('#fee_ship').val();
                $('#background').css('display', 'block');
                $.ajax({
                    url: '{{url('/add-fee-delivery') }}',
                    method: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {city: city, province: province, wards: wards, fee: fee},
                    success: function (data) {
                        $('#background').css('display', 'none');
                        $('.alert-success').html(data);
                        fetch_delivery();
                    }
                });
            });
            //AJAX Find city , province, wards
            $('.choose').on('change', function name(params) {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                if (action == 'city') {
                    result = 'province';
                    //résult_wards
                    result_ward = 'wards';
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: '{{url('/select-delivery') }}',
                    method: 'POST',
                    data: {action: action, ma_id: ma_id, _token: _token},
                    success: function (data) {
                        var s = $('#' + result).html(data);

                        if (action == 'city') {
                            $('#' + result_ward).html('<option value="0"><--Vui lòng chọn quận huyện trước--></option>');
                        }
                    }
                });
            });
            // SEARCH FEE_SHIP keypress
            $('.search_fee_ship, .input_search_fee_ship').on('keypress keydown', function name(event) {
                var val_input = $('.input_search_fee_ship').val();
                //reset value
                if (event.keyCode == 8 || event.keyCode == 46) {
                    if (val_input.length == 0) {
                        fetch_delivery();
                    }
                }
                $.ajax({
                    url: '{{url('/search-fee-ship') }}',
                    method: 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {val_input: val_input},
                    success: function (data) {
                        $('#show_info_feeship').html(data);
                    }
                })
            })
        });
    </script>
@endsection
