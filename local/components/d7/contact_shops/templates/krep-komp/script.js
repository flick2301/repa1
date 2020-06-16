$(document).ready(function() {
	
	ymaps.ready(init);
	
	$(document).on('click', '#shops li', function() {
		//alert($(this).attr('rel'));
		$('#shops li').removeClass('active');
		$(this).addClass('active');
		unsetPlacemark();
		closeBallon();
		myPlacemark[$(this).attr('rel')].options.set('iconImageHref', '/images/shop_label_current.png');
		myMap.setCenter([myPlacemark[$(this).attr('rel')].options.get('lat'), myPlacemark[$(this).attr('rel')].options.get('lon')], zoom[section_id]);
	});
	
   
   addScheme = new BX.PopupWindow("scheme", null, {
      content: BX('scheme_text'),
      //closeIcon: {right: "10px", top: "0px"},
      titleBar: {content: BX.create("div", {html: 'Видео проезда', 'props': {'className': 'scheme-title-bar'}})},
	  autoHide: true,
      zIndex: 0,
      offsetLeft: 0,
      offsetTop: 20,
      draggable: {restrict: false},	  
	  overlay: {backgroundColor: 'black', opacity: '80' },
   }); 
   
   $('#click_scheme').click(function(){
      addScheme.show(); // появление окна
   });
   
	BX.bind(BX("scheme"), 'click', function() {addScheme.close();});
	
	$('#qr').qrcode({
		render: 'canvas',
		width:200,
		height:200,
		text: window.location.href
	});	

});	


function init() {
    myMap = new ymaps.Map("map", {
            center: [center_lat[section_id], center_lon[section_id]],
            zoom: zoom[section_id]
        }, {
            searchControlProvider: 'yandex#search'
        });
		
		
shop.forEach(function(entry) {

        myPlacemark[entry.id] = new ymaps.Placemark([entry.lat, entry.lon], {
            hintContent: entry.name,
            balloonContent: '<div class="inblock">' + entry.color + entry.address + '<br />' + entry.text + '</div>'
        }, {
            // Опции.
            // Необходимо указать данный тип макета.
            iconLayout: 'default#image',
            // Своё изображение иконки метки.
            iconImageHref: '/images/shop_label.png',
            // Размеры метки.
            iconImageSize: [48, 48],
            // Смещение левого верхнего угла иконки относительно
            // её "ножки" (точки привязки).
            iconImageOffset: [-24, -48],
			id: entry.id,
			lat: entry.lat,
			lon: entry.lon,
        });
		

    myPlacemark[entry.id].events
        .add('click', function (e) {
            // Ссылку на объект, вызвавший событие,
            // можно получить из поля 'target'.
            if(!$('#shops li[rel=' + entry.id +']').hasClass('active')) e.get('target').options.set('iconImageHref', '/images/shop_label_current.png');
        })	
        .add('mouseenter', function (e) {
            // Ссылку на объект, вызвавший событие,
            // можно получить из поля 'target'.
            if(!$('#shops li[rel=' + entry.id +']').hasClass('active')) e.get('target').options.set('iconImageHref', '/images/shop_label_active.png');
        })
        .add('mouseleave', function (e) {
            if(!$('#shops li[rel=' + entry.id +']').hasClass('active')) e.get('target').options.set('iconImageHref', '/images/shop_label.png');
        });
		
		if (entry.balloon) myPlacemark[entry.id].events.add('balloonopen', function (e) {	
			unsetPlacemark();
			e.get('target').options.set('iconImageHref', '/images/shop_label_current.png');
			$('#shops li').removeClass('active');
			$('#shops li[rel=' + entry.id +']').addClass('active');
			$('#shops li[rel=' + entry.id +']').scrollIntoView(false);
        })	
		.add('balloonclose', function (e) {
			e.get('target').options.set('iconImageHref', '/images/shop_label.png');
			$('#shops li').removeClass('active');			
        });				

    myMap.geoObjects.add(myPlacemark[entry.id]);
	$('.print_btn').css('visibility', 'visible');
	
});
}

function unsetPlacemark() {
	shop.forEach(function(place) {			
			myPlacemark[place.id].options.set('iconImageHref', '/images/shop_label.png');
	});		
}

function closeBallon() {
	shop.forEach(function(place) {			
			myPlacemark[place.id].balloon.close();
	});		
}
	

    // Через коллекции можно подписываться на события дочерних элементов.
    //yellowCollection.events.add('click', function () { alert('Кликнули по желтой метке') });
    //blueCollection.events.add('click', function () { alert('Кликнули по синей метке') });

    // Через коллекции можно задавать опции дочерним элементам.
   // blueCollection.options.set('preset', 'islands#blueDotIcon');

