<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
require_once($_SERVER["DOCUMENT_ROOT"]."/local/modules/relink.table/lib/table.php");
// подключаем пространство имен класса HighloadBlockTable и даём ему псевдоним HLBT для удобной работы
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
$module_id = 'relink.table';

global $DEFAULT_STORE_ID;


use Bitrix\Main\Loader;


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
	$arResult["UF_CHARS"] = $arSection["UF_CHARS"];
	$arResult["UF_DOP_SETTINGS"] = $arSection["UF_DOP_SETTINGS"];
	$arResult["UF_EXTRA_FIELD"] = $arSection["UF_EXTRA_FIELD"];
	
	$this->__component->SetResultCacheKeys(array("UF_META_TITLE_MSK"));
	$this->__component->SetResultCacheKeys(array("UF_META_DESCRIPTION_MSK"));
	$this->__component->SetResultCacheKeys(array("UF_META_TITLE"));
	$this->__component->SetResultCacheKeys(array("UF_META_DESCRIPTION_SPB"));
	
	foreach($arSection["UF_SURFACE"] AS $surface) {
		$res = CIBlockElement::GetByID($surface);
		if ($ar_res = $res->GetNext()) {
			$ar_res["IMG"] = CFile::GetPath($ar_res["PREVIEW_PICTURE"]);
			$arNewResult["UF_SURFACE"][] = $ar_res;
		}
	}
	$arResult["UF_SURFACE"] = $arNewResult["UF_SURFACE"];
	if($arResult['ORIGINAL_PARAMETERS']['EXTRA_FIELD']){
		
		$arCode = explode(';', $arResult['ORIGINAL_PARAMETERS']['EXTRA_FIELD']);
		foreach($arCode as $code)
		{
			$arResult['EXTRA_FIELD'][] = CIBlockProperty::GetList([], Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arParams["IBLOCK_ID"], 'CODE'=>$code))->GetNext();
		}
	}elseif($arResult['UF_EXTRA_FIELD']){
		$arCode = explode(';', $arResult['UF_EXTRA_FIELD']);
		foreach($arCode as $code)
		{
			$arResult['EXTRA_FIELD'][] = CIBlockProperty::GetList([], Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arParams["IBLOCK_ID"], 'CODE'=>$code))->GetNext();
		}
	}
	
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


if (!count($arResult['EXTRA_FIELD']) && $GLOBALS["REFERENCE"]["UF_EXTRA_FIELD"]["VALUE"]) {
		$arCode = explode(';', $GLOBALS["REFERENCE"]["UF_EXTRA_FIELD"]["VALUE"]);
		foreach($arCode as $code)
		{
			$arResult['EXTRA_FIELD'][] = CIBlockProperty::GetList([], Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arParams["IBLOCK_ID"], 'CODE'=>$code))->GetNext();
		}	
}

//if ($_SERVER['REQUEST_URI']=="/krepezh/samorezy/samorezy_po_derevu/ostrye_pd/") file_put_contents($_SERVER["DOCUMENT_ROOT"].'/service/text.txt', print_r($arResult["ITEMS"][0]["PROPERTIES"], true));

