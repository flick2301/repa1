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

$(window).on('scroll', function() {
    if ($(window).scrollTop() > 0) $('.basic-layout__header span').addClass('fixed');
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


$(document).on('click', '.bx-filter-section.container-fluid .checkbox__else--type01 span', function() {  
	if ($(this).hasClass('open')) {
		$(this).removeClass('open');
		$(this).parent().prev().hide();
		$(this).text('Еще');
	}	
	else {
		$(this).addClass('open')
		$(this).parent().prev().css('display', 'flex');
		$(this).text('Свернуть');
	}	
}); 



//$('.category-blocknew .category-blocknew__list').hide();
$('.category-blocknew .category-blocknew__title:first-child span').trigger('click');
});