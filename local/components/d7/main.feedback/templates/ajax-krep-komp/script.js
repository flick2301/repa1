$(document).ready(function() {

$('#feedback_form input[required], #feedback_form textarea[required]').keyup(function() {	
	var correct = true;
	
$('#feedback_form input[required], #feedback_form textarea[required]').each(function(index,value){
	if(!$(value).val()) correct = false;
});
console.log(correct);
	if (correct) $('#feedback_form .main-button').removeClass('disable');
	else $('#feedback_form .main-button').addClass('disable');
});
	
$('#feedback_form').submit(function(e) {	

$('#feedback_form .send-a-request__form-errors').hide();
$('#feedback_form .send-a-request__form-reuslt').hide();

$('#feedback_form input[required], #feedback_form textarea[required]').each(function(index,value){
	if(!$(value).val()) $(value).addClass('input-alert');
});

$('#feedback_form input[required], #feedback_form textarea[required]').click(function(){
	$(this).removeClass('input-alert');
	$('#feedback_form .send-a-request__form-errors').hide();
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

			var result = $(data).find('#feedback_form .header-form-feedback');
			var error = $(data).find('#feedback_form .header-form-feedback .errortext');

			if ($(error).html()) {
				$('#feedback_form .send-a-request__form-errors').html('Ошибка отправки данных');
				$('#feedback_form .send-a-request__form-errors').show();				
			}
			else {
				//$('#feedback_form .send-a-request__form-result').html($(result).html());
				//$('#feedback_form .send-a-request__form-result').show();
				yaCounter29426710.reachGoal('SendMessage');
				dataLayerSendForm();
				$('.basic-layout__module.basic-layout__module--request.send-a-request').html($('.send-a-request_success_block').html());
			}

			//else window.location.href = window.location.href;
         },
         error: function (data) {
            $('#feedback_form .send-a-request__form-errors').html('Ошибка на сервере!');
			$('#feedback_form .send-a-request__form-errors').show();
			console.log(data);
         },
		 complete: function() {
			//$('#load').hide();
		},	 
      });
      e.preventDefault();
});	  
});