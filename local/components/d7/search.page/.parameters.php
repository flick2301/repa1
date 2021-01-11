<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock=array();
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
{
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}






$arComponentParameters = array(
	
		
		
		
	
	"PARAMETERS" => array(
		
		
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => "IBLOCK_TYPE",
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => "IBLOCK_ID",
			"TYPE" => "LIST",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
			"ADDITIONAL_VALUES" => "Y",
		),
		"USE_REVIEW" => Array(
			"PARENT" => "REVIEW_SETTINGS",
			"NAME" => GetMessage('USE_REVIEW'),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"REFRESH" => "Y",
		),
		
		
		
		
		
		
		
		
		"CACHE_TIME"  =>  Array("DEFAULT"=>36000000),
            
            
            "ITEMS_PREV_PIC_H" => array(
		"NAME" => GetMessage('ITEMS_PREV_PIC_H'),
		"TYPE" => "STRING",
		"DEFAULT" => "100",
		
	),
            "ITEMS_PREV_PIC_W" => array(
		"NAME" => GetMessage('ITEMS_PREV_PIC_H'),
		"TYPE" => "STRING",
		"DEFAULT" => "100",
		
	),
	),
);






?>
