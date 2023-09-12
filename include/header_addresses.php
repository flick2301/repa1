<?php
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true) die();
if($_SERVER['HTTP_HOST']!="krep-komp.ru")
{
	$arSelect = Array("*");
	$arFilter = Array("IBLOCK_ID"=>GEOLOCATION_IBLOCK_ID, "ACTIVE"=>"Y", "PROPERTY_DOMAIN"=>$_SERVER['HTTP_HOST']);
	$res = CIBlockElement::GetList(Array("SORT"=>"ASC", "NAME"=>"ASC"), $arFilter, false, Array(), $arSelect);
	if($arGeo = $res->GetNext())
	{
		$rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),['IBLOCK_ID'=>SHOPS_IBLOCK_ID, 'NAME'=>$arGeo['NAME']]);
		if($arSect = $rsSect->GetNext())
		{
			$arSelect = Array("*", "PROPERTY_*");
			$arFilter = Array("IBLOCK_ID"=>SHOPS_IBLOCK_ID, "ACTIVE"=>"Y", "SECTION_ID"=>$arSect["ID"], '!PROPERTY_TYPE_VALUE'=>['Точка выдачи']);
			$res = CIBlockElement::GetList(Array("SORT"=>"ASC", "NAME"=>"ASC"), $arFilter, false, Array(), $arSelect);
		
			$counts = $res->SelectedRowsCount();
		}
	}
}else{
	$arSelect = Array("*");
	$arFilter = Array("IBLOCK_ID"=>SHOPS_IBLOCK_ID, "ACTIVE"=>"Y", "SECTION_ID"=>"0", '!PROPERTY_TYPE_VALUE'=>['Точка выдачи']);
	$res = CIBlockElement::GetList(Array("SORT"=>"ASC", "NAME"=>"ASC"), $arFilter, false, Array(), $arSelect);
		
	$counts = $res->SelectedRowsCount();
}
if($counts>5)
	$text = $counts.' магазинов';
elseif($counts>1)
	$text = $counts.' магазина';
else
	$text = $counts.' магазин';
if($counts){
?>
<div class="c-header__geo">
	<svg class="c-header__geo-icon" aria-hidden="true" width="9" height="11" viewBox="0 0 9 11" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M4.5 0C2.01868 0 0 1.86296 0 4.15282C0 5.71664 2.2554 8.64258 4.36604 10.8592L4.5 11L4.63366 10.8588C5.65808 9.7763 9 6.09344 9 4.15268C9.00015 1.86296 6.98131 0 4.5 0ZM4.5 5.83361C3.49403 5.83361 2.67858 5.08098 2.67858 4.15268C2.67858 3.22439 3.49403 2.4719 4.5 2.4719C5.50597 2.4719 6.32142 3.22453 6.32142 4.15282C6.32142 5.08112 5.50597 5.83361 4.5 5.83361Z" fill="currentColor"></path>
	</svg>      
																						
	<div class="adress_header">
		<a href="/addresses/" class="adress_header_link" style="display: block;"><?=$text?></a>
	</div>
</div>
<?
}