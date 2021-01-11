$(document).ready(function() {
	
	if ((img_count - 3) > 0) initialSlide = 1;
	else initialSlide = 0
	
 $('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: '.slider-for',
  dots: false,
  centerMode: true,
  focusOnSelect: true,
  infinite: true,
  initialSlide: initialSlide,
  centerPadding: '0px',
});
});	  