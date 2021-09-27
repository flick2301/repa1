<?
// #
// # События и обработчики
// #


use \Bitrix\Main\EventManager;
use \Bitrix\Main\Event;
use \Bitrix\Main\Entity;
use \Bitrix\Sale\Order;
use \Bitrix\Sale\Payment;
use \Bitrix\Sale\PaySystem\Manager;
use \Bitrix\Sale\Shipment;
use \Bitrix\Sale\Helpers\Admin\Blocks\OrderBasketShipment;
$inst = EventManager::getInstance();
$inst-> addEventHandler('sale', 'OnBeforeCollectionDeleteItem', 'saveInfo');
$inst-> addEventHandler('sale', 'OnSaleOrderBeforeSaved', 'reverseInfo');
//Небольшая прослойка, возвращает доступные поля
/**
 * @param array $arValues
 * @param array $allowedFields
 * @return array $result
 */
function checkFields( $arValues, $allowedFields) {
	   $result = array();
	   foreach ( $arValues as $key => $value ) {
		      if ( in_array( $key,$allowedFields ) && !in_array($key, array('ACCOUNT_NUMBER')) ) {
			         $result[$key] = $value;
			}
		}
	   return $result;
	}
function saveInfo(\Bitrix\Main\Event $event ) {
	   /**
	    * @var \Bitrix\Sale\Shipment|\Bitrix\Sale\Payment $entity
	    */
	   if ( $_SESSION['BX_CML2_EXPORT'] ) {
		      $entity = $event->getParameter('ENTITY');
			  
		      if ( $entity instanceof Shipment ) {
			         if ( !is_array( $_SESSION['BX_CML2_EXPORT']['DELETED_SHIPMENTS'] )  )
			            $_SESSION['BX_CML2_EXPORT']['DELETED_SHIPMENTS'] = array();
					
			         if ( !$entity->isSystem() )
			            $_SESSION['BX_CML2_EXPORT']['DELETED_SHIPMENTS'][] = checkFields( $entity->getFields()->getValues(), Shipment::getAvailableFields() );
			}
		      if ( $entity instanceof Payment ) {
			         if ( !is_array( $_SESSION['BX_CML2_EXPORT']['DELETED_PAYMENTS'] )  )
			            $_SESSION['BX_CML2_EXPORT']['DELETED_PAYMENTS'] = array();
			         $_SESSION['BX_CML2_EXPORT']['DELETED_PAYMENTS'][] = checkFields( $entity->getFields()->getValues(), Payment::getAvailableFields() );
			}
		}
	   else {
		      return;
		}
	}
function reverseInfo(\Bitrix\Main\Event $event ) 
{
	/**
	* @var \Bitrix\Sale\Order $order
	* @var \Bitrix\Sale\ShipmentCollection $shipmentCollection
	* @var \Bitrix\Sale\Shipment $shipment
	* @var \Bitrix\Sale\PaymentCollection $paymentCollection
	* @var \Bitrix\Sale\Payment $payment
	* @var \Bitrix\Sale\PropertyValue $somePropValue
	* **/
	if ( $_SESSION['BX_CML2_EXPORT'] ) 
	{
		$order = $event->getParameter("ENTITY");
		if ( $_SESSION['BX_CML2_EXPORT']['DELETED_SHIPMENTS'] ) 
		{
			
			//Вернем отгрузки
			$shipmentCollection = $order->getShipmentCollection();
			
			$systemShipmentItemCollection = $shipmentCollection->getSystemShipment()->getShipmentItemCollection();
			
			$products = array();
			$basket = $order->getBasket();
			if ($basket)
			{
				/** @var \Bitrix\Sale\BasketItem $product */
				$basketItems = $basket->getBasketItems();
				foreach ($basketItems as $product)
				{
					$systemShipmentItem = $systemShipmentItemCollection->getItemByBasketCode($product->getBasketCode());
					
					if ($product->isBundleChild() || !$systemShipmentItem || $systemShipmentItem->getQuantity() <= 0)
					    continue;
					$products[] = array(
					                  'AMOUNT' => $product->getQuantity(),
					                  'BASKET_CODE' => $product->getBasketCode()
									);
				}
			}
			/** @var \Bitrix\Sale\Shipment $obShipment */
			/** @var array $shipmentFields */
					 
			foreach ( $_SESSION['BX_CML2_EXPORT']['DELETED_SHIPMENTS'] as $shipmentFields ) 
			{
						 
							
				$fg = false;
				foreach( $shipmentCollection as $obShipment ) 
				{
								
					if ($obShipment->isSystem())
					    continue;
					$usedFields = checkFields($obShipment->getFields()->getValues(), Shipment::getAvailableFields() );
					
					if ( count( array_diff_assoc( $shipmentFields, $usedFields) ) == 0 )
					    $fg = false;
					 //доставка с такими полями уже есть
				}
				if ( $fg || $order->getDeliveryPrice()==0) 
				{
					
					$shipment = $shipmentCollection->createItem();
					$shipment->setFields( $shipmentFields );
					OrderBasketShipment::updateData($order, $shipment, $products);
				}
					
			}
					
			         unset( $_SESSION['BX_CML2_EXPORT']['DELETED_SHIPMENTS'] );
					 
		}
		      if ( $_SESSION['BX_CML2_EXPORT']['DELETED_PAYMENTS'] ) {
			         //Вернем оплаты
			         $paymentCollection = $order->getPaymentCollection();
			         /** @var \Bitrix\Sale\Payment $obPayment */
			         /** @var array $paymentFields */
					 $first = true;
			         foreach ( $_SESSION['BX_CML2_EXPORT']['DELETED_PAYMENTS'] as $paymentFields ) {
						 if($first){
							 
				            $fg = true;
				            foreach( $paymentCollection as $obPayment ) {
					               $usedFields = checkFields( $obPayment->getFields()->getValues(), Payment::getAvailableFields() );
					               if ( count( array_diff_assoc( $paymentFields, $usedFields) ) == 0 )
					                  $fg = false;
					 //такая оплата уже есть
					}
				            if ( $fg ) {
					               $payment = $paymentCollection->createItem();
					               $payment->setFields( $paymentFields );
					}
					$first = false;
						 }
				}
			         unset( $_SESSION['BX_CML2_EXPORT']['DELETED_PAYMENTS'] );
			}
		      //Проверим сумму заказа
		      $paymentCollection = $order->getPaymentCollection();
			  if($order->getField('STATUS_ID')=='R')
			  {
				  foreach ( $paymentCollection as $payment ) {
				        $paySystemService = Bitrix\Sale\PaySystem\Manager::getObjectById(8);
						$payment->setFields(array(
								'PAY_SYSTEM_ID' => $paySystemService->getField("PAY_SYSTEM_ID"),
								'PAY_SYSTEM_NAME' => $paySystemService->getField("NAME"),
						));
					}
			  }
		      if ( ($sumP = $paymentCollection->getSum() ) != ($sumO = $order->getPrice() ) ) {
			         $diff = $sumO - $sumP;
			         $innerPayID = Manager::getInnerPaySystemId();
			         foreach ( $paymentCollection as $payment ) {
				            if ( $payment->getPaymentSystemId() != $innerPayID) {
					               $newVal = floatval($payment->getField("SUM")) + floatval($diff);
					               $payment->setField("SUM", $newVal);
					}
				}
			}
	}
}



