/* JavaScript */




function add2basketLine() {
	
}






$('.card__btn').click(function() {
    $('#added-basket').popUp();
    return false;
});









$(document).ready(function(){
    //carousel
    $(".box-modal__carousel").slick({
        dots: true,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1
    });
    //carousel
    $(".carousel-product__items").slick({
        dots: true,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1
    });
	//carousel
	$(".carousel-certeficate__items").slick({
		dots: true,
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 1
	});
	$(".popular-categories__items").slick({
		dots: true,
		infinite: true,
		slidesToShow: 5,
		slidesToScroll: 1
	});


        
       
    //product tabs
    $('.products-tabs__item').click(function(){
        var tab_id = $(this).attr('data-tab');

        $('.products-tabs__item').removeClass('active');
        $('.product-tabs-list').removeClass('active');

        $(this).addClass('active');
        $("#"+tab_id).addClass('active');
    });


    


	


	


 
});


//select
$('.amount__wrap select').change(function(){
    $(this).siblings('span').addClass('add').text($(this).children('option:selected').text());
});


//radio
$('.form__label').click(function(){
    $('.form__label').removeClass('active');
    $(this).addClass('active');
});






//NAV
BX.ready(function(){
                           
var nCurPosX; // текущее положение курсора




$('html').mousemove(function(e){
    
    if(!e) e = window.event;
    nCurPosX = e.clientX;

});

$('.header-feedback__btn, .aside-contacts__btn').click(function() {
    $('#feedback').popUp();
    return false;
});




$('.nav-catalog__item, .catalog-level-two__item').hover(function(){

    var $curItem = $(this),
        $submenu = $curItem.find('.catalog-level-two__wrap, .catalog-level-three__wrap').eq(0);
        
    $curItem.addClass('hover');
    
    /*
        делаем задержку чтобы при случайном наведении на пункт под меню не показывалось
    */
    setTimeout(function() {
        /* если по истечению задержки мы все еще на том же пункт меню,
            значит показываем подменю
        */
        
        if($curItem.hasClass('hover'))
        {
            $submenu.css('display', 'block');
        }
                        }, 0);

},
function(){
    

    var nPosXStart = nCurPosX,
        $submenu = $(this).find('.catalog-level-two__wrap, .catalog-level-three__wrap').eq(0),
        $curItem = $(this);
    
    $curItem.removeClass('hover');
    /*
        делаем небольшую задержку чтобы определить направление движение курсора
    */
    setTimeout(function() {
                
        var nPosXEnd = nCurPosX;
        
        // если в сторону подменю, значит делаем большую задержку для возможности движения по диагонали
        if(nPosXEnd - nPosXStart > 0)
                    
            setTimeout(function() {
                
                /*
                    если по истечению задержки курсор находится на подменю или текущем пункте меню
                    тогда не прячем подменю
                */
                if(!$submenu.hasClass('hover') && !$curItem.hasClass('hover')){
                    $submenu
                        .css('display', 'none')
                        .removeClass('hover');
                }
            }, 300);
        
        // если нет и мы ушли с текущего пункта меню, моментально скрываем подменю
        else if(!$submenu.hasClass('hover') && !$curItem.hasClass('hover')){
            $submenu
                .css('display', 'none')
                .removeClass('hover');
                
            
        }       
                
    }, 10);
    
    
    
});

if(location.origin=='https://spb.krep-komp.ru'){
    $('.delivery_item').removeClass('active');
    $('.delivery__tabs-list').removeClass('active');
    $('.vivoz_item').removeClass('active');
    $('.vivoz__tabs-list').removeClass('active');
    $('.map-location').removeClass('active');
    $('.spb').addClass('active');
    
    
}

$('.delivery_item').click(function(){
        
        var tab_id = $(this).attr('data-tab');

        $('.delivery_item').removeClass('active');
        $('.delivery__tabs-list').removeClass('active');

        $(this).addClass('active');
        $("#"+tab_id).addClass('active');
    });
    
    $('.vivoz_item').click(function(){
        
        var tab_id = $(this).attr('data-tab');

        $('.vivoz_item').removeClass('active');
        $('.vivoz__tabs-list').removeClass('active');

        $(this).addClass('active');
        $("#"+tab_id).addClass('active');
    });
    
    $('.variants_item').click(function(){
        
        var tab_id = $(this).attr('data-tab');

        $('.variants_item').removeClass('active');
        $('.variants__tabs-list').removeClass('active');

        $(this).addClass('active');
        $("#"+tab_id).addClass('active');
    });
    
    

$('.catalog-level-two__wrap, .catalog-level-three__wrap').hover(function(){
                             
    $(this).addClass('hover');
                             },
function(){
    $(this).removeClass('hover');
});


   //fancybox
    if($('*').is('a[rel=gallery_img], a[rel=gallery_card], a[rel=catalog-photo]')) {
        $("a[rel=gallery_img]").fancybox({
            'transitionIn'      : 'none',
            'transitionOut'     : 'none',
            'titlePosition'     : 'none'
        });
        $("a[rel=gallery_card]").fancybox({
            'transitionIn'      : 'none',
            'transitionOut'     : 'none',
            'titlePosition'     : 'none'
        });
        $("a[rel=catalog-photo]").fancybox({
            'transitionIn'      : 'none',
            'transitionOut'     : 'none',
            'titlePosition'     : 'none'
        });
    };
    
    
    //checkbox
$('.checkbox__label').click(function(){
     $(this).toggleClass('checked');
});

//colorbox show all
$(".checkbox-color__all").click(function() {
    $(this).addClass('disable');
    $('.checkbox__item--color .checkbox__item').addClass('visible');
    return false;
});


// search
$('.header-search__input').focus(function() {
	$('.header-search').toggleClass('active');
});
$('.header-search__fade').click(function() {
	$('.header-search').removeClass('active');
        $('.title-search-result').css({'display':'none'});
});


//login popup
$('.login__btn').click(function() {
    $('#login').popUp();
    return false;
});

//paragraph show
$('.catalog-head__more').click(function() {
    $(this).addClass('disable');
    $('.catalog-head__paragraph').addClass('show');
	$('.catalog-view__head').addClass('show');
    return false;
});

});

//Выделение email
jQuery(document).mousedown(function() {
	var oncl=1;
	jQuery('.header-contacts__mail').mousemove(function() {
		if (oncl) {
		oncl=0;
		ga('send', 'event', 'Е-мейл', 'Выделение е-мейла');
		yaCounter29426710.reachGoal('EmailHighlight');
		}
	});	
	jQuery('.footer_email').mousemove(function() {
		if (oncl) {
		oncl=0;
		ga('send', 'event', 'Е-мейл', 'Выделение е-мейла');
		yaCounter29426710.reachGoal('EmailHighlight');		
		}
	});		
	jQuery(document).mouseup(function() {
		oncl=0;
	});
});
//Выделение email

//Клик по email
BX.ready(function(){
   BX.bindDelegate(
      document.body, 'click', {className: 'header-contacts__mail' },
      function(e){
         if(!e) {
            e = window.event;
         }
         
         ga('send', 'event', 'Е-мейл', 'Клик по е-мейл'); yaCounter29426710.reachGoal('EmailClick'); return true;
         return BX.PreventDefault(e);
      }
   );
   BX.bindDelegate(
      document.body, 'click', {className: 'footer_email' },
      function(e){
         if(!e) {
            e = window.event;
         }
         
         ga('send', 'event', 'Е-мейл', 'Клик по е-мейл'); yaCounter29426710.reachGoal('EmailClick'); return true;
         return BX.PreventDefault(e);
      }
   );
});
//Конец клик по email





