/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


BX.ready(function () {
    
	
	gtag('event','view_item_list', {
		'send_to': 'AW-958495754',
				'items': IDs
					});
    
    function add2basketDetailSoputka(e) {
        var id = e.target.dataset.product,
                quantity = 1;
				
        if (!!BX('QUANTITY_' + id)) {
            quantity = BX('QUANTITY_' + id).value;
        }
       alert(e.target.dataset.product);
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
                    //BX.addClass(e.target, 'active2');
                   console.log(e.target.dataset.price);
                    BX.onCustomEvent('OnBasketChange');
					ga ('send', 'event', 'Корзина', 'Добавить в корзину');
					gtag('event','add_to_cart', {
						'send_to': 'AW-958495754',
						'value': e.target.dataset.price,
						'items': [
						{
							'id':  e.target.dataset.product, 
							'google_business_vertical': 'retail'
						}]
					});
					$('.header-basket-none').text(data.MESSAGE);
                    //$('.header-basket').popUp();
                } else {
                   console.log(data);
				   $('.header-basket-none').text(data.MESSAGE);
                   $('.header-basket-none').popUp();
                }
            }
        }); 
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

});
function ChangeInputCart(name, e){
	
	if(e.val() > e.data("quantity"))
	{
		
		
		$('.header-basket-sberbank').html("<p>Максимальное количество позиций "+name+" в наличии <b>"+e.data("quantity")+" уп.</b></p>");
		$('.header-basket-sberbank').popUp();
		e.val(e.data("quantity"));
		
	}
   
}
