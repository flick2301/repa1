<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->setFrameMode(true);

global $APPLICATION;
global $context;
global $sec_builder;

$request = $context->getRequest();
$requestUri = $request->getRequestUri();
    
    
    

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
      
    
	<?globalGetTitle($arResult['REFERENCE']['ITEM']['ELEMENT_PAGE_TITLE'] ? $arResult['REFERENCE']['ITEM']['ELEMENT_PAGE_TITLE'] : $arResult['REFERENCE']['ITEM']['H1']['VALUE'])?>

	
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
				<div class="div_flex_h3 catalog-card__title"><a href="<?=$arSection['SECTION_PAGE_URL']?>" target="_self" title='<?=$arSection['IPROPERTY_VALUES']['SECTION_META_TITLE']?>' class="catalog-card__link"><?=$arSection['NAME']?></a></div>
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
					<div class="div_flex_h3 catalog-card__title"><a href="<?=$arSection['SECTION_PAGE_URL']?>" target="_self" title='<?=$arSection['IPROPERTY_VALUES']['SECTION_META_TITLE']?>' class="catalog-card__link"><?=$arSection['NAME']?></a></div>
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



    <?
    //ФИЛЬТРОВЫЕ КНОПКИ ДЛЯ ПОСАДОЧНЫХ СТРАНИЦ
    if($arResult['SORTING']['SECTION_ID']){
        ?>

        <?

        foreach($arResult['SORTING']['SECTIONS'] as $sortSection){
            if($sortSection['TOP']){
                ?>
                <div class="basic-layout__module category-blocknew">
                    <div class="div_h3 category-blocknew__title"><span><?=$sortSection["NAME"]?></span></div>
                    <ul class="category-blocknew__list">
                        <?$i=0;?>
                        <?foreach($sortSection['ITEMS'] as $sort_item):?>
                            <?$i++;
                            $link = $link = $sec_builder->linkBuilder($sort_item, $sortSection);

                            ?>

                            <li class="category-blocknew__item" >
                                <a href="<?=$link?>" <?=($sort_item['LINK_TARGET']['VALUE']) ? "target='_self'" : "";?> class="category-block__link <?=$sort_item['IS_ACTIVE']?>">
                                    <?=$sort_item['NAME']?>
                                </a>
                            </li>
                        <?endforeach;?>
                    </ul>
                </div>
                <?
            }
        }

    }
    ?>


	<?if(!empty($arResult['REFERENCE']['ITEM']['SECTION_LINK']['VALUE']) && $_POST['ENUM_LIST']['ELEMENTS'])
		require_once __DIR__."/include_parts/section_table.php";?>
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

    if($arResult['REFERENCE']['ITEM']['DIRECTORY'] && $intSectionID==0){

		
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

<?$this->SetViewTarget('catalog_section');?>

	 <div class="basic-layout__columns basic-layout__columns--reverse">
		  <div class="basic-layout__content full">
		  
		  <?
		  if($arResult['SECTION']["UF_H1_MSK"] && $_SERVER['HTTP_HOST'] != 'spb.krep-komp.ru')
		  {
			$h1_section = $arResult['SECTION']["UF_H1_MSK"];
		  }elseif($arResult['SECTION']["UF_H1_SPB"] && $_SERVER['HTTP_HOST'] == 'spb.krep-komp.ru')
		  {
			$h1_section = $arResult['SECTION']["UF_H1_SPB"];
		  }else
		  {
			  $h1_section = $arResult['SECTION']['IPROPERTY_VALUES']['SECTION_PAGE_TITLE'] ? $arResult['SECTION']['IPROPERTY_VALUES']['SECTION_PAGE_TITLE'] : $arResult["SECTION"]["NAME"];
		  }
		  ?>
<?globalGetTitle($h1_section)?>	


<?
//Проверка, что из саморезов и шурупов, отслеживаем путь, берем второго родителя( Крепеж - первый и т.д.)
$second_parent = $arResult['SECTION']['PATH']['1'];
if(0)
{
    $arParams['SECTIONS_LIST_TEMPLATE']="<!--catalog-feed-->
            <div class=\"basic-layout__module basic-layout__module__sections catalog-feed below-table\">
        <div class=\"catalog-feed__list\">";
    foreach ($arResult['SECTIONS'] as &$arSection)
    {
        $white_class = (!$arSection['DETAIL_PICTURE']) ? 'catalog-feed__item__white' : '';
        $arParams['SECTIONS_LIST_TEMPLATE'].= "<div class=\"catalog-feed__item catalog-feed__item__withpic ".$white_class."\">
            <!--catalog-card-->
            <section class=\"catalog-card\">";
        $link = $arSection['UF_SYM_LINK'] ?? $arSection['SECTION_PAGE_URL'];
        $name = $arSection['UF_SHORT_NAME'] ?? $arSection['NAME'];
        $arParams['SECTIONS_LIST_TEMPLATE'].= "<div class=\"div_flex_h3 catalog-card__title\"><a href=\"$link\" target=\"_self\" title=\"".$arSection['IPROPERTY_VALUES']['SECTION_META_TITLE']."\" class=\"catalog-card__link\" onclick=\"dataLayerProduct(".str_replace(Array("\"", "'"), "", htmlspecialchars($arSection['NAME'])).");\">$name</a></div>";
        $cover_class = (!$arSection['DETAIL_PICTURE']) ? 'catalog-card__cover__white' : '';
        $arParams['SECTIONS_LIST_TEMPLATE'].= "<div class=\"catalog-card__cover $cover_class\">";
        $arParams['SECTIONS_LIST_TEMPLATE'].= "<img class=\"catalog-card__image\" width=\"262\" height=\"197\" src=\"".$arSection['PICTURE']['src']."\" alt=\"".$arSection['IPROPERTY_VALUES']['SECTION_META_TITLE']."\">
                </div>

            </section>
            <!--catalog-card-->
        </div>";
    }
    $arParams['SECTIONS_LIST_TEMPLATE'] .= "</div>
    </div>
    <!--catalog-feed-->";
}
elseif($arParams['TYPE_TEMPLATE']!='BOTTOM')
{
   	?>

<!--catalog-feed-->
    <div class="basic-layout__module basic-layout__module__sections catalog-feed">
        <div class="catalog-feed__list">
<?
    foreach ($arResult['SECTIONS'] as &$arSection)
    {
    ?>
		<div class="catalog-feed__item catalog-feed__item__withpic <?if(!$arSection['DETAIL_PICTURE']):?>catalog-feed__item__white<?endif?>">
		<!--catalog-card-->
        <section class="catalog-card">
            <div class="div_flex_h3 catalog-card__title"><a href="<?=$arSection['UF_SYM_LINK'] ? $arSection['UF_SYM_LINK'] : $arSection['SECTION_PAGE_URL']?>" target="_self" title='<?=$arSection['IPROPERTY_VALUES']['SECTION_META_TITLE']?>' class="catalog-card__link" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($arSection['NAME']))?>');"><?=$arSection['UF_SHORT_NAME'] ? $arSection['UF_SHORT_NAME'] : $arSection['NAME']?></a></div>
                <div class="catalog-card__cover <?if(!$arSection['DETAIL_PICTURE']):?>catalog-card__cover__white<?endif?>">
                    <img class="catalog-card__image" width="262" height="197" src="<?=$arSection['PICTURE']['src']?>" alt="<?=$arSection['IPROPERTY_VALUES']['SECTION_META_TITLE']?>">
                </div>
            
        </section>
		<!--catalog-card-->
		</div>
    <?}?>
	<?if ($arResult["SECTION"]["UF_YOUTUBE"]):?>
	<?$video_view_name = mb_strtolower(mb_substr($h1_section, 0, 1)) . mb_substr($h1_section, 1);?>
<div class="catalog-feed__item catalog-feed__item__withpic catalog-feed__item__white">
		<!--goto-video-->
    <section id="catalog-card_goto-video" class="catalog-card catalog-card_goto-video">
      <div class="div_flex_h3 catalog-card__title"><a href="javascript:void();" title="Видеобзоры на <?=$video_view_name?>" class="catalog-card__link">Видеобзоры на <?=$video_view_name?></a></div>
        <div class="catalog-card__cover catalog-card__cover__white">
          <img class="catalog-card__image catalog-card__image_goto-video" width="262" height="197" src="<?=SITE_TEMPLATE_PATH?>/img/video_view_name.svg" alt="Видеобзоры на <?=$video_view_name?>">
        </div>
      
    </section>
		<!--goto-video-->
		</div>
		
	<?endif?>	
    <?php
    if(count($arResult['SORTING']['ROOT_ELEMENTS'])){
        foreach($arResult['SORTING']['ROOT_ELEMENTS'] as $dop_section){
            ?>
        <div class="catalog-feed__item">
		<!--catalog-card-->
        <section class="catalog-card">
            <div class="div_flex_h3 catalog-card__title"><a href="<?=($dop_section['LINK_TARGET']['VALUE']) ? $dop_section['LINK_TARGET']['VALUE'] : $dop_section['CODE'].'/';?>" target="_self" title='<?=$dop_section['IPROPERTY_VALUES']['SECTION_META_TITLE']?>' class="catalog-card__link"><?=$dop_section['H1']["VALUE"]?></a></div>
                <div class="catalog-card__cover <?if(!$dop_section['DETAIL_PICTURE']):?>catalog-card__cover__white<?endif?>">
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

<?}?>

	
		<!--category-blocknew-->
            <div class="basic-layout__module category-blocknew">
	<?
	//Если по шаблону категории должны быть под таблицей
	if($arParams['TYPE_TEMPLATE']=='BOTTOM')
	{
		?><div class="div_h3 category-blocknew__title"><span>Основные категории</span></div>
		<ul class="category-blocknew__list">
        <?$i=0;?><?
		foreach ($arResult['SECTIONS'] as &$arSection)
		{
			$i++;
		?>
			<li class="category-blocknew__item">
                <a href="<?=$arSection['UF_SYM_LINK'] ? $arSection['UF_SYM_LINK'] : $arSection['SECTION_PAGE_URL']?>" target="_self" class="category-block__link">
                    <?=($arSection['UF_SHORT_NAME']) ? $arSection['UF_SHORT_NAME']: $arSection['NAME'];?>
                </a>
            </li>
		
		<?}?>
		</ul><?
	}
	?></div>

	<!--category-blocknew-->
	
			  </div>
	</div>
	
<?$this->EndViewTarget();?> 	
	
<?
if($arResult['SORTING']['SECTION_ID']){
?>	

	<?
	
    foreach($arResult['SORTING']['SECTIONS'] as $sortSection){
        if($sortSection['TOP']){
        ?>
		<div class="basic-layout__module category-blocknew">
			<div class="div_h3 category-blocknew__title"><span><?=$sortSection["NAME"]?></span></div>
			<ul class="category-blocknew__list">
			<?$i=0;?>
			<?foreach($sortSection['ITEMS'] as $sort_item):?>
				<?$i++;
                $link = $sec_builder->linkBuilder($sort_item, $sortSection);

            ?>

				<li class="category-blocknew__item" >
                    <a href="<?=$link?>" <?=($sort_item['LINK_TARGET']['VALUE']) ? "target='_self'" : "";?> class="category-block__link <?=$sort_item['IS_ACTIVE']?>">
						<?=$sort_item['NAME']?> <?=$sort_item['sef_filter']['VALUE_XML_ID']?>
					</a>
				</li>
			<?endforeach;?>
			</ul>
		</div>
        <?
		}
    }
	
}
?>

<?if($_POST['ENUM_LIST']['ELEMENTS'])
	require_once __DIR__."/include_parts/section_table.php";?>



<?
if($arResult['SORTING']['SECTION_ID']){
?>
	<!--category-blocknew-->
            <div class="basic-layout__module category-blocknew">
			
	<?
	
    foreach($arResult['SORTING']['SECTIONS'] as $sortSection){
        if(!$sortSection['TOP']){
        ?>
        <div class="div_h3 category-blocknew__title"><span><?=$sortSection["NAME"]?></span></div>
        <ul class="category-blocknew__list">
        <?$i=0;?>
        <?foreach($sortSection['ITEMS'] as $sort_item):?>
            <?$i++;?>
            <li class="category-blocknew__item">
                <a href="<?=($sort_item['LINK_TARGET']['VALUE']) ? $sort_item['LINK_TARGET']['VALUE'] : $sort_item['CODE'].'/';?>" <?=($sort_item['LINK_TARGET']['VALUE']) ? "target='_self'" : "";?> class="category-block__link">
                    <?=$sort_item['NAME']?>
                </a>
            </li>
	<?endforeach;?>
        </ul>
        <?
		}
    }
	?></div>

	<!--category-blocknew-->
	<?
	
	/*
	?>
	<!--category-block-->
            <div class="basic-layout__module category-block">
	<?
	//Если по шаблону категории должны быть под таблицей
	if($arParams['TYPE_TEMPLATE']=='BOTTOM')
	{
		?><div class="div_h3 category-block__title">Основные категории</div>
		<ul class="category-block__list">
        <?$i=0;?><?
		foreach ($arResult['SECTIONS'] as &$arSection)
		{
			$i++;
		?>
			<li class="category-block__item">
                <a href="<?=$arSection['UF_SYM_LINK'] ? $arSection['UF_SYM_LINK'] : $arSection['SECTION_PAGE_URL']?>" target="_self" class="category-block__link">
                    <?=($arSection['UF_SHORT_NAME']) ? $arSection['UF_SHORT_NAME']: $arSection['NAME'];?>
                </a>
            </li>
		
		<?}?>
		</ul><?
	}
    foreach($arResult['SORTING']['SECTIONS'] as $sortSection){
        
        ?>
        <div class="div_h3 category-block__title"><?=$sortSection["NAME"]?></div>
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
	<!--category-block--><?*/
}
?>

<?
if($arResult["S_ETIM_TOVAROM"]){
?>
<br><br>
<div class="recomend__title">Рекомендации</div>
<div class="catalog-feed__other">
<?
$arFilter = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], "ID"=>$arResult["S_ETIM_TOVAROM"], false, array("*"));
$db_list = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, true);
while($arSection = $db_list->GetNext()) {
    $renderImage = CFile::ResizeImageGet($arSection["PICTURE"], Array("width" => 172, "height" => 172), BX_RESIZE_IMAGE_EXACT, false); 
    ?>
		<div class="catalog-feed__child">
                     <!--category-card-->
                     <div class="category-card">
                        <p class="category-card__title"><a class="category-card__link" href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?></a></p>
                        <div class="category-card__cover">
                           <img class="category-card__image" src="<?=$renderImage['src']?>" width="120" height="76" alt="<?=$arSection['NAME']?>"> 
                        </div>
                     </div>
                     <!--category-card-->
		</div>
	<?
}
?>
</div>
<?}?>


