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

            <!--page-heading-->
            <header class="basic-layout__module page-heading">
               <h1 class="page-heading__title">Магазин крепежа, метизов и инструментов</h1>
            </header>
            <!--page-heading-->


            <!--product-slider-->
            <div class="basic-layout__module product-slider">
               <div class="product-slider__list" id="product-slider__list">
			   <?foreach ($arResult['ITEMS'] as $item):?>
                                <?$res = CIBlockElement::GetList(array(), array('ID'=>$item["ID"]), false, false, array('ID', 'IBLOCK_ID', 'NAME', 'DETAIL_PAGE_URL'));
                                  $arElement = $res->GetNext();?>			   
                  <div class="product-slider__item">
                     <!--product-card-->
                     <section class="product-card product-card--lite">
                        <div class="product-card__header">
                           <h3 class="product-card__title"><a class="product-card__link" href="<?=$arElement['DETAIL_PAGE_URL']?>"><?=$item['NAME']?></a></h3>
                           <img id="img_<?=$item['ID']?>" class="product-card__image" src="<?echo ($item['PREVIEW_PICTURE']['SRC']) ? $item['PREVIEW_PICTURE']['SRC'] : "/images/no_image.jpg";?>" width="179" height="134" alt="<?=$item['PREVIEW_PICTURE']['DESCRIPTION']?>">
                        </div>
                        <div class="product-card__footer">
                           <div class="product-card__price"><?=$item['PRICES']['Распродажа']['VALUE']?> ₽<del><?=$item['PRICES'][ID_BASE_PRICE]['VALUE']?> ₽</del></div>
                           <button data-product="<?=$item['ID']?>" data-name="<?=$item['NAME']?>" data-price="<?=$item['PRICES']['Распродажа']['VALUE']?>" class="main-button product-card__to-cart <?=($arResult['IN_BASKET'][$item['ID']] == 'Y') ? 'active' : "";?>"><i class="simple-cart-icon"></i>В корзину</button>
                        </div>
                     </section>
                     <!--product-card-->
                  </div>			   
			   <?endforeach?>
               </div>
            </div>
            <!--product-slider-->			   
