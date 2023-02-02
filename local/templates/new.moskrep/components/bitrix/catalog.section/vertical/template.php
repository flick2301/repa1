<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */
global $APPLICATION;
global $DEFAULT_STORE_ID;
global $arFilter_soput;

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
       
?>
<?include($_SERVER["DOCUMENT_ROOT"]."/include/array_rals.php");?>
<?$ral_in_ar = $arResult['ITEMS'][0]['PROPERTIES']["TSVET"]["VALUE"];?>

<?if(!$_POST['ENUM_LIST']['ELEMENTS'] && !$arParams["DISABLE_HEADER"]=='Y'){?>
<?
if(empty($APPLICATION->GetPageProperty('title')))
	$APPLICATION->SetPageProperty('title', $arResult["NAME"].", цена - купить в интернет-магазине в Москве");?>

<?if(count($arResult['RELINK'])):?>
<?php $this->SetViewTarget('RELINK'); ?>
<!--see-also-widget-->
	<div class="basic-layout__module see-also-widget">
               <h4 class="see-also-widget__title">Сопутствующие товары:</h4>
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
<?php
//Параметр FOR_SEO устанавливается если это раздел справочника, а не каталога
//А значит текст и заголовок(шапка) не берутся из каталога, а из справочника, значит условие FOR_SEO != Y
if($arParams['FOR_SEO']!='Y'){?>

<?globalGetTitle($arResult['META_TITLE'] ? $arResult['META_TITLE'] : $arResult['NAME'])?>


<?if($arResult['DESCRIPTION']):?>
<!--catalog-desc-->
            <div class="basic-layout__module catalog-desc">
               <div class="catalog-desc__cover">
                  <img class="catalog-desc__image" src="<?=$arResult['PICTURE']['SRC']?>" width="226" height="170" alt="<?=$arResult['NAME']?>">
               </div>
               <p class="catalog-desc__about"><?=html_entity_decode($arResult['DESCRIPTION'], ENT_QUOTES, "UTF-8");?></p>
            </div>
<!--catalog-desc-->
<?endif;?>
<?}
	?>

<?}?>
<?
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
?>



<div id="shops-window"><div class="win"></div></div>
<div class="page_count_panel">

<div class="page_count_panel_viewblock">Показано <?=count($arResult['ITEMS'])?> из <?=$arResult['NAV_RESULT']->NavRecordCount?> товаров</div>



<div class="page_count_panel_block">

<a id="view_available" href="javascript:void(0);" rel="nofollow" class="blue-btn page_count_panel_viewblock_btn"><?=($request['available']=='Y') ?  'Все позиции' : 'В наличии';?></a>
<a id="view_wholesale" href="javascript:void(0);" rel="nofollow" class="blue-btn page_count_panel_viewblock_btn">Оптовые скидки</a>


<select name="page_element_count" id="page_element_count">
	<?foreach(PAGE_ELEMENT_COUNT_NEW as $page_element_count)
	{?>
          <option value="<?=$page_element_count?>" <?=($arParams['PAGE_ELEMENT_COUNT'] == $page_element_count) ? 'selected="selected"' : '';?>>Показывать: по <?=$page_element_count?></option>
	<?}?>
</select>
    <?if($arParams["SELECT_PAGE_TEMPLATE"]!="Y"){?>
        <select name="select_template" id="select_template">
            <option value="horizontal_new">Элементы: Таблицей</option>
            <option value="vertical" selected="selected">Элементы: Блоками</option>
        </select>
    <?}?>
</div>
</div>





    <!--catalog-feed-->
    <div class="basic-layout__module catalog-feed">

		<div class="product__list">
	<?
	
    foreach ($arResult['ITEMS'] as $key => $item)
    {
		if($key == 12)
		{
			?><div data-retailrocket-markup-block="63591b951e039327291149d8" data-category-id="<?=$arResult['ID'];?>"></div><?
		}
        
        $price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_SALE_PRICE]['VALUE'] : $item['MIN_PRICE']['VALUE'] ? $item['MIN_PRICE']['VALUE'] : $item['PRICES'][ID_BASE_PRICE]['VALUE'];
        $old_price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_BASE_PRICE]['VALUE'] : 0;
        
        $ar_size = array(
            $item['PROPERTIES']["DIAMETR"]["VALUE"],
            $item['PROPERTIES']["VYSOTA"]["VALUE"],
            $item['PROPERTIES']["SHIRINA"]["VALUE"],
            $item['PROPERTIES']["DLINA"]["VALUE"],
        );
        $size = array_diff($ar_size, ['']);
