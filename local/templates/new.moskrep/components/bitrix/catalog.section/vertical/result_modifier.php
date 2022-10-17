<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
require_once($_SERVER["DOCUMENT_ROOT"]."/local/modules/relink.table/lib/table.php");
// подключаем пространство имен класса HighloadBlockTable и даём ему псевдоним HLBT для удобной работы
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
$module_id = 'relink.table';

global $DEFAULT_STORE_ID;
global $filterObj;

use Bitrix\Main\Loader;
//подключаем модуль highloadblock
CModule::IncludeModule('highloadblock');
if (!Loader::includeModule($module_id))
    return;
//подключаем модуль highloadblock
CModule::IncludeModule('highloadblock');

$intCount = \Bitrix\Iblock\SectionTable::getList([
    'select'=>['*'],
    'filter'=>[
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'IBLOCK_SECTION_ID' => $arResult["ID"],
        'ACTIVE'=>'Y'
    ]]);

if(!count($intCount->fetchAll()))
{
    //MAX цена
    $db_price_max = CIBlockElement::GetList(
        array("CATALOG_PRICE_9" => "ASC"),
        array("IBLOCK_ID" => $arParams["IBLOCK_ID"],"IBLOCK_SECTION_ID"=>$arResult["ID"],"ACTIVE"=>"Y"),
        false,
        array(),
        array()
    );
    while($ob_price_max = $db_price_max->GetNextElement())
    {
        $arPrices[] = $ob_price_max->GetFields();
        if($ob_price_max->GetFields()['CATALOG_PRICE_9'])
            (int) $pmax= $ob_price_max->GetFields()['CATALOG_PRICE_9'];
    }

//MIN цена
    $db_price_min = CIBlockElement::GetList(
        array("CATALOG_PRICE_9" => "DESC"),
        array("IBLOCK_ID" => $arParams["IBLOCK_ID"],"SECTION_ID"=>$arResult["ID"],"ACTIVE"=>"Y"),
        false,
        array(),
        array()
    );
    while($ob_price_min = $db_price_min->GetNextElement())
    {
        $arPrices[] = $ob_price_min->GetFields();
        if($ob_price_min->GetFields()['CATALOG_PRICE_9'])
            (int) $pmin= $ob_price_min->GetFields()['CATALOG_PRICE_9'];
    }

    $arEgor = [
        "@context"=>"https://schema.org/",
        "@type"=>"Product",
        "name"=>$arResult['NAME'],
        "image"=>$_SERVER[HTTP_HOST].$arResult['PICTURE']['SRC'],
        "description"=>html_entity_decode($arResult['DESCRIPTION'], ENT_QUOTES, "UTF-8"),
        "brand"=>[
            "@type"=>"Brand",
            "name"=>"Интернет-магазин строительного крепежа «КРЕП-КОМП»"
        ],
        "offers"=>[
            "@type"=>"AggregateOffer",
            "priceCurrency"=>"RUB",
            "offerCount"=>count($arPrices)/2,
            "lowPrice"=>$pmin,
            "highPrice"=>$pmax,
        ]
    ];
    $arResult['EGOR_SCRIPT_AR']=$arEgor;

}
$relinkList = \Relink\Table\LinksTable::getList(array("select" => array('*'), "filter" => array("=DONOR_ID" => $arResult['ID'])));
while($arRelink = $relinkList->fetch()){
    $arResult['RELINK'][] = $arRelink;
}

$nav = CIBlockSection::GetNavChain(false, $arResult['ID']);
while($nw = $nav->Fetch()){
    $arTempID[]=$nw['ID'];
    $arTempName[]=$nw['NAME'];
}

$arFilter = array('IBLOCK_ID' => IBLOCK_ID_CERT, "UF_SEC_CAT"=>$arTempID);
$rsSections = CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter, false, array("*", "UF_*"));
while($arSection = $rsSections->GetNext())
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
	 $arResult['UF_INCLUDE_FILE_AFTER_DESC'] = $arSection["UF_INCLUDE_FILE_AFTER_DESC"];
	 
	$this->__component->SetResultCacheKeys(array("UF_META_TITLE_MSK"));
	$this->__component->SetResultCacheKeys(array("UF_META_DESCRIPTION_MSK"));
	$this->__component->SetResultCacheKeys(array("UF_META_TITLE"));
	$this->__component->SetResultCacheKeys(array("UF_META_DESCRIPTION_SPB"));
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

$ipropSectionValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arResult["IBLOCK_ID"],$arResult["ID"]);
$section_values=$ipropSectionValues->getValues();
$arResult['META_TITLE']=$section_values['SECTION_PAGE_TITLE'];

$nav = CIBlockSection::GetNavChain(false, $arResult["ID"]);
$arSec = $nav->GetNext();

if(!in_array($arSec['ID'], $arParams["VIBOR_CATALOG_TABLE"])){ $arResult['JUST_VERTICAL']='Y';}

foreach($arResult['ITEMS'] as $key=>$arItem){
	$arResult['arITEMS_ID'][]=$arItem['ID'];
    if(isset($arItem['PREVIEW_PICTURE']['ID'])){
      $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('height'=>'150'), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    }else{
      $file = CFile::ResizeImageGet($arResult['PICTURE']['ID'], array('height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, true);  
    }
    if($file['src']):
    $arResult['ITEMS'][$key]['PREVIEW_PICTURE'] = $file;
    else:
    $arResult['ITEMS'][$key]['PREVIEW_PICTURE']['src'] = '/images/no_image.jpg';   
    endif;
	
	$rsStore = CCatalogStoreProduct::GetList(array(), array('PRODUCT_ID' => $arItem['ID']), false, false, array('STORE_ID', 'AMOUNT', 'STORE_NAME'));
    while($arStore = $rsStore->Fetch()){
        $arResult['ITEMS'][$key]['STORE'][$arStore['STORE_ID']] = $arStore;
    }
	//Выбираем количество. Для СПБ - общее. Для МСК - только со склада в Коледино
	if($_SERVER['HTTP_HOST']=='spb.krep-komp.ru'){
		$arResult['ITEMS'][$key]['STORE'][$DEFAULT_STORE_ID]['AMOUNT'] = $arResult['ITEMS'][$key]['STORE'][$DEFAULT_STORE_ID]['AMOUNT']+$arResult['ITEMS'][$key]['STORE'][3]['AMOUNT'];
	}
	
	
	if(stripos($arItem['NAME'], 'кг') !== false):
		$arResult['ITEMS'][$key]['UNIT'] = ' кг';
	else:
		$arResult['ITEMS'][$key]['UNIT'] = ' шт.';
	endif;

}


