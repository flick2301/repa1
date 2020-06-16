$(document).ready(function() {

if (select_city) {
	$('.delivery_items .delivery_item').removeClass('active');
	$('.delivery_items .delivery_item.city' + select_city).addClass('active');
	$('.delivery__tabs-list').removeClass('active');
	$('.delivery__tabs-list.city' + select_city).addClass('active');	
}	
	
	
	ymaps.ready(init2565);
	
	$(document).on('click', '#shops2565 li', function() {
		//alert($(this).attr('rel'));
		$('#shops2565 li').removeClass('active');
		$(this).addClass('active');
		unsetPlacemark2565();
		closeBallon2565();
		myPlacemark2565[$(this).attr('rel')].options.set('iconImageHref', '/images/shop_label_current.png');
		myMap2565.setCenter([myPlacemark2565[$(this).attr('rel')].options.get('lat'), myPlacemark2565[$(this).attr('rel')].options.get('lon')], zoom[2565]);
	});
	
   
   addScheme2565 = new BX.PopupWindow("scheme2565", null, {
      content: BX('scheme_text2565'),
      //closeIcon: {right: "10px", top: "0px"},
      titleBar: {content: BX.create("div", {html: 'Видео проезда', 'props': {'className': 'scheme-title-bar'}})},
	  autoHide: true,
      zIndex: 0,
      offsetLeft: 0,
      offsetTop: 20,
      draggable: {restrict: false},	  
	  overlay: {backgroundColor: 'black', opacity: '80' },
   }); 
   
   $('#click_scheme2565').click(function(){
      addScheme2565.show(); // появление окна
   });
   
	BX.bind(BX("scheme2565"), 'click', function() {addScheme2565.close();})

});	


function init2565() {
    myMap2565 = new ymaps.Map("map2565", {
            center: [center_lat[2565], center_lon[2565]],
            zoom: zoom[2565]
        }, {
            searchControlProvider: 'yandex#search'
        });
		
		
shop.forEach(function(entry) {
        myPlacemark2565[entry.id] = new ymaps.Placemark([entry.lat, entry.lon], {
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
		

    myPlacemark2565[entry.id].events
        .add('click', function (e) {
            // Ссылку на объект, вызвавший событие,
            // можно получить из поля 'target'.
            if(!$('#shops2565 li[rel=' + entry.id +']').hasClass('active')) e.get('target').options.set('iconImageHref', '/images/shop_label_current.png');
        })	
        .add('mouseenter', function (e) {
            // Ссылку на объект, вызвавший событие,
            // можно получить из поля 'target'.
            if(!$('#shops2565 li[rel=' + entry.id +']').hasClass('active')) e.get('target').options.set('iconImageHref', '/images/shop_label_active.png');
        })
        .add('mouseleave', function (e) {
            if(!$('#shops2565 li[rel=' + entry.id +']').hasClass('active')) e.get('target').options.set('iconImageHref', '/images/shop_label.png');
        }); 
		
		if (entry.balloon) myPlacemark2565[entry.id].events.add('balloonopen', function (e) {	
			unsetPlacemark2565();
			e.get('target').options.set('iconImageHref', '/images/shop_label_current.png');
			$('#shops2565 li').removeClass('active');
			$('#shops2565 li[rel=' + entry.id +']').addClass('active');
			$('#shops2565 li[rel=' + entry.id +']').scrollIntoView(false);
        })	
		.add('balloonclose', function (e) {
			e.get('target').options.set('iconImageHref', '/images/shop_label.png');
			$('#shops2565 li').removeClass('active');			
        });				

    myMap2565.geoObjects.add(myPlacemark2565[entry.id]);
	$('.print_btn').css('visibility', 'visible');
	
});
}

function unsetPlacemark2565() {
	shop.forEach(function(place) {			
			myPlacemark2565[place.id].options.set('iconImageHref', '/images/shop_label.png');
	});		
}

function closeBallon2565() {
	shop.forEach(function(place) {			
			myPlacemark2565[place.id].balloon.close();
	});		
}
	

    // Через коллекции можно подписываться на события дочерних элементов.
    //yellowCollection.events.add('click', function () { alert('Кликнули по желтой метке') });
    //blueCollection.events.add('click', function () { alert('Кликнули по синей метке') });

    // Через коллекции можно задавать опции дочерним элементам.
   // blueCollection.options.set('preset', 'islands#blueDotIcon');