/*События dataLayer*/
$(document).ready(function() {
	//Клик по телефонам
	$(document).on('click', 'a.roistat-phone', function() {
		
		current_phone = $(this).attr('href').replace(/[^0-9\+]+/, '');
		
		dataLayer.push({
			'event':'krepkomp',
			'eventCategory':'Контакты', 
			'eventAction': current_phone, // Номер телефона, указанный в гиперссылке
			'eventLabel':'нажатие' 
		});
	});	
});
/*События dataLayer*/





/*События dataLayer*/
//отправка формы
function dataLayerSendForm() {
		url = window.location.href;
		url = url.split('?')[0];
		
	dataLayer.push({
		'event':'krepkomp',
		'eventCategory':'Заявка', 
		'eventAction':'форма', 
		'eventLabel': url // URL-адрес страницы, на которой была отправлена форма
	});
}
/*События dataLayer*/