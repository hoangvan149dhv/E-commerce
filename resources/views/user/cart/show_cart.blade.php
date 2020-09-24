@extends('layout')
@Section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<section id="cart_items">
    <div class="container-sm">
        <div class="cart_info table-responsive">
            <?php
                $content = Cart::Content();
            ?>
            <table class="table table-responsive" style="margin-bottom: 0px;">
                <thead>
                    <tr class="cart_menu" style="text-align: center;">
                        <td class="image">Hình ảnh</td>
                        <td class="product">Sản phẩm</td>
                        <td class="price">Gía</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($content as $value_content)
                    <tr>
                        <td style="">
                            <img src="public/upload/{{$value_content->options->images}}" class="img-fluid" width="90" height="90" alt=""> {{-- options nằm bên Cartcontroller ($data['options']['image']) dòng 31 --}}
                        </td>
                        {{-- Sản Phẩm --}}
                        <td class="cart_description">
                            <h5 ><p>{{$value_content->name }}</p></h5>
                        </td>
                        <td   class="cart_price">
                            <p >{{number_format($value_content->price)}}.VNĐ</p>
                        </td>
                        {{-- SỐ LƯỢNG --}}
                        <td   class="cart_quantity">
                            <form action="{{ URL::to('update_cart_quantity') }}" method="POST" style="margin-bottom:0px">
                                {{ csrf_field() }}
                                    @csrf
                                <div class="cart_quantity_button"style="text-align: center;">
                                    <input type="hidden" value="{{$value_content->rowId}}" name="rowId_cart">
                                    <input class="cart_quantity_input" type="number" name="soluong" value="{{$value_content->qty}}" width="50px" min="1"> {{-- rowId là là trong dòng 17 GỌI LÀ RAMDOM --}}
                                    <input type="submit" name="submit" value="Sửa" class="cart_quantity_delete">
                                </div>
                            </form>
                        </td>
                        {{--TỔNG GIÁ --}}
                        <td   class="cart_total">
                            <p  class="cart_total_price">
                                <?php
                            $subtotal = $value_content->price * $value_content->qty;
                            echo number_format($subtotal);
                                ?>.VNĐ
                            </p>
                        </td>
                        <td class="cart_deletee">
                            <a onclick="return confirm('Bạn Muốn Xóa Sản Phẩm Này?')" class="cart_quantity_delete" data-id="$value_content->rowId" href="{{ URL::to('/delete/'.$value_content->rowId) }}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <section id="do_action">
        <div class="container-sm">
            <div class="row">
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li><span class="subtotal_product">Tổng</span><span class="fee_cart_product">{{ str_replace('.00',"",Cart::subtotal()) }}</span><span>.VNĐ</span></li>
                            <li><span class="fee_ship">Phí vận chuyển</span> <span class="fee_ship_cart"></span><span class="fee_delivery"></span></span></li>
                            <li><span class="total_name">Thành tiền</span><span class="total_price">{{ str_replace('.00',"",Cart::subtotal()) }}</span><span>.VNĐ</li>
                        </ul>
                    </div>

                </div>
                <div class="col-sm-6">
                    <div class="chose_area col-sm-12" style="padding-left:25px;">
                        <?php
                        if(empty($value_content->name)){
                            echo "<div class='danger' style='color:red;'>CHƯA CÓ SẢN PHẨM</div>";
                        }else{
                         ?>
                            <h2>Thông tin khách hàng</h2>
                            <div class="shopper-info">
                                <form action="{{ URL::to('/thanh-toan-gio-hang') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input  data-validation="length" data-validation-length="1-70" data-validation-error-msg='vui lòng điền đầy đủ thông tin' type="text" name="name" placeholder="Họ Và Tên Người Nhận">
                                    <input data-validation="length" data-validation-length="10-11" data-validation-error-msg='vui lòng điền đầy đủ thông tin' type="number" name="phone" placeholder="Số Điện Thoại">
                                        <form >
                                                @csrf
                                            <div class="form-group">
                                                <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                                    <option value="0">Chọn tỉnh thành phố</option>
                                                    @foreach ($city as $key=>$City)
                                                    <option value ="{{$City->matp}}">{{$City->name}}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" class="val_feeship" name="val_feeship" value="20000">
                                            </div>
                                            <div class="form-group">
                                                <select name="province" id="province" class="form-control input-sm m-bot15 choose province">
                                                    <option value="0" >Quận huyện</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select name="wards" id="wards" class="form-control input-sm m-bot15  wards">
                                                    <option value="0" >Phường xã</option>
                                                </select>
                                            </div>
                                            <input  data-validation="length" data-validation-length="1-70" class="add" data-validation-error-msg='vui lòng điền đầy đủ thông tin' type="text" placeholder="Địa Chỉ">
                                            <input type="hidden" name="add" id="val_address" value="">
                                            <textarea data-validation="length" data-validation-length="0-1000" data-validation-error-msg='vui lòng điền đầy đủ thông tin' name="note" id="" rows="6" placeholder="Ghi Chú"></textarea>
                                            <div style="color:red;margin-top:1.5rem;">
                                            </div>
                                            <div class="checkout" >
                                                <button type="submit" name="submit" class="btn btn-default check_out" style="margin-left: 0px;border-radius: 5px; font-size: 25px;">
                                                    MUA HÀNG
                                                </button>
                                            </div>
                                        </form>
                                    </form>
                            </div>
                    </div>
                    {{-- </form> --}}
                    <?php       }
                     ?>
                </div>
            </div>
        </div>
    </section>
    <!--/#do_action-->
