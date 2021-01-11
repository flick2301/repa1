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
<?
include($_SERVER["DOCUMENT_ROOT"]."/include/array_rals.php");
?>
<?
$ral_in_ar = $arResult['ITEMS'][0]['PROPERTIES']["TSVET"]["VALUE"];
?>
<h2 class="s22-title padding-20"><?=$arResult['NAME']?></h2>

<div class="sale-category">
    <table class="blue-table basket blue-table--first">
	<tbody class="blue-table__tbody">
            <?foreach ($arResult['ITEMS'] as $item):?>
            <?
            $price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_SALE_PRICE]['VALUE'] : $item['PRICES'][ID_BASE_PRICE]['VALUE'];
            $old_price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_BASE_PRICE]['VALUE'] : 0;
            $size = array(
                $item['PROPERTIES']["DIAMETR"]["VALUE"],
                $item['PROPERTIES']["VYSOTA"]["VALUE"],
                $item['PROPERTIES']["SHIRINA"]["VALUE"],
                $item['PROPERTIES']["DLINA"]["VALUE"],
            );
            $size = array_diff($size, array(''));
            ?>
            <tr class="blue-table__tr">
		<td class="blue-table__td">
                    <div class="basket-infomedia">
			<div class="infomedia__img"><a target="_self" href="<?=$item['DETAIL_PAGE_URL']?>"><img src="<?=$item['PREVIEW_PICTURE']['src']?>" alt=""></a></div>
			<div class="infomedia__text">
                            <a href="<?=$item['DETAIL_PAGE_URL']?>" target="_self" class="infomedia__link"><?=$item['NAME']?></a>
                            <span class="carousel-product__price"><?echo number_format($price, 2, '.', ' ');?> ₽ <span class="carousel-product__price-wrap"><?if($old_price){?><span class="carousel-product__price-old"><?echo number_format($old_price, 2, '.', ' ');?> ₽</span><?}?></span></span>
                            <span class="availability-b<?echo ($item['CATALOG_QUANTITY']+$item['CATALOG_QUANTITY_RESERVED']) ? " active" : "";?>"><? echo ($item['CATALOG_QUANTITY']+$item['CATALOG_QUANTITY_RESERVED']) ? "В наличии" : "Нет в наличии";?></span>
                            <span class="infomedia__articul">Артикул: <span><?=$item['PROPERTIES']["CML2_ARTICLE"]["VALUE"]?></span></span>
                            <span class="infomedia__size">Размер, мм: <span><?=implode($size, 'x');?></span></span>
                            <?if($ral_in_ar):?>
                            <span class="infomedia__massa">Цвет, RAL: <div class="color-b"><i style="background: #<?=$array_rals[$item['PROPERTIES']["TSVET"]["VALUE"]]?>;"></i><?=$item['PROPERTIES']["TSVET"]["VALUE"]?></div></span>
                            <?endif;?>
                            <span class="infomedia__massa">Фасовка, шт: <span><?=$item['PROPERTIES']["KOLICHESTVO_V_UPAKOVKE"]["VALUE"]?></span></span>
                            <a href="javascript:void(0);" data-product="<?=$item['ID']?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>" class="blue-btn basket-btn">В корзину</a>
			</div>
                    </div>
		</td>
            </tr>
	<?endforeach;?>
            <tr class="blue-table__tr">
		<td class="blue-table__td">
                    <a href="<?=$arResult['SECTION_PAGE_URL']?>" target="_self" class="all-size-btn">Показать все размеры</a>
		
                </td>
                
            </tr>
	</tbody>
    </table>
</div>


		