if (strstr($_SERVER['HTTP_HOST'], "dev") && file_exists($_SERVER['DOCUMENT_ROOT']."/local/php_interface/include/dev_constants.php"))
		require_once($_SERVER['DOCUMENT_ROOT']."/local/php_interface/include/dev_constants.php");
elseif(file_exists($_SERVER['DOCUMENT_ROOT']."/local/php_interface/include/constants.php"))
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


AddEventHandler("sale", "OnSaleComponentOrderOneStepOrderProps", "OnSaleComponentOrderOneStepOrderProps");
function OnSaleComponentOrderOneStepOrderProps(&$arResult, &$arUserResult, &$arParams)
{
	global $USER;
	if (!$USER->IsAuthorized()) {
		
                $arSelect = Array("*");
                $arFilter = Array("IBLOCK_ID"=>22, "PROPERTY_SITES"=>$_SERVER['HTTP_HOST']);
                $res = CIBlockElement::GetList(Array(), $arFilter, false, array(), $arSelect);
                if($ob = $res->GetNextElement())
                {
                    $arFields = $ob->GetFields();
                    $arProperties = $ob->GetProperties();
					if ($arProperties["LOCATION"]["VALUE"]) $arUserResult['DELIVERY_LOCATION'] =  $arProperties["LOCATION"]["VALUE"];
					//$arUserResult['DELIVERY_LOCATION'] = 269; // id Санкт-Петербурга
                }
	}
}

