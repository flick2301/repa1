function init(id, lat, lon) {
	 return function () {
	    window['myMap' + id] = new ymaps.Map('map-' + id, {
            center: [lat, lon],
			controls: [],
            zoom: 15
        }, {
        });

		if(window.innerWidth >= 767){
    var pixelCenter = window['myMap' + id].getGlobalPixelCenter();
    pixelCenter = [
     pixelCenter[0] - 220,
     pixelCenter[1] - 0
    ];
    var geoCenter = window['myMap' + id].options.get('projection').fromGlobalPixels(pixelCenter, window['myMap' + id].getZoom());
    window['myMap' + id].setCenter(geoCenter);
   }
		
        var myPlacemark = new ymaps.Placemark([lat, lon], {
            hintContent: '',
            balloonContent: ''
        }, {
            // Опции.
            // Необходимо указать данный тип макета.
            iconLayout: 'default#image',
            // Своё изображение иконки метки.
            iconImageHref: template_url + '/images/shop_label.svg',
            // Размеры метки.
            iconImageSize: [30, 30],
            // Смещение левого верхнего угла иконки относительно
            // её "ножки" (точки привязки).
            iconImageOffset: [-15, -15]
        });
		
		window['myMap' + id].geoObjects.add(myPlacemark);	
		
		
		window['suggestView' + id] = new ymaps.SuggestView('form-map-from-' + id);

		
	
 window['suggestView' + id].events.add('select', function (e) { conslole.log(2222);
	ymaps.geocode(e.get('item').value).then(function (res) {
		conslole.log(122211);	
	});
});
		
	 }
}