</section>
<!--/#cart_items-->
@endsection
@section('script')
    <script>
        $(document).ready(function name(params) {
            $('.home, active').removeClass('active');
            $('.cart-product').addClass('active');

            //AJAX Find city , province, wards
            $('.choose').on('change',function name(params) {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
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
                        $('#'+result).html(data);
                        if(action == 'city'){
                            $('#'+result_ward).html('<option value="0" style="cursor: no-drop">Vui lòng chọn quận huyện trước</option>');
                        }
                    }
                });
            });

            //format number // money
            function formatNumber(nStr, decSeperate, groupSeperate) {
                nStr += '';
                x = nStr.split(decSeperate);
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
                }
                return x1 + x2;
            }
            //fee_ship
            $('#city').change(function name(params) {
                var fee_ship =$('#city option:selected').text();
                var _token = $('input[name="_token"]').val();
                var fee_cart_product = $('.fee_cart_product').text().replace(',','');
                var total ;
                $.ajax({
                    url : '{{url('/select-delivery-feeship') }}',
                    method : 'POST',
                    data:{ fee_ship:fee_ship,_token:_token },
                    success:function(data){
                        $('.fee_ship_cart').text(formatNumber(data , '.', ','));
                        $('.fee_delivery').text(".VNĐ");
                        if(data.length < 1){
                            total = 20000 + parseFloat(fee_cart_product);
                            $('.val_feeship').val(20000);
                            $('.fee_ship_cart').text(formatNumber(20000 , '.', ','));
                        }else{
                            $('.val_feeship').val(parseFloat(data));
                            total = parseFloat(data) + parseFloat(fee_cart_product);
                        }

                        $('.total_price').text(formatNumber(parseFloat(total) , '.', ','));

                    }
                });
            });
            $('.checkout').click(function name(params) {
                if($('#wards').val() == 0 || $('#province').val() == 0 || $('#wards').val() == 0){
                    alert('Vui lòng điền đầy đủ thông tin');
                    return false;
                }
                var val_city = $('#city option:selected').text();
                var val_province = $('#province option:selected').text();
                var val_wards = $('#wards option:selected').text();
                var val_add = $('.add').val();
                $('#val_address').val( val_add + ", " +val_wards + ", " +  val_province + ", " + val_city);
            })
        });
    </script>
@endsection
