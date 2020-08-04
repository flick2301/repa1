<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?>



<?$APPLICATION->IncludeComponent(
	"d7:slider_new", 
	".default", 
	array(
		"IBLOCK_TYPE" => "banners",
		"IBLOCK_ID" => "6",
		"width" => "904",
		"height" => "290",
		"effect" => "fold",
		"slices" => "21",
		"animSpeed" => "800",
		"pauseTime" => "8000",
		"startSlide" => "0",
		"directionNav" => "N",
		"controlNav" => "Y",
		"pauseOnHover" => "Y",
		"text_title" => "",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>