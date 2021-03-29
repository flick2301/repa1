<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */
global $APPLICATION;
global $DEFAULT_STORE_ID;
?>
<?include($_SERVER["DOCUMENT_ROOT"]."/include/array_rals.php");?>
<?$ral_in_ar = $arResult['ITEMS'][0]['PROPERTIES']["TSVET"]["VALUE"];?>

<?
$showTopPager = $arParams["DISPLAY_TOP_PAGER"];
$showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
$showLazyLoad = false;

if ($arParams['PAGE_ELEMENT_COUNT'] > 0 && $navParams['NavPageCount'] > 1)
{
	$showTopPager = $arParams['DISPLAY_TOP_PAGER'];
	$showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
	$showLazyLoad = $arParams['LAZY_LOAD'] === 'Y' && $navParams['NavPageNomer'] != $navParams['NavPageCount'];
}

//ШАПКА ТАБЛИЦЫ
?>

    <!--catalog-feed-->
    <div class="basic-layout__module catalog-feed">
	
	
    
		
	
	
		<div class="catalog-feed__list">			
	<?
	
    foreach ($arResult['ITEMS'] as $item)
    {
        
        $price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_SALE_PRICE]['VALUE'] : $item['MIN_PRICE']['VALUE'];
        $old_price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_BASE_PRICE]['VALUE'] : 0;
        
        $ar_size = array(
            $item['PROPERTIES']["DIAMETR"]["VALUE"],
            $item['PROPERTIES']["VYSOTA"]["VALUE"],
            $item['PROPERTIES']["SHIRINA"]["VALUE"],
            $item['PROPERTIES']["DLINA"]["VALUE"],
        );
        $size = array_diff($ar_size, ['']);
?>

			<div class="catalog-feed__item">
                     <!--product-card-->
                     <section class="product-card">
                        <div class="product-card__header">
                           <h3 class="product-card__title"><a class="product-card__link" href="<?=$item['DETAIL_PAGE_URL']?>" title='<?=$item['IPROPERTY_VALUES']['TITLE_HREF_MINI_CART']?>' target="_self" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($item['NAME']))?>')"><?=$item['NAME']?></a></h3>
                           <img class="product-card__image" src="<?=$item['PREVIEW_PICTURE']['src']?>"  height="150" alt="<?=$item['NAME']?>">
                        </div>
                        <div class="product-card__content">
                           <div class="product-card__block">
                              <p class="product-card__delivery"><i class="simple-car-icon product-card__icon"></i><span class="product-card__text">Доставка</span><span class="product-card__date">Завтра</span></p>
                              <p class="product-card__delivery"><i class="simple-home-icon product-card__icon"></i><span class="product-card__text">Самовывоз</span><span class="product-card__date">Сегодня</span></p>
                           </div>
                           <div class="product-card__block">
                              <p class="product-card__available"><span class="product-card__state"><?echo ($item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']) ? 'В наличии' : 'Под заказ';?></span></p>
                              <p class="product-card__available"><i class="simple-state-yes-icon product-card__icon product-card__icon--state"></i><span class="product-card__text"><?echo $item['STORE'][$DEFAULT_STORE_ID]['AMOUNT'];?> уп.</span></p>
                           </div>
                        </div>
                        <div class="product-card__footer">
                           <div class="product-card__price"><?echo number_format($price, 2, '.', ' ');?> ₽</div>
                           <button data-quantity="<?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?>" data-product="<?=$item['ID']?>" old-price="<?=$price?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>" class="main-button main-button--mini product-card__button">В корзину</button>
                        </div>
                     </section>
                     <!--product-card-->
            </div>
          

                                                   
						
			
			<?
		}
		?>
		</div>

					
	</div>
<!--catalog-feed-->
<?
if ($showBottomPager)
{
	?>
	
		<!-- pagination-container -->
		<?=$arResult['NAV_STRING']?>
		<!-- pagination-container -->
	
	<?
}
?>


<br>
<br>


		