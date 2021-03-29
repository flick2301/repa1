$(document).ready(function() {
	
$(document).on('click', '.callback-formblock .callback-formblock-consent input[type=checkbox]', function(){
	if ($(this).is(':checked')){
		$(this).parent().parent().children('.callback-formblock .callback-formblock-submit').addClass('active');
	} else {
		$(this).parent().parent().children('.callback-formblock .callback-formblock-submit').removeClass('active');
	}
});

$(document).on('click', '.callback-formblock .callback-formblock-submit', function(e) { //Поиск заказов
	//if ($(this).hasClass('active')) $('form[name=' + $(this).attr('rel') + ']').trigger('submit')
	//e.preventDefault();
});

$('form[name=SIMPLE_FORM_1]').submit(function(e) { //Сохранение формы


    $.ajax({
        url: $(this).attr("action"),
        data: $(this).serialize() + '&web_form_submit=true',
        type: 'post',
         /*dataType: "json",*/
		beforeSend: function() {
			//$("#load").show();
		},	 
         success: function (data) {
			var errors = $(data).find('.callback-formblock .callback-formblock-description .callback-formblock-errortext');

			if ($(errors).html()) {
				$('.callback-formblock .callback-formblock-description p').html($(errors).get(0).outerHTML);
			}
			else {
				$('.callback-formblock-description-title').html('Мы скоро Вам перезвоним!');
				setTimeout(function() {window.location.href = window.location.href}, 2000);
			}
         },
         error: function (data) {
            //$("#errors").html('Ошибка на сервере! ' + data);
         },
		 complete: function() {
			//$("#load").hide();
		},	 
    });
	  
	  e.preventDefault();
});	



});