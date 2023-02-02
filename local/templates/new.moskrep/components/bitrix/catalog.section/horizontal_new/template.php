<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();


global $APPLICATION;
global $DEFAULT_STORE_ID;
global $filterObj;
global $request;
global $arFilter_soput;
include($_SERVER["DOCUMENT_ROOT"]."/include/array_rals.php");
$ral_in_ar = $arResult['ITEMS'][10]['PROPERTIES']["TSVET"]["VALUE"];

//Параметр FOR_SEO устанавливается если это раздел справочника, а не каталога
//А значит текст и заголовок(шапка) не берутся из каталога, а из справочника, значит условие FOR_SEO != Y
if($arParams['FOR_SEO']!='Y'){
    

    if(empty($APPLICATION->GetPageProperty('title')))
		$APPLICATION->SetPageProperty('title', $arResult["NAME"].", цена - купить в интернет-магазине в Москве");

    $clock = date('G');
	
	
    ?>

<?if(!$_POST['ENUM_LIST']['ELEMENTS'] && !$arParams["DISABLE_HEADER"]=='Y'){?>

<?globalGetTitle($APPLICATION->GetPageProperty('page_title') ? $APPLICATION->GetPageProperty('page_title') : ($arResult['META_TITLE'] ? $arResult['META_TITLE'] : $arResult['NAME']))?>

<?if($arResult['DESCRIPTION']):?>
	<div class="basic-layout__module catalog-desc">
        <div class="catalog-desc__cover">
            <img class="catalog-desc__image" src="<?=$arResult['PICTURE']['SRC']?>" width="226" height="170" alt="<?=($arResult['META_TITLE']) ? $arResult['META_TITLE'] :$arResult['NAME'];?>" title="<?=($arResult['META_TITLE']) ? $arResult['META_TITLE'] :$arResult['NAME'];?>" />
        </div>
		<p class="catalog-desc__about">
        <?=strip_tags($arResult['DESCRIPTION']);?>
		</p>
	
    <?if($arResult['GENERAL_PROPERTIES']){?>
    <!--product-data-->
        <div class="catalog-desc__data product-data">
            <ul class="product-data__list">
            <?foreach($arResult['GENERAL_PROPERTIES'] as $key=>$value){
            ?>
				<li class="product-data__item"><p class="product-data__name"><?=$key?></p><p class="product-data__text"><?=$value?></p></li>
		
            <?}?>
			</ul>
		
        <?if($arResult['CERT_URL']):?>
            <div class="product-data__more">
                <p class="product-data__title">Информация:</p>
                <ul class="info-nav__items">
                    <?if($arResult['CERT_URL']):?>
                        <a class="product-data__link" href="<?=$arResult['CERT_URL'];?>" title='Сертификаты на <?=$arResult['CERT_NAME'];?>'>Сертификаты на <?=$arResult['CERT_NAME'];?></a>
                    <?endif;?>

                </ul>
            </div>
        <?endif;?>
		</div>
	<!--product-data-->
    <?}?>
</div>
<!--catalog-desc-->
<?endif;?>



<?php
    $showTopPager = $arParams["DISPLAY_TOP_PAGER"];
    $showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
    $showLazyLoad = false;

    if ($arParams['PAGE_ELEMENT_COUNT'] > 0 && $navParams['NavPageCount'] > 1)
    {
	$showTopPager = $arParams['DISPLAY_TOP_PAGER'];
	$showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
	$showLazyLoad = $arParams['LAZY_LOAD'] === 'Y' && $navParams['NavPageNomer'] != $navParams['NavPageCount'];
    }

//ШАПКА ТАБЛИЦЫ

}?>

<?
//ФИЛЬТРОВЫЕ КНОПКИ ДЛЯ ПОСАДОЧНЫХ СТРАНИЦ
if($arResult['SORTING']['SECTION_ID'] && $arParams['DISPLAY_FILTER_BUTTONS']=='Y'){
    ?>

    <?

    foreach($arResult['SORTING']['SECTIONS'] as $sortSection){
        if($sortSection['TOP']){
            ?>

            <ul class="category-blocknew__list">
                <?$i=0;?>
                <?foreach($sortSection['ITEMS'] as $sort_item):?>
                    <?$i++;
                    $link =  $filterObj->sec_builder->linkBuilder($sort_item, $sortSection);

                    ?>

                    <li class="category-blocknew__item" >
                        <a href="<?=$link?>" <?=($sort_item['LINK_TARGET']['VALUE']) ? "target='_self'" : "";?> class="category-block__link <?=$sort_item['IS_ACTIVE']?>">
                            <?=$sort_item['NAME']?>
                        </a>
                    </li>
                <?endforeach;?>
            </ul>

            <?
        }
    }

}
?>



    <div id="shops-window"><div class="win"></div></div>
<div class="page_count_panel">


<div class="page_count_panel_viewblock">Показано <?=count($arResult['ITEMS'])?> из <?=$arResult['NAV_RESULT']->NavRecordCount?> товаров</div>



<div class="page_count_panel_block">


<a id="view_wholesale" href="javascript:void(0);" rel="nofollow" class="blue-btn page_count_panel_viewblock_btn">Оптовые скидки</a>



<select name="page_element_count" id="page_element_count">
	<?foreach(PAGE_ELEMENT_COUNT as $page_element_count)
	{?>
          <option value="<?=$page_element_count?>" <?=($arParams['PAGE_ELEMENT_COUNT'] == $page_element_count) ? 'selected="selected"' : '';?>>Показывать: по <?=$page_element_count?></option>
	<?}?>
</select>
    <?if($arParams["SELECT_PAGE_TEMPLATE"]!="Y"){?>
        <select name="select_template" id="select_template">
            <option value="horizontal_new" selected="selected">Элементы: Таблицей</option>
            <option value="vertical" >Элементы: Блоками</option>
        </select>
    <?}?>
</div>
</div>

<!--catalog-feed-->
    <div class="basic-layout__module catalog-feed">
<?if($arResult['UF_SOPUT_SPR_ITMES']){
	?>
	        <div class="catalog-feed__other">
		<?
		foreach($arResult['UF_SOPUT_SPR_ITMES'] as $soput_itme){
			
		?>
					<div class="catalog-feed__child">
                     <!--category-card-->
                     <div class="category-card">
                        <p class="category-card__title"><a class="category-card__link" href="<?=$soput_itme['FULL_URL']?>/"><?=$soput_itme['NAME']?></a></p>
                        <div class="category-card__cover">
                          <!-- <img class="category-card__image" src="uploads/category-card/cover-01.jpg" width="120" height="76" alt=""> -->
                        </div>
                     </div>
                     <!--category-card-->
					</div>

<?
		}
				?></div>
			
		<!--catalog-feed--><?	

	}?>
	
			<?$this->SetViewTarget('catalogFilterClass');?>
                  catalog
			<?$this->EndViewTarget();?>



	
			<div class="catalog-feed__tabs">
			<?$this->SetViewTarget('catalogFilter');?>
                  <button class="catalog-feed__filter" id="catalog-filter-trigger2"><i class="simple-filter-icon"></i>Фильтр</button>
			<?$this->EndViewTarget();?> 
			<div id="filter__catalog_desktop"><button class="catalog-feed__filter" id="catalog-filter-trigger"><i class="simple-filter-icon"></i>Фильтр</button></div>	
            </div>	
<?
}

