var BXFormPosting = false,
    currentCity = {},
    $pickupInput,
    $cityInput,
    $cityApiIdInput,
    $cityKladrIdInput,
    $shopLogisticInput,
    $shopLogisticCourierInput,
    $companyFilialMskInput,
    $companyFilialSpbInput,
	$shopLogisticCourierMscSpbInput,
    $dellinInput,
    $ruspostInput,
    $pickupList,
    $pickupListScrollWrapper,
    pickupMap,
    pickupPlaceMark,
    scrollHandle,
    initCustomStop = false;

GG.CUSTOMSCROLL = false;

$(function () {
    initCustomWidgets();

    $(document).on('click', '[bx_pickup]', function () {
        $pickupInput.val($(this).data('value'));

        var pickup = $(this).data('pickup'),
            $deliveryPriceRow = $('#delivery_price'),
            defaultDeliveryPrice = $deliveryPriceRow.data('default'),
            city = $cityApiIdInput.val(),
            price = BX('order_price').value,
            weight = BX('order_weight').value,
            deliveryPrice = $(this).data('price');

        if (defaultDeliveryPrice > 0) {
            if (typeof deliveryPrice == 'undefined') {
                BX.ajax({
                    url : '/ajax/delivery.php',
                    data : {
                        action : 'getPrice',
                        pickup : pickup,
                        city : city,
                        price : price,
                        weight : weight
                    },
                    method : 'POST',
                    dataType : 'json',
                    onsuccess : function (data) {
                        $deliveryPriceRow.html(data.price + ' руб.');
                    }
                });
            } else {
                $deliveryPriceRow.html(deliveryPrice + ' руб.');
            }
        }
    });

    $(document).on('click', '[order_tab]', function () {
        $('[order_tab]').each(function () {
            if ($(this).hasClass('order_tab__current')) {
                $(this).addClass('links__entry_current');
            } else {
                $(this).removeClass('links__entry_current');
            }
        });
    });

    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });

    $(document).on('keyup', '#ORDER_PROPERTY_CITY', function (e) {
        if ($cityKladrIdInput && $cityApiIdInput && $.inArray(event.keyCode, [13, 38, 40]) < 0) {
            $cityKladrIdInput.val('');
            $cityApiIdInput.val('');
            disableShopLogisticsDelivery();
			checkShopLogisticsDelivery();
			
	
			
        }
		
    });

});

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function submitForm(val) {
    if (BXFormPosting === true) {
        return true;
    }

    var errors = '',
        requiredInputs = document.body.querySelectorAll('[required-input]'),
        orderErrors = BX('bx_order_error');

    if (!!requiredInputs && !!orderErrors && val > BX('step').value) {
        for (var i = 0; i < requiredInputs.length; i++) {
            if (!requiredInputs[i].value.length) {
                if (requiredInputs[i].type == 'hidden') {
                    errors += 'Выберите ' + requiredInputs[i].title + '<br>';
                } else {
                    errors += 'Поле ' + requiredInputs[i].title + ' обязательно для заполнения<br>';
                }
            } else {
                if (requiredInputs[i].type == 'email' && !validateEmail(requiredInputs[i].value)) {
                    errors += 'Поле ' + requiredInputs[i].title + ' заполнено некорректно<br>';
                }
            }
        }
        errors = errors.substr(0, errors.length - 4);
    }

    if (errors.length > 0) {
        orderErrors.innerHTML = errors;
        orderErrors.style.display = 'inline-block';
        BX.scrollToNode(orderErrors);
        return false;
    }

    BXFormPosting = true;
    if (val != 'Y') {
        BX('confirmorder').value = 'N';
        if (val == 1 || val == 2 || val == 3) {
            BX('step').value = val;
        }
    }

    var orderForm = BX('ORDER_FORM');
    BX.showWait();
    initCustomStop = false;
    BX.ajax.submit(orderForm, ajaxResult);

    return true;
}

BX.addCustomEvent('onAjaxSuccess', function (data) {
	window.a=1;
    if(typeof data == 'undefined') {
        initCustomWidgets();
        if (BX('step').value == 1) {
            disableShopLogisticsDelivery();
            if ($cityApiIdInput.val().length) {
              
			   checkShopLogisticsDelivery();
				
            }
        }
		
    }
	
});

