<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Результаты поиска");
?>

<?$APPLICATION->IncludeComponent(
	"webcreature:dsearch", 
	"krep-komp_module", 
	array(
		"ALTER_PAGINATION" => "Y",
		"ALT_NAME" => "",
		"ARTNO" => "CML2_ARTICLE",
		"CATEGORY" => array(
			0 => "0",
		),
		"COMPONENT_TEMPLATE" => "krep-komp_module",
		"DESCRIPTION_LEN" => "500",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_PAGE_TITLE" => "N",
		"IBLOCK_ID" => "17",
		"IBLOCK_TYPE" => "catalog",
		"IN_CATEGORY" => "Y",
		"ON_PAGE" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "",
		"PAGE_SIZE" => "20",
		"REQUEST" => "",
		"SEARCH_VARIABLE" => "result",
		"STAT" => "Y",
		"STAT_LIMIT" => "10000"
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>