<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Localization\Loc;

$showBasket = ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y');
?>

<a href="<?if($arResult['NUM_PRODUCTS'] > 0):?><?= $arParams['PATH_TO_BASKET'] ?><?else:?>javascript:void(0);<?endif?>" class="client-widget__link <?if($arResult['NUM_PRODUCTS'] <= 0):?>noitems<?endif?>"><i class="colored-cart-icon client-widget__icon"></i>Корзина<small class="client-widget__amount header-basket__summ"><?= $arResult['NUM_PRODUCTS'] ?></small></a>