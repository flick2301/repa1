<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
require_once($_SERVER["DOCUMENT_ROOT"]."/local/modules/relink.table/lib/table.php");
$module_id = 'relink.table';
use Bitrix\Main\Loader;
if (!Loader::includeModule($module_id))
    return;
$relinkList = \Relink\Table\LinksTable::getList(array("select" => array('*'), "filter" => array("=DONOR_ID" => $arResult['SECTION']['ID'])));
while($arRelink = $relinkList->fetch()){
    $arResult['RELINK'][] = $arRelink;
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$cp = $this->__component;


if($arParams['REFERENCE_CHECK']=='Y'):
    

    
    
   
    $arFilter = array('IBLOCK_ID' => SORTING_IBLOCK_ID, 'UF_DIRECTORY'=>$arResult['SECTION']['ID']);
    $rsSections = CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter, false, array('*', 'UF_DIRECTORY'));
    while ($arSection = $rsSections->Fetch())
    {
       $arResult['SORTING']['SECTION_ID'] = $arSection['ID'];
    }
    
    if($arResult['SORTING']['SECTION_ID'] && $arResult['SECTION']['ID']){
        $arFilter = array('IBLOCK_ID' => SORTING_IBLOCK_ID, 'SECTION_ID'=>$arResult['SORTING']['SECTION_ID']);
        $rsSections = CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter, false, array('*', 'UF_TOP'));
        while ($arSection = $rsSections->Fetch())
        {
            $arResult['SORTING']['SECTIONS'][$arSection['ID']]['NAME'] = $arSection['NAME'];
            $arResult['SORTING']['SECTIONS'][$arSection['ID']]['TOP']=$arSection['UF_TOP'];
            
            $arSortSecID[]=$arSection['ID'];
            
        }
        
        if($arSortSecID){
            $arFilter = Array("IBLOCK_ID"=>SORTING_IBLOCK_ID, "ACTIVE"=>"Y", 'IBLOCK_SECTION_ID'=>$arSortSecID, '!PROPERTY_VISIBILITY_VALUE'=>'Y');
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, array('*'));
            while($ob = $res->GetNextElement()){ 
            
                $arFields = $ob->GetFields();  
                $arProps = $ob->GetProperties();
                $arResult['SORTING']['SECTIONS'][$arFields['IBLOCK_SECTION_ID']]['ITEMS'][]=array_merge($arFields, $arProps);

            }
        }
        
        $arFilter = Array("IBLOCK_ID"=>SORTING_IBLOCK_ID, "ACTIVE"=>"Y", 'IBLOCK_SECTION_ID'=>$arResult['SORTING']['SECTION_ID'], '!PROPERTY_VISIBILITY_VALUE'=>'Y');
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, array('*'));
        while($ob = $res->GetNextElement()){ 
            
            $arFields = $ob->GetFields();  
            $arProps = $ob->GetProperties();
            
            $arResult['SORTING']['ROOT_ELEMENTS'][$arFields['ID']]=array_merge($arFields, $arProps);
        
            $arResult['SORTING']['ROOT_ELEMENTS'][$arFields['ID']]['PICTURE'] = CFile::ResizeImageGet($arFields['PREVIEW_PICTURE'], array('width'=>'184', 'height'=>'330'), BX_RESIZE_IMAGE_PROPORTIONAL, true);

        }
        
       
       
    }else{
        $resProps = CIBlock::GetProperties($arParams["IBLOCK_ID"], Array(), Array());
        while($arProp = $resProps->Fetch()){
            $arProp_catalog[]=$arProp['CODE'];
            $arProp_catalog_type[$arProp['CODE']]=$arProp['PROPERTY_TYPE'];
             
        }
         
        $arFilter = Array("IBLOCK_ID"=>SORTING_IBLOCK_ID, "ACTIVE"=>"Y", 'CODE'=>$arParams['SORTING']);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, array('*'));
        while($ob = $res->GetNextElement()){ 
            
            $arFields = $ob->GetFields();  
            $arProps = $ob->GetProperties();
           
            $arResult['REFERENCE']['ITEM']=array_merge($arFields, $arProps);


            if($arResult['REFERENCE']['ITEM']['DETAIL_PICTURE']){
                $arResult['REFERENCE']['ITEM']['PICTURE'] = CFile::ResizeImageGet($arResult['REFERENCE']['ITEM']['DETAIL_PICTURE'], array('width'=>'600', 'height'=>'600'), BX_RESIZE_IMAGE_PROPORTIONAL, true);
            }
            foreach($arProps as $val){
                
                if(in_array($val['CODE'], $arProp_catalog) && $val['VALUE']!=''){
                    $arProp_sorting[]=$val;
                    
                }
                
            }
           
           //$arProp_sorting - ЭТО СВОЙСТВО ПО СПРАВОЧНИКУ СОВПАДАЮЩЕЕ СО СВОЙСТВОМ КАТОЛОГА( ДИАМЕТР, ПРОЧНОСТЬ И Т.Д.)
            $cp->SetResultCacheKeys(array('REFERENCE'));

            //СОПУТСТВУЮЩИЕ РАЗДЕЛЫ
            if(count($arResult['REFERENCE']['ITEM']['COMPANION_SECTION']['VALUE'])) {
                $arFilter = array("IBLOCK_ID" => $arParams['IBLOCK_ID'], 'ID' => $arResult['REFERENCE']['ITEM']['COMPANION_SECTION']['VALUE']);
                $rsSections = CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter);
                while ($arSection = $rsSections->GetNext()) {

                    $arResult['REFERENCE']['ITEM']['COMPANIONS'][] = array('NAME' => $arSection['NAME'], 'SRC' => $arSection['SECTION_PAGE_URL']);

                }

            }
            //СОПУТСТВУЮЩИЕ СПРАВОЧНИКИ
            if(count($arResult['REFERENCE']['ITEM']['COMPANION_GUIDE']['VALUE'])) {
                foreach($arResult['REFERENCE']['ITEM']['COMPANION_GUIDE']['VALUE'] as $arGuide){
                    $guide = explode("=", $arGuide);
                    $arResult['REFERENCE']['ITEM']['COMPANIONS'][] = array('NAME' => $guide[0], 'SRC' => $guide[1]);
                }

            }

        }

        //ЕСЛИ ВЫБРАНО НЕСКОЛЬКО РАЗДЕЛОВ БЕЗ СВОЙСТВ
    if(count($arResult['REFERENCE']['ITEM']['SECTION_LINK']['VALUE'])>1 && $arResult['REFERENCE']['ITEM'][$arProp_sorting[0]['CODE']]['VALUE']=='') {
            $rsResult = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arResult['REFERENCE']['ITEM']['SECTION_LINK']['VALUE']), false, array("*", "IPROPERTY_VALUES"));
            while ($rSection = $rsResult->GetNext()) {
                $arResult['DOP_SECTIONS'][] = $rSection;
            }

            foreach ($arResult['DOP_SECTIONS'] as $key => $arSection) {
                $file = CFile::ResizeImageGet($arSection['PICTURE'], array('width' => $arParams['LIST_PREV_PIC_W_L2'], 'height' => $arParams['LIST_PREV_PIC_H_L2']), BX_RESIZE_IMAGE_PROPORTIONAL, true);

                if ($file['src']):
                    $arResult['DOP_SECTIONS'][$key]['PICTURE'] = $file;
                else:
                    $arResult['DOP_SECTIONS'][$key]['PICTURE']['src'] = '/images/no_image_sec.jpg';
                endif;
                $ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(5, $arSection['ID']);
                $arResult['DOP_SECTIONS'][$key]['IPROPERTY_VALUES'] = $ipropValues->getValues();

            }
    //НЕСКОЛЬКО РАЗДЕЛОВ И СВОЙСТВА
    }elseif(count($arResult['REFERENCE']['ITEM']['SECTION_LINK']['VALUE'])>1 && $arResult['REFERENCE']['ITEM'][$arProp_sorting[0]['CODE']]['VALUE']!=''){
        $arResult['REFERENCE']['ITEM']['DIRECTORY'] = $arResult['SECTIONS'][0]['ID'];

        $GLOBALS['Filter_seo'] = Array();
        $GLOBALS['Filter_seo']['IBLOCK_SECTION_ID']=$arResult['REFERENCE']['ITEM']['SECTION_LINK']['VALUE'];
        foreach($arProp_sorting as $arFilt_prop){
            //ЕСЛИ СВОЙСТВО В КАТАЛОГЕ ТИПА СПИСОК, ТО ФИЛЬТР ДОЛЖЕН БЫТЬ PROPERTY_КОД_VALUE
            if($arProp_catalog_type[$arFilt_prop['CODE']] == 'L'){
                $GLOBALS['Filter_seo']["PROPERTY_".$arFilt_prop['CODE']."_VALUE"] = $arResult['REFERENCE']['ITEM'][$arFilt_prop['CODE']]['VALUE'];
            }elseif($arFilt_prop['CODE']=="PO_PRIMENENIYU"){

                $GLOBALS['Filter_seo']["%PROPERTY_".$arFilt_prop['CODE']] = $arResult['REFERENCE']['ITEM'][$arFilt_prop['CODE']]['VALUE'];
            }else{
                $GLOBALS['Filter_seo']["PROPERTY_".$arFilt_prop['CODE']] = $arResult['REFERENCE']['ITEM'][$arFilt_prop['CODE']]['VALUE'];
            }
        }
    //ЕСЛИ ВЫБРАН ОДИН РАЗДЕЛ
    }elseif($arResult['REFERENCE']['ITEM']['SECTION_LINK']['VALUE']){

       $arResult['REFERENCE']['ITEM']['DIRECTORY']=$arResult['REFERENCE']['ITEM']['SECTION_LINK']['VALUE'][0];

            $GLOBALS['Filter_seo'] = Array();
            foreach($arProp_sorting as $arFilt_prop){
                //ЕСЛИ СВОЙСТВО В КАТАЛОГЕ ТИПА СПИСОК, ТО ФИЛЬТР ДОЛЖЕН БЫТЬ PROPERTY_КОД_VALUE
                if($arProp_catalog_type[$arFilt_prop['CODE']] == 'L'){
                    $GLOBALS['Filter_seo']["PROPERTY_".$arFilt_prop['CODE']."_VALUE"] = $arResult['REFERENCE']['ITEM'][$arFilt_prop['CODE']]['VALUE'];
                }elseif($arFilt_prop['CODE']=="PO_PRIMENENIYU"){

                    $GLOBALS['Filter_seo']["%PROPERTY_".$arFilt_prop['CODE']."_VALUE"] = $arResult['REFERENCE']['ITEM'][$arFilt_prop['CODE']]['VALUE'];
                }else{
                    $GLOBALS['Filter_seo']["PROPERTY_".$arFilt_prop['CODE']] = $arResult['REFERENCE']['ITEM'][$arFilt_prop['CODE']]['VALUE'];
                }
            }
     //ЕСЛИ ВЫБРАНЫ ТОЛЬКО СВОЙСТВА
    }elseif($arResult['REFERENCE']['ITEM'][$arProp_sorting[0]['CODE']]['VALUE']!=''){
       
       $nav = CIBlockSection::GetNavChain(false,$arFields['IBLOCK_SECTION_ID']);
        while($arSectionPath = $nav->GetNext()){
            $arNav[] =  $arSectionPath['ID'];
        }
       $arFilter = array('IBLOCK_ID' => SORTING_IBLOCK_ID, 'ID'=>$arNav);
       $rsSections = CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter, false, array('*', 'UF_*'));
        while ($arSection = $rsSections->Fetch())
        {
            if($arSection['UF_DIRECTORY'][0]!='')
                $arResult['REFERENCE']['ITEM']['DIRECTORY'] = $arSection['UF_DIRECTORY'][0];
            
        }
        $GLOBALS['Filter_seo'] = Array();
        foreach($arProp_sorting as $arFilt_prop){
            //ЕСЛИ СВОЙСТВО В КАТАЛОГЕ ТИПА СПИСОК, ТО ФИЛЬТР ДОЛЖЕН БЫТЬ PROPERTY_КОД_VALUE
            if($arProp_catalog_type[$arFilt_prop['CODE']] == 'L'){
                $GLOBALS['Filter_seo']["PROPERTY_".$arFilt_prop['CODE']."_VALUE"] = $arResult['REFERENCE']['ITEM'][$arFilt_prop['CODE']]['VALUE']; 
            }else{
                $GLOBALS['Filter_seo']["PROPERTY_".$arFilt_prop['CODE']] = $arResult['REFERENCE']['ITEM'][$arFilt_prop['CODE']]['VALUE'];
            }
        }
   
       
    }


    //НАЛИЧИЕ У СПРАВОЧНИКА ВЕРХНИХ ПРИЛИНКОВАННЫХ РАЗДЕЛОВ(SECTIONS_TOP)
        if(count($arResult['REFERENCE']['ITEM']['SECTIONS_TOP']['VALUE'])>1) {
            $rsResult = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arResult['REFERENCE']['ITEM']['SECTIONS_TOP']['VALUE']), false, array("*", "IPROPERTY_VALUES"));
            while ($rSection = $rsResult->GetNext()) {
                $arResult['TOP_SECTIONS'][] = $rSection;
            }
            foreach($arResult['REFERENCE']['ITEM']['REPLACEMENT']['VALUE'] as $arReplacement){
                $repl[] = explode('=', $arReplacement);

            }
            foreach ($arResult['TOP_SECTIONS'] as $key => $arSection) {
                $file = CFile::ResizeImageGet($arSection['PICTURE'], array('width' => $arParams['LIST_PREV_PIC_W_L2'], 'height' => $arParams['LIST_PREV_PIC_H_L2']), BX_RESIZE_IMAGE_PROPORTIONAL, true);

                if ($file['src']):
                    $arResult['TOP_SECTIONS'][$key]['PICTURE'] = $file;
                else:
                    $arResult['TOP_SECTIONS'][$key]['PICTURE']['src'] = '/images/no_image_sec.jpg';
                endif;
                $ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(5, $arSection['ID']);
                $arResult['TOP_SECTIONS'][$key]['IPROPERTY_VALUES'] = $ipropValues->getValues();

                if(count($repl)){
                    foreach($repl as $rep_val) {
                        $arResult['TOP_SECTIONS'][$key]['NAME'] = str_replace($rep_val[0], $rep_val[1], $arSection['NAME']);
                    }
                }
            }
        }


    //НАЛИЧИЕ У СПРАВОЧНИКА ПОДГРУПП
        if($arResult['REFERENCE']['ITEM']['SUBGROUP']['VALUE']){
            $arFilter = Array("IBLOCK_ID"=>SORTING_IBLOCK_ID, "ACTIVE"=>"Y", 'SECTION_ID'=>$arResult['REFERENCE']['ITEM']['SUBGROUP']['VALUE']);
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, array('*'));
            while($ob = $res->GetNext()){
                $arResult['REFERENCE']['ITEM']['SUBGROUP']['ELEMENTS'][] = $ob;
            }
        }

    }
    
    
    
    
