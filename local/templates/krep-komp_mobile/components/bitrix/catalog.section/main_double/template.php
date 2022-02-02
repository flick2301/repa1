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

<div class="popular">
<div class="container">
<div class="popular__wrapper">
<div class="popular__title">Популярные товары</div>

<div class="popular__block">
	<div class="popular__shadow"></div>
	<div class="popular__navigation">
		
	</div>
    <div class="owl-carousel owl-loaded owl-drag">
		<div class='owl-stage-outer'>
			<div class='popular__list owl-stage' style=''>
				<?$index=0;?>
				<?foreach ($arResult['ITEMS'] as $key=>$item):?>
				
				<?
					$index++;
                    $price = $arResult['ITEMS'][$key]['PRICES']['Распродажа']['VALUE'] ? $arResult['ITEMS'][$key]['PRICES']['Распродажа']['VALUE'] : $arResult['ITEMS'][$key]['PRICES'][ID_BASE_PRICE]['VALUE'];
                    $old_price = $arResult['ITEMS'][$key]['PRICES']['Распродажа']['VALUE'] ? $arResult['ITEMS'][$key]['PRICES']['К0 (БАЗОВАЯ НАЧАЛЬНАЯ)']['VALUE'] : 0;
                ?>	
                    
				<div class="owl-item" style="">
					<div class="popular__box">
						<div class="popular__topside">
							<a class="popular__top" href="<?=$item['DETAIL_PAGE_URL']?>">
								<div class="popular__offer">Акция</div>
								<img class="popular__img" src="<?=$item["SMALL_IMG_WEBP"]['WEBP_SRC'] ? $item["SMALL_IMG_WEBP"]['WEBP_SRC'] : $item['PREVIEW_PICTURE']['SRC'];?>" style="opacity: 1;">
							</a>
							<a class="popular__name" href="<?=$item['DETAIL_PAGE_URL']?>"><?=$item['NAME']?></a>
						</div>
						<div class="popular__botside">
							<div class="popular__tr">
								<div class="popular__delivery">Доставка</div>
								<div class="popular__date">Завтра</div>
							</div>
							<div class="popular__tr">
								<div class="popular__get">Самовывоз</div>
								<div class="popular__date">Сегодня</div>
							</div>
							<div class="popular__prices">
								<div class="popular__new"><?=number_format($price, 2, '.', ' ');?> ₽</div>
								<?if($old_price)
								{?>
								<div class="popular__old"><?=number_format($old_price, 2, '.', ' ');?> ₽</div>
								<?}?>
							</div>
							<div class="popular__add product-card__button" data-product="<?=$arResult['ITEMS'][$key + 1]['ID']?>" data-name="<?=$arResult['ITEMS'][$key + 1]['NAME']?>" data-price="<?=$arResult['ITEMS'][$key + 1]['PRICES']['Распродажа']['VALUE']?>">В корзину</div>
						</div>
					</div>
				</div>
					
					
					
				  
								 				  
			   <?endforeach?>
			   
			</div>
		</div>
		<div class="owl-dots disabled"></div>
	</div>
</div>
	</div>
</div>            
</div>