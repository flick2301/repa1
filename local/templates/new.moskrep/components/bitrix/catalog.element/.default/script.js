BX.ready(function () {
    
    var buyBtnDetail = document.body.querySelectorAll('.product-purchase__button');

    for (var i = 0; i < buyBtnDetail.length; i++) {
        BX.bind(buyBtnDetail[i], 'click', BX.delegate(function (e) {
            add2basketDetail(e)
        }, this));
    
    }

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
    
        
    function add2basketDetail(e) {
        var id = e.target.dataset.product,
                quantity = 1;
        
        if (!!BX('QUANTITY_' + id)) {
            quantity = BX('QUANTITY_' + id).value;
        }
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
                    BX.onCustomEvent('OnBasketChange');
					dataLayerAddBasket(e.target.dataset.name, e.target.dataset.price, quantity);
                    $('.header-basket').popUp();
					
					yaCounter29426710.reachGoal('AddToShoppingCart');
                    
                } else {
                   console.log(data);
                   $('.header-basket-none').popUp();
                }
				
            }
        });
		}else{$('.header-basket-none').popUp();}		
    }
    
    
    
         



});



