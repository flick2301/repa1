<?php
// подключаем пространство имен класса HighloadBlockTable и даём ему псевдоним HLBT для удобной работы
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
// id highload-инфоблока
const MY_HL_BLOCK_ID = 3;
const MY_HL_BLOCK_META_ID=7;
//подключаем модуль highloadblock
CModule::IncludeModule('highloadblock');




$entity_data_class = GetEntityDataClass(MY_HL_BLOCK_ID);
$rsData = $entity_data_class::getList(array(
   'select' => array('*')
));
$el = $rsData->fetch();
$arResult['SALE_PRICE_DATE'] = $el['UF_DATE'];
$arResult['SALE_PRICE_FILE'] = CFile::GetPath($el['UF_FILE']);
$arResult['SALE_PRICE_LINK']=$el['UF_SALE_LINK'];

$rsSites = CSite::GetByID("s1");
$arSite = $rsSites->Fetch();
$arResult["SITE_EMAIL"] = $arSite['EMAIL'];



$res = CIBlockSection::GetByID($arResult['ID']);
$ar_res = $res->GetNext();
$arResult["OVER_URL"]=$ar_res["SECTION_PAGE_URL"];




foreach($arResult['ITEMS'] as $key => $item){
    
    $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL");
    $arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "ID"=>$item['ID']);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    $arRes = $res->GetNext();
    $arResult['ITEMS'][$key]["DETAIL_PAGE_URL"]=$arRes['DETAIL_PAGE_URL'];
    
    if(stripos($item['NAME'], 'кг') !== false):
        $arResult['ITEMS'][$key]['UNIT']= ' кг';
    else:
        $arResult['ITEMS'][$key]['UNIT']= ' шт.';
    endif;
    
    
    
}

$entity_data_class = GetEntityDataClass(MY_HL_BLOCK_META_ID);
$rsData = $entity_data_class::getList(array(
   'select' => array('*')
));

while($el = $rsData->fetch()):
    
    if($el['UF_SALE_CODE']==$arResult['ORIGINAL_PARAMETERS']['SECTION_CODE']){
        
        $arResult['SALE_H1']=$el['UF_SALE_H1'];
        
        if($el['UF_SALE_TITLE']) 
            $APPLICATION->SetPageProperty("title", $el['UF_SALE_TITLE']);
        if($el['UF_SALE_DESCRIPTION']) 
            $APPLICATION->SetPageProperty("description", $el['UF_SALE_DESCRIPTION']);
        if($el['UF_SALE_KEYWORDS']) 
            $APPLICATION->SetPageProperty("keywords", $el['UF_SALE_KEYWORDS']);
    }
endwhile;

if(mb_substr($arResult['NAME'], -1)=='а' || mb_substr($arResult['NAME'], -1)=='ы' || mb_substr($arResult['NAME'], -1)=='и'):
    $arResult['ALL'] = 'Все';
else:
    $arResult['ALL'] = 'Весь';
endif;

