<?php
// подключаем пространство имен класса HighloadBlockTable и даём ему псевдоним HLBT для удобной работы
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
// id highload-инфоблока
const MY_HL_BLOCK_ID = 3;
//подключаем модуль highloadblock
CModule::IncludeModule('highloadblock');
//Напишем функцию получения экземпляра класса:
function GetEntityDataClass($HlBlockId) {
    if (empty($HlBlockId) || $HlBlockId < 1)
    {
        return false;
    }
    $hlblock = HLBT::getById($HlBlockId)->fetch();   
    $entity = HLBT::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();
    return $entity_data_class;
}


$entity_data_class = GetEntityDataClass(MY_HL_BLOCK_ID);
$rsData = $entity_data_class::getList(array(
   'select' => array('*')
));
$el = $rsData->fetch();
$arResult['SALE_PRICE_DATE'] = $el['UF_DATE'];
$arResult['SALE_PRICE_FILE'] = CFile::GetPath($el['UF_FILE']);

$rsSites = CSite::GetByID("s1");
$arSite = $rsSites->Fetch();
$arResult["SITE_EMAIL"] = $arSite['EMAIL'];



$res = CIBlockSection::GetByID($arResult["ORIGINAL_PARAMETERS"]["SECTION_ID"]);
$ar_res = $res->GetNext();
$arResult["OVER_URL"]=$ar_res["SECTION_PAGE_URL"];




foreach($arResult['ITEMS'] as $key => $item){
    
    $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL");
    $arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "ID"=>$item['ID']);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    $arRes = $res->GetNext();
    $arResult['ITEMS'][$key]["DETAIL_PAGE_URL"]=$arRes['DETAIL_PAGE_URL'];
    
    
    
}