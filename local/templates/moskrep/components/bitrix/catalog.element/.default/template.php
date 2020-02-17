<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $APPLICATION;

$ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues($arParams["IBLOCK_ID"],$arResult['SECTION']['ID']);
    $IPROPERTY  = $ipropValues->getValues();
    
    $APPLICATION->SetPageProperty('title', $IPROPERTY['ELEMENT_META_TITLE']);
    $APPLICATION->SetPageProperty('description', $IPROPERTY['ELEMENT_META_DESCRIPTION']);
    $APPLICATION->SetPageProperty('keywords', $IPROPERTY['ELEMENT_META_KEYWORDS']);


$price = $arResult['PRICES'][ID_SALE_PRICE]['VALUE'] ? $arResult['PRICES'][ID_SALE_PRICE]['VALUE'] : $arResult['MIN_PRICE']['VALUE'];
$old_price = $arResult['PRICES'][ID_SALE_PRICE]['VALUE'] ? $arResult['PRICES'][ID_BASE_PRICE]['VALUE'] : 0;

?>
<?if(count($arResult['RELINK'])):?>
    <?php $this->SetViewTarget('RELINK'); ?>
    <nav class="nav-aside">
        <strong class="nav-aside__title">Смотрите также:</strong>
        <ul class="nav-aside__items">

            <?foreach($arResult['RELINK'] as $relink):?>

                <li class="nav-aside__item"><a href="<?=$relink['AKCEPTOR']?>" title="" class="nav-aside__link"><?=$relink['ANKOR']?></a></li>

            <?endforeach;?>
        </ul>
    </nav>
    <?php $this->EndViewTarget(); ?>