<!--simple-article-->
<?if(!($_REQUEST['PAGEN_1'] > 1)  && ($_SERVER['HTTP_HOST']=='spb.krep-komp.ru' || $_SERVER['HTTP_HOST']=='krep-komp.ru' || $_SERVER['HTTP_HOST']=='dev2.krep-komp.ru')):?>
<?if($arResult['SECTION']['UF_DESCRIPTION_ABOUT'] /*&& ($USER->IsAdmin() || $arResult['SECTION']['UF_DESCRIPTION_SPECIES'] || $arResult['SECTION']['UF_DESCRIPTION_WHOLESALE'] || $arResult['SECTION']['UF_DESCRIPTION_WARRANTY'] || $arResult['SECTION']['UF_DESCRIPTION_DELIVERY'] || $arResult['SECTION']['UF_DESCRIPTION_SORT'])*/):?>



        <!--product-tabs-->
               <div class="product-page__tabs product-tabs" id="desc">
                  <ul class="product-tabs__list" data-product-page-tabs>		
                     <li class="product-tabs__item">
                        <a class="product-tabs__toggle" href="#description_about" data-tabby-default>Описание</a>
                     </li>
					 
					 <?if($arResult['SECTION']['UF_DESCRIPTION_SPECIES'] && false):?>
                     <li class="product-tabs__item">
                        <a class="product-tabs__toggle" href="#description_species">Виды</a>
                     </li>
					 <?endif?>
					 
					 <?if($arResult['SECTION']['UF_DESCRIPTION_WHOLESALE'] || true):?>					 
                     <li class="product-tabs__item">
                        <a class="product-tabs__toggle" href="#description_wholesale"><?=explode(" ", $arResult['SECTION']["NAME"])[0]?> оптом</a>
                     </li>
					 <?endif?>
                     <li class="product-tabs__item">
                        <a class="product-tabs__toggle" href="#description_payment">Как заказать</a>
                     </li>					 
					 <?if($arResult['SECTION']['UF_DESCRIPTION_WARRANTY'] || true):?>						 
                     <li class="product-tabs__item">
                        <a class="product-tabs__toggle" href="#description_warranty">Гарантия</a>
                     </li>
					 <?endif?>
					 <?if($arResult['SECTION']['UF_DESCRIPTION_DELIVERY'] || true):?>						 
                     <li class="product-tabs__item">
                        <a class="product-tabs__toggle" href="#description_delivery">Доставка</a>
                     </li>
					 <?endif?>		
					 <?if($arResult['SECTION']['UF_DESCRIPTION_SORT'] && false):?>						 
                     <li class="product-tabs__item">
                        <a class="product-tabs__toggle" href="#description_sort">Сортировка</a>
                     </li>	
					<?endif?>			
					 <?if($arResult['SECTION']['UF_YOUTUBE']):?>						 
                     <li class="product-tabs__item">
                        <a class="product-tabs__toggle" href="#description_youtube">Видео</a>
                     </li>	
					<?endif?>						
                  </ul>
               </div>
        <!--product-tabs-->


