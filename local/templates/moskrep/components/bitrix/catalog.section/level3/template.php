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


<div class="sale-category">
    <table class="blue-table price-category">
	<thead class="blue-table__thead">
	    <tr class="blue-table__tr">
		<th class="blue-table__th blue-table__name"><span class='link-sorting'><span class="link-sorting__style">Наименование</span></span></a></th>
		<th class="blue-table__th"><span class='link-sorting'><span class="link-sorting__style">Артикул</span></span></a></th>
		<th class="blue-table__th"><span class='link-sorting'><span class="link-sorting__style">Размер,мм</span></span></a></th>
                <?if($ral_in_ar){?>
		<th class="blue-table__th"><span class='link-sorting'><span class="link-sorting__style">Цвет, RAL</span></span></a></th>
                <?}?>
                <th class="blue-table__th"><span class='link-sorting'><span class="link-sorting__style">Фасовка</span></span></a></th>
		<th class="blue-table__th blue-table__price"><span class='link-sorting'><span class="link-sorting__style">Стоимость</span></span></a></th>
		<th class="blue-table__th">Купить</th>
	    </tr>
	</thead>
	<tbody class="blue-table__tbody">
						
					
				
<?
		foreach ($arResult['ITEMS'] as $item)
		{
			
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
		<td class="blue-table__td blue-table__name"><a href="<?=$item['DETAIL_PAGE_URL']?>" target="_self" class="name-b"><?=$item['NAME']?></a></td>
		<td class="blue-table__td"><span class="articul-b"><?=$item['PROPERTIES']["CML2_ARTICLE"]["VALUE"]?></span></td>
		<td class="blue-table__td"><span class="size-b"><?=implode($size, 'x');?></span></td>
		<?if($ral_in_ar){?>
                <td class="blue-table__td"><div class="color-b"><i style="background: #<?=$array_rals[$item['PROPERTIES']["TSVET"]["VALUE"]]?>;"></i><?=$item['PROPERTIES']["TSVET"]["VALUE"]?></div></td>
                <?}?>
                <td class="blue-table__td"><span class="col-b"><?=$item['PROPERTIES']["KOLICHESTVO_V_UPAKOVKE"]["VALUE"]?> <?=$arResult['UNIT']?></span></td>
		<td class="blue-table__td blue-table__price">
		    <span class="price-b"><?echo number_format($price, 2, '.', ' ');?> ₽</span>
		<?echo ($item['CATALOG_QUANTITY']+$item['CATALOG_QUANTITY_RESERVED']) ? '<span class="availability-b active">В наличии</span>' : '<span class="availability-b">Под заказ</span>';?>
		</td>
		<td class="blue-table__td">
		    <div class="value">
			<a href="javascript:void(0)" class="value__minus">—</a>
			    <input type="text" id="QUANTITY_<?=$item['ID']?>" name="QUANTITY_<?=$item['ID']?>" value="1" class="value__input">
			<a href="javascript:void(0)" rel="nofollow" class="value__plus">+</a>
		    </div>
			<a href="javascript:void(0)" rel="nofollow" data-product="<?=$item['ID']?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>" rel="nofollow" class="blue-btn basket-btn">В корзину</a>
		</td>
	    </tr>
<?}?>
	</tbody>
    </table>
</div>
		