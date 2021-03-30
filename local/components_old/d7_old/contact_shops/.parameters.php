<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc;

if (!CModule::IncludeModule("iblock")) return;

//$arTypesEx = CIBlockParameters::GetIBlockTypes(Array("-"=>" "));

$arTypesEx[0] = $arIBlocks[0] = Loc::getMessage("SHOPS_NOT_SELECTED");
$arSections[0] = Loc::getMessage("SHOPS_ALL");

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
}


	 
	$arComponentParameters = array(
	"GROUPS" => Array(
		"SETTING" => Array("NAME" => Loc::getMessage("SHOPS_SETTING"), "SORT" => "200"),
	),	
	"PARAMETERS" => Array(
			"IBLOCK_TYPE" => Array(
			"PARENT" => "BASE",
			"NAME" => Loc::getMessage("SHOPS_TYPE_IBLOCK"),
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx,
			"DEFAULT" => "0",
			"REFRESH" => "Y",
		),
			"IBLOCK_ID" => Array(
			"PARENT" => "BASE",
			"NAME" => Loc::getMessage("SHOPS_ID_IBLOCK"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"DEFAULT" => "0",
			"REFRESH" => "Y",
		),
	        'SECTION_ID' => Array(
			"PARENT" => "SETTING",
			"NAME" => Loc::getMessage("SHOPS_SECTION"),
			"TYPE" => "LIST", "MULTIPLE"=>"Y",
			"VALUES" => $arSections,
			"DEFAULT" => "0",
			"COLS" =>25,
			"SIZE" =>30,
			"ADDITIONAL_VALUES"=>"N",
			"REFRESH" => "Y",
		), 
	    ),
	'CACHE_TIME'  =>  array('DEFAULT'=>3600),	
	);
?>