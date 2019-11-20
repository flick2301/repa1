<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?><?$APPLICATION->IncludeComponent(
	"bitrix:search.title",
	"",
	Array(
		"CATEGORY_0" => array("no"),
		"CATEGORY_0_TITLE" => "",
		"CHECK_DATES" => "N",
		"CONTAINER_ID" => "title-search1",
		"INPUT_ID" => "title-search-input1",
		"NUM_CATEGORIES" => "1",
		"ORDER" => "date",
		"PAGE" => "#SITE_DIR#search/index.php",
		"SHOW_INPUT" => "Y",
		"SHOW_OTHERS" => "N",
		"TOP_COUNT" => "5",
		"USE_LANGUAGE_GUESS" => "Y"
	)
);?>

<?$APPLICATION->IncludeComponent(
	"idf:slider", 
	".default", 
	array(
		"IBLOCK_TYPE" => "banners",
		"IBLOCK_ID" => "6",
		"width" => "1020",
		"height" => "360",
		"effect" => "fold",
		"slices" => "21",
		"animSpeed" => "800",
		"pauseTime" => "8000",
		"startSlide" => "0",
		"directionNav" => "N",
		"controlNav" => "N",
		"pauseOnHover" => "Y",
		"text_title" => "",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>