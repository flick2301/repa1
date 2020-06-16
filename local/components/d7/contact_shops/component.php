<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true) die();

if(CModule::IncludeModule('iblock')){


	
	$obCache = new CPHPCache();

	
if($obCache->InitCache(360000, "contact_shops".$arParams["SECTION_ID"].$_REQUEST["ID"], "/"))// Если кэш валиден
{
   $vars = $obCache->GetVars();// Извлечение переменных из кэша
   $arResult = $vars["RESULT"];
}
elseif($obCache->StartDataCache())// Если кэш невалиден
{	

		
		$i = 0;
		$lat = 0;
		$lon = 0;
		$center_count = 0;
		$lat_min = 0;		
		$lat_max = 0;
		$lon_min = 0;			
		$lon_max = 0;	
		
		$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "DETAIL_TEXT", "IBLOCK_SECTION_ID", "PROPERTY_*");
		$arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE"=>"Y", "SECTION_ID"=>"");
		$arParams["SECTION_ID"] ? $arFilter['SECTION_ID'] = $arParams["SECTION_ID"] : "";
		
		if ($_REQUEST["ID"]) $arFilter['ID'] = $_REQUEST["ID"];
		
		$res = CIBlockElement::GetList(Array("SORT"=>"ASC", "ID"=>"ASC"), $arFilter, false, Array(), $arSelect);
		while($ob = $res->GetNextElement())
		{
			$arResult["ITEMS"][$i] = $ob->GetFields();
			$arResult["ITEMS"][$i]['PROP'] = $ob->GetProperties();
			$payment = CIBlockElement::GetByID($arResult["ITEMS"][$i]['PROP']["PAYMENT"]["VALUE"]);
			$arResult["ITEMS"][$i]['PROP']["PAYMENT_NAME"] =  $payment->GetNext();
			if ($arResult["ITEMS"][$i]['PROP']["LAT"]["VALUE"] && $arResult["ITEMS"][$i]['PROP']["LON"]["VALUE"]) {
				$lat += $arResult["ITEMS"][$i]['PROP']["LAT"]["VALUE"];
				$lon += $arResult["ITEMS"][$i]['PROP']["LON"]["VALUE"];
				if (!$lat_min || $lat_min > $arResult["ITEMS"][$i]['PROP']["LAT"]["VALUE"]) $lat_min = $arResult["ITEMS"][$i]['PROP']["LAT"]["VALUE"];
				if (!$lat_max || $lat_max < $arResult["ITEMS"][$i]['PROP']["LAT"]["VALUE"]) $lat_max = $arResult["ITEMS"][$i]['PROP']["LAT"]["VALUE"];
				if (!$lon_min || $lon_min > $arResult["ITEMS"][$i]['PROP']["LON"]["VALUE"]) $lon_min = $arResult["ITEMS"][$i]['PROP']["LON"]["VALUE"];
				if (!$lon_max || $lon_max < $arResult["ITEMS"][$i]['PROP']["LON"]["VALUE"]) $lon_max = $arResult["ITEMS"][$i]['PROP']["LON"]["VALUE"];		
				$center_count++;
			}
			if($arResult["ITEMS"][$i]['PROP']["SHEME_IMG"]["VALUE"]) $arResult["ITEMS"][$i]["SCHEME"] = CFile::GetPath($arResult["ITEMS"][$i]['PROP']["SHEME_IMG"]["VALUE"]);
			if($arResult["ITEMS"][$i]['PROP']["VIDEO"]["VALUE"]) $arResult["ITEMS"][$i]["VIDEO"] = CFile::GetPath($arResult["ITEMS"][$i]['PROP']["VIDEO"]["VALUE"]);
			
			if (is_array($arResult["ITEMS"][$i]['PROP']["PHOTO"]["VALUE"])) {
				foreach($arResult["ITEMS"][$i]['PROP']["PHOTO"]["VALUE"] AS $img) {
					$arResult["ITEMS"][$i]["IMG"][] = CFile::GetPath($img);
				}
			}	
		if ($_REQUEST["ID"]) $arResult['SELECT'] = $arParams["SECTION_ID"];
			$i++;
		}
		
		if ($center_count) {
			$arResult["LAT"] = $lat / $center_count;
			$arResult["LON"] = $lon / $center_count;
		}	
		
$zoom_lon = ($arResult["LON"] - $lon_min) + ($lon_max - $arResult["LON"]);	
$zoom_lat = ($arResult["LAT"] - $lat_min) + ($lat_max - $arResult["LAT"]);	

$zoom = $zoom_lon < $zoom_lat ? $zoom_lat : $zoom_lon;

if (count($arResult["ITEMS"])==1) $arResult["ZOOM"] = 15;
else $arResult["ZOOM"] = round(pi() * 2 / $zoom);


	
	$obCache->EndDataCache(array(
        "RESULT"    => $arResult
        ));// Сохраняем переменные в кэш.	
		
   }   
   
	if (count($arResult["ITEMS"]) >= 1) $this->IncludeComponentTemplate();	
} 
			
?>