$(document).ready(function() {
	$(document).on('click', 'body', function() {
		$("#text_result" ).css("display", "none");
	})
	
	var timerId;

	$(document).on('keyup', '.moskrep-search .moskrep_input', function(event) {
		var search=$('.moskrep-search .moskrep_input').val();
		search=search.replace(/[^0-9A-ßà-ÿ¸¨úA-Za-z\-_ :\%\$\&\*\.\,]+/, '');
		search=search.replace(/^[ \-_:\%\$\&\*\.\,]+/, ''); 
	    $('.moskrep-search .moskrep_input').val(search);
		
		if (search.length>2) {
			if (event.keyCode==13) send_request(search);
			else clearTimeout(timerId); 
			timerId = setTimeout(function() {get_ajax(search);}, 1000);  		
		}
else $("#text_result" ).css("display", "none");		
	})
	
$(document).on('click', '.moskrep-search .moskrep_submit', function() { 
	var search=$('.moskrep-search .moskrep_input').val();
	if (search.length>2) send_request(search);
});

function send_request(search) {
	window.location.href="/search_result/?" + BX.message('SEARCH_VARIABLE') + "=" + search;
}

function get_ajax(search){
			$.post(BX.message('TEMPLATE_URL') + "/ajax/search.php", {search: search, size: BX.message('SIZE'), artno: BX.message('ARTNO'), template: BX.message('COMPONENT_TEMPLATE'), description: BX.message('DESCRIPTION_LEN'), variable: BX.message('SEARCH_VARIABLE'), incategory: BX.message('IN_CATEGORY'), iblock: BX.message('IBLOCK_TYPE'), iblockid: BX.message('IBLOCK_ID'), stat: BX.message('STAT'), statlimit: BX.message('STAT_LIMIT'), category: BX.message('CATEGORY')}, function(data) {  
				
			$("#text_result" ).css("display", "block");		
		
 			if (!data.match(/error/)) $("#text_result" ).html(data);
			else $("#text_result" ).css("display", "none");		
			});	

}	
});
