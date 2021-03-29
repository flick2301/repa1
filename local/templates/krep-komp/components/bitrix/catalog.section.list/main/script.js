BX.ready(function () {   
        
  $(document).on('click', '#sales-slider__list .slick-prev, #sales-slider__list .slick-next', function() {	
     $('#sales-slider__list div img').each(function() {
        $(this).attr('src', $(this).attr('data-src'));
		$(this).removeAttr('data-src');
    });	 
 });

});