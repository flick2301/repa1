<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
require_once($_SERVER["DOCUMENT_ROOT"]."/local/modules/relink.table/lib/table.php");
$module_id = 'relink.table';

global $sec_builder;
global $filterObj;

\Bitrix\Main\Loader::includeModule("highloadblock");

use \Bitrix\Highloadblock as HL; 
use \Bitrix\Main\Entity;

if(strpos($_SERVER["HTTP_HOST"], 'dev') === false)
{
	$hlbl = 11; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
	$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch(); 

	$entity = HL\HighloadBlockTable::compileEntity($hlblock); 
	$entity_data_class = $entity->getDataClass(); 
	$rsData = $entity_data_class::getList(array(
			"select" => array("*"),
			"order" => array("ID" => "ASC"),
			"filter" => array("UF_CATALOG_ELEMENTS"=>$arResult['ID'])  // Задаем параметры фильтра выборки
	));
	while($arData = $rsData->Fetch()){
			$arSorts[] = $arData;
	}
}
$sortSection['ACTIVES']=0;

if(!empty($arSorts))
{
	foreach($arSorts as $sort)
	{
		$sec_builder->setCurSorting($sort['UF_SORT_ID']);
		$sec_builder->setCurSection($sort['UF_CATALOG_SECTION_ID']);

		$link = $sec_builder->linkBuilder($sec_builder->curSorting, $sortSection);
		$add = $sec_builder->getArrAddress();
		$name =$sec_builder->curSorting['H1']['VALUE'] ?? $sec_builder->curSorting['NAME'];
		$arResult['SORT_ITEMS'][] = ['NAME'=>$name, 'LINK'=>$link];
		//var_dump($sec_builder->curSorting['NAME']);
		//var_dump($link);
		//var_dump($add);
	}
}

/*$cp = $this->__component; // объект компонента
if (is_object($cp))
   $cp->SetResultCacheKeys(array('TIMESTAMP_X'));*/
global $DEFAULT_STORE_ID;

use Bitrix\Main\Loader;
if (!Loader::includeModule($module_id))
    return;

$relinkList = \Relink\Table\LinksTable::getList(array("select" => array('*'), "filter" => array("=DONOR_ID" => $arResult['ID'])));
while($arRelink = $relinkList->fetch()){
    $arResult['RELINK'][] = $arRelink;
}
//НЕОБХОДИМО ПРОВЕРИТЬ DETAIL_PAGE_URL И URL ТЕКУЩЕЙ СТРАНИЦЫ, ЧТОБЫ ВЫДАВАЛО 404 ОШИБКУ
//ЕСЛИ НА СТРАНИЦУ ЭЛЕМЕНТА ПЕРЕШЛИ ПО ДРУГОМУ АДРЕСУ( ЧЕРЕЗ ДРУГУЮ ДИРИКТОРИЮ).
$dir = $APPLICATION->GetCurDir();
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), array("IBLOCK_ID"=>$arResult["IBLOCK_ID"], "ID"=>$arResult["ID"]), Array("*"));
while($ar_fields = $res->GetNext()){
    if ($dir.$arResult['CODE'].'.html' != $ar_fields['DETAIL_PAGE_URL'])
    {
        @define("ERROR_404", "Y");
        if($arParams["SET_STATUS_404"]==="Y")
            CHTTP::SetStatus("404 Not Found");
    }
}
//КОНЕЦ ПРОВЕРКИ
$rsStore = CCatalogStoreProduct::GetList(array(), array('PRODUCT_ID' => $arResult['ID']), false, false, array('STORE_ID', 'AMOUNT', 'STORE_NAME'));
    while($arStore = $rsStore->Fetch()){
        $arResult['STORE'][$arStore['STORE_ID']] = $arStore;
    }
//ВЫЧИСЛЯЕМ ЕДИНИЦЫ ИЗМЕРЕНИЯ
if(stripos($arResult['NAME'], 'кг') !== false):
    $arResult['UNIT'] = ' кг';
else:
    $arResult['UNIT'] = ' шт.';
endif;


 foreach($arResult['DISPLAY_PROPERTIES'] as $key => $value){
       if(in_array($value['CODE'], ARR_UINTS_MM)){
         $arResult['DISPLAY_PROPERTIES'][$key]['VALUE'] .= ' мм';
       }
       elseif(in_array($value['CODE'], ARR_UNITS_SHT)){
         $arResult['DISPLAY_PROPERTIES'][$key]['VALUE'] .= $arResult['UNIT'];
       }
       elseif(in_array($value['CODE'], ARR_UNITS_RAL)){
         $arResult['DISPLAY_PROPERTIES'][$key]['VALUE'] .= ' RAL';
       }
}