function disableShopLogisticsDelivery() {
    var disabledDeliveryHintRow = '<span class="disabled-delivery-hint"> (этот способ доставки недоступен в вашем регионе)</span>';
    var ru = $('.select-form-field').customSelect() == 'ru';

    $shopLogisticInput = $('#DELIVERY_ID_' + deliveryShoplogisticId);
    $shopLogisticCourierInput = $('#DELIVERY_ID_' + deliveryShoplogisticCourierId);
    $companyFilialMskInput = $('#DELIVERY_ID_' + deliveryCompanyFilialMskId);
    $companyFilialSpbInput = $('#DELIVERY_ID_' + deliveryCompanyFilialSpbId);
	$shopLogisticCourierMscSpbInput = $('#DELIVERY_ID_' + deliveryCourierMscSpb);
    $dellinInput = $('#DELIVERY_ID_' + deliveryDellinId);
    $ruspostInput = $('#DELIVERY_ID_' + deliveryRuspostId);

    $companyFilialMskInput.prop('disabled', true).prop('checked', false).parent().parent().hide();
    $companyFilialSpbInput.prop('disabled', true).prop('checked', false).parent().parent().hide();
	$shopLogisticCourierMscSpbInput.prop('disabled', true).prop('checked', false).parent().parent().hide();
    if (ru) {
        $dellinInput.prop('disabled', false).parent().parent().show();
        if (!$shopLogisticCourierInput.prop('disabled')) {
            $shopLogisticCourierInput.prop('disabled', true);
            $shopLogisticCourierInput.parent().find('.custom__title').css('color', '#9c9c9c').append(disabledDeliveryHintRow);
        }
    } else {
        $dellinInput.prop('disabled', true).parent().parent().hide();
        if ($shopLogisticCourierInput.prop('disabled')) {
            $shopLogisticCourierInput.prop('disabled', false).parent()
                .find('.custom__title').css('color', '')
                .find('.disabled-delivery-hint').remove();
        }
    }
    $ruspostInput.prop('disabled', false).parent().parent().show();
	
	

    if (!$shopLogisticInput.prop('disabled')) {
        $shopLogisticInput.prop('disabled', true);
        $shopLogisticInput.parent().find('.custom__title').css('color', '#9c9c9c').append(disabledDeliveryHintRow);
    }

    $shopLogisticInput.prop('checked', false);
    $shopLogisticCourierInput.prop('checked', false);

    $('input[name="DELIVERY_ID"]').each(function () {
        if (!$(this).prop('disabled')) {
            var deliveryId = $(this).attr('id').replace('DELIVERY_ID_', ''), arrayForCheck;
            if (ru) {
                arrayForCheck = [deliveryShoplogisticId, deliveryShoplogisticCourierId];
            } else {
                arrayForCheck = [deliveryShoplogisticId];
            }
            if ($.inArray(deliveryId, arrayForCheck) < 0) {
                $(this).prop('checked', true);
                return false;
            }
        }
    });
	
	
}

function checkShopLogisticsDelivery(sh) {
	
	if(!sh){
	$('#order_price').attr('data-id', 'none');
	 price = BX('order_price').value,
     weight = BX('order_weight').value;
	 BX.ajax({
                url : '/ajax/delivery.php',
                data : {
                    action : 'getPickupsPrices',
                    city : $('[name="ORDER_PROP_11"]').val(),
                    price : price,
					city_name : $('[name="ORDER_PROP_11"]').val(),
                    weight : weight
                },
                method : 'POST',
                dataType : 'json',
                onsuccess : function (pickupsPrices) {
                    
						
                    Object.keys(pickupsPrices).map(function(k, index) {
                        var pickup = pickupsPrices[k];
                        var tit = pickup.title;
						
						if(tit!=='none' && window.a != 2){
						window.a++;
						checkShopLogisticsDelivery(true);
						}
						
                    });

                   
                }
            });
	
	 
	}
	
	
	if(sh){
    var ru = $('.select-form-field').customSelect() == 'ru',
        price = BX('order_price').value,
        weight = BX('order_weight').value;

    if (1) {
       if (1) {
            BX.ajax({
                url : '/ajax/delivery.php',
                data : {
                    action : 'getPickupsPrices',
                    city : currentCity.id,
                    price : price,
					city_name : $('[name="ORDER_PROP_11"]').val(),
                    weight : weight,
                    limit : 1
                },
                method : 'POST',
                dataType : 'json',
                onsuccess : function (pickupsPrices) {
                    if (Object.keys(pickupsPrices).length) {
                        if (!$shopLogisticInput.prop('checked')) {
                            $('input[name="DELIVERY_ID"]:checked').prop('checked', false);
                            $shopLogisticInput.prop('checked', true).prop('disabled', false);
                            $shopLogisticInput.parent()
                                .find('.custom__title').css('color', '')
                                .find('.disabled-delivery-hint').remove();
                        }
                    }
                }
				
            });
        }
        if (!$shopLogisticInput.prop('checked') && !$shopLogisticCourierInput.prop('checked')) {
            $shopLogisticCourierInput.prop('checked', true);
        }
        if ($shopLogisticCourierInput.prop('disabled')) {
            $shopLogisticCourierInput.prop('disabled', false);
            $shopLogisticCourierInput.parent()
                .find('.custom__title').css('color', '')
                .find('.disabled-delivery-hint').remove();
        }
        if ($.inArray(currentCity.id, ['405065', '958281']) >= 0) {
            if (currentCity.id === '405065') {
                $companyFilialMskInput.prop('disabled', false).parent().parent().show();
			}
            if (currentCity.id === '958281') {
                $companyFilialSpbInput.prop('disabled', false).parent().parent().show();
				
            }
			$shopLogisticCourierMscSpbInput.prop('disabled', false).parent().parent().show();
            $dellinInput.prop('disabled', true).prop('checked', false).parent().parent().hide();
            $ruspostInput.prop('disabled', true).prop('checked', false).parent().parent().hide();
			$shopLogisticCourierInput.prop('disabled', true).prop('checked', false).parent().parent().hide();
			
        }else{
			$shopLogisticCourierInput.prop('disabled', false).parent().parent().show();
		}
    }

	$('input[name="DELIVERY_ID"]:checked').prop('checked', false);
                            $shopLogisticInput.prop('checked', true).prop('disabled', false);
                            $shopLogisticInput.parent()
                                .find('.custom__title').css('color', '')
                                .find('.disabled-delivery-hint').remove();

								
								}else{ disableShopLogisticsDelivery();}
       
}     


