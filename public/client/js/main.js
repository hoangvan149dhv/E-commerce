$('#sl2').slider();
var RGBChange = function() {
    $('#RGB').css('background', 'rgb(' + r.getValue() + ',' + g.getValue() + ',' + b.getValue() + ')')
};
$(document).ready(function() {
    $(function() {
        $.scrollUp({
            scrollName: 'scrollUp',
            scrollDistance: 300,
            scrollSpeed: 300,
            easingType: 'linear',
            animation: 'fade',
            animationSpeed: 200,
            scrollTrigger: !1,
            scrollText: '<i class="fa fa-angle-up"></i>',
            scrollTitle: !1,
            scrollImg: !1,
            activeOverlay: !1,
            zIndex: 999
        })
    })
    $.validate({});
    $(window).scroll(function name(params) {
        if (window.scrollY > 300) {
            $('.icon-bar-menu').addClass('menu-bar');
            $(".header-middle").slideUp(100)
        }
        if (window.scrollY < 200) {
            $('.icon-bar-menu, menu-bar').removeClass('menu-bar')
            $(".header-middle").slideDown(100)
        }
    })
    $('#background').fadeIn(1000);
    $('#background').click(function name(params) {
        $('#background').fadeOut(700, function name(params) {
            $(this).css('display', 'none')
        })
    })
    $('#background button').click(function name(params) {
        $('#background').fadeOut(700, function name(params) {
            $(this).css('display', 'none')
        })
    });
    $('.carousel-indicators li:first-child, .carousel-inner>.item:first-child').addClass('active');
    $('.add-to-cart').click(function() {
        var id = $(this).data('id_product');
        var cart_id = $('.cart_product_id_' + id).val();
        var cart_name = $('.cart_product_name_' + id).val();
        var cart_image = $('.cart_product_image_' + id).val();
        var cart_price = $('.cart_product_price_' + id).val();
        var cart_qty = $('.cart_product_qty_' + id).val();
        var _token = $('input[name="_token"]').val();
        var url = $(".url").attr('url');
        var cart_url = $(".url_addtocart_success").attr('url');
        $.ajax({
            url: url,
            method: 'GET',
            data: {
                cart_id: cart_id,
                cart_name: cart_name,
                cart_image: cart_image,
                cart_price: cart_price,
                cart_qty: cart_qty,
                _token: _token
            },
            success: function() {
                setTimeout(() => {
                    swal({
                        title: "Đã thêm sản phẩm vào giỏ hàng",
                        text: "Bạn có thể tiếp tục mua hàng hoặc tới giỏ hàng để tiến hành thanh toán",
                        showCancelButton: !0,
                        cancelButtonText: "Xem tiếp",
                        confirmButtonClass: "btn-primary",
                        confirmButtonText: "Đi đến giỏ hàng",
                        type: "success",
                        closeOnConfirm: !1
                    }, function() {
                        window.location.href = cart_url
                    })
                }, 100)
            }
        })
    });
    $('.home, active').removeClass('active');
    $('.cart-product').addClass('active');
    $('.choose').on('change', function name(params) {
        var action = $(this).attr('id');
        var ma_id = $(this).val();
        var _token = $('input[name="_token"]').val();
        var result = '';
        if (action == 'city') {
            $('#img-load').css('display', 'block');
            result = 'province';
            result_ward = 'wards'
        } else {
            result = 'wards'
        }
        $.ajax({
            url: select_delivery,
            method: 'POST',
            data: {
                action: action,
                ma_id: ma_id,
                _token: _token
            },
            success: function(data) {
                $('#' + result).html(data);
                $('#img-load').css('display', 'none');
                if (action == 'city') {
                    $('#' + result_ward).html('<option value="" style="cursor: no-drop">Vui lòng chọn quận huyện trước</option>')
                }
            }
        })
    });

    function formatNumber(nStr, decSeperate, groupSeperate) {
        nStr += '';
        x = nStr.split(decSeperate);
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + groupSeperate + '$2')
        }
        return x1 + x2
    }
    $('#city').change(function name(params) {
        var fee_ship = $('#city option:selected').text();
        var _token = $('input[name="_token"]').val();
        var fee_cart_product = $('.fee_cart_product').text().split(',').join('');
        var total;
        $.ajax({
            url: select_delivery_feeship,
            method: 'POST',
            data: {
                fee_ship: fee_ship,
                _token: _token
            },
            success: function(data) {
                $('.fee_ship_cart').text(formatNumber(data, '.', ','));
                $('.fee_delivery').text(".VNĐ");
                if (data.length < 1) {
                    total = 20000 + parseFloat(fee_cart_product);
                    $('.val_feeship').val(20000);
                    $('.fee_ship_cart').text(formatNumber(20000, '.', ','))
                } else {
                    $('.val_feeship').val(parseFloat(data));
                    total = parseFloat(data) + parseFloat(fee_cart_product)
                }
                $('.total_price').text(formatNumber(parseFloat(total), '.', ','))
            }
        })
    });
    $('.checkout').click(function name(params) {
        if ($('#wards').val() == ''|| $('#province').val() == '' || $('#wards').val() == '') {
            alert('Vui lòng điền đầy đủ thông tin');
            return ;
        }
        var val_city = $('#city option:selected').text();
        var val_province = $('#province option:selected').text();
        var val_wards = $('#wards option:selected').text();
        var val_add = $('.add').val();
        $('#val_address').val(val_add + ", " + val_wards + ", " + val_province + ", " + val_city)
    })
})