//КОНЕЦ БЛОКА



//ОБЩЕЕ КОЛИЧЕСТВО **РЕШИЛИ УБРАТЬ, ОСТАВИТЬ ТОЛЬКО КОЛЕДИНО
//$arResult['ELEMENT_COUNT'] = $arResult['CATALOG_QUANTITY']+$arResult['CATALOG_QUANTITY_RESERVED'];

$rsStoreProduct = \Bitrix\Catalog\StoreProductTable::getList(array(
		'filter' => array('=PRODUCT_ID'=>$arResult['ID'],'STORE.ACTIVE'=>'Y','STORE.ID'=>3),
		'select' => array('AMOUNT','STORE_ID','STORE_TITLE' => 'STORE.TITLE'),
	));
	if($arStoreProduct=$rsStoreProduct->fetch())
	{
		$arResult['ELEMENT_COUNT'] = $arStoreProduct['AMOUNT'];
	}




//ДЕЛИМ ВСЕ ХАРАКТЕРИСТИКИ НА ДВА СТОЛБИКА (СЕЙЧАС НЕ НУЖНО, НО ВДРУГ ОПЯТЬ ВЕРНУТ ГОРЕ ДИЗАЙНЕРЫ)
foreach($arResult['DISPLAY_PROPERTIES'] as $key=>$arProp):
    if($key != "IN_STOCK" && $key != "FOR_SALE"):
       $arResult['BASE_PROPERTIES'][$key]= $arResult['DISPLAY_PROPERTIES'][$key];
    endif;
endforeach;
$arResult['BASE_PROPERTIES_HEAD'] = array_slice($arResult['BASE_PROPERTIES'],0,4);

if(count($arResult['BASE_PROPERTIES'])%2){
    $ul1 = (count($arResult['BASE_PROPERTIES'])+1)/2;
    $ul2 = count($arResult['BASE_PROPERTIES'])-$ul1;
}else{
   $ul1= count($arResult['BASE_PROPERTIES'])/2;
   $ul2=$ul1;
}

$arResult['BASE_PROPERTIES_UL1'] = array_slice($arResult['BASE_PROPERTIES'],0,$ul1);
$arResult['BASE_PROPERTIES_UL2'] = array_slice($arResult['BASE_PROPERTIES'],$ul1,$ul2);


if($arResult['PROPERTIES']['ROOT_DESCRIPTION']['VALUE']['TEXT']){
	$arResult['DETAIL_DESCRIPTION'] =$arResult['PROPERTIES']['ROOT_DESCRIPTION']['VALUE']['TEXT'];
}

if($arResult['PROPERTIES']['ROOT_NAME']['VALUE'])
	$arResult['NAME']=$arResult['PROPERTIES']['ROOT_NAME']['VALUE'];
//КОНЕЦ БЛОКА

//ПОДГРУЖАЕМ СЕРТИФИКАТЫ ИЗ ДРУГОГО ИНФОБЛОКА, ДЛЯ ЭТОГО НУЖНО ПОЛУЧИТЬ ID ВСЕХ ВЕРХНИХ РАЗДЕЛОВ
//И ПРОСМОТРЕТЬ ПРИВЯЗАННЫЕ К НИМ СЕРТИФИКАТЫ
$nav = CIBlockSection::GetNavChain(false, $arResult['IBLOCK_SECTION_ID']);
while($nw = $nav->Fetch()){
    $arTempID[]=$nw['ID'];
}

$arFilter = array('IBLOCK_ID' => IBLOCK_ID_CERT, "UF_SEC_CAT"=>$arTempID);
$rsSections = CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter, false, array("*", "UF_*"));
while($arSection = $rsSections->GetNext())
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
//КОНЕЦ БЛОКА



$ar_result = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arResult["IBLOCK_SECTION_ID"]), false, $arSelect = array("*", "UF_*"));

if($arSection = $ar_result->GetNext()) {

    $arResult["RELATED"] = $arSection["UF_RELATED"];
	$arResult["SECTION_PICTURE"]=$arSection['PICTURE'];
	$arResult["SOPUT_PROPERTY"]=$arSection["UF_SOPUT_PROPERTY"];

}