//Обработчик свойств заказа
AddEventHandler("sale", "OnSaleComponentOrderJsData", "SaleComponentOrderJsData");
function SaleComponentOrderJsData(&$arResult, &$arParams)
{
	$delivery = array();
	$arStoreId = array();
	
     $dbDeliveryList = \Bitrix\Sale\Delivery\Services\Table::GetList();
     while ($service = $dbDeliveryList->fetch()) {
         $deliveryObj = Bitrix\Sale\Delivery\Services\Manager::createObject($service);
         $delivery[$deliveryObj->GetId()]["NAME"] = $deliveryObj->getName();
		 $delivery[$deliveryObj->GetId()]["ID"] = $deliveryObj->getParentId();
     }	
	 
	 foreach($arResult["JS_DATA"]["DELIVERY"] AS $key=>$val) {
	 $arResult["JS_DATA"]["DELIVERY"][$key]["GROUP"] = $delivery[$delivery[$delivery[$key]["ID"]]["ID"]]["NAME"] ? $delivery[$delivery[$delivery[$key]["ID"]]["ID"]]["NAME"] : $delivery[$delivery[$key]["ID"]]["NAME"];
	 				if ($arResult["JS_DATA"]["DELIVERY"][$key]["GROUP"]) $arResult["JS_DATA"]["DELIVERY_GROUPS"][$arResult["JS_DATA"]["DELIVERY"][$key]["GROUP"]][] = $key; 
	 if ($val["STORE"]) $arStoreId = array_unique(array_merge($arStoreId, $val["STORE"]));
}

//$arResult["JS_DATA"]["DELIVERY_GROUPS"] = array_unique($arResult["JS_DATA"]["DELIVERY_GROUPS"]);

//Доставка день в день и по субботам
$curtime = date(H)*60 + (int)date(i);
$offtime = 14*60 + 30;

if ($curtime > $offtime) unset($arResult["JS_DATA"]["DELIVERY"][ID_DELIVERY_DAYTODAY]);
if (($curtime > $offtime && date(N)==5) || date(N) > 5) unset($arResult["JS_DATA"]["DELIVERY"][ID_DELIVERY_SUNDAY]);



//Путкты самовывоза
$dbList = CCatalogStore::GetList(
			Array("SORT" => "ASC"),
			Array("ACTIVE" => "Y", "ID" => $arStoreId),
			false,
			false,
			Array("ID", "TITLE", "ADDRESS", "CODE", "DESCRIPTION", "PHONE", "SCHEDULE", "IMAGE_ID") //Добавлена выборка по коду
		);
		while ($arStoreTmp = $dbList->Fetch())
		{
			if ($arStoreTmp["CODE"]) {
				$arStoreTmp["DELIVERY"] = preg_replace("/[^0-9]/", "", $arStoreTmp["CODE"]);
				$arResult["JS_DATA"]["DELIVERY"][$arStoreTmp["DELIVERY"]]["CURRENT_STORE"] = $arStoreTmp["ID"];
				$arResult["JS_DATA"]["DELIVERY"][$arStoreTmp["DELIVERY"]]["STORE_ADDRESS"] = $arStoreTmp["ADDRESS"];
				$arResult["JS_DATA"]["DELIVERY"][$arStoreTmp["DELIVERY"]]["STORE_SCHEDULE"] = $arStoreTmp["SCHEDULE"];
				$arResult["JS_DATA"]["DELIVERY"][$arStoreTmp["DELIVERY"]]["STORE_PHONE"] = $arStoreTmp["PHONE"];
				$arResult["JS_DATA"]["DELIVERY"][$arStoreTmp["DELIVERY"]]["STORE_DESCRIPTION"] = $arStoreTmp["DESCRIPTION"];
				
			if ($arStoreTmp["IMAGE_ID"] > 0)
				$arResult["JS_DATA"]["DELIVERY"][$arStoreTmp["DELIVERY"]]["STORE_IMAGE"] = CFile::GetFileArray($arStoreTmp["IMAGE_ID"]);
			else
				$arResult["JS_DATA"]["DELIVERY"][$arStoreTmp["DELIVERY"]]["STORE_IMAGE"] = null;				
			}
			$arResult["JS_DATA"]["STORE_LIST"][$arStoreTmp["ID"]] = array_merge($arStoreTmp, $arResult["JS_DATA"]["STORE_LIST"][$arStoreTmp["ID"]]);
		}
		
		$arResult["JS_DATA"]["DELIVERY_ADDRESS"]["address_street"] = htmlspecialchars($_REQUEST['order']['address_street']);
		$arResult["JS_DATA"]["DELIVERY_ADDRESS"]["address_full_street"] = htmlspecialchars($_REQUEST['order']['address_full_street']);
		$arResult["JS_DATA"]["DELIVERY_ADDRESS"]["address_id_street"] = htmlspecialchars($_REQUEST['order']['address_id_street']);
		$arResult["JS_DATA"]["DELIVERY_ADDRESS"]["address_house"] = htmlspecialchars($_REQUEST['order']['address_house']);
		$arResult["JS_DATA"]["DELIVERY_ADDRESS"]["address_flat"] = htmlspecialchars($_REQUEST['order']['address_flat']);
		$arResult["JS_DATA"]["DELIVERY_ADDRESS"]["delivery_lat"] = htmlspecialchars($_REQUEST['order']['delivery_lat']);
		$arResult["JS_DATA"]["DELIVERY_ADDRESS"]["delivery_lon"] = htmlspecialchars($_REQUEST['order']['delivery_lon']);	
		
		$delivery_price = $_REQUEST['order']['ORDER_PROP_' . ORDER_PROPERTY_DELIVERY_PRICE1] ? $_REQUEST['order']['ORDER_PROP_' . ORDER_PROPERTY_DELIVERY_PRICE1] : $_REQUEST['order']['ORDER_PROP_' . ORDER_PROPERTY_DELIVERY_PRICE2];
		
		if ($delivery_price) {

			$delivery_price = preg_replace("/[^0-9]+/", "", $delivery_price);
			$formatted_delivery_price = CurrencyFormat($delivery_price, 'RUB');
			$total_price = $delivery_price + $arResult["JS_DATA"]["TOTAL"]["ORDER_PRICE"];
			
		$arResult["JS_DATA"]["DELIVERY"][2]["PRICE"] = $delivery_price;
		$arResult["JS_DATA"]["DELIVERY"][2]["PRICE_FORMATED"] = $formatted_delivery_price;
		$arResult["JS_DATA"]["DELIVERY"][28]["PRICE"] = $delivery_price;
		$arResult["JS_DATA"]["DELIVERY"][28]["PRICE_FORMATED"] = $formatted_delivery_price;		
		$arResult["JS_DATA"]["DELIVERY"][ID_DELIVERY_DAYTODAY]["PRICE"] = $delivery_price;
		$arResult["JS_DATA"]["DELIVERY"][ID_DELIVERY_DAYTODAY]["PRICE_FORMATED"] = $formatted_delivery_price;
		$arResult["JS_DATA"]["DELIVERY"][ID_DELIVERY_SUNDAY]["PRICE"] = $delivery_price;
		$arResult["JS_DATA"]["DELIVERY"][ID_DELIVERY_SUNDAY]["PRICE_FORMATED"] = $formatted_delivery_price;				
		$arResult["JS_DATA"]["DELIVERY_PRICE"] = $delivery_price;
		$arResult["JS_DATA"]["DELIVERY_PRICE_FORMATED"] = $formatted_delivery_price;		
		$arResult["JS_DATA"]["TOTAL"]["DELIVERY_PRICE"] = $delivery_price;
		$arResult["JS_DATA"]["TOTAL"]["DELIVERY_PRICE_FORMATED"] = $formatted_delivery_price;			
		$arResult["JS_DATA"]["TOTAL"]["DELIVERY_PRICE"] = $delivery_price;
		$arResult["JS_DATA"]["TOTAL"]["DELIVERY_PRICE_FORMATED"] = $formatted_delivery_price;			
		$arResult["JS_DATA"]["TOTAL"]["ORDER_TOTAL_PRICE"] = $total_price;
		$arResult["JS_DATA"]["TOTAL"]["ORDER_TOTAL_PRICE_FORMATED"] = CurrencyFormat($total_price, 'RUB');
		}

	//file_put_contents($_SERVER["DOCUMENT_ROOT"].'/service/text.txt', print_r($arResult["JS_DATA"], true)."\n-------------".print_r($arParams, true));
}