?>


				


			<div class="product__box">
                     <!--product-card-->
                <div class="product__top">
                    <div class="product__topside">
                        <div class="product__article">Артикул <span><?=$item['PROPERTIES']["CML2_ARTICLE"]["VALUE"]?></span></div>
                        <div class="product__deliveries">
                            <div class="product__delivery card_pickup" data-product="<?=$item['ID']?>">
                                <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 2.453 1.812 5.032l-.312.14V13.5h13V5.172l-.313-.14L8 2.453Zm0 1.094 5.5 2.296V12.5h-1V7h-9v5.5h-1V5.843L8 3.547ZM4.5 8h7v4.5h-7V8Z"></path>
                                </svg>
                                <div class="product__date">Самовывоз: <span><?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT'] ? "Сегодня" : "Под заказ";?></span></div>
                            </div>
                            <div class="product__delivery  card_delivery"  data-product="<?=$item['ID']?>">
                                <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m14.96 8.305-1.5-3.5A.5.5 0 0 0 13 4.5h-1.5v-1A.5.5 0 0 0 11 3H1.5a.5.5 0 0 0-.5.5V12a.5.5 0 0 0 .5.5h1.07a2 2 0 0 0 3.86 0h3.14a2 2 0 0 0 3.86 0h1.07a.5.5 0 0 0 .5-.5V8.5a.499.499 0 0 0-.04-.195ZM11.5 5.5h1.17L13.74 8H11.5V5.5Zm-7 7.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm5.07-1.5H6.43a2 2 0 0 0-3.86 0H2V4h8.5v6.28a1.999 1.999 0 0 0-.93 1.22ZM11.5 13a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm2.5-1.5h-.57A2 2 0 0 0 11.5 10V9H14v2.5Z"></path>
                                </svg>
                                <div class="product__date">Доставка: <span><?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT'] ? "Завтра" : "Под заказ";?></span></div>
                            </div>
                        </div>
                    </div>
                    <a class="product__link" href="<?=$item['DETAIL_PAGE_URL']?>">
                        <img class="product__images" src="<?=$item['PREVIEW_PICTURE']['src']?>" alt="<?=$item['NAME']?>" title="<?=$item['NAME']?>">
                    </a>
                    <a class="product__name" href="<?=$item['DETAIL_PAGE_URL']?>"><?=$item['NAME']?></a>

 					</div>

				<div class="product__bottom">
					<?if(($item['PROPERTIES']["DIAMETR"]["VALUE"] && $item['PROPERTIES']["DLINA"]["VALUE"]) || !empty($item['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE']))
					{?>
                    <div class="product__params">
                    <?if($item['PROPERTIES']["DIAMETR"]["VALUE"] && $item['PROPERTIES']["DLINA"]["VALUE"]):?>
                        <div class="product__param">Размер(мм): <span><?=$item['PROPERTIES']["DIAMETR"]["VALUE"]?>x<?=$item['PROPERTIES']["DLINA"]["VALUE"]?></span></div>
                    <?endif;?>
                    <?if($item['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE']):?>
                        <div class="product__param">Фасовка: <span><?=$item['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE']?> <?=$item['UNIT']?></span></div>
                    <?endif;?>
                    </div>
					<?}?>
                    <?if($item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']):?>
                        <div class="product__availible">
                            <span>В наличии: <?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?> уп.</span>
                        </div>
                    <?else:?>
                        <div class="product__availible product__availible--unavailible">
                            <span>Товар закончился</span>
                        </div>
                    <?endif;?>




                <div class="product__botside">
                    <div class="product__left">
                        <div class="product__tax">цена (с НДС)</div>
                        <div class="product__price"><?echo number_format($price, 2, '.', ' ');?> р.</div>
                        <div class="product__price product__price--one"><?echo round($price/$item['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE'], 2);?> р. за <?=$item['UNIT']?></div>
                    </div>
                    <div class="product__right">
                        <div data-quantity="<?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?>" onmousedown="try { rrApi.addToBasket(<?=$item['ID']?>) } catch(e) {}" data-product="<?=$item['ID']?>" old-price="<?=$price?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>" class="main-button main-button--mini product-card__button product-card__button_round product__buy" href="javascript:void(0);">
                            <svg viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg" data-quantity="<?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?>" data-product="<?=$item['ID']?>" old-price="<?=$price?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>">
                                <path data-quantity="<?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?>" data-product="<?=$item['ID']?>" old-price="<?=$price?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>" d="M1.957 11.634c0 1.14.806 2.094 1.877 2.325a1.578 1.578 0 0 0 .68 2.998 1.576 1.576 0 0 0 .781-2.944h6.287a1.576 1.576 0 1 0 1.563 0h1.18a.595.595 0 0 0 0-1.19h-9.99a1.19 1.19 0 0 1-1.189-1.189v-.885c.35.203.757.32 1.19.32h8.027c1.252 0 2.502-.943 2.846-2.147l1.472-5.153a.594.594 0 0 0-.571-.758H3.146v-.565A2.381 2.381 0 0 0 .768.067a.595.595 0 0 0 0 1.19c.656 0 1.19.533 1.19 1.189v9.188Zm10.406 4.133a.387.387 0 1 1 .002-.774.387.387 0 0 1-.002.774Zm-7.849 0a.387.387 0 1 1 .001-.774.387.387 0 0 1 0 .774Zm9.552-7.171c-.196.684-.991 1.284-1.703 1.284H4.336a1.19 1.19 0 0 1-1.19-1.19V4.2h12.175l-1.255 4.396Z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
</div>


					 

						   

                     <!--product-card-->
            </div>
          

                                                   
						
			
			<?
		}
		?>
		<?if($arResult['NAV_RESULT']->NavRecordCount<12)
		{
			?><div data-retailrocket-markup-block="63591b951e039327291149d8" data-category-id="<?=$arResult['ID'];?>"></div><?
		}?>
		</div>

					
	</div>
