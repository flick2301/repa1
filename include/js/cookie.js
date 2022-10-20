$(document).ready(function() {
	$(document).on('click', '#use_cookie', function() {
	$('.cookie').hide();	
	var expire = new Date();
	expire.setHours(expire.getHours() + 24*30*12*3);
		document.cookie = "use_cookie=true;expires=" + expire.toUTCString() + ";path=/;";
	});
});