//Заказ добавлен
use Bitrix\Main;
Main\EventManager::getInstance()->addEventHandler(
    'sale',
    'OnSaleOrderBeforeSaved',
    'bxOnSaleOrderBeforeSaved'
);


function bxOnSaleOrderBeforeSaved(Main\Event $event)
{

    /** @var \Bitrix\Sale\Order $order */
    $order = $event->getParameter("ENTITY");

    /** @var \Bitrix\Sale\PropertyValueCollection $propertyCollection */
    $propertyCollection = $order->getPropertyCollection();

    $propsData = [];

	if($order->getId() !=20905 && $order->getId() !=25478)
	{

    /**
     * Собираем все свойства и их значения в массив
     * @var \Bitrix\Sale\PropertyValue $propertyItem
     */
		foreach ($propertyCollection as $propertyItem) {
			if (!empty($propertyItem->getField("CODE"))) {
				$props[$propertyItem->getField("CODE")]["VALUE"] = trim($propertyItem->getValue());
			}
		}
		
		
		$delivery_price = $order->getDeliveryPrice() ? $order->getDeliveryPrice() : 0;
	
		
		
		if ($props['DELIVERY_PRICE']['VALUE']) {
	
			if($order->getField('STATUS_ID') == 'N')
				$delivery_price = $props['DELIVERY_PRICE']['VALUE'];//К точному времени (только новые заказы)


			$deliveryCollection = $order->getShipmentCollection()->getNotSystemItems();

			foreach ($deliveryCollection as $shipment) {
				if ($shipment->getDeliveryId() == 2 || $shipment->getDeliveryId() == 28 || $shipment->getDeliveryId() == ID_DELIVERY_DAYTODAY || $shipment->getDeliveryId() == ID_DELIVERY_SUNDAY) {
			//if ($shipment->getDeliveryId() == 11) $delivery_price+=400;
					$shipment->setField("BASE_PRICE_DELIVERY", $delivery_price);			
					$shipment->setField('PRICE_DELIVERY', $delivery_price);
					$shipment->setField("CUSTOM_PRICE_DELIVERY", "Y");
				}
				else {
					$shipment->setField("BASE_PRICE_DELIVERY", 0);				
					$shipment->setField('PRICE_DELIVERY', 0);
					$shipment->setField("CUSTOM_PRICE_DELIVERY", "Y");
				}
			}
		}
 
   //file_put_contents($_SERVER["DOCUMENT_ROOT"].'/service/text.txt',  file_get_contents($_SERVER["DOCUMENT_ROOT"].'/service/text.txt').$order->getField("ID").": ".$order->getPrice()."---------------\n".$delivery_price."---------------\n".$order->getDeliveryPrice()."\n".print_r($props, true)."\n++++++++++++++");

	//if ($props["IDCONTACT"]['VALUE']) file_put_contents($_SERVER["DOCUMENT_ROOT"].'/service/text.txt',  $order->getPrice()."---------------\n".$delivery_price."---------------\n".print_r($did, true));
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

    if ($arProps["CODE"] == "ADDRESS")
    {
      $address = $arProps["VALUE"];   
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
	if ($arProps["CODE"] == "FILE_ORG")
    {
      $file_org = CFile::GetPath($arProps["VALUE"]);   
    }
	if ($arProps["CODE"] == "FILE_ID")
    {
      $file_id = CFile::GetPath($arProps["VALUE"]);   
    }
	if($arProps["CODE"] == "PERSONAL_MANAGER")
	{
		if($arProps['VALUE']>1)
		{
			global $USER;
			
			$userY = new CUser;
			$fields = Array( 
				"UF_PERSONAL_MANAGER" => array($arProps['VALUE']), 
							); 
			$userY->Update($USER->GetId(), $fields);


		}
		
	}
}

  $full_address = $country_name.", ".$address ? $address : ($city_name.($pcity ? ", ".$pcity : "").($street ? ", ".$street.", ".$house.", ".$flat : ""));
  
$resultDelivery = \Bitrix\Sale\Delivery\Services\Table::getList(array('filter' => array('ID'=>$arOrder["DELIVERY_ID"])));
if ($deliveryInfo = $resultDelivery->fetch()) $deliveryGroupID = $deliveryInfo["PARENT_ID"];  
  

  //-- получаем название службы доставки
  $arDeliv = CSaleDelivery::GetByID($arOrder["DELIVERY_ID"]);
  $delivery_name = "";
  if ($arDeliv)
  {
	  
    $delivery_name = $arDeliv["NAME"].($deliveryGroupID==33 ? " <span style='color: red;'>(Вход в ПВЗ только в масках и перчатках)</span>" : "");	
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

	if($_SERVER['HTTP_HOST']=='spb.krep-komp.ru'){
		$arFields["SALE_EMAIL"] = 'spb@krep-komp.ru';
		$arFields["SALE_PHONE"] = '8 812 309-95-45';
	
	}elseif($_SERVER['HTTP_HOST']=='kazan.krep-komp.ru'){
		$arFields["SALE_EMAIL"] = 'kazan@krep-komp.ru';
		$arFields["SALE_PHONE"] = '8 843 206-07-00';
	
	}elseif($_SERVER['HTTP_HOST']=='nizhniy-novgorod.krep-komp.ru'){
		$arFields["SALE_EMAIL"] = 'nn@krep-komp.ru';
		$arFields["SALE_PHONE"] = '8 831 219-95-16';
	
	}elseif($_SERVER['HTTP_HOST']=='voronezh.krep-komp.ru'){
		$arFields["SALE_EMAIL"] = 'voronezh@krep-komp.ru';
		$arFields["SALE_PHONE"] = '8 473 204-53-38';
	
	}else{
		$arFields["SALE_PHONE"] = '8 499 350-55-55';
	}

   
   //-- добавляем новые поля в массив результатов
  $arFields["ORDER_DESCRIPTION"] = $arOrder['USER_DESCRIPTION'];
  $arFields["PPHONE"] =  $phone;
  $arFields["DELIVERY"] =  $delivery_name;
  $arFields["PAY_SYSTEM_NAME"] =  $pay_system_name;
  $deliveryGroupID==32 || $deliveryGroupID==34 ? $arFields["FULL_ADDRESS"] = "Адрес доставки: {$full_address}<br />" : "";	
  $arFields["ADDRESS"] = $address;
  $arFields["COMPANY"] = $company;
  $arFields["PCITY"] = $pcity;
  $arFields["PPLACE"] = $place;
  $arFields["SELFPOINT"] = $selfpoint;
  $arFields["PREQ"] = $preq;
  $arFields["PERSON_TYPE_NAME"] = $person_type;
  $arFields["ORDER_LIST"] = $strOrderList;
  if($file_org)
	$arFields["FILE_ORG"] = 'https://'.$_SERVER['SERVER_NAME'].$file_org;
  if($file_id)
	$arFields["FILE_ORG"] = 'https://'.$_SERVER['SERVER_NAME'].$file_id;
  if ($arOrder['PRICE_DELIVERY'] && ($arOrder["DELIVERY_ID"]=='sdek:courier' || $arOrder["DELIVERY_ID"]=='sdek:pickup')) $arFields["DELIVERY_PRICE"] = "Стоимость доставки: {$arOrder['PRICE_DELIVERY']} руб <span style='color: red;'>*приблизительная стоимость (оплачивается отдельно по факту получения заказа)</span><br />";
  else $arFields["DELIVERY_PRICE"]="";
  
	
//file_put_contents($_SERVER["DOCUMENT_ROOT"].'/service/text.txt', print_r($arDeliv, true)."---------------<br />".print_r($arFields, true));
      }
   }
   
   


\Bitrix\Main\EventManager::getInstance()->addEventHandler( 

    'main', 

    '\Bitrix\Main\Mail\Internal\Event::OnBeforeAdd', 

    'onBeforeAdd'

); 



function onBeforeAdd(\Bitrix\Main\Entity\Event $event)

{

        $fields = $event->getParameter("fields");
		



        if($fields['EVENT_NAME']='SALE_STATUS_CHANGED_R') // модифицируем только конкретное почтовое событие
		{
			$cFields = $fields['C_FIELDS'];

			
			if(strpos($cFields['ORDER_ACCOUNT_NUMBER_ENCODE'], 'PB'))
			{
				$cFields['SALE_EMAIL'] = 'spb@krep-komp.ru';
			}

            $result = new \Bitrix\Main\Entity\EventResult();

			$changedFields = array(

				'C_FIELDS' => $cFields,

			);

			$result->modifyFields($changedFields);

        

			return $result;
		}elseif($fields['EVENT_NAME']='SALE_ORDER_PAID')
		{
			$cFields = $fields['C_FIELDS'];

			
			if(strpos($cFields['ORDER_ACCOUNT_NUMBER_ENCODE'], 'PB'))
			{
				$cFields['SALE_EMAIL'] = 'spb@krep-komp.ru';
			}

            $result = new \Bitrix\Main\Entity\EventResult();

			$changedFields = array(

				'C_FIELDS' => $cFields,

			);

			$result->modifyFields($changedFields);
		}
		

}


/* 
   
   //Антибот регистрации на сайте
AddEventHandler("main", "OnBeforeUserRegister", "OnBeforeUserRegisterHandler");
function OnBeforeUserRegisterHandler(&$arFields)
{
    global $APPLICATION;
    
    //В файл 1_txt.php будут записываться вск регистрации, можете закомментировать эти три строки
    $_REQUEST['DATE'] = date('d-m-Y H:i:s');
    $tttfile=$_SERVER['DOCUMENT_ROOT'].'/service/spam_txt.php';
    file_put_contents($tttfile, "<pre>".print_r($_REQUEST,1)."</pre>\n",FILE_APPEND);

    $arFields["LOGIN"] = $arFields["EMAIL"];
    if($_REQUEST['AUTH_FORM']=="Y")
    {
       if ($_REQUEST['_ym_uid'] == ''){
           file_put_contents($tttfile, "<pre>Ошибка регистрации</pre>\n",FILE_APPEND);
           $APPLICATION->ThrowException('Ошибка регистрации.');
           return false;
       }
    }

    
}
*/
   
   
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
			
		$replace = array();
		\Bitrix\Main\Loader::IncludeModule("iblock");


		$dbSections = \Bitrix\Iblock\SectionTable::getList(array(
			'filter'=>['IBLOCK_ID'=>'19'],
			'select'=>['IBLOCK_ID', 'ID', 'CODE', 'NAME', 'DESCRIPTION']
		));

		while($section = $dbSections->fetch())
		{
			if($_SERVER['HTTP_HOST']==$section['CODE'])
			{
				$replace = explode(";", $section['DESCRIPTION']);
				
			}
		
		
		}
		if(empty($replace))
		{
			$replace = array(
				'Москве',
				'Москве и МО',
				'<span>8 499 350-55-55</span>'
			);  
		}
		
    
    $content = str_replace($search, $replace, $content);
	//$content = preg_replace("  ", " ", $content);
	$content = str_replace("  ", " ", $content);
	//$content = sanitize_output($content);
	
	if(!($_SERVER['HTTP_HOST']=='krep-komp.ru' || $_SERVER['HTTP_HOST']=='spb.krep-komp.ru'))
	{	
		$content = str_replace('Адреса магазинов', 'Точки выдачи', $content);
	}
   }
   
   $content = str_replace(Array(" type=\"text/javascript\"", " type='text/javascript'"), "", $content);    
}




