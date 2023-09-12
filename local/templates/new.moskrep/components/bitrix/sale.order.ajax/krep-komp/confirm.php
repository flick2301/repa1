<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 * @var array $arResult
 * @var $APPLICATION CMain
 */

if ($arParams["SET_TITLE"] == "Y")
{
	$APPLICATION->SetTitle(Loc::getMessage("SOA_ORDER_COMPLETE"));
}
?>

<div>

<? if (!empty($arResult["ORDER"])): ?>

	<table class="sale_order_full_table">
		<tr>
			<td>
				<?=Loc::getMessage("SOA_ORDER_SUC", array(
					"#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"]->toUserTime()->format('d.m.Y H:i'),
					"#ORDER_ID#" => $arResult["ORDER"]["ACCOUNT_NUMBER"]
				))?>
				<? if (!empty($arResult['ORDER']["PAYMENT_ID"])): ?>
					<?=Loc::getMessage("SOA_PAYMENT_SUC", array(
						"#PAYMENT_ID#" => $arResult['PAYMENT'][$arResult['ORDER']["PAYMENT_ID"]]['ACCOUNT_NUMBER']
					))?>
				<? endif ?>
				<? if ($arParams['NO_PERSONAL'] !== 'Y'): ?>
					<br /><br />
					<?=Loc::getMessage('SOA_ORDER_SUC1', ['#LINK#' => $arParams['PATH_TO_PERSONAL']])?>
				<? endif; ?>
			</td>
		</tr>
	</table>
	
	
	<?
	$order = \Bitrix\Sale\Order::load($arResult["ORDER"]["ID"]);
	if ($order){
    	$userEmail = '';
 		$propertyCollection = $order->getPropertyCollection();
 
		if ($propUserEmail = $propertyCollection->getUserEmail()) {
			$userEmail = $propUserEmail->getValue();
		} else {
         
			// поиск свойства путём перебора
			foreach($propertyCollection as $orderProperty) {
             
				if ($orderProperty->getField('CODE') == 'EMAIL') {
					$userEmail = $orderProperty->getValue();
					break;
				}
			}
		}
		
		$basket = Bitrix\Sale\Basket::loadItemsForOrder($order);
		
		
		?>
		<!-- Criteo Sales dataLayer -->
<script type='text/javascript'>
        var dataLayer = dataLayer || [];
        dataLayer.push({
            'event': 'crto_transactionpage',            
            crto: {             
                'email': '<?=$userEmail?>',   
                'transactionid':'<?=$arResult["ORDER"]["ID"]?>',                                        
                'products': [
				<?
				foreach ($basket as $basketItem) {
					?>
					{
                    id: '<?=$basketItem->getProductId()?>',
                    price: '<?=$basketItem->getPrice()?>',              
                    quantity: '<?=$basketItem->getQuantity()?>'
					},
				<?
				}
				?>
				]
            }
        });
</script>
<!-- END Criteo Sales dataLayer -->
		<?
	}															
											?>
	
<script>

dataLayer.push({
	'event':'krepkomp',
		'eventCategory':'Заказ', 
		'eventAction':'подтверждение',  
    'eventLabel':'<?=$arResult["ORDER"]["ACCOUNT_NUMBER"]?>', // Номер заказа, указанный на странице с информацией об успешно созданном заказе
    'eventValue':'<?=$arResult["ORDER"]["PRICE"]?>'  // Общая стоимость оформленного заказа
});






window.onload = function() {

yaCounter29426710.reachGoal('BUY');
    
window.dataLayer = window.dataLayer || [];
	


}
</script>	
	

	<?
	if ($arResult["ORDER"]["IS_ALLOW_PAY"] === 'Y')
	{
		if (!empty($arResult["PAYMENT"]))
		{
			foreach ($arResult["PAYMENT"] as $payment)
			{
				if ($payment["PAID"] != 'Y')
				{
					if (!empty($arResult['PAY_SYSTEM_LIST'])
						&& array_key_exists($payment["PAY_SYSTEM_ID"], $arResult['PAY_SYSTEM_LIST'])
					)
					{
						$arPaySystem = $arResult['PAY_SYSTEM_LIST_BY_PAYMENT_ID'][$payment["ID"]];

						if (empty($arPaySystem["ERROR"]))
						{
							?>
							<br /><br />

							<table class="sale_order_full_table">
								<tr>
									<td class="ps_logo">
										<div class="pay_name"><?=Loc::getMessage("SOA_PAY") ?></div>
										<?=CFile::ShowImage($arPaySystem["LOGOTIP"], 100, 100, "border=0\" style=\"width:100px\"", "", false) ?>
										<div class="paysystem_name"><?=$arPaySystem["NAME"] ?></div>
										<br/>
									</td>
								</tr>
								<tr>
									<td>
										<? if (strlen($arPaySystem["ACTION_FILE"]) > 0 && $arPaySystem["NEW_WINDOW"] == "Y" && $arPaySystem["IS_CASH"] != "Y"): ?>
											<?
											$orderAccountNumber = urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]));
											$paymentAccountNumber = $payment["ACCOUNT_NUMBER"];
											?>
											<script>
												window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=$orderAccountNumber?>&PAYMENT_ID=<?=$paymentAccountNumber?>');
											</script>
										<?=Loc::getMessage("SOA_PAY_LINK", array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$orderAccountNumber."&PAYMENT_ID=".$paymentAccountNumber))?>
										<? if (CSalePdf::isPdfAvailable() && $arPaySystem['IS_AFFORD_PDF']): ?>
										<br/>
											<?=Loc::getMessage("SOA_PAY_PDF", array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$orderAccountNumber."&pdf=1&DOWNLOAD=Y"))?>
										<? endif ?>
										<? else: ?>
											<?=$arPaySystem["BUFFERED_OUTPUT"]?>
										<? endif ?>
									</td>
								</tr>
							</table>

							<?
						}
						else
						{
							?>
							<span style="color:red;"><?=Loc::getMessage("SOA_ORDER_PS_ERROR")?></span>
							<?
						}
					}
					else
					{
						?>
						<span style="color:red;"><?=Loc::getMessage("SOA_ORDER_PS_ERROR")?></span>
						<?
					}
				}
			}
		}
	}
	else
	{
		?>
		<br /><strong><?=$arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR']?></strong>
		<?
	}
	?>

