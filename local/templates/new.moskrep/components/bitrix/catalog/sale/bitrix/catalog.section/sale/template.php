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


?>
<?
include($_SERVER["DOCUMENT_ROOT"]."/include/array_rals.php");
?>

<?
$ral_in_ar = $arResult['ITEMS'][0]['PROPERTIES']["TSVET"]["VALUE"];
?>

<?globalGetTitle($arResult['SALE_H1'] ? $arResult['SALE_H1'] : $arResult['NAME'])?>

<!--catalog-feed-->
            <div class="basic-layout__module catalog-feed">
				<div class="catalog-feed__about">
                  <!--download-file-->
                  <p class="download-file"><img class="download-file__icon" src="/local/templates/moskrep/assets/design/download-file/xls.svg" width="36" height="36" alt="Скачать прайс" title="Скачать прайс" /><a class="second-button second-button--mini download-file__button" href="<?=$arResult['SALE_PRICE_LINK']?>">Скачать прайс</a><span class="download-file__date"><?=$arResult['SALE_PRICE_DATE']?></span></p>
                  <!--download-file-->
                  <a href="<?=$arResult['OVER_URL']?>" class="other-button catalog-feed__more"><i class="simple-go-to-icon other-button__icon"></i>Перейти в каталог</a>
               </div>
			</div>
<!--catalog-feed-->
 
	<div class="catalog-feed__list">
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
	<!--
	<?var_dump($item);?>
	-->
	<div class="catalog-feed__table">
                     <!--catalog-table-->
                     <section class="catalog-table">
                        <div class="catalog-table__column catalog-table__column--global">
                           <div class="catalog-table__title">Наименование<small>:</small></div>
                           <h3 class="catalog-table__content"><a class="catalog-table__link catalog-table__link--product" href="<?=$item['DETAIL_PAGE_URL']?>" target="_self"><?=$item['NAME']?></a></h3>
                        </div>
                        <div class="catalog-table__column catalog-table__column--basic">
                           <div class="catalog-table__title">Артикул<small>:</small></div>
                           <div class="catalog-table__content">
                              <p class="catalog-table__desc"><?=$item['PROPERTIES']["CML2_ARTICLE"]["VALUE"]?></p>
                           </div>
                        </div>
                        <div class="catalog-table__column catalog-table__column--basic">
                           <div class="catalog-table__title">Размер, мм<small>:</small></div>
                           <div class="catalog-table__content">
                              <p class="catalog-table__desc"><?=implode($size, 'x');?></p>
                           </div>
                        </div>
                        <div class="catalog-table__column catalog-table__column--basic">
                           <div class="catalog-table__title">Фасовка<small>:</small></div>
                           <div class="catalog-table__content">
                              <p class="catalog-table__count"><?=$item['PROPERTIES']["KOLICHESTVO_V_UPAKOVKE"]["VALUE"]?> <?=$item['UNIT']?></p>
                           </div>
                        </div>
                        <div class="catalog-table__column catalog-table__column--to-cart">
                           <div class="catalog-table__title">Стоимость<small>:</small></div>
                           <div class="catalog-table__content catalog-table__content--to-cart">
                              <!--price-in-table-->
                              <div class="price-in-table">
                                 <p class="price-in-table__actual"><?echo number_format($price, 2, '.', ' ');?> ₽</p>
                                 <p class="price-in-table__state"><?=($item['CATALOG_QUANTITY']+$item['CATALOG_QUANTITY_RESERVED']) ? 'В наличии' : 'Под заказ';?></p>
                              </div>
                              <!--price-in-table-->
                              <button class="catalog-table__to-cart" data-product="<?=$item['ID']?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>" rel="nofollow"><i data-product="<?=$item['ID']?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>" rel="nofollow" class="colored-cart-icon catalog-table__cart"></i>Добавить в корзину</button>
                           </div>
                        </div>
                     </section>
                     <!--catalog-table-->
                  </div>
	<?}?>
	</div>

	
	
	
    

	