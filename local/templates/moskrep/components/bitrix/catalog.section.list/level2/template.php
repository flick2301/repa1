<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->setFrameMode(true);

global $APPLICATION;


  
    
    
    

?>

<?if(count($arResult['RELINK'])):?>
    <?php $this->SetViewTarget('RELINK'); ?>
	<!--see-also-widget-->
	<div class="basic-layout__module see-also-widget">
               <h4 class="see-also-widget__title">Смотрите также:</h4>
               <ul class="see-also-widget__list">
				<?foreach($arResult['RELINK'] as $relink):?>
                  <li class="see-also-widget__item">
                     <a class="see-also-widget__link" href="<?=$relink['AKCEPTOR']?>"><?=$relink['ANKOR']?></a>
                  </li>
				<?endforeach;?>
				</ul>
    </div>
	<!--see-also-widget-->
    <?php $this->EndViewTarget(); ?>
<?endif;?>

<?if($arResult['REFERENCE']['ITEM']['ID']!=''):?>

   
    
<?$APPLICATION->SetPageProperty('url_canon_relink', 'Y'); 
		
		?>
      
    
    <!--page-heading-->
            <header class="basic-layout__module page-heading">
               <h1 class="page-heading__title"><?=($arResult['REFERENCE']['ITEM']['ELEMENT_PAGE_TITLE']) ? $arResult['REFERENCE']['ITEM']['ELEMENT_PAGE_TITLE'] : $arResult['REFERENCE']['ITEM']['H1']['VALUE'];?></h1>
			</header>
	<!--page-heading-->
    <!--catalog-feed-->
    <div class="basic-layout__module catalog-feed">
        <div class="catalog-feed__list">
<?
    foreach ($arResult['DOP_SECTIONS'] as &$arSection)
    {
?>
        <div class="catalog-feed__item">
			<!--catalog-card-->
			<section class="catalog-card">
				<h3 class="catalog-card__title"><a href="<?=$arSection['SECTION_PAGE_URL']?>" target="_self" title='<?=$arSection['IPROPERTY_VALUES']['SECTION_META_TITLE']?>' class="catalog-card__link"><?=$arSection['NAME']?></a></h3>
                <div class="catalog-card__cover">
                    <img class="catalog-card__image" width="262" height="197" src="<?=$arSection['PICTURE']['src']?>" alt="<?=$arSection['IPROPERTY_VALUES']['SECTION_META_TITLE']?>">
                </div>
            </section>
		</div>
    <?}?>		
		</div>
	</div>
	<!--catalog-feed-->

    <?if($arResult['TOP_SECTIONS']):?>
        <!--catalog-feed-->
		<div class="basic-layout__module catalog-feed">
			<div class="catalog-feed__list">
                <?foreach ($arResult['TOP_SECTIONS'] as &$arSection):?>
                    <div class="catalog-feed__item">
					<!--catalog-card-->
					<section class="catalog-card">
					<h3 class="catalog-card__title"><a href="<?=$arSection['SECTION_PAGE_URL']?>" target="_self" title='<?=$arSection['IPROPERTY_VALUES']['SECTION_META_TITLE']?>' class="catalog-card__link"><?=$arSection['NAME']?></a></h3>
                            <div class="catalog-card__cover">
                                <img class="catalog-card__image" width="262" height="197" src="<?=$arSection['PICTURE']['src']?>" alt="<?=$arSection['IPROPERTY_VALUES']['SECTION_META_TITLE']?>">
                            </div>
            
					</section>
					<!--catalog-card-->
					</div>
   
                <?endforeach;?>
            </div>
		</div>
		<!--catalog-feed-->
		<?if($_POST['ENUM_LIST']['ELEMENTS'])
			require_once __DIR__."/include_parts/section_table.php";?>
    <?endif;?>
    <?if($arResult['REFERENCE']['ITEM']['PICTURE']){?>
    <div class="catalog-head__photo photo__seo">
        <a href="<?=$arResult['REFERENCE']['ITEM']['PICTURE']['src']?>"  onclick="javascript:void();" rel="catalog-photo" class="catalog-photo__link">
            <img src="<?=$arResult['REFERENCE']['ITEM']['PICTURE']['src']?>" alt="<?=$$arResult['REFERENCE']['ITEM']['H1']['VALUE']?>">
        </a>
    </div>
    <?}?>
<!--simple-article-->
        <div class="basic-layout__module simple-article">
            <div class="simple-article__content wysiwyg-block">
<?=$arResult['REFERENCE']['ITEM']['DETAIL_TEXT']?>
			</div>	
		</div>
