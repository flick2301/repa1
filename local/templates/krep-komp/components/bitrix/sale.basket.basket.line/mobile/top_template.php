<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Localization\Loc;

$showBasket = ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y');
?>


	<span><?= $arResult['NUM_PRODUCTS'] ?></span>
