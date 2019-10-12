<?php

if(file_exists($_SERVER['DOCUMENT_ROOT']."/local/php_interface/include/constants.php"))
        require_once($_SERVER['DOCUMENT_ROOT']."/local/php_interface/include/constants.php");

if(file_exists($_SERVER['DOCUMENT_ROOT']."/local/php_interface/include/agent.php"))
        require_once($_SERVER['DOCUMENT_ROOT']."/local/php_interface/include/agent.php");

if (isset ($_GET['type'])){ 
    switch ($_GET['type']) { 
        case 'pda': 
            setcookie('siteType', 'pda', time()+3600*24*30,'/'); 
            define('siteType','pda'); 
            break; 
        default: 
            setcookie('siteType', 'original', time()+3600*24*30,'/'); 
            define('siteType','original'); 
    } 
}else{ 
    $checkType=''; 
    if (isset($_COOKIE['siteType'])) $checkType=$_COOKIE['siteType']; 
    switch ($checkType) { 
        case 'pda': 
            define('siteType','pda'); 
            break; 
        default: 
            define('siteType',''); 
    } 
}



AddEventHandler("main", "OnEpilog", "My404PageInSiteStyle");
function My404PageInSiteStyle()
{
    if(defined('ERROR_404') && ERROR_404 == 'Y')
    {
        global $APPLICATION;
        $APPLICATION->RestartBuffer();
        include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/header.php';
        include $_SERVER['DOCUMENT_ROOT'].'/404.php';
        include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/footer.php';
    }
}


//-- Обработчик почтового шаблона перед отправкой
AddEventHandler("sale", "OnOrderNewSendEmail", "bxModifySaleMails");

//-- Собственно обработчик события

