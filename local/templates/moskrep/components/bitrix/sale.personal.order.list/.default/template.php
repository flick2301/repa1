<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main,
	Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset;


Asset::getInstance()->addJs("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/script.js");


Loc::loadMessages(__FILE__);

?>
<br />

            <div class="basic-layout__module catalog-feed">
               <div class="catalog-feed__list">

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
 
		foreach ($arResult['ORDERS'] as $key => $order)
		{
                ?>
				
				
                  <div class="catalog-feed__table myorders">				
                     <!--orders-table-->
                     <section class="orders-table">
                        <div class="orders-table__column orders-table__column--order">
                           <div class="orders-table__title">Номер заказа<small>:</small></div>
						   <div class="orders-table__content">
                           <h3 class="orders-table__content"><a class="orders-table__link" href="<?=$order['ORDER']['URL_TO_DETAIL']?>"><?=Loc::getMessage('SPOL_TPL_ORDER')?>
							<?=Loc::getMessage('SPOL_TPL_NUMBER_SIGN').$order['ORDER']['ACCOUNT_NUMBER']?>
                        </a></h3>
						 </div>
                        </div>
						<?
						 $date = (array) $order['ORDER']['DATE_INSERT'];
						?>
                        <div class="orders-table__column orders-table__column--date">
                           <div class="orders-table__title">Дата заказа<small>:</small></div>
                           <div class="orders-table__content">
                              <p class="orders-table__desc"><?/*=$order['ORDER']['DATE_INSERT']->format($arParams['ACTIVE_DATE_FORMAT'])*/?><?=preg_replace("/:[0-9]{2}$/", "", $order['ORDER']['DATE_INSERT']->toString())?></p>
                           </div>
                        </div>
                        <div class="orders-table__column orders-table__column--basic">
                           <div class="orders-table__title">Статус заказа<small>:</small></div>
                           <div class="orders-table__content orders-table__content--status">
                              <p class="orders-table__desc"><?=$arResult['STATUS'][$order['ORDER']["STATUS_ID"]]?></p>
                           </div>
                        </div>
                        <div class="orders-table__column orders-table__column--basic">
                           <div class="orders-table__title">Статус оплаты<small>:</small></div>
                           <div class="orders-table__content">
                              <?foreach ($order['PAYMENT'] as $payment):?><p class="orders-table__desc orders-table__desc--basic"><?=$payment['PAY_SYSTEM_NAME']?></p><?endforeach?>
                           </div>
                        </div>
                        <div class="orders-table__column orders-table__column--total">
                           <div class="orders-table__title">Сумма заказа<small>:</small></div>
                           <div class="orders-table__content">
                              <p class="orders-table__desc"><?=$order['ORDER']['FORMATED_PRICE']?></p>
                           </div>
                        </div>
                     </section>
                     <!--orders-table-->		
	</div> 					 
				
                                       
                <?
                }
                ?>
				    


</div>				
</div>                
                   
   
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
