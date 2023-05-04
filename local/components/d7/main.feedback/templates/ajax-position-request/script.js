$(document).ready(function() {

$('#position-request input[required], #position-request textarea[required]').keyup(function() {	
	var correct = true;
	
$('#position-request input[required], #position-request textarea[required]').each(function(index,value){
	if(!$(value).val()) correct = false;
});
console.log(correct);
	if (correct) $('#position-request .main-button').removeClass('disable');
	else $('#position-request .main-button').addClass('disable');
});
	
$('#position-request').submit(function(e) {	

$('#position-request .send-a-request__form-errors').hide();
$('#position-request .send-a-request__form-reuslt').hide();

$('#position-request input[required], #position-request textarea[required]').each(function(index,value){
	if(!$(value).val()) $(value).addClass('input-alert');
});

$('#position-request input[required], #position-request textarea[required]').click(function(){
	$(this).removeClass('input-alert');
	$('#position-request .send-a-request__form-errors').hide();
});

	     $.ajax({
         url: $(this).attr('action'),
         data: $(this).serialize(),
         type: 'post',
         /*dataType: 'json',*/
		beforeSend: function() {
			//$('#load').show();
		},	 
         success: function (data) { 

			var result = $(data).find('#position-request .header-form-feedback');
			var error = $(data).find('#position-request .header-form-feedback .errortext');

			if ($(error).html()) {
				console.log($(error).html());
				$('#position-request .send-a-request__form-errors').html('Ошибка отправки данных');
				$('#position-request .send-a-request__form-errors').show();				
			}
			else {
				//$('#position-request .send-a-request__form-result').html($(result).html());
				//$('#position-request .send-a-request__form-result').show();
				yaCounter29426710.reachGoal('SendMessage');
				dataLayerSendForm();
				$('.basic-layout__module.basic-layout__module--request.send-a-request').html($('.send-a-request_success_block').html());
			}

			//else window.location.href = window.location.href;
         },
         error: function (data) {
            $('#position-request .send-a-request__form-errors').html('Ошибка на сервере!');
			$('#position-request .send-a-request__form-errors').show();
			console.log(data);
         },
		 complete: function() {
			//$('#load').hide();
		},	 
      });
      e.preventDefault();
});	  
});