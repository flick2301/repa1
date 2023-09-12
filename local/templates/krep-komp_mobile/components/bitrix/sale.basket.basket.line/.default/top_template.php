<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Localization\Loc;

$showBasket = ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y');
?>

							<a onclick="dataLayerToBasket()" class="mobile-navbar__link" href="<?if($arResult['NUM_PRODUCTS'] > 0):?><?= $arParams['PATH_TO_BASKET'] ?><?else:?>javascript:void(0);<?endif?>">
								<svg class="mobile-navbar__icon mobile-navbar__icon--basket" aria-hidden="true" width="28" height="21" viewBox="0 0 28 21" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1.625 1.70306H6.35678L8.4779 8.00925M8.4779 8.00925L10.2167 17.3202C10.3935 18.2668 11.2198 18.9531 12.1827 18.9531H21.8324C22.7321 18.9531 23.5211 18.3523 23.7604 17.485L26.375 8.00925H8.4779Z" stroke="#552FEC" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
								<span>Корзина <span class="mobile-navbar__basket-count" aria-label="Количество товаров в корзине - <?= $arResult['NUM_PRODUCTS'] ?>"><?= $arResult['NUM_PRODUCTS'] ?></span></span>
							</a>