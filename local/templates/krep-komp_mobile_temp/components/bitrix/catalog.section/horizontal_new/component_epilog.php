<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arParams["IBLOCK_ID"],$arResult['ID']);
$IPROPERTY  = $ipropValues->getValues();

$APPLICATION->SetPageProperty('title', $IPROPERTY['SECTION_META_TITLE']);
$APPLICATION->SetPageProperty('description', $IPROPERTY['SECTION_META_DESCRIPTION']);
$APPLICATION->SetPageProperty('keywords', $IPROPERTY['SECTION_META_KEYWORDS']);

if($arResult["UF_META_TITLE_MSK"] && $_SERVER['HTTP_HOST'] == 'krep-komp.ru')
{
	$APPLICATION->SetPageProperty('title', $arResult["UF_META_TITLE_MSK"]);
}elseif($arResult["UF_META_TITLE"] && $_SERVER['HTTP_HOST'] == 'spb.krep-komp.ru')
{
	
	$APPLICATION->SetPageProperty('title', $arResult["UF_META_TITLE"]);
}
		
if($arResult["UF_META_DESCRIPTION_MSK"] && $_SERVER['HTTP_HOST'] == 'krep-komp.ru')
{
	$APPLICATION->SetPageProperty('description', $arResult["UF_META_DESCRIPTION_MSK"]);
}elseif($arResult["UF_META_DESCRIPTION_SPB"] && $_SERVER['HTTP_HOST'] == 'spb.krep-komp.ru')
{
	$APPLICATION->SetPageProperty('description', $arResult["UF_META_DESCRIPTION_SPB"]);
}