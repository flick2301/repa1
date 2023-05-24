<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Localization\Loc;

$showBasket = ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y');
?>

							<a onclick="dataLayerToBasket()" class="navbar__link" href="<?if($arResult['NUM_PRODUCTS'] > 0):?><?= $arParams['PATH_TO_BASKET'] ?><?else:?>javascript:void(0);<?endif?>">
								<svg class="navbar__icon" aria-hidden="true" width="26" height="20" viewBox="0 0 26 20" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1 1H5.58839L7.64523 7.58037M7.64523 7.58037L9.33931 17.342C9.50562 18.3003 10.3372 19 11.3099 19H20.52C21.4332 19 22.2304 18.3814 22.4573 17.4968L25 7.58037H7.64523Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>                
								<span>Корзина <span class="navbar__basket-count" aria-label="Количество товаров в корзине - <?= $arResult['NUM_PRODUCTS'] ?>"><?= $arResult['NUM_PRODUCTS'] ?></span></span>
							</a>
