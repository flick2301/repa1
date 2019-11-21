<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule("iblock");
$arResult = $arParams;

$arFilter = Array(
	"IBLOCK_ID" => $arParams['IBLOCK_ID'], 
	"ACTIVE"=>"Y"
);
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, Array("ID", "IBLOCK_ID", "PREVIEW_TEXT", "NAME", "PREVIEW_PICTURE", "CODE", "PROPERTY_*"));
while($ob = $res->GetNextElement()){ 
 $i++;
 $ar_fields = $ob->GetFields();  
 $arResult["ITEMS"][$i] = $ar_fields;
 $arProps = $ob->GetProperties();
 $arResult["ITEMS"][$i]["PROPERTIES"] = $arProps;
}

for($i = 0; $i < count($arResult["ITEMS"]); $i++){
$arResult["ITEMS"][$i]["PREVIEW_PICTURE"] = CFile::ResizeImageGet(
            $arResult["ITEMS"][$i]["PREVIEW_PICTURE"],
            array("width" => $arResult["width"], "height" => $arResult["height"]),
            BX_RESIZE_IMAGE_EXACT,
            true,
            array()
        );
	// $arResult["ITEMS"][$i]["PREVIEW_PICTURE"] = CFile::GetPath($arResult["ITEMS"][$i]["PREVIEW_PICTURE"]);
}
?>

<? $this->IncludeComponentTemplate(); ?>