function bxModifySaleMails($orderID, &$eventName, &$arFields)
{
    $ID=$orderID;

    if ($ID>0 && CModule::IncludeModule('iblock')) {
        $strOrderList = "<table cellpadding='0' cellspacing='0' width='800' style='border:1px solid #cdcaca; border-collapse:collapse;' border='1' bordercolor='#cdcaca'>";
	$strOrderList .= "<tr style='background: #a8c3d6; min-height: 40px; height: 40px; font-size: 14px; color: #012e57; font-family: Arial; font-weight: bold;text-align:center;'>";
	$strOrderList .= "<td width='50'>Артикул</td>";
	$strOrderList .= "<td width='290'>Наименование</td>";
	$strOrderList .= "<td width='50'>Цена</td>";
	$strOrderList .= "<td width='80'>Кол-во</td>";
	$strOrderList .= "<td width='50'>Сумма</td>";
	$strOrderList .= '</tr>';
						
        $rsBasket = CSaleBasket::GetList(array(), array('ORDER_ID' => $ID));
        while ($arBasket = $rsBasket->GetNext()) {	
            
            $res = CIBlockElement::GetList(Array(), array('ID'=>$arBasket['PRODUCT_ID']), false, Array("nPageSize"=>50), array('*', 'CATALOG_GROUP_'.NUMBER_SALE_PRICE, 'CATALOG_GROUP_'.NUMBER_BASE_PRICE, 'PROPERTY_CML2_ARTICLE'));
            while($ar_res = $res->GetNext()){    

                $detail_page_url="https://".$_SERVER["HTTP_HOST"].$ar_res["DETAIL_PAGE_URL"];
                $artikul=$ar_res["PROPERTY_CML2_ARTICLE_VALUE"];
			
                $strOrderList .= "<tr valign='top'>"
                                . "<td style='text-align:center;'>{$artikul}</td>"
                                . "<td style='text-align:left; padding-left: 10px;'><a href=".$detail_page_url." target='_blank'>{$ar_res["NAME"]}</a></td>"
				. "<td style='white-space: nowrap; text-align:center;'>".($ar_res["CATALOG_PRICE_".NUMBER_SALE_PRICE] ? "<s style='color: #999;'>{$ar_res["CATALOG_PRICE_".NUMBER_BASE_PRICE]} руб.</s> " : "").SaleFormatCurrency($arBasket["PRICE"], $arBasket["CURRENCY"])."</td>"
                                . "<td style='white-space: nowrap; text-align:center;'>{$arBasket["QUANTITY"]} шт.</td>"
                                . "<td style='white-space: nowrap; text-align:center;'>".SaleFormatCurrency($arBasket["PRICE"]*$arBasket["QUANTITY"], $arBasket["CURRENCY"])."</td>"
                              . "</tr>";						  
							  
	    }
        }
            $strOrderList .= '</table>';

		 
            $arOrder = CSaleOrder::GetByID($ID);
  
  //-- получаем телефоны и адрес
  $order_props = CSaleOrderPropsValue::GetOrderProps($ID);
  $phone="";
  $index = ""; 
  $country_name = "";
  $city_name = "";  
  $address = "";
  $company = "";
  $pcity = "";
  
  while ($arProps = $order_props->Fetch())
  {
    if ($arProps["CODE"] == "PPHONE")
    {
       $phone = htmlspecialchars($arProps["VALUE"]);
	   
    }
    if ($arProps["CODE"] == "LOCATION")
    {
        $arLocs = CSaleLocation::GetByID($arProps["VALUE"]);
        $country_name =  $arLocs["COUNTRY_NAME_ORIG"];
        $city_name = $arLocs["CITY_NAME_ORIG"];
    }
    if ($arProps["CODE"] == "PPLACE")
    {
	$place = $arProps["VALUE"];
        $arLocs = CSaleLocation::GetByID($arProps["VALUE"]);
        $country_name =  $arLocs["COUNTRY_NAME_ORIG"];
	$region_name = $arLocs["REGION_NAME_ORIG"];
        $city_name = $arLocs["CITY_NAME_ORIG"];
    }	

    if ($arProps["CODE"] == "INDEX")
    {
      $index = $arProps["VALUE"];   
    }
	
    if ($arProps["CODE"] == "COMPANY")
    {
      $company = $arProps["VALUE"];
    }
	
    if ($arProps["CODE"] == "PCITY")
    {
      $pcity = $arProps["VALUE"];
    }	
	
    if ($arProps["CODE"] == "SELFPOINT")
    {
      $selfpoint = $arProps["VALUE"];
    }	

    if ($arProps["CODE"] == "PREQ")
    {
      $preq = $arProps["VALUE"];
    }	

    if ($arProps["CODE"] == "PSTREET")
    {
      $street = $arProps["VALUE"];   
    }

    if ($arProps["CODE"] == "PHOUSE")
    {
      $house = $arProps["VALUE"];   
    }

    if ($arProps["CODE"] == "PFLAT")
    {
      $flat = $arProps["VALUE"];   
    }	
}

  $full_address = $country_name.", ".$city_name.($pcity ? ", ".$pcity : "").($street ? ", ".$street.", ".$house.", ".$flat : "");
  

  //-- получаем название службы доставки
  $arDeliv = CSaleDelivery::GetByID($arOrder["DELIVERY_ID"]);
  $delivery_name = "";
  if ($arDeliv)
  {
    $delivery_name = $arDeliv["NAME"];	
  }
  
  if ($arOrder["DELIVERY_ID"]=='sdek:courier') $delivery_name="Доставка СДЭК";
  elseif ($arOrder["DELIVERY_ID"]=='sdek:pickup') $delivery_name="Самовывоз СДЭК";

  //-- получаем название платежной системы   
  $arPaySystem = CSalePaySystem::GetByID($arOrder["PAY_SYSTEM_ID"]);
  $pay_system_name = "";
  if ($arPaySystem)
  {
    $pay_system_name = $arPaySystem["NAME"];	
  }
  
  //-- получаем тип платильщика   
  $arPersonType = CSalePersonType::GetByID($arOrder["PERSON_TYPE_ID"]);
  $person_type = "";
  if ($arPersonType)
  {
    $person_type = $arPersonType["NAME"];	
  }  
   
   //-- добавляем новые поля в массив результатов
  $arFields["ORDER_DESCRIPTION"] = $arOrder['USER_DESCRIPTION'];
  $arFields["PPHONE"] =  $phone;
  $arFields["DELIVERY"] =  $delivery_name;
  $arFields["PAY_SYSTEM_NAME"] =  $pay_system_name;
  $arFields["FULL_ADDRESS"] = $full_address;	
  $arFields["COMPANY"] = $company;
  $arFields["PCITY"] = $pcity;
  $arFields["PPLACE"] = $place;
  $arFields["SELFPOINT"] = $selfpoint;
  $arFields["PREQ"] = $preq;
  $arFields["PERSON_TYPE_NAME"] = $person_type;
  $arFields["ORDER_LIST"] = $strOrderList;
  if ($arOrder['PRICE_DELIVERY'] && ($arOrder["DELIVERY_ID"]=='sdek:courier' || $arOrder["DELIVERY_ID"]=='sdek:pickup')) $arFields["DELIVERY_PRICE"] = "Стоимость доставки: {$arOrder['PRICE_DELIVERY']} руб <span style='color: red;'>*приблизительная стоимость (оплачивается отдельно по факту получения заказа)</span><br />";
  else $arFields["DELIVERY_PRICE"]="";
  
	
//file_put_contents('/var/www/webadmin/data/www/moskrep.ru/service/text.txt', print_r($arOrder, true));	
      }
   }
   
   
   //Антибот регистрации на сайте