?>
				
    <div class="catalog-feed__list">
	
    
				
			
				
<?php
	//if ($_SERVER['REQUEST_URI']=="/krepezh/samorezy/samorezy_po_derevu/ostrye_pd/") file_put_contents($_SERVER["DOCUMENT_ROOT"].'/service/text.txt', print_r($arResult['SIZES'], true));
	
	$size_index=0;

    foreach($arResult['SIZES'] as $key=>$size){
        
        $index=0;
		$size_index++;
        foreach ($size as $item)
        {
			
            
            $price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_SALE_PRICE]['VALUE'] : $item['MIN_PRICE']['VALUE'] ? $item['MIN_PRICE']['VALUE'] : $item['PRICES'][ID_BASE_PRICE]['VALUE'];
            $old_price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_BASE_PRICE]['VALUE'] : 0;
        ?>
        
        <div class="catalog-feed__table">
            <!--catalog-table-->
                <section class="catalog-table">
				
				

					<div class="catalog-table__column catalog-table__column--basic <?=$index>0 ? " is-merged is-merged-{$index}" : "groupped";?>">				
                        <div class="catalog-table__title">Размер, мм<small>:</small></div>
		<div class="item_img_block">
					<img src="<?=$item['PREVIEW_PICTURE']['src']?>" alt='<?=$item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT']?>' />
					<div><?=($item['PROPERTIES']['ROOT_NAME']['VALUE']) ? $item['PROPERTIES']['ROOT_NAME']['VALUE'] : $item['NAME'];?></div>
					</div>							
                        <div class="catalog-table__content">							
						<span class="catalog-table__desc"><strong><?=$item['SIZES']?></strong></span></div>

                    </div>
					
        
            <?
            $index++;
            ?>
					<div class="catalog-table__column catalog-table__column--basic">				
                        <div class="catalog-table__title">Фасовка<small>:</small></div>
                        <div class="catalog-table__content">
                            <a class="catalog-table__link" href="<?=$item['DETAIL_PAGE_URL']?>" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($item['PROPERTIES']['ROOT_NAME']['VALUE'] ? $item['PROPERTIES']['ROOT_NAME']['VALUE'] : $item['NAME']))?>')" target="_self"><?=($item['PROPERTIES']["KOLICHESTVO_V_UPAKOVKE"]["VALUE"]) ? $item['PROPERTIES']["KOLICHESTVO_V_UPAKOVKE"]["VALUE"] : '1';?> <?=$item['UNIT']?></a>
                        </div>
                    </div>

            
            <?if(!$arResult['ENUM_LIST']['TURN_OFF_ARTICUL'] && !$_POST['ENUM_LIST']['TURN_OFF_ARTICUL'])
				{?>
					<div class="catalog-table__column catalog-table__column--basic">
                        <div class="catalog-table__title">Артикул<small>:</small></div>
                        <div class="catalog-table__content">
                            <?=$item['PROPERTIES']["CML2_ARTICLE"]["VALUE"]?>
                        </div>
                    </div>
			
			<?}?>
	        <?if(!$arResult['ENUM_LIST']['TURN_OFF_DELIVERY'] && !$_POST['ENUM_LIST']['TURN_OFF_DELIVERY'])
				{?>
			

					<div class="catalog-table__column catalog-table__column--basic">
					
									
						<div class="catalog-table__title">Получение<small>:</small></div>
                        <div class="catalog-table__content">
                            <span class="pickup-view" data-product="<?=$item['ID']?>">
									<div id='pickup_<?=$item['ID']?>' class="pickup-block">
										
									</div>
							</span>
							<span class="delivery-view" data-product="<?=$item['ID']?>">
									<div id='delivery_<?=$item['ID']?>' class="delivery-block">
										
									</div>
							</span>

                        </div>
					</div>
										
				<?}?>
			
		<?if($ral_in_ar){?>
					<div class="catalog-table__column catalog-table__column--color">
                        <div class="catalog-table__title">Цвет, RAL<small>:</small></div>
                           <div class="catalog-table__content">
							<div class="color-b" width="34" height="19"><i style="background: #<?=$array_rals[$item['PROPERTIES']["TSVET"]["VALUE"]]?>;"></i></div>
                            <p class="catalog-table__desc"><?=$item['PROPERTIES']["TSVET"]["VALUE"]?></p>
                        </div>
                    </div>
            
        <?}?>
		<?if($arResult['EXTRA_FIELD']){
			foreach($arResult['EXTRA_FIELD'] as $field){?>
					<div class="catalog-table__column catalog-table__column--basic" data-code="<?=$field['CODE']?>"><?$item['PROPERTIES'][$field['CODE']]["VALUE"] ? $view[$field['CODE']]=true : "";?>
					<?=$size_index==count($arResult['SIZES']) && $index==count($size) && !$view[$field['CODE']] ? "<script>$('.catalog-table__column[data-code=\"{$field['CODE']}\"]').hide();</script>" : ""?>
                        <div class="catalog-table__title"><?=$field['NAME']?><small>:</small></div>
                           <div class="catalog-table__content">
								<p class="catalog-table__desc"><?=mb_strimwidth($item['PROPERTIES'][$field['CODE']]["VALUE"], 0, 12, "...");?></p>
                        </div>
					</div>
            
			<?}
		}?>
				<?if($arResult['AMOUN_ALLOWED'])
				{
					?>
					<div class="catalog-table__column catalog-table__column--state">
                           <div class="catalog-table__title">Наличие<small>:</small></div>
                           <div class="catalog-table__content">
							<?if($item['STORE'][$DEFAULT_STORE_ID]['AMOUNT'])
							{?>
								<p class="catalog-table__state"><i class="simple-state-yes-icon catalog-table__available"></i><?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?> уп.</p>
							<?}else{?>
								<p class="catalog-table__state catalog-table__state--notafs">Под заказ</p>
							<?}?>
                           </div>
                    </div>
				<?}?>
					
					<div class="catalog-table__column catalog-table__column--to-cart">
                           <div class="catalog-table__title">Цена (с НДС)<small>:</small></div>
                           <div class="catalog-table__content catalog-table__content--to-cart">
                              <!--price-in-table-->
                              <div class="price-in-table">
                                 <p class="price-in-table__actual"><?=number_format($price, 2, '.', ' ');?> ₽</p>
								 <?if($old_price){?>
								 <p class="price-in-table__legacy"><?=number_format($old_price, 2, '.', ' ');?> ₽</p>
								 <?}?>
								 <?if($item['PRICE_FOR_ONE']){?>
                                 <p class="price-in-table__units"><?=$item['PRICE_FOR_ONE']?> ₽ за <?=$item['UNIT']?></p>
								 <?}?>
                              </div>
                              <!--price-in-table-->
							  <input type="hidden" name="quantity-hidden" data-quantity="<?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?>" onchange='ChangeInputCart("<?=$item['NAME']?>", $(this))' id="QUANTITY_<?=$item['ID']?>" value="1" class="value__input">
                              <button class="catalog-table__to-cart" onmousedown="try { rrApi.addToBasket(<?=$item['ID']?>) } catch(e) {}" data-product="<?=$item['ID']?>" data-quantity="<?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>"><i class="colored-cart-icon catalog-table__cart" data-product="<?=$item['ID']?>" data-quantity="<?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>"></i>Добавить в корзину</button>
                           </div>
                    </div>
            
	   
	
                                                        
		</section>
        <!--catalog-table-->
		</div>
			
