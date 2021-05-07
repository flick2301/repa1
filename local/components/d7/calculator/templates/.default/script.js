$(document).ready(function() {
	$(document).on('keyup', '#mass-widget__count', function(e) {
		$(this).val($(this).val().replace(/[^0-9]/, ""));
		var weight = $(this).val() * $('#mass-widget__weight').val();
		
		
		if (weight > 0.01) weight = weight.toFixed(3);
		else weight = weight.toFixed(5);
		
		$('#mass-widget__result').val(weight);
	});
	

	$(document).on('keyup', '#mass-widget__result', function(e) {
		$(this).val($(this).val().replace(/[^0-9\.]/, ""));
		var count = $(this).val() / $('#mass-widget__weight').val();
		
		
		count = count.toFixed();
		
		
		$('#mass-widget__count').val(count);
	});
	
	

	
	$(document).on('change', '#mass-widget__form select', function() {
		if ($(this).hasClass('mass-widget-loader-select-type')) $('#mass-widget__form select').each(function(index, el) {
			if(!$(el).hasClass('mass-widget-loader-select-type')) $(el).val('');
		});
		$('#mass-widget__form').submit();
	});
	
	
	
	$('#mass-widget-cleaner').click(function() {
		$('#mass-widget__form select').each(function(index, el) {
			$(el).val('');
			$('#mass-widget__form').submit();
		});
	});
	
	
$('#mass-widget__form').submit(function(e) { //Отправка формы заказа

      $.ajax({
         url: '/ajax/calculator.php',
         data: $(this).serialize(),
         type: 'post',
         /*dataType: "json",*/
		beforeSend: function() {
			//$("#load").css("display", "block");
		},	 
         success: function (data) {
			//$("#errors_log").html(data
			var formdata = $(data).find('#mass-widget__form');
			$('#mass-widget__form').html($(formdata).html());
         },
         error: function (data) {
            //$(".orders_list tbody").html("<tr><td class=\"nodata\" colspan=\"11\">Ошибка на сервере! " + data + "</td></tr>");
         },
		 complete: function() {
			//$("#load").css("display", "none");
		},	 
      });

e.preventDefault();
});	
});


