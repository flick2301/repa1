BX.ready(function () {
    
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
                   
                    BX.onCustomEvent('OnBasketChange');
                    
                } else {
                   console.log(data);
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
    
    
    
    
    $(".card__link-dashed").on("click", function (event) {
       
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
    




     
    
    
        
  $('.card__btn').click(function() {
           // $('#added-basket').css({"display":"block"});
            $('.header-basket').popUp();
            return false;
        });   



});