function initCustomWidgets() {
    $pickupInput = $('#ORDER_PROPERTY_PICKUP');
    $cityInput = $('#ORDER_PROPERTY_CITY');
    $cityApiIdInput = $('#ORDER_PROPERTY_CITY_API_ID');
    $cityKladrIdInput = $('#ORDER_PROPERTY_CITY_KLADR_ID');
    $shopLogisticInput = $('#DELIVERY_ID_' + deliveryShoplogisticId);
    $pickupList = $('[pickup-list]');
    $pickupListScrollWrapper = $pickupList.closest('.scroll__wrapper');

    if (initCustomStop) {
        return false;
    } else {
        initCustomStop = true;
    }

    if (!!BX('pickup-map')) {
        if (typeof ymaps != 'undefined') {
            ymaps.ready(YMapsInit);
        }
    }

    initKladr();
    GG.customSelect($('.select-form-field'));
    $('.select-form-field').data('callback', function () {
        disableShopLogisticsDelivery();
        if ($cityApiIdInput.val().length) {
            checkShopLogisticsDelivery();
        }
		checkShopLogisticsDelivery();
		
    });
    scrollHandle = GG.customScroll($pickupListScrollWrapper[0]);
}

// метод переключения на метку
function switchToPoint($point, scrollTo) {
    var $scroll__block = $(".pickup__address .scroll__block"),
        $current_point = $(".pickup__address .address__list .address__entry_current");

    // деактивируем старую метку
    if ($current_point.length) {
        $current_point.removeClass('address__entry_current');
    }

    // активируем новую метку
    $point.addClass('address__entry_current');

    // прокручиваем список до элемента
    if (scrollTo) {
        $scroll__block.scrollTop($scroll__block.scrollTop() + $point.position().top);
        scrollHandle();
    }

    // двигаем карту к метке
    pickupMap.setCenter($point.data("placemark").geometry.getCoordinates());

    // увеличиваем масштаб карты
    pickupMap.setZoom(16);
}

function checkCity(city) {
    BX.ajax({
        url : '/ajax/delivery.php',
        data : {action : 'checkCity', city : city},
        method : 'POST',
        dataType : 'json',
        onsuccess : function (result) {
            if (result.id.length) {
                currentCity = result;
                $cityApiIdInput.val(result.id);
                checkShopLogisticsDelivery();
            } else {
                $cityApiIdInput.val('');
            }
        }
    });
}

function initKladr() {
    if ($cityInput.length) {
        $cityInput.kladr({
            type : $.kladr.type.city,
            token : kladrToken,
            open : function () {
                if (!$('#next_step_btn').attr('onclick').length) {
                    $('#next_step_btn').attr('onclick', 'submitForm(2);');
                }
            },
            send : function (data) {
                if ($('.select-form-field').customSelect() == 'ru') {
                    $('#kladr_autocomplete').show();
                } else {
                    $('#kladr_autocomplete').hide();
                }
            },
            receive : function (data) {
            },
            select : function (data) {
                $cityKladrIdInput.val(data.id);
                checkCity(data.id);
            }
        })
            .prop('disabled', false)
            .closest('.form__label').removeClass('form__label_loading')
            .find('.loading').remove();
    }
}

