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

				<ul class="product-list__items">
<?
		foreach ($arResult['ITEMS'] as $item)
		{
			?>
			<li class="product-list__item" >
                            
                            
                            <?$res = CIBlockElement::GetList(array(), array('ID'=>$item["ID"]), false, false, array('ID', 'IBLOCK_ID', 'NAME', 'DETAIL_PAGE_URL'));
                                  $arElement = $res->GetNext();
?>
                            
						<a href="<?=$arElement['DETAIL_PAGE_URL']?>" class="product-list__img">
                                                    <?if($item['PROPERTIES']['novelty']['VALUE_XML_ID']=='Y'){?><div class="product-list__novelty">Новинка</div><?}?>
                                                    <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="<?=$item['PREVIEW_PICTURE']['DESCRIPTION']?>"></a>
						<a href="<?=$arElement['DETAIL_PAGE_URL']?>" class="product-list__title"><?=$item['NAME']?></a>
						<div class="product-list__lineflex">
							<div class="product-list__delivery">Доставка <span class="product-list__day">Завтра</span></div>
							<div class="product-list__presence">Наличие</div>
						</div>
						<div class="product-list__lineflex">
							<div class="product-list__pickup">Самовывоз <span class="product-list__day">Сегодня</span></div>
							<div class="product-list__presence-number"><?=($item['CATALOG_QUANTITY']+$item['CATALOG_QUANTITY_RESERVED']);?> шт.</div>
						</div>
                                                <?
                                                         $price = $item['PRICES']['Распродажа']['VALUE'] ? $item['PRICES']['Распродажа']['VALUE'] : $item['PRICES']['К0 (БАЗОВАЯ НАЧАЛЬНАЯ)']['VALUE'];
                                                         $old_price = $item['PRICES']['Распродажа']['VALUE'] ? $item['PRICES']['К0 (БАЗОВАЯ НАЧАЛЬНАЯ)']['VALUE'] : 0;
                                                         ?>
						<div class="product-list__lineflex">
							<div class="product-list__price"><?echo number_format($price, 2, '.', ' ');?> ₽
                                                        <?if($old_price){
                                                            ?><span class="carousel-product__price-old"><?echo number_format($old_price, 2, '.', ' ');?> ₽</span><?
                                                        }?></div>
							<a href="javascript:void(0)" data-product="<?=$item['ID']?>" data-name="<?=$item['NAME']?>" data-price="<?=$item['PRICES']['Распродажа']['VALUE']?>" class="product-list__btn blue-btn">В корзину</a>
						</div>
					
                            
                            
                                
						
					</li>
			
			<?
		}
		?>

					
				</ul>
		