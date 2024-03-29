<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$this->setFrameMode(true);
global $mySmartFilter;
global $NavNum;
global $sec_builder;
$sec_builder = new \CatalogHelpers\SectionBulder();
$NavNum = 0;
$mySmartFilter = [">CATALOG_PRICE_9" => 0];

//ЭТОТ ГЛОБАЛ НЕ ТРОГАТЬ. НУЖЕН В ХЛЕБНЫХ КРОШКАХ ВИРТУАЛЬНОГО КАТАЛОГА
$GLOBAL['SECTION_ID'] = $arResult["VARIABLES"]["SECTION_ID"];


if($APPLICATION->GetCurDir() != $sec_builder->curSection['SECTION_PAGE_URL'])
{
	$sorting = $sec_builder->getCurSorting();
}
if(!empty($sorting[0]['arFilters']['VALUE'])) {
	
	$arResult["VARIABLES"]["SECTION_ID"] = $sec_builder->getCurSection();

	$ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(SORTING_IBLOCK_ID,$sorting[0]['ID']);
	$IPROPERTY  = $ipropValues->getValues();
	if($IPROPERTY['ELEMENT_PAGE_TITLE']!='')
		$APPLICATION->SetPageProperty('page_title', $IPROPERTY['ELEMENT_PAGE_TITLE']);
	if($IPROPERTY['ELEMENT_META_TITLE']!='')
	{
		$APPLICATION->SetPageProperty('title', $IPROPERTY['ELEMENT_META_TITLE']);
		
	}
	if($IPROPERTY['ELEMENT_META_DESCRIPTION'])
    $APPLICATION->SetPageProperty('description', $IPROPERTY['ELEMENT_META_DESCRIPTION']);
}elseif(!empty($sorting[0]['ID']))
{
	
	$ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(SORTING_IBLOCK_ID,$sorting[0]['ID']);
	$IPROPERTY  = $ipropValues->getValues();
	if($IPROPERTY['ELEMENT_PAGE_TITLE']!='')
		$APPLICATION->SetPageProperty('page_title', $IPROPERTY['ELEMENT_PAGE_TITLE']);
	if($IPROPERTY['ELEMENT_META_TITLE']!='')
	{
		
		$APPLICATION->SetPageProperty('title', $IPROPERTY['ELEMENT_META_TITLE']);
		$APPLICATION->SetTitle($IPROPERTY['ELEMENT_META_TITLE']);
		
	}
	if($IPROPERTY['ELEMENT_META_DESCRIPTION'])
    $APPLICATION->SetPageProperty('description', $IPROPERTY['ELEMENT_META_DESCRIPTION']);
}


$sec_builder->addParameters();




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

?>
<script type="text/javascript">
	(window["rrApiOnReady"] = window["rrApiOnReady"] || []).push(function() {
		try { rrApi.categoryView(<?=$arResult["VARIABLES"]["SECTION_ID"];?>); } catch(e) {}
			})
</script>
<?php

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
		/*if($res["UF_SECTION_ID"])
			$arResult["VARIABLES"]["SECTION_ID"] = $res["UF_SECTION_ID"];*/
		
//ТАК ЖЕ СМОТРИМ В СЕКЦИИ ДОП. МЕТЫ

		if($res["UF_META_TITLE"])
			$meta['title'] = $res["UF_META_TITLE"];
		if($res["UF_META_DESCRIPTION_SPB"])
			$meta['description'] = $res["UF_META_DESCRIPTION_SPB"];
		if($res["UF_H1_SPB"])
			$meta['H1'] = $res["UF_H1_SPB"];
		
		if($res["UF_MATERIAL"])
			$uf_fields["UF_MATERIAL"] = $res["UF_MATERIAL"];
	
		
}
if($_REQUEST['section_temp'] == 'new' || $temple=='ANKERA'){
    //$name_temple = 'level2_new';
	$name_temple = 'level2';
}else{
    $name_temple = 'level2';
}


