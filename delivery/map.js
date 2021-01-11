$.getScript('/delivery/areas.js', function(){
});

viewmap = false;

$(document).on('click', "li.viewmap", function() {
	if (!viewmap) {
		viewmap = true;
		ymaps.ready(init);
		ymaps.ready(init_spb);
	}	
});

        var myMap,
            myPolygon = [];

        function ready() {
            ymaps.ready(init);
        }
		
        function ready_spb() {
            ymaps.ready(init_spb);
        }		
		
        function ready_spb() {
            ymaps.ready(init_spb);
        }		

        function init() {
            myMap = new ymaps.Map("map", {
                center: [55.753559,37.609218],
                zoom: 8,
            }, {
                avoidFractionalZoom: false,
                searchControlProvider: 'yandex#search'
            });
            loadPolygons();
        }
		
        function init_spb() {
            myMap = new ymaps.Map("map_spb", {
                center: [59.939095, 30.315868],
                zoom: 8,
            }, {
                avoidFractionalZoom: false,
                searchControlProvider: 'yandex#search'
            });
            loadPolygons_spb();
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