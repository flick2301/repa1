<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$this->setFrameMode(true);

// БЛОК ГДЕ ОПРЕДЕЛЯЕМ ВЕРТИКАЛЬНЫЙ ИЛИ ГОРИЗОНТАЛЬНЫЙ ШАБЛОН
// И УКАЗАННУЮ СОРТИРОВКУ
$isVerticalFilter = $_REQUEST['VERTICAL_FILTER'];

if($_REQUEST['FIELD1']):
    $arResult["VARIABLES"]['FIELD1'] = $_REQUEST['FIELD1'];
    $arResult["VARIABLES"]['ORDER1'] = $_REQUEST['ORDER1'];
    $arResult["VARIABLES"]['FIELD2'] = $_REQUEST['FIELD2'];
    $arResult["VARIABLES"]['ORDER2'] = $_REQUEST['ORDER2'];
else:
    $arResult["VARIABLES"]['FIELD1'] = 'property_DIAMETR';
    $arResult["VARIABLES"]['ORDER1'] = 'asc';
    $arResult["VARIABLES"]['FIELD2'] = 'property_DLINA';
    $arResult["VARIABLES"]['ORDER2'] = 'asc';
endif;

if($_REQUEST['SIZEN_1']):
    $GLOBAL['size_1'] = $_REQUEST['SIZEN_1'];
else:
    $GLOBAL['size_1'] = 50; 
endif;
// КОНЕЦ БЛОКА
//ЭТОТ ГЛОБАЛ НЕ ТРОГАТЬ. НУЖЕН В ХЛЕБНЫХ КРОШКАХ ВИРТУАЛЬНОГО КАТАЛОГА
$GLOBAL['SECTION_ID'] = $arResult["VARIABLES"]["SECTION_ID"];
//

// В ПЕРЕМЕННОЙ $arUrl ПОЛУЧАЕМ КОД ПОСЛЕДНЕГО РАЗДЕЛА
// НУЖЕН ЧТОБЫ УЗНАТЬ В КАТАЛОГЕ МЫ НАХОДИМСЯ ИЛИ УЖЕ В СПРАВОЧНИКЕ
$arUrl = explode('/', $APPLICATION->GetCurPage());
$arUrl = array_diff($arUrl, array(''));


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

$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array());

//Выявляем, есть ли секции в секции
$count_sections = CIBlockSection::GetCount(Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "SECTION_ID"=>$arResult["VARIABLES"]["SECTION_ID"]));

if(preg_match('/length/Ui', $_REQUEST['reference']) || preg_match('/width/Ui', $_REQUEST['reference'])){
    
    require_once($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/section_seo.php");
				
}elseif($count_sections){ 
            
            $APPLICATION->IncludeComponent('bitrix:catalog.section.list', 'level2', [
                'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                'SECTION_ID' => $arResult["VARIABLES"]["SECTION_ID"],
                "SECTION_USER_FIELDS" => array("UF_OTHER_SECTION"),
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
                'SORTING' => $arUrl,
                
            ], $component, ['HIDE_ICONS' => 'Y']); 
 
}else{
    
    
    if (CModule::IncludeModule("iblock"))
    {
        $arFilter = array(
        "ACTIVE" => "Y",
        "GLOBAL_ACTIVE" => "Y",
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        );
        if(strlen($arResult["VARIABLES"]["SECTION_CODE"])>0)
        {
            $arFilter["CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];
        }
        elseif($arResult["VARIABLES"]["SECTION_ID"]>0)
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
            $dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID"));
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
        "",
        Array(
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "SECTION_ID" => $arCurSection["ID"],
            "FILTER_NAME" => "arrFilter",
            "PRICE_CODE" => "",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_NOTES" => "",
            "CACHE_GROUPS" => "Y",
            "SAVE_IN_SESSION" => "N"
        ),
        false
        );
        $this->EndViewTarget();
    }
  
    $nav = CIBlockSection::GetNavChain(false, $arCurSection["ID"]);
    $arSec = $nav->GetNext();


    if ($isVerticalFilter==='Y' || !in_array($arSec['ID'], $arParams["VIBOR_CATALOG_TABLE"]))
	include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/section_vertical.php");
    else
	include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/section_horizontal.php");

    
}?>