//Подбор сопутствующих товаров по свойству, нужен getlist на все верхние подразделы, будут
//проверены все верхние подразделы пока не найдется первый с заполненным свойством
$ar_result = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arTempID), false, $arSelect = array("*", "UF_*"));
while($arSection = $ar_result->GetNext())
{
	if($arSection["UF_S_ETIM_TOVAROM"])
	{
		$arResult["S_ETIM_TOVAROM"] = $arSection["UF_S_ETIM_TOVAROM"];
		$arResult["S_ETIM_TOVAROM_PROPERTIES"] = $arSection["UF_S_ETIM_TOVAROM_PROPERTIES"];
		$ar_props = CUserFieldEnum::GetList([], ['ID'=>$arResult["S_ETIM_TOVAROM_PROPERTIES"]]);
		while($prop = $ar_props->GetNext())
		{
			$props['PROPERTY_'.$prop['VALUE'].'_VALUE'] = $arResult['DISPLAY_PROPERTIES'][$prop['VALUE']]['VALUE'];
		}
		$filter = array_merge(['IBLOCK_ID' => $arParams['IBLOCK_ID'], 'INCLUDE_SUBSECTIONS'=>'Y', 'CATALOG_AVAILABLE'=>'Y', 'ACTIVE'=>'Y',  'SECTION_ID'=>$arResult["S_ETIM_TOVAROM"]], $props);

		// выборка списка элементов
		$dbItems = CIBlockElement::GetList(Array(), $filter, false, array(), array('ID', 'NAME', 'IBLOCK_ID'));
        global $baFilter;
		while ($arItem = $dbItems->GetNext()){
			$baFilter['ID'][] = $arItem['ID'];
		}

		break;
	}
}


if($arResult['DETAIL_PICTURE']['ID']){
    $arResult['PREVIEW_PICTURE'] = CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], array('width'=>$arParams['ITEMS_DETAIL_PIC_W'], 'height'=>$arParams['ITEMS_DETAIL_PIC_H']), BX_RESIZE_IMAGE_PROPORTIONAL, true);

}else{
   $arResult['PREVIEW_PICTURE'] = CFile::ResizeImageGet($arResult['SECTION_PICTURE'], array('width'=>$arParams['ITEMS_DETAIL_PIC_W'], 'height'=>$arParams['ITEMS_DETAIL_PIC_H']), BX_RESIZE_IMAGE_PROPORTIONAL, true);
   if($arResult['PREVIEW_PICTURE']['src']==false):
        $arResult['PREVIEW_PICTURE']['src']='/images/no_image.jpg';
    endif;
}

$rsStore = CCatalogStoreProduct::GetList(array(), array('PRODUCT_ID' => $arResult['ID']), false, false, array('STORE_ID', 'AMOUNT', 'STORE_NAME'));
while($arStore = $rsStore->Fetch()){
    $arResult['STORE'][$arStore['STORE_ID']] = $arStore;
}

$db_res = CPrice::GetList(
    array('ASC'=>'PRICE'),
    array(
        'PRODUCT_ID' => $arResult['ID'],
        'CATALOG_GROUP_ID' => array(ID_PRICE_5, ID_PRICE_10, ID_PRICE_15, ID_PRICE_20, ID_PRICE_25, ID_PRICE_30, ID_PRICE_35),
    )
);
$arResult["DOP_PRICE"] = array();
while($ar_res = $db_res->Fetch())
{
    $arResult["DOP_PRICE"][] = round($ar_res['PRICE'], 2);
}
rsort($arResult["DOP_PRICE"]);




//ВЫВОДИМ ЭЛЕМЕНТЫ С ОДИНАКОВЫМИ РАЗМЕРАМИ НО РАЗНОЙ УПАКОВКОЙ
//И СЛЕДУЮЩИЕ ТОВАРЫ ПО СПИСКУ С ЗАКОЛЬЦОВКОЙ
$arOrder = Array("PROPERTY_DIAMETR"=>"ASC", "PROPERTY_DLINA"=>"ASC");
$arFilter = array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "SECTION_ID" => $arResult['IBLOCK_SECTION_ID']);
$arSelect = array('*');
$db_elemens = CIblockElement::GetList($arOrder, $arFilter, false, array(), $arSelect);