function sanitize_output($buffer)
{
   return preg_replace('~>\s*\n\s*<~', '><', $buffer);
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
         $title = $GLOBALS['APPLICATION']->getTitle();
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
		
		/*
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
		*/
		
		//Коллекция оплат
		$paymentCollection = $order->getPaymentCollection();
		
		
		if($arFields["PAY_SYSTEM_ID"] != 8)
		{
			Bitrix\Main\Diag\Debug::dumpToFile($arFields, "", '/upload/1.txt');
			$r = $paymentCollection[0]->setField('PAY_SYSTEM_ID', 8);
			$r = $paymentCollection[0]->setField('PAY_SYSTEM_NAME', 'Сбербанк');
			$r = $paymentCollection[0]->setField('XML_ID', 'bx_5d35f0eb89573');
			$r = $paymentCollection[0]->setField('XML_ID', 'bx_5d35f0eb89573');
			$result = $order->save();
		}
		
		if(empty($paymentCollection)){
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
			$paymentCollection->addItem($payment);
			$result = $order->save();
			
			\Bitrix\Main\Diag\Debug::dumpToFile($payment, "", '/upload/errors_pay.txt');
			if(!$result->isSuccess())
			{
				//\Bitrix\Main\Diag\Debug::dumpToFile($result->getErrors(), "", '/upload/errors_pay.txt');
				//$result->getErrors();
			}
		}
	}
}

