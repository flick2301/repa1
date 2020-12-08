<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
require_once($_SERVER["DOCUMENT_ROOT"]."/local/modules/relink.table/lib/table.php");
// подключаем пространство имен класса HighloadBlockTable и даём ему псевдоним HLBT для удобной работы
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
$module_id = 'relink.table';




use Bitrix\Main\Loader;
//подключаем модуль highloadblock
CModule::IncludeModule('highloadblock');
if (!Loader::includeModule($module_id))
    return;




$nav = CIBlockSection::GetNavChain(false, $arResult['ID']);
while($nw = $nav->Fetch()){
    $arTempID[]=$nw['ID'];
    $arTempName[]=$nw['NAME'];
}

$arFilter = array('IBLOCK_ID' => IBLOCK_ID_CERT, "UF_SEC_CAT"=>$arTempID);
$rsSections = CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter, false, array("*", "UF_*"));
if($arSection = $rsSections->GetNext())
{
    
    $arResult['CERT_URL'] = $arSection['LIST_PAGE_URL'].$arSection['SECTION_PAGE_URL'];
    $arResult['CERT_NAME'] = strtolower($arSection['NAME']);
    

}

$rsResult = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arResult["ID"]), false, array("UF_*"));
if($arSection = $rsResult->GetNext()) { 
    
    $arResult['UF_TECH_ID'] = $arSection["UF_TECH"];
    $arResult['UF_VES_TABLE_ID'] = $arSection["UF_VES_TABLE"];
    $arResult["UF_RELATED"] = $arSection["UF_RELATED"];
    $arResult["UF_DETAIL_TEXT"] = $arSection["UF_DETAIL_TEXT"];
}
						

$entity_data_class = GetEntityDataClass(TECH_HB_ID);
$rsData = $entity_data_class::getList(array(
   'filter' => array("ID"=>$arResult['UF_TECH_ID'],)
));
$el = $rsData->fetch();
$arResult['UF_TECH_FILE'] = CFile::GetPath($el['UF_FILE']);
$arResult['UF_TECH_NAME'] = $el['UF_NAME'];
$entity_data_class = GetEntityDataClass(VES_HB_ID);
$rsData = $entity_data_class::getList(array(
   'filter' => array("ID"=>$arResult['UF_VES_TABLE_ID'],)
));
$el = $rsData->fetch();
$arResult['UF_VES_TABLE_FILE'] = CFile::GetPath($el['UF_FILE']);
$arResult['UF_VES_NAME'] = $el['UF_NAME'];


$relinkList = \Relink\Table\LinksTable::getList(array("select" => array('*'), "filter" => array("=DONOR_ID" => $arResult['ID'])));
while($arRelink = $relinkList->fetch()){
    $arResult['RELINK'][] = $arRelink;
}





$ipropSectionValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arResult["IBLOCK_ID"],$arResult["ID"]);
$section_values=$ipropSectionValues->getValues();
$arResult['META_TITLE']=$section_values['SECTION_PAGE_TITLE'];

//ВЫЧИСЛЯЕМ ДОСТУПНЫЕ РАЗМЕРЫ ДЛЯ ОТОБРАЖЕНИЯ
$arFilter = array("IBLOCK_ID" => $arParams['IBLOCK_ID'], "ID"=>$arTempID);
$rsSections = CIBlockSection::GetList(array('ID' => 'ASC'), $arFilter, false, array("IBLOCK_ID", "UF_SEC_LIST_SIZES"));


while($arSection = $rsSections->GetNext())
{

    if($arSection["UF_SEC_LIST_SIZES"]) {
        $arSizes = array();
        $rsGender = CUserFieldEnum::GetList(array(), array("ID" => $arSection["UF_SEC_LIST_SIZES"]));
        while ($arCat = $rsGender->GetNext()) {
            $arSizes[] = $arCat["XML_ID"];

        }

    }

}
//ВЫЧИСЛЯЕМ ДОСТУПНЫЕ РАЗМЕРЫ ДЛЯ ОТОБРАЖЕНИЯ(КОНЕЦ)

foreach($arParams['REPLACEMENT'] as $arReplacement){
    $repl = explode('=', $arReplacement);

}
foreach($arResult['ITEMS'] as $key=>$arItem){
    if(isset($arItem['PREVIEW_PICTURE']['ID'])){
      $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>150, 'height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    }else{
      $file = CFile::ResizeImageGet($arResult['PICTURE']['ID'], array('width'=>150, 'height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, true);  
    }
    //заменяем Имена если надо
    if(count($repl)){
        $arResult['ITEMS'][$key]['NAME'] = str_replace($repl[0], $repl[1], $arItem['NAME']);
    }
    $arResult['ITEMS'][$key]['PREVIEW_PICTURE'] = $file;
    if(stripos($arItem['NAME'], 'кг') !== false):
        $arResult['ITEMS'][$key]['UNIT']= ' кг';
    else:
        $arResult['ITEMS'][$key]['UNIT']= ' шт.';
    endif;

    //Получаем массив из размеров
    $ar_size = array();
    if(count($arSizes)>0){
        foreach($arSizes as $size){
            $ar_size[] = $arItem['PROPERTIES'][$size]["VALUE"];
        }
    }else{

        $ar_size = array(
            $arItem['PROPERTIES']["DIAMETR"]["VALUE"],
            $arItem['PROPERTIES']["VYSOTA"]["VALUE"],
            $arItem['PROPERTIES']["SHIRINA"]["VALUE"],
            $arItem['PROPERTIES']["DLINA"]["VALUE"],
			$arItem['PROPERTIES']['DIAMETR_VNUTRENNIY']["VALUE"]
        );
    }
    $sizes = array_diff($ar_size, ['']);
	
    if(count($arSizes) === 1 && $arSizes['0']=='DIAMETR') {

        $arResult['ITEMS'][$key]['SIZES'] = 'M ' . implode($sizes, 'x');
    }else{
        $arResult['ITEMS'][$key]['SIZES']=implode($sizes, 'x');
    }
        //Вводим массив c ключами из размеров с значениями в виде ITEMS id
    $arResult['SIZES'][$arResult['ITEMS'][$key]['SIZES']][$key]=$arResult['ITEMS'][$key];

    
    
}

