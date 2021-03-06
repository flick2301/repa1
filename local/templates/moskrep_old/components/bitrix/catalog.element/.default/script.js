BX.ready(function () {
	
	
	
	gtag('event','view_item', {
		'send_to': 'AW-958495754',
		'value': BX('main_link').dataset.price,
		'items': [
		{
			'id': BX('main_link').dataset.product, 
			'google_business_vertical': 'retail'
		}]
	});

    
    var buyBtnDetail = document.body.querySelectorAll('.card__btn');

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
       if(e.target.dataset.quantity){
           quantity=1;
       }
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
                   
                   yaCounter29426710.reachGoal('AddToShoppingCart');
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
                    BX.onCustomEvent('OnBasketChange');
                    $('.header-basket').popUp();
                    
                } else {
                   console.log(data);
                   $('.header-basket-none').popUp();
                }
            }
        }); 
    }
    
    
    
    
    
$('.card-tabs__item').click(function(){
        
        var tab_id = $(this).attr('data-tab');

        $('.card-tabs__item').removeClass('active');
        $('.card__tabs-list').removeClass('active');

        $(this).addClass('active');
        $("#"+tab_id).addClass('active');
    });
    
    $('.card__link-dashed_over').click(function(event){
        var tab_id = $(this).attr('data-tab');
        
        $('.card-tabs__item').removeClass('active');
        $('.card__tabs-list').removeClass('active');

        
        $('[data-tab='+tab_id+']').addClass('active');
        $("#"+tab_id).addClass('active');
        
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1000);
        
    });
    $('.card__link-dashed_packs').click(function(event){
        

        
        
        
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1000);
        
    });
    
    
    
    
    $(".card__link-dashed").on("click", function (event) {
        
        var tab_id = $(this).attr('data-tab');
        
        $('.card-tabs__item').removeClass('active');
        $('.card__tabs-list').removeClass('active');

        
        $('[data-tab='+tab_id+']').addClass('active');
        $("#"+tab_id).addClass('active');
       
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 500);
    });
    
    //map tabs
	$('.adress__link').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('.adress__link').removeClass('active');
		$('.map-location').removeClass('active');

		$(this).addClass('active');
		$("#"+tab_id).addClass('active');
	});
    



//carousel
	
        
      
        
        



});


