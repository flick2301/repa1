<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 */

$this->setFrameMode(true);
$this->addExternalCss('/bitrix/css/main/bootstrap.css');

global $APPLICATION;
global $DEFAULT_STORE_ID;

$templateLibrary = array('popup');
$currencyList = '';

if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList
);
unset($currencyList, $templateLibrary);

$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_CPV_TPL_ELEMENT_DELETE_CONFIRM'));

$positionClassMap = array(
	'left' => 'product-item-label-left',
	'center' => 'product-item-label-center',
	'right' => 'product-item-label-right',
	'bottom' => 'product-item-label-bottom',
	'middle' => 'product-item-label-middle',
	'top' => 'product-item-label-top'
);

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

$arParams['~MESS_BTN_BUY'] = $arParams['~MESS_BTN_BUY'] ?: Loc::getMessage('CT_CPV_TPL_MESS_BTN_BUY');
$arParams['~MESS_BTN_DETAIL'] = $arParams['~MESS_BTN_DETAIL'] ?: Loc::getMessage('CT_CPV_TPL_MESS_BTN_DETAIL');
$arParams['~MESS_BTN_COMPARE'] = $arParams['~MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_CPV_TPL_MESS_BTN_COMPARE');
$arParams['~MESS_BTN_SUBSCRIBE'] = $arParams['~MESS_BTN_SUBSCRIBE'] ?: Loc::getMessage('CT_CPV_TPL_MESS_BTN_SUBSCRIBE');
$arParams['~MESS_BTN_ADD_TO_BASKET'] = $arParams['~MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_CPV_TPL_MESS_BTN_ADD_TO_BASKET');
$arParams['~MESS_NOT_AVAILABLE'] = $arParams['~MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_CPV_TPL_MESS_PRODUCT_NOT_AVAILABLE');
$arParams['~MESS_SHOW_MAX_QUANTITY'] = $arParams['~MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_CPV_CATALOG_SHOW_MAX_QUANTITY');
$arParams['~MESS_RELATIVE_QUANTITY_MANY'] = $arParams['~MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_CPV_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['~MESS_RELATIVE_QUANTITY_FEW'] = $arParams['~MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_CPV_CATALOG_RELATIVE_QUANTITY_FEW');

$generalParams = array(
	'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
	'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
	'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
	'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
	'MESS_SHOW_MAX_QUANTITY' => $arParams['~MESS_SHOW_MAX_QUANTITY'],
	'MESS_RELATIVE_QUANTITY_MANY' => $arParams['~MESS_RELATIVE_QUANTITY_MANY'],
	'MESS_RELATIVE_QUANTITY_FEW' => $arParams['~MESS_RELATIVE_QUANTITY_FEW'],
	'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
	'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
	'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
	'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
	'ADD_PROPERTIES_TO_BASKET' => $arParams['ADD_PROPERTIES_TO_BASKET'],
	'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
	'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'],
	'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
	'COMPARE_PATH' => $arParams['COMPARE_PATH'],
	'COMPARE_NAME' => $arParams['COMPARE_NAME'],
	'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
	'PRODUCT_BLOCKS_ORDER' => $arParams['PRODUCT_BLOCKS_ORDER'],
	'LABEL_POSITION_CLASS' => $labelPositionClass,
	'DISCOUNT_POSITION_CLASS' => $discountPositionClass,
	'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
	'SLIDER_PROGRESS' => $arParams['SLIDER_PROGRESS'],
	'~BASKET_URL' => $arParams['~BASKET_URL'],
	'~ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
	'~BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE'],
	'~COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
	'~COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
	'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
	'MESS_BTN_BUY' => $arParams['~MESS_BTN_BUY'],
	'MESS_BTN_DETAIL' => $arParams['~MESS_BTN_DETAIL'],
	'MESS_BTN_COMPARE' => $arParams['~MESS_BTN_COMPARE'],
	'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
	'MESS_BTN_ADD_TO_BASKET' => $arParams['~MESS_BTN_ADD_TO_BASKET'],
	'MESS_NOT_AVAILABLE' => $arParams['~MESS_NOT_AVAILABLE']
);

