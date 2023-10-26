BX.ready(function(){
	
	

$('#position-request input[required], #position-request textarea[required]').keyup(function() {	
	var correct = true;
	
$('#position-request input[required], #position-request textarea[required]').each(function(index,value){
	if(!$(value).val()) correct = false;
});
console.log(correct);
	if (correct) $('#position-request .main-button').removeClass('disable');
	else $('#position-request .main-button').addClass('disable');
});
	
$('.phone_submit_button').click(function(e) {	
	
	$('#phone-request .send-a-request__form-errors').hide();
	$('#phone-request .send-a-request__form-reuslt').hide();

	$('#phone-request input[required], #position-request textarea[required]').each(function(index,value){
		if(!$(value).val()) $(value).addClass('input-alert');
	});

	$('#phone-request input[required], #phone-request textarea[required]').click(function(){
		$("#phone-request").removeClass('input-alert');
		$('#position-request .send-a-request__form-errors').hide();
	});

	     $.ajax({
         url: '/ajax/callback.php',
         data: $("#phone-request").serialize(),
         type: 'post',
         /*dataType: 'json',*/
		beforeSend: function() {
			//$('#load').show();
		},	 
         success: function (data) { 
			$('.basic-layout__module.basic-layout__module--request.send-a-request').html($('.send-a-request_success_block').html());
			setTimeout(function() {
				$('.callback_form').hide();
				$('.callback_form').popUp('close');
			}, 1000);
			
			var result = $(data).find('#phone-request .header-form-feedback');
			var error = $(data).find('#phone-request .header-form-feedback .errortext');

			if ($(error).html()) {
				console.log($(error).html());
				$('#phone-request .send-a-request__form-errors').html('Ошибка отправки данных');
				$('#phone-request .send-a-request__form-errors').show();				
			}
			else {
				//$('#position-request .send-a-request__form-result').html($(result).html());
				//$('#position-request .send-a-request__form-result').show();
				
				$('.basic-layout__module.basic-layout__module--request.send-a-request').html($('.send-a-request_success_block').html());
			}

			//else window.location.href = window.location.href;
         },
         error: function (data) {
            $('#phone-request .send-a-request__form-errors').html('Ошибка на сервере!');
			$('#phone-request .send-a-request__form-errors').show();
			console.log(data);
         },
		 complete: function() {
			//$('#load').hide();
		},	 
      });
      e.preventDefault();
});	  
});
