<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $APPLICATION;
global $sec_builder;
global $filterObj;

$filt = new \CatalogHelpers\FilterButtonsBuilder('section.list', $arResult, $arResult['SECTION']['ID']);
$arResult['REFERENCE']['ITEM'] = $filt->arResult['REFERENCE']['ITEM'];


if($arResult['REFERENCE']['ITEM']['ID']!=''):
        $ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues($arResult['REFERENCE']['ITEM']["IBLOCK_ID"],$arResult['REFERENCE']['ITEM']['ID']);
        $IPROPERTY  = $ipropValues->getValues();
        if($IPROPERTY['ELEMENT_META_TITLE']!=''):
            
            $APPLICATION->SetPageProperty('title', $IPROPERTY['ELEMENT_META_TITLE']);
        else:
            $APPLICATION->SetPageProperty('title', $arResult['REFERENCE']['ITEM']['H1']['VALUE']." купить в {{city}} – каталог, цены");
        endif;
        
        if($IPROPERTY['ELEMENT_META_DESCRIPTION'])
			$APPLICATION->SetPageProperty('description', $IPROPERTY['ELEMENT_META_DESCRIPTION']);
		else
			$APPLICATION->SetPageProperty('description', "Купить ".mb_strtolower($arResult['REFERENCE']['ITEM']['H1']['VALUE'])." в {{city}} оптом и в розницу в магазине крепежа «КРЕП-КОМП». Доставка по России.");
        $APPLICATION->SetPageProperty('keywords', $IPROPERTY['ELEMENT_META_KEYWORDS']);
        
    else:
    
        $ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arParams["IBLOCK_ID"],$arResult['SECTION']['ID']);
        $IPROPERTY  = $ipropValues->getValues();
        
        $APPLICATION->SetPageProperty('title', $IPROPERTY['SECTION_META_TITLE']);
        $APPLICATION->SetPageProperty('description', $IPROPERTY['SECTION_META_DESCRIPTION']);
        $APPLICATION->SetPageProperty('keywords', $IPROPERTY['SECTION_META_KEYWORDS']);
		
		if($arResult['SECTION']["UF_META_TITLE_MSK"] && $_SERVER['HTTP_HOST'] != 'spb.krep-komp.ru')
		{
			$APPLICATION->SetPageProperty('title', $arResult['SECTION']["UF_META_TITLE_MSK"]);
		}elseif($arResult['SECTION']["UF_META_TITLE"] && $_SERVER['HTTP_HOST'] == 'spb.krep-komp.ru')
		{
			$APPLICATION->SetPageProperty('title', $arResult['SECTION']["UF_META_TITLE"]);
		}
		
		if($arResult['SECTION']["UF_META_DESCRIPTION_MSK"] && $_SERVER['HTTP_HOST'] != 'spb.krep-komp.ru')
		{
			$APPLICATION->SetPageProperty('description', $arResult['SECTION']["UF_META_DESCRIPTION_MSK"]);
		}elseif($arResult['SECTION']["UF_META_DESCRIPTION_SPB"] && $_SERVER['HTTP_HOST'] == 'spb.krep-komp.ru')
		{
			$APPLICATION->SetPageProperty('description', $arResult['SECTION']["UF_META_DESCRIPTION_SPB"]);
		}
    endif;

if($arResult['REFERENCE']['ITEM']['ID']=='' && $arResult["SECTION"]["ID"]==''){
	@define("ERROR_404","Y");
	CHTTP::SetStatus("404 Not Found");
	$APPLICATION->SetPageProperty('title', "404 - HTTP not found");
}