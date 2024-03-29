<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $APPLICATION;
global $DEFAULT_STORE_ID;

CJSCore::Init(array("ajax"));

$ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues($arParams["IBLOCK_ID"],$arResult['SECTION']['ID']);
    $IPROPERTY  = $ipropValues->getValues();
    
    $APPLICATION->SetPageProperty('title', $IPROPERTY['ELEMENT_META_TITLE']);
    $APPLICATION->SetPageProperty('description', $IPROPERTY['ELEMENT_META_DESCRIPTION']);
    $APPLICATION->SetPageProperty('keywords', $IPROPERTY['ELEMENT_META_KEYWORDS']);


$price = $arResult['PRICES'][ID_SALE_PRICE]['VALUE'] ? $arResult['PRICES'][ID_SALE_PRICE]['VALUE'] : $arResult['MIN_PRICE']['VALUE'] ? $arResult['MIN_PRICE']['VALUE'] : $arResult['PRICES'][ID_BASE_PRICE]['VALUE'];
$old_price = $arResult['PRICES'][ID_SALE_PRICE]['VALUE'] ? $arResult['PRICES'][ID_BASE_PRICE]['VALUE'] : 0;

$scheme = CMain::isHttps() ? 'https' : 'http';
?>

<script>
$(document).ready(function(){
    $(document).on("click","#chars_href", function (event) {	
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1500);
    });
});

dataLayer.push({
	'event':'krepkomp',
	'eventCategory':'Карточка товара', 
	'eventAction':'<?=$arResult["NAME"]?>', // Наименование товара, указанное на просматриваемой странице 
    'eventLabel':'просмотр' 
});
</script>

<!--json-ld-->
<script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "Product",
      "name": "<?=$arResult['NAME']?>",
      "image": [
        "<?=$scheme?>://<?=$_SERVER['HTTP_HOST']?><?=$arResult['DETAIL_PICTURE']['SRC'];?>"
       ],
      "description": "<?=trim($arResult['PREVIEW_TEXT'])?>",
      "sku": "<?=trim($arResult['PROPERTIES']['CML2_ARTICLE']['VALUE'])?>",
	  "mpn": "",
      "brand": {
        "@type": "Brand",
        "name": "<?=$arResult['PROPERTIES']['BREND']['VALUE']?>"
      },	  
      "offers": {
        "@type": "Offer",
        "url": "<?=$scheme?>://<?=$_SERVER['HTTP_HOST']?><?=$arResult['DETAIL_PAGE_URL']?>",	
        "priceCurrency": "RUB",
        "price": "<?=$price?>",
        "itemCondition": "https://schema.org/UsedCondition",
        "availability": "http://schema.org/<?=$arResult['STORE'][$DEFAULT_STORE_ID]['AMOUNT'] ? 'InStock' : 'OutOfStock'?>",
        "seller": {
          "@type": "Organization",
          "name": "КРЕП-КОМП"
        }
      },
	  "aggregateRating": {
		"@type": "AggregateRating",
		"ratingValue" : "5",
		"ratingCount" : "1",
		"reviewCount" : "1"
	}
	}
    </script>
<!--json-ld-->


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

<?globalGetTitle($arResult['NAME'].' '.$arResult['PROPERTIES']['BREND']['VALUE'])?>