<div class="product-page__section" id="description_about">
<div class="basic-layout__module simple-article">
<div class="simple-article__content wysiwyg-block">		
<?=$arResult['SECTION']['~UF_DESCRIPTION_ABOUT'];?>
<?=$arResult['SECTION']['~UF_DESCRIPTION_SPECIES'];?>
</div>	
</div>
</div>	

<?if($arResult['SECTION']['UF_DESCRIPTION_SPECIES'] && false):?>
<div class="product-page__section" id="description_species">
<div class="basic-layout__module simple-article">
<div class="simple-article__content wysiwyg-block">		
<?=$arResult['SECTION']['~UF_DESCRIPTION_SPECIES'];?>
</div>	
</div>
</div>	
<?endif?>

<?if($arResult['SECTION']['UF_DESCRIPTION_WHOLESALE'] || true):?>	
<div class="product-page__section" id="description_wholesale">
<div class="basic-layout__module simple-article">
<div class="simple-article__content wysiwyg-block">	
<?if($arResult['SECTION']['~UF_DESCRIPTION_WHOLESALE']):?>	
<?=$arResult['SECTION']['~UF_DESCRIPTION_WHOLESALE'];?>
<?else:?>
<h2 style="text-align: left;"> Как купить <?=mb_strtoupper(explode(" ", $arResult['SECTION']["NAME"])[0])?> ОПТОМ?</h2>
Все цены, предоставленные на нашем сайте БАЗОВЫЕ (мелкооптовые).<br />
Для того, чтобы купить <?=mb_strtolower(explode(" ", $arResult['SECTION']["NAME"])[0])?> оптом, нужно сделать заказ от 20 000 рублей. <br />
На такие заказы, мы предоставляем следующие скидки:<br /><br />
От 20 000 рублей – 5%<br />
От 100 000 рублей – 10%<br />
От 500 000 рублей – 15%<br /><br />
Скидка сохраняется на месяц, при условии выбора товара на сумму, соответствующей скидки.<br />
Также, для особо крупных клиентов, с оборотом от 5 000 000 рублей в квартал, у нас предусмотрена скидка в 20%. Она закрепляется на квартал, и по итогам нового квартала пересчитывается. <br /><br />
Все цены, предоставленные в нашем прайс-листе и на сайте с НДС.<br /><br />
Так же, для крупных заказов, суммой от 50 000 рублей, у нас предусмотрена бесплатная доставка по Москве, в пределах МКАД. 
<?endif?>
</div>		
</div>
</div>
<?endif?>

