<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

foreach($arResult['SECTIONS'] as $key=>$arSection){
    
    $arSelect = Array("ID", "NAME", "PROPERTY_FOR_SALE");
    $arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "SECTION_ID"=>$arSection['ID'], "INCLUDE_SUBSECTIONS"=>"Y","PROPERTY_FOR_SALE"=>"По акции", "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, array(), false, $arSelect);
    if($res == 0)
   {
      unset($arResult['SECTIONS'][$key]);
      continue;
   }
   
   
    
    $file = CFile::ResizeImageGet($arSection['PICTURE']['ID'], array('width'=>268, 'height'=>201), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult['SECTIONS'][$key]['PICTURE'] = $file;
    
}
