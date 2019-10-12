<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$this->setFrameMode(true);


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


$isVerticalFilter = $_REQUEST['VERTICAL_FILTER'];
if($_REQUEST['SIZEN_1']){
$GLOBAL['size_1'] = $_REQUEST['SIZEN_1'];
}else{
 $GLOBAL['size_1'] = 15; 
}
$GLOBAL['SECTION_ID'] = $arResult["VARIABLES"]["SECTION_ID"];


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



//Выявляем, есть ли подсекции в секциях
$count_subsections = getSectionCount($arParams['IBLOCK_ID'], $arResult["VARIABLES"]["SECTION_ID"]);    
//Выявляем, есть ли секции в секции
$count_sections = CIBlockSection::GetCount(Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "SECTION_ID"=>$arResult["VARIABLES"]["SECTION_ID"]));
if($count_subsections){
?>
<? $APPLICATION->IncludeComponent('bitrix:catalog.section.list', 'level2', [
                'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                'SECTION_ID' => $arResult["VARIABLES"]["SECTION_ID"],
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
            ], $component, ['HIDE_ICONS' => 'Y']); ?>
<?}elseif($count_sections){?>
<? $APPLICATION->IncludeComponent('bitrix:catalog.section.list', 'level2', [
                'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                'SECTION_ID' => $arResult["VARIABLES"]["SECTION_ID"],
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
            ], $component, ['HIDE_ICONS' => 'Y']); ?>
<?



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
    ?>
    <?$this->SetViewTarget("smart_filter");?>
    <?$APPLICATION->IncludeComponent(
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
            "MOBILE_VERSION"=>"Y",
            "SAVE_IN_SESSION" => "N"
        ),
        false
    );?>
    <?$this->EndViewTarget();?>
<?
}

    
  

	include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/section_vertical.php");



    
}?>


