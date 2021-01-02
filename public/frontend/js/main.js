(function($) {

	"use strict";

	$(window).stellar({
    responsive: true,
    parallaxBackgrounds: true,
    parallaxElements: true,
    horizontalScrolling: false,
    hideDistantElements: false,
    scrollProperty: 'scroll'
  });


	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	// loader
	var loader = function() {
		setTimeout(function() { 
			if($('#ftco-loader').length > 0) {
				$('#ftco-loader').removeClass('show');
			}
		}, 1);
	};
	loader();

	var carousel = function() {
		$('.carousel-testimony').owlCarousel({
			center: true,
			loop: true,
			autoplay: true,
			autoplaySpeed:2000,
			items:1,
			margin: 30,
			stagePadding: 0,
			nav: false,
			navText: ['<span class="ion-ios-arrow-back">', '<span class="ion-ios-arrow-forward">'],
			responsive:{
				0:{
					items: 1
				},
				600:{
					items: 2
				},
				1000:{
					items: 3
				}
			}
		});

	};
	carousel();

	$('nav .dropdown').hover(function(){
		var $this = $(this);
		// 	 timer;
		// clearTimeout(timer);
		$this.addClass('show');
		$this.find('> a').attr('aria-expanded', true);
		// $this.find('.dropdown-menu').addClass('animated-fast fadeInUp show');
		$this.find('.dropdown-menu').addClass('show');
	}, function(){
		var $this = $(this);
			// timer;
		// timer = setTimeout(function(){
			$this.removeClass('show');
			$this.find('> a').attr('aria-expanded', false);
			// $this.find('.dropdown-menu').removeClass('animated-fast fadeInUp show');
			$this.find('.dropdown-menu').removeClass('show');
		// }, 100);
	});


	$('#dropdown04').on('show.bs.dropdown', function () {
	  console.log('show');
	});

	// scroll
	var scrollWindow = function() {
		$(window).scroll(function(){
			var $w = $(this),
					st = $w.scrollTop(),
					navbar = $('.ftco_navbar'),
					sd = $('.js-scroll-wrap');

			if (st > 150) {
				if ( !navbar.hasClass('scrolled') ) {
					navbar.addClass('scrolled');	
				}
			} 
			if (st < 150) {
				if ( navbar.hasClass('scrolled') ) {
					navbar.removeClass('scrolled sleep');
				}
			} 
			if ( st > 350 ) {
				if ( !navbar.hasClass('awake') ) {
					navbar.addClass('awake');	
				}
				
				if(sd.length > 0) {
					sd.addClass('sleep');
				}
			}
			if ( st < 350 ) {
				if ( navbar.hasClass('awake') ) {
					navbar.removeClass('awake');
					navbar.addClass('sleep');
				}
				if(sd.length > 0) {
					sd.removeClass('sleep');
				}
			}
		});
	};
	scrollWindow();

	var counter = function() {
		
		$('#section-counter, .wrap-about, .ftco-counter').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('ftco-animated') ) {

				var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',')
				$('.number').each(function(){
					var $this = $(this),
						num = $this.data('number');
						console.log(num);
					$this.animateNumber(
					  {
					    number: num,
					    numberStep: comma_separator_number_step
					  }, 7000
					);
				});
				
			}

		} , { offset: '95%' } );

	}
	counter();


	var contentWayPoint = function() {
		var i = 0;
		$('.ftco-animate').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('ftco-animated') ) {
				
				i++;

				$(this.element).addClass('item-animate');
				setTimeout(function(){

					$('body .ftco-animate.item-animate').each(function(k){
						var el = $(this);
						setTimeout( function () {
							var effect = el.data('animate-effect');
							if ( effect === 'fadeIn') {
								el.addClass('fadeIn ftco-animated');
							} else if ( effect === 'fadeInLeft') {
								el.addClass('fadeInLeft ftco-animated');
							} else if ( effect === 'fadeInRight') {
								el.addClass('fadeInRight ftco-animated');
							} else {
								el.addClass('fadeInUp ftco-animated');
							}
							el.removeClass('item-animate');
						},  k * 50, 'easeInOutExpo' );
					});
					
				}, 100);
				
			}

		} , { offset: '95%' } );
	};
	contentWayPoint();


	
	// magnific popup
	$('.image-popup').magnificPopup({
    type: 'image',
    closeOnContentClick: true,
    closeBtnInside: false,
    fixedContentPos: true,
    mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
     gallery: {
      enabled: true,
      navigateByImgClick: true,
      preload: [0,1] // Will preload 0 - before current, and 1 after the current image
    },
    image: {
      verticalFit: true
    },
    zoom: {
      enabled: true,
      duration: 300 // don't foget to change the duration also in CSS
    }
  });

  $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
    disableOn: 700,
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,

    fixedContentPos: false
  });

  $('[data-toggle="popover"]').popover()
	$('[data-toggle="tooltip"]').tooltip()

})(jQuery);
$(document).ready(function() {
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
					$('#' + result_ward).html('<option value="0" style="cursor: no-drop">Vui lòng chọn quận huyện trước</option>')
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
