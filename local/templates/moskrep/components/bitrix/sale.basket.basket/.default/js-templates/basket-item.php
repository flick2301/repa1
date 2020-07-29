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
<script>console.log({{ID}});</script>
<script id="basket-item-template" type="text/html">




                  <div class="catalog-feed__table" id="basket-item-{{ID}}" data-entity="basket-item" data-id="{{ID}}">
{{^SHOW_RESTORE}}

                    {{#SHOW_LOADING}}
			<div class="basket-items-list-item-overlay"></div>
		    {{/SHOW_LOADING}}
			
                     <!--cart-table-->
                     <section class="cart-table">
                        <div class="cart-table__column cart-table__column--global">
                           <div class="cart-table__title">Наименование<small>:</small></div>
                           <div class="cart-table__content">
                              <!--product-in-table-->
                              <div class="product-in-table">
                                 <div class="product-in-table__about">
                                    <h3 class="product-in-table__title"><a class="product-in-table__link" href="{{DETAIL_PAGE_URL}}">{{NAME}}</a></h3>
                                    <p class="product-in-table__number">Артикул: {{ARTICLE}}</p>
                                 </div>
                                 <div class="product-in-table__cover">
                                    <img class="product-in-table__image" src="{{{IMAGE_URL}}}{{^IMAGE_URL}}<?=$templateFolder?>/images/no_photo.png{{/IMAGE_URL}}" width="107" height="80" alt="{{NAME}}">
                                 </div>
                              </div>
                              <!--product-in-table-->
                           </div>
                        </div>
                        <div class="cart-table__column cart-table__column--basic">
                           <div class="cart-table__title">Цена<small>:</small></div>
                           <div class="cart-table__content">
                              <p class="cart-table__price">{{{PRICE_NUMBER_FORMAT}}} ₽</p>
                           </div>
                        </div>
                        <div class="cart-table__column cart-table__column--basic">
                           <div class="cart-table__title">Вес / Объём<small>:</small></div>
                           <div class="cart-table__content">
                              <p class="cart-table__desc">{{WEIGHT}}</p>
                           </div>
                        </div>
                        <div class="cart-table__column cart-table__column--value">
                           <div class="cart-table__title">Количество<small>:</small></div>
                           <div class="cart-table__content">
                              <!--change-value-->
                              <div class="change-value" data-entity="basket-item-quantity-block">
                                 <button class="change-value__button change-value__button--minus" data-entity="basket-item-quantity-minus">−</button>
                                 <input class="change-value__input" type="text" name="change-value__input" value="{{QUANTITY}}" {{#NOT_AVAILABLE}} disabled="disabled"{{/NOT_AVAILABLE}}
							data-value="{{QUANTITY}}" data-entity="basket-item-quantity-field"
							id="basket-item-quantity-{{ID}}">
                                 <button class="change-value__button change-value__button--plus" data-entity="basket-item-quantity-plus">+</button>
                              </div>
                              <!--change-value-->
                           </div>
                        </div>
                        <div class="cart-table__column cart-table__column--total">
                           <div class="cart-table__title">Сумма<small>:</small></div>
                           <div class="cart-table__content">
                              <p class="cart-table__total">{{SUM_PRICE}} ₽</p>
                           </div>
                        </div>
                        <div class="cart-table__column cart-table__column--delete">
                           <div class="cart-table__title">Удалить</div>
                           <div class="cart-table__content">
                              <button class="catalog-table__delete" data-entity="basket-item-delete"><i class="colored-close-icon catalog-table__delete"></i></button>
                           </div>
                        </div>
                     </section>
                     <!--cart-table-->
					 {{/SHOW_RESTORE}}
                  </div>
				  
</script>