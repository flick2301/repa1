$(document).ready(function() {
	$('.level').has('.level').addClass('subsection');
	
	$(document).on('click', '.user_sitemap .subsection span', function() {
		if($(this).hasClass('open')) {
			$(this).removeClass('open');
			$(this).parent().children('.level').hide();
		}
		else {
			$(this).addClass('open');
			$(this).parent().children('.level').show(300);
		}
	});
});