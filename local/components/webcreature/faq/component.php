<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true) die();

if(CModule::IncludeModule("iblock")){
	
	$obCache = new CPHPCache();

if($obCache->InitCache($arParams["CACHE_TIME"], $componentName.$componentTemplate.$arParams["IBLOCK_ID"], "/"))// Если кэш валиден
{
   $vars = $obCache->GetVars();// Извлечение переменных из кэша
   $arResult = $vars["RESULT"];
}
elseif($obCache->StartDataCache())// Если кэш невалиден
{	
		$arSort = $arParams["SORT"] ? $arParams["SORT"] : array("SORT" => "ASC", "ID" => "ASC");
		$arFilter = array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y");
        $arSelect = array("ID", "IBLOCK_ID", "NAME", "CODE", "PICTURE");
		$rsSect = CIBlockSection::GetList($arSort, $arFilter, true, $arSelect);
		while($arSect = $rsSect->GetNext()) {
			if ($arSect["PICTURE"]) $arSect["PREVIEW_PICTURE"] = CFile::GetPath($arSect["PICTURE"]);
			$arResult[$arSect["ID"]] = $arSect;
			
		$arFilter = array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y", "SECTION_ID" => $arSect["ID"]);
        $arSelect = array("ID", "IBLOCK_ID", "NAME", "CODE", "PREVIEW_TEXT", "DETAIL_TEXT");
        $res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, Array(), $arSelect);
		while($ob = $res->GetNextElement()){
			$arResult[$arSect["ID"]]["ITEMS"][] = $ob->GetFields();
		}	
		};
		
		
		
	$obCache->EndDataCache(array(
        "RESULT"    => $arResult
        ));// Сохраняем переменные в кэш.			
		
} 		


	if (count($arResult)) $this->IncludeComponentTemplate();	
} 	
?>