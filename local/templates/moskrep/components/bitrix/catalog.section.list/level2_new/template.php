<?php

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
<?
//Если мы зашли на страницу СПРАВОЧНИКА
if($arResult['REFERENCE']['ITEM']['ID']!=''){?>
   
<h1 class="s38-title"><?=$arResult['REFERENCE']['ITEM']['H1']['VALUE']?></h1>
    
<nav class="nav-sale">
    <ul class="nav-sale__items">
    <?php
    
    //Выводим разделы прилинкованные в справочнике
    foreach ($arResult['DOP_SECTIONS'] as &$arSection)
    {
    ?>
        <li class="nav-sale__item">
            <a href="<?=$arSection['SECTION_PAGE_URL']?>" target="_self" title='<?=$arSection['IPROPERTY_VALUES']['SECTION_META_TITLE']?>' class="nav-sale__link">
                <div class="nav-sale__img">
                    <img src="<?=$arSection['PICTURE']['src']?>" alt="<?=$arSection['IPROPERTY_VALUES']['SECTION_META_TITLE']?>">
                </div>
                <span class="nav-sale__title"><?=$arSection['NAME']?></span>
            </a>
        </li>
    <?php
    }
    ?>		
    </ul>
</nav>
    <?if($arResult['TOP_SECTIONS']):?>
        <nav class="nav-sale">
            <ul class="nav-sale__items">
                <?foreach ($arResult['TOP_SECTIONS'] as &$arSection):?>
                    <li class="nav-sale__item">
                        <a href="<?=$arSection['SECTION_PAGE_URL']?>" target="_self" title='<?=$arSection['IPROPERTY_VALUES']['SECTION_META_TITLE']?>' class="nav-sale__link">
                            <div class="nav-sale__img">
                                <img src="<?=$arSection['PICTURE']['src']?>" alt="<?=$arSection['IPROPERTY_VALUES']['SECTION_META_TITLE']?>">
                            </div>
                            <span class="nav-sale__title"><?=$arSection['NAME']?></span>
                        </a>
                    </li>
                <?endforeach;?>
            </ul>
        </nav>
    <?endif;?>
    <?php
    
    //Выводим картинку и текст справочника
    if($arResult['REFERENCE']['ITEM']['PICTURE']){?>
    <div class="catalog-head__photo photo__seo">
        <a href="<?=$arResult['REFERENCE']['ITEM']['PICTURE']['src']?>"  onclick="javascript:void();" rel="catalog-photo" class="catalog-photo__link">
            <img src="<?=$arResult['REFERENCE']['ITEM']['PICTURE']['src']?>" alt="<?=$$arResult['REFERENCE']['ITEM']['H1']['VALUE']?>">
        </a>
    </div>
    <?php
    }?>
    <div class='set-default-parametr-page-cat'>
    <?=$arResult['REFERENCE']['ITEM']['DETAIL_TEXT']?>
    </div>
    <?php
    
    //Если справочник не по привязке к разделам, а по свойствам товаров, то делаем его в виде catalo.section, а не catalog.section.list
    if($arResult['REFERENCE']['ITEM']['DIRECTORY']){

    $intSectionID = $APPLICATION->IncludeComponent(
					"bitrix:catalog.section",
					"horizontal",
					array(
						
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"ELEMENT_SORT_FIELD" => ($arResult['REFERENCE']['ITEM']['DIAMETR']['VALUE']) ? 'IBLOCK_SECTION_ID' : 'property_DIAMETR',
						"ELEMENT_SORT_ORDER" => 'asc',
						"ELEMENT_SORT_FIELD2" => 'property_DLINA',
						"ELEMENT_SORT_ORDER2" => 'asc',
						"PROPERTY_CODE" => array("*"),
                                                "FOR_SEO"=>"Y",
						"PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
						"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
						"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
						"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
						"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
						"INCLUDE_SUBSECTIONS" => 'Y',
						"BASKET_URL" => $arParams["BASKET_URL"],
                                                "SHOW_ALL_WO_SECTION" => "Y",
						"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
						"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
						"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
						"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
						"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
						"USE_FILTER"=>"Y",
                                                "FILTER_NAME" => "Filter_seo",
                                                
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

						"PRICE_CODE" => array(
                                                    0 => "Распродажа",
                                                    1 => "К0 (БАЗОВАЯ НАЧАЛЬНАЯ)",
                                                ),
						"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
						"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

						"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
						"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
						"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
						"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
						"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

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
						"ADD_SECTIONS_CHAIN" => "Y",
						'ADD_TO_BASKET_ACTION' => $basketAction,
						'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
						'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
						'COMPARE_NAME' => $arParams['COMPARE_NAME'],
						'USE_COMPARE_LIST' => 'Y',
						'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
						'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
						'DISABLE_HEADER' => 'Y',
		
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
	 <div class='set-default-parametr-page-cat'>
<?=$arResult['REFERENCE']['ITEM']['PREVIEW_TEXT']?>
	</div>
    <?}
    
//Если не справочник, а обычный раздел каталога    
}else{
    if($IPROPERTY['SECTION_META_TITLE']==''){$APPLICATION->SetPageProperty('title', $arResult["SECTION"]["NAME"]);}?>
	
<?globalGetTitle($arResult['SECTION']['IPROPERTY_VALUES']['SECTION_PAGE_TITLE'] ? $arResult['SECTION']['IPROPERTY_VALUES']['SECTION_PAGE_TITLE'] : $arResult["SECTION"]["NAME"])?>

<?php

    //Если в разделе имеются справочники
    if($arResult['SORTING']['SECTION_ID']){
		?>
		<!--category-filter-->
        <div class="basic-layout__module category-filter">
		<?
        foreach($arResult['SORTING']['SECTIONS'] as $sortSection){
        
        if($sortSection['TOP']){
        ?>
			<h4 class="category-filter__title"><?=$sortSection["NAME"]?>:</h4>
            <ul class="category-filter__list">
            <?foreach($sortSection['ITEMS'] as $sort_item):?>
            
                <li class="category-filter__item">
                    <a href="<?=($sort_item['LINK_TARGET']['VALUE']) ? $sort_item['LINK_TARGET']['VALUE'] : $sort_item['CODE'].'/';?>" <?=($sort_item['LINK_TARGET']['VALUE']) ? "target='_self'" : "";?>  class="category-filter__link">
                    
                       <?=$sort_item['NAME']?>
                    </a>
                </li>
            <?endforeach;?>
        
            </ul>
        <?php
        }
        }
		?>
		</div>
		<!--category-filter-->
		<?
    }
?>
	<!--content-feed-->
    <div class="basic-layout__module content-feed">
        <div class="content-feed__list">
<?php
    foreach ($arResult['SECTIONS'] as &$arSection)
    {
        
?>		<div class="content-feed__item">
		<!--article-card-->
                     <section class="article-card article-card--category">
                        <div class="article-card__about">
                           <h3 class="article-card__title"><a class="article-card__link" href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?></a></h3>
                           <p class="article-card__desc"><?=$arSection['DESCRIPTION']?></p>
                           <a class="main-button main-button--mini article-card__button" href="<?=$arSection['SECTION_PAGE_URL']?>">В каталог</a>
                        </div>
                        <div class="article-card__cover">
                           <img class="article-card__image" src="<?=$arSection['PICTURE']['src']?>" width="301" height="226" alt="<?=$arSection['IPROPERTY_VALUES']['SECTION_META_TITLE']?>">
                        </div>
                     </section>
        <!--article-card-->
		</div>
        
    <?php
    }?>
    <?php
    if(count($arResult['SORTING']['ROOT_ELEMENTS'])){
        foreach($arResult['SORTING']['ROOT_ELEMENTS'] as $dop_section){
            ?>
			<div class="content-feed__item">
			<!--article-card-->
                     <section class="article-card article-card--category">
                        <div class="article-card__about">
                           <h3 class="article-card__title"><a class="article-card__link" href="<?=($dop_section['LINK_TARGET']['VALUE']) ? $dop_section['LINK_TARGET']['VALUE'] : $dop_section['CODE'].'/';?>"><?=$dop_section['H1']["VALUE"]?></a></h3>
                           <p class="article-card__desc"><?=$dop_section['PREVIEW_TEXT']?></p>
                           <a class="main-button main-button--mini article-card__button" href="<?=($dop_section['LINK_TARGET']['VALUE']) ? $dop_section['LINK_TARGET']['VALUE'] : $dop_section['CODE'].'/';?>">В каталог</a>
                        </div>
                        <div class="article-card__cover">
                           <img class="article-card__image" src="<?=$dop_section['PICTURE']['src']?>" width="301" height="226" alt="<?=$dop_section['H1']["VALUE"]?>">
                        </div>
                     </section>
            <!--article-card-->
			</div>
            

    <?php
            
        }
        
    }
    ?>
		</div>
    </div>

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

<!--simple-article-->
        <div class="basic-layout__module simple-article">
            <div class="simple-article__content wysiwyg-block">
			<?if($_SERVER['HTTP_HOST']=='spb.krep-komp.ru' || $_SERVER['HTTP_HOST']=='krep-komp.ru'){?>
				<?=$arResult['SECTION']['DESCRIPTION']?>
			<?}?>
			</div>	
		</div>
<!--simple-article-->

<?php
}?>
