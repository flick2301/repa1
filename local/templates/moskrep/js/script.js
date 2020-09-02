$(document).ready(function() {
setTimeout(function(){
     $('#intro-slider__list img.intro-slider__image').each(function() {
        $(this).attr('src', $(this).attr('data-src'));
		$(this).removeAttr('data-src');
    });
}, 4000);
});