<div id="shops-window"><div class="win"></div></div>
<div class="card__articul">Артикул: <span class="card__articul-name"><?=$arResult['PROPERTIES']['CML2_ARTICLE']['VALUE']?></span>
<div class="stars">
	<div>
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="svg-icon star" style="font-size: 20px;">
			<path d="M12.024 3.277c.15-.316.6-.316.752 0L15.3 8.57c.06.127.182.215.322.233l5.814.767a.416.416 0 0 1 .232.715l-4.253 4.037a.416.416 0 0 0-.123.378l1.068 5.767a.416.416 0 0 1-.608.442l-5.155-2.798a.416.416 0 0 0-.397 0L7.047 20.91a.416.416 0 0 1-.608-.442L7.506 14.7a.417.417 0 0 0-.123-.378L3.13 10.285a.417.417 0 0 1 .233-.715l5.814-.767a.416.416 0 0 0 .321-.233l2.526-5.293Z"></path>
		</svg>
	</div>
	<div>
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="svg-icon star" style="font-size: 20px;">
			<path d="M12.024 3.277c.15-.316.6-.316.752 0L15.3 8.57c.06.127.182.215.322.233l5.814.767a.416.416 0 0 1 .232.715l-4.253 4.037a.416.416 0 0 0-.123.378l1.068 5.767a.416.416 0 0 1-.608.442l-5.155-2.798a.416.416 0 0 0-.397 0L7.047 20.91a.416.416 0 0 1-.608-.442L7.506 14.7a.417.417 0 0 0-.123-.378L3.13 10.285a.417.417 0 0 1 .233-.715l5.814-.767a.416.416 0 0 0 .321-.233l2.526-5.293Z"></path>
		</svg>
	</div>
	<div>
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="svg-icon star" style="font-size: 20px;">
			<path d="M12.024 3.277c.15-.316.6-.316.752 0L15.3 8.57c.06.127.182.215.322.233l5.814.767a.416.416 0 0 1 .232.715l-4.253 4.037a.416.416 0 0 0-.123.378l1.068 5.767a.416.416 0 0 1-.608.442l-5.155-2.798a.416.416 0 0 0-.397 0L7.047 20.91a.416.416 0 0 1-.608-.442L7.506 14.7a.417.417 0 0 0-.123-.378L3.13 10.285a.417.417 0 0 1 .233-.715l5.814-.767a.416.416 0 0 0 .321-.233l2.526-5.293Z"></path>
		</svg>
	</div>
	<div>
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="svg-icon star" style="font-size: 20px;">
			<path d="M12.024 3.277c.15-.316.6-.316.752 0L15.3 8.57c.06.127.182.215.322.233l5.814.767a.416.416 0 0 1 .232.715l-4.253 4.037a.416.416 0 0 0-.123.378l1.068 5.767a.416.416 0 0 1-.608.442l-5.155-2.798a.416.416 0 0 0-.397 0L7.047 20.91a.416.416 0 0 1-.608-.442L7.506 14.7a.417.417 0 0 0-.123-.378L3.13 10.285a.417.417 0 0 1 .233-.715l5.814-.767a.416.416 0 0 0 .321-.233l2.526-5.293Z"></path>
		</svg>
	</div>
	<div>
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="svg-icon star" style="font-size: 20px;">
			<path d="M12.024 3.277c.15-.316.6-.316.752 0L15.3 8.57c.06.127.182.215.322.233l5.814.767a.416.416 0 0 1 .232.715l-4.253 4.037a.416.416 0 0 0-.123.378l1.068 5.767a.416.416 0 0 1-.608.442l-5.155-2.798a.416.416 0 0 0-.397 0L7.047 20.91a.416.416 0 0 1-.608-.442L7.506 14.7a.417.417 0 0 0-.123-.378L3.13 10.285a.417.417 0 0 1 .233-.715l5.814-.767a.416.416 0 0 0 .321-.233l2.526-5.293Z"></path>
		</svg>
	</div>
</div>