AddEventHandler("main", "OnBeforeUserRegister", "OnBeforeUserRegisterHandler");
function OnBeforeUserRegisterHandler(&$arFields)
{
    global $APPLICATION;
    
    //В файл 1_txt.php будут записываться вск регистрации, можете закомментировать эти три строки
    $_REQUEST['DATE'] = date('d-m-Y H:i:s');
    $tttfile=$_SERVER['DOCUMENT_ROOT'].'/service/spam_txt.php';
    file_put_contents($tttfile, "<pre>".print_r($_REQUEST,1)."</pre>\n",FILE_APPEND);

    
    if($_REQUEST['AUTH_FORM']=="Y")
    {
       if ($_REQUEST['_ym_uid'] == ''){
           file_put_contents($tttfile, "<pre>Ошибка регистрации</pre>\n",FILE_APPEND);
           $APPLICATION->ThrowException('Ошибка регистрации.');
           return false;
       }
    }

    
}
   
   
AddEventHandler("main", "OnEndBufferContent", "ChangeMyContent");
function ChangeMyContent(&$content)
{
   $search = array(
        '{{city}}',
        '{{region}}',
        '{{phone}}',
    );
   global $APPLICATION;
   $CD   = $APPLICATION->GetCurDir();
   if($CD!='/bitrix/admin/'){
   if($_SERVER['HTTP_HOST']=='spb.krep-komp.ru'){
     $replace = array(
        'Санкт-Петербурге',
        'Санкт-Петербурге и ЛО',
        '<span class="roistat-phone-spb">8 812 309-95-45</span>'
    );  
   }else{
     $replace = array(
        'Москве',
        'Москве и МО',
        '<span class="roistat-phone">8 499 350-55-55</span>'
    );    
   }
    
    $content = str_replace($search, $replace, $content);
   }
}   
   
   \Bitrix\Main\EventManager::getInstance()->addEventHandler('sale', 'OnSaleComponentOrderOneStepFinal',
    array('\Olegpro\Handlers\Sale\OrderAjaxComponentHandler', 'AddGoogleAnalyticsEcommerceCode')
);
   
   \Bitrix\Main\EventManager::getInstance()->addEventHandler('sale', 'OnSaleComponentOrderOneStepFinal',
    array('\Olegpro\Handlers\Sale\OrderAjaxComponent', 'AddYandexMetricsEcommerceCode')
);
 
\Bitrix\Main\Loader::registerAutoLoadClasses(null, array(
    '\Olegpro\Handlers\Sale\OrderAjaxComponentHandler' => '/bitrix/php_interface/classes/handlers/orderajaxcomponenthandler.php',
));

