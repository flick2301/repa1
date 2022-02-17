/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


BX.ready(function () {
	
    var buyBtnDetail = document.body.querySelectorAll('.catalog-table__cart');
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
    
    function add2basketDetail(e) {
        var id = e.target.dataset.product,
                quantity = 1;
        if (!!BX('QUANTITY_' + id)) {
            quantity = BX('QUANTITY_' + id).value;
        }
		if(e.target.dataset.quantity >= quantity)
		{
			//console.log(e);
			
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
                   
				   $('.header-basket-none').text(data.MESSAGE);
                   $('.header-basket-none').popUp();
                }
            }
        }); 
		}else{$('.header-basket-none').popUp();}
    }





  $('.pickup-view').click(function(e) {

		$('.pickup-block').removeClass('show');
		$('.delivery-block').removeClass('show');
		$(this).children('.pickup-block').addClass('show');
		
		var id = e.target.dataset.product;
		//console.log(e.target.dataset.product);
								
		BX.ajax({ 
			type: 'POST', // метод отправки
			url: '/ajax/getdelivery.php', // путь к обработчику
			data: {
				'ID': e.target.dataset.product,
				'PICKUP': 'SHOW',
				'HOST': window.location.host,
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
				'HOST': window.location.host,
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


$(document).on('change', '#page_element_count', function(event) {
	location.href = location.pathname + '?SIZEN_1=' + $('#page_element_count option:selected').val();
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

});
function ChangeInputCart(name, e){
	
	if(e.val() > e.data("quantity"))
	{
		
		
		$('.header-basket-sberbank').html("<p>Максимальное количество позиций "+name+" в наличии <b>"+e.data("quantity")+" уп.</b></p>");
		$('.header-basket-sberbank').popUp();
		e.val(e.data("quantity"));
		
	}
   
}