endif;



if(count($arResult['SECTION']['UF_OTHER_SECTION'])){
   
    $arFilter = array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], 'ID' => $arResult['SECTION']['UF_OTHER_SECTION']);
    $rsSections = CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter);
    while ($arSection = $rsSections->GetNext())
    {
        $arOther[$arSection['ID']]=$arSection;
        $rsFile = CFile::GetByID($arSection["PICTURE"]);
        $arFile=$rsFile->Fetch();
        $arOther[$arSection['ID']]['PICTURE']=$arFile;
	$arResult['SECTIONS'][$arSection['ID']]=$arSection;
	$arResult['SECTIONS'][$arSection['ID']]['PICTURE']=$arFile;
    }
}

foreach($arResult['SECTIONS'] as $key=>$arSection){
    
    $file = CFile::ResizeImageGet($arSection['PICTURE']['ID'], array('width'=>'184', 'height'=>'330'), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    
    if($file['src']):
        $arResult['SECTIONS'][$key]['PICTURE'] = $file;
    else:
        $arResult['SECTIONS'][$key]['PICTURE']['src'] = '/images/no_image_sec.jpg';   
    endif;

    
    
}

if($arResult['REFERENCE']['ITEM']['ID']!=''){
	$relinkList = \Relink\Table\LinksTable::getList(array("select" => array('*'), "filter" => array("=DONOR_ID" => $arResult['REFERENCE']['ITEM']['ID'])));
while($arRelink = $relinkList->fetch()){
    $arResult['RELINK'][] = $arRelink;
}

}