if($count_sections || !empty($subsections) || !empty($uf_fields["UF_MATERIAL"])){ 
            
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
                'SORTING' => $sec_builder->arPagesCode,
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
			"FOR_SEO"=>'Y',
        ),
        false
        );
		
        $this->EndViewTarget();
    }
	
	$temple = 'vertical';
		$rsGender = CUserFieldEnum::GetList(array(), array("ID" => $arCurSection["UF_EL_LIST_TEMPL"]));
        if($arCat = $rsGender->GetNext())
                  $temple = $arCat["XML_ID"];
			  
		
			  
	   
	
  
    //Получает все ID верхних каталогов, нужно чтоб вычислить $arParams["VIBOR_CATALOG_TABLE"]( ID в котором прописан
    //что разделы каталога в виде таблице( по дефолту карточками))
    $nav = CIBlockSection::GetNavChain(false, $arCurSection["ID"]);
    $arSec = $nav->GetNext();

	$request = \Bitrix\Main\Context::getCurrent()->getRequest();
    if (($isVerticalFilter==='Y' || !in_array($arSec['ID'], $arParams["VIBOR_CATALOG_TABLE"]) || $temple == 'vertical') || $request->get('TEMPLATE') == 'vertical')
	include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/section_vertical.php");
    else
	include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/section_horizontal.php");

    
}?>
<?
$url = 'https://'.$_SERVER['HTTP_HOST'].$APPLICATION->GetCurPage(false);
?>
<script type="application/ld+json">
[{
"url":"<?=$url?>",
"name":" 🔹 Более 15 000 наименований",
"@type":"SaleEvent","about":" 🔹 Более 15 000 наименований",
"image":"https://krep-komp.ru/local/templates/moskrep/assets/design/website-logo/krep-komp.svg","offers":
{"url":"<?=$url?>",
"@type":"Offer",
"price":100,
"validFrom":"2023-01-01T03:00:00+00:00",
"availability":"https://schema.org/InStock",
"priceCurrency":"RUB"
},
"endDate":"2023-12-31T03:00:00+00:00",
"@context":"https://schema.org",
"location":
{
"geo":
{"@type":"GeoCoordinates","latitude":"37.60295113218015","longitude":"55.60059870162757"},
"name":"Креп-Комп","@type":"Place","address":
{"@type":"PostalAddress","addressLocality":"Москва"}},
"organizer":"Креп-Комп","performer":"Креп-Комп","startDate":"2023-01-01T03:00:00+00:00"
},
{
"url":"<?=$url?>",
"name":"🔹 Бесплатная доставка по Москве и МО",
"@type":"SaleEvent","about":"🔹 Бесплатная доставка по Москве и МО ",
"image":"https://krep-komp.ru/local/templates/moskrep/assets/design/website-logo/krep-komp.svg","offers":
{"url":"<?=$url?>",
"@type":"Offer",
"price":100,
"validFrom":"2023-01-01T03:00:00+00:00",
"availability":"https://schema.org/InStock",
"priceCurrency":"RUB"
},
"endDate":"2023-12-31T03:00:00+00:00",
"@context":"https://schema.org",
"location":
{
"geo":
{"@type":"GeoCoordinates","latitude":"37.60295113218015","longitude":"55.60059870162757"},
"name":"Креп-Комп","@type":"Place","address":
{"@type":"PostalAddress","addressLocality":"Москва"}},
"organizer":"Креп-Комп","performer":"Креп-Комп","startDate":"2023-01-01T03:00:00+00:00"
},
{
"url":"<?=$url?>",
"name":" 🔹 Гарантия качества",
"@type":"SaleEvent","about":" 🔹 Гарантия качества",
"image":" https://krep-komp.ru/local/templates/moskrep/assets/design/website-logo/krep-komp.svg","offers":
{"url":" <?=$url?>",
"@type":"Offer",
"price":100,
"validFrom":"2023-01-01T03:00:00+00:00",
"availability":"https://schema.org/InStock",
"priceCurrency":"RUB"
},
"endDate":"2023-12-31T03:00:00+00:00",
"@context":"https://schema.org",
"location":
{
"geo":
{"@type":"GeoCoordinates","latitude":"37.60295113218015","longitude":"55.60059870162757"},
"name":"Креп-Комп","@type":"Place","address":
{"@type":"PostalAddress","addressLocality":"Москва"}},
"organizer":"Креп-Комп","performer":"Креп-Комп","startDate":"2023-01-01T03:00:00+00:00"
}]
</script>