$ar_size = array(
            "DIAMETR"=>$arResult['PROPERTIES']["DIAMETR"]["VALUE"],
            "VYSOTA"=>$arResult['PROPERTIES']["VYSOTA"]["VALUE"],
            "SHIRINA"=>$arResult['PROPERTIES']["SHIRINA"]["VALUE"],
            "DLINA"=>$arResult['PROPERTIES']["DLINA"]["VALUE"],
            );
$size = array_diff($ar_size, ['']);

while($obElement = $db_elemens->GetNext())
{
    $conformity = true;
    foreach($size as $key=>$val){
        if($obElement['PROPERTY_'.$key.'_VALUE'] != $val)
            $conformity = false;
    }
    if($conformity && $arResult['ID'] != $obElement['ID']){
        $arResult['ELEMENT_VARS'][] = $obElement['ID'];
    }else{

        $arElements[] = $obElement['ID'];
        if($obElement['ID']==$arResult['ID'])
            $indexElement = count($arElements);

    }

}

if((count($arElements) - $indexElement) < 3){
$startTable = 3 - (count($arElements) - $indexElement);

$arResult['ELEMENT_NEXT'] = array_merge(array_slice($arElements, $indexElement, count($arElements) - $indexElement), array_slice($arElements, 0, $startTable));
}else{
$arResult['ELEMENT_NEXT'] = array_slice($arElements, $indexElement, 3);
}

if($_SERVER['HTTP_HOST']=='spb.krep-komp.ru'){
	$arResult['STORE'][$DEFAULT_STORE_ID]['AMOUNT'] = $arResult['STORE'][$DEFAULT_STORE_ID]['AMOUNT']+$arResult['STORE'][3]['AMOUNT']+$arResult['STORE'][66]['AMOUNT']+$arResult['STORE'][74]['AMOUNT'];
}

\Bitrix\Main\Loader::includeModule('dev2fun.opengraph');
\Dev2fun\Module\OpenGraph::Show($arResult['ID'],'element');
if($arResult['PROPERTIES']['noindex']['VALUE_XML_ID']=='Y')
    $APPLICATION->SetPageProperty('robots', 'noindex, nofollow');

$arSelect = Array("ID", "PROPERTY_SITES", "PROPERTY_MIN_DELIVERY");
$arFilter = ["IBLOCK_ID"=>22, "ACTIVE"=>"Y", 'PROPERTY_SITES'=>[$_SERVER['HTTP_HOST']]];
$res = CIBlockElement::GetList(['ID'=>'DESC'], $arFilter, false, Array("nPageSize"=>50), $arSelect);
if($ob = $res->GetNext())
{
    $arResult['PROPERTIES']['PROPERTY_MIN_DELIVERY_VALUE'] = $ob['PROPERTY_MIN_DELIVERY_VALUE'];
}

$arFilter = array("IBLOCK_ID" => 19, "ACTIVE" => "Y", "CODE"=>$_SERVER['HTTP_HOST']);
$arSelect = array("ID", "IBLOCK_ID", "NAME", "CODE");
$rsSect = CIBlockSection::GetList(Array(), $arFilter, false, $arSelect, Array("iNumPage"=>1));
if ($arSection = $rsSect->GetNext()) {
    if ($arSection["ID"])
	{
	
		$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "DETAIL_TEXT", "IBLOCK_SECTION_ID", "PROPERTY_*");
		$arFilter = Array("IBLOCK_ID"=>19, "ACTIVE"=>"Y", "SECTION_ID"=>$arSection["ID"]);
		$res = \CIBlockElement::GetList(Array("SORT"=>"ASC", "ID"=>"ASC"), $arFilter, false, Array(), $arSelect);				
		while($ob = $res->GetNextElement())
           {
			   
               $fields = $ob->GetFields();
               $props = $ob->GetProperties();
			   
               $amount = \Bitrix\Catalog\StoreProductTable::getList([
                   'filter' => [
                       'PRODUCT_ID' => $arResult["ID"],
                       'STORE_ID'=>$props['SKLAD_ID']['VALUE'],
                   ],
                   'select'=>['*'],
               ])->fetch();
               $arResult['STORE_AMOUNT'] += $amount['AMOUNT'];
			   if($props["TYPE"]["VALUE"]=="Магазин" || $props["TYPE"]["VALUE"]=="Магазин и точка выдачи"){
				   $arResult['ONLY_STORE_AMOUNT'] += $amount['AMOUNT'];
				   $arResult['ONLY_STORE_COUNT']++;
			   }
		   }
	}
	
}



