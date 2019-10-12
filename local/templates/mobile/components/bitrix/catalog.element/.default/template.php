<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$price = $arResult['PRICES'][ID_SALE_PRICE]['VALUE'] ? $arResult['PRICES'][ID_SALE_PRICE]['VALUE'] : $arResult['PRICES'][ID_BASE_PRICE]['VALUE'];
$old_price = $arResult['PRICES'][ID_SALE_PRICE]['VALUE'] ? $arResult['PRICES'][ID_BASE_PRICE]['VALUE'] : 0;

?>


<h1 class="s28-title"><?=$arResult['NAME']?></h1>
    <div class="card">
	<div class="card__articul">Артикул: <span class="card__articul-name"><?=$arResult['PROPERTIES']['CML2_ARTICLE']['VALUE']?></span></div>
	<div class="card__top">
	    <div class="card__photo"><a href="<?=$arResult['DETAIL_PICTURE']['SRC'];?>" rel="gallery_card" class="card__photo-link"><img src="<?=$arResult['PREVIEW_PICTURE']['src'];?>" alt=""></a></div>
	    <div class="card-small-info">
		<div class="card__price">
		    <div class="card__price-wrap">
			<div class="card__price-first"><?echo number_format($price, 2, '.', ' ');?> ₽</div>
                        <?if($old_price){?>
			<div class="card__price-last"><?echo number_format($old_price, 2, '.', ' ');?> ₽</div>
                        <?}?>
		    </div>
		    <a href="javascript:void(0)" data-product="<?=$arResult['ID']?>" data-name="<?=$arResult['NAME']?>" data-price="<?=$price?>" data-quantity='1' class="blue-btn card__btn">Добавить в корзину</a>
		</div>
		<ul class="basket-info__items">
		    <li class="basket-info__item basket-info--car"><span>Доставка</span><i></i><strong>от 250 руб.<?echo ($arResult['ELEMENT_COUNT']) ? ' сегодня' : '';?></strong></li>
		    <li class="basket-info__item basket-info--nal"><span>Наличие</span><i></i><strong class="baskey-info__green"><?=$arResult['ELEMENT_COUNT']?> шт.</strong></li>
		    <li class="basket-info__item basket-info--home"><span>Самовывоз</span><i></i><strong><?echo ($arResult['ELEMENT_COUNT']) ? ' сегодня бесплатно' : 'на заказ';?></strong></li>
		</ul>
		
	    </div>
	</div>
	<div class="card__middle">
	    <div class="card-tabs">
		<ul class="card-tabs__items">
		    <li data-tab="tab-1" class="card-tabs__item active">Описание</li>
		    <li data-tab="tab-2" class="card-tabs__item">Сертификаты</li>
		    <li data-tab="tab-3" class="card-tabs__item">Способы оплаты</li>
		    <li data-tab="tab-4" class="card-tabs__item">Доставка</li>
		    <li data-tab="tab-5" class="card-tabs__item">Самовывоз</li>
		</ul>
	    <div id="tab-1" class="card__tabs-list active">
	    <?=html_entity_decode($arResult['DETAIL_DESCRIPTION'], ENT_QUOTES, "UTF-8");?>
		<h2 id='chars' class="s28-title">Характеристики</h2>
		<div class="info__items-wrap">
		    <ul class="basket-info__items">
                    <?foreach($arResult['BASE_PROPERTIES_UL1'] as $arProp){?>
			<li class="basket-info__item"><span><?=$arProp['NAME']?></span><i></i><strong><?=$arProp['VALUE']?></strong></li>
		    <?}?>
                    </ul>
		    <ul class="basket-info__items">
		    <?foreach($arResult['BASE_PROPERTIES_UL2'] as $arProp){?>
			<li class="basket-info__item"><span><?=$arProp['NAME']?></span><i></i><strong><?=$arProp['VALUE']?></strong></li>
		    <?}?>
		    </ul>
		</div>
                <?if(isset($arResult['FILTER_ARTICL'])){?>
		<h2 class="s28-title">Варианты упаковки</h2>
		<?$APPLICATION->IncludeComponent(
	    "bitrix:catalog.section", 
	    "level3", 
	    array(
		"COMPONENT_TEMPLATE" => "level3",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => $arParams['IBLOCK_ID'],
		"SECTION_ID" => $ar_result['ID'],
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "Filter",
		"INCLUDE_SUBSECTIONS" => "A",
		"SHOW_ALL_WO_SECTION" => "N",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBProp:5:66\",\"DATA\":{\"logic\":\"Contain\",\"value\":\"".$arResult['FILTER_ARTICL']."\"}}]}",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"ELEMENT_SORT_FIELD" => "rand",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"PAGE_ELEMENT_COUNT" => "3",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array("TSVET","CML2_ARTICLE","KOLICHESTVO_V_UPAKOVKE",""),
		"OFFERS_LIMIT" => "5",
		"BACKGROUND_IMAGE" => "-",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"SET_LAST_MODIFIED" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_FILTER" => "N",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRICE_CODE" => $arParams['PRICE_CODE'],
		"USE_PRICE_COUNT" => $arParams['USE_PRICE_COUNT'],
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => $arParams['PRICE_VAT_INCLUDE'],
		"CONVERT_CURRENCY" => $arParams['CONVERT_CURRENCY'],
		"BASKET_URL" => "/personal/basket.php",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"DISPLAY_COMPARE" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"COMPATIBLE_MODE" => "Y",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"CURRENCY_ID" => "RUB",
		"PROPERTY_CODE_MOBILE" => "",
		"TEMPLATE_THEME" => "blue",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"ENLARGE_PRODUCT" => "STRICT",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"SHOW_SLIDER" => "Y",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => "",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"RCM_TYPE" => "personal",
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"SHOW_FROM_SECTION" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"LAZY_LOAD" => "N",
		"LOAD_ON_SCROLL" => "N",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_CART_PROPERTIES" => ""
	),
	false
);
}?>
	    </div>
	    <div id="tab-2" class="card__tabs-list">
		<div class="carousel-certeficate">
		    <ul class="carousel-certeficate__items">
                        <?foreach($arResult['CERT_PICTURE'] as $cert){?>
                        <li class="carousel-certeficate__item">
			    <a href="<?=$cert['BIG_PIC']?>" rel="gallery_img" class="nav-certificate__link"><img src="<?=$cert['src']?>" alt=""></a>
			</li>
                        <?}?>
                    </ul>
		</div>
	    </div>
	    <? include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/var_payment.php"); ?>
	    <? include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php"); ?>
	    <div id="tab-5" class="card__tabs-list">
		<h2 class="s22-title">Самовывоз бесплатно</h2>
		<div class="card-maps">
		    <div class="card-maps__adress">
			<ul class="adress__items">
			    <li class="adress__item">
				<div class="adress__number">1</div>
				<div class="adress__info">
				    <p><?=STORE_ID_KASHIRKA[1]?><br> <?=STORE_ID_KASHIRKA[2]?></p>
				    <div class="adress__pres">Наличие <?echo ($arResult['STORE'][STORE_ID_KASHIRKA[0]]['AMOUNT']) ? '<div class="adress__pres--yes"> '.$arResult['STORE'][STORE_ID_KASHIRKA[0]]['AMOUNT'].'  шт.</div>' : '<div class="adress__pres--no">Нет в наличии</div>';?></div>
				    <div class="adress__link" data-tab="map1">Показать на карте</div>
				</div>
			    </li>
			    <li class="adress__item">
				<div class="adress__number">2</div>
				<div class="adress__info">
				    <p><?=STORE_ID_KOLEDINO[1]?><br> <?=STORE_ID_KOLEDINO[2]?></p>
				    <div class="adress__pres">Наличие <?echo ($arResult['STORE'][STORE_ID_KOLEDINO[0]]['AMOUNT']) ? '<div class="adress__pres--yes"> '.$arResult['STORE'][STORE_ID_KOLEDINO[0]]['AMOUNT'].'  шт.</div>' : '<div class="adress__pres--no">Нет в наличии</div>';?></div>
				    <div class="adress__link" data-tab="map2">Показать на карте</div>
				</div>
			    </li>
			</ul>
		    </div>
		    <div class="card-maps__location">
			<div class="map-location active" id="map1" style="position: relative; overflow: hidden;"></div>
			<div class="map-location" id="map2" style="position: relative; overflow: hidden;"></div>
		    </div>
		</div>
	    </div>
	</div>
        </div>
        <?if($arResult["RELATED"]){?>
	<h2 class="s22-title">Сопутствующие товары</h2>
	<ul class="card-nav-product">
            <?
            $arFilter = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], "ID"=>$arResult["RELATED"], false, array("*"));
            $db_list = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, true);
            while($arSection = $db_list->GetNext()) {
            $renderImage = CFile::ResizeImageGet($arSection["PICTURE"], Array("width" => 72, "height" => 72), BX_RESIZE_IMAGE_EXACT, false); 
            ?>
	    <li class="card-nav-product__item">
		<a href="<?=$arSection['SECTION_PAGE_URL']?>" class="card-nav-product__link">
		    <div class="card-nav-img"><img src="<?=$renderImage['src']?>" alt=""></div>
		    <div class="card-nav-text"><?=$arSection['NAME']?></div>
		</a>
	    </li>
            <?}?>
	</ul>
        <?$this->SetViewTarget("related_menu_element");?>
            <nav class="nav-aside nav-aside--yellow">
		<strong class="nav-aside__title">Рекомендуемые разделы</strong>
		    <ul class="nav-aside__items">
                        <?
                        $db_list = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, true);
                        while($arSection = $db_list->GetNext()) {?>
			<li class="nav-aside__item"><a href="<?=$arSection['SECTION_PAGE_URL']?>" class="nav-aside__link"><?=$arSection['NAME']?></a></li>
                        <?}?>
					
		    </ul>
	    </nav>
        <?$this->EndViewTarget();?>
        <?}?>
    </div>

