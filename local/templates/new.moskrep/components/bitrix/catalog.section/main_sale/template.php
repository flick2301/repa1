<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

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

               <div class="special-products__item">
                  <!--product-card-->
                  <section class="product-card">
                     <div class="product-card__header">
                        <div class="div_h3 product-card__title"><a class="product-card__link" href="<?=$arElement['DETAIL_PAGE_URL']?>" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($item['NAME']))?>')"><?=$item['NAME']?></a></div>
                        <img class="product-card__image" src="<?echo ($item['PREVIEW_PICTURE']['SRC']) ? $item['PREVIEW_PICTURE']['SRC'] : "/images/no_image.jpg";?>" width="200" height="150" alt="">
                     </div>
                     <div class="product-card__content">
                        <div class="product-card__block">
                           <p class="product-card__delivery"><i class="simple-car-icon product-card__icon"></i><span class="product-card__text">Доставка</span><span class="product-card__date">Завтра</span></p>
                           <p class="product-card__delivery"><i class="simple-home-icon product-card__icon"></i><span class="product-card__text">Самовывоз</span><span class="product-card__date">Сегодня</span></p>
                        </div>
                        <div class="product-card__block">
                           <p class="product-card__available"><span class="product-card__state">В наличии</span></p>
                           <p class="product-card__available"><i class="simple-state-yes-icon product-card__icon product-card__icon--state"></i><span class="product-card__text"><?=($item['CATALOG_QUANTITY'] + $item['CATALOG_QUANTITY_RESERVED']);?> уп.</span></p>
                        </div>
                     </div>
					 
                                                <?
                                                    $price = $item['PRICES']['Распродажа']['VALUE'] ? $item['PRICES']['Распродажа']['VALUE'] : $item['PRICES'][ID_BASE_PRICE]['VALUE'];
                                                    $old_price = $item['PRICES']['Распродажа']['VALUE'] ? $item['PRICES']['К0 (БАЗОВАЯ НАЧАЛЬНАЯ)']['VALUE'] : 0;
                                                ?>					 
                     <div class="product-card__footer">
                        <div class="product-card__price"><?echo number_format($price, 2, '.', ' ');?> ₽</div>
						<?if($old_price && false):?>
                        <div class="product-card__price"><?echo number_format($old_price, 2, '.', ' ');?> ₽</div>
						<?endif?>
                                         
                        <button class="main-button main-button--mini product-card__button" data-product="<?=$item['ID']?>" data-name="<?=$item['NAME']?>" data-price="<?=$item['PRICES']['Распродажа']['VALUE']?>">В корзину</button>
                     </div>
                  </section>
                  <!--product-card-->
               </div>
			   
<?endforeach?>