AddEventHandler("iblock", "OnBeforeIBlockElementUpdate","DoNotUpdate");
function DoNotUpdate(&$arFields)
{
    if ($_REQUEST['mode']=='import')
    {
		if($arFields['PREVIEW_PICTURE'] || $arFields['DETAIL_PICTURE'])
		{
			$time = date("H:i:s");
			
		}
       //unset($arFields['PREVIEW_PICTURE']);
       //unset($arFields['DETAIL_PICTURE']);
        
    }
}

AddEventHandler("iblock", "OnBeforeIBlockSectionUpdate", "DoNotUpdateSectionActivate"); 
function DoNotUpdateSectionActivate(&$arFields)
{
	CModule::IncludeModule("iblock");
	$doNotUpdateActivates = [2777, 2779, 2780, 2781, 2782, 2783, 2784, 2785, 2802, 2803, 2558];
	$res = CIBlockSection::GetList(["SORT"=>"ASC"], ['IBLOCK_ID'=>17, 'ID'=>$arFields["ID"]],false, array("ID","IBLOCK_ID","IBLOCK_SECTION_ID","NAME","DESCRIPTION","UF_*"));
	if($ar_res = $res->Fetch())
		
	
	if(in_array($arFields["ID"], $doNotUpdateActivates) || $ar_res['UF_SECTION_ID'] || $ar_res['UF_SYM_LINK'])
		$arFields["ACTIVE"] = "Y";

	
}

$eventManager = \Bitrix\Main\EventManager::getInstance();
 
$eventManager->addEventHandlerCompatible('sale', 'OnBeforeOrderAccountNumberSet', 
function ($orderId, $type){
    if($type == 'siteid_orderid' && $orderId > 0){
        $arOrder = CSaleOrder::GetByID($orderId);
		if($_SERVER['HTTP_HOST']=='spb.krep-komp.ru')
			return sprintf('%s-%s', 'SPB', $orderId);
		else
			return sprintf('%s', $orderId);
    }
    return false;
});
 
$eventManager->addEventHandlerCompatible('sale', 'OnBuildAccountNumberTemplateList', 
function (){
   return array('CODE' => 'siteid_orderid', 'NAME' => '#SITE_ID#-#ORDER_ID#');
});


AddEventHandler("iblock", "OnBeforeIBlockElementUpdate","SaveInOldSectionVaterland"); 
  
