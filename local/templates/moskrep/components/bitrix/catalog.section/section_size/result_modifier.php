<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// подключаем пространство имен класса HighloadBlockTable и даём ему псевдоним HLBT для удобной работы
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;

//подключаем модуль highloadblock
CModule::IncludeModule('highloadblock');




$nav = CIBlockSection::GetNavChain(false, $arResult['ID']);
while($nw = $nav->Fetch()){
    $arTempID[]=$nw['ID'];
    $arTempName[]=$nw['NAME'];
}

$arFilter = array('IBLOCK_ID' => IBLOCK_ID_CERT, "UF_SEC_CAT"=>$arTempID);
$rsSections = CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter, false, array("*", "UF_*"));
if($arSection = $rsSections->GetNext())
{
    
    $arResult['CERT_URL'] = $arSection['SECTION_PAGE_URL'];

}

$rsResult = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arResult["ID"]), false, array("UF_*"));
if($arSection = $rsResult->GetNext()) { 
    
    $arResult['UF_TECH_ID'] = $arSection["UF_TECH"];
    $arResult['UF_VES_TABLE_ID'] = $arSection["UF_VES_TABLE"];
    $arResult["UF_RELATED"] = $arSection["UF_RELATED"];
}
						

$entity_data_class = GetEntityDataClass(TECH_HB_ID);
$rsData = $entity_data_class::getList(array(
   'filter' => array("ID"=>$arResult['UF_TECH_ID'],)
));
$el = $rsData->fetch();
$arResult['UF_TECH_FILE'] = CFile::GetPath($el['UF_FILE']);

$entity_data_class = GetEntityDataClass(VES_HB_ID);
$rsData = $entity_data_class::getList(array(
   'filter' => array("ID"=>$arResult['UF_VES_TABLE_ID'],)
));
$el = $rsData->fetch();
$arResult['UF_VES_TABLE_FILE'] = CFile::GetPath($el['UF_FILE']);



$nav = CIBlockSection::GetNavChain(false, $arResult["ID"]);
$arSec = $nav->GetNext();

if(!in_array($arSec['ID'], $arParams["VIBOR_CATALOG_TABLE"])){ $arResult['JUST_VERTICAL']='Y';}

foreach($arResult['ITEMS'] as $key=>$arItem){
    if(isset($arItem['PREVIEW_PICTURE']['ID'])){
      $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>$arParams['ITEMS_PREV_PIC_W_L3'], 'height'=>$arParams['ITMES_PREV_PIC_H_L3']), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    }else{
      $file = CFile::ResizeImageGet($arResult['PICTURE']['ID'], array('width'=>$arParams['ITEMS_PREV_PIC_W_L3'], 'height'=>$arParams['ITMES_PREV_PIC_H_L3']), BX_RESIZE_IMAGE_PROPORTIONAL, true);  
    }
    if($file['src']):
    $arResult['ITEMS'][$key]['PREVIEW_PICTURE'] = $file;
    else:
    $arResult['ITEMS'][$key]['PREVIEW_PICTURE']['src'] = '/images/no_image.jpg';   
    endif;
    
    $arIdes[]=$arItem['ID'];
    
}

$res = CIBlockElement::GetList(Array(), array("IBLOCK_ID"=>$arResult["IBLOCK_ID"], "ID"=>$arIdes));
while($ar_fields = $res->GetNext()){
    
    $arURL[$ar_fields['ID']]=$ar_fields['DETAIL_PAGE_URL'];
    
    
}
foreach($arResult['ITEMS'] as $key=>$arItem){
   $arResult['ITEMS'][$key]['DETAIL_PAGE_URL'] = $arURL[$arItem['ID']];
}

$entity_data_class = GetEntityDataClass(SIZE_HB_ID);
$rsData = $entity_data_class::getList(array(
   'filter' => array(),
    
));
while($el = $rsData->fetch()):
    $arTemplateText[$el['UF_TYPE']]=$el['UF_TEXT_TEMPLATE'];
    
    
endwhile;


if($arParams['SIZES']['width'] && $arParams['SIZES']['length']):
    $arResult['TITLE']=$arResult['NAME'].' '.$arParams['SIZES']['width'].'x'.$arParams['SIZES']['length'].' мм';
    $arResult['TEXT']=str_replace("{DIAMETR}", $arParams['SIZES']['width'], $arTemplateText['DOBLE']);
    $arResult['TEXT']=str_replace("{DLINNA}", $arParams['SIZES']['length'], $arResult['TEXT']);
    
elseif($arParams['SIZES']['width']):
    $arResult['TITLE']=$arResult['NAME'].' диаметром '.$arParams['SIZES']['width'].' мм';
    $arResult['TEXT']=str_replace("{DIAMETR}", $arParams['SIZES']['width'], $arTemplateText['DIAMETR']);
elseif($arParams['SIZES']['length']):
    $arResult['TITLE']=$arResult['NAME'].' длинной '.$arParams['SIZES']['length'].' мм';
    $arResult['TEXT']=str_replace("{DLINNA}", $arParams['SIZES']['length'], $arTemplateText['DLINNA']);
endif;

