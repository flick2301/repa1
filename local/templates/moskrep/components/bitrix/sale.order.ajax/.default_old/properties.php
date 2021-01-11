<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Localization\Loc;

foreach ($arResult['PERSON_TYPE'] as $person) {
    if ($person['CHECKED'] == 'Y') {
        echo '<input type="hidden" name="PERSON_TYPE" value="' . $person['ID'] . '">';
    }
}

PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_HIDDEN"], $arResult, true);

switch ($arResult['ORDER_STEP']) {
    case 1:
        ?>

        <div class="checkout__form">
            <div class="form__container <?= $_POST['is_ajax_post'] == 'Y' ? 'opacity_04' : '' ?>">
                <div class="form__inner">
                    <? PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_BEFORE_TYPE"], $arResult); ?>
                </div>
            </div>
            <div class="form__error"></div>
            <? if ($_POST['is_ajax_post'] != 'Y') { ?>
                <a href="" class="btn btn_yellow btn_large js-delivery-toggle js-delivery-toggle-unused" onclick="yaCounter24179866.reachGoal('delivery_step_city', { 'city': $('input[name=ORDER_PROP_11]').val()});">Продолжить</a>
            <? } else { ?>
                <a href="" class="btn btn_yellow btn_large js-delivery-toggle">Изменить страну и город</a>
            <? } ?>
        </div>
        <?
        break;
    case 2:
        ?>
		<? if($arResult['ORDER_DATA']['DELIVERY_ID'] == 25){$target='delivery_type_pickup';}elseif($arResult['ORDER_DATA']['DELIVERY_ID'] == 27){$target='delivery_type_shop';}elseif($arResult['ORDER_DATA']['DELIVERY_ID'] == 28){$target='delivery_type_courier';}elseif($arResult['ORDER_DATA']['DELIVERY_ID'] == 29){$target='delivery_type_dellin';}elseif($arResult['ORDER_DATA']['DELIVERY_ID'] == 32){$target='delivery_type_postal';}?>
       
		<div class="checkout__form">
            <div class="form__container">
                <div class="form__inner">
                    <? PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_AFTER_TYPE"], $arResult); ?>
					
                </div>
            </div>
        </div>
		
        <?
        break;
    case 3:
        break;
}