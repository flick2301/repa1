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

<?$APPLICATION->SetPageProperty('title', $arResult["NAME"].", цена - купить в интернет-магазине в Москве");?>

<?if(count($arResult['RELINK'])):?>
<?php $this->SetViewTarget('RELINK'); ?>
<!--see-also-widget-->
	<div class="basic-layout__module see-also-widget">
               <h4 class="see-also-widget__title">Сопутствующие товары:</h4>
               <ul class="see-also-widget__list">
				<?foreach($arResult['RELINK'] as $relink):?>
                  <li class="see-also-widget__item">
                     <a class="see-also-widget__link" href="<?=$relink['AKCEPTOR']?>"><?=$relink['ANKOR']?></a>
                  </li>
				<?endforeach;?>
				</ul>
    </div>
	<!--see-also-widget-->

<?php $this->EndViewTarget(); ?>
<?endif;?>
<?php
//Параметр FOR_SEO устанавливается если это раздел справочника, а не каталога
//А значит текст и заголовок(шапка) не берутся из каталога, а из справочника, значит условие FOR_SEO != Y
if($arParams['FOR_SEO']!='Y'){?>
<!--page-heading-->
    <header class="basic-layout__module page-heading">
        <h1 class="page-heading__title"><?=($arResult['META_TITLE']) ? $arResult['META_TITLE'] :$arResult['NAME'];?></h1>
    </header>
<!--page-heading-->
<?if($arResult['DESCRIPTION']):?>
<!--catalog-desc-->
            <div class="basic-layout__module catalog-desc">
               <div class="catalog-desc__cover">
                  <img class="catalog-desc__image" src="<?=$arResult['PICTURE']['SRC']?>" width="226" height="170" alt="<?=$arResult['NAME']?>">
               </div>
               <p class="catalog-desc__about"><?=html_entity_decode($arResult['DESCRIPTION'], ENT_QUOTES, "UTF-8");?></p>
            </div>
<!--catalog-desc-->
<?endif;?>
<?}
	?>


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
                           <h3 class="product-card__title"><a class="product-card__link" href="<?=$item['DETAIL_PAGE_URL']?>" title='<?=$item['IPROPERTY_VALUES']['TITLE_HREF_MINI_CART']?>' target="_self"><?=$item['NAME']?></a></h3>
                           <img class="product-card__image" src="<?=$item['PREVIEW_PICTURE']['src']?>" width="200" height="150" alt="">
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
                           <button onclick="dataLayerAddBasket('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($item['NAME']))?>', '<?=$price?>', 1)" data-quantity="<?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?>" data-product="<?=$item['ID']?>" old-price="<?=$price?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>" class="main-button main-button--mini product-card__button">В корзину</button>
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

<?


if($arResult["UF_RELATED"]){
?>
<div class="catalog-feed__other">
<ul class="card-nav-product"><?
$arFilter = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], "ID"=>$arResult["UF_RELATED"], false, array("*"));
$db_list = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, true);
while($arSection = $db_list->GetNext()) {
    $renderImage = CFile::ResizeImageGet($arSection["PICTURE"], Array("width" => 72, "height" => 72), BX_RESIZE_IMAGE_EXACT, false); 
    ?>
		<div class="catalog-feed__child">
                     <!--category-card-->
                     <div class="category-card">
                        <p class="category-card__title"><a class="category-card__link" href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?><</a></p>
                        <div class="category-card__cover">
                           <img class="category-card__image" src="<?=$renderImage['src']?>" width="120" height="76" alt=""> 
                        </div>
                     </div>
                     <!--category-card-->
		</div>
	<?
}
?>
</div>
<?}?>
<?if($arResult['UF_DETAIL_TEXT']):?>
<!--simple-article-->
            <div class="basic-layout__module simple-article">
               <div class="simple-article__content wysiwyg-block">
			   <?=html_entity_decode($arResult['UF_DETAIL_TEXT'], ENT_QUOTES, "UTF-8");?>
			   </div>
            </div>
            <!--simple-article-->
<?endif;?>

<br>
<br>


		