</div>

    <div itemscope class="basic-layout__module product-page">
		<div class="product-page__main">
                  <div class="product-page__gallery">
                     <!--product-gallery-->
                     <div class="product-gallery" data-gallery-popup>
                        <a class="product-gallery__link" href="<?=$arResult['DETAIL_PICTURE']['SRC'];?>" rel="gallery_card" title='<? echo ($arResult["IPROPERTY_VALUES"]['ELEMENT_DETAIL_PICTURE_FILE_TITLE'] ? $arResult["IPROPERTY_VALUES"]['ELEMENT_DETAIL_PICTURE_FILE_TITLE'] : "Moskrep.ru - ".$arResult["SECTION"]["NAME"]." ".$arResult["NAME"].", купить в интернет-магазине - цена, фото");?>'>
                           <p class="product-gallery__cover"><img class="product-gallery__image" itemprop="image" src="<?=$arResult['PREVIEW_PICTURE']['src'];?>" alt="<?=$arResult['NAME']?>" width="582" height="437" alt=""></p>
                           <p data-sreader>Увеличить</p>
                        </a>
                     </div>
                     <!--product-gallery-->
                  </div>
                  <div class="product-page__about">
                     <!--product-purchase-->
                     <div class="product-purchase">
						<?if($old_price){?>
						<p class="card__price-last" ><?echo number_format($old_price, 2, '.', ' ');?> ₽<img src='/images/info-svgrepo-com.svg' data-tooltip2="<?echo number_format($old_price, 2, '.', ' ');?>" /></p>
                        <?}?>					 
                        <p class="product-purchase__price" ><?echo number_format($price, 2, '.', ' ');?> ₽<img src='/images/info-svgrepo-com.svg' data-tooltip2="<?echo number_format($price, 2, '.', ' ');?>" /></p>
			<?//временно отключаем вывод цен?>
            
			<div class='card-price-dop-contaiber' id='tooltip2'>
            <?if($arResult["DOP_PRICE"][0]):?><div class='card-price-dop'><b><?=$arResult["DOP_PRICE"][0]?> ₽</b> при заказе от 5 000₽</div><br><?endif?>
            <?if($arResult["DOP_PRICE"][1]):?><div class='card-price-dop'><b><?=$arResult["DOP_PRICE"][1]?> ₽</b> при заказе от 10 0000₽</div><br><?endif?>
            <?if($arResult["DOP_PRICE"][2]):?><div class='card-price-dop'><b><?=$arResult["DOP_PRICE"][2]?> ₽</b> при заказе от 15 000₽</div><br><?endif?>
			<?if($arResult["DOP_PRICE"][3]):?><div class='card-price-dop'><b><?=$arResult["DOP_PRICE"][3]?> ₽</b> при заказе от 20 000₽</div><br><?endif?>
			<?if($arResult["DOP_PRICE"][4]):?><div class='card-price-dop'><b><?=$arResult["DOP_PRICE"][4]?> ₽</b> при заказе от 25 000₽</div><br><?endif?>
			<?if($arResult["DOP_PRICE"][5]):?><div class='card-price-dop'><b><?=$arResult["DOP_PRICE"][5]?> ₽</b> при заказе от 100 000₽</div><br><?endif?>
			<?if($arResult["DOP_PRICE"][6]):?><div class='card-price-dop'><b><?=$arResult["DOP_PRICE"][6]?> ₽</b> при заказе от 500 000₽</div><?endif?>
			</div>
            
			
<?if ($old_price):?>			
<div class="product__date-block">	
<?endif?>					
                        <a href='javascript::void(0)' onmousedown="try { rrApi.addToBasket(<?=$arResult['ID']?>) } catch(e) {}" data-quantity="<?=$arResult['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?>" data-product="<?=$arResult['ID']?>" data-name="<?=$arResult['NAME']?>" data-price="<?=$price?>"  class="main-button main-button--plus product-purchase__button"><i class="simple-cart-icon product-purchase__icon" data-product="<?=$arResult['ID']?>" data-name="<?=$arResult['NAME']?>" data-price="<?=$price?>"  data-quantity="<?=$arResult['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?>" rel="nofollow"></i>Добавить в корзину</a>
						<?if ($old_price):?>
			<div class="product__date">Внимание! Количество акционных товаров ограничено</div>	