<!--catalog-feed-->
<?
if ($showBottomPager)
{
	?>
	
		<!-- pagination-container -->
		<?=$arResult['NAV_STRING']?>
		<!-- pagination-container -->
	
	<?
}
?>
<?php echo htmlspecialchars_decode($arParams['SECTIONS_LIST_TEMPLATE']);?>
<?if(!$arParams["DISABLE_HEADER"]=='Y'){?>
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
<?if($arResult['UF_DETAIL_TEXT'] && !($_REQUEST['PAGEN_1'] > 1)  && ($_SERVER['HTTP_HOST']=='krep-komp.ru') && empty($arParams['REFERENCE']['DETAIL_TEXT'])):?>
<!--simple-article-->
            <div class="basic-layout__module simple-article">
               <div class="simple-article__content wysiwyg-block">
			   <?=html_entity_decode($arResult['UF_DETAIL_TEXT'], ENT_QUOTES, "UTF-8");?>
			   </div>
            </div>
<!--simple-article-->
<?endif;?>

<br>
<br>
<?}?>
<?if($arResult['UF_INCLUDE_FILE_AFTER_DESC'])
{
	$APPLICATION->IncludeFile(SITE_DIR."/include/".$arResult['UF_INCLUDE_FILE_AFTER_DESC'], array("SHOW_BORDER" => true, "MODE"=>"html"));
}
?>

<?
//НУЖНО ВСТАВИТЬ КАЛЬКУЛЯТОР ДЛЯ ХИМ. КАРТРИДЖЕЙ
if($arResult['ORIGINAL_PARAMETERS']['SECTION_CODE']=='kartridzh')
    $APPLICATION->IncludeFile(SITE_DIR."/include/calculator.php", array("SHOW_BORDER" => true, "MODE"=>"html"));
?>

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

