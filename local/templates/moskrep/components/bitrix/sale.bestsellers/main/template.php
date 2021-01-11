<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$this->setFrameMode(true);
?>


<? if (!empty($arResult['ITEMS'])): ?>
	<ul class="product-list__items">
	<?
	foreach ($arResult['ITEMS'] as $key => $arItem)
	{
	?>	
<li class="product-list__item">
<?$res = CIBlockElement::GetList(array(), array('IBLOCK_ID'=>CATALOG_IBLOCK_ID,'ID'=>$arItem["ID"]), false, false, array('ID', 'IBLOCK_ID', 'NAME', 'DETAIL_PAGE_URL'));
                                  $arElement = $res->GetNext();
?>                                                <a href="<?=$arElement["DETAIL_PAGE_URL"]?>" class="product-list__img">
                                                  <div class="product-list__hit">Хит</div>
                                                  <img src="<?echo ($arItem["PREVIEW_PICTURE"]["SRC"]) ? $arItem["PREVIEW_PICTURE"]["SRC"] : "/images/no_image.jpg";?>" alt=""></a>
						<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" class="product-list__title"><?=$arItem["NAME"]?></a>
						<div class="product-list__lineflex">
							<div class="product-list__delivery">Доставка <span class="product-list__day">Завтра</span></div>
							<div class="product-list__presence">Наличие</div>
						</div>
						<div class="product-list__lineflex">
							<div class="product-list__pickup">Самовывоз <span class="product-list__day">Сегодня</span></div>
							<div class="product-list__presence-number"><?=($arItem['CATALOG_QUANTITY']+$arItem['CATALOG_QUANTITY_RESERVED']);?> шт.</div>
						</div>
						<div class="product-list__lineflex">
                                                         <?
                                                         $price = $arItem['PRICES']['Распродажа']['VALUE'] ? $arItem['PRICES']['Распродажа']['VALUE'] : $arItem['PRICES']['К0 (БАЗОВАЯ НАЧАЛЬНАЯ)']['VALUE'];
                                                         $old_price = $arItem['PRICES']['Распродажа']['VALUE'] ? $arItem['PRICES']['К0 (БАЗОВАЯ НАЧАЛЬНАЯ)']['VALUE'] : 0;
                                                         ?>
							<div class="product-list__price"><?echo number_format($price, 2, '.', ' ');?> ₽
                                                        <?if($old_price){
                                                            ?><span class="carousel-product__price-old"><?echo number_format($old_price, 2, '.', ' ');?> ₽</span><?
                                                        }?>
                                                        </div>
							<a href="javascript:void(0)" data-product="<?=$arItem['ID']?>" data-name="<?=$arItem['NAME']?>" data-price="<?echo $arItem['PRICES']['Распродажа']['VALUE'] ? $arItem['PRICES']['Распродажа']['VALUE'] : $arItem['PRICES']['К0 (БАЗОВАЯ НАЧАЛЬНАЯ)']['VALUE'];?>" class="product-list__btn blue-btn">В корзину</a>
                                                        
						</div>
					</li>
                                        <?
		
        }
	?>

	</ul>
<? else: ?>
	<div class="bx-nothing"><?= GetMessage("SB_NO_PRODUCTS"); ?></div>
<?endif ?>


