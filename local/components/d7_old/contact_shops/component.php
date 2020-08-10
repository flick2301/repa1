<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true) die();

if(CModule::IncludeModule('iblock')){


	
	$obCache = new CPHPCache();

	
if($obCache->InitCache(360000, "contact_shops".$arParams["SECTION_ID"], "/"))// Если кэш валиден
{
   $vars = $obCache->GetVars();// Извлечение переменных из кэша
   $arResult = $vars["RESULT"];
}
elseif($obCache->StartDataCache())// Если кэш невалиден
{	

		
		$i = 0;
		
		$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "DETAIL_TEXT", "IBLOCK_SECTION_ID", "PROPERTY_*");
		$arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE"=>"Y", "SECTION_ID"=>"");
		$arParams["SECTION_ID"] ? $arFilter['SECTION_ID'] = $arParams["SECTION_ID"] : "";
		$res = CIBlockElement::GetList(Array("SORT"=>"ASC", "ID"=>"ASC"), $arFilter, false, Array(), $arSelect);
		while($ob = $res->GetNextElement())
		{
			$arResult[$i] = $ob->GetFields();
			$arResult[$i]['PROP'] = $ob->GetProperties();
			$i++;
		}

	
	
	$obCache->EndDataCache(array(
        "RESULT"    => $arResult
        ));// Сохраняем переменные в кэш.	
		
   }   
   
	if (count($arResult) >= 1) $this->IncludeComponentTemplate();	
} 
			
?>