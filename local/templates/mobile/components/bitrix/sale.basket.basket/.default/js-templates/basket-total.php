<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 */
?>




<script id="basket-total-template" type="text/html">
<div class="basket-info" data-entity="basket-checkout-aligner">
		<ul class="basket-info__items">
		 
		    <li class="basket-info__item"><span><?=Loc::getMessage('SBB_WEIGHT')?>:</span><i></i><strong>{{{WEIGHT_FORMATED}}}</strong></li>
		    <li class="basket-info__item" ><span>Стоимость:</span><i></i><strong data-entity="basket-total-price">{{{PRICE_FORMATED}}}</strong></li>
		</ul>
		<a href="javascript:void(0);" data-entity="basket-checkout-button" class="yellow-btn">Оформить заказ</a>
		
	    </div>
</script>