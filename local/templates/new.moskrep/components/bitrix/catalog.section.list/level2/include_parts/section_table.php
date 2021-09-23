<?
$first_sort_field = 'DIAMETR';

$aSection   = CIBlockSection::GetList(array(), array('IBLOCK_ID'=> $arParams["IBLOCK_ID"], 'ID'=> $arResult['SECTION']['ID'],), false, array( 'UF_SEC_LIST_SIZES' ) )->Fetch();
if($aSection["UF_SEC_LIST_SIZES"])
{
	$rsGender = CUserFieldEnum::GetList(array(), array("ID" => $aSection["UF_SEC_LIST_SIZES"]));
    while ($arCat = $rsGender->GetNext()) {
        $arSizes_val[] = $arCat["XML_ID"];
    }
	if(in_array('DIAMETR_VNUTRENNIY', $arSizes_val))
		$first_sort_field = 'DIAMETR_VNUTRENNIY_INTEGER';
	if(in_array('SHIRINA', $arSizes_val))
		$first_sort_field = 'SHIRINA';

}?>
<?

global $mySmartFilter;
global $arrFilter2;
global $NavNum;
$NavNum=0;

if(!empty($arResult['REFERENCE']['ITEM']['SECTION_LINK']['VALUE']))
{
	$arrFilter2 = array("SECTION_ID" => $arResult['REFERENCE']['ITEM']['SECTION_LINK']['VALUE']);
	$filter_section_id = $arResult['REFERENCE']['ITEM']['SECTION_LINK']['VALUE'][0];
	$filter = array_merge($GLOBALS['Filter_seo'], array('IBLOCK_ID' => CATALOG_IBLOCK_ID, 'SECTION_ID'=> $filter_section_id, 'INCLUDE_SUBSECTIONS'=>'Y'));	
	$dbItems = CIBlockElement::getList(array('SORT' => 'ASC', 'ID' => 'DESC'),	$filter, false, false, array('ID', 'PROPERTY_GOLOVKA'));
	while ($row = $dbItems->getNext()) 
	{
		$mySmartFilter['ID'][]=$row['ID'];
		//$arrFilter2['ID'][]=$row['ID'];
	}
	
}
elseif(count($arResult['REFERENCE']['ITEM']['SECTIONS_TOP']['VALUE'])>1) {
	$arrFilter2 = array("SECTION_ID" => $arResult['REFERENCE']['ITEM']['SECTIONS_TOP']['VALUE']);
	$filter_section_id = $arResult['TOP_SECTIONS'][0]['IBLOCK_SECTION_ID'];
	$dbItems = \Bitrix\Iblock\ElementTable::getList(array(
				'select' => array('ID'), 
				'filter' => array('IBLOCK_ID' => CATALOG_IBLOCK_ID, 'IBLOCK_SECTION_ID'=> $arrFilter2["SECTION_ID"]),
			))->fetchAll();
	foreach($dbItems as $item)
	{
		$mySmartFilter['ID'][]=$item['ID'];
	}
}elseif($arResult['SECTION']['UF_SECTION_ID'])
{
	$filter_section_id = $arResult['SECTION']['UF_SECTION_ID'];
	
	$filter = array_merge($GLOBALS['Filter_seo'], array('IBLOCK_ID' => CATALOG_IBLOCK_ID, 'SECTION_ID'=> $filter_section_id, 'INCLUDE_SUBSECTIONS'=>'Y'));	
	$dbItems = CIBlockElement::getList(array('SORT' => 'ASC', 'ID' => 'DESC'),	$filter, false, false, array('ID', 'PROPERTY_GOLOVKA'));
	while ($row = $dbItems->getNext()) 
	{
		$mySmartFilter['ID'][]=$row['ID'];
		//$arrFilter2['ID'][]=$row['ID'];
	}
}else{
	$filter_section_id = $arResult['SECTION']['ID'];
	$mySmartFilter =[];
}

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
            "SECTION_ID" => $filter_section_id,
            "FILTER_NAME" => (!empty($arResult['REFERENCE']['ITEM']['SECTION_LINK']['VALUE']) || $arResult['SECTION']['UF_SECTION_ID']) ? "Filter_seo" : "arrFilter2",
			"PREFILTER_NAME" => "mySmartFilter",
            "PRICE_CODE" => "",
            "CACHE_TYPE" => "N",
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
?>
<?
if($_POST['ENUM_LIST']['BLOCKS'])
{
	$template = "vertical";
	$element_sort_field = 'sort';
	$arParams["HIDE_NOT_AVAILABLE"]='L';
	$arParams["HIDE_NOT_AVAILABLE_OFFERS"]='L';
	$arParams["ELEMENT_SORT_FIELD"]='';
	$arParams["ELEMENT_SORT_FIELD2"]='';
	
}
else
{
	$template = "horizontal_new";
	$arParams["ELEMENT_SORT_FIELD"] = 'property_'.$first_sort_field;
	$arParams["ELEMENT_SORT_FIELD2"]='property_DLINA';
	
}

