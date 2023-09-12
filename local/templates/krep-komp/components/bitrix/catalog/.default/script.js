BX.ready(function () {

$('.unavailable_pickup').click(function () {
        //$('#unavailable-window').slideDown(0);
             



    });
	$('.win').on('click', function(e){
		if(e.target.id=='close') {
			$('#unavailable-window').slideUp(0);
		}
	});
});