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

<?globalGetTitle("Магазин крепежа, метизов и инструментов")?>	


            <!--product-slider-->
            <div class="basic-layout__module product-slider">
               <div class="product-slider__list" id="product-slider__list">
			   <?foreach ($arResult['ITEMS'] as $item):?>
                                <?$res = CIBlockElement::GetList(array(), array('ID'=>$item["ID"]), false, false, array('ID', 'IBLOCK_ID', 'NAME', 'DETAIL_PAGE_URL', 'IBLOCK_SECTION_ID'));
                                  $arElement = $res->GetNext();
								  $count++;?>			   
                  <div class="product-slider__item">
                     <!--product-card-->
                     <section class="product-card product-card--lite">
                        <div class="product-card__header">
                           <div class="div_h3 product-card__title"><a class="product-card__link" href="<?=$arElement['DETAIL_PAGE_URL']?>"  onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($item['NAME']))?>')"><?=$item['NAME']?></a></div>
                           <img id="img_<?=$item['ID']?>" class="product-card__image" <?=$count > 4 ? "data-" : ""?>src="<?echo ($item['PREVIEW_PICTURE']['SRC']) ? $item['PREVIEW_PICTURE']['SRC'] : "/images/no_image.jpg";?>" width="179" height="134" alt="<?=$item['PREVIEW_PICTURE']['DESCRIPTION']?>">
                        </div>
                        <div class="product-card__footer">
                           <div class="product-card__price"><?=$item['PRICES']['Распродажа']['VALUE']?> ₽<del><?=$item['PRICES'][ID_BASE_PRICE]['VALUE']?> ₽</del></div>
                           <button data-product="<?=$item['ID']?>" data-name="<?=$item['NAME']?>" data-price="<?=$item['PRICES']['Распродажа']['VALUE']?>" class="main-button product-card__to-cart <?=($arResult['IN_BASKET'][$item['ID']] == 'Y') ? 'active' : "";?>"><i data-product="<?=$item['ID']?>" data-name="<?=$item['NAME']?>" data-price="<?=$item['PRICES']['Распродажа']['VALUE']?>" class="simple-cart-icon"></i>В корзину</button>
                        </div>
                     </section>
                     <!--product-card-->
                  </div>			   
			   <?endforeach?>
               </div>
            </div>
            <!--product-slider-->			   
