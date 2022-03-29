$(document).ready(function(){
	$(document).on('click', 'div[data-cat]', function() {
			$('div[data-cat]').removeClass('active');
			
			$($('div[data-cat=' + $(this).attr('data-cat') + ']')).addClass('active');

		if ($(this).attr('data-cat')!='all') {
			$('.dsearch_result_items__item').hide();
			$('.' + $(this).attr('data-cat')).show();
			$('.dsearch_result_passive').css('display', 'table-row');
			$('.dsearch_result_items__else').hide();
		}
		else { 
			$('.dsearch_result_items__item').show();
			$('.dsearch_result_passive').css('display', 'none');
			$('.dsearch_result_items__else').show();
		}
	});
});