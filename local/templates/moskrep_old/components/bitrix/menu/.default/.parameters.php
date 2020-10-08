<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

if (!Loader::includeModule('iblock'))
	return;
$boolCatalog = Loader::includeModule('catalog');

$dbIBlockType = CIBlockSection::GetList(array('SORT' => 'ASC'), array('IBLOCK_ID'=>CATALOG_IBLOCK_ID, 'SECTION_ID'=>false));
  

while ($arIBlockType = $dbIBlockType->GetNext())
{
   
      $arIblockType[$arIBlockType["ID"]] = "[".$arIBlockType["ID"]."] ".$arIBlockType["NAME"];
}

$arTemplateParameters["VIBOR_CATALOG_TABLE"] = array(
         "PARENT" => "SETTINGS",
         "NAME" => 'Разделы которые не видны в меню',
         "TYPE" => "LIST",
         "MULTIPLE"=>"Y",
         "ADDITIONAL_VALUES" => "Y",
         "VALUES" => $arIblockType,
         "REFRESH" => "Y"
		
	);
?>