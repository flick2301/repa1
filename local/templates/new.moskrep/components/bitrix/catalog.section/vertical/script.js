/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


BX.ready(function () {
    var buyBtnDetail = document.body.querySelectorAll('.product-card__button');
	var IDs=[];
    for (var i = 0; i < buyBtnDetail.length; i++) {
        BX.bind(buyBtnDetail[i], 'click', BX.delegate(function (e) {
            add2basketDetail(e)
        }, this));
		
		
	IDs.push({'id': buyBtnDetail[i].dataset.product, 'google_business_vertical': 'retail'});
		
    
    }

	$('.unavailable_pickup').click(function () {
        $('#unavailable-window').slideDown(0);
    });
	$('.unavailable-win').on('click', function(e){
		if(e.target.id=='close') {
			$('#unavailable-window').slideUp(0);
		}
	});
	
	gtag('event','view_item_list', {
		'send_to': 'AW-958495754',
				'items': IDs
					});
    
    function add2basketDetail(e) {
        var id = e.target.dataset.product,
                quantity = 1;
				
        if (!!BX('QUANTITY_' + id)) {
            quantity = BX('QUANTITY_' + id).value;
        }
		
       console.log(e);
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
                   console.log(e.target.dataset.price);
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
                   console.log(data);
				   $('.header-basket-none').text(data.MESSAGE);
                   $('.header-basket-none').popUp();
                }
            }
        });
		}else{
		$('.send-a-request__header').text('Позицию ' + e.target.dataset.name + ' уточните у менеджера')
		$('.header-basket-none input[name="product_name"]').val(e.target.dataset.name);
		$('.header-basket-none').popUp();}		
    }





  $('.pickup-view').click(function(e) {

		$('.pickup-block').removeClass('show');
		$('.delivery-block').removeClass('show');
		$(this).children('.pickup-block').addClass('show');
		
		var id = e.target.dataset.product;
		console.log(e.target.dataset.product);
								
		BX.ajax({ 
			type: 'POST', // метод отправки
			url: '/ajax/getdelivery.php', // путь к обработчику
			data: {
				'ID': e.target.dataset.product,
				'PICKUP': 'SHOW',
			},
			method: 'POST',
			dataType: 'text',
			timeout: 30,
			async: true,
			processData: true,
			scriptsRunFirst: true,
			emulateOnload: true,
			start: true,
			cache: false,
			onsuccess: function(data){
				//console.log(data['KPP']); // при успешном получении ответа от сервера, заносим полученные данные в элемент с классом answer
				$("#pickup_"+id).html(data);
				

			},
			onfailure: function(data){
				console.log(data); // выводим ошибку в консоль
			}
		});
								
								
							
	});

	$('.delivery-view').click(function(e) {
		$('.pickup-block').removeClass('show');
		$('.delivery-block').removeClass('show');
		$(this).children('.delivery-block').addClass('show');
		
		var id = e.target.dataset.product;
		console.log(e.target.dataset.product);
								
		BX.ajax({ 
			type: 'POST', // метод отправки
			url: '/ajax/getdelivery.php', // путь к обработчику
			data: {
				'ID': e.target.dataset.product,
				'DELIVERY': 'SHOW',
			},
			method: 'POST',
			dataType: 'text',
			timeout: 30,
			async: true,
			processData: true,
			scriptsRunFirst: true,
			emulateOnload: true,
			start: true,
			cache: false,
			onsuccess: function(data){
				//console.log(data['KPP']); // при успешном получении ответа от сервера, заносим полученные данные в элемент с классом answer
				$("#delivery_"+id).html(data);
				

			},
			onfailure: function(data){
				console.log(data); // выводим ошибку в консоль
			}
		});
	});

        $('body').on("click",function(event){
            if(event.target.className!= 'pickup-view' && event.target.className!= 'delivery-view') {
                $('.pickup-block').removeClass('show');
                $('.delivery-block').removeClass('show');
            }
        });


    
    

$(".amount__select :contains("+$('.amount__info').text()+")").attr("selected", "selected");

$(document).on('change', '#page_element_count', function(event) {
	location.href = location.pathname + '?SIZEN_1=' + $('#page_element_count option:selected').val();
});
	$(document).on('change', '#select_template', function(event) {
		location.href = location.pathname + '?TEMPLATE=' + $('#select_template option:selected').val();
	});
    

