<?
use Bitrix\Main\Loader,
	Bitrix\Main\Localization\Loc,
	Bitrix\Iblock\ElementTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var $APPLICATION CMain
 * @var $USER CUser
 */

Loc::loadMessages(__FILE__);

if (!Loader::includeModule("iblock"))
{
	
	return;
}

class classSlider extends CBitrixComponent
{
	public function executeComponent(){
		if($this->startResultCache())
        {
	    $this->arResult = $this->arParams;

$arFilter = Array(
	"IBLOCK_ID" => $this->arParams['IBLOCK_ID'], 
	"ACTIVE"=>"Y"
);
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"),
                               $arFilter, 
							   Array("ID", "IBLOCK_ID", "IBLOCK_SECTION_ID","PREVIEW_TEXT", "NAME", "PREVIEW_PICTURE", "CODE", "PROPERTY_*"));
							   
							   


while($ar_fields = $res->GetNextElement())
{
	
	$arFields = $ar_fields->GetFields();
	$arFields["PROPERTIES"] = $ar_fields->GetProperties();
	$arFields["PROPERTIES"]["PREVIEW_PICTURE"] = CFile::ResizeImageGet(
            $arFields["PROPERTIES"]["PREVIEW_PICTURE"]['ID'],
            array("width" => $this->arResult["width"], "height" => $this->arResult["height"]),
            BX_RESIZE_IMAGE_EXACT,
            true,
            array()
        );
	$this->arResult["ITEMS"][] = $arFields;
}
         
		$this->IncludeComponentTemplate();
		
		}
	}
}
?>