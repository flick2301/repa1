<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true) die();

if(CModule::IncludeModule("iblock")){
	
include_once("functions.php");	

	
	$obCache = new CPHPCache();

if($obCache->InitCache($arParams["CACHE_TIME"], $componentName.$componentTemplate.$arParams["IBLOCK_ID"], "/"))// Если кэш валиден
{
   $vars = $obCache->GetVars();// Извлечение переменных из кэша
   $arResult = $vars["RESULT"];
}
elseif($obCache->StartDataCache())// Если кэш невалиден
{	

		$arSort = array("SORT" => "ASC", "ID" => "ASC");
		$arFilter = array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arParams["SECTIONS"], "ACTIVE" => "Y");
		if ($arParams["SECTION_ID"]) $arFilter["SECTION_ID"] = $arParams["SECTION_ID"];
        $arSelect = array("ID", "IBLOCK_ID", "NAME", "CODE");
		$rsSect = CIBlockSection::GetList($arSort, $arFilter, true, $arSelect, Array("nPageSize"=>50));
		while ($arSect = $rsSect->GetNext()) {//echo 111;
			$arResult["SECTIONS"][] = $arSect;
		}
	
	$obCache->EndDataCache(array(
        "RESULT"    => $arResult
        ));// Сохраняем переменные в кэш.	
		
   }  
   

$arResult["NAMES"] = Array();         

if($_POST["TYPE"]) {
	$arResultFunction = widgetGetNames($arParams, htmlspecialcharsbx($_POST["TYPE"]));
	$arResult["NAMES"] = $arResultFunction[0];
	$arResult["LOG"] .= $arResultFunction[1];
}	

$arResult["DIAMETR"] = Array();

if($_POST["NAMES"]) {
		$arFilter = array('IBLOCK_ID' => $arParams["IBLOCK_ID"], 'ACTIVE' => 'Y', 'SECTION_ID'=>$_POST["NAMES"]);
        $arSelect = array("ID", "IBLOCK_ID", "NAME", "CODE");
        $res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, Array(), $arSelect);  

		while($ob = $res->GetNextElement()){
			$fields = $ob->GetFields();
			$props = $ob->GetProperties(); 
			
			if ($props["DIAMETR"]["VALUE"]) {$arResult["DIAMETR"][$props["DIAMETR"]["VALUE"]] = $props["DIAMETR"]["VALUE"];}
			elseif ($props["DIAMETR_VNUTRENNIY"]["VALUE"]) {$arResult["DIAMETR_VNUTRENNIY"][$props["DIAMETR_VNUTRENNIY"]["VALUE"]] = $props["DIAMETR_VNUTRENNIY"]["VALUE"];}
		}	
		
		if (!count($arResult["DIAMETR"])) $startResult = true;
		
		ksort($arResult["DIAMETR"]);
}


$arResult["LENGTH"] = Array();

if($_POST["DIAMETR"]) {
		$arFilter = array('IBLOCK_ID' => $arParams["IBLOCK_ID"], 'ACTIVE' => 'Y', 'SECTION_ID'=>$_POST["NAMES"], 'PROPERTY_DIAMETR'=>htmlspecialcharsbx($_POST["DIAMETR"]));
        $arSelect = array("ID", "IBLOCK_ID", "NAME", "CODE");
        $res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, Array(), $arSelect); 

		while($ob = $res->GetNextElement()){
			$fields = $ob->GetFields();
			$props = $ob->GetProperties(); 
			if ($props["DLINA"]["VALUE"]) $arResult["LENGTH"][$props["DLINA"]["VALUE"]] = $props["DLINA"]["VALUE"];
		}	
		
		ksort($arResult["LENGTH"]);	
}	


if($_POST["LENGTH"] || count($arResult["LENGTH"])==1 || count($arResult["DIAMETR_VNUTRENNIY"])) {
		$arFilter = array('IBLOCK_ID' => $arParams["IBLOCK_ID"], 'ACTIVE' => 'Y', 'SECTION_ID'=>$_POST["NAMES"], 'PROPERTY_DIAMETR'=>htmlspecialcharsbx($_POST["DIAMETR"]), 'PROPERTY_DLINA'=>htmlspecialcharsbx($_POST["LENGTH"]));
        $arSelect = array("ID", "IBLOCK_ID", "NAME", "CODE");
        $res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, Array(), $arSelect); 

		while($ob = $res->GetNextElement()){
			$fields = $ob->GetFields();
			$props = $ob->GetProperties(); 
			$arResult["ITEMS"][++$i] = $fields;
			$arResult["ITEMS"][$i]["PROPS"] = $props;
			if ($props["KOLICHESTVO_V_UPAKOVKE"]["VALUE"] != end($props["CML2_TRAITS"]["VALUE"]) && !strstr($fields["NAME"], " кг")) {
			if ($props["KOLICHESTVO_V_UPAKOVKE"]["VALUE"] && end($props["CML2_TRAITS"]["VALUE"]) && !$arResult["WEIGHT"]) $arResult["WEIGHT"] = end($props["CML2_TRAITS"]["VALUE"]) / $props["KOLICHESTVO_V_UPAKOVKE"]["VALUE"];
			elseif (!$props["KOLICHESTVO_V_UPAKOVKE"]["VALUE"] || !end($props["CML2_TRAITS"]["VALUE"])) $arResult["LOG"] .= "<b>{$fields["NAME"]}</b> ({$props["CML2_ARTICLE"]["VALUE"]}): в упаковке - {$props["KOLICHESTVO_V_UPAKOVKE"]["VALUE"]}, вес упаковки - ".end($props["CML2_TRAITS"]["VALUE"])."<br />";
			}
		}	
}



	if (count($arResult["SECTIONS"])) $this->IncludeComponentTemplate();	
} 	
?>