</div>			
			<?endif?>
			
                     </div>
                     <!--product-purchase-->
                     <!--product-data-->
                     <div class="product-page__data product-data">
                        <div class="product-data__section">
                           <ul class="product-data__list">
                              <li class="product-data__item">
                                 <p class="product-data__name card_delivery product-data__scroll" data-product="<?=$arResult['ID']?>"><i class="simple-car-icon product-data__icon"></i>Доставка</p>
                                 <p class="product-data__text">от <?=$arResult['PROPERTIES']['PROPERTY_MIN_DELIVERY_VALUE'];?> руб.</p>
                              </li>
                              <li class="product-data__item">
                                 <p class="product-data__name"><i class="simple-available-icon product-data__icon"></i>На складе</p>
                                 <p class="product-data__text" data-product="<?=$arResult['ID']?>"><?=($arResult['STORE'][$DEFAULT_STORE_ID]['AMOUNT']) ?  $arResult['STORE'][$DEFAULT_STORE_ID]['AMOUNT'].' уп.' : '<span class="unavailable_pickup" data-product="'.$arResult['ID'].'">Наличие уточнить</span>'?></p>
                              </li>

                              <li class="product-data__item">
                                 <p class="product-data__name card_pickup product-data__scroll" data-product="<?=$arResult['ID']?>"><i class="simple-home-icon product-data__icon"></i><?echo ($arResult['ONLY_STORE_AMOUNT']) ? 'В магазинах' : 'Самовывоз';?></p>
								 <?if($arResult['ONLY_STORE_AMOUNT'])
								 {?>
									<p class="product-data__text"><?=$arResult['ONLY_STORE_COUNT'];?> <?echo ($arResult['ONLY_STORE_COUNT']>1) ? 'магазина' : 'магазин';?></p>
								 <?}else{?>
                                 <p class="product-data__text"><?echo ((strstr($_SERVER['HTTP_HOST'], "spb") && $arResult['STORE'][$DEFAULT_STORE_ID]['AMOUNT']-$arResult['STORE'][3]['AMOUNT']) || (strstr($_SERVER['HTTP_HOST'], "novosibirsk") && $arResult['STORE'][$DEFAULT_STORE_ID]['AMOUNT']) || (($_SERVER['HTTP_HOST'] == "krep-komp.ru") && $arResult['STORE'][3]['AMOUNT'])) ? ' сегодня, бесплатно' : 'на заказ';?></p>
								 <?}?>
                              </li>

                           </ul>
                           <div class="product-data__info">
                              <a class="" href="/addresses/">Адреса магазинов</a>
                           </div>
                        </div>
                        <div class="product-data__section">
						<?if(count($arResult['BASE_PROPERTIES_HEAD'])):?>
                           <ul class="product-data__list">
							<?foreach($arResult['BASE_PROPERTIES_HEAD'] as $arProp){?>
                              <li class="product-data__item">
                                 <p class="product-data__name"><?=$arProp['NAME']?></p>
                                 <p class="product-data__text"><?=$arProp['VALUE']?></p>
                              </li>
							<?}?>
							</ul>
                        <?endif;?>
                           
                           <div class="product-data__info">
                              <a id="chars_href" class="product-data__scroll" href="#desc" rel="nofollow" data-tab="tab-1">Все характеристики</a>
                           </div>
                        </div>
                     </div>
                     <!--product-data-->
                  </div>
        </div>
		    <!--product-tabs-->
               <div class="product-page__tabs product-tabs" id="desc">
                  <ul class="product-tabs__list" data-product-page-tabs>
                     <li class="product-tabs__item">
                        <a class="product-tabs__toggle" href="#description" data-tabby-default>Описание</a>
                     </li>
					 <?if(count($arResult['CERT_PICTURE'])):?>
                     <li class="product-tabs__item">
                        <a class="product-tabs__toggle" href="#certify">Сертификаты</a>
                     </li>
					 <?endif;?>
                     <li class="product-tabs__item">
                        <a class="product-tabs__toggle" href="#payment">Способы оплаты</a>
                     </li>
                     <li class="product-tabs__item">
                        <a class="product-tabs__toggle" href="#delivery">Доставка</a>
                     </li>
					<?if($_SERVER['HTTP_HOST']=='krep-komp.ru' || $_SERVER['HTTP_HOST']=='spb.krep-komp.ru'){?>
                     <li class="product-tabs__item">
                        <a class="product-tabs__toggle" href="#pickup">Самовывоз</a>
                     </li>
					<?}?>
                     <li class="product-tabs__item">
                        <a class="product-tabs__toggle product-tabs__toggle--special" href="#discount">Ваши скидки</a>
                     </li>
                  </ul>
               </div>
        <!--product-tabs-->
        <div class="product-page__section" id="description">
					<?if($arResult['DETAIL_TEXT']){?>
					<h2 id="chars" class="product-page__title">Описание</h2>
					<div class="product-page__specs product-data product-data--specs product-data--specsfull">
						<?=$arResult['DETAIL_TEXT']?>
						<?
						//НУЖНО ВСТАВИТЬ КАЛЬКУЛЯТОР ДЛЯ ХИМ. КАРТРИДЖЕЙ
						if($arResult['ORIGINAL_PARAMETERS']['SECTION_CODE']=='kartridzh')
							$APPLICATION->IncludeFile(SITE_DIR."/include/calculator.php", array("SHOW_BORDER" => true, "MODE"=>"html"));
						?>
					</div>
					<br>
					<?}?>
                  <h2 id="chars" class="product-page__title">Характеристики</h2>
                  <!--product-data-->
                  <div class="product-page__specs product-data product-data--specs">
                     <ul class="product-data__list">
					 <?foreach($arResult['BASE_PROPERTIES_UL1'] as $arProp){?>
                        <li class="product-data__item">
                           <p class="product-data__name"><?=$arProp['NAME']?></p>
                           <p class="product-data__text"><?=$arProp['VALUE']?></p>
                        </li>
					 <?}?>
					 <?foreach($arResult['BASE_PROPERTIES_UL2'] as $arProp){?>
                        <li class="product-data__item">
                           <p class="product-data__name"><?=$arProp['NAME']?></p>
                           <p class="product-data__text"><?=$arProp['VALUE']?></p>
                        </li>
					 <?}?>
                        
                     </ul>
                     <!--<p class="product-data__info"><?=$arResult['NAME']?></p>-->
                  </div>
                  <!--product-data-->
				  
				  <?
    //ФИЛЬТРОВЫЕ КНОПКИ ДЛЯ ПОСАДОЧНЫХ СТРАНИЦ
    if(!empty($arResult['SORT_ITEMS'])){
        ?>

        <?

        
                ?>
                <div class="basic-layout__module category-blocknew">
                    <div class="div_h3 category-blocknew__title"><span><?=$sortSection["NAME"]?></span></div>
                    <ul class="category-blocknew__list">
                       
                        <?foreach($arResult['SORT_ITEMS'] as $sort_item):?>
                            
                            <li class="category-blocknew__item" >
                                <a href="<?=$sort_item['LINK']?>" class="category-block__link active">
                                    <?=$sort_item['NAME']?>
                                </a>
                            </li>
                        <?endforeach;?>
                    </ul>
                </div>
                <?
           

    }
    ?>
        </div>
		
		<div class="product-page__section" id="certify">
                  <div class="product-page__block" data-gallery-popup>
					<?foreach($arResult['CERT_PICTURE'] as $cert){?>
                     <div class="product-page__column">
                        <!--certify-card-->
                        <div class="certify-card">
                           <a class="certify-card__link" href="<?=$cert['BIG_PIC']?>" data-fancy="gallery_img">
                              <p class="certify-card__cover"><img class="certify-card__image" src="<?=$cert['src']?>" width="265" height="375" alt=""></p>
                              <p data-sreader>Увеличить</p>
                           </a>
                        </div>
                        <!--certify-card-->
                     </div>
					<?}?>
                     
                  </div>
        </div>
		<div class="product-page__section" id="payment">
		 <? include($_SERVER["DOCUMENT_ROOT"]."/include/oplata.php"); ?>
		 </div>
         <!--<?=$templateFolder?>-->   
	    <? require_once($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php"); ?>
		
<?if($_SERVER['HTTP_HOST']=='krep-komp.ru' || $_SERVER['HTTP_HOST']=='spb.krep-komp.ru'){?>		
		<div class="product-page__section" id="pickup"><br /><br />
                  <h2 class="product-page__title">Самовывоз бесплатно</h2>
                  <!--simple-article-->
                  <div class="basic-layout__module simple-article">
                     <!--content-tabs-->
                     <div class="product-widget__tabs content-tabs">
                        <ul class="content-tabs__list" data-pickup-tabs>
                           <li class="content-tabs__item">
                              <a class="content-tabs__toggle" href="#pickup-moscow" data-tabby-default>Москва и МО</a>
                           </li>
                           <li class="content-tabs__item">
                              <a class="content-tabs__toggle" href="#pickup-piter">Санкт-Петербург</a>
                           </li>
                        </ul>
                     </div>
                     <!--content-tabs-->
                     <div class="simple-article__content" id="pickup-moscow">
                        <div class="simple-article__pickup">
                           <div class="simple-article__main">
                              <div class="simple-article__section pickup-block">
                                 <p class="pickup-block__marker">1</p>
                                 <div class="pickup-block__main">
                                    <p class="pickup-block__text"><?echo STORE_ID_KASHIRKA['1'];?></p>
                                    <p class="pickup-block__text"><?=STORE_ID_KASHIRKA[2]?></p>
                                    <p class="pickup-block__info">Получение:</p>
                                    <ul class="pickup-block__list simple-list">
									<?=($arResult['ELEMENT_COUNT']) ? '<li class="pickup-block__item">сегодня после 14:00 при заказе до 11:00</li><li class="pickup-block__item">сегодня после 17:00 при заказе до 15:00</li>' : '<li class="pickup-block__item">Уточнить</li>';?>
                                    </ul>
                                    <button class="pickup-block__open-map" id="maps-trigger-01">Показать на карте</button>
                                 </div>
                              </div>
                              <div class="simple-article__section pickup-block">
                                 <p class="pickup-block__marker">2</p>
                                 <div class="pickup-block__main">
                                    <p class="pickup-block__text"><?=STORE_ID_KOLEDINO[1]?></p>
                                    <p class="pickup-block__text"><?=STORE_ID_KOLEDINO[2]?></p>
                                    <p class="pickup-block__info">Получение:</p>
                                    <ul class="pickup-block__list simple-list">
                                       <?=($arResult['ELEMENT_COUNT']) ? '<li class="pickup-block__item">сегодня при заказе до 17:00</li>' : '<li class="pickup-block__item">Уточнить</li>';?>
                                    </ul>
                                    <button class="pickup-block__open-map" id="maps-trigger-02">Показать на карте</button>
                                 </div>
                              </div>
                              <div class="simple-article__section pickup-block">
                                 <p class="pickup-block__marker">3</p>
                                 <div class="pickup-block__main">
                                    <p class="pickup-block__text"><?echo STORE_ID_UZHKA['1'];?></p>
                                    <p class="pickup-block__text"><?echo STORE_ID_UZHKA['2'];?></p>
                                    <p class="pickup-block__info">Получение:</p>
                                    <ul class="pickup-block__list simple-list">
										<?=($arResult['ELEMENT_COUNT']) ? '<li class="pickup-block__item">завтра после 13:00 при заказе до 18:00</li>' : '<li class="pickup-block__item">Уточнить</li>';?>
                                       
                                    </ul>
                                    <button class="pickup-block__open-map" id="maps-trigger-03">Показать на карте</button>
                                 </div>
                              </div>
                              <div class="simple-article__section pickup-block">
                                 <p class="pickup-block__marker">4</p>
                                 <div class="pickup-block__main">
                                    <p class="pickup-block__text"><?=STORE_ID_SERPUH[1]?></p>
                                    <p class="pickup-block__text"><?=STORE_ID_SERPUH[2]?></p>
                                    <p class="pickup-block__info">Получение:</p>
                                    <ul class="pickup-block__list simple-list">
                                       <?=($arResult['ELEMENT_COUNT']) ? '<li class="pickup-block__item">завтра после 13:00 при заказе до 18:00</li>' : '<li class="pickup-block__item">Уточнить</li>';?>
                                    </ul>
                                    <button class="pickup-block__open-map" id="maps-trigger-04">Показать на карте</button>
                                 </div>
                              </div>
                              <div class="simple-article__footer">
                                 <p>Забрать груз в пункте самовывоза на Каширском шоссе можно на следующий день. Для этого оформить заказ нужно до 15:00. Суббота и Воскресенье - выходные дни.</p>
                              </div>
                           </div>
                           <div class="simple-article__maps">
                              <div class="pickup-maps is-active" id="pickup-maps-01" data-pickup-maps>
                                 <script src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A625507974d4d143dfc3082f31cfe436fb4ffdf548210a4ea3a6086f80e3805d4&amp;amp;width=100%&amp;amp;height=366&amp;amp;lang=ru_RU&amp;amp;scroll=true" async></script>
                              </div>
                              <div class="pickup-maps" id="pickup-maps-02" data-pickup-maps>
                                 <script src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A9f57f6af4a5f287322eab5e90b142e37ef689f4dedd4dad7dcd35867eb10639f&amp;amp;width=100%&amp;amp;height=366&amp;amp;lang=ru_RU&amp;amp;scroll=true" async></script>
                              </div>
                              <div class="pickup-maps" id="pickup-maps-03" data-pickup-maps>
                                 <script src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A7897bc149959ca515a7d85597cf186c9c167311b25f224bb2ec39ebc13b8bcd2&amp;amp;width=100%&amp;amp;height=366&amp;amp;lang=ru_RU&amp;amp;scroll=true" async></script>
                              </div>
                              <div class="pickup-maps" id="pickup-maps-04" data-pickup-maps>
                                 <script src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Acfdcfe91111c9ff07c8cdd73241e97f87f46ab875d8ce1a07269ca9593aaf944&amp;amp;width=100%&amp;amp;height=366&amp;amp;lang=ru_RU&amp;amp;scroll=true" async></script>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="simple-article__content" id="pickup-piter">
                        <div class="simple-article__pickup">
                           <div class="simple-article__main">
                              <div class="simple-article__section pickup-block">
                                 <p class="pickup-block__marker">SP1</p>
                                 <div class="pickup-block__main">
                                    <p class="pickup-block__text">Санкт-Петербург, улица проспект Энергетиков, 22Л</p>
                                    <p class="pickup-block__text">Пн - Пт: c 09:00 до 18:00; Сб: 10:00-16:00</p>
                                 </div>
                              </div>
                              <div class="simple-article__footer">
                                 <p>Забрать груз можно уже на следующий день в точке самовывоза на ул. проспект Энергетиков, 22Л. Для этого оформить заказ нужно до 15:00 с понедельника по пятницу. Суббота и Воскресенье - выходные дни. Если получить груз нужно в другом пункте выдачи - получить его можно только через день. Доставка по городу оплачивается дополнительно и включается в счет.</p>
                              </div>
                           </div>
                           <div class="simple-article__maps">
                              <div class="pickup-maps is-active">
                                 <script src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Aa806ad6dec02c427303feb640071a9eb6a3f60ea63e7892d5475723a45dbcefb&amp;amp;width=100%&amp;amp;height=366&amp;amp;lang=ru_RU&amp;amp;scroll=true" async></script>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--simple-article-->
               </div>
<?}?>			   
			   
			   
			   <div class="product-page__section" id="discount">
                  <!--simple-article-->
                  <div class="basic-layout__module simple-article">
                     <div class="simple-article__content wysiwyg-block">
                        <p>KREP-KOMP - ведущий поставщик и производитель строительного крепежа для розничных, мелкооптовых и оптовых клиентов. С 2005 года мы предлагаем самый широкий ассортимент, доступные цены и гибкую систему скидок.</p>
                        <p>Доставка по Москве в пределах МКАД при заказе от 50000 руб. <strong>БЕСПЛАТНО</strong></p>
                        <h3>Оптовые скидки:</h3>
                        <div class="special-table special-table--lite">
                           <table>
                              <tbody>
                                 <tr >
									<th>5%</th>
									<td >от 5 000 руб</td>
								</tr>
								<tr >
									<th>10%</th>
									<td >от 10 000 руб</td>
								</tr>
								<tr>
									<th>15%</th>
									<td >от 15 000 руб</td>
								</tr>
								<tr>
									<th>20%</th>
									<td >от 20 000 руб</td>
								</tr>
								<tr>
									<th>25%</th>
									<td >от 25 000 руб</td>
								</tr>
								<tr>
									<th>30%</th>
									<td >от 100 000 руб</td>
								</tr>
								<tr>
									<th>35%</th>
									<td >от 500 000 руб</td>
								</tr>
                                 <!--<tr>
                                    <th>18%</th>
                                    <td>от 1 000 000 руб<br>* скидка предоставляется при условии выполнения ежеквартальных закупкок на сумму от 5 000 000 руб.</td>
                                 </tr>-->
                              </tbody>
                           </table>
                        </div>
                        <p>Оформите заказ на сайте, и менеджер пересчитает его стоимость с учётом вашей скидки.</p>
                     </div>
                  </div>
                  <!--simple-article-->
               </div>
			</div>
			<!--product-page-->
		<div class="basic-layout__module product-widget">
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.products.viewed",
	"",
	Array(
		
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_TO_BASKET_ACTION" => "BUY",
		"BASKET_URL" => "/personal/basket.php",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CART_PROPERTIES_2" => array("*"),
		"CART_PROPERTIES_3" => array("*"),
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "RUB",
		"DATA_LAYER_NAME" => "dataLayer",
		"DEPTH" => "",
		"DISCOUNT_PERCENT_POSITION" => "top-right",
		"ENLARGE_PRODUCT" => "STRICT",
		"ENLARGE_PROP_2" => "NEWPRODUCT",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "L",
		"IBLOCK_ID" => "17",
		"IBLOCK_MODE" => "single",
		"IBLOCK_TYPE" => "catalog",
		"LABEL_PROP_2" => array("NEWPRODUCT"),
		"LABEL_PROP_MOBILE_2" => array(),
		"LABEL_PROP_POSITION" => "top-left",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"MESS_RELATIVE_QUANTITY_FEW" => "мало",
		"MESS_RELATIVE_QUANTITY_MANY" => "много",
		"MESS_SHOW_MAX_QUANTITY" => "Наличие",
		"OFFER_TREE_PROPS_3" => array("COLOR_REF","SIZES_SHOES","SIZES_CLOTHES"),
		"PAGE_ELEMENT_COUNT" => "4",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array("*"
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,quantityLimit,sku,quantity,buttons,compare",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false}]",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"PROPERTY_CODE_17" => array("*"),
		"PROPERTY_CODE_3" => array("*"),
		"PROPERTY_CODE_MOBILE_2" => array(),
		"RELATIVE_QUANTITY_FACTOR" => "5",
		"SECTION_CODE" => "",
		"SECTION_ELEMENT_CODE" => "",
		"SECTION_ELEMENT_ID" => "",
		"SECTION_ID" => "",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_MAX_QUANTITY" => "M",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_PRICE_COUNT" => "",
		"SHOW_PRODUCTS_2" => "N",
		"SHOW_SLIDER" => "Y",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "Y",
		"TEMPLATE_THEME" => "blue",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "Y"
	)
);?>
</div>
	
			<div class="basic-layout__module product-widget">
               <!--content-tabs-->
               <div class="product-widget__tabs content-tabs">
                  <ul class="content-tabs__list" data-product-widget-tabs>
                     <li class="content-tabs__item">
                        <a class="content-tabs__toggle" href="#packaging" data-tabby-default>Варианты упаковки</a>
                     </li>
					 <?
						if(!empty($arResult["RELATED"]))
						{
					?>
                     <li class="content-tabs__item">
                        <a class="content-tabs__toggle" href="#other">Сопутствующие товары</a>
                     </li>
					 <?
						}
						?>
                  </ul>
               </div>
               <!--content-tabs-->
            
            <!--product-widget-->
            <div class="basic-layout__module product-widget">
               <!--content-tabs-->
            <div class="product-widget__content" id="packaging">   			   
            <?if(count($arResult['ELEMENT_VARS'])){?>            
		<?
            global $bbFilter;
            $bbFilter = Array("ID" => $arResult['ELEMENT_VARS']);    
            
            $APPLICATION->IncludeComponent(
	    "bitrix:catalog.section", 
	    "vertical", 
	    array(
		"COMPONENT_TEMPLATE" => "vertical",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => $arParams['IBLOCK_ID'],
		"SECTION_ID" => $arResult['IBLOCK_SECTION_ID'],
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
                "USE_FILTER" =>"Y",
				'DISABLE_HEADER' => 'Y',
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
		"DISPLAY_BOTTOM_PAGER" => "N",
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
		"SHOW_OLD_PRICE" => "Y",
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
<div data-retailrocket-markup-block="63591c1ce931eed4c8088b0a" data-product-id="<?=$arResult['ID']?>"></div>
    
            
            <div class="product-widget__content" id="other">
			<div data-retailrocket-markup-block="63591c2ae931eed4c8088b0e" data-product-id="<?=$arResult['ID']?>"></div>
			<script>retailrocket.markup.render();</script>
			<div data-retailrocket-markup-block="63591c3a1e03932729114a3c" data-product-id="<?=$arResult['ID']?>"></div>
		<?
            global $baFilter;
			if(empty($baFilter))
				$baFilter = Array("ID" => $arResult['ELEMENT_NEXT']);
		global $arFilter_soput;
		$arFilter_soput = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], "SECTION_ID"=>$arResult["RELATED"], 'ACTIVE'=>'Y');
		foreach($arResult['SOPUT_PROPERTY'] as $soput_property)
		{	
			$arProp = explode('=>', $soput_property);
			$arFilter_soput[$arProp[0]] = $arProp[1];
		}
		
			
						
            
            
?>

<div class="catalog-feed__other">
<?
if(!empty($arResult["RELATED"]))
{
$arFilter = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], "ID"=>$arResult["RELATED"], 'ACTIVE'=>'Y', false, array("*"));
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
}
?>
</div>


            </div>
			<!--content-tabs-->
		</div>
		<!--product-widget-->
          

		  
	</div>

