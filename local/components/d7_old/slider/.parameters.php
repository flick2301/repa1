<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arCurrentValues */

if(!CModule::IncludeModule("iblock"))
	return;
$arTypesEx = CIBlockParameters::GetIBlockTypes(Array("-"=>" "));

$arIBlocks=Array();
$db_iblock = CIBlock::GetList(Array("SORT"=>"ASC"), Array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:"")));
while($arRes = $db_iblock->Fetch())
	$arIBlocks[$arRes["ID"]] = $arRes["NAME"];
	
$effect = array("fold" => GetMessage("IDF_JUSTSLIDER_SKLADYVANIE"), "fade" => GetMessage("IDF_JUSTSLIDER_ZATUHANIE"), "sliceDown" => GetMessage("IDF_JUSTSLIDER_PADENIE"), "boxRainGrow" => GetMessage("IDF_JUSTSLIDER_PROSTOE_PEREKLUCENIE"));

$arComponentParameters = array(
	"GROUPS" => array(
		"setting" => array("NAME" => GetMessage("IDF_JUSTSLIDER_DANNYE"), "SORT" => "1"),
		"setting_slider" => array("NAME" => GetMessage("IDF_JUSTSLIDER_PARAMETRY_SLAYDERA"), "SORT" => "2"),
	),
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => Array(
			"PARENT" => "setting",
			"NAME" => GetMessage("IDF_JUSTSLIDER_TIP_INFOBLOKA"),
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx,
			"DEFAULT" => "news",
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => Array(
			"PARENT" => "setting",
			"NAME" => GetMessage("IDF_JUSTSLIDER_INFO_BLOK"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"DEFAULT" => '={$_REQUEST["ID"]}',
			"REFRESH" => "Y",
		),
		"width"	=> Array(
			"PARENT" => "setting_slider",
			"NAME" => GetMessage("IDF_JUSTSLIDER_SIRINA_IZOBRAJENIA"),
			"TYPE" => "STRING",
			"DEFAULT" => "718",
		),
		"height" => Array(
			"PARENT" => "setting_slider",
			"NAME" => GetMessage("IDF_JUSTSLIDER_VYSOTA_IZOBRAJENIA"),
			"TYPE" => "STRING",
			"DEFAULT" => "246",
		),
		"effect" => Array(
			"PARENT" => "setting_slider",
			"NAME" => GetMessage("IDF_JUSTSLIDER_TIP_EFFEKTA"),
			"TYPE" => "LIST",
			"VALUES" => $effect,
			"DEFAULT" => "fade",
			"REFRESH" => "Y",
		),
		"slices" => Array(
			"PARENT" => "setting_slider",
			"NAME" => GetMessage("IDF_JUSTSLIDER_KOLICESTVO_LOMTIKOV"),
			"TYPE" => "STRING",
			"DEFAULT" => "6",
		),
		"animSpeed" => Array(
			"PARENT" => "setting_slider",
			"NAME" => GetMessage("IDF_JUSTSLIDER_VREMA_ANIMACII"),
			"TYPE" => "STRING",
			"DEFAULT" => "1300",
		),
		"pauseTime" => Array(
			"PARENT" => "setting_slider",
			"NAME" => GetMessage("IDF_JUSTSLIDER_VREMA_PAUZY"),
			"TYPE" => "STRING",
			"DEFAULT" => "4000",
		),
		"startSlide" => Array(
			"PARENT" => "setting_slider",
			"NAME" => GetMessage("IDF_JUSTSLIDER_NACINATQ_SO_SLAYDA"),
			"TYPE" => "STRING",
			"DEFAULT" => "0",
		),
		"directionNav" => Array(
			"PARENT" => "setting_slider",
			"NAME" => GetMessage("IDF_JUSTSLIDER_OTOBRAJATQ_KNOPKI_VP"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"controlNav" => Array(
			"PARENT" => "setting_slider",
			"NAME" => GetMessage("IDF_JUSTSLIDER_OTOBRAJATQ_NAVIGACIU"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"pauseOnHover" => Array(
			"PARENT" => "setting_slider",
			"NAME" => GetMessage("IDF_JUSTSLIDER_OSTANAVLIVATQ_ANIMAC"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"text_title" => Array(
			"PARENT" => "setting_slider",
			"NAME" => GetMessage("IDF_JUSTSLIDER_ZAGOLOVOK_IZOBRAJENI"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
		)
		
	),
);



?>
