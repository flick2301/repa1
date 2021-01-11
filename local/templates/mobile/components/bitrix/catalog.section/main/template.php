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
<div class="carousel-product">
				<ul class="carousel-product__items">
<?
		foreach ($arResult['ITEMS'] as $item)
		{
			?>
			<li class="carousel-product__item" alt='<?=print_r($item)?>'>
                                <?$res = CIBlockElement::GetList(array(), array('ID'=>$item["ID"]), false, false, array('ID', 'IBLOCK_ID', 'NAME', 'DETAIL_PAGE_URL'));
                                  $arElement = $res->GetNext();
?>
						<a href="<?=$arElement['DETAIL_PAGE_URL']?>" class="carousel-product__link">
							<div class="carousel-product__img"><img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" id="img_<?=$item['ID']?>" alt="<?=$item['PREVIEW_PICTURE']['DESCRIPTION']?>"></div>
						</a>
						<a href="<?=$arElement['DETAIL_PAGE_URL']?>" class="carousel-product__title"><?=$item['NAME']?></a>
						<div class="carousel-product__price-line">
							<span class="carousel-product__price"><?=$item['PRICES']['Распродажа']['VALUE']?> ₽<span class="carousel-product__price-wrap"><span class="carousel-product__price-old"><?=$item['PRICES']['К0 (БАЗОВАЯ НАЧАЛЬНАЯ)']['VALUE']?> ₽</span></span></span>
							<a href="javascript:void(0)" data-product="<?=$item['ID']?>" data-name="<?=$item['NAME']?>" data-price="<?=$item['PRICES']['Распродажа']['VALUE']?>" class="carousel-product__btn <?=($arResult['IN_BASKET'][$item['ID']] == 'Y') ? 'active' : "";?>"></a>
						</div>
					</li>
			
			<?
		}
		?>

					
				</ul>
			</div>