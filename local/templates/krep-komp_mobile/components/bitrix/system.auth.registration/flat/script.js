$(document).ready(function(){
	$('#user-account__email').keyup(function() {
		$('#user-account__login').val($(this).val());
	});
	
	$('#user-account__name').keyup(function() {
		var trimmedString = $(this).val().substring(0, 15);
		$(this).val(trimmedString.replace(/[^А-Яа-я]+/, ''));
	});	
	
	$('#user-account__lastname').keyup(function() {
		var trimmedString = $(this).val().substring(0, 25);
		$(this).val(trimmedString.replace(/[^А-Яа-я]+/, ''));
	});		
});