$(".amount__select :contains("+$('.amount__info').text()+")").attr("selected", "selected");

$(document).on('click', '#view_wholesale', function() {
	if($('div').is('#desc')) {	
		$('.product-tabs__toggle').attr('aria-selected', false); 
		$('#tabby-toggle_description_wholesale').attr('aria-selected', true); 
		$('.product-page__section').attr('hidden', 'hidden'); 
		$('#description_wholesale').attr('hidden', false); 
		element = document.getElementById('desc');
		element.scrollIntoView(true);
	}
	else window.open('/vashi_skidki/', '_blank');
	});
	$.get( location.href, function( data ) {
  
});

	
	$(document).on('click', '#view_available', function() {
		
		var queryString = location.href ? location.href.split('?')[1] : window.location.search.slice(1);
		if(queryString){
			var arr = queryString.split('&');
			var position = $.inArray('available=Y', arr);
		}
		var params = {};
		
		if(position == -1 || position == null){
			params = { available:'Y' };
			var str = jQuery.param( params );
		
			_url = location.href;
			_url += (_url.split('?')[1] ? '&':'?') + str;
			window.location.href = _url;
		}else{
			
			arr.splice(position, 1);
			for (var i=0; i<arr.length; i++) {
				// разделяем параметр на ключ => значение
				var a = arr[i].split('=');
				// обработка данных вида: list[]=thing1&list[]=thing2
				var paramNum = undefined;
				var paramName = a[0].replace(/\[\d*\]/, function(v) {
					paramNum = v.slice(1,-1);
					return '';
				});
				// передача значения параметра ('true' если значение не задано)
				var paramValue = typeof(a[1])==='undefined' ? true : a[1];
				params[paramName]=paramValue;
			}



			console.log(params);
			var str = jQuery.param( params );
			if(str)
				str='?'+str;
			
			_url = window.location.href.split('?')[0] + str;
			window.location.href = decodeURI(_url);
		}
	});

	$('.card_pickup').click(function () {
		$('#shops-window').slideDown(0);
		var product_id = $(this).data('product');
		var request = BX.ajax.runComponentAction("d7:contact_shops", "ajaxRequest", {

			mode: "class",
			data:{
				iblock_id: '19',
				product_id: product_id,
			}

		});

		request.then(function(response)
		{
			let shops_monitor = document.querySelector('.win');

			$('body').append("<script type='text/javascript' src='/local/components/d7/contact_shops/templates/krep-komp.new/script.js' />");
			//Отклик шаблона компонента заливаем в селектор
			shops_monitor.innerHTML = response.data;
			//С помощью eval запускаем javascript в теле шаблона popup-окна вызванного через ajax
			let code2 = document.querySelector('#api-map').textContent;
			eval(code2);
			let code = document.querySelector('#push').textContent;
			eval(code);

		});



	});

	$('.card_delivery').click(function () {
		$('#shops-window').slideDown(0);
		var product_id = $(this).data('product');
		var request = BX.ajax.runComponentAction("d7:delivery", "ajaxRequest", {

			mode: "class",
			data:{
				iblock_id: '22',
				product_id: product_id,
			}

		});
		request.then(function(response)
		{
			let shops_monitor = document.querySelector('.win');

			$('body').append("<script type='text/javascript' src='/local/components/d7/delivery/templates/krep-komp/script.js' />");
			//Отклик шаблона компонента заливаем в селектор
			shops_monitor.innerHTML = response.data;
			//С помощью eval запускаем javascript в теле шаблона popup-окна вызванного через ajax
			let code = document.querySelector('#api-map-delivery').textContent;
			eval(code);

		});



	});

	$('.win').on('click', function(e){
		if(e.target.id=='close') {
			$('#shops-window').slideUp(0);
		}
	});
	
	


});
function ChangeInputCart(name, e){
	
	if(e.val() > e.data("quantity"))
	{
		
		
		$('.header-basket-sberbank').html("<p>Максимальное количество позиций "+name+" в наличии <b>"+e.data("quantity")+" уп.</b></p>");
		$('.header-basket-sberbank').popUp();
		e.val(e.data("quantity"));
		
	}
   
}