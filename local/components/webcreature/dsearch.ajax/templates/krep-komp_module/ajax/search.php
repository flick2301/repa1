<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?php 
$search = htmlspecialcharsEx($_POST['search']);
$search = iconv("UTF-8", "WINDOWS-1251", $search);
$arParams["SIZE"] = htmlspecialcharsEx($_POST['size']);
$arParams["ARTNO"] = htmlspecialcharsEx($_POST['artno']);
$arParams["COMPONENT_TEMPLATE"] = htmlspecialcharsEx($_POST['template']);
$arParams["DESCRIPTION_LEN"] = htmlspecialcharsEx($_POST['description']);
$arParams["SEARCH_VARIABLE"] = htmlspecialcharsEx($_POST['variable']);
$arParams["IN_CATEGORY"] = htmlspecialcharsEx($_POST['incategory']);
$arParams["IBLOCK_TYPE"] = htmlspecialcharsEx($_POST['iblock']);
$arParams["IBLOCK_ID"] = htmlspecialcharsEx($_POST['iblockid']);
$arParams["STAT"] = htmlspecialcharsEx($_POST['stat']);
$arParams["STAT_LIMIT"] = htmlspecialcharsEx($_POST['statlimit']);
$arParams["CATEGORY"] = htmlspecialcharsEx($_POST['category']);

if (stristr(LANG_CHARSET, "utf") && strstr(LANG_CHARSET, "8")) $search = iconv("windows-1251", "UTF-8", $search);
?>

<?if (CModule::IncludeModule("iblock")):?>

<?$APPLICATION->IncludeComponent(
	"webcreature:dsearch", 
	"krep-komp_module", 
	array(
		"CATEGORY" => array(
			0 => "0",
		),
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IN_CATEGORY" => $arParams["IN_CATEGORY"],
		"ON_PAGE" => "N",
		"ALTER_PAGINATION" => "Y",
		"SEARCH_VARIABLE" => $arParams["SEARCH_VARIABLE"],
		"REQUEST" => $search,
		"ELEMENT_PAGE_TITLE" => "Y",
		"DESCRIPTION_LEN" => $arParams["DESCRIPTION_LEN"],
		"COMPONENT_TEMPLATE" => $arParams["COMPONENT_TEMPLATE"],
		"ARTNO" => $arParams["ARTNO"],
		"PAGE_SIZE" => $arParams["SIZE"],
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "",
		"STAT" => $arParams["STAT"],
		"STAT_LIMIT" => $arParams["STAT_LIMIT"]		
	),
	false
);?>

<?endif?>