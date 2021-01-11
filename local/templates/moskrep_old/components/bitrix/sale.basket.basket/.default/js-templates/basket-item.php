<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $mobileColumns
 * @var array $arParams
 * @var string $templateFolder
 */

$usePriceInAdditionalColumn = in_array('PRICE', $arParams['COLUMNS_LIST']) && $arParams['PRICE_DISPLAY_MODE'] === 'Y';
$useSumColumn = in_array('SUM', $arParams['COLUMNS_LIST']);
$useActionColumn = in_array('DELETE', $arParams['COLUMNS_LIST']);

$restoreColSpan = 2 + $usePriceInAdditionalColumn + $useSumColumn + $useActionColumn;

$positionClassMap = array(
	'left' => 'basket-item-label-left',
	'center' => 'basket-item-label-center',
	'right' => 'basket-item-label-right',
	'bottom' => 'basket-item-label-bottom',
	'middle' => 'basket-item-label-middle',
	'top' => 'basket-item-label-top'
);
$sss=2;
$discountPositionClass = '';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
	{
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$labelPositionClass = '';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
	{
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}
?>

<script id="basket-item-template" type="text/html">
    
	<tr class="blue-table__tr" id="basket-item-{{ID}}" data-entity="basket-item" data-id="{{ID}}">
		{{^SHOW_RESTORE}}
            <td class="blue-table__td">
		<div class="basket-infomedia">
                    {{#SHOW_LOADING}}
			<div class="basket-items-list-item-overlay"></div>
		    {{/SHOW_LOADING}}
		    <div class="infomedia__img"><a href="{{DETAIL_PAGE_URL}}"><img src="{{{IMAGE_URL}}}{{^IMAGE_URL}}<?=$templateFolder?>/images/no_photo.png{{/IMAGE_URL}}" alt=""></a></div>
		    <div class="infomedia__text">
			<a href="{{DETAIL_PAGE_URL}}" class="infomedia__link">{{NAME}}</a>
			<span class="infomedia__articul">Артикул: {{ARTICLE}}</span>
		    </div>
		</div>
	    </td>
	    <td class="blue-table__td"><div class="t-basket-price">{{{PRICE_NUMBER_FORMAT}}}</div></td>
            <td class="blue-table__td"><div class="t-basket-kg">{{WEIGHT}}</div></td>
            <td class="blue-table__td">
		<div class="value t-basket-value" data-entity="basket-item-quantity-block">
		    <a href='javascript:void(0);' class="value__minus_basket" data-entity="basket-item-quantity-minus">—</a>
		    <input type="text" class="value__input" value="{{QUANTITY}}"
							{{#NOT_AVAILABLE}} disabled="disabled"{{/NOT_AVAILABLE}}
							data-value="{{QUANTITY}}" data-entity="basket-item-quantity-field"
							id="basket-item-quantity-{{ID}}">
		    <a href='javascript:void(0);' class="value__plus_basket" data-entity="basket-item-quantity-plus">+</a>
		</div>
	    </td>
            
            <td class="blue-table__td"><div class="t-basket-price">{{SUM_PRICE}}</div></td>
        
            <td class="blue-table__td"><span class="t-basket-delete" data-entity="basket-item-delete"></span></td>
		
		
			
			
			
		
		{{/SHOW_RESTORE}}
	</tr>
</script>