<?endif;?>


    <div itemscope itemtype="http://schema.org/Product" class="card">
        <div style='display:none;'>
            <?if($USER->IsAuthorized()):?>
            <div class='card-price-dop'><b><?=$arResult["DOP_PRICE"][0]?> ₽</b> при заказе от 20 000 руб.</div><br>
            <div class='card-price-dop'><b><?=$arResult["DOP_PRICE"][1]?> ₽</b> при заказе от 100 000 руб.</div><br>
            <div class='card-price-dop'><b><?=$arResult["DOP_PRICE"][2]?> ₽</b> при заказе от 500 000 руб.</div>
            <?endif;?>
        </div>
        <h1 itemprop="name" class="s38-title"><?=$arResult['NAME']?></h1><br>
	<div class="card__articul">Артикул: <span class="card__articul-name"><?=$arResult['PROPERTIES']['CML2_ARTICLE']['VALUE']?></span></div>
	<div class="card__top">
	    <div class="card__photo"><a href="<?=$arResult['DETAIL_PICTURE']['SRC'];?>" onclick="javascript:void();" rel="gallery_card" title='<? echo ($arResult["IPROPERTY_VALUES"]['ELEMENT_DETAIL_PICTURE_FILE_TITLE'] ? $arResult["IPROPERTY_VALUES"]['ELEMENT_DETAIL_PICTURE_FILE_TITLE'] : "Moskrep.ru - ".$arResult["SECTION"]["NAME"]." ".$arResult["NAME"].", купить в интернет-магазине - цена, фото");?>' class="card__photo-link"><img itemprop="image" src="<?=$arResult['PREVIEW_PICTURE']['src'];?>" alt="<?=$arResult['NAME']?>"></a></div>
	    <div class="card-small-info">
		<div class="card__price">
		    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="card__price-wrap">
                        <div class="card__price-first">
                            <meta  itemprop="price" content='<?echo number_format($price, 2, '.', ' ');?>'>
                            <meta itemprop="priceCurrency" content='RUB'>
                            <?echo number_format($price, 2, '.', ' ');?> ₽</div>
                        <?if($old_price){?>
			<div class="card__price-last"><?echo number_format($old_price, 2, '.', ' ');?> ₽</div>
                        <?}?>
		    </div>
                    <?if($USER->IsAuthorized()):?>
                    <br>
            <div class='card-price-dop'><b><?=$arResult["DOP_PRICE"][0]?> ₽</b> при заказе от 20000 ₽</div><br>
            <div class='card-price-dop'><b><?=$arResult["DOP_PRICE"][1]?> ₽</b> при заказе от 100000 ₽</div><br>
            <div class='card-price-dop'><b><?=$arResult["DOP_PRICE"][2]?> ₽</b> при заказе от 500000 ₽</div><br>
			<div class='card-price-dop'><b><?=$arResult["DOP_PRICE"][3]?> ₽</b> при заказе от 5000000 ₽</div>
            <?endif;?>
		    <a href="javascript:void(0)" id='main_link' data-product="<?=$arResult['ID']?>" data-name="<?=$arResult['NAME']?>" data-price="<?=$price?>" data-quantity='1' rel="nofollow" class="blue-btn card__btn">Добавить в корзину</a>
		</div>
		<ul class="basket-info__items">
		    <li class="basket-info__item basket-info--car"><span>Доставка</span><i></i><strong>от 290 руб.</strong></li>
		    <li class="basket-info__item basket-info--nal"><span>Наличие</span><i></i><strong class="baskey-info<?=($arResult['ELEMENT_COUNT']) ? '__green': '';?>"><?=($arResult['ELEMENT_COUNT']) ?  $arResult['ELEMENT_COUNT'].' уп.' : 'нет (<a href="#packs" class="card__link-dashed_packs">другие упаковки</a>)';?></strong></li>
		    <li class="basket-info__item basket-info--home"><span>Самовывоз</span><i></i><strong><?echo ($arResult['ELEMENT_COUNT']) ? ' сегодня, бесплатно' : 'на заказ';?></strong></li>
		</ul>
		<a href="#over"  rel="nofollow" target="_self" data-tab="tab-5" class="card__link-dashed_over">Адреса магазинов</a>
		    <?if(count($arResult['BASE_PROPERTIES_HEAD'])):?>
                    
                    <ul class="basket-info__items card__pos">
                    <?foreach($arResult['BASE_PROPERTIES_HEAD'] as $arProp){?>
                        
                            <li class="basket-info__item"><span><?=$arProp['NAME']?></span><i></i><strong><?=$arProp['VALUE']?></strong></li>
                       
		    <?}?>
		    </ul>
		    <a href="#chars" rel="nofollow" data-tab="tab-1" class="card__link-dashed">Все характеристики</a>
                    <?endif;?>
	    </div>
	</div>
	<div class="card__middle">
	    <div class="card-tabs">
		<ul class="card-tabs__items">
		    <li data-tab="tab-1" class="card-tabs__item active">Описание</li>
                    <?if(count($arResult['CERT_PICTURE'])):?>
		    <li data-tab="tab-2" class="card-tabs__item">Сертификаты</li>
                    <?endif;?>
		    <li data-tab="tab-3" class="card-tabs__item">Способы оплаты</li>
		    <li data-tab="tab-4" class="card-tabs__item">Доставка</li>
		    <li data-tab="tab-5" class="card-tabs__item">Самовывоз</li>
                    <li data-tab="tab-6" class="card-tabs__item" style="color:#01B10E">Ваши скидки</li>
		</ul>
	    <div id="tab-1" class="card__tabs-list active">
		<?if(count($arResult['BASE_PROPERTIES_HEAD'])):?>
                <h2 id='chars' class="s28-title">Характеристики</h2>
		<div class="info__items-wrap">
		    <ul class="basket-info__items">
                    <?foreach($arResult['BASE_PROPERTIES_UL1'] as $arProp){?>
                       
                            <li class="basket-info__item"><span><?=$arProp['NAME']?></span><i></i><strong><?=$arProp['VALUE']?></strong></li>
                        
                    <?}?>
                    
		    <?foreach($arResult['BASE_PROPERTIES_UL2'] as $arProp){?>
                        
                            <li class="basket-info__item"><span><?=$arProp['NAME']?></span><i></i><strong><?=$arProp['VALUE']?></strong></li>
                        
                    <?}?>
		    </ul>
		</div>
                <?endif;?>         
		 <div class='delivery__text  set-default-parametr-page-cat' itemprop="description"><?=($arResult['DETAIL_DESCRIPTION']) ? html_entity_decode($arResult['DETAIL_DESCRIPTION'], ENT_QUOTES, "UTF-8") : $arResult['NAME'];?></div>
		
                
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
                <div id="tab-6" class="card__tabs-list set-default-parametr-page-cat">
                        <p class='info-paragraph'>KREP-KOMP - ведущий поставщик и производитель строительного крепежа для розничных, мелкооптовых и оптовых клиентов. С 2005 года мы предлагаем самый широкий ассортимент, доступные цены и гибкую систему скидок.</p>
