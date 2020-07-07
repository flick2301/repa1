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
<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "sale", Array()); ?>
<h1 class="s38-title"><?=($arResult['SALE_H1'] ? $arResult['SALE_H1'] : $arResult['NAME'])?></h1>

<div class="sale-category">
    <div class="sale-category__info">
	<a href="<?=$arResult['SALE_PRICE_LINK']?>" class="download-excel">Скачать прайс</a>
	<div class="sale-category__date">Распродажа <span><?=$arResult['SALE_PRICE_DATE']?></span></div>
	<a href="<?=$arResult['OVER_URL']?>" class="link-all"><?=$arResult['ALL']?> <?=strtolower($arResult['NAME']);?></a>
    </div>
    <table class="blue-table price-category">
	<thead class="blue-table__thead">
            <tr class="blue-table__tr">
		<th  class="blue-table__th blue-table__name"><span class='link-sorting'><span class="link-sorting__style">Наименование</span></span></th>
		<th class="blue-table__th"><span class='link-sorting'><span class="link-sorting__style">Артикул</span></span></th>
		<th class="blue-table__th"><span class='link-sorting'><span class="link-sorting__style">Размер, мм</span></span></th>
            <?if($ral_in_ar){?>
		<th class="blue-table__th"><span class='link-sorting'><span class="link-sorting__style">Цвет, RAL</span></span></th>
            <?}?>
                <th class="blue-table__th"><span class='link-sorting'><span class="link-sorting__style">Фасовка</span></span></th>
		<th class="blue-table__th blue-table__price"><span class='link-sorting'><span class="link-sorting__style">Стоимость</span></span></th>
		<th class="blue-table__th">Купить</th>
	    </tr>
	</thead>
    <tbody class="blue-table__tbody">
						
					
				
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
        
        
        <tr class="blue-table__tr">
	    <td class="blue-table__td blue-table__name"><a href="<?=$item['DETAIL_PAGE_URL']?>" target="_self" class="name-b"><?=$item['NAME']?></a></td>
	    <td class="blue-table__td"><span class="articul-b"><?=$item['PROPERTIES']["CML2_ARTICLE"]["VALUE"]?></span></td>
	    <td class="blue-table__td"><span class="size-b"><?=implode($size, 'x');?></span></td>
	<?if($ral_in_ar){?>
            <td class="blue-table__td"><div class="color-b"><i style="background: #<?=$array_rals[$item['PROPERTIES']["TSVET"]["VALUE"]]?>;"></i><?=$item['PROPERTIES']["TSVET"]["VALUE"]?></div></td>
        <?}?>
            <td class="blue-table__td"><span class="col-b"><?=$item['PROPERTIES']["KOLICHESTVO_V_UPAKOVKE"]["VALUE"]?> <?=$item['UNIT']?></span></td>
	    <td class="blue-table__td blue-table__price">
	        <span class="price-b"><?echo number_format($price, 2, '.', ' ');?> ₽</span>
                <?echo ($old_price) ? '<span class="carousel-product__price-old">'.number_format($old_price, 2, '.', ' ').' ₽</span>': '';?>
		<?echo ($item['CATALOG_QUANTITY']+$item['CATALOG_QUANTITY_RESERVED']) ? '<span class="availability-b active">В наличии</span>' : '<span class="availability-b">Под заказ</span>';?>
            </td>
	    <td class="blue-table__td">
		<div class="value">
		    <a href="#" class="value__minus" rel="nofollow">—</a>
			<input type="text" name="" id="QUANTITY_<?=$item['ID']?>" value="1" class="value__input">
		    <a href="#" class="value__plus" rel="nofollow">+</a>
		</div>
		<a href="javascript:void(0)" data-product="<?=$item['ID']?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>" rel="nofollow" class="blue-btn basket-btn">В корзину</a>
	    </td>
	</tr>
                                                        
						
			
			<?
		}
		?>

					
    </tbody>
</table>
</div>

	