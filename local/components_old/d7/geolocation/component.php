<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true) die();

if(CModule::IncludeModule('iblock')){
	
	

	//setcookie('geo_text', '', time() - 3600, '/');
	//setcookie('geo_id', '', time() - 3600, '/');
	
		


	
	$obCache = new CPHPCache();
	
if($obCache->InitCache(360000, "geolocation".$_SERVER['HTTP_HOST'], "/"))// Если кэш валиден
{
   $vars = $obCache->GetVars();// Извлечение переменных из кэша
   $arResult = $vars["RESULT"];
}
elseif($obCache->StartDataCache())// Если кэш невалиден
{	
		
		$arSelect = Array("ID", "IBLOCK_ID", "NAME", "SORT", "PREVIEW_TEXT", "DETAIL_TEXT", "IBLOCK_SECTION_ID", "PROPERTY_*");
		$arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE"=>"Y", "SECTION_ID"=>"");

		
		$res = CIBlockElement::GetList(Array("SORT"=>"ASC", "NAME"=>"ASC"), $arFilter, false, Array(), $arSelect);
		while($ob = $res->GetNextElement())
		{
			$arr = $ob->GetFields();
			$arResult["ITEMS"][$arr["ID"]] = $ob->GetFields();
			$arResult["ITEMS"][$arr["ID"]]['PROP'] = $ob->GetProperties();
			$i++;
		}
		


	
	$obCache->EndDataCache(array(
        "RESULT"    => $arResult
        ));// Сохраняем переменные в кэш.	
		
   }   
   

	if (count($arResult["ITEMS"]) >= 1) $this->IncludeComponentTemplate();	
} 
			
?>