<div class="product-page__section" id="description_payment">
<div class="basic-layout__module simple-article">
<div class="simple-article__content wysiwyg-block">		
<h2 style="text-align: left;">Как сделать заказ?</h2>
Сделать заказ можно несколькими способами:<br /><br />
<ul>
<li>На сайте через корзину (самый быстрый способ, чтобы получить счет).</li>
<li>Отправить заявку через форму на сайте, прикрепив её.</li>
<li>Отправить заявку на почту.</li>
<li>Отправить заявку в мессенджере (Живосайт).</li>
<li>Позвонить по телефону и продиктовать менеджеру.</li>
<ul><br />
<h2 style="text-align: left;">Как получить заказ?</h2>
Получить заказ можно у нас на центральном складе или в любом магазине ПВЗ.
Либо воспользоваться нашей услугой по доставке вашего заказа. 
<br /><br />
Телефон отдела продаж: (499) 350-55-55
</div>
</div>
</div>	

<?if($arResult['SECTION']['UF_DESCRIPTION_WARRANTY'] || true):?>		
<div class="product-page__section" id="description_warranty">
<div class="basic-layout__module simple-article">
<div class="simple-article__content wysiwyg-block">		
<?if($arResult['SECTION']['~UF_DESCRIPTION_WARRANTY']):?>	
<?=$arResult['SECTION']['~UF_DESCRIPTION_WARRANTY'];?>
<?else:?>
<h2 style="text-align: left;">Гарантия качества “КРЕП-КОМП”</h2>
<p>
	 Все крепежные изделия и <?=mb_strtolower(explode(" ", $arResult['SECTION']["NAME"])[0])?> торговых марок “KREP-KOMP” и “KENNER” изготавливаются на ведущих фабриках на современном оборудовании, и из первичного сырья. На всю продукцию мы предоставляем соответствующие сертификаты. Наша компания КРЕП-КОМП даёт гарантию, и в случае если вас что-то не устроит, вы сможете вернуть нам приобретенные у нас изделия обратно, при условии целостности упаковки.
