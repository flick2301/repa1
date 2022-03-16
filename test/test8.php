<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?>

<?$APPLICATION->IncludeComponent(
	"webcreature:dsearch.ajax", 
	"krep-komp_module", 
	array(
		"ARTNO" => "CML2_ARTICLE",
		"CATEGORY" => array(
			0 => "0",
		),
		"DESCRIPTION_LEN" => "300",
		"IBLOCK_ID" => "17",
		"IBLOCK_TYPE" => "catalog",
		"IN_CATEGORY" => "Y",
		"SEARCH_VARIABLE" => "result",
		"SIZE" => "8",
		"STAT" => "Y",
		"STAT_LIMIT" => "10000",
		"COMPONENT_TEMPLATE" => "krep-komp_module"
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>