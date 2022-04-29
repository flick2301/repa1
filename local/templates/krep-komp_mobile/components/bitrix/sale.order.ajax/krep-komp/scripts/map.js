lat = '';
lon = '';
areas = [];

$.getScript('/delivery/get_areas.php', function(){
});

function getMap(send_lat, send_lon, send_areas) {

	lat = send_lat;
	lon = send_lon;

		ymaps.ready(init);
}

var myMap, myPolygon = [];

        function init() {
            myMap = new ymaps.Map("delivery_map", {
                center: [lat,lon],
                zoom: 8,
            }, {
                avoidFractionalZoom: false,
                searchControlProvider: 'yandex#search'
            }),

		myMap.geoObjects
			.add(new ymaps.Placemark([lat, lon], {
            iconCaption: lat + ', ' + lon
        }));
		
		myMap.behaviors.disable('scrollZoom'); 
		
            loadPolygons(BX.Sale.OrderAjaxComponent.currentDelivery!=ID_DELIVERY_DAYTODAY && BX.Sale.OrderAjaxComponent.currentDelivery!=ID_DELIVERY_SUNDAY ? false : true);
			loadPolygons_spb();
			loadPolygons_nn();
			loadPolygons_voron();
			loadPolygons_novosib();
        }

        function stopDraw() {
            if (myPolygon.length > 0) {
                $.each(myPolygon, function (i, obj) {
                    if (typeof myPolygon[i] == 'object') {
                        obj.editor.stopEditing();
                    }
                });
            }
        }											

        function addPolygon(coords, numpol, index) {
            /* пробежимся по массиву полигонов и остановим их редактирование */

            if (typeof coords === 'undefined' || !coords.length) {
                coords = [];
            }
            stopDraw();

            myPolygon[numpol] = new ymaps.Polygon(coords, {
                hintContent: numpol
            }, {
                fillColor: '#f00',
                strokeColor: '#d00000',
                fillOpacity: .05,
                outline: true,
                strokeWidth: 1
            });
            myMap.geoObjects.add(myPolygon[numpol]);
            
        }