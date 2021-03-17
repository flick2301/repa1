<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$this->setFrameMode(true);
global $mySmartFilter;
$mySmartFilter = [">CATALOG_PRICE_9" => 0];

//ЭТОТ ГЛОБАЛ НЕ ТРОГАТЬ. НУЖЕН В ХЛЕБНЫХ КРОШКАХ ВИРТУАЛЬНОГО КАТАЛОГА
$GLOBAL['SECTION_ID'] = $arResult["VARIABLES"]["SECTION_ID"];
//

// В ПЕРЕМЕННОЙ $arUrl ПОЛУЧАЕМ КОД ПОСЛЕДНЕГО РАЗДЕЛА
// НУЖЕН ЧТОБЫ УЗНАТЬ В КАТАЛОГЕ МЫ НАХОДИМСЯ ИЛИ УЖЕ В СПРАВОЧНИКЕ
$arUrl = explode('/', $APPLICATION->GetCurPage());
$arUrl = array_diff($arUrl, array(''));
if($APPLICATION->GetCurPage() == '/krepezh/ankera/anker-25-mm/anker-bolt-s/'){
	@define("ERROR_404","Y");
	CHTTP::SetStatus("404 Not Found");
		
	$APPLICATION->SetPageProperty('title', "404 - HTTP not found");
}



$isFilter = ($arParams['USE_FILTER'] == 'Y');

if ($isFilter)
{
	$arFilter = array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
		"GLOBAL_ACTIVE" => "Y",
	);
	if (0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
		$arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
	elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"])
		$arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];

	$obCache = new CPHPCache();
	if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog"))
	{
		$arCurSection = $obCache->GetVars();
	}
	elseif ($obCache->StartDataCache())
	{
		$arCurSection = array();
		if (Loader::includeModule("iblock"))
		{
			$dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID"));

			if(defined("BX_COMP_MANAGED_CACHE"))
			{
				global $CACHE_MANAGER;
				$CACHE_MANAGER->StartTagCache("/iblock/catalog");

				if ($arCurSection = $dbRes->Fetch())
					$CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);

				$CACHE_MANAGER->EndTagCache();
			}
			else
			{
				if(!$arCurSection = $dbRes->Fetch())
					$arCurSection = array();
			}
		}
		$obCache->EndDataCache($arCurSection);
	}
	if (!isset($arCurSection))
		$arCurSection = array();
}

//Выявляем, есть ли секции в секции
$count_sections = CIBlockSection::GetCount(Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "SECTION_ID"=>$arResult["VARIABLES"]["SECTION_ID"]));


$ar_result=CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "ID"=>$arResult["VARIABLES"]["SECTION_ID"]),false, Array("ID", "IBLOCK_ID","UF_*")); 
if($res=$ar_result->GetNext()){
    $rsGender = CUserFieldEnum::GetList(array(), array("ID" => $res["UF_SEC_LIST_TEMPL"]));
        if($arCat = $rsGender->GetNext())
                  $temple = $arCat["XML_ID"];
		if($res["UF_SUBSECTION_ID"])
			$subsections[] = $res["UF_SUBSECTION_ID"];
		if($res["UF_OTHER_SECTION"])
			$subsections[] = $res["UF_OTHER_SECTION"];
		
//ТАК ЖЕ СМОТРИМ В СЕКЦИИ ДОП. МЕТЫ

		if($res["UF_META_TITLE"])
			$meta['title'] = $res["UF_META_TITLE"];
		if($res["UF_META_DESCRIPTION_SPB"])
			$meta['description'] = $res["UF_META_DESCRIPTION_SPB"];
		if($res["UF_H1_SPB"])
			$meta['H1'] = $res["UF_H1_SPB"];
	
		
}
if($_REQUEST['section_temp'] == 'new' || $temple=='ANKERA'){
    //$name_temple = 'level2_new';
	$name_temple = 'level2';
}else{
    $name_temple = 'level2';
}


