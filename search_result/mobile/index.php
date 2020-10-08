<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Результаты поиска");
?>

<div id="krep_search">
	<div class="search">
<?$APPLICATION->IncludeComponent(
	"webcreature:dsearch.ajax", 
	"mobile", 
	array(
		"CATEGORY" => array(
			0 => "0",
		),
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "catalog",
		"IN_CATEGORY" => "Y",
		"SEARCH_VARIABLE" => "result",
		"DESCRIPTION_LEN" => "70",
		"COMPONENT_TEMPLATE" => "mobile",
		"ARTNO" => "artikul",
		"SIZE" => "8",
		"STAT" => "Y",
		"STAT_LIMIT" => "10000",		
	),
	false
);?>
</div>	
</div>

<div class="clear"></div>

<br /><br />
<br /><br />
<?$APPLICATION->IncludeComponent(
	"webcreature:dsearch", 
	"krep-komp", 
	array(
		"CATEGORY" => array(
			0 => "0",
		),
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "catalog",
		"IN_CATEGORY" => "Y",
		"ON_PAGE" => "N",
		"ALTER_PAGINATION" => "Y",
		"SEARCH_VARIABLE" => "result",
		"REQUEST" => "",
		"ELEMENT_PAGE_TITLE" => "Y",
		"DESCRIPTION_LEN" => "250",
		"COMPONENT_TEMPLATE" => "krep-komp",
		"ARTNO" => "artikul",
		"PAGE_SIZE" => "20",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "Y",
		"PAGER_TEMPLATE" => "visual",
		"PAGER_TITLE" => "",
		"STAT" => "Y",
		"STAT_LIMIT" => "10000",		
	),
	false
);?>
<br /><br />

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>