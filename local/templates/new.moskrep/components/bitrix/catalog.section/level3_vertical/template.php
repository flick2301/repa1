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


<div class="page_count_panel">

<div class="page_count_panel_viewblock">Показано <?=count($arResult['ITEMS'])?> из <?=$arResult['NAV_RESULT']->NavRecordCount?> товаров</div>



<div class="page_count_panel_block">


<a id="view_wholesale" href="javascript:void(0);" rel="nofollow" class="blue-btn page_count_panel_viewblock_btn">Оптовые скидки</a>



<select name="page_element_count" id="page_element_count">
	<?foreach(PAGE_ELEMENT_COUNT as $page_element_count)
	{?>
          <option value="<?=$page_element_count?>" <?=($arParams['PAGE_ELEMENT_COUNT'] == $page_element_count) ? 'selected="selected"' : '';?>>Показывать: по <?=$page_element_count?></option>
	<?}?>
</select>
</div>
</div>




    <!--catalog-feed-->
    <div class="basic-layout__module catalog-feed">
	
	
    
		
	
	
		<div class="catalog-feed__list catalog-feed__list_vi">			
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

			<div class="catalog-feed__item catalog-feed__item_vi">
                     <!--product-card-->
                     <section class="product-card product-card_vi">
					 
						<div class="product-card__artno-blok">
							<p class="product-card__artno">Артикул: <span class="product-card__state product-card__state_artno"><?=$item['PROPERTIES']["CML2_ARTICLE"]["VALUE"]?></span></p>
						</div>  		
						
                        <div class="product-card__header product-card__header_vi">
                           <img class="product-card__image" src="<?=$item['PREVIEW_PICTURE']['src']?>"  height="150" alt="<?=$item['NAME']?>">
                         <h3 class="product-card__title product-card__title_vi"><a class="product-card__link product-card__link_vi" href="<?=$item['DETAIL_PAGE_URL']?>" title='<?=$item['IPROPERTY_VALUES']['TITLE_HREF_MINI_CART']?>' target="_self" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($item['NAME']))?>')"><?=$item['NAME']?></a></h3>						   
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


                        <div class="product-card__footer product-card__footer_vi">	
						   <p class="product-card__price-block product-card__price-block_vi">Цена (с НДС): <br /><span class="product-card__price product-card__price_vi"><?echo number_format($price, 2, '.', ' ');?> ₽</span></p>	

						

                           <button title="Добавить в корзину" data-quantity="<?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?>" data-product="<?=$item['ID']?>" old-price="<?=$price?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>" class="main-button main-button--mini product-card__button product-card__button_round">
						   </button>
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


		