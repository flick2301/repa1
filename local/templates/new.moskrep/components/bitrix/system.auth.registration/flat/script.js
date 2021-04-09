$(document).ready(function(){
	$('#user-account__email').keyup(function() {
		$('#user-account__login').val($(this).val());
	});
});