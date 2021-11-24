$(document).ready(function() {

		
    
		$('#geolocation, .geolocation_link, #geolocation .box-modal__head .popUp-close, #geolocation .white-btn').click(function() {
			//$('#geolocation').slideToggle(0);
			//return false;
		});
		
		$('#geolocation, .geolocation_link, #geolocation .box-modal__head .popUp-close, #geolocation .white-btn').click(function() {
			$('#geolocation').slideDown(0);
			return false;
		});		
		
		$('.geo .popUp-close').click(function() {
			$('#geolocation').slideUp(0);
			return false;
		});	

		

		$('#geolocation').on('click', 'li', function(e) {
			
			$.cookie("geo_text", null);
			$.cookie("geo_id", null);
			$.cookie("geo_text", $(this).attr('rel'),{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
			$.cookie("geo_id", $(this).data().value,{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
			
			//console.log($(this).data());
			window.location.href = 'https://'+$(this).data().domain+location.pathname;
      
			$('#geolocation').slideToggle(0);
			return false; 
		});



	$(document).on('keyup', '#input_geoitem', function(event) {
		
	var search = $(this).val();	
	getResult = false;
	var timerId;
		
		if (search.length >= 2) {
			if (event.keyCode==13) getGeoAjax(search);
			else clearTimeout(timerId);
			timerId = setTimeout(function() { getGeoAjax(search); }, 500);  		
		}
		else {
			$('#result_geo_items').hide();
			$('#result_geo_items').html('');
		}	
	});	

});

function getGeoAjax(search) { 
	$.ajax({
		async: false,
		url: url,
		type: 'POST',
		data: {city: search, iblock_id: iblock_id},
		dataType: 'html',
		success: function(data) {
			if (data) {
				$('#result_geo_items').slideDown(300);
				$('#result_geo_items').html(data);
			}
			else {
				$('#result_geo_items').hide();
				$('#result_geo_items').html('');
			}	
        },
		error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
      }		
	});
}