<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main,
	Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset;


Asset::getInstance()->addJs("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/script.js");


Loc::loadMessages(__FILE__);

?>

<?

if (!empty($arResult['ERRORS']['FATAL']))
{
	foreach($arResult['ERRORS']['FATAL'] as $error)
	{
		ShowError($error);
	}
	$component = $this->__component;
	if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]))
	{
		$APPLICATION->AuthForm('', false, false, 'N', false);
	}

}
else
{
	if (!empty($arResult['ERRORS']['NONFATAL']))
	{
		foreach($arResult['ERRORS']['NONFATAL'] as $error)
		{
			ShowError($error);
		}
	}
	if (!count($arResult['ORDERS']))
	{
		if ($_REQUEST["filter_history"] == 'Y')
		{
			if ($_REQUEST["show_canceled"] == 'Y')
			{
				?>
				<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_CANCELED_ORDER')?></h3>
				<?
			}
			else
			{
				?>
				<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_HISTORY_ORDER_LIST')?></h3>
				<?
			}
		}
		else
		{
			?>
			<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_ORDER_LIST')?></h3>
			<?
		}
                
           
                
	}
        
        
                
                $paymentChangeData = array();
		$orderHeaderStatus = null;
                ?><table class="blue-table lk">
                    <thead class="blue-table__thead">
                        <tr class="blue-table__tr">
			    <th class="blue-table__th">Номер заказа</th>
                            <th class="blue-table__th">Дата заказа</th>
                            <th class="blue-table__th">Статус заказа</th>
                            <th class="blue-table__th">Статус оплаты</th>
                            <th class="blue-table__th">Сумма заказа</th>
			</tr>
                    </thead><?
		foreach ($arResult['ORDERS'] as $key => $order)
		{
                ?>
                    <tr class="blue-table__tr">
						<td class="blue-table__td">
                                                    <span class="lk-number">
                                                        <a class="lk-number" href="<?=$order['ORDER']['URL_TO_DETAIL']?>">
                                                        <?=Loc::getMessage('SPOL_TPL_ORDER')?>
							<?=Loc::getMessage('SPOL_TPL_NUMBER_SIGN').$order['ORDER']['ACCOUNT_NUMBER']?>
                                                        </a>
                                                    </span>
                                                </td>
						<td class="blue-table__td">
                                                    <span class="lk-date">
                                                        <?=$order['ORDER']['DATE_INSERT']->format($arParams['ACTIVE_DATE_FORMAT'])?>
                                                    </span>
                                                </td>
						<td class="blue-table__td">
                                                    <span class="lk-order">
                                                         <?=$arResult['STATUS'][$order['ORDER']["STATUS_ID"]]?>
                                                    </span>
                                                </td>
						<td class="blue-table__td">
                                                    <span class="lk-pay">
                                                 <?foreach ($order['PAYMENT'] as $payment)
						  {
                                                     ?>
                                                 
                                                        <?=$payment['PAY_SYSTEM_NAME']?>
                                                  <?}?>
                                                    </span>
                                                </td>
						<td class="blue-table__td">
                                                    <span class="lk-price">
                                                        <?=$order['ORDER']['FORMATED_PRICE']?>
                                                    </span>
                                                </td>
					</tr>
                                       
                <?
                }
                ?></table>            
                
                   
   
	<?
	echo $arResult["NAV_STRING"];

	if ($_REQUEST["filter_history"] !== 'Y')
	{
		$javascriptParams = array(
			"url" => CUtil::JSEscape($this->__component->GetPath().'/ajax.php'),
			"templateFolder" => CUtil::JSEscape($templateFolder),
			"templateName" => $this->__component->GetTemplateName(),
			"paymentList" => $paymentChangeData
		);
		$javascriptParams = CUtil::PhpToJSObject($javascriptParams);
		?>
		<script>
			BX.Sale.PersonalOrderComponent.PersonalOrderList.init(<?=$javascriptParams?>);
		</script>
		<?
	}
}
?>
