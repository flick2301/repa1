<?
/**
 * Created by Webcreature.
 * User: Denis Chuchumashev
 * www.webcreature.ru
 * Date: 13.04.2018
 * Time: 9:18
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc;

if (!CModule::IncludeModule("iblock")) return;

//$arTypesEx = CIBlockParameters::GetIBlockTypes(Array("-"=>" "));

$arTypesEx[0] = $arIBlocks[0] = Loc::getMessage("DSEARCH_NOT_SELECTED");
$arSections[0] = Loc::getMessage("DSEARCH_ALL");

$iblockTypes = Bitrix\Iblock\TypeTable::getList(array('select' => array('*', 'LANG_MESSAGE')))->FetchAll(); //Типы инфоблоков
foreach ($iblockTypes AS $val) if ($val["IBLOCK_TYPE_LANG_MESSAGE_LANGUAGE_ID"] == LANGUAGE_ID) $arTypesEx[$val["ID"]] = $val["IBLOCK_TYPE_LANG_MESSAGE_NAME"];


$arCurrentValues["IBLOCK_TYPE"] ? $filter_type = Array('IBLOCK_TYPE_ID' => $arCurrentValues["IBLOCK_TYPE"]) : ""; //Фильтрация по типу инфоблока

$result = \Bitrix\Iblock\IblockTable::getList(Array( 
    'select'  => Array('NAME', 'ID'),
    'filter'  => Array($filter_type)
));

while ($arRes = $result->fetch()) $arIBlocks[$arRes["ID"]] = $arRes["NAME"];


if (0 < intval($arCurrentValues['IBLOCK_ID'])) { //Разделы
	
$result = \Bitrix\Iblock\SectionTable::getList(Array( 
    'select'  => Array('NAME', 'ID'),
    'filter'  => Array('IBLOCK_ID' => $arCurrentValues["IBLOCK_ID"]),
	'order' => Array('NAME' => 'ASC')
));

while ($arRes = $result->fetch()) $arSections[$arRes["ID"]] = $arRes["NAME"];

$result = \Bitrix\Iblock\ElementTable::getList(Array( 
    'select'  => Array('ID', 'IBLOCK_ID', 'NAME'),
    'filter'  => Array('IBLOCK_ID' => $arCurrentValues["IBLOCK_ID"], "ACTIVE" => "Y")
    ));

$arRes = $result->fetch();

$db_props = CIBlockElement::GetProperty($arCurrentValues["IBLOCK_ID"], $arRes["ID"], array("NAME" => "ASC"), Array());

while ($arProps = $db_props->fetch()) {
	$arProperties[$arProps["CODE"]] = $arProps["NAME"];
}	


//Пользовательские свойства
$rsData = CUserTypeEntity::GetList( array("ID"=>"ASC"), Array('ENTITY_ID' => "IBLOCK_".$arCurrentValues["IBLOCK_ID"]."_SECTION"));
while($arRes = $rsData->Fetch())
{
	$arUserProperties[$arRes["FIELD_NAME"]] = $arRes["FIELD_NAME"];
}	
}





$arComponentParameters = Array(
	"GROUPS" => Array(
		"SETTING" => Array("NAME" => Loc::getMessage("DSEARCH_SETTING"), "SORT" => "200"),
	),
	"PARAMETERS" => Array(
			"IBLOCK_TYPE" => Array(
			"PARENT" => "BASE",
			"NAME" => Loc::getMessage("DSEARCH_TYPE_IBLOCK"),
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx,
			"DEFAULT" => "0",
			"REFRESH" => "Y",
		),
			"IBLOCK_ID" => Array(
			"PARENT" => "BASE",
			"NAME" => Loc::getMessage("DSEARCH_ID_IBLOCK"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"DEFAULT" => "0",
			"REFRESH" => "Y",
		),
		    "ON_PAGE" => Array(
		    "PARENT" => "BASE",
			"NAME" => Loc::getMessage("DSEARCH_ON_PAGE"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",	
		),
			"SEARCH_VARIABLE"	=> Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("DSEARCH_VARIABLE"),
			"TYPE" => "STRING",
			"DEFAULT" => "result",
		),
			"REQUEST"	=> Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("DSEARCH_REQUEST"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
		),		
			"CATEGORY" => Array(
			"PARENT" => "SETTING",
			"NAME" => Loc::getMessage("DSEARCH_SECTION"),
			"TYPE" => "LIST", "MULTIPLE"=>"Y",
			"VALUES" => $arSections,
			"DEFAULT" => "0",
			"COLS" =>25,
			"SIZE" =>30,
			"ADDITIONAL_VALUES"=>"N",
			"REFRESH" => "Y",
		),	
			"ALT_NAME" => Array(
			"PARENT" => "SETTING",
			"NAME" => Loc::getMessage("DSEARCH_ALT_NAME"),
			"TYPE" => "LIST", "MULTIPLE"=>"N",
			"VALUES" => $arUserProperties,
			"DEFAULT" => "0",
			"COLS" =>25,
			"SIZE" =>10,
			"ADDITIONAL_VALUES"=>"Y",
			"REFRESH" => "Y",
		),		
			"ARTNO" => Array(
			"PARENT" => "SETTING",
			"NAME" => Loc::getMessage("DSEARCH_ARTNO"),
			"TYPE" => "LIST", "MULTIPLE"=>"N",
			"VALUES" => $arProperties,
			"DEFAULT" => "0",
			"COLS" =>25,
			"SIZE" =>10,
			"ADDITIONAL_VALUES"=>"Y",
			"REFRESH" => "Y",
		),			
		    "IN_CATEGORY" => Array(
		    "PARENT" => "SETTING",
			"NAME" => Loc::getMessage("DSEARCH_IN_CATEGORY"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",	
		),
		    "ELEMENT_PAGE_TITLE" => Array(
		    "PARENT" => "SETTING",
			"NAME" => Loc::getMessage("DSEARCH_ELEMENT_PAGE_TITLE"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",	
		),		
			"DESCRIPTION_LEN"	=> Array(
			"PARENT" => "SETTING",
			"NAME" => GetMessage("DSEARCH_DESCRIPTION_LEN"),
			"TYPE" => "STRING",
			"DEFAULT" => "1000",
		),	
		    "STAT" => Array(
		    "PARENT" => "SETTING",
			"NAME" => Loc::getMessage("DSEARCH_STAT"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",	
		),		
            "STAT_LIMIT"	=> Array(
			"PARENT" => "SETTING",
			"NAME" => GetMessage("DSEARCH_STAT_LIMIT"),
			"TYPE" => "STRING",
			"DEFAULT" => "10000",
		),			
            "PAGE_SIZE"	=> Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("DSEARCH_PAGE_SIZE"),
			"TYPE" => "STRING",
			"DEFAULT" => "20",
		),	
		    "ALTER_PAGINATION" => Array(
		    "PARENT" => "SETTING",
			"NAME" => Loc::getMessage("DSEARCH_ALTER_PAGINATION"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",	
		),		
	),
);

CIBlockParameters::AddPagerSettings(
	$arComponentParameters,
	GetMessage("DSEARCH_PAGER"), //$pager_title
	false, //$bDescNumbering
	false, //$bShowAllParam
	false, //$bBaseLink
	$arCurrentValues["PAGER_BASE_LINK_ENABLE"]==="N" //$bBaseLinkEnabled
);
?>