$intSectionID = $APPLICATION->IncludeComponent(
					"bitrix:catalog.section",
					$template,
					array(
						"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
						"ELEMENT_SORT_ORDER" => 'asc',
						"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
						"ELEMENT_SORT_ORDER2" => 'asc',
						"PROPERTY_CODE" => ['*'],
						"PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
						"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
						"INCLUDE_SUBSECTIONS" => 'Y',
						"BASKET_URL" => $arParams["BASKET_URL"],
                                                "SHOW_ALL_WO_SECTION" => "Y",
						"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
						"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
						"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
						"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
						"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
						"FILTER_NAME" => (!empty($arResult['REFERENCE']['ITEM']['SECTION_LINK']['VALUE']) || $arResult['SECTION']['UF_SECTION_ID']) ? "Filter_seo" : "arrFilter2",
						"CACHE_TYPE" => $arParams["CACHE_TYPE"],
						"CACHE_TIME" => $arParams["CACHE_TIME"],
						"CACHE_FILTER" => $arParams["CACHE_FILTER"],
						"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
						"SET_TITLE" => $arParams["SET_TITLE"],
						"MESSAGE_404" => $arParams["~MESSAGE_404"],
						"SET_STATUS_404" => $arParams["SET_STATUS_404"],
						"SHOW_404" => $arParams["SHOW_404"],
						"FILE_404" => $arParams["FILE_404"],
						"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
						"PAGE_ELEMENT_COUNT" => $_GET['SIZEN_1'],
						"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
						"PRICE_CODE" => array(
                                                    0 => "Распродажа",
                                                    1 => "К0 (БАЗОВАЯ НАЧАЛЬНАЯ)",
													2 => "К05 (от 100 тыс.руб)",
													3 => "К10 (от 500тыс.руб)",
													4 => "К13 (от 1 млн.руб)",
													5 => "К18 (от 5 млн.руб)"
                                                ),
						"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
						"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

						"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
						"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
						"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
						"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
						"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

						"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
						"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
						"PAGER_TITLE" => $arParams["PAGER_TITLE"],
						"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
						"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
						"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
						"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
						"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
						"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
						"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
						"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
						"LAZY_LOAD" => $arParams["LAZY_LOAD"],
						"MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
						"LOAD_ON_SCROLL" => $arParams["LOAD_ON_SCROLL"],

						"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
						"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
						"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
						"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
						"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
						"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
						"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
						"OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

						"SECTION_ID" => ($arResult['SECTION']['ID'] && $arResult['SECTION']['UF_SECTION_ID']==null) ? $arResult['SECTION']['ID'] : $filter_section_id,
						"SECTION_CODE" => $arResult['SECTION']['CODE'],
						"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
						"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
						"USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
						"SECTION_USER_FIELDS" => array("UF_SOPUT_SPR", "UF_EXTRA_FIELDS"),
						'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
						'CURRENCY_ID' => $arParams['CURRENCY_ID'],
						'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
						'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

						'LABEL_PROP' => $arParams['LABEL_PROP'],
						'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
						'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
						'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
						'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
						'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
						'PRODUCT_ROW_VARIANTS' => $arParams['LIST_PRODUCT_ROW_VARIANTS'],
						'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
						'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
						'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
						'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
						'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

						'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
						'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
						'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
						'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
						'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
						'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
						'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
						'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
						'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
						'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
						'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
						'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
						'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
						'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
						'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
						'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
						'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

						'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
						'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
						'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

						'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
						"ADD_SECTIONS_CHAIN" => "N",
						'ADD_TO_BASKET_ACTION' => $basketAction,
						'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
						'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
						'COMPARE_NAME' => $arParams['COMPARE_NAME'],
						'USE_COMPARE_LIST' => 'Y',
						'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
						'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
						'EXTRA_FIELD' => (isset($arResult['SECTION']['UF_EXTRA_FIELD']) ? $arResult['SECTION']['UF_EXTRA_FIELD'] : ''),
						
		
					)
					
				);
			
				?>
