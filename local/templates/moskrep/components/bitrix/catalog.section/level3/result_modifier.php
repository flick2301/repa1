<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult['ITEMS'] as $key=>$arItem){
   
    if(stripos($arItem['NAME'], 'кг') !== false):
        $arResult['ITEMS'][$key]['UNIT']= ' кг';
    else:
        $arResult['ITEMS'][$key]['UNIT']= ' шт.';
    endif;
    
}

