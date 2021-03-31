$(document).ready(function() {

if (select_city) {
	$('.delivery_items .delivery_item').removeClass('active');
	$('.delivery_items .delivery_item.city' + select_city).addClass('active');
	$('.delivery__tabs-list').removeClass('active');
	$('.delivery__tabs-list.city' + select_city).addClass('active');	
}	
	
	
	ymaps.ready(init2631);
	
	$(document).on('click', '#shops2631 li', function() {
		//alert($(this).attr('data-rel'));
		$('#shops2631 li').removeClass('active');
		$(this).addClass('active');
		unsetPlacemark2631();
		closeBallon2631();
		myPlacemark2631[$(this).attr('data-rel')].options.set('iconImageHref', '/images/shop_label_current.png');
		myMap2631.setCenter([myPlacemark2631[$(this).attr('data-rel')].options.get('lat'), myPlacemark2631[$(this).attr('data-rel')].options.get('lon')], zoom[2631]);
	});
	
   
   addScheme2631 = new BX.PopupWindow("scheme2631", null, {
      content: BX('scheme_text2631'),
      //closeIcon: {right: "10px", top: "0px"},
      titleBar: {content: BX.create("div", {html: 'Видео проезда', 'props': {'className': 'scheme-title-bar'}})},
	  autoHide: true,
      zIndex: 0,
      offsetLeft: 0,
      offsetTop: 20,
      draggable: {restrict: false},	  
	  overlay: {backgroundColor: 'black', opacity: '80' },
   }); 
   
   $('#click_scheme2631').click(function(){
      addScheme2631.show(); // появление окна
   });
   
	BX.bind(BX("scheme2631"), 'click', function() {addScheme2631.close();})

});	


function init2631() {
    myMap2631 = new ymaps.Map("map2631", {
            center: [center_lat[2631], center_lon[2631]],
            zoom: zoom[2631]
        }, {
            searchControlProvider: 'yandex#search'
        });
		
		
shop.forEach(function(entry) {
        myPlacemark2631[entry.id] = new ymaps.Placemark([entry.lat, entry.lon], {
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
		

    myPlacemark2631[entry.id].events
        .add('click', function (e) {
            // Ссылку на объект, вызвавший событие,
            // можно получить из поля 'target'.
            if(!$('#shops2631 li[data-rel=' + entry.id +']').hasClass('active')) e.get('target').options.set('iconImageHref', '/images/shop_label_current.png');
        })	
        .add('mouseenter', function (e) {
            // Ссылку на объект, вызвавший событие,
            // можно получить из поля 'target'.
            if(!$('#shops2631 li[data-rel=' + entry.id +']').hasClass('active')) e.get('target').options.set('iconImageHref', '/images/shop_label_active.png');
        })
        .add('mouseleave', function (e) {
            if(!$('#shops2631 li[data-rel=' + entry.id +']').hasClass('active')) e.get('target').options.set('iconImageHref', '/images/shop_label.png');
        }); 
		
		if (entry.balloon) myPlacemark2631[entry.id].events.add('balloonopen', function (e) {	
			unsetPlacemark2631();
			e.get('target').options.set('iconImageHref', '/images/shop_label_current.png');
			$('#shops2631 li').removeClass('active');
			$('#shops2631 li[data-rel=' + entry.id +']').addClass('active');
			$('#shops2631 li[data-rel=' + entry.id +']').scrollIntoView(false);
        })	
		.add('balloonclose', function (e) {
			e.get('target').options.set('iconImageHref', '/images/shop_label.png');
			$('#shops2631 li').removeClass('active');			
        });				

    myMap2631.geoObjects.add(myPlacemark2631[entry.id]);
	$('.print_btn').css('visibility', 'visible');
	
});
}

function unsetPlacemark2631() {
	shop.forEach(function(place) {			
			myPlacemark2631[place.id].options.set('iconImageHref', '/images/shop_label.png');
	});		
}

function closeBallon2631() {
	shop.forEach(function(place) {			
			myPlacemark2631[place.id].balloon.close();
	});		
}
	

    // Через коллекции можно подписываться на события дочерних элементов.
    //yellowCollection.events.add('click', function () { alert('Кликнули по желтой метке') });
    //blueCollection.events.add('click', function () { alert('Кликнули по синей метке') });

    // Через коллекции можно задавать опции дочерним элементам.
   // blueCollection.options.set('preset', 'islands#blueDotIcon');