<!--simple-article-->
    <?

    if($arResult['REFERENCE']['ITEM']['DIRECTORY']){

		
        global $arReplacement;
        $arReplacement = $arResult['REFERENCE']['ITEM']['REPLACEMENT']['VALUE'];
		$tmp = ($arResult['REFERENCE']['ITEM']['VERTICAL']['VALUE']=='Y') ? 'vertical' : 'horizontal_new';


        $intSectionID = $APPLICATION->IncludeComponent(
					"bitrix:catalog.section",
					"horizontal_new",
					array(
						"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"ELEMENT_SORT_FIELD" => 'property_'.$first_sort_field,
						"ELEMENT_SORT_ORDER" => 'asc',
						"ELEMENT_SORT_FIELD2" => 'property_DLINA',
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
						"FILTER_NAME" => 'Filter_seo',
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
						"PAGE_ELEMENT_COUNT" => $GLOBAL['size_1'],
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

						"REPLACEMENT" => $arResult['REFERENCE']['ITEM']['REPLACEMENT']['VALUE'],
						"DISPLAY_TOP_PAGER" => 'N',
						"DISPLAY_BOTTOM_PAGER" => "Y",



						"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
						"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
						"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
						"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
						"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
						"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
						"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
						"OFFERS_LIMIT" => '0',

						"SECTION_ID" => $arResult['REFERENCE']['ITEM']['DIRECTORY'],
						"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
						"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
						"USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
						"SECTION_USER_FIELDS" => array("UF_SOPUT_SPR", "UF_EXTRA_FIELDS"),
						'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
						'CURRENCY_ID' => $arParams['CURRENCY_ID'],
						'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
						'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],
"DISABLE_HEADER"=>'Y',
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
        if($arResult['REFERENCE']['ITEM']['COMPANIONS']){?>
            <div class="sorting_section">
                <div class="sorting_section_left">
                    <span>Сопутствующие товары:</span>
                </div>
                <div class="sorting_section_right">




                    <?foreach($arResult['REFERENCE']['ITEM']['COMPANIONS'] as $companion){?>
                        <div class="sorting_item">
                            <a href="<?=$companion['SRC']?>" target='_self' class="sorting_link">

                                <span class="sorting_title"><?=$companion['NAME']?></span>
                            </a>
                        </div>
                    <?}?>

                </div>
            </div>
        <?}?>
		
		
<!--simple-article-->
        <div class="basic-layout__module simple-article">
            <div class="simple-article__content wysiwyg-block">
<?=$arResult['REFERENCE']['ITEM']['PREVIEW_TEXT']?>
			</div>	
		</div>
<!--simple-article-->

				<?}
    ?>
    
<?else:?>
<?if($IPROPERTY['SECTION_META_TITLE']==''){$APPLICATION->SetPageProperty('title', $arResult["SECTION"]["NAME"]);}?>
<!--page-heading-->
            <header class="basic-layout__module page-heading">
               <h1 class="page-heading__title"><?=($arResult['SECTION']['IPROPERTY_VALUES']['SECTION_PAGE_TITLE']) ? $arResult['SECTION']['IPROPERTY_VALUES']['SECTION_PAGE_TITLE'] :$arResult["SECTION"]["NAME"];?></h1>
            </header>
 <!--page-heading-->
 <?
if($arResult['SORTING']['SECTION_ID']){
	?>
	<!--category-block-->
            <div class="basic-layout__module category-block">
	<?
    foreach($arResult['SORTING']['SECTIONS'] as $sortSection){
        
        ?>
        <h3 class="category-block__title"><?=$sortSection["NAME"]?></h3>
        <ul class="category-block__list">
        <?$i=0;?>
        <?foreach($sortSection['ITEMS'] as $sort_item):?>
            <?$i++;?>
            <li class="category-block__item">
                <a href="<?=($sort_item['LINK_TARGET']['VALUE']) ? $sort_item['LINK_TARGET']['VALUE'] : $sort_item['CODE'].'/';?>" <?=($sort_item['LINK_TARGET']['VALUE']) ? "target='_self'" : "";?> class="category-block__link">
                    <?=$sort_item['NAME']?>
                </a>
            </li>
	<?endforeach;?>
        </ul>
        <?
    }
	?></div>
	<!--category-block--><?
}
?>
<!--catalog-feed-->
    <div class="basic-layout__module catalog-feed">
        <div class="catalog-feed__list">
<?
    foreach ($arResult['SECTIONS'] as &$arSection)
    {
    ?>
		<div class="catalog-feed__item">
		<!--catalog-card-->
        <section class="catalog-card">
            <h3 class="catalog-card__title"><a href="<?=$arSection['UF_SYM_LINK'] ? $arSection['UF_SYM_LINK'] : $arSection['SECTION_PAGE_URL']?>" target="_self" title='<?=$arSection['IPROPERTY_VALUES']['SECTION_META_TITLE']?>' class="catalog-card__link" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($arSection['NAME']))?>');"><?=$arSection['NAME']?></a></h3>
                <div class="catalog-card__cover">
                    <img class="catalog-card__image" width="262" height="197" src="<?=$arSection['PICTURE']['src']?>" alt="<?=$arSection['IPROPERTY_VALUES']['SECTION_META_TITLE']?>">
                </div>
            
        </section>
		<!--catalog-card-->
		</div>
    <?}?>
    <?php
    if(count($arResult['SORTING']['ROOT_ELEMENTS'])){
        foreach($arResult['SORTING']['ROOT_ELEMENTS'] as $dop_section){
            ?>
        <div class="catalog-feed__item">
		<!--catalog-card-->
        <section class="catalog-card">
            <h3 class="catalog-card__title"><a href="<?=($dop_section['LINK_TARGET']['VALUE']) ? $dop_section['LINK_TARGET']['VALUE'] : $dop_section['CODE'].'/';?>" target="_self" title='<?=$dop_section['IPROPERTY_VALUES']['SECTION_META_TITLE']?>' class="catalog-card__link"><?=$dop_section['H1']["VALUE"]?></a></h3>
                <div class="catalog-card__cover">
                    <img class="catalog-card__image" width="262" height="197" src="<?=$dop_section['PICTURE']['src']?>" alt="<?=$dop_section['IPROPERTY_VALUES']['SECTION_META_TITLE']?>">
                </div>
            
        </section>
		<!--catalog-card-->
		</div>
    <?php
            
        }
        
    }
    ?>
		</div>
    </div>
    <!--catalog-feed-->



<?if($_POST['ENUM_LIST']['ELEMENTS'])
	require_once __DIR__."/include_parts/section_table.php";?>
<!--simple-article-->
        <div class="basic-layout__module simple-article">
            <div class="simple-article__content wysiwyg-block">
				<?=$arResult['SECTION']['DESCRIPTION']?>
			</div>	
		</div>
<!--simple-article-->
<?endif?>
