<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
require_once($_SERVER["DOCUMENT_ROOT"]."/local/modules/relink.table/lib/table.php");

$ipropSectionValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arResult["IBLOCK_ID"],$arResult["ID"]);
$section_values=$ipropSectionValues->getValues();
$arResult['META_TITLE']=$section_values['SECTION_PAGE_TITLE'];

$nav = CIBlockSection::GetNavChain(false, $arResult["ID"]);
$arSec = $nav->GetNext();

if(!in_array($arSec['ID'], $arParams["VIBOR_CATALOG_TABLE"])){ $arResult['JUST_VERTICAL']='Y';}

foreach($arResult['ITEMS'] as $key=>$arItem){
	$price_result = CPrice::GetList(
		array(),
		array(
			"PRODUCT_ID" => $arItem["ID"], // $arFields2["ID"] - этой мой id товара, может быть и число например 12458
			 // это группа цены, у меня есть как оптовые так и розничная цена
		)
	);
	while ($arPrices = $price_result->Fetch())
	{
		//var_dump($arPrices);
		$arResult['ITEMS'][$key]["PRICES"][$arPrices["CATALOG_GROUP_NAME"]]['VALUE'] = $arPrices["PRICE"]; // тут присваиваю значения переменной 
	}
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
		$arResult['ITEMS'][$key]['STORE'][$DEFAULT_STORE_ID]['AMOUNT'] = $arResult['ITEMS'][$key]['STORE'][$DEFAULT_STORE_ID]['AMOUNT']+$arResult['ITEMS'][$key]['STORE'][3]['AMOUNT']+$arResult['ITEMS'][$key]['STORE'][66]['AMOUNT']+$arResult['ITEMS'][$key]['STORE'][74]['AMOUNT'];
	}
	
	
	if(stripos($arItem['NAME'], 'кг') !== false):
		$arResult['ITEMS'][$key]['UNIT'] = ' кг';
	else:
		$arResult['ITEMS'][$key]['UNIT'] = ' шт.';
	endif;
	
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
}elseif($arResult['UF_CHARS'][0]=='-')
{
	$arResult['GENERAL_PROPERTIES']=[];
}else{
	$arResult['GENERAL_PROPERTIES']=$arProp;
}