if($count_sections || !empty($subsections)){ 
            
            $APPLICATION->IncludeComponent('bitrix:catalog.section.list', $name_temple, [
                'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                'SECTION_ID' => $arResult["VARIABLES"]["SECTION_ID"],
                "SECTION_USER_FIELDS" => array("UF_*"),
                'COUNT_ELEMENTS' => $arParams['SECTION_COUNT_ELEMENTS'],
                'TOP_DEPTH' => $arParams['SECTION_TOP_DEPTH'],
                'SECTION_URL' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['section'],
                'HIDE_SECTION_NAME' => (isset($arParams['SECTIONS_HIDE_SECTION_NAME']) ? $arParams['SECTIONS_HIDE_SECTION_NAME'] : 'N'),
                'ADD_SECTIONS_CHAIN' => (isset($arParams['ADD_SECTIONS_CHAIN']) ? $arParams['ADD_SECTIONS_CHAIN'] : ''),
                'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                'CACHE_TIME' => $arParams['CACHE_TIME'],
                'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                'LIST_PREV_PIC_W_L2' => $arParams['LIST_PREV_PIC_W_L2'],
                'LIST_PREV_PIC_H_L2' => $arParams['LIST_PREV_PIC_W_L2'],
                'REFERENCE_CHECK' => 'Y',
                'REFERENCE' => $_REQUEST['reference'],
				'META' => $meta,
                'SORTING' => $arUrl,
				'TYPE_TEMPLATE'=>$temple,
                
            ], $component, ['HIDE_ICONS' => 'Y']); 
 
}else{
    
    
    if (CModule::IncludeModule("iblock"))
    {
        $arFilter = array(
        "ACTIVE" => "Y",
        "GLOBAL_ACTIVE" => "Y",
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        );
        if($arResult["VARIABLES"]["SECTION_ID"]>0)
        {
            $arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
        }
        
        $obCache = new CPHPCache;
        if($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog"))
        {
            $arCurSection = $obCache->GetVars();
        }
        else
        {
            $arCurSection = array();
            $dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID", 'UF_*'));
            $dbRes = new CIBlockResult($dbRes);

            if(defined("BX_COMP_MANAGED_CACHE"))
            {
                global $CACHE_MANAGER;
                $CACHE_MANAGER->StartTagCache("/iblock/catalog");

                if ($arCurSection = $dbRes->GetNext())
                {
                    $CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);
                }
                $CACHE_MANAGER->EndTagCache();
            }
            else
            {
                if(!$arCurSection = $dbRes->GetNext())
                    $arCurSection = array();
            }

            $obCache->EndDataCache($arCurSection);
        }
    
        $this->SetViewTarget("smart_filter");
   
        $APPLICATION->IncludeComponent(
        "d7:catalog.smart.filter",
        "krep-komp",
        Array(
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
            "FILTER_NAME" => "arrFilter",
			"PREFILTER_NAME" => "",
            "PRICE_CODE" => "",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_NOTES" => "",
            "CACHE_GROUPS" => "Y",
            "SAVE_IN_SESSION" => "N",
            "ID SMALL" => "125",
            "ID MIDLE" => "124",
            "ID BIG" => "123",
        ),
        false
        );
		
        $this->EndViewTarget();
    }
	
	
		$rsGender = CUserFieldEnum::GetList(array(), array("ID" => $arCurSection["UF_EL_LIST_TEMPL"]));
        if($arCat = $rsGender->GetNext())
                  $temple = $arCat["XML_ID"];
			  
	   
	
  
    //Получает все ID верхних каталогов, нужно чтоб вычислить $arParams["VIBOR_CATALOG_TABLE"]( ID в котором прописан
    //что разделы каталога в виде таблице( по дефолту карточками))
    $nav = CIBlockSection::GetNavChain(false, $arCurSection["ID"]);
    $arSec = $nav->GetNext();

    if ($isVerticalFilter==='Y' || !in_array($arSec['ID'], $arParams["VIBOR_CATALOG_TABLE"]) || $temple == 'vertical')
	include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/section_vertical.php");
    else
	include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/section_horizontal.php");

    
}?>


