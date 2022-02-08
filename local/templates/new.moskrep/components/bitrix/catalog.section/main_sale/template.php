<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

global $DEFAULT_STORE_ID;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */

?>


<?foreach ($arResult['ITEMS'] as $item):?>
<?$res = CIBlockElement::GetList(array(), array('ID'=>$item["ID"]), false, false, array('ID', 'IBLOCK_ID', 'NAME', 'DETAIL_PAGE_URL', 'IBLOCK_SECTION_ID'));
$arElement = $res->GetNext();?>


<div class="catalog-feed__item catalog-feed__item_vi">
                     <!--product-card-->
                     <section class="product-card product-card_vi">
					 
						<div class="product-card__artno-blok">
							<p class="product-card__artno">Артикул: <span class="product-card__state product-card__state_artno"><?=$item['PROPERTIES']["CML2_ARTICLE"]["VALUE"]?></span></p>
						</div>  		
						
                        <div class="product-card__header product-card__header_vi">
                           <img class="product-card__image" src="<?echo $item["SMALL_IMG_WEBP"]['WEBP_SRC'] ? $item["SMALL_IMG_WEBP"]['WEBP_SRC'] : ($item['PREVIEW_PICTURE']['SRC'] ? $item['PREVIEW_PICTURE']['SRC'] : "/images/no_image.jpg");?>" alt="<?=$item['NAME']?>" />
                         <h3 class="product-card__title product-card__title_vi"><a class="product-card__link product-card__link_vi" href="<?=$arElement['DETAIL_PAGE_URL']?>" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($item['NAME']))?>')" title='<?=$item['NAME']?>' target="_self" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($item['NAME']))?>')"><?=$item['NAME']?></a></h3>						   
                        </div>
											
      			
				<?if($item['PROPERTIES']["DIAMETR"]["VALUE"] && $item['PROPERTIES']["DLINA"]["VALUE"]):?>
                        <div class="product-card__content">
						<div class="product-card__block-size">
						   <p class="product-card__size">Размер (мм): <span class="product-card__state"><?=$item['PROPERTIES']["DIAMETR"]["VALUE"]?>x<?=$item['PROPERTIES']["DLINA"]["VALUE"]?></span></p>
						</div>  						
						</div> 
				<?endif?>		
						
						<div class="product-card__content">
                           <div class="product-card__block">
                              <p class="product-card__delivery"><i class="simple-home-icon product-card__icon"></i><span class="product-card__text">Самовывоз</span><span class="product-card__date">Сегодня</span></p>						   
                              <p class="product-card__delivery"><i class="simple-car-icon product-card__icon"></i><span class="product-card__text">Доставка</span><span class="product-card__date">Завтра</span></p>
                           </div>
						</div>  

						<div class="product-card__content">
                           <div class="product-card__block">
							  <?if($item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']):?>
                              <p class="product-card__available product-card__available_vi"><span class="product-card__state">Наличие:</span><span class="product-card__amount"><i class="simple-state-yes-icon product-card__icon product-card__icon--state simple-state-yes-icon_vi"></i><span class="product-card__text"><?echo $item['STORE'][$DEFAULT_STORE_ID]['AMOUNT'];?> уп.</span></span></p>
							  <?else:?>
							  <p class="product-card__available product-card__available_vi"><span class="product-card__state">Под заказ</span></p>
							  <?endif?>
                           </div>	
						</div>	
						
                                                <?
                                                    $price = $item['PRICES']['Распродажа']['VALUE'] ? $item['PRICES']['Распродажа']['VALUE'] : $item['PRICES'][ID_BASE_PRICE]['VALUE'];
                                                    $old_price = $item['PRICES']['Распродажа']['VALUE'] ? $item['PRICES']['К0 (БАЗОВАЯ НАЧАЛЬНАЯ)']['VALUE'] : 0;
                                                ?>								


                        <div class="product-card__footer product-card__footer_vi">	
						   <p class="product-card__price-block product-card__price-block_vi">Цена (с НДС): <br /><span class="product-card__price product-card__price_vi"><?echo number_format($price, 2, '.', ' ');?> ₽</span></p>	

						
		   
						   <button class="main-button main-button--mini product-card__button product-card__button_round" data-product="<?=$item['ID']?>" data-name="<?=$item['NAME']?>" data-price="<?=$item['PRICES']['Распродажа']['VALUE']?>"></button>
						   
                        </div>							   
						   
                     </section>		
                     <!--product-card-->
            </div>

		   
			   
<?endforeach?>