<?php
		$arProductsID .= '"'.$item['ID'].'",';
        }
    }
?>

					
    
</div>
</div>


		<!-- pagination-container -->
		<?=$arResult['NAV_STRING']?>
		<!-- pagination-container -->
<?php echo htmlspecialchars_decode($arParams['SECTIONS_LIST_TEMPLATE']);?>
<?

if($arResult["UF_RELATED"]){
	?><div class='basic-layout__module page-heading'><h2>Связанные позиции</h2></div><?
	$arFilter_soput = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], "SECTION_ID"=>$arResult["UF_RELATED"]);
	foreach($arResult['UF_SOPUT_PROPERTY'] as $soput_property)
	{
		$arProp = explode('=>', $soput_property);
		$arFilter_soput[$arProp[0]] = $arProp[1];
	}
	$intSectionID = $APPLICATION->IncludeComponent(
					"bitrix:catalog.section",
					'level3_vertical',
					array(
						"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"ELEMENT_SORT_FIELD" => "SORT",
						"FOR_SEO"=>'Y',
						"ELEMENT_SORT_ORDER" => 'asc',
						"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD"],
						"ELEMENT_SORT_ORDER2" => 'asc',
						"ELEMENT_SORT_FIELD3" => $arParams["ELEMENT_SORT_FIELD2"],
						"ELEMENT_SORT_ORDER3" => 'asc',
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
						"FILTER_NAME" => 'arFilter_soput',
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
						"PAGE_ELEMENT_COUNT" => $_GET['SIZEN_1'] ? $_GET['SIZEN_1'] : PAGE_ELEMENT_COUNT_NEW[0],
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
						"USE_FILTER"=>"Y",
						"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
						"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
						"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
						"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
						"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

						"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
						"DISPLAY_BOTTOM_PAGER" => 'N',
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
						'SECTIONS_LIST_TEMPLATE'=>(isset($arParams['SECTIONS_LIST_TEMPLATE']) ? $arParams['SECTIONS_LIST_TEMPLATE'] : ''),
						'SET_SORT_MAIN'=> $arResult['SECTION']['UF_SET_SORT_MAIN'] ?? '0',
						'REFERENCE'=>$arResult['REFERENCE']['ITEM'],
						'HIDE_NOT_AVAILABLE'=>$request['available'],


		
					)
					
				);
			
