<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
require_once($_SERVER["DOCUMENT_ROOT"]."/local/modules/relink.table/lib/table.php");
$module_id = 'relink.table';
use Bitrix\Main\Loader;
if (!Loader::includeModule($module_id))
    return;
//ПЕРЕЛИНКОВКА(СМОТРИТЕ ТАК ЖЕ(ВРЕМЕННО ОТКЛЮЧАЕМ))
$relinkList = \Relink\Table\LinksTable::getList(array("select" => array('*'), "filter" => array("=DONOR_ID" => $arResult['SECTION']['ID'])));
while($arRelink = $relinkList->fetch()){
   // $arResult['RELINK'][] = $arRelink;
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$cp = $this->__component;
global $context;
global $sec_builder;
global $filterObj;

$request = $context->getRequest();
$requestUri = $request->getRequestUri();

if($arParams['REFERENCE_CHECK']=='Y'):


    $landing_page_code = $sec_builder->curSorting[0]['CODE'] ?? end($arParams['SORTING']);
    $arResult['SECTION']['SORTING'] = $arParams['SORTING'];

    $filterObj = new \CatalogHelpers\FilterButtonsBuilder('section.list', $arResult, $arResult['SECTION']['ID']);
    $arResult = $filterObj->arResult;
	    

endif;

$nav = CIBlockSection::GetNavChain(false, $arResult['SECTION']['ID']);
while($nw = $nav->Fetch()){
    $arTempID[]=$nw['ID'];
    $arTempName[]=$nw['NAME'];
}

//Подбор сопутствующих товаров по свойству, нужен getlist на все верхние подразделы, будут
//проверены все верхние подразделы пока не найдется первый с заполненным свойством
$ar_result = CIBlockSection::GetList(array("ID" => "DESC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arTempID), false, $arSelect = array("*", "UF_*"));
while($arSection = $ar_result->GetNext())
{
	if($arSection["UF_S_ETIM_TOVAROM"])
	{
		$arResult["S_ETIM_TOVAROM"] = $arSection["UF_S_ETIM_TOVAROM"];
				
		break;
	}
}

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

if($arResult['SECTION']['UF_VID_KREPEZH'])
{
	$GLOBALS['Filter_seo']["PROPERTY_VID_KREPEZH_VALUE"]=$arResult['SECTION']['UF_VID_KREPEZH'];
}
if($arResult['SECTION']['UF_PO_PRIMENENIYU'])
{
	$GLOBALS['Filter_seo']["PROPERTY_PO_PRIMENENIYU_VALUE"]=$arResult['SECTION']['UF_PO_PRIMENENIYU'];
}
if($arResult['SECTION']['UF_GOLOVKA'])
{
	$GLOBALS['Filter_seo']["PROPERTY_GOLOVKA_VALUE"]=$arResult['SECTION']['UF_GOLOVKA'];
}
if($arResult['SECTION']['UF_MATERIAL'])
{
	
	$GLOBALS['Filter_seo']["PROPERTY_MATERIAL_VALUE"]=$arResult['SECTION']['UF_MATERIAL'];
}

foreach($arResult['SECTIONS'] as $key=>$arSection){
    
    $file = CFile::ResizeImageGet($arSection['DETAIL_PICTURE'] ? $arSection['DETAIL_PICTURE'] :  $arSection['PICTURE']['ID'], array('width'=>$arParams['LIST_PREV_PIC_W_L2'], 'height'=>$arParams['LIST_PREV_PIC_H_L2']), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	
			//Отмена сжатия
			//if ($arSection['DETAIL_PICTURE'])			
			//$file['src'] = CFile::GetPath($arSection['DETAIL_PICTURE']);	
    
    if($file['src']):
        $arResult['SECTIONS'][$key]['PICTURE'] = $file;
    else:

$arSelect = Array("DETAIL_PICTURE");
$arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "IBLOCK_SECTION_ID"=>$arResult['SECTIONS'][$key]['ID'], "!DETAIL_PICTURE"=>false);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
if($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 $arResult['SECTIONS'][$key]['PICTURE'] = CFile::ResizeImageGet($arFields['DETAIL_PICTURE'], array('width'=>$arParams['LIST_PREV_PIC_W_L2'], 'height'=>$arParams['LIST_PREV_PIC_H_L2']), BX_RESIZE_IMAGE_PROPORTIONAL, true);
}	
	
        if (!$arResult['SECTIONS'][$key]['PICTURE']) $arResult['SECTIONS'][$key]['PICTURE']['src'] = '/images/no_image_sec.jpg';  
		
    endif;
    
    
}

if($arResult['REFERENCE']['ITEM']['ID']!=''){
	$relinkList = \Relink\Table\LinksTable::getList(array("select" => array('*'), "filter" => array("=DONOR_ID" => $arResult['REFERENCE']['ITEM']['ID'])));
while($arRelink = $relinkList->fetch()){
    $arResult['RELINK'][] = $arRelink;
}

}
if($arResult['SECTION']["UF_DOP_SETTINGS"])
{
	foreach($arResult['SECTION']["UF_DOP_SETTINGS"] as $extra_setting)
	{
        $val_enum = CUserFieldEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "ID"=>$extra_setting))->GetNext();
		$_POST['ENUM_LIST'][$val_enum['XML_ID']] = true;
	}
}

if (count($arResult["REFERENCE"]["ITEM"])) $GLOBALS["REFERENCE"] = $arResult["REFERENCE"]["ITEM"];

\Bitrix\Main\Loader::includeModule('dev2fun.opengraph');
\Dev2fun\Module\OpenGraph::Show($arResult['SECTION']['ID'],'section');

/*
$isSEF = $sec_builder->isFilterSEF(end($sec_builder->arPagesCode), true);
foreach($arResult['SORTING']['SECTIONS'] as $key=>$sortSection)
{
    foreach($sortSection['ITEMS'] as $key_item=>$sort_item)
    {
        if(!empty($sort_item['arFilters']['VALUE']))
        {
            $get_params = $request->getQueryList();

            if($isSEF)
                $is_active = ($sort_item['sef_filter']['VALUE']==end($sec_builder->arPagesCode)) ? 'active' : null;
            else
                $is_active = count(array_intersect_key(array_flip($sort_item['arFilters']['VALUE']), $get_params->getValues())) == count($sort_item['arFilters']['VALUE']) ? 'active' : null;
            $arResult['SORTING']['SECTIONS'][$key]['ITEMS'][$key_item]['IS_ACTIVE']=$is_active;
            if($is_active)
                ++$arResult['SORTING']['SECTIONS'][$key]['ACTIVES'];

        }
    }
}
*/