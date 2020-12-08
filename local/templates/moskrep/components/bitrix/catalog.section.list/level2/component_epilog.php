<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $APPLICATION;


if($arResult['REFERENCE']['ITEM']['ID']!=''):
        $ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues($arResult['REFERENCE']['ITEM']["IBLOCK_ID"],$arResult['REFERENCE']['ITEM']['ID']);
        $IPROPERTY  = $ipropValues->getValues();
        
        if($IPROPERTY['ELEMENT_META_TITLE']!=''):
            
            $APPLICATION->SetPageProperty('title', $IPROPERTY['ELEMENT_META_TITLE']);
        else:
            $APPLICATION->SetPageProperty('title', $arResult['REFERENCE']['ITEM']['H1']['VALUE'].", цена - купить в интернет-магазине в Москве");
        endif;
        
        
        $APPLICATION->SetPageProperty('description', $IPROPERTY['ELEMENT_META_DESCRIPTION']);
        $APPLICATION->SetPageProperty('keywords', $IPROPERTY['ELEMENT_META_KEYWORDS']);
        
    else:
    
        $ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arParams["IBLOCK_ID"],$arResult['SECTION']['ID']);
        $IPROPERTY  = $ipropValues->getValues();
        
		if($arParams['META']['title'] && $_SERVER["HTTP_HOST"]=="spb.krep-komp.ru")
			$APPLICATION->SetPageProperty('title', $arParams['META']['title']);
		else
			$APPLICATION->SetPageProperty('title', $IPROPERTY['SECTION_META_TITLE']);
		
		if($arParams['META']['description'] && $_SERVER["HTTP_HOST"]=="spb.krep-komp.ru")
			$APPLICATION->SetPageProperty('description', $arParams['META']['description']);
		else
			$APPLICATION->SetPageProperty('description', $IPROPERTY['SECTION_META_DESCRIPTION']);
		
        
        $APPLICATION->SetPageProperty('keywords', $IPROPERTY['SECTION_META_KEYWORDS']);
    endif;

if($arResult['REFERENCE']['ITEM']['ID']=='' && $arResult["SECTION"]["ID"]==''){
@define("ERROR_404","Y");
	CHTTP::SetStatus("404 Not Found");
		
	$APPLICATION->SetPageProperty('title', "404 - HTTP not found");
} 