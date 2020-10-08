<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true) die();

if(CModule::IncludeModule('iblock')){

	
	$obCache = new CPHPCache();


if($obCache->InitCache($arParams["CACHE_TIME"], "slider", "/"))// Если кэш валиден
{
   $vars = $obCache->GetVars();// Извлечение переменных из кэша
   $arResult = $vars["RESULT"];
}
elseif($obCache->StartDataCache())// Если кэш невалиден
{	


		$arFilter = array('IBLOCK_ID' => $arParams["IBLOCK_ID"], 'ACTIVE' => 'Y');
        $arSelect = array("ID", "IBLOCK_ID", "NAME", "CODE", "PREVIEW_PICTURE", "PREVIEW_TEXT", "IBLOCK_SECTION_ID", "PROPERTY_*");
        $res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, Array(), $arSelect);
		$i=0;
		while($ob = $res->GetNextElement()){ 
			$fields = $ob->GetFields();
			$arResult["ITEMS"][$fields["IBLOCK_SECTION_ID"]][$i] = $fields;
			$arResult["ITEMS"][$fields["IBLOCK_SECTION_ID"]][$i]["IMG"] = CFile::GetPath($arResult["ITEMS"][$fields["IBLOCK_SECTION_ID"]][$i]["PREVIEW_PICTURE"]);
			$arResult["ITEMS"][$fields["IBLOCK_SECTION_ID"]][$i]["SMALL_IMG"] =  CFile::ResizeImageGet($arResult["ITEMS"][$fields["IBLOCK_SECTION_ID"]][$i]["PREVIEW_PICTURE"], array('width'=>792, 'height'=>507), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			$arResult["ITEMS"][$fields["IBLOCK_SECTION_ID"]][$i]["PROPERTY"] = $ob->GetProperties();
			$i++;
		}
	
	$obCache->EndDataCache(array(
        "RESULT"    => $arResult
        ));// Сохраняем переменные в кэш.	
		
   }  

	if (count($arResult["ITEMS"])) $this->IncludeComponentTemplate();	
} 
			
?>