?>
<div class="catalog-feed__other">
<?
$arFilter = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], "ID"=>$arResult["UF_RELATED"], false, array("*"));
$db_list = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, true);
while($arSection = $db_list->GetNext()) {
    $renderImage = CFile::ResizeImageGet($arSection["PICTURE"], Array("width" => 72, "height" => 72), BX_RESIZE_IMAGE_EXACT, false); 
    ?>
		<div class="catalog-feed__child">
                     <!--category-card-->
                     <div class="category-card">
                        <p class="category-card__title"><a class="category-card__link" href="<?=$arSection['SECTION_PAGE_URL']?>" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($arSection['NAME']))?>')"><?=$arSection['NAME']?></a></p>
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
<?

if(!$_POST['ENUM_LIST']['ELEMENTS'] && !$arParams["DISABLE_HEADER"]=='Y')
{
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

<?if(count($arResult["UF_SURFACE"])):?>

<div class="blue-block">Типы оснований</div>
<div class="surface-block-container">
<?foreach($arResult["UF_SURFACE"] AS $surface):?>
<div class="surface-block">
<div class="surface-inblock">
<div class="surface-image" style="background: url(<?=$surface["IMG"]?>) no-repeat;"></div>
<div class="surface-name"><span><?=$surface["NAME"]?></span></div>
</div>
</div>
<?endforeach?>
</div>
<?endif?>

<?if($arResult['UF_DETAIL_TEXT'] && !($_REQUEST['PAGEN_1'] > 1)  && ($_SERVER['HTTP_HOST']=='krep-komp.ru') && empty($arParams['REFERENCE']['DETAIL_TEXT'])):?>
<!--simple-article-->
            <div class="basic-layout__module simple-article">
               <div class="simple-article__content wysiwyg-block">
			   <?=html_entity_decode($arResult['UF_DETAIL_TEXT'], ENT_QUOTES, "UTF-8");?>
			   </div>
            </div>
            <!--simple-article-->
<?endif;?>
<?}?>
<script>
BX.ready(function () {
    var buyBtnDetail = document.body.querySelectorAll('.basket-btn');
	var IDs=[];
	var sum=0;
    for (var i = 0; i < buyBtnDetail.length; i++) {
     
		
	IDs.push(buyBtnDetail[i].dataset.product);
	sum =  sum+Number(buyBtnDetail[i].dataset.price);
		
    
    }
	
	
	
	console.log(IDs);
	console.log(sum);
	
});
</script>

<?global $userEmail;?>
<!-- Criteo Category / Listing dataLayer -->
<script type='text/javascript'>
        var dataLayer = dataLayer || [];
        dataLayer.push({            
            'event': 'crto_listingpage',
            crto: {             
                'email': '<?=$userEmail?>', //может быть пустой строкой
                'products': [<?=$arProductsID?>]
            }
        });
</script>
<!-- END Criteo Category / Listing dataLayer -->

<?php
if(!empty($arResult["EGOR_SCRIPT_AR"]))
{
    ?>
    <script type="application/ld+json">
        <?=json_encode($arResult["EGOR_SCRIPT_AR"], JSON_UNESCAPED_UNICODE);?>
    </script>
    <?php
}
?>

