<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?>
<script type="text/javascript" src="http://map.krep-komp.ru/js/script.js"></script>
<script>
$(document).ready(function() {
	var result = deliveryCost.init({
		lat: 55.703634,
		lon: 38.215568,
		weight: 10,
		price: 10000,
		delivery_id: 2,
		key: '77b63f2d-9cc1-11ea-aaaf-00259031639a',
	});
	
alert(JSON.stringify(result));
/*result.then(function (datums) {
	let result = JSON.parse(datums);
	if (typeof result === 'object') {
		alert(result.area.name);
	}
})*/
});
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>