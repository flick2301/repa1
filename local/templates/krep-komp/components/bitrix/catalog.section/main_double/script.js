/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
BX.ready(function () {
	
	//sliderResizer();
	
    var buyBtnDetail = document.body.querySelectorAll('.simple-cart-icon');

    for (var i = 0; i < buyBtnDetail.length; i++) {
        BX.bind(buyBtnDetail[i], 'click', BX.delegate(function (e) {
            add2basketDetail(e)
        }, this));
    
    }
    
    function add2basketDetail(e) {
        var id = e.target.dataset.product,
                quantity = 1;
        if (!!BX('QUANTITY_' + id)) {
            quantity = BX('QUANTITY_' + id).value;
        }
       console.log(e);
        BX.ajax({
            url: window.location.href,
            data: {
                action: 'ADD2BASKET',
                ajax_basket: 'Y',
                quantity: quantity,
                id: e.target.dataset.product
            },
            method: 'POST',
            dataType: 'json',
            onsuccess: function (data) {
                if (data.STATUS == 'OK') {
                    BX.addClass(e.target, 'active');
                   /*ga ('send', 'event', 'Корзина', 'Добавить в корзину');
				   gtag('event','add_to_cart', {
						'value': e.target.dataset.price,
						'items': [
						{
							'id':  e.target.dataset.product, 
							'google_business_vertical': 'retail'
						}]
					});*/
                    BX.onCustomEvent('OnBasketChange');
					dataLayerAddBasket(e.target.dataset.name, e.target.dataset.price, quantity);
                    $('.header-basket').popUp();
                } else {
                   console.log(data);
                   $('.header-basket-none').popUp();
                }
            }
        }); 
    }
	
	
 $(document).on('click', '.product-slider .slick-prev, .product-slider .slick-next', function() {	
     $('.product-slider div img').each(function() {
        $(this).attr('src', $(this).attr('data-src'));
		$(this).removeAttr('data-src');
    });	 
 }); 
 
 	$(window).resize(function() {
		//sliderResizer(true);
	});	

});

min = false;

function sliderResizer(relay) {
	
	if (mobile) return;
	
if ($(window).width() < 991) {
	if (relay) $('.basic-layout__module.product-slider, .main_hits_title').hide();
	if (!relay) min = true;
	$('.basic-layout__module.product-slider .product-slider__list').removeClass('product-slider__list').addClass('special-products__list').removeAttr('id');
	$('.basic-layout__module.product-slider .product-slider__item').removeClass('product-slider__item').addClass('special-products__item');
}	
else {
	if (min && relay) {
		min = false;
		window.location.reload();
	}	
	else $('.basic-layout__module.product-slider, .main_hits_title').show();
	$('.basic-layout__module.product-slider .special-products__list').removeClass('special-products__list').addClass('product-slider__list').attr('id', 'product-slider__list');
	$('.basic-layout__module.product-slider .special-products__item').removeClass('special-products__item').addClass('product-slider__item');	
}
}