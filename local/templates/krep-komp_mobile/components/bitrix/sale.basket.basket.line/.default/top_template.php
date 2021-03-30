<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Localization\Loc;

$showBasket = ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y');
?>

<a onclick="dataLayerToBasket()" href="<?if($arResult['NUM_PRODUCTS'] > 0):?><?= $arParams['PATH_TO_BASKET'] ?><?else:?>javascript:void(0);<?endif?>" class="<?if($arResult['NUM_PRODUCTS'] <= 0):?>noitems<?endif?>">
	Корзина
	<span><?= $arResult['NUM_PRODUCTS'] ?></span>
</a>