$obName = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($this->randString()));
$containerName = 'catalog-products-viewed-container';
?>
<?if(!empty($arResult['ITEMS'])){?>
<h2 class='product-page__title'>Последние просмотренные товары</h2>
<!--catalog-feed-->
    <div class="basic-layout__module catalog-feed">

		<div class="product__list">
	<?
	
    foreach ($arResult['ITEMS'] as $key => $item)
    {
		
       //var_dump(ID_BASE_PRICE);
        $price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_SALE_PRICE]['VALUE'] : $item['MIN_PRICE']['VALUE'] ? $item['MIN_PRICE']['VALUE'] : $item['PRICES'][ID_BASE_PRICE]['VALUE'];
        $old_price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_BASE_PRICE]['VALUE'] : 0;
        //var_dump($price);
        $ar_size = array(
            $item['PROPERTIES']["DIAMETR"]["VALUE"],
            $item['PROPERTIES']["VYSOTA"]["VALUE"],
            $item['PROPERTIES']["SHIRINA"]["VALUE"],
            $item['PROPERTIES']["DLINA"]["VALUE"],
        );
        $size = array_diff($ar_size, ['']);
?>


				


			<div class="product__box">
                     <!--product-card-->
                <div class="product__top">
                    <div class="product__topside">
                        <div class="product__article">Артикул <span><?=$item['PROPERTIES']["CML2_ARTICLE"]["VALUE"]?></span></div>
                        <div class="product__deliveries">
                            <div class="product__delivery card_pickup" data-product="<?=$item['ID']?>">
                                <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 2.453 1.812 5.032l-.312.14V13.5h13V5.172l-.313-.14L8 2.453Zm0 1.094 5.5 2.296V12.5h-1V7h-9v5.5h-1V5.843L8 3.547ZM4.5 8h7v4.5h-7V8Z"></path>
                                </svg>
                                <div class="product__date">Самовывоз: <span><?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT'] ? "Сегодня" : "Под заказ";?></span></div>
                            </div>
                            <div class="product__delivery  card_delivery"  data-product="<?=$item['ID']?>">
                                <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m14.96 8.305-1.5-3.5A.5.5 0 0 0 13 4.5h-1.5v-1A.5.5 0 0 0 11 3H1.5a.5.5 0 0 0-.5.5V12a.5.5 0 0 0 .5.5h1.07a2 2 0 0 0 3.86 0h3.14a2 2 0 0 0 3.86 0h1.07a.5.5 0 0 0 .5-.5V8.5a.499.499 0 0 0-.04-.195ZM11.5 5.5h1.17L13.74 8H11.5V5.5Zm-7 7.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm5.07-1.5H6.43a2 2 0 0 0-3.86 0H2V4h8.5v6.28a1.999 1.999 0 0 0-.93 1.22ZM11.5 13a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm2.5-1.5h-.57A2 2 0 0 0 11.5 10V9H14v2.5Z"></path>
                                </svg>
                                <div class="product__date">Доставка: <span><?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT'] ? "Завтра" : "Под заказ";?></span></div>
                            </div>
                        </div>
                    </div>
                    <a class="product__link" href="<?=$item['DETAIL_PAGE_URL']?>">
                        <img class="product__images" src="<?=$item['PREVIEW_PICTURE']['src']?>" alt="<?=$item['NAME']?>" title="<?=$item['NAME']?>">
                    </a>
                    <a class="product__name" href="<?=$item['DETAIL_PAGE_URL']?>"><?=$item['NAME']?></a>

 					</div>

				<div class="product__bottom">
					<?if(($item['PROPERTIES']["DIAMETR"]["VALUE"] && $item['PROPERTIES']["DLINA"]["VALUE"]) || !empty($item['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE']))
					{?>
                    <div class="product__params">
                    <?if($item['PROPERTIES']["DIAMETR"]["VALUE"] && $item['PROPERTIES']["DLINA"]["VALUE"]):?>
                        <div class="product__param">Размер(мм): <span><?=$item['PROPERTIES']["DIAMETR"]["VALUE"]?>x<?=$item['PROPERTIES']["DLINA"]["VALUE"]?></span></div>
                    <?endif;?>
                    <?if($item['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE']):?>
                        <div class="product__param">Фасовка: <span><?=$item['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE']?> <?=$item['UNIT']?></span></div>
                    <?endif;?>
                    </div>
					<?}?>
                    <?if($item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']):?>
                        <div class="product__availible">
                            <span>В наличии: <?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?> уп.</span>
                        </div>
                    <?else:?>
                        <div class="product__availible product__availible--unavailible">
                            <div class="unavailable_pickup pointer" data-product="<?=$item['ID']?>"><span>Наличие уточнить</span></div>
                        </div>
                    <?endif;?>




                <div class="product__botside">
                    <div class="product__left">
                        <div class="product__tax">цена (с НДС)</div>
                        <div class="product__price"><?echo number_format($price, 2, '.', ' ');?> р.</div>
						<?if(!empty($item['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE']))
						{?>
							<div class="product__price product__price--one"><?echo round($price/$item['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE'], 2);?> р. за <?=$item['UNIT']?></div>
						<?}?>
                    </div>
                    <div class="product__right">
                        <div data-quantity="<?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?>" onmousedown="try { rrApi.addToBasket(<?=$item['ID']?>) } catch(e) {}" data-product="<?=$item['ID']?>" old-price="<?=$price?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>" class="main-button main-button--mini product-card__button product-card__button_round product__buy" href="javascript:void(0);">
                            
                        </div>
                    </div>
                </div>
</div>


					 

						   

                     <!--product-card-->
            </div>
          

                                                   
						
			
			<?
		}
		?>
		
		</div>

					
	</div>
