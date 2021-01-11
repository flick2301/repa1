$(document).ready(function() {
	$('body').click(function() {
		$(".moskrep_search #text_result" ).css("display", "none");
	})
	
	var timerId;

	$('.moskrep_search .moskrep_input').keyup(function(event) {
		var search=$('.moskrep_search .moskrep_input').val();
		search=search.replace(/[^0-9A-ßà-ÿ¸¨úA-Za-z\-_ :\%\$\&\*\.\,]+/, '');
		search=search.replace(/^[ \-_:\%\$\&\*\.\,]+/, ''); 
	    $('.moskrep_search .moskrep_input').val(search);
		
		if (search.length>2) {
			if (event.keyCode==13) send_request(search);
			else clearTimeout(timerId);
			timerId = setTimeout(function() {get_ajax(search);}, 1000);  		
		}
else $(".moskrep_search #text_result" ).css("display", "none");		
	})
	
$('.moskrep_search .moskrep_submit').click(function() {
	var search=$('.moskrep_search .moskrep_input').val();
	if (search.length>2) send_request(search);
});

function send_request(search) {
	window.location.href="/search_result/?" + BX.message('SEARCH_VARIABLE') + "=" + search;
}

function get_ajax(search){
			$.post(BX.message('TEMPLATE_URL') + "/ajax/search.php", {search: search, size: BX.message('SIZE'), artno: BX.message('ARTNO'), template: BX.message('COMPONENT_TEMPLATE'), description: BX.message('DESCRIPTION_LEN'), variable: BX.message('SEARCH_VARIABLE'), incategory: BX.message('IN_CATEGORY'), iblock: BX.message('IBLOCK_TYPE'), iblockid: BX.message('IBLOCK_ID'), stat: BX.message('STAT'), statlimit: BX.message('STAT_LIMIT'), category: BX.message('CATEGORY')}, function(data) {
		$(".moskrep_search #text_result" ).css("display", "block");
 			if (!data.match(/error/)) $(".moskrep_search #text_result" ).html(data);
			else $(".moskrep_search #text_result" ).css("display", "none");		
			});	

}	
});