<p class='info-paragraph'>Доставка по Москве в пределах МКАД при заказе от 50000 руб. <b>БЕСПЛАТНО</b></p>
<p class='info-paragraph'>Оптовые и накопительные скидки:</p>

<table class='skid' >
	<tr >
		<td><b>5%</b></td>
		<td >от 20 000 руб</td>
	</tr>
	<tr >
		<td ><b>10%</b></td>
		<td >от 100 000 руб</td>
	</tr>
	<tr>
		<td ><b>13%</b></td>
		<td >от 500 000 руб</td>
	</tr>
        <tr>
		<td ><b>18%</b></td>
		<td >от 1 000 000 руб<br>* скидка предоставляется при условии выполнения ежеквартальных закупкок на сумму от 5 000 000 руб.</td>
	</tr>
</table>

<p class='info-paragraph'>Оформите заказ на сайте, и менеджер пересчитает его стоимость с учётом вашей скидки.</p>
                    </div>
	    <? include($_SERVER["DOCUMENT_ROOT"]."/kontent-elementa/var_payment.php"); ?>
            
	    <? include($_SERVER["DOCUMENT_ROOT"]."/kontent-elementa/delivery.php"); ?>
            
	    <div id="tab-5" class="card__tabs-list">
		<h2 id='over' class="s28-title">Самовывоз бесплатно</h2>
                <ul class='vivoz_items'>
	<li data-tab='vivoz_1' class='vivoz_item active'>Москва и МО</li>
	<li data-tab='vivoz_2' class='vivoz_item spb'>Санкт-Петербург</li>
        

