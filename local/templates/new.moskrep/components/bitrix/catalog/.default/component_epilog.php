<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;
global $sec_builder;


$sorting = $sec_builder->curSorting;



$ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(SORTING_IBLOCK_ID, end($sorting)['ID']);

$IPROPERTY  = $ipropValues->getValues();

$sorting = $sec_builder->getCurSorting();
echo '<!--';
var_dump($sorting);
echo '-->';
if(!empty($sorting[0]['arFilters']['VALUE'])) {
	$arResult["VARIABLES"]["SECTION_ID"] = $sec_builder->getCurSection();

	$ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(SORTING_IBLOCK_ID,$sorting[0]['ID']);
	$IPROPERTY  = $ipropValues->getValues();
	if($IPROPERTY['ELEMENT_PAGE_TITLE']!='')
		$APPLICATION->SetPageProperty('page_title', $IPROPERTY['ELEMENT_PAGE_TITLE']);
	if($IPROPERTY['ELEMENT_META_TITLE']!='')
	{
		$APPLICATION->SetPageProperty('title', $IPROPERTY['ELEMENT_META_TITLE']);
		
	}
	if($IPROPERTY['ELEMENT_META_DESCRIPTION'])
    $APPLICATION->SetPageProperty('description', $IPROPERTY['ELEMENT_META_DESCRIPTION']);
}elseif(!empty($sorting[0]['ID']))
{
	$ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(SORTING_IBLOCK_ID,$sorting[0]['ID']);
	$IPROPERTY  = $ipropValues->getValues();
	if($IPROPERTY['ELEMENT_PAGE_TITLE']!='')
		$APPLICATION->SetPageProperty('page_title', $IPROPERTY['ELEMENT_PAGE_TITLE']);
	if($IPROPERTY['ELEMENT_META_TITLE']!='')
	{
		
		$APPLICATION->SetPageProperty('title', $IPROPERTY['ELEMENT_META_TITLE']);
		$APPLICATION->SetTitle($IPROPERTY['ELEMENT_META_TITLE']);
		
	}
	if($IPROPERTY['ELEMENT_META_DESCRIPTION'])
    $APPLICATION->SetPageProperty('description', $IPROPERTY['ELEMENT_META_DESCRIPTION']);
}

	






