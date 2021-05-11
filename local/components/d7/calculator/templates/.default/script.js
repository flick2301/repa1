$(document).ready(function() {
	$(document).on('keyup', '#mass-widget__count', function(e) {
		$(this).val($(this).val().replace(/[^0-9]/, ""));
		var weight = $(this).val() * $('#mass-widget__weight').val();
		
		
		if (weight > 0.01) weight = weight.toFixed(3);
		else weight = weight.toFixed(5);
		
		$('#mass-widget__result').val(weight);
	});
	

	$(document).on('keyup', '#mass-widget__result', function(e) {
		$(this).val($(this).val().replace(/[^0-9\.]/, ""));
		var count = $(this).val() / $('#mass-widget__weight').val();
		
		
		count = count.toFixed();
		
		
		$('#mass-widget__count').val(count);
	});
	
	

	
	$(document).on('change', '#mass-widget__form select', function() {
		if ($(this).hasClass('mass-widget-loader-select-type')) $('#mass-widget__form select').each(function(index, el) {
			if(!$(el).hasClass('mass-widget-loader-select-type')) $(el).val('');
		});
		$('#mass-widget__form').submit();
	});
	
	
	
	$('#mass-widget-cleaner').click(function() {
		$('#mass-widget__form select').each(function(index, el) {
			$(el).val('');
			$('#mass-widget__form').submit();
		});
	});
	
	
$('#mass-widget__form').submit(function(e) { //Отправка формы заказа
      $.ajax({
         url: '/ajax/calculator.php',
         data: $(this).serialize(),
         type: 'post',
         /*dataType: "json",*/
		beforeSend: function() {
			//$("#load").css("display", "block");
		},	 
         success: function (data) {
			//$("#errors_log").html(data
			var formdata = $(data).find('#mass-widget__form');
			var item_result = $(data).find('#item_result');
			$('#mass-widget__form').html($(formdata).html());
			$('#item_result').html($(item_result).html());
			if ($('#item_result .special-products__list_calculator').html()) buyBtnDetail();
         },
         error: function (data) {
            //$(".orders_list tbody").html("<tr><td class=\"nodata\" colspan=\"11\">Ошибка на сервере! " + data + "</td></tr>");
         },
		 complete: function() {
			//$("#load").css("display", "none");
		},	 
      });

e.preventDefault();
});	
});



function buyBtnDetail() {
	var buyBtnDetail = document.body.querySelectorAll('.product-card__button');
	
    var buyBtnDetail = document.body.querySelectorAll('.product-card__button');
	var IDs=[];
    for (var i = 0; i < buyBtnDetail.length; i++) {
        BX.bind(buyBtnDetail[i], 'click', BX.delegate(function (e) {
            add2basketDetail(e)
        }, this));
		
		
	IDs.push({'id': buyBtnDetail[i].dataset.product, 'google_business_vertical': 'retail'});
		
    
    }
	
	gtag('event','view_item_list', {
		'send_to': 'AW-958495754',
				'items': IDs
					});
					

}



    function add2basketDetail(e) {
        var id = e.target.dataset.product,
                quantity = 1;
				
        if (!!BX('QUANTITY_' + id)) {
            quantity = BX('QUANTITY_' + id).value;
        }
		
       //console.log(e);
	   if(e.target.dataset.quantity >= quantity)
		{
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
                   //console.log(e.target.dataset.price);
                    BX.onCustomEvent('OnBasketChange');
					dataLayerAddBasket(e.target.dataset.name, e.target.dataset.price, quantity);
					/*ga ('send', 'event', 'Корзина', 'Добавить в корзину');
					gtag('event','add_to_cart', {
						'send_to': 'AW-958495754',
						'value': e.target.dataset.price,
						'items': [
						{
							'id':  e.target.dataset.product, 
							'google_business_vertical': 'retail'
						}]
					});*/
                    $('.header-basket').popUp();
                } else {
                   //console.log(data);
				   $('.header-basket-none').text(data.MESSAGE);
                   $('.header-basket-none').popUp();
                }
            }
        });
		}else{$('.header-basket-none').popUp();}		
    }


