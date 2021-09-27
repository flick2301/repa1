$(document).ready(function() {
	$(document).on('click', '#sidebar__manager-title', function() {
		if (!$(this).parent('.sidebar__manager').hasClass('active')) $(this).parent('.sidebar__manager').addClass('active');
		else $(this).parent('.sidebar__manager').removeClass('active');
	});
});