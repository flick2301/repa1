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
	
	//Авторизация
	$(document).on('click', '#form_lk .user-account__submit[name=Auth]', function() {
		if($('#user-account__login').val() && $('#user-account__pass').val()) dataLayerSendFormAuth(true);
		else dataLayerSendFormAuth(false);
	});	

	$(document).on('click', '#form_auth .login-btn', function() {
		if($('#form_auth input[name=USER_LOGIN]').val() && $('#form_auth input[name=USER_PASSWORD]').val()) dataLayerSendFormAuth(true);
		else dataLayerSendFormAuth(false);
	});	
	
	//Регистрация
	$(document).on('click', '#form_lk .user-account__submit[name=Register]', function() {
		if($('#user-account__login').val() && $('#user-account__pass').val() && $('#user-account__passconfirm').val() && $('#user-account__email').val() && $('#form_auth input[name=captcha_word]').val()) dataLayerSendFormRegister(true);
		else dataLayerSendFormRegister(false);
	});		


	
});








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

//отправка формы авторизации
function dataLayerSendFormAuth(result) {
	if (result) {
dataLayer.push({
	'event':'krepkomp',
	'eventCategory':'Авторизация', 
	'eventAction':'форма', 
	'eventLabel':'успешно' // Статус отправки заполненной формы пользователем
});		
	}
	else {
dataLayer.push({
	'event':'krepkomp',
	'eventCategory':'Авторизация', 
	'eventAction':'форма', 
    'eventLabel':'неуспешно' // Статус отправки заполненной формы пользователем
});		
	}
}

//отправка формы регистрации
function dataLayerSendFormRegister(result) {
	if (result) {
dataLayer.push({
	'event':'krepkomp',
	'eventCategory':'Регистрация', 
	'eventAction':'форма', 
    'eventLabel':'успешно' // Статус отправки заполненной формы пользователем
});	
	}
	else {
dataLayer.push({
	'event':'krepkomp',
	'eventCategory':'Регистрация', 
	'eventAction':'форма', 
    'eventLabel':'неуспешно' // Статус отправки заполненной формы пользователем
});	
	}
}


function dataLayerProduct(name) {
	dataLayer.push({
		'event':'krepkomp',
		'eventCategory':'Карточка товара', 
		'eventAction': name, // Наименование товара, указанное в блоке с превью товара или в таблице со списком товаров
		'eventLabel':'нажатие' 
	});
}

function dataLayerAddBasket(name, price, quantity) {
dataLayer.push({
	'event':'krepkomp',
		'eventCategory':'Корзина', 
		'eventAction':'Добавить в корзину',  
    'eventLabel': name,  // Наименование товара, указанное в блоке, из которого пользователь добавляет его в корзину
    'eventValue': price, // Цена товара, указанная в блоке, из которого пользователь добавляет его в корзину. Пример: 562.35
    'quantity': quantity  // Количество товаров, которые пользователь добавил в корзину
});
}

function dataLayerToBasket() {
dataLayer.push({
	'event':'krepkomp',
	'eventCategory':'Корзина', 
	'eventAction':'нажатие',  
    'eventLabel': window.location.href  // URL-адрес страницы, с которой пользователь переходи в корзину
});
}

function dataLayerToOrder(sum) {
	
	sum = sum.replace(/[^0-9\.]+/, '');
	
dataLayer.push({
	'event':'krepkomp',
	'eventCategory':'Оформление заказа', 
	'eventAction':'оформить заказ',  
    'eventLabel':'нажатие',
    'eventValue': sum // Общая стоимость заказа, указанная на странице, с которой пользователь переходит на страницу оформления заказа
});
}

function dataLayerSendOrder(sum) {
dataLayer.push({
	'event':'krepkomp',
	'eventCategory':'Оформление заказа', 
	'eventAction':'оформить заказ',  
    'eventLabel':'нажатие',
    'eventValue': sum // Общая стоимость оформленного заказа
});
}