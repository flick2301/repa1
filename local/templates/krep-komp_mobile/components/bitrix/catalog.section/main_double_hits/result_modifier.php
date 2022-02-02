<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$basket = [];
$basketResultSet = CSaleBasket::GetList(
    ['NAME' => 'ASC'],
    ['FUSER_ID' => CSaleBasket::GetBasketUserID(), 'LID' => SITE_ID, 'ORDER_ID' => 'NULL']
);
while (($basketItem = $basketResultSet->fetch())) {
    $arResult['IN_BASKET'][$basketItem['PRODUCT_ID']] = 'Y';
}



foreach ($arResult['ITEMS'] as $key=>$item) {
	$ar_result = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $item["IBLOCK_SECTION_ID"]), false, $arSelect = array("*", "UF_*"));

	if($arSection = $ar_result->GetNext()) {
		$section_picture = $arSection['PICTURE'];
	}
	
		$arResult['ITEMS'][$key]["SMALL_IMG_WEBP"] = \Bas\Pict::getWebp($arResult['ITEMS'][$key]['PREVIEW_PICTURE'] ? $arResult['ITEMS'][$key]['PREVIEW_PICTURE'] : CFile::GetFileArray($section_picture), CFile::ResizeImageGet($arResult['ITEMS'][$key]['PREVIEW_PICTURE']['ID'] ? $arResult['ITEMS'][$key]['PREVIEW_PICTURE']['ID'] : $section_picture, array('width'=>'179px', 'height'=>'134px', BX_RESIZE_IMAGE_PROPORTIONAL, true))['src']);
		$arResult['ITEMS'][$key]["SMALL_IMG_WEBP"] = \Bas\Pict::getWebp($arResult['ITEMS'][$key]['PREVIEW_PICTURE'] ? $arResult['ITEMS'][$key]['PREVIEW_PICTURE'] : CFile::GetFileArray($section_picture));		

		//echo $arResult['ITEMS'][$key]["SMALL_IMG_WEBP"]['WEBP_SRC']."<br />";
	


	if ($section_picture && !$arResult['ITEMS'][$key]['PREVIEW_PICTURE']) $arResult['ITEMS'][$key]['PREVIEW_PICTURE'] = CFile::ResizeImageGet($section_picture, array('width'=>'179px', 'height'=>'134px', BX_RESIZE_IMAGE_PROPORTIONAL, true));
	
	$res = CIBlockElement::GetList(array(), array('ID'=>$item["ID"]), false, false, array('ID', 'IBLOCK_ID', 'NAME', 'DETAIL_PAGE_URL', 'IBLOCK_SECTION_ID'));
    $arElement = $res->GetNext();
	$arResult['ITEMS'][$key]['DETAIL_PAGE_URL'] = $arElement['DETAIL_PAGE_URL'];
}
