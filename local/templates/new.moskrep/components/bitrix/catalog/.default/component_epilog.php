<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;
global $sec_builder;

$sorting = $sec_builder->getCurSorting();



$ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(SORTING_IBLOCK_ID,$sorting[0]['ID']);

$IPROPERTY  = $ipropValues->getValues();


if($IPROPERTY['ELEMENT_META_TITLE']!='')
    $APPLICATION->SetPageProperty('title', $IPROPERTY['ELEMENT_META_TITLE']);
if($IPROPERTY['ELEMENT_META_DESCRIPTION'])
    $APPLICATION->SetPageProperty('description', $IPROPERTY['ELEMENT_META_DESCRIPTION']);


