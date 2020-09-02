$(document).ready(function() {
	//Клик по телефонам
	$(document).on('click', 'a.roistat-phone, article .contact-block__link--phone', function() {
		
		current_phone = $(this).attr('href').replace(/[^0-9\+]+/, ''); 
		
		dataLayer.push({
			'event':'krepkomp',
			'eventCategory':'Контакты', 
			'eventAction': current_phone, // Номер телефона, указанный в гиперссылке
			'eventLabel':'нажатие' 
		});
	});	
	


	$(document).on('click', '#form_auth .login-btn', function() {
		if($('#form_auth input[name=USER_LOGIN]').val() && $('#form_auth input[name=USER_PASSWORD]').val()) {
			var uid = checkUser($('#form_auth input[name=USER_LOGIN]').val(), $('#form_auth input[name=USER_PASSWORD]').val());
			if (uid)  dataLayerSendFormAuth(uid);
		}	
		else dataLayerSendFormAuth(false);
	});	
	
	//Регистрация
	$(document).on('click', '#form_lk .user-account__submit[name=Register]', function(e) {
		if($('#user-account__login').val() && $('#user-account__pass').val() && $('#user-account__passconfirm').val() && $('#user-account__email').val() && !checkEmail($('#user-account__email').val()) && validateEmail($('#user-account__email').val()) && $('#captcha_word_registration').val()) dataLayerSendFormRegister(true);
		else dataLayerSendFormRegister(false);
		//e.preventDefault();
	});	

usertype = "";	

//Заполнение формы заказа
$(document).on('focusout', '#bx-soa-order input[type=text], #bx-soa-order textarea', function() {
	var label = $('#bx-soa-order label[for=' + $(this).attr('id') + ']').text();
	if (label && $(this).val()) dataLayerTypeOrder(label, $(this).val());
});
$(document).on('focusout', '#address_street', function() {	
	if ($(this).val()) dataLayerTypeOrder('Улица', $(this).val());
});
$(document).on('focusout', '#address_house', function() {		
	if ($(this).val()) dataLayerTypeOrder('Дом', $(this).val());
});
$(document).on('focusout', '#address_flat', function() {		
	if ($(this).val()) dataLayerTypeOrder('Квартира', $(this).val());
});
$(document).on('click', '.dropdown-item.bx-ui-sls-variant', function() {		
	if ($(this).text()) dataLayerTypeOrder('Город', $(this).text());
});
$(document).on('click', '#bx-soa-order .usertype label', function() {	
	if (usertype != $(this).children('span').text()) {
		dataLayerTypeOrder('Покупатель', $(this).children('span').text());	
	}
	usertype = $(this).children('span').text();
});
$(document).on('click', '#bx-soa-paysystem label', function() {		
	dataLayerTypeOrder('Платежная система', $(this).children('span').text()); 
});
$(document).on('click', '#select_delivery_group > li', function() {		
	if (usertype != $(this).text()) {
		dataLayerTypeOrder('Группы доставки', $(this).text()); 
	}
	usertype = $(this).text();	
});
$(document).on('click', '#bx-soa-delivery label', function(e) {		
	var target = e.target;
	if ($(target).hasClass('radio__text')) {
		dataLayerTypeOrder('Тип доставки', $(this).children('span').text()); 
	}
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
			'UID': result // Уникальный идентификатор пользователя взятый из CRM Bitrix24
		});		

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

//Показ карточки товара
function dataLayerProduct(name) {
	dataLayer.push({
		'event':'krepkomp',
		'eventCategory':'Карточка товара', 
		'eventAction': name, // Наименование товара, указанное в блоке с превью товара или в таблице со списком товаров
		'eventLabel':'нажатие' 
	});
}

//Добавление в корзину
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

//Переход в корзину
function dataLayerToBasket() {
dataLayer.push({
	'event':'krepkomp',
	'eventCategory':'Корзина', 
	'eventAction':'нажатие',  
    'eventLabel': window.location.href  // URL-адрес страницы, с которой пользователь переходи в корзину
});
}

//Заполнение полей заказа
function dataLayerTypeOrder(name, val) {
	
	name = name.replace(':', '');
	name = name.replace(/^\* /, '');

dataLayer.push({
	'event':'krepkomp',
	'eventCategory':'Оформление заказа', 
	'eventAction':'форма',  
    'eventLabel': name // Обозначение поля, которое заполняет пользователь. Например: ФИО/email и тд
});
}

//Переход заказ
function dataLayerToOrder(sum) {
	
	sum = sum.replace(/[^+\d\.]/g, '');
	
dataLayer.push({
	'event':'krepkomp',
	'eventCategory':'Корзина', 
	'eventAction':'оформить заказ',  
    'eventLabel':'нажатие',
    'eventValue': sum // Общая стоимость заказа, указанная на странице, с которой пользователь переходит на страницу оформления заказа
});
}

//Отправка заказ
function dataLayerSendOrder(sum) {
	
	sum = sum.replace(/[^+\d\.]/g, '');
	
dataLayer.push({
	'event':'krepkomp',
	'eventCategory':'Оформление заказа', 
	'eventAction':'оформить заказ',  
    'eventLabel':'нажатие',
    'eventValue': sum // Общая стоимость оформленного заказа
});
}

//Проверка пользователя
function checkUser(login, pass) {
	
	result = false;
	
		BX.ajax({
			async: false,
			url: '/ajax/checkuser.php',
			method: 'POST',
			dataType: 'html',
			data: {login, pass},
			onsuccess: function(data){
				if (data) result = data;
           },
		});

		if (result) return result;
}

//Проверка email
function checkEmail(email) {
	
	result = false;
	
		BX.ajax({
			async: false,
			url: '/ajax/checkemail.php',
			method: 'POST',
			dataType: 'html',
			data: {email},
			onsuccess: function(data){
				if (data) result = data;
           },
		});
		
		if (result) return result;
}

//Валидация email
function validateEmail(email) {
   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   return reg.test(email);
}