</p>
<?endif?>
</div>	
</div>
</div>
<?endif?>	

<?if($arResult['SECTION']['UF_DESCRIPTION_DELIVERY'] || true):?>
<div class="product-page__section" id="description_delivery">
<div class="basic-layout__module simple-article">
<div class="simple-article__content wysiwyg-block">	
<?if($arResult['SECTION']['UF_DESCRIPTION_DELIVERY']):?>	
<?=$arResult['SECTION']['~UF_DESCRIPTION_DELIVERY'];?>
<?else:?>
<h2 style="text-align: left;">Доставка заказов</h2>
<p>
	 Мы выполняем доставку заказов собственным автотранспортом по {{region}}, а также во все города РФ, через транспортные компании. До ТК “Деловые Линии” и “ПЭК”, мы везём бесплатно от любой суммы заказа, услуги самой ТК от города {{city}} до вашего города оплачиваете вы.
</p>
<?endif?>
</div>
</div>
</div>	
<?endif?>

<?if($arResult['SECTION']['UF_DESCRIPTION_SORT'] && false):?>		
<div class="product-page__section" id="description_sort">
<div class="basic-layout__module simple-article">
<div class="simple-article__content wysiwyg-block">		
<?=$arResult['SECTION']['~UF_DESCRIPTION_SORT'];?>
</div>
</div>
</div>	
<?endif?>
	
