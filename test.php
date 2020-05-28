<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?><?$APPLICATION->IncludeComponent(
	"g-tech:yandexiblockmap", 
	"krep-komp", 
	array(
		"ADDR_PROP_ID" => "193",
		"CONTROLS" => array(
			0 => "TOOLBAR",
			1 => "ZOOM",
			2 => "MINIMAP",
			3 => "TYPECONTROL",
			4 => "SCALELINE",
		),
		"DIPLAY_PREVIEW_PICTURE" => "N",
		"DISPLAY_ITEM_LIST" => "Y",
		"IBLOCK_ID" => "19",
		"IBLOCK_TYPE" => "shops",
		"INCLUDE_FANCYBOX" => "N",
		"INIT_MAP_TYPE" => "MAP",
		"ITEM_LIST_ROW_COUNT" => "10",
		"KEY" => "e42a471e-bc80-4836-8f3b-af2ca212b91b",
		"MAP_HEIGHT" => "500",
		"MAP_ID" => "shop_map",
		"MAP_LAT_CODE" => "196",
		"MAP_LON_CODE" => "195",
		"MAP_WIDTH" => "600",
		"MARK_PROP_ID" => "190",
		"OPTIONS" => array(
			0 => "ENABLE_SCROLL_ZOOM",
			1 => "ENABLE_DBLCLICK_ZOOM",
			2 => "ENABLE_DRAGGING",
		),
		"PLACEICON" => "/upload/medialibrary/c98/c98a6722c4cff5d594a0bf0602f55713.png",
		"PLAN_PROP_ID" => "192",
		"TEMPLATE_EDIT" => "plain#whitePoint",
		"COMPONENT_TEMPLATE" => "krep-komp"
	),
	false
);?>

<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>