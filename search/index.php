<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");
?>

<?$APPLICATION->IncludeComponent(
	"d7:search.page",
	"",
	Array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"IBLOCK_ID" => "17",
		"IBLOCK_TYPE" => "catalog",
		"ITEMS_PREV_PIC_H" => "100",
		"ITEMS_PREV_PIC_W" => "100",
		"USE_REVIEW" => "N"
	)
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>