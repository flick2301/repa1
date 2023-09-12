<?php
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true) die();

if(CModule::IncludeModule('iblock')){
	$rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),['IBLOCK_ID'=>$arParams["SHOPS_IBLOCK_ID"]]);
	while ($arSect = $rsSect->GetNext())
	{
		$arSelect = Array("*", "PROPERTY_*");
		$arFilter = Array("IBLOCK_ID"=>$arParams["SHOPS_IBLOCK_ID"], "ACTIVE"=>"Y", "SECTION_ID"=>$arSect["ID"]);
		$res = CIBlockElement::GetList(Array("SORT"=>"ASC", "NAME"=>"ASC"), $arFilter, false, Array(), $arSelect);
		
		$countShops[$arSect["NAME"]] = $res->SelectedRowsCount();
	}
	
	$arSelect = Array("*");
	$arFilter = Array("IBLOCK_ID"=>$arParams["SHOPS_IBLOCK_ID"], "ACTIVE"=>"Y", "SECTION_ID"=>"0");
	$res = CIBlockElement::GetList(Array("SORT"=>"ASC", "NAME"=>"ASC"), $arFilter, false, Array(), $arSelect);
		
	$countShops["Москва"] = $res->SelectedRowsCount();
	
	foreach($arResult['ITEMS'] as $item)
	{
		$arResult['ITEMS'][$item['ID']]['SHOPS_COUNT'] = $countShops[$item['NAME']];
	}
	
}