\Bitrix\Main\Loader::registerAutoLoadClasses(null, array(
    '\Olegpro\Handlers\Sale\OrderAjaxComponentHandler' => '/bitrix/php_interface/classes/handlers/orderajaxcomponenthandler2.php',
));

AddEventHandler('main', 'OnEpilog', array('CMainHandlers', 'OnEpilogHandler'));  
class CMainHandlers { 
   public static function OnEpilogHandler() {
      if (isset($_GET['PAGEN_1']) && intval($_GET['PAGEN_1'])>0) {
         $title = $GLOBALS['APPLICATION']->GetPageProperty('title');
         $GLOBALS['APPLICATION']->SetPageProperty('title', $title.' (страница '.intval($_GET['PAGEN_1']).')');
      }
   }
}

//Создавать оплату при смене статуса оплаты на "Готов к оплате". 1С оплату и отгрузку удаляют
//AddEventHandler("sale", "OnOrderUpdate", "OnSaleStatusOrderFunck");
function OnSaleStatusOrderFunck(&$ID, &$arFields)
{
	CModule::IncludeModule('sale');
	
	if($arFields["STATUS_ID"] == "R")
	{

		$order_id = $arFields["ID"];
		
		//Получаем стоимость доставки из комментариев
		
		$res = \Bitrix\Sale\Order::getList(array('filter'=>array('ID'=>$order_id)));
		while ($row = $res->fetch()){
			preg_match('/\$(.+)\$/U', $row['COMMENTS'], $matches);
		}
		
		$order = \Bitrix\Sale\Order::load($order_id);
		
		//Коллекция доставок
		$shipmentCollection = $order->getShipmentCollection();
		$deliveryIds = $order->getDeliverySystemId();
		
		//Удаляем старые
		$rsShipment = \Bitrix\Sale\Internals\ShipmentTable::getList(array('filter'=>array('ORDER_ID' => $order_id),));
		while($arShipment=$rsShipment->fetch())

		{
			\Bitrix\Sale\Internals\ShipmentTable::delete($arShipment['ID']);
		}
		
		//Создаем новую
		$shipment = $shipmentCollection->createItem(
			Bitrix\Sale\Delivery\Services\Manager::getObjectById(end($deliveryIds))
		);
		$shipmentItemCollection = $shipment->getShipmentItemCollection();
		$service = \Bitrix\Sale\Delivery\Services\Manager::getById(end($deliveryIds));
		$deliveryData = [
			'DELIVERY_ID' => $service['ID'],
			'DELIVERY_NAME' => $service['NAME'],
			'ALLOW_DELIVERY' => 'Y',
			'PRICE_DELIVERY' => end($matches),
			'CUSTOM_PRICE_DELIVERY' => 'Y'
		];
		$shipment->setFields($deliveryData);

		//Коллекция оплат
		$paymentCollection = $order->getPaymentCollection();
		$sum = $paymentCollection->getSum();
		
		if($sum==0){
			/*$payment = $paymentCollection->createItem(
				\Bitrix\Sale\PaySystem\Manager::getObjectById("8")
			);
			//$payment = \Bitrix\Sale\Payment::create($paymentCollection, \Bitrix\Sale\PaySystem\Manager::getObjectById("8"));
			//$payment->setField("SUM", $order->getPrice());
			*/
			$service = \Bitrix\Sale\PaySystem\Manager::getObjectById(8);
			$payment = \Bitrix\Sale\Payment::create($paymentCollection, $service);

			$payment->setField('SUM',  $order->getPrice());
			//$payment->setField('PSA_NAME',  'Сбербанк');
			//$payment->setField('NAME',  'Сбербанк');
			
			$result = $order->save();
			$paymentCollection->addItem($payment);
			\Bitrix\Main\Diag\Debug::dumpToFile($payment, "", '/upload/errors_pay.txt');
			if(!$result->isSuccess())
			{
				//\Bitrix\Main\Diag\Debug::dumpToFile($result->getErrors(), "", '/upload/errors_pay.txt');
				//$result->getErrors();
			}
		}
	}
}


	
?>