<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
foreach($arResult['SECTIONS'] as $key=>$arSection){
    $file = CFile::ResizeImageGet($arSection['PICTURE']['ID'], array('width'=>$arParams['LIST_PREV_PIC_W_L3'], 'height'=>$arParams['LIST_PREV_PIC_H_L3']), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult['SECTIONS'][$key]['PICTURE'] = $file;
    
}