<!--catalog-feed-->

<script>
	BX.message({
		BTN_MESSAGE_BASKET_REDIRECT: '<?=GetMessageJS('CT_CPV_CATALOG_BTN_MESSAGE_BASKET_REDIRECT')?>',
		BASKET_URL: '<?=$arParams['BASKET_URL']?>',
		ADD_TO_BASKET_OK: '<?=GetMessageJS('ADD_TO_BASKET_OK')?>',
		TITLE_ERROR: '<?=GetMessageJS('CT_CPV_CATALOG_TITLE_ERROR')?>',
		TITLE_BASKET_PROPS: '<?=GetMessageJS('CT_CPV_CATALOG_TITLE_BASKET_PROPS')?>',
		TITLE_SUCCESSFUL: '<?=GetMessageJS('ADD_TO_BASKET_OK')?>',
		BASKET_UNKNOWN_ERROR: '<?=GetMessageJS('CT_CPV_CATALOG_BASKET_UNKNOWN_ERROR')?>',
		BTN_MESSAGE_SEND_PROPS: '<?=GetMessageJS('CT_CPV_CATALOG_BTN_MESSAGE_SEND_PROPS')?>',
		BTN_MESSAGE_CLOSE: '<?=GetMessageJS('CT_CPV_CATALOG_BTN_MESSAGE_CLOSE')?>',
		BTN_MESSAGE_CLOSE_POPUP: '<?=GetMessageJS('CT_CPV_CATALOG_BTN_MESSAGE_CLOSE_POPUP')?>',
		COMPARE_MESSAGE_OK: '<?=GetMessageJS('CT_CPV_CATALOG_MESS_COMPARE_OK')?>',
		COMPARE_UNKNOWN_ERROR: '<?=GetMessageJS('CT_CPV_CATALOG_MESS_COMPARE_UNKNOWN_ERROR')?>',
		COMPARE_TITLE: '<?=GetMessageJS('CT_CPV_CATALOG_MESS_COMPARE_TITLE')?>',
		PRICE_TOTAL_PREFIX: '<?=GetMessageJS('CT_CPV_CATALOG_PRICE_TOTAL_PREFIX')?>',
		RELATIVE_QUANTITY_MANY: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
		RELATIVE_QUANTITY_FEW: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>',
		BTN_MESSAGE_COMPARE_REDIRECT: '<?=GetMessageJS('CT_CPV_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT')?>',
		SITE_ID: '<?=CUtil::JSEscape($component->getSiteId())?>'
	});
	var <?=$obName?> = new JCCatalogProductsViewedComponent({
		initiallyShowHeader: '<?=!empty($arResult['ITEM_ROWS'])?>',
		container: '<?=$containerName?>'
	});
</script>
<?}?>