<br> 	
<div style="margin: auto; width: auto; text-align: right;">
<script src="https://yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-curtain data-size="l" data-services="messenger,vkontakte,facebook,telegram"></div>
</div>
<br>   




<?global $userEmail;?>
<!-- Criteo Product dataLayer -->
<script>
        var dataLayer = dataLayer || [];
        dataLayer.push({            
            'event': 'crto_productpage',
            crto: {             
                'email': '<?=$userEmail?>',
                'products': ['<?=$arResult["ID"]?>']
            }
        });
</script>
<!-- END Criteo Product dataLayer -->
<script src="<?=SITE_TEMPLATE_PATH?>/assets/scripts/tabby-12.0.3.min.js?v=XXXXXXa"></script>
   <script>var tabs=new Tabby("[data-product-page-tabs]");tabs=new Tabby("[data-delivery-tabs]"),tabs=new Tabby("[data-pickup-tabs]"),tabs=new Tabby("[data-product-widget-tabs]")</script>
   
   
<script type="text/javascript"> 
    (window["rrApiOnReady"] = window["rrApiOnReady"] || []).push(function() {
		try{ rrApi.groupView([<? echo $arResult['ID']; ?>]); } catch(e) {}
	})
</script>
<style>
.basic-layout__content{
	width:100% !important;
}
</style>