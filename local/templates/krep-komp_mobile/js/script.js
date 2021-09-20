$(document).ready(function() {
setTimeout(function(){
     $('#intro-slider__list img.intro-slider__image').each(function() {
        $(this).attr('src', $(this).attr('data-src'));
		$(this).removeAttr('data-src');
    });
}, 4000);

$('a[data-rel=gallery_card]').fancybox({arrows: true, toolbar: false, loop: true});
$('a[data-rel=gallery_img]').fancybox({arrows: false, toolbar: false, loop: true});
$('a[data-rel=catalog-photo]').fancybox({arrows: false, toolbar: false, loop: true});

		$('.modal-can-register-link').click(function() {
			//$('#modal-can-register-mobile').slideDown(0);
			$('#modal-can-register-mobile').css('display', 'flex');
			return false;
		});		
		
		$('.can-register-mobile_close').click(function() {
			$('#modal-can-register-mobile').slideUp(0);
			return false;
		});	

$(window).on('scroll', function() {
    if ($(window).scrollTop() > 0) $('.basic-layout__header').addClass('fixed');
          else $('.basic-layout__header').removeClass('fixed');
   });
   
   usedtrigger = false;
   
$(document).on('click', '.category-blocknew .category-blocknew__title span', function() {  
if (!$(this).parent().hasClass('open')) {
	if ($(this).hasClass('open')) {
		$(this).removeClass('open');
		$(this).parent().next().hide();
	}	
	else {
		$(this).addClass('open')
		$(this).parent().next().css('display', 'flex');
	}	
}	
/*
if ($(this).parent().hasClass('opening') && usedtrigger==true) {
	if ($(this).hasClass('open')) {
		$(this).removeClass('open');
		$(this).parent().next().addClass('opening');
	}
	else {
	$(this).addClass('open');
	$(this).parent().next().removeClass('opening');
	}
}
*/	
usedtrigger = true;
}); 

$(document).on('click', '.category-blocknew .category-blocknew__list.open span', function() {  
	if ($(this).parent().hasClass('opening')) {
		$(this).parent().removeClass('opening');
		$(this).text('Свернуть');
	}
	else {
		$(this).parent().addClass('opening');
		$(this).text('Еще');
	}
});


$(document).on('click', '.bx-filter-section.container-fluid .checkbox__else--type01:not(.colors) span', function() {  
	if ($(this).hasClass('open')) {
		$(this).removeClass('open');
		$(this).parent().prev().hide();
		$(this).text('Еще');
	}	
	else {
		$(this).addClass('open');
		$(this).parent().prev().css('display', 'flex');
		$(this).text('Свернуть');
	}	
}); 

$(document).on('click', '.bx-filter-section.container-fluid .checkbox__else--type01.colors span', function() {
	if ($(this).hasClass('open')) {
		$(this).removeClass('open');
		$('.bx-filter-section.container-fluid .checkbox__item--color').removeClass('full');
		$(this).text('Еще');
	}	
	else {
		$(this).addClass('open');
		$('.bx-filter-section.container-fluid .checkbox__item--color').addClass('full');
		$(this).text('Свернуть');
	}	
}); 
	

$(document).on('click', '.main-filter .s18-title.opening:not(.colors)', function() {  
	if ($(this).hasClass('open')) {
		$(this).removeClass('open');
		$(this).parent().next().children().children().children().hide();	
	}	
	else {
		$(this).addClass('open');
		$(this).parent().next().children().children().children().css('display', 'flex');
	}	
});


$(document).on('click', '.main-filter .s18-title.opening.colors', function() {  
	if ($(this).hasClass('open')) {
		$(this).removeClass('open');
		$('.bx-filter-section.container-fluid .checkbox__item--color').removeClass('full');
	}	
	else {
		$(this).addClass('open');
		$('.bx-filter-section.container-fluid .checkbox__item--color').addClass('full');
	}	
});



	$(window).resize(function() {
        elseTest();
    });



//$('.category-blocknew .category-blocknew__list').hide();
$('.category-blocknew .category-blocknew__title:first-child span').trigger('click');


elseTest();
});

var else_view = false;
var else_test = false; 

function elseTest() {
	$('.category-blocknew .category-blocknew__list.open.opening .category-blocknew__item').each(function(i,elem) {
	else_test = true;
	if ($(elem).position().top > 0) else_view = true;
});

if (!else_view) $('.category-blocknew .category-blocknew__list.open span').hide();
else if (else_test) $('.category-blocknew .category-blocknew__list.open span').show();
}





BX.ready(function(){
	$("#soa-property-14").mask("+7 (999) 999-99-99");
	$("#soa-property-3").mask("+7 (999) 999-99-99");
	$(".phonemask").mask("+7 (999) 999-99-99");
	click_phone = true;
	
$(document).on('keyup', '#soa-property-10', function(e) {
	$(this).val($(this).val().replace(/[^0-9]+/, ""));
});	

$(document).on('click', 'input[name=PERSON_TYPE]', function(e) {
	click_phone = false;
});

$(document).on('click', '#soa-property-14, #soa-property-3', function(e) {
	
	if (click_phone==false) {
		$("#soa-property-14").mask("+7 (999) 999-99-99");
		$("#soa-property-3").mask("+7 (999) 999-99-99");
		click_phone = true;
	}
});	
});