<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$res = CIBlockElement::GetByID($arResult['ID']);
if($ar_res = $res->GetNext()) {
    $arResult['SHOW_COUNTERS'] = $ar_res['SHOW_COUNTER'];
}

$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
$arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "ID"=>$arResult['ID']);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
if($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    $arResult['PROPERTIES'] = $ob->GetProperties();
}