<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (!empty($arResult["ORDER"]))
{
	?>
	<b><?=GetMessage("SOA_TEMPL_ORDER_COMPLETE")?></b><br /><br />
	<table class="sale_order_full_table">
		<tr>
			<td>
				<?= GetMessage("SOA_TEMPL_ORDER_SUC", Array("#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"], "#ORDER_ID#" => $arResult["ORDER"]["ACCOUNT_NUMBER"]))?>
				<br /><br />
				<?= GetMessage("SOA_TEMPL_ORDER_SUC1", Array("#LINK#" => $arParams["PATH_TO_PERSONAL"])) ?>
			</td>
		</tr>
	</table>
	<?
	if($arResult["PAY_SYSTEM"]['ID'] == BY_CARD){
		?><p>Менеджер пришлет ссылку на оплату картой после обработки заказа!</p><?
	}
	if (!empty($arResult["PAY_SYSTEM"]))
	{
		?>
		<br /><br />

		<table class="sale_order_full_table">
			<tr>
				<td class="ps_logo">
					<div class="pay_name"><?=GetMessage("SOA_TEMPL_PAY")?></div>
					<?=CFile::ShowImage($arResult["PAY_SYSTEM"]["LOGOTIP"], 100, 100, "border=0", "", false);?>
					<div class="paysystem_name"><?= $arResult["PAY_SYSTEM"]["NAME"] ?></div><br>
				</td>
			</tr>
			<?
			if (strlen($arResult["PAY_SYSTEM"]["ACTION_FILE"]) > 0 && $arResult["ORDER"]["STATUS_ID"]=="R")
			{
				
				?>
				<tr>
					<td>
						<?
						if ($arResult["PAY_SYSTEM"]["NEW_WINDOW"] == "Y")
						{
							?>
							<script language="JavaScript">
								window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))?>');
							</script>
							<?= GetMessage("SOA_TEMPL_PAY_LINK", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))))?>
							<?
							if (CSalePdf::isPdfAvailable() && CSalePaySystemsHelper::isPSActionAffordPdf($arResult['PAY_SYSTEM']['ACTION_FILE']))
							{
								?><br />
								<?= GetMessage("SOA_TEMPL_PAY_PDF", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))."&pdf=1&DOWNLOAD=Y")) ?>
								<?
							}
						}
						else
						{
							if (strlen($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"])>0)
							{
								try
								{
									include($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"]);
								}
								catch(\Bitrix\Main\SystemException $e)
								{
									if($e->getCode() == CSalePaySystemAction::GET_PARAM_VALUE)
										$message = GetMessage("SOA_TEMPL_ORDER_PS_ERROR");
									else
										$message = $e->getMessage();

									echo '<span style="color:red;">'.$message.'</span>';
								}
							}
						}
						?>
					</td>
				</tr>
				<?
			}
			?>
		</table>
		<?
	}
}
else
{
	?>
	<b><?=GetMessage("SOA_TEMPL_ERROR_ORDER")?></b><br /><br />

	<table class="sale_order_full_table">
		<tr>
			<td>
				<?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST", Array("#ORDER_ID#" => $arResult["ACCOUNT_NUMBER"]))?>
				<?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST1")?>
			</td>
		</tr>
	</table>
	<?
}
?>

<?
    $data_1 = explode(' ', $arResult["ORDER"]["DATE_INSERT"]);
    $data_1_mdy = explode('.', $data_1[0]);
    $data_1_his = explode(':', $data_1[1]);
    
   
    $days = abs(intval(date('d')) - intval($data_1_mdy[0]));
    $houers = abs(intval(date('H')) - intval($data_1_his[0]));
     
    if(!empty($arResult["ORDER"]) && $houers<=2):
    
    ?>
    
<script>

window.onload = function() {

yaCounter29426710.reachGoal('BUY');
    
window.dataLayer = window.dataLayer || [];



	
dataLayer.push({
    "ecommerce": {
        "purchase": {
            "actionField": {
                "id" : "<?=$arResult["ORDER_ID"]?>"
            },
            "products": [
			<?
$arBasketItems = array();

$dbBasketItems = CSaleBasket::GetList(
     array(
          "NAME" => "ASC",
          "ID" => "ASC"
          ),
     array(
         
        "ORDER_ID" => $arResult["ORDER_ID"]
          ),
        false,
        false,
        array("ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "DELAY", "CAN_BUY", "PRICE", "WEIGHT", "PRODUCT_PROVIDER_CLASS", "NAME")
                );
while ($arItems = $dbBasketItems->Fetch())
{?>
                {
                    "id": "<?=$arItems['PRODUCT_ID']?>",
                    "name": "<?=$arItems['NAME']?>",
                    "price": <?=$arItems['PRICE']?>,
					"quantity": <?=$arItems['QUANTITY']?>
                   
                },
<?}?>  
            ]
        }
    }
});

}
</script>
<?endif;?>