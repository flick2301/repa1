$(document).ready(function() {
	$(document).on('click', '#view_wholesale', function() {
	if($('div').is('#desc')) {	
		$('.product-tabs__toggle').attr('aria-selected', false); 
		$('#tabby-toggle_description_wholesale').attr('aria-selected', true); 
		$('.product-page__section').attr('hidden', 'hidden'); 
		$('#description_wholesale').attr('hidden', false); 
		element = document.getElementById('desc');
		element.scrollIntoView(true);
	}
	else window.open('/vashi_skidki/', '_blank');
	});
	if($(':checkbox:checked').length)
		window.scrollTo(0, $(".bx-filter-section").offset().top);
	
$(document).on('click', '#catalog-card_goto-video', function() {
		$('.product-tabs__toggle').attr('aria-selected', false); 
		$('#tabby-toggle_description_youtube').attr('aria-selected', true); 
		$('.product-page__section').attr('hidden', 'hidden'); 
		$('#description_youtube').attr('hidden', false); 
		element = document.getElementById('desc');
		element.scrollIntoView(true);
	});	
	
});