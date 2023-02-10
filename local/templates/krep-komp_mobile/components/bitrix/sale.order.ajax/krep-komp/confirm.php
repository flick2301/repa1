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
                'transactionid':'<?=$arResult["ORDER"]["ACCOUNT_NUMBER"]?>',                                        
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


</div>

<script type="text/javascript">
    (window["rrApiOnReady"] = window["rrApiOnReady"] || []).push(function() {
        try {
            rrApi.setEmail("<?=$userEmail;?>");
            rrApi.order({
                "transaction": "<?=$arResult["ORDER"]["ID"];?>",
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