<? else: ?>

	<b><?=Loc::getMessage("SOA_ERROR_ORDER")?></b>
	<br /><br />

	<table class="sale_order_full_table">
		<tr>
			<td>
				<?=Loc::getMessage("SOA_ERROR_ORDER_LOST", ["#ORDER_ID#" => htmlspecialcharsbx($arResult["ACCOUNT_NUMBER"])])?>
				<?=Loc::getMessage("SOA_ERROR_ORDER_LOST1")?>
			</td>
		</tr>
	</table>

<? endif ?>
<?
$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
			"AREA_FILE_SHOW" => "file",
			"PATH" => "/include/grade_site_confirm.php",
			"AREA_FILE_SUFFIX" => "grade_site",
			"EDIT_TEMPLATE" => ""
			)
		);
		?>
		<?
global $arrFilter;
$arrFilter['!CATALOG_PRICE_8'] = false;
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"main_double", 
	array(
		"COMPONENT_TEMPLATE" => "main",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => CATALOG_IBLOCK_ID,
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "samorezy",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "arrFilter",
		"INCLUDE_SUBSECTIONS" => "A",
		"SHOW_ALL_WO_SECTION" => "N",
		"CUSTOM_FILTER" => "",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"ELEMENT_SORT_FIELD" => "rand",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"PAGE_ELEMENT_COUNT" => "1",
		"LINE_ELEMENT_COUNT" => "1",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_LIMIT" => "1",
		"BACKGROUND_IMAGE" => "-",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"SET_LAST_MODIFIED" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_FILTER" => "N",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRICE_CODE" => array(
			0 => "Распродажа",
			1 => "К0 (БАЗОВАЯ НАЧАЛЬНАЯ)",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "Y",
		"BASKET_URL" => "/personal/basket.php",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"DISPLAY_COMPARE" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"COMPATIBLE_MODE" => "Y",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"CURRENCY_ID" => "RUB",
		"PROPERTY_CODE_MOBILE" => "",
		"TEMPLATE_THEME" => "blue",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"ENLARGE_PRODUCT" => "STRICT",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"SHOW_SLIDER" => "Y",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => "",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"RCM_TYPE" => "personal",
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"SHOW_FROM_SECTION" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"LAZY_LOAD" => "N",
		"LOAD_ON_SCROLL" => "N",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_CART_PROPERTIES" => "",
		"SHOW_HITS"=>"N",
	),
	false
);?>
<div class='basic-layout__columns basic-layout__columns--reverse basic-layout__full'>
<div class='basic-layout__content full'>
<div class="simple-article__content" id="moscow">
	<div data-retailrocket-markup-block="63591b58e931eed4c8088a82"></div>
</div>
</div>
</div>


 
</div>



<?
if($orderId = $arResult['ORDER']['ID']) {
    $userEmail = "";
    if($order = \Bitrix\Sale\Order::load($orderId)) {
        /** @var \Bitrix\Sale\PropertyValueCollection $propertyCollection */
        if($propertyCollection = $order->getPropertyCollection()) {

            /** @var \Bitrix\Sale\PropertyValue $orderProperty */
            foreach($propertyCollection as $orderProperty) {
                //Ищет свойство заказа, у которого символьный код EMAIL
                if($orderProperty->getField('CODE') == 'EMAIL') {
                    $userEmail = $orderProperty->getValue();
                }
				if($orderProperty->getField('CODE') == 'AGREEMENT') {
                    $agreement = $orderProperty->getValue();
                }
            }

        }
    }
}

?>

<script type="text/javascript">
    (window["rrApiOnReady"] = window["rrApiOnReady"] || []).push(function() {
        try {
            rrApi.setEmail("<?=$userEmail;?>");
            rrApi.order({
                "transaction": "<?=$orderId;?>",
                "items": [
                    <? $rsCart = CSaleBasket::GetList(Array(),Array("ORDER_ID"=>$arResult['ORDER']['ID']));?>
                    <? while ($arCartItem = $rsCart->Fetch()) {?>
                    { "id": <?=$arCartItem["PRODUCT_ID"]?>, "qnt": <?=$arCartItem['QUANTITY']?>,  "price": <?=$arCartItem["PRICE"]?>},
                            <?};?>

                                ]
                                });
                                } catch(e) {}
                                })
</script>
<?
if($agreement=='Y')
{?>
<script type="text/javascript">
    (window["rrApiOnReady"] = window["rrApiOnReady"] || []).push(function() {
        try { rrApi.setEmail("<?=$userEmail;?>"); } catch(e) {}
    })
</script>
<?}?>
<p>
</p>


</div>