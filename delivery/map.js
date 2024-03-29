/*$.getScript('/delivery/areas.js', function(){
});*/

$.getScript('/delivery/get_areas.php', function(){
});

viewmap = false;

$(document).on('click', "li.viewmap", function() {
	if (!viewmap) {
		viewmap = true;
		ymaps.ready(init);
		ymaps.ready(init_spb);
		ymaps.ready(init_nn);
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
		
        function ready_nn() {
            ymaps.ready(init_nn);
        }	

        function ready_pskov() {
            ymaps.ready(init_pskov);
        }	

        function ready_voron() {
            ymaps.ready(init_voron);
        }		

        function ready_novosib() {
            ymaps.ready(init_novosib);
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

        function init_nn() {
            myMap = new ymaps.Map("map_nn", {
                center: [56.3287, 44.002],
                zoom: 8,
            }, {
                avoidFractionalZoom: false,
                searchControlProvider: 'yandex#search'
            });
            loadPolygons_nn();
        }		

        function init_pskov() {
            myMap = new ymaps.Map("map_pskov", {
                center: [57.819274, 28.332460],
                zoom: 8,
            }, {
                avoidFractionalZoom: false,
                searchControlProvider: 'yandex#search'
            });
            //loadPolygons_pskov();
        }	

        function init_voron() {
            myMap = new ymaps.Map("map_voron", {
                center: [51.660786, 39.200269],
                zoom: 9,
            }, {
                avoidFractionalZoom: false,
                searchControlProvider: 'yandex#search'
            });
            loadPolygons_voron();
        }	

        function init_novosib() {
            myMap = new ymaps.Map("map_novosib", {
                center: [55.030204, 82.920430],
                zoom: 9,
            }, {
                avoidFractionalZoom: false,
                searchControlProvider: 'yandex#search'
            });
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
				

        function addPolygon(coords, numpol, index, num) { 
		
		//console.log(coords);
		
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
			
			myMap.behaviors.disable('scrollZoom');
			
			myPolygon[numpol].events.add('hover', function () {
				$('.delivery__td').removeClass('red'); 
				//if (num) $('.delivery__td:nth-child(' + (num + 1) + ')').addClass('red'); 
			});	
            
        }