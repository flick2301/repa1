<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 */
?>




<script id="basket-total-template" type="text/html">
               <ul class="in-cart-total__list" data-entity="basket-checkout-aligner">
                  <li class="in-cart-total__item">
                     <p class="in-cart-total__name">Общий вес</p>
                     <p class="in-cart-total__text">{{{WEIGHT_FORMATED}}}</p>
                  </li>
                  <li class="in-cart-total__item">
                     <p class="in-cart-total__name">Стоимость</p>
                     <p class="in-cart-total__text" data-entity="basket-total-price">{{{PRICE_FORMATED}}} ₽</p>
                  </li>
               </ul>
               <div class="in-cart-total__footer">
                  <a class="main-button main-button--plus in-cart-total__submit" data-entity="basket-checkout-button" href="javascript:void(0);">Оформить заказ</a>
               </div>
</script>