<?if($arResult['SECTION']['UF_YOUTUBE']):?>						 
<div class="product-page__section" id="description_youtube">
<div class="basic-layout__module simple-article">
<div class="simple-article__content wysiwyg-block">	
<?$arResult['SECTION']['UF_YOUTUBE'] = explode("|", $arResult['SECTION']['UF_YOUTUBE'])?>
<?foreach($arResult['SECTION']['UF_YOUTUBE'] AS $youtube):?>
<iframe class="youtube_video" width="100%" height="" src="https://www.youtube.com/embed/<?=$youtube;?>" title="<?=$h1_section?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<?endforeach?>
</div>
</div>
</div>
<?endif?>	



<?else:?>
        <div class="basic-layout__module simple-article">
            <div class="simple-article__content wysiwyg-block">
				<?=$arResult['SECTION']['DESCRIPTION']?>
			</div>	
		</div>
	<?endif?>	
	<?endif;?>
<!--simple-article-->
<?endif?>


<script src="/local/templates/moskrep/assets/scripts/tabby-12.0.3.min.js?v=XXXXXXa"></script>
<script>var tabs=new Tabby("[data-product-page-tabs]");tabs=new Tabby("[data-delivery-tabs]"),tabs=new Tabby("[data-pickup-tabs]"),tabs=new Tabby("[data-product-widget-tabs]")</script>
