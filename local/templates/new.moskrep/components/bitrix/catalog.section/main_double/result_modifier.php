<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
global $DEFAULT_STORE_ID;

$basket = [];
$basketResultSet = CSaleBasket::GetList(
    ['NAME' => 'ASC'],
    ['FUSER_ID' => CSaleBasket::GetBasketUserID(), 'LID' => SITE_ID, 'ORDER_ID' => 'NULL']
);
while (($basketItem = $basketResultSet->fetch())) {
    $arResult['IN_BASKET'][$basketItem['PRODUCT_ID']] = 'Y';
}




foreach ($arResult['ITEMS'] as $key=>$item) {
	$arResult['arITEMS_ID'][]=$item['ID'];
$ar_result = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $item["IBLOCK_SECTION_ID"]), false, $arSelect = array("*", "UF_*"));

if($arSection = $ar_result->GetNext()) {
    $section_picture = $arSection['PICTURE'];
}



		$arResult['ITEMS'][$key]["SMALL_IMG_WEBP"] = \Bas\Pict::getWebp($arResult['ITEMS'][$key]['PREVIEW_PICTURE'] ? $arResult['ITEMS'][$key]['PREVIEW_PICTURE'] : CFile::GetFileArray($section_picture), CFile::ResizeImageGet($arResult['ITEMS'][$key]['PREVIEW_PICTURE']['ID'] ? $arResult['ITEMS'][$key]['PREVIEW_PICTURE']['ID'] : $section_picture, array('width'=>'179px', 'height'=>'134px', BX_RESIZE_IMAGE_PROPORTIONAL, true))['src']);
		$arResult['ITEMS'][$key]["SMALL_IMG_WEBP"] = \Bas\Pict::getWebp($arResult['ITEMS'][$key]['PREVIEW_PICTURE'] ? $arResult['ITEMS'][$key]['PREVIEW_PICTURE'] : CFile::GetFileArray($section_picture));		

		//echo $arResult['ITEMS'][$key]["SMALL_IMG_WEBP"]['WEBP_SRC']."<br />";
	

if ($section_picture && !$arResult['ITEMS'][$key]['PREVIEW_PICTURE']) $arResult['ITEMS'][$key]['PREVIEW_PICTURE'] = CFile::ResizeImageGet($section_picture, array('width'=>'179px', 'height'=>'134px', BX_RESIZE_IMAGE_PROPORTIONAL, true));


	$rsStore = CCatalogStoreProduct::GetList(array(), array('PRODUCT_ID' => $item['ID']), false, false, array('STORE_ID', 'AMOUNT', 'STORE_NAME'));
    while($arStore = $rsStore->Fetch()){ 
        $arResult['ITEMS'][$key]['STORE'][$arStore['STORE_ID']] = $arStore;
    }
	


	//Выбираем количество. Для СПБ - общее. Для МСК - только со склада в Коледино
	if($_SERVER['HTTP_HOST']=='spb.krep-komp.ru'){
		$arResult['ITEMS'][$key]['STORE'][$DEFAULT_STORE_ID]['AMOUNT'] = $arResult['ITEMS'][$key]['STORE'][$DEFAULT_STORE_ID]['AMOUNT']+$arResult['ITEMS'][$key]['STORE'][3]['AMOUNT'];
	}
}
