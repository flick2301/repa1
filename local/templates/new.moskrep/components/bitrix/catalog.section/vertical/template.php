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

<?if(!$_POST['ENUM_LIST']['ELEMENTS'] && !$arParams["DISABLE_HEADER"]=='Y'){?>
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

<?globalGetTitle($arResult['META_TITLE'] ? $arResult['META_TITLE'] : $arResult['NAME'])?>


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

<?}?>
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



<div id="shops-window"><div class="win"></div></div>
<div class="page_count_panel">

<div class="page_count_panel_viewblock">Показано <?=count($arResult['ITEMS'])?> из <?=$arResult['NAV_RESULT']->NavRecordCount?> товаров</div>



<div class="page_count_panel_block">


<a id="view_wholesale" href="javascript:void(0);" rel="nofollow" class="blue-btn page_count_panel_viewblock_btn">Оптовые скидки</a>


<select name="page_element_count" id="page_element_count">
	<?foreach(PAGE_ELEMENT_COUNT_NEW as $page_element_count)
	{?>
          <option value="<?=$page_element_count?>" <?=($arParams['PAGE_ELEMENT_COUNT'] == $page_element_count) ? 'selected="selected"' : '';?>>Показывать: по <?=$page_element_count?></option>
	<?}?>
</select>
</div>
</div>





    <!--catalog-feed-->
    <div class="basic-layout__module catalog-feed">
        <?php //require_once($_SERVER["DOCUMENT_ROOT"].'/test/temp_of_cart.php');?>
		<div class="catalog-feed__list catalog-feed__list_vi">			
	<?
	
    foreach ($arResult['ITEMS'] as $item)
    {
        
        $price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_SALE_PRICE]['VALUE'] : $item['MIN_PRICE']['VALUE'] ? $item['MIN_PRICE']['VALUE'] : $item['PRICES'][ID_BASE_PRICE]['VALUE'];
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
						
						<?if($item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']):?>
						<div class="product-card__content">
                           <div class="product-card__block">
                              <p class="product-card__delivery card_pickup" data-product="<?=$item['ID']?>"><i class="simple-home-icon product-card__icon"></i><span class="product-card__text">Самовывоз</span><span class="product-card__date">Сегодня</span></p>
                              <p class="product-card__delivery card_delivery" data-product="<?=$item['ID']?>"><i class="simple-car-icon product-card__icon"></i><span class="product-card__text">Доставка</span><span class="product-card__date">Завтра</span></p>
                           </div>
						</div> 
						<?endif;?>

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
<?php echo htmlspecialchars_decode($arParams['SECTIONS_LIST_TEMPLATE']);?>
<?if(!$arParams["DISABLE_HEADER"]=='Y'){?>
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
                        <p class="category-card__title"><a class="category-card__link" href="<?=$arSection['SECTION_PAGE_URL']?>" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($arSection['NAME']))?>')"><?=$arSection['NAME']?></a></p>
                        <div class="category-card__cover">
                           <img class="category-card__image" src="<?=$renderImage['src']?>" width="120" height="76" alt="<?=$arSection['NAME']?>"> 
                        </div>
                     </div>
                     <!--category-card-->
		</div>
	<?
}
?>
</div>
<?}?>
<?if($arResult['UF_DETAIL_TEXT'] && !($_REQUEST['PAGEN_1'] > 1)):?>
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
<?}?>
<?if($arResult['UF_INCLUDE_FILE_AFTER_DESC'])
{
	$APPLICATION->IncludeFile(SITE_DIR."/include/".$arResult['UF_INCLUDE_FILE_AFTER_DESC'], array("SHOW_BORDER" => true, "MODE"=>"html"));
}
?>

<?
//НУЖНО ВСТАВИТЬ КАЛЬКУЛЯТОР ДЛЯ ХИМ. КАРТРИДЖЕЙ
if($arResult['ORIGINAL_PARAMETERS']['SECTION_CODE']=='kartridzh')
    $APPLICATION->IncludeFile(SITE_DIR."/include/calculator.php", array("SHOW_BORDER" => true, "MODE"=>"html"));
?>