function YMapsInit() {
    pickupMap = new ymaps.Map("pickup-map", {center : [60.002297, 30.342036], zoom : 9});
    if (GG.CONFIG.responsive) {
        pickupMap.behaviors.disable('drag');
        pickupMap.behaviors.enable('multiTouch');
    }
    var cityId = $cityApiIdInput.val(),
        price = BX('order_price').value,
        weight = BX('order_weight').value;

  //  if (cityId) {
        if (!!$pickupList) {
            BX.ajax({
                url : '/ajax/delivery.php',
                data : {
                    action : 'getPickupsPrices',
                    city : $('[name="ORDER_PROP_11"]').val(),
                    price : price,
					city_name : $('[name="ORDER_PROP_11"]').val(),
                    weight : weight
                },
                method : 'POST',
                dataType : 'json',
                onsuccess : function (pickupsPrices) {
                    $pickupList.html('');
                    pickupMap.geoObjects.removeAll();
                    var pickupInputValue = $pickupInput.val(),
                        triggerEntry = false;
                    Object.keys(pickupsPrices).map(function(k, index) {
                        var pickup = pickupsPrices[k];
                        var tit = pickup.title;
						var found = tit.includes('Москва'); //ищем fgh по границам слова
                        var found2 = tit.includes('Санкт-Петербург'); //ищем fgh по границам слова
                        if(found || found2)
                        pickup.price = 250;
					
					if($('#delivery_price').data('default') == 0){pickup.price = 0;}
                        var value = pickup.address + ' [' + pickup.id + ']',
                            $entry = $("<li/>", {class : "address__entry"}).html(
                            '<a href="" class="address__lnk"></a>'
                            + '<strong>' + pickup.title + '</strong>'
                            + pickup.address
                            + '<br><span>' + pickup.phone + '</span>'
							+ '<br><span>Стоимость: <b style="color: dimgray;">' + pickup.price + ' руб.</b></span>').appendTo($pickupList);
                        $entry.attr('data-value', value)
                            .attr('data-pickup', pickup.id)
                            .attr('data-price', pickup.price)
                            .attr('bx_pickup', '');

                        pickupPlaceMark = new ymaps.Placemark([pickup.latitude, pickup.longitude], {
                            balloonContent : '<b>Адрес:</b> ' + pickup.address + '<br><b>Телефон:</b> ' + pickup.phone
                            + '<br>' + pickup.description
							+ '<br><b>Стоимость:</b> <span style="color: dimgray;">' + pickup.price + ' руб.</span>'
                        }, {
                            iconImageHref : '/local/templates/.default/img/images/pin.svg',
                            iconLayout : 'default#image',
                            iconImageSize : [70, 72],
                            iconImageOffset : [-36, -72]
                        });

                        // привязываем данные к элементу списка
                        $entry.data("placemark", pickupPlaceMark);

                        // эвент при нажатии на метку
                        pickupPlaceMark.events.add('click', function () {
                            $entry.trigger('click', true);
                            return false;
                        });

                        // эвент при нажатии на элемент списка
                        $entry.click(function (event, scrollTo) {
                            switchToPoint($(this), scrollTo);
                        });

                        if (pickupInputValue == value) {
                            triggerEntry = $entry;
                        }

                        pickupMap.geoObjects.add(pickupPlaceMark);
                    });

                    if (triggerEntry) {
                        triggerEntry.trigger('click', true);
                    } else {
                        pickupMap.setBounds(pickupMap.geoObjects.getBounds(), {checkZoomRange : true});
                    }

                    // GG.customScroll($pickupListScrollWrapper);
                    $pickupListScrollWrapper.css('height', $pickupList.outerHeight());
                }
            });
        }
  //  }
 
  
 
}

function ajaxResult(res) {
    var orderForm = BX('ORDER_FORM');
    try {
        // if json came, it obviously a successfull order submit

        var json = JSON.parse(res);
        BX.closeWait();

        if (json.error) {
            BXFormPosting = false;
            return;
        }
        else if (json.redirect) {
            window.top.location.href = json.redirect;
        }
    }
    catch (e) {
        // json parse failed, so it is a simple chunk of html

        BXFormPosting = false;
        BX('order_form_content').innerHTML = res;
    }

    BX.closeWait();
    BX.onCustomEvent(orderForm, 'onAjaxSuccess');
}

$(document).on('click', '.maps-button', function () {

		
		

		$('.maps-back').css({'display':'none'});
	


		
	});	