</ul>
		<div class="card-maps">
		    <div class="card-maps__adress">
			<ul class="adress__items">
			    
                           <div id='vivoz_2' class='vivoz__tabs-list spb'>
                               
                            <li class="adress__item">
				<div class="adress__number">SP1</div>
				<div class="adress__info">
                                    <p>Санкт-Петербург, улица Магнитогорская 21<br>Пн - Пт: c 09:00 до 18:00; Сб: 10:00-16:00</p>
				    
				    <div class="adress__link" data-tab="sp1">Показать на карте</div>
				</div>
			    </li>
            
                            <p>Забрать груз можно уже на следующий день в точке самовывоза на ул. Магнитогорская. Для этого оформить заказ нужно до 15:00 с понедельника по пятницу. Суббота и Воскресенье - выходные дни. Если получить груз нужно в другом пункте выдачи - получить его можно только через день. Доставка по городу оплачивается дополнительно и включается в счет.</p>
                           </div>
                           <div id='vivoz_1' class='vivoz__tabs-list active'>  
                            <li class="adress__item">
				<div class="adress__number">1</div>
				<div class="adress__info">
				    <p><?echo STORE_ID_KASHIRKA['1'];?><br> <?=STORE_ID_KASHIRKA[2]?></p>
				    <div class="adress__pres">Наличие <?echo ($arResult['STORE'][STORE_ID_KASHIRKA[0]]['AMOUNT']) ? '<div class="adress__pres--yes"> '.$arResult['STORE'][STORE_ID_KASHIRKA[0]]['AMOUNT'].'  уп.</div>' : '<div class="adress__pres--no">Под заказ</div>';?></div>
				    <div class="adress__link" data-tab="map1">Показать на карте</div>
				</div>
			    </li>
                            
			    <li class="adress__item">
				<div class="adress__number">2</div>
				<div class="adress__info">
				    <p><?=STORE_ID_KOLEDINO[1]?><br> <?=STORE_ID_KOLEDINO[2]?></p>
				    <div class="adress__pres">Наличие <?echo ($arResult['STORE'][STORE_ID_KOLEDINO[0]]['AMOUNT']) ? '<div class="adress__pres--yes"> '.$arResult['STORE'][STORE_ID_KOLEDINO[0]]['AMOUNT'].'  уп.</div>' : '<div class="adress__pres--no">Под заказ</div>';?></div>
				    <div class="adress__link" data-tab="map2">Показать на карте</div>
				</div>
			    </li>
                <li class="adress__item">
				<div class="adress__number">3</div>
				<div class="adress__info">
				    <p><?echo STORE_ID_UZHKA['1'];?><br> <?=STORE_ID_UZHKA[2]?></p>
				    <div class="adress__pres">Наличие <?echo ($arResult['STORE'][STORE_ID_UZHKA[0]]['AMOUNT']) ? '<div class="adress__pres--yes"> '.$arResult['STORE'][STORE_ID_UZHKA[0]]['AMOUNT'].'  уп.</div>' : '<div class="adress__pres--no">Под заказ</div>';?></div>
				    <div class="adress__link" data-tab="map4">Показать на карте</div>
				</div>
			    </li>
				<li class="adress__item">
				<div class="adress__number">4</div>
				<div class="adress__info">
				    <p><?echo STORE_ID_SERPUH['1'];?><br> <?=STORE_ID_SERPUH[2]?></p>
				    <div class="adress__pres">Наличие <?echo ($arResult['STORE'][STORE_ID_SERPUH[0]]['AMOUNT']) ? '<div class="adress__pres--yes"> '.$arResult['STORE'][STORE_ID_SERPUH[0]]['AMOUNT'].'  уп.</div>' : '<div class="adress__pres--no">Под заказ</div>';?></div>
				    <div class="adress__link" data-tab="map5">Показать на карте</div>
				</div>
			    </li>
                            <p>Забрать груз в пункте самовывоза на Каширском шоссе можно на следующий день. Для этого оформить заказ нужно до 15:00. 

                                Суббота и Воскресенье - выходные дни.</p>
                           </div>
			</ul>
		    </div>
                    
		    <div class="card-maps__location">
			    <div class="map-location active" id="map1" style="position: relative; overflow: hidden;"><?include($_SERVER["DOCUMENT_ROOT"].'/include/map1.php');?></div>
			    <div class="map-location" id="map2" style="position: relative; overflow: hidden;"><?include($_SERVER["DOCUMENT_ROOT"].'/include/map2.php');?></div>
                <div class="map-location" id="map4" style="position: relative; overflow: hidden;"><?include($_SERVER["DOCUMENT_ROOT"].'/include/map4.php');?></div>
				<div class="map-location" id="map5" style="position: relative; overflow: hidden;"><?include($_SERVER["DOCUMENT_ROOT"].'/include/map5.php');?></div>
                       
                <div class="map-location" id="sp1" style="position: relative; overflow: hidden;"><iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A147a22791efa23d9da2c37679a8d3271b26fe1ce8be56e60f81e518f84136d7d&amp;source=constructor" width="470" height="370" frameborder="0"></iframe></div>
                
                        
            </div>
		</div>
	    </div>
            
            <ul class="variants_items">
                <li data-tab="var_tab_1" class="variants_item active">Варианты упаковки</li>
                <li data-tab="var_tab_2" class="variants_item">С этим товаром смотрят</li>
                
            </ul>
            
            
            <?if(count($arResult['ELEMENT_VARS'])){?>
            <div id='var_tab_1' class='variants__tabs-list'>                
		<?
            global $bbFilter;
            $bbFilter = Array("ID" => $arResult['ELEMENT_VARS']);    
            
            $APPLICATION->IncludeComponent(
	    "bitrix:catalog.section", 
	    "level3", 
	    array(
		"COMPONENT_TEMPLATE" => "level3",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => $arParams['IBLOCK_ID'],
		"SECTION_ID" => $arResult['IBLOCK_SECTION_ID'],
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
                "USE_FILTER" =>"Y",
		"FILTER_NAME" => "bbFilter",
		"INCLUDE_SUBSECTIONS" => "A",
		"SHOW_ALL_WO_SECTION" => "N",
		"CUSTOM_FILTER" => "",
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
            
            <div id='var_tab_2' class='variants__tabs-list'>
		<?
            global $baFilter;
            $baFilter = Array("ID" => $arResult['ELEMENT_NEXT']);    
            
            $APPLICATION->IncludeComponent(
	    "bitrix:catalog.section", 
	    "level3", 
	    array(
		"COMPONENT_TEMPLATE" => "level3",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => $arParams['IBLOCK_ID'],
		"SECTION_ID" => $arResult['IBLOCK_SECTION_ID'],
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
                "USE_FILTER" =>"Y",
		"FILTER_NAME" => "baFilter",
		"INCLUDE_SUBSECTIONS" => "A",
		"SHOW_ALL_WO_SECTION" => "N",
		"CUSTOM_FILTER" => "",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		
		
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
		"MESS_NOT_AVAILABLE" => "Под заказ",
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
?>
            </div>
	</div>
        </div>
        <?if($arResult["RELATED"]){?>
	<h2 class="s28-title">Сопутствующие товары</h2>
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