function SaveInOldSectionVaterland(&$arFields) {
	if (@$_REQUEST['mode']=='import') {
 
		$db_old_groups = CIBlockElement::GetElementGroups($arFields['ID'], true);

		$all_ar_group = [];
		while($ar_group = $db_old_groups->Fetch()) {

			$all_ar_group[] = $ar_group['ID'];
			/*
			if(!in_array($ar_group['ID'],$arFields['IBLOCK_SECTION'])) {
				$arFields['IBLOCK_SECTION'][]=$ar_group['ID'];
			} 
			*/

		} 

		if(count($all_ar_group)>1) {
			$arFields['IBLOCK_SECTION'] = $all_ar_group;
		}

	}
}	


//ПЕЧАТЬ В ЧЕКАХ КОДА НОМЕНКЛАТУРЫ

AddEventHandler("sale", "OnSaleCheckPrepareData", "OnSaleCheckPrepareDataHandler");

function OnSaleCheckPrepareDataHandler($a, $str)
{
	
	
	foreach($a['PRODUCTS'] as $key=>$product)
	{
		if($product['PRODUCT_ID']==44497)
		{
			//$a['PRODUCTS'][$key]["NOMENCLATURE_CODE"] = __int64 4144676f705371;
			
		}

	}
	
	return $a;
		
}


//Местоположение в заказе по умолчанию

\Bitrix\Main\EventManager::getInstance()->addEventHandlerCompatible( 

    'sale', 
    'OnSaleComponentOrderProperties', 
    'SaleOrderEvents::fillLocation'

); 



class SaleOrderEvents 
{
    function fillLocation(&$arUserResult, $request, &$arParams, &$arResult) 
    {
        $registry = \Bitrix\Sale\Registry::getInstance(\Bitrix\Sale\Registry::REGISTRY_TYPE_ORDER);

        $orderClassName = $registry->getOrderClassName();

        $order = $orderClassName::create(\Bitrix\Main\Application::getInstance()->getContext()->getSite());

        $propertyCollection = $order->getPropertyCollection();



        foreach ($propertyCollection as $property)
        {

            if ($property->isUtil())

                continue;

            $arProperty = $property->getProperty();

            if ($arProperty['TYPE'] === 'LOCATION' && array_key_exists($arProperty['ID'],$arUserResult["ORDER_PROP"]) && !$request->getPost("ORDER_PROP_".$arProperty['ID']) && (!is_array($arOrder=$request->getPost("order")) || !$arOrder["ORDER_PROP_".$arProperty['ID']])) {
                if (strstr($_SERVER['HTTP_HOST'], "spb") && $arUserResult["ORDER_PROP"][$arProperty['ID']]==CURRENT_CITY_CODE) $arUserResult["ORDER_PROP"][$arProperty['ID']] = CURRENT_CITY_CODE_SPB;
            }
        }
    }

}

//AddEventHandler("main", "OnBeforeUserLogin", Array("CUserEx", "OnBeforeUserLogin"));
AddEventHandler("main", "OnBeforeUserRegister", Array("CUserEx", "OnBeforeUserRegister"));
AddEventHandler("main", "OnBeforeUserRegister", Array("CUserEx", "OnBeforeUserUpdate"));
AddEventHandler("main", "OnBeforeUserAdd", Array("CUserEx", "OnBeforeUserRegister"));


class CUserEx
{
   function OnBeforeUserLogin($arFields)
   {
      $filter = Array("EMAIL" => $arFields["LOGIN"]);
      $rsUsers = CUser::GetList(($by="ID"), ($order="asc"), $filter);
      if($user = $rsUsers->GetNext())
         $arFields["LOGIN"] = $user["LOGIN"];
      /*else $arFields["LOGIN"] = "";*/
   }
   public static function OnBeforeUserRegister(&$arFields)
   {
	   
      $arFields["LOGIN"] = $arFields["EMAIL"];
	  
   }
}



// обработка If-Modified-Since
/*AddEventHandler('main', 'OnEpilog', array('CBDPEpilogHooks', 'CheckIfModifiedSince'));

class CBDPEpilogHooks
{
   function CheckIfModifiedSince()
   {
      GLOBAL $lastModified;
      if ($lastModified)
      {
         header('Last-Modified: '.gmdate('D, d M Y H:i:s', $lastModified).' GMT');
         $arr = apache_request_headers();
         foreach ($arr as $header => $value)
         {
            if ($header == 'If-Modified-Since')
            {
               $ifModifiedSince = strtotime($value);
               if ($ifModifiedSince > $lastModified)
               {
                  $GLOBALS['APPLICATION']->RestartBuffer();
                  CHTTP::SetStatus('304 Not Modified');
               }
            }
         }
      }
   }
}*/



/*
AddEventHandler("iblock", "OnBeforeIBlockElementAdd", "AddElementOrSectionCode"); 
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", "AddElementOrSectionCode"); 
AddEventHandler("iblock", "OnBeforeIBlockSectionAdd", "AddElementOrSectionCode"); 
AddEventHandler("iblock", "OnBeforeIBlockSectionUpdate", "AddElementOrSectionCode"); 

function AddElementOrSectionCode(&$arFields) { 
   $params = array(
      "max_len" => "100", 
      "change_case" => "L", 
      "replace_space" => "_", 
      "replace_other" => "_", 
      "delete_repeat_replace" => "true", 
      "use_google" => "false", 
   );
   Bitrix\Main\Diag\Debug::dumpToFile($arFields['CODE'], "", '/upload/code_new.txt');
   Bitrix\Main\Diag\Debug::dumpToFile($arFields['NAME'], "", '/upload/code_new.txt');
   if (strlen($arFields["NAME"])>0 && strlen($arFields["CODE"])<=0 && $arFields["IBLOCK_ID"] == 17) {
      $arFields['CODE'] = CUtil::translit($arFields["NAME"], "ru", $params); 
		Bitrix\Main\Diag\Debug::dumpToFile($arFields['CODE'], "", '/upload/code.txt');	  
   }
}
*/


