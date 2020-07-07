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
<h1 class="s38-title"><?=$arResult['NAME']?></h1>

<div class="sale-category">
    <div class="sale-category__info">
	<a href="<?=$arResult['SALE_PRICE_FILE']?>" class="download-excel">Скачать прайс</a>
	<div class="sale-category__date">Распродажа <span><?=$arResult['SALE_PRICE_DATE']?></span></div>
	<a href="<?=$arResult['OVER_URL']?>" class="link-all">Все <?=$arResult['NAME']?></a>
    </div>
    <table class="blue-table price-category">
	<thead class="blue-table__thead">
            <tr class="blue-table__tr">
		<th class="blue-table__th"><a href="javascript:void(0);" class="link-sorting sorting-name"><span class="link-sorting__style sort-down">Наименование</span></a></th>
		<th class="blue-table__th"><a href="javascript:void(0);" class="link-sorting sorting-articul"><span class="link-sorting__style">Артикул</span></a></th>
		<th class="blue-table__th"><a href="javascript:void(0);" class="link-sorting sorting-size"><span class="link-sorting__style">Размер, мм</span></a></th>
            <?if($ral_in_ar){?>
		<th class="blue-table__th"><a href="javascript:void(0);" class="link-sorting sorting-color"><span class="link-sorting__style">Цвет, RAL</span></a></th>
            <?}?>
                <th class="blue-table__th"><a href="javascript:void(0);" class="link-sorting sorting-col"><span class="link-sorting__style">Фасовка, шт</span></a></th>
		<th class="blue-table__th"><a href="javascript:void(0);" class="link-sorting sorting-price"><span class="link-sorting__style">Стоимость</span></a></th>
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
	    <td class="blue-table__td"><a href="<?=$item['DETAIL_PAGE_URL']?>" target="_self" class="name-b"><?=$item['NAME']?></a></td>
	    <td class="blue-table__td"><span class="articul-b"><?=$item['PROPERTIES']["CML2_ARTICLE"]["VALUE"]?></span></td>
	    <td class="blue-table__td"><span class="size-b"><?=implode($size, 'x');?></span></td>
	<?if($ral_in_ar){?>
            <td class="blue-table__td"><div class="color-b"><i style="background: #<?=$array_rals[$item['PROPERTIES']["TSVET"]["VALUE"]]?>;"></i><?=$item['PROPERTIES']["TSVET"]["VALUE"]?></div></td>
        <?}?>
            <td class="blue-table__td"><span class="col-b"><?=$item['PROPERTIES']["KOLICHESTVO_V_UPAKOVKE"]["VALUE"]?></span></td>
	    <td class="blue-table__td">
	        <span class="price-b"><?echo number_format($price, 2, '.', ' ');?> ₽</span>
		<?echo ($item['CATALOG_QUANTITY']+$item['CATALOG_QUANTITY_RESERVED']) ? '<span class="availability-b active">В наличии</span>' : '<span class="availability-b">Нет в наличии</span>';?>
            </td>
	    <td class="blue-table__td">
		<div class="value">
		    <a href="#" class="value__minus">—</a>
			<input type="text" name="" id="QUANTITY_<?=$item['ID']?>" value="1" class="value__input">
		    <a href="#" class="value__plus">+</a>
		</div>
		<a href="javascript:void(0)" data-product="<?=$item['ID']?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>" class="blue-btn basket-btn">В корзину</a>
	    </td>
	</tr>
                                                        
						
			
			<?
		}
		?>

					
    </tbody>
</table>
</div>

<div class="content-feedback">
<?$APPLICATION->IncludeComponent(
	"d7:main.feedback",
	"",
	Array(
		"EMAIL_TO" => $arResult["SITE_EMAIL"],
		"EVENT_MESSAGE_ID" => array("7"),
		"OK_TEXT" => "Спасибо, ваше сообщение отправлено.",
		"REQUIRED_FIELDS" => array("NAME","EMAIL","MESSAGE"),
		"USE_CAPTCHA" => "N"
	)
);?> 
</div>		