<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Localization\Loc;

$showBasket = ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y');
?>

<a href="<?= $arParams['PATH_TO_BASKET'] ?>" class="header-basket__link"><span class="header-basket__summ"><?= $arResult['NUM_PRODUCTS'] ?></span></a>