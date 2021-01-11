<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$arResult['PREVIEW_PICTURE'] = CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], array('width'=>$arParams['ITEMS_DETAIL_PIC_W'], 'height'=>$arParams['ITEMS_DETAIL_PIC_H']), BX_RESIZE_IMAGE_PROPORTIONAL, true);
$arResult['ELEMENT_COUNT'] = $arResult['CATALOG_QUANTITY']+$arResult['CATALOG_QUANTITY_RESERVED'];


    foreach($arResult['DISPLAY_PROPERTIES'] as $key => $value){
       if(in_array($value['CODE'], ARR_UINTS_MM)){
         $arResult['DISPLAY_PROPERTIES'][$key]['VALUE'] .= ' мм';   
       } 
       elseif(in_array($value['CODE'], ARR_UNITS_SHT)){
         $arResult['DISPLAY_PROPERTIES'][$key]['VALUE'] .= ' шт.';   
       }
       elseif(in_array($value['CODE'], ARR_UNITS_RAL)){
         $arResult['DISPLAY_PROPERTIES'][$key]['VALUE'] .= ' RAL';   
       } 
    }
    
$arResult['BASE_PROPERTIES'] = array_slice($arResult['DISPLAY_PROPERTIES'],0,4);

if(count($arResult['DISPLAY_PROPERTIES'])%2){
    $ul1 = (count($arResult['DISPLAY_PROPERTIES'])+1)/2;
    $ul2 = count($arResult['DISPLAY_PROPERTIES'])-$ul1;
}else{
   $ul1= count($arResult['DISPLAY_PROPERTIES'])/2;
   $ul2=$ul1;
}

$arResult['BASE_PROPERTIES_UL1'] = array_slice($arResult['DISPLAY_PROPERTIES'],0,$ul1);
$arResult['BASE_PROPERTIES_UL2'] = array_slice($arResult['DISPLAY_PROPERTIES'],$ul1,$ul2);

if(!$arResult['DETAIL_DESCRIPTION']){
    $arFilter = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], "ID"=>$arResult["IBLOCK_SECTION_ID"]);
    $db_list = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, true);

    if($ar_result = $db_list->GetNext()){
       $arResult['DETAIL_DESCRIPTION'] = $ar_result['DESCRIPTION']; 
    }
}

$nav = CIBlockSection::GetNavChain(false, $arResult['IBLOCK_SECTION_ID']);
while($nw = $nav->Fetch()){
    $arTempID[]=$nw['ID'];
    $arTempName[]=$nw['NAME'];
}

$arFilter = array('IBLOCK_ID' => IBLOCK_ID_CERT, "UF_SEC_CAT"=>$arTempID);
$rsSections = CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter, false, array("*", "UF_*"));
if($arSection = $rsSections->GetNext())
{
    $arSelect = Array("*");
    $arFilter = Array("IBLOCK_ID"=>IBLOCK_ID_CERT, "SECTION_ID"=>$arSection['ID']);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, array(), $arSelect);
    while($ob = $res->GetNextElement())
    {
        
        $arProperties = $ob->GetProperties();
        $arCert = array();
        foreach($arProperties['CERT_PAGE']['VALUE'] as $page_pic){
            
            $arCert = CFile::ResizeImageGet($page_pic, array('width'=>'330', 'height'=>'330'), BX_RESIZE_IMAGE_PROPORTIONAL, true);
            $arCert['BIG_PIC'] = CFile::GetPath($page_pic);
            $arResult['CERT_PICTURE'][] = $arCert;
           
        }
    } 
}

if(in_array(KREPEZH_NAME, $arTempName)){
$str1 = preg_replace("/[^0-9]/", "", $arResult['PROPERTIES']['CML2_ARTICLE']['VALUE']);
$str2 = preg_replace("/^(.+?)$str1.+$/", '\\1', $arResult['PROPERTIES']['CML2_ARTICLE']['VALUE']);

$arResult['FILTER_ARTICL'] = $str2.$str1;
}

$ar_result = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arResult["IBLOCK_SECTION_ID"]), false, $arSelect = array("*", "UF_*"));

if($arSection = $ar_result->GetNext()) { 
    $arResult["RELATED"] = $arSection["UF_RELATED"];
}
$rsStore = CCatalogStoreProduct::GetList(array(), array('PRODUCT_ID' => $arResult['ID']), false, false, array('STORE_ID', 'AMOUNT', 'STORE_NAME')); 
while($arStore = $rsStore->Fetch()){
    $arResult['STORE'][$arStore['STORE_ID']] = $arStore;
}