$(document).ready(function() {
setTimeout(function(){
     $('#intro-slider__list img.intro-slider__image').each(function() {
        $(this).attr('src', $(this).attr('data-src'));
		$(this).removeAttr('data-src');
    });
}, 4000);

$("a[data-rel=gallery_card]").fancybox();
$("a[data-rel=gallery_img]").fancybox();
$("a[data-rel=catalog-photo]").fancybox();
});