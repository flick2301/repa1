<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main,
	Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset;


Asset::getInstance()->addJs("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/script.js");


Loc::loadMessages(__FILE__);

?>

<?globalGetTitle()?>

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
?>		

              <div class="allorders"> 
                <div class="allorders__table"> 
				
				
                  <div class="allorders__tr allorders__tr--head">
                    <div class="allorders__td"> 
                      <div class="allorders__name">Заказ №</div>
                    </div>
                    <div class="allorders__td"> 
                      <div class="allorders__name">Отправлено</div>
                    </div>
                    <div class="allorders__td"> 
                      <div class="allorders__name">Стоимость</div>
                    </div>
                    <div class="allorders__td"> 
                      <div class="allorders__name">Способ оплаты</div>
                    </div>
                    <div class="allorders__td"> 
                      <div class="allorders__name">Статус</div>
                    </div>
                  </div>
				  
<?foreach ($arResult['ORDERS'] as $key => $order):?>

                  <div class="allorders__tr"> 
                    <div class="allorders__td"> <a class="allorders__link" href="<?=$order['ORDER']['URL_TO_DETAIL']?>">
							<?=$order['ORDER']['ACCOUNT_NUMBER']?></a></div>
                    <div class="allorders__td"> 
                      <div class="allorders__date"><?=preg_replace("/:[0-9]{2}$/", "", $order['ORDER']['DATE_INSERT']->toString())?></div>
                    </div>
                    <div class="allorders__td"> 
                      <div class="allorders__price"><?=$order['ORDER']['FORMATED_PRICE']?></div>
                    </div>
                    <div class="allorders__td"> 
                      <div class="allorders__address"><?foreach ($order['PAYMENT'] as $payment):?><?=$payment['PAY_SYSTEM_NAME']?><?endforeach?></div>
                    </div>
                    <div class="allorders__td"> 
                      <div class="allorders__accept"><?if($order['ORDER']["STATUS_ID"]=="F"):?><b><?endif?><?=$arResult['STATUS'][$order['ORDER']["STATUS_ID"]]?><?if($order['ORDER']["STATUS_ID"]=="F"):?></b><?endif?></div>
                    </div>
                  </div>

<?endforeach?>				  

                </div>
				
	











	
				
                <div class="allorders__table allorders__table--mobile">
				
<?foreach ($arResult['ORDERS'] as $key => $order):?>

                  <div class="allorders__column">
                    <div class="allorders__tr">
                      <div class="allorders__td"> 
                        <div class="allorders__name">Заказ №</div>
                      </div>
                      <div class="allorders__td"> <a class="allorders__link" href="<?=$order['ORDER']['URL_TO_DETAIL']?>"><?=$order['ORDER']['ACCOUNT_NUMBER']?></a></div>
                    </div>
                    <div class="allorders__tr">
                      <div class="allorders__td"> 
                        <div class="allorders__name">Отправлено</div>
                      </div>
                      <div class="allorders__td"> 
                        <div class="allorders__date"><?=preg_replace("/:[0-9]{2}$/", "", $order['ORDER']['DATE_INSERT']->toString())?></div>
                      </div>
                    </div>
                    <div class="allorders__tr">
                      <div class="allorders__td"> 
                        <div class="allorders__name">Стоимость</div>
                      </div>
                      <div class="allorders__td"> 
                        <div class="allorders__price"><?=$order['ORDER']['FORMATED_PRICE']?></div>
                      </div>
                    </div>
                    <div class="allorders__tr">
                      <div class="allorders__td"> 
                        <div class="allorders__name">Способ оплаты</div>
                      </div>
                      <div class="allorders__td"> 
                        <div class="allorders__address"><?foreach ($order['PAYMENT'] as $payment):?><?=$payment['PAY_SYSTEM_NAME']?><?endforeach?></div>
                      </div>
                    </div>
                    <div class="allorders__tr">
                      <div class="allorders__td"> 
                        <div class="allorders__name">Статус</div>
                      </div>
                      <div class="allorders__td"> 
                        <div class="allorders__accept"><?if($order['ORDER']["STATUS_ID"]=="F"):?><b><?endif?><?=$arResult['STATUS'][$order['ORDER']["STATUS_ID"]]?><?if($order['ORDER']["STATUS_ID"]=="F"):?></b><?endif?></div>
                      </div>
                    </div>
                  </div>
				  
<?endforeach?>					  
				  		  
				  
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