if($arResult['UF_SOPUT_SPR']){
	$rsResult = CIBlockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => SORTING_IBLOCK_ID, "ID" => $arResult["UF_SOPUT_SPR"]), false, false, array("*"));
	while($arElement = $rsResult->GetNext()) { 
    
		$arResult['UF_SOPUT_SPR_ITMES'][] = $arElement;
    
	}
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
//if ($_SERVER['REQUEST_URI']=="/krepezh/samorezy/samorezy_po_derevu/ostrye_pd/") file_put_contents($_SERVER["DOCUMENT_ROOT"].'/service/text.txt', print_r($arResult['ITEMS'], true));
foreach($arResult['ITEMS'] as $key=>$arItem){
	$arResult['arITEMS_ID'][]=$arItem['ID'];
    if(isset($arItem['PREVIEW_PICTURE']['ID'])){
      $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>150, 'height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    }else{
      $file = CFile::ResizeImageGet($arResult['PICTURE']['ID'], array('width'=>150, 'height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, true);  
    }
    $arResult['ITEMS'][$key]['PREVIEW_PICTURE'] = $file;
	
		
    if(stripos($arItem['NAME'], 'кг') !== false):
        $arResult['ITEMS'][$key]['UNIT']= ' кг';
    else:
        $arResult['ITEMS'][$key]['UNIT']= ' шт.';
    endif;
	
	$rsStoreProduct = \Bitrix\Catalog\StoreProductTable::getList(array(
		'filter' => array('=PRODUCT_ID'=>$arItem['ID'],'STORE.ACTIVE'=>'Y','STORE.ID'=>3),
		'select' => array('AMOUNT','STORE_ID','STORE_TITLE' => 'STORE.TITLE'),
	));
	while($arStoreProduct=$rsStoreProduct->fetch())
	{
		$arResult['ITEMS'][$key]['KOLEDINO'] = $arStoreProduct['AMOUNT'];
	}
	
	
    $rsStore = CCatalogStoreProduct::GetList(array(), array('PRODUCT_ID' => $arItem['ID']), false, false, array('STORE_ID', 'AMOUNT', 'STORE_NAME'));
    while($arStore = $rsStore->Fetch()){
        $arResult['ITEMS'][$key]['STORE'][$arStore['STORE_ID']] = $arStore;
    }
	//Выбираем количество. Для СПБ - общее. Для МСК - только со склада в Коледино
	if($_SERVER['HTTP_HOST']=='spb.krep-komp.ru'){
		$arResult['ITEMS'][$key]['STORE'][$DEFAULT_STORE_ID]['AMOUNT'] = $arResult['ITEMS'][$key]['STORE'][$DEFAULT_STORE_ID]['AMOUNT']+$arResult['ITEMS'][$key]['STORE'][3]['AMOUNT'];
	}
    
    foreach($arItem['PROPERTIES'] as $prop){
        if(!in_array($prop['CODE'], ['SOPUTSTVUYUSHCHIE_TOVARY', 'PO_PRIMENENIYU', 'DIAMETR', 'DLINA', 'VYSOTA', 'SHIRINA', 'RAZMER_POD_KLYUCH_MM', 'SHAG_REZBY_MM'])){
            if($arProp[$prop['NAME']]=='' || $arProp[$prop['NAME']]==$prop['VALUE'])
                $arProp[$prop['NAME']]=$prop['VALUE'];
            else
                $arProp[$prop['NAME']]='false';
        }
    }
	
	if($arItem['PROPERTIES']["KOLICHESTVO_V_UPAKOVKE"]["VALUE"] > 1){
		$price = $arItem['PRICES'][ID_SALE_PRICE]['VALUE'] ? $arItem['PRICES'][ID_SALE_PRICE]['VALUE'] : $arItem['PRICES'][ID_BASE_PRICE]['VALUE'];
		$arResult['ITEMS'][$key]["PRICE_FOR_ONE"] = number_format($price/$arItem['PROPERTIES']["KOLICHESTVO_V_UPAKOVKE"]["VALUE"], 2, '.', ' ');
	}

    //Получаем массив из размеров
    $ar_size = array();
	
if(count($arSizes)>0 && (count($arSizes)!=1 || $arSizes[0]!='DIAMETR_VNUTRENNIY')){
	
        foreach($arSizes as $size){
            $ar_size[] = $arItem['PROPERTIES'][$size]["VALUE"];
        }
    }else{

        $ar_size = array(
            $arItem['PROPERTIES']["DIAMETR"]["VALUE"],
			$arItem['PROPERTIES']['DIAMETR_VNUTRENNIY']["VALUE"],
            $arItem['PROPERTIES']["VYSOTA"]["VALUE"],
            $arItem['PROPERTIES']["SHIRINA"]["VALUE"],
            $arItem['PROPERTIES']["DLINA"]["VALUE"],
			
        );
    }
	
	
    $sizes = array_diff($ar_size, ['']);
    if(count($arSizes) === 1 && $arSizes['0']=='DIAMETR') {

        $arResult['ITEMS'][$key]['SIZES'] = 'M ' . implode($sizes, 'x');
    }else{
        $arResult['ITEMS'][$key]['SIZES']=implode($sizes, 'x');
    }
        //Вводим массив c ключами из размеров с значениями в виде ITEMS id
	if($arItem['PROPERTIES']["DIAMETR_VNUTRENNIY"]["VALUE"]){
		$vnut_diametr = true;
		$ss = str_replace('м', '', $arResult['ITEMS'][$key]['SIZES']);
		$arResult['SIZES'][$ss][$key]=$arResult['ITEMS'][$key];
		
		
	}else{
		$vnut_diametr=false;
		$arResult['SIZES'][$arResult['ITEMS'][$key]['SIZES']][$key]=$arResult['ITEMS'][$key];
	}
    
    
}


if($vnut_diametr){
	//ksort($arResult['SIZES']);
	
}

$arProp = array_diff($arProp, array(''));
$arProp = array_diff($arProp, array('false'));
unset($arProp['Ставки налогов']);
unset($arProp['Базовая единица']);
if(count($arResult['UF_CHARS'])>1)
{
	foreach($arResult['UF_CHARS'] as $char){
		$arVal = explode(';', trim($char,';'));
		$arResult['GENERAL_PROPERTIES'][$arVal[0]]=$arVal[1];
	}
}else{
	$arResult['GENERAL_PROPERTIES']=$arProp;
}

$arResult['PICTURE_RESIZE'] = CFile::ResizeImageGet($arResult['PICTURE']['ID'], array('width'=>200, 'height'=>200), BX_RESIZE_IMAGE_PROPORTIONAL, true);


if($arResult["UF_DOP_SETTINGS"])
{
	foreach($arResult['UF_DOP_SETTINGS'] as $extra_setting)
	{
        $val_enum = CUserFieldEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "ID"=>$extra_setting))->GetNext();
		$arResult['ENUM_LIST'][$val_enum['XML_ID']] = true;
	}
}

foreach($arResult['UF_SOPUT_SPR_ITMES'] as $key=>$value)
{
	$nav = CIBlockSection::GetNavChain(false, $value["IBLOCK_SECTION_ID"]);
	while($arNav = $nav->GetNext())
	{
				
		$res_sect = CIBlockSection::GetList(array("SORT"=>"ASC"), array("IBLOCK_ID"=>SORTING_IBLOCK_ID, 'ID'=>$arNav['ID']), false, Array('CODE', 'UF_DIRECTORY'));
		if($arSect = $res_sect->GetNext())
		{
					
			if($arSect['UF_DIRECTORY'])
			{
				$res_sect = CIBlockSection::GetList(array("SORT"=>"ASC"), array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], 'ID'=>$arSect['UF_DIRECTORY']), false, Array('ID', 'SECTION_PAGE_URL'));
				if($parent_sec_id = $res_sect->GetNext())
				{
					$arResult['UF_SOPUT_SPR_ITMES'][$key]['FULL_URL'] = $parent_sec_id['SECTION_PAGE_URL'].$arResult['UF_SOPUT_SPR_ITMES'][$key]['CODE'];
								
				}
			}
		}
	}
}

\Bitrix\Main\Loader::includeModule('dev2fun.opengraph');
\Dev2fun\Module\OpenGraph::Show($arResult['ID'],'section'); 