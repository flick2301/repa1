$(document).ready(function() {
if (jQuery('#sale_order_props').css('display')=='none') jQuery('a.slide').click();	
$("input#ORDER_PROP_2").mask("+7 (999) 999-99-99");
$("input#ORDER_PROP_2").attr("placeholder", "+7 (___) ___-__-__");
$("input#ORDER_PROP_6").mask("+7 (999) 999-99-99");
$("input#ORDER_PROP_6").attr("placeholder", "+7 (___) ___-__-__");

BX.addCustomEvent('onAjaxSuccess', function(){
$("input#ORDER_PROP_2").mask("+7 (999) 999-99-99");
$("input#ORDER_PROP_2").attr("placeholder", "+7 (___) ___-__-__");
$("input#ORDER_PROP_6").mask("+7 (999) 999-99-99");
$("input#ORDER_PROP_6").attr("placeholder", "+7 (___) ___-__-__");
});
});

function getMask() {
$("input#ORDER_PROP_2").mask("+7 (999) 999-99-99");
$("input#ORDER_PROP_2").attr("placeholder", "+7 (___) ___-__-__");
$("input#ORDER_PROP_6").mask("+7 (999) 999-99-99");
$("input#ORDER_PROP_6").attr("placeholder", "+7 (___) ___-__-__");

BX.addCustomEvent('onAjaxSuccess', function(){
$("input#ORDER_PROP_2").mask("+7 (999) 999-99-99");
$("input#ORDER_PROP_2").attr("placeholder", "+7 (___) ___-__-__");
$("input#ORDER_PROP_6").mask("+7 (999) 999-99-99");
$("input#ORDER_PROP_6").attr("placeholder", "+7 (___) ___-__-__");
});
}