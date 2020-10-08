<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */
global $APPLICATION
?>
<?include($_SERVER["DOCUMENT_ROOT"]."/include/array_rals.php");?>
<?$ral_in_ar = $arResult['ITEMS'][0]['PROPERTIES']["TSVET"]["VALUE"];?>
<?$APPLICATION->SetPageProperty('title', $arResult["NAME"].", цена - купить в интернет-магазине в Москве");?>


<h1 class="s38-title"><?=$arResult['TITLE']?></h1>

<div class="set-default-parametr-page-cat"><p><?=$arResult['TEXT'];?></p></div>

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
<a href="<?=$APPLICATION->GetCurPageParam('FIELD1=shows&ORDER1=asc', array('FIELD1', 'ORDER1', 'FIELD2', 'ORDER2'))?>" id="sort_shows_asc"></a>
<a href="<?=$APPLICATION->GetCurPageParam('FIELD1=CATALOG_PRICE_9&ORDER1=asc', array('FIELD1', 'ORDER1', 'FIELD2', 'ORDER2'))?>" id="sort_price_asc"></a>
<a href="<?=$APPLICATION->GetCurPageParam('FIELD1=CATALOG_PRICE_9&ORDER1=desc', array('FIELD1', 'ORDER1', 'FIELD2', 'ORDER2'))?>" id="sort_price_desc"></a>
<a href="<?=$APPLICATION->GetCurPageParam('FIELD1=property_DIAMETR&ORDER1=asc&FIELD2=property_DLINA&ORDER2=asc', array('FIELD1', 'ORDER1', 'FIELD2', 'ORDER2'))?>" id="sort_size_asc"></a>

    <ul class="product-list__items product-list__items--card">
	
    
						
					
				
<?

  
    foreach ($arResult['ITEMS'] as $item)
    {
        
        $price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_SALE_PRICE]['VALUE'] : $item['PRICES'][ID_BASE_PRICE]['VALUE'];
        $old_price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_BASE_PRICE]['VALUE'] : 0;
        
        $ar_size = array(
            $item['PROPERTIES']["DIAMETR"]["VALUE"],
            $item['PROPERTIES']["VYSOTA"]["VALUE"],
            $item['PROPERTIES']["SHIRINA"]["VALUE"],
            $item['PROPERTIES']["DLINA"]["VALUE"],
        );
        $size = array_diff($ar_size, ['']);
?>
        
        <li class="product-list__item">
            
					<a href="<?=$item['DETAIL_PAGE_URL']?>" target="_self" class="product-list__img"><?if($item['PROPERTIES']['novelty']['VALUE_XML_ID']=='Y'){?><div class="product-list__novelty">Новинка</div><?}?><img src="<?=$item['PREVIEW_PICTURE']['src']?>" alt=""></a>
					<a href="<?=$item['DETAIL_PAGE_URL']?>" target="_self"  class="product-list__title"><?=$item['NAME']?></a>
					<div class="product-list__lineflex">
						<div class="product-list__delivery">Доставка <span class="product-list__day">Завтра</span></div>
						<div class="product-list__presence"><?echo ($item['CATALOG_QUANTITY']+$item['CATALOG_QUANTITY_RESERVED']) ? 'В наличии' : 'Под заказ';?></div>
					</div>
					<div class="product-list__lineflex">
						<div class="product-list__pickup">Самовывоз <span class="product-list__day">Сегодня</span></div>
						<div class="product-list__presence-number<?echo ($item['CATALOG_QUANTITY']+$item['CATALOG_QUANTITY_RESERVED']=='0') ? "_disable" : "";?>"><?echo $item['CATALOG_QUANTITY']+$item['CATALOG_QUANTITY_RESERVED'];?> уп.</div>
					</div>
					<div class="product-list__lineflex">
						<div class="product-list__price"><?echo number_format($price, 2, '.', ' ');?> ₽
                                                  <?echo ($old_price) ? '<span class="carousel-product__price-old">'.number_format($old_price, 2, '.', ' ').' ₽</span>': '';?> 
                                                </div>
						<a href="javascript:void(0)" data-product="<?=$item['ID']?>" old-price="<?=$price?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>" rel="nofollow" class="product-list__btn blue-btn">В корзину</a>
					</div>
	</li>
        
                                                   
						
			
			<?
		}
		?>

					
    </ul>
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




<script>
$('.amount__select').on('change', function() {
        $('.amount__info').text($(".amount__select option:selected").text());
        
        $('#'+this.value).click();
        $(".amount__select :contains('Сначала по цене')").attr("selected", "selected"); 
        
});
$(".amount__select :contains('"+$('.amount__info').text()+"')").attr("selected", "selected");
</script>

		