AddEventHandler('main', 'OnEpilog', 'OnEpilogHandler');  

function OnEpilogHandler()
{
    if ( isset($_GET['PAGEN_1']) && (intval($_GET['PAGEN_1'])>0) && (!defined('ERROR_404')) ) 
	{
        $title = $GLOBALS['APPLICATION']->GetProperty('title');
        $GLOBALS['APPLICATION']->SetPageProperty('title', $title.' (страница '.intval($_GET['PAGEN_1']).')');
        $description = $GLOBALS['APPLICATION']->GetProperty('description');
        $GLOBALS['APPLICATION']->SetPageProperty('description', $description.' (страница '.intval($_GET['PAGEN_1']).')');        
    }
	if ( isset($_GET['PAGEN_5']) && (intval($_GET['PAGEN_5'])>0) && (!defined('ERROR_404')) ) 
	{
        $title = $GLOBALS['APPLICATION']->GetProperty('title');
        $GLOBALS['APPLICATION']->SetPageProperty('title', $title.' (страница '.intval($_GET['PAGEN_5']).')');
        $description = $GLOBALS['APPLICATION']->GetProperty('description');
        $GLOBALS['APPLICATION']->SetPageProperty('description', $description.' (страница '.intval($_GET['PAGEN_5']).')');        
    }
	 
}
  
  


 
$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler('', 'SalePriceOnUpdate', 'OnUpdate');
 
function OnUpdate(\Bitrix\Main\Entity\Event $event) {
    $params = $event->getParameter("id");
//id обновляемого элемента
    $id = $params["ID"];
 
    $entity = $event->getEntity();
    $entityDataClass = $entity->GetDataClass();
	
if ($entityDataClass != "\SalePriceTable")	return;

// тип события. вернет ColorsOnUpdate
    $eventType = $event->getEventType();
// получаем массив полей хайлоад блока
    $arFields = $event->getParameter("fields");
	
	if($arFields["UF_FILE"]["tmp_name"]) copy($arFields["UF_FILE"]["tmp_name"], $_SERVER["DOCUMENT_ROOT"].$arFields["UF_SALE_LINK"]);

	
	//file_put_contents($_SERVER["DOCUMENT_ROOT"].'/service/text.txt', print_r($arFields, true).print_r($entityDataClass, true));
}	



//Почтовое событие
AddEventHandler("main", "OnBeforeEventAdd", "OnBeforeEventAddHandler");
	
function OnBeforeEventAddHandler(&$event, &$lid, &$arFields)
{
if ($event == 'USER_PASS_REQUEST' || $event == 'NEW_USER'){
	$arFields["SERVER_NAME"] = $_SERVER['HTTP_HOST'];
	//file_put_contents($_SERVER["DOCUMENT_ROOT"].'/service/text.txt', $event."-------------------".print_r($arFields, true));
}
}

//Вначале выполнения пролога
AddEventHandler("main", "OnPageStart", "OnPageStartHandler");
	
function OnPageStartHandler()
{
	if($_GET["mode"] == "import" && $_GET['type']=='sale' && $_GET['filename'])
	{
		\Bitrix\Main\Diag\Debug::dumpToFile(array($_REQUEST, date('H:i:s')), "", '/upload/1.txt');
		$DIR_NAME_OUR = $_SERVER["DOCUMENT_ROOT"]."/".COption::GetOptionString("main", "upload_dir", "upload")."/1c_exchange/";
		$DIR_NAME_TEMP = $_SERVER["DOCUMENT_ROOT"]."/".COption::GetOptionString("main", "upload_dir", "upload")."/temp_1c_exchange/";
		$file = $DIR_NAME_OUR.$_GET['filename'];
		$newfile = $DIR_NAME_TEMP.$_GET['filename'];
		copy($file, $newfile);
	}
}


\Bitrix\Main\EventManager::getInstance()->addEventHandler('catalog','\Bitrix\Catalog\Price::OnBeforeUpdate','onBeforePriceUpdate');

function onBeforePriceUpdate($event){

	$result = new Entity\EventResult;
	$data = $event->getParameter("fields");
	
   	if ($data["PRICE"]==0)
	{
		\Bitrix\Main\Diag\Debug::dumpToFile($data, "", '/upload/aa.txt');
		$result->unsetFields(array('PRICE'));
	}

   return $result;
   
}


\Bitrix\Main\EventManager::getInstance()->addEventHandler('catalog','\Bitrix\Catalog\Price::OnBeforeAdd','onBeforePriceAdd');

function onBeforePriceAdd($event){

	$result = new Entity\EventResult;
	$data = $event->getParameter("fields");
	
   	if ($data["PRICE"]==0)
	{
		\Bitrix\Main\Diag\Debug::dumpToFile($data, "", '/upload/a9.txt');
		$result->unsetFields(array('PRICE'));
	}

   return $result;
   
}