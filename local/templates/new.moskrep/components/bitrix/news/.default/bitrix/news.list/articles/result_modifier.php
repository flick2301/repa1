<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$res = \Bitrix\Iblock\SectionTable::getList([
    'filter'=>['IBLOCK_ID'=>$arParams['IBLOCK_ID']],
]);
while($sec = $res->fetch())
    $arResult['SECTIONS'][$sec['ID']] = $sec;

$rsElement = CIBlockElement::GetList(
    array(),   // сортировка
    ['IBLOCK_ID'=>$arParams['IBLOCK_ID']], // фильтр
    false,     // группировка
    false,     // постраничная навигация
    ['*']  // поля
);

while($obElement = $rsElement->GetNextElement()) {

    $arFields = $obElement->GetFields();
    $res = CIBlockElement::GetByID($arFields['ID']);
    if($ar_res = $res->GetNext())
        $arResult['SHOW_COUNTERS'][$arFields['ID']] = $ar_res['SHOW_COUNTER'];

    // пользовательские свойства
    $arResult['PROPERTIES'][$arFields['ID']] = $obElement->GetProperties();
}




