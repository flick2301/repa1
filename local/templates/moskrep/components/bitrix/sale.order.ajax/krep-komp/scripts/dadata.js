$(document).ready(function() {
	
	var timerId;
	var timerHouseId;
	var token = "6286a42bb8f394fa4346875f691f7b28a9db6b63";
	var getResult = false;
	
	$(document).on('keyup', '#address_street', function(event) {
		
	var search = $(this).val();	
	getResult = false;
		
		if (search.length > 2) {
			if (event.keyCode==13) get_ajax(search, 'street');
			else clearTimeout(timerId);
			timerId = setTimeout(function() { get_ajax(search, 'street'); }, 500);  		
		}
		else changeClose('address_street');
	});	
	
	$(document).on('click', '#change_address_street div', function(e) {
		$('#address_street').val(($(this).text()));
		BX.Sale.OrderAjaxComponent.editAddress();
		changeClose('address_street');
		getResult = true;
		//setDeliveryPrice($(this).attr('rel'));
		
		e.stopPropagation();
	});
	
	$(document).on('keyup', '#address_house', function(event) {
		
		if (!getResult) return;
		
	var search = $(this).val();	
	
		search = search.replace(/^[^0-9]+/, '');
		$(this).val(search);
		
		if (search.length) {
			if (event.keyCode==13) get_ajax(search, 'house');
			else clearTimeout(timerHouseId);
			timerHouseId = setTimeout(function() { get_ajax(search, 'house'); }, 500);  		
		}
		//else changeClose('address_street');
	});		
	
	$(document).on('click', '#change_address_house div', function(e) {
		$('#address_house').val(($(this).text()));
		BX.Sale.OrderAjaxComponent.editAddress();
		changeClose('address_house');
		setDeliveryPrice($(this).attr('rel'));

		e.stopPropagation();
	});	
	
	$(document).click(function() {
		changeClose('address_street');
		changeClose('address_house');
	});
	
	
	function get_ajax(search, to_bound) {
		
		target = 'address_' + to_bound;
		
		var locations = [];
		
		locations[0] = {
            "country_iso_code": "RU",
        };
		locations[1] = {
            "country_iso_code": "RU",
        };	
	
		var city = explode(", ", $('#bx-soa-order-form .bx-ui-sls-container .bx-ui-sls-fake').attr('title'));	
		var street = $('#address_street').val();
		street = street.replace(/(ул )|(пр\-кт )|( пер)|( б\-р)/, '');
		
		if (city[0]) {
			locations[0].city = city[0];
			locations[1].settlement = city[0];
		}		
		
		if (to_bound=='house' && street) {
			locations[0].street = street;
			locations[1].street = street;
		}	
		
	var promise = suggest(search, locations, to_bound);
  
	promise
  	.done(function(response) {
		if (response.suggestions.length) {
			
			var result = [];
			
		response.suggestions.forEach(function(item, i, arr) {
			switch(to_bound) {
				case 'street':
					if (item.data.street && item.data.street != null) result.push({value: item.data.street_type == 'ул' ? item.data.street : item.data.street_with_type, full: item.value});
				break;
				case 'house':
					if (item.data.house && item.data.house != null) result.push({value:item.data.house, full: item.value});
				break;				
			}
		});
		
		result = doSmth(result);

		
							if (result[0]) {
								
								if (!BX('change_' + target)) {
									
								var children = [];
								
								result.forEach(function(item, i, arr) {									
									children.push(BX.create('DIV', {props: {className: ''}, attrs: {rel: item.full}, text: item.value}));
								});									
									
									var change = BX.create('DIV', {props: {id: 'change_' + target}, style: {'borderBottomLeftRadius':'4px', 'borderBottomRightRadius':'4px'}, children: children});
									BX(target).parentNode.appendChild(change);	
								}
								else {
									BX.cleanNode(BX('change_' + target));	
									result.forEach(function(item, i, arr) {		
										BX("change_" + target).appendChild(BX.create('DIV', {props: {className: ''}, attrs: {rel: item.full}, text: item.value}));	
									});	
								}
								
								$("#" + target).css({'borderBottomLeftRadius':'0px', 'borderBottomRightRadius':'0px'});
							}
							else changeClose(target);
		}

		//$("#suggestions").text(JSON.stringify(response, null, 4));
		//console.log(response);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
		//console.log(textStatus);
		//console.log(errorThrown);
    });		
	}
	

function suggest(query, locations, to_bound) {
	
  var serviceUrl = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address";
  
  var request = {
    "query": query,
	"count": 50,
	"locations": locations,
    "locations_boost": [{
        "kladr_id": "77"
    }],
	"from_bound": {
    "value": to_bound
  },	
	"to_bound": {
    "value": to_bound
  },			
  };
  
  var params = {
    type: "POST",
    contentType: "application/json",
    headers: {
      "Authorization": "Token " + token
    },
    data: JSON.stringify(request)
  }
  
	return $.ajax(serviceUrl, params);
}	


function get_coords(query) {
	
  var serviceUrl = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address";
  
  var request = {
    "query": query,
	"count": 1,
	"locations": [
        {
            "country_iso_code": "RU",
        },	
    ],
    "locations_boost": [{
        "kladr_id": "77"
    }],
	"from_bound": {
		"value": "city"
	},	
	"to_bound": {
		"value": "house"
	},		
  };
  
  var params = {
    type: "POST",
    contentType: "application/json",
    headers: {
      "Authorization": "Token " + token
    },
    data: JSON.stringify(request)
  }

	return $.ajax(serviceUrl, params);
}	

//Расчет стоимости доставки
function setDeliveryPrice(rel) {
	
	if (BX.Sale.OrderAjaxComponent.currentDelivery!=2 && BX.Sale.OrderAjaxComponent.currentDelivery!=28) return;
	
		var coords = get_coords(rel);
		
	coords
  	.done(function(response) {
		if (response.suggestions.length) {
			BX.Sale.OrderAjaxComponent.lat = response.suggestions[0].data.geo_lat;
			BX.Sale.OrderAjaxComponent.lon = response.suggestions[0].data.geo_lon;
			
var result = deliveryCost.init({
		lat: response.suggestions[0].data.geo_lat,
		lon: response.suggestions[0].data.geo_lon,
		weight: BX.Sale.OrderAjaxComponent.result.TOTAL.ORDER_WEIGHT ? BX.Sale.OrderAjaxComponent.result.TOTAL.ORDER_WEIGHT/1000 : 10,
		price: BX.Sale.OrderAjaxComponent.result.TOTAL.ORDER_PRICE,
		delivery_id: BX.Sale.OrderAjaxComponent.currentDelivery,
	});
	
	$('#delivery_lat').val(result.lat);
	$('#delivery_lon').val(result.lon);
	
	//getMap(result.lat, result.lon); //Показ карты
	
$("#soa-property-34, #soa-property-35").val(result.cost);	
//alert(JSON.stringify(result));
			
			BX.Sale.OrderAjaxComponent.sendRequest();
		}
	});		
}	
});








function explode( delimiter, string ) {	// Split a string by string
	// 
	// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +   improved by: kenneth
	// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)

	var emptyArray = { 0: '' };

	if ( arguments.length != 2
		|| typeof arguments[0] == 'undefined'
		|| typeof arguments[1] == 'undefined' )
	{
		return null;
	}

	if ( delimiter === ''
		|| delimiter === false
		|| delimiter === null )
	{
		return false;
	}

	if ( typeof delimiter == 'function'
		|| typeof delimiter == 'object'
		|| typeof string == 'function'
		|| typeof string == 'object' )
	{
		return emptyArray;
	}

	if ( delimiter === true ) {
		delimiter = '1';
	}

	return string.toString().split ( delimiter.toString() );
}

function doSmth(a) {
  for (var q=1, i=1; q<a.length; ++q) {
    if (a[q] !== a[q-1]) {
      a[i++] = a[q];
    }
  }

  a.length = i;
  return a;
}

function changeClose(target) {
	BX.cleanNode(BX("change_" + target), true);	
	$("#" + target).css({'borderBottomLeftRadius':'4px', 'borderBottomRightRadius':'4px'});		
}
