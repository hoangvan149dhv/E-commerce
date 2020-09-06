@extends('layout') {{-- "triệu gọi trang layout như include" LƯU Ý:TRONG LARAVEL ĐẶT FILE PHẢI CÓ .BLADE.PHP --}} {{-- GỌI folder routes/web.php dòng 15 --}} @Section('content') {{--Đặt 'content bên trang welcome.blade.php dòng 355' --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<section id="cart_items">
    <div class="container-sm">

        <div class="cart_info table-responsive">
            <?php
                $content = Cart::Content();//Cart::Content() KẾT NỐI Cart

                //     echo "<pre>";
                //         print_r($content);
                //         echo"</pre>";
                ?>
                <?php
                                // $content = Cart::Content();//Cart::Content()
                                // $message = Session::get('message');
                                // if($message){
                                //     echo "(".$message.")";
                                //     Session::put('message',null);
                                // }else{echo "";}
                                // $content_cart = Cart::content()->count();
                                // echo $content_cart;
                            ?>
                    <table class="table table-responsive" style="margin-bottom: 0px;">
                        <thead>
                            <tr class="cart_menu" style="     text-align: center;">
                                <td class="image">Hình ảnh</td>
                                <td class="product">Sản phẩm</td>
                                <td class="price">Gía</td>
                                <td class="quantity">Số lượng</td>
                                <td class="total">Tổng</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- XEM BÊN CARTCONTROLLER function save_product_Cart BÀI 33 --}}
                             @foreach ($content as $value_content) {{--$content là khai báo dòng 14, nó hiển thị ra thông tin đã add vào cart--}}
                            <tr>
                                <td style="">
                                    <img src="public/upload/{{$value_content->options->images}}" class="img-fluid" width="90" height="90" alt=""> {{-- options nằm bên Cartcontroller ($data['options']['image']) dòng 31 --}}
                                </td>
                                {{-- Sản Phẩm --}}
                                <td   class="cart_description">
                                    <h5 ><p>{{$value_content->name }}</p></h5> {{-- name nằm bên Cartcontroller ($data['name']) dòng 25 --}} {{--
                                    <p>Mã Hàng: {{$value_content->weight}}</p> --}}
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
                            <li>Tổng<span>{{ str_replace('.00',"",Cart::subtotal()) }}.VNĐ</span></li>
                            <li>Phí vận chuyển <span></span></li>
                            <li>Thành tiền <span>{{ str_replace('.00',"",Cart::subtotal()) }}.VNĐ</span></li>
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
                                    <input  data-validation="length" data-validation-length="5-70" data-validation-error-msg='vui lòng điền đầy đủ thông tin' type="text" name="name" placeholder="Họ Và Tên Người Nhận">
                                    <input  data-validation="length" data-validation-length="5-70" data-validation-error-msg='vui lòng điền đầy đủ thông tin' type="text" name="add" placeholder="Địa Chỉ">
                                    <input data-validation="length" data-validation-length="10-11" data-validation-error-msg='vui lòng điền đầy đủ thông tin' type="number" name="phone" placeholder="SỐ Điện Thoại">

                                            <form >
                                                @csrf
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Địa chỉ</label>
                                                <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                                    <option value="0"><--Chọn tỉnh thành phố--></option>
                                                    @foreach ($city as $key=>$City)
                                                    <option value ="{{$City->matp}}">{{$City->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select name="province" id="province" class="form-control input-sm m-bot15 choose province">
                                                    <option value="0" ><--Chọn Quận huyện--></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select name="wards" id="wards" class="form-control input-sm m-bot15  wards">
                                                    <option value="0" ><-- Chọn phường xã --></option>
                                                </select>
                                            </div>
                                            </form>
                                    <textarea data-validation="length" data-validation-length="0-1000" data-validation-error-msg='vui lòng điền đầy đủ thông tin' name="note" id="" rows="6" placeholder="Ghi Chú"></textarea>
                                    <div style="color:red;margin-top:1.5rem;">
                                    </div>
                                    <div class="checkout" >
                                        <button type="submit" name="submit" class="btn btn-default check_out" style="margin-left: 0px;border-radius: 5px; font-size: 25px;">
                                            MUA HÀNG
                                        </button>
                                    </div>
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
    <style>
        .note {
            color: red;
            font-size: 35px;
            font-weight: bold;
        }
    </style>
</section>
<!--/#cart_items-->
@endsection
@section('script')
    {{-- <script>
        
        $(document).ready(function name(params) {
            $('.cart_quantity_delete').click(function name(params) {
                var id = $(this).data("id");
                // alert(id);
                $.ajax({
                    url:"/hien-thi-gio-hang/"+id ,
                    type:'delete',
                    success:function(){
                        swal("Here's a message!");
                    }
                });
            });
        });
    </script> --}}
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
                        var s = $('#'+result).html(data);

                        if(action == 'city'){
                            $('#'+result_ward).html('<option value="0"><--Vui lòng chọn quận huyện trước--></option>');
                        }
                    }
                });
            });
        });
    </script>
@endsection