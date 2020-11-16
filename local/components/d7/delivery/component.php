<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true) die();

if(CModule::IncludeModule('iblock')){


	
	$obCache = new CPHPCache();
	
if($obCache->InitCache(360000, "delivery".$arParams["PAGE"], "/"))// Если кэш валиден
{
   $vars = $obCache->GetVars();// Извлечение переменных из кэша
   $arResult = $vars["RESULT"];
}
elseif($obCache->StartDataCache())// Если кэш невалиден
{	
	$i = 0;

		$arSelect = Array("ID", "IBLOCK_ID", "NAME", "CODE", "DETAIL_TEXT", "PROPERTY_*");
		$arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE"=>"Y", "PROPERTY_SITES"=>Array($_SERVER['HTTP_HOST'], "*"));

		
		if ($_REQUEST["ID"]) $arFilter['ID'] = $_REQUEST["ID"];
		
		$res = CIBlockElement::GetList(Array("SORT"=>"ASC", "ID"=>"ASC"), $arFilter, false, Array(), $arSelect);
		while($ob = $res->GetNextElement())
		{
			$arResult["ITEMS"][$i] = $ob->GetFields();
			$arResult["ITEMS"][$i]['PROP'] = $ob->GetProperties();
			$i++;
		}
		
	
	$obCache->EndDataCache(array(
        "RESULT"    => $arResult
        ));// Сохраняем переменные в кэш.	
		
   }   
   
   
	if (count($arResult["ITEMS"]) >= 1) $this->IncludeComponentTemplate();	
} 
			
?>