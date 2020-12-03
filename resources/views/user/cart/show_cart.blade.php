@extends('user.index')
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
                                <img src="public/upload/{{$value_content->options->images}}" class="img-fluid"
                                     width="90" height="90"
                                     alt="">
                            </td>
                            {{-- Sản Phẩm --}}
                            <td class="cart_description">
                                <h5><p>{{$value_content->name }}</p></h5>
                            </td>
                            <td class="cart_price">
                                <p>{{number_format($value_content->price)}}.VNĐ</p>
                            </td>
                            {{-- SỐ LƯỢNG --}}
                            <td class="cart_quantity">
                                <form action="{{ URL::to('update_cart_quantity') }}" method="POST"
                                      style="margin-bottom:0px">
                                    {{ csrf_field() }}
                                    @csrf
                                    <div class="cart_quantity_button" style="text-align: center;">
                                        <input type="hidden" value="{{$value_content->rowId}}" name="rowId_cart">
                                        <input class="cart_quantity_input" type="number" name="qty"
                                               value="{{$value_content->qty}}" width="50px"
                                               min="1"> {{-- rowId là là trong dòng 17 GỌI LÀ RAMDOM --}}
                                        <input type="submit" name="submit" value="Sửa" class="cart_quantity_delete">
                                    </div>
                                </form>
                            </td>
                            {{--TỔNG GIÁ --}}
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    <?php
                                    $subtotal = $value_content->price * $value_content->qty;
                                    echo number_format($subtotal);
                                    ?>.VNĐ
                                </p>
                            </td>
                            <td class="cart_deletee">
                                <a onclick="return confirm('Bạn Muốn Xóa Sản Phẩm Này?')" class="cart_quantity_delete"
                                   data-id="$value_content->rowId"
                                   href="{{ URL::to('/delete/'.$value_content->rowId) }}"><i
                                        class="fa fa-times"></i></a>
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
                                <li><span class="subtotal_product">Tổng</span><span
                                        class="fee_cart_product">{{ str_replace('.00',"",Cart::subtotal()) }}</span><span>.VNĐ</span>
                                </li>
                                <li><span class="fee_ship">Phí vận chuyển</span>
                                    <span class="fee_ship_cart"></span><span class="fee_delivery"></span></li>
                                <li><span class="total_name">Thành tiền</span>
                                    <span class="total_price">{{ str_replace('.00',"",Cart::subtotal()) }}</span><span>.VNĐ</span>
                                </li>
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
                                    <input data-validation="length" data-validation-length="1-70"
                                           data-validation-error-msg='vui lòng điền đầy đủ thông tin' type="text"
                                           name="name" placeholder="Họ Và Tên Người Nhận">
                                    <input data-validation="length" data-validation-length="5-50"
                                           data-validation-error-msg='vui lòng điền đúng đúng email, Khi order sẽ được gửi mail'
                                           type="email"
                                           name="email" placeholder="Nhập đúng email, Khi order sẽ được gửi mail">
                                    <input data-validation="length" data-validation-length="10-11"
                                           data-validation-error-msg='vui lòng điền đúng số điện thoại bắt đầu 09xx,...'
                                           type="number"
                                           name="phone" placeholder="Số Điện Thoại">
                                    <form>
                                        @csrf
                                        <div class="form-group">
                                            <select name="city" id="city"
                                                    class="form-control input-sm m-bot15 choose city">
                                                <option value="0">Chọn tỉnh thành phố</option>
                                                @foreach ($city as $key=>$City)
                                                    <option value="{{$City->matp}}">{{$City->name}}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" class="val_feeship" name="val_feeship" value="20000">
                                        </div>
                                        <div class="form-group">
                                            <select name="province" id="province"
                                                    class="form-control input-sm m-bot15 choose province">
                                                <option value="0">Quận huyện</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="wards" id="wards"
                                                    class="form-control input-sm m-bot15  wards">
                                                <option value="0">Phường xã</option>
                                            </select>
                                        </div>
                                        <input data-validation="length" data-validation-length="1-70" class="add"
                                               data-validation-error-msg='vui lòng điền đầy đủ thông tin' type="text"
                                               placeholder="Địa Chỉ">
                                        <input type="hidden" name="add" id="val_address" value="">
                                        <textarea data-validation="length" data-validation-length="0-1000"
                                                  data-validation-error-msg='vui lòng điền đầy đủ thông tin' name="note"
                                                  id="" rows="6" placeholder="Ghi Chú"></textarea>
                                        <div style="color:red;margin-top:1.5rem;">
                                        </div>
                                        <div class="checkout">
                                            <button type="submit" name="submit" class="btn btn-default check_out"
                                                    style="margin-left: 0px;border-radius: 5px; font-size: 25px;">
                                                MUA HÀNG
                                            </button>
                                        </div>
                                    </form>
                                </form>
                            </div>
                        </div>
                        {{-- </form> --}}
                        <?php
                        }
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
        var select_delivery = "{{url('/select-delivery') }}";
        var select_delivery_feeship = "{{url('/select-delivery-feeship') }}";
    </script>
@endsection
