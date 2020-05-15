@extends('layout')
 @Section('content') {{--Đặt 'content bên trang welcome.blade.php dòng 355' --}}
<section id="cart_items">
    <div class="container-sm">

        <div class="cart_info table-responsive">
            <?php
                //Cart::Content() KẾT NỐI Cart

                //     echo "<pre>";
                //         print_r($content);
                //         echo"</pre>";
                ?>
                <?php
                            ?>
                    <table class="table table-responsive" style="margin-bottom: 0px;">
                        <thead>
                            <tr class="cart_menu" style="  border: 1px solid #E6E4DF;  text-align: center;">
                                <td class="image">Hình ảnh</td>
                                <td class="product">Sản phẩm</td>
                                <td class="price">Gía</td>
                                <td class="quantity">Số lượng</td>
                                <td class="total">Tổng</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                //  echo "<pre>";
                                //   print_r(Session::get('cart'));
                                //  echo"</pre>";
                                ?>
                            @foreach (Session::get('cart') as $cart)
                            <tr>
                                <td style="border: 1px solid #E6E4DF;padding:25px 10px;text-align: center;">
                                    <img src="public/upload/{{ $cart['product_image'] }}" class="img-fluid" width="90" height="90" alt="">
                                </td>
                                <td style="border: 1px solid #E6E4DF;" class="cart_description">
                                    <h5 style="text-align: center;"><p>{{ $cart['product_Name'] }}</p></h5>
                                                                        {{-- product_Name CHÍNH LÀ CÁI MẢNG CỦA cart CartController dòng 78 --}}
                                </td>
                                <td style="border: 1px solid #E6E4DF;" class="cart_price">
                                    <p style="text-align: center;">{{ number_format($cart['product_price']) }}.VNĐ</p>
                                                                        {{-- product_price CHÍNH LÀ CÁI MẢNG CỦA cart CartController dòng 78 --}}
                                </td>
                                <td style="border: 1px solid #E6E4DF;" class="cart_quantity">
                                    <form action="{{ URL::to('update_cart_quantity_ajax') }}" method="POST" style="margin-bottom:0px">
                                        <div class="cart_quantity_button" style="margin-top:10px;text-align: center;">
                                            @csrf
                                            <input type="hidden" value="" name="rowId_cart">
                                            <input class="cart_quantity_input" type="number" name="soluong" value="{{ $cart['product_qty'] }}" width="50px" min="1"> 
                                            <input type="submit" name="submit" value="Sửa" class="cart_quantity_delete" style="color:white;font-size:17px;background:#FE980F;">
                                        </div>
                                    </form>
                                </td>
                                <td style="border: 1px solid #E6E4DF;" class="cart_total">
                                    <p style="text-align: center;" class="cart_total_price">
                                        <?php
                                    $subtotal = $cart['product_price'] * $cart['product_qty'];
                                    echo number_format($subtotal);
                                ?>.VNĐ
                                    </p>
                                </td>
                                <td class="cart_deletee" style="border: 1px solid #E6E4DF;">
                                    <a class="cart_quantity_delete" href="{{ URL::to('/deleteajax/'.$cart['product_id'])}}"><i class="fa fa-times"></i></a> 
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
        </div>
    </div>
    <!--/#do_action-->
</section>
<!--/#cart_items-->
@endsection