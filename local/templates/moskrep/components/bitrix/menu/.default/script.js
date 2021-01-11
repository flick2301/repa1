/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

BX.ready(function () {
//btn catalog

$('.nav-catalog__btn').click(function() {
    
    $(this).addClass('active');
    $('.nav-catalog__items').addClass('active');
    return false;
});
$('.nav-catalog__items').mouseover(function() {
    $('.nav-catalog__btn').addClass('active');
    $('.nav-catalog__items').addClass('active');
    return false;
});
$('.nav-catalog').mouseout(function() {
    $('.nav-catalog__btn').removeClass('active');
    $('.nav-catalog__items').removeClass('active');
    return false;
});
$('.nav-catalog--main').mouseout(function() {
    $('.nav-catalog__btn').addClass('active');
    $('.nav-catalog__items').addClass('active');
	return false;
});
});