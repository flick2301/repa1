<?php
//УДАЛЕНИЕ ЭЛЕМЕНТОВ С ПУСТЫМИ ЦЕНАМИ(ЕДИНСТВЕННЫЙ СПОСОБ ЗАЧИСТКИ УСТАРЕВШИХ ПОЗИЦИЙ ИЗ 1С)
//А ТАК ЖЕ РАНЖИРОВАНИЕ ПОЗИЦИЙ С ВНУТРЕННИМ ДИАМЕТРОМ (добавление числового значения диаметра)
function AgentDeleteZeroElements(){
    
    if(CModule::IncludeModule('iblock')){
       
    //ПОИСК ЭЛЕМЕНТОВ ГДЕ ЦЕНА = 0 или пустая и УДАЛЕНИЕ
    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_CML2_ARTICLE");
    $arFilter = Array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, 
                    array(
        		"LOGIC" => "OR",
        		array("CATALOG_PRICE_".NUMBER_BASE_PRICE=>false),
        		array("CATALOG_PRICE_".NUMBER_BASE_PRICE=>"0"),
                    ),
		);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNext()){ 
        
        $elements[]=$ob['ID'].' '.$ob['PROPERTY_CML2_ARTICLE_VALUE'].'<br>';
	CIBlockElement::Delete($ob['ID']);

    }
    CEventLog::Add(array(
		"SEVERITY"=>"SECURETY",
		"AUDIT_TIPY_ID"=>"CHECK_PRICE_AND_DELETE",
		"MODULE_ID"=>"iblock",
		"ITEM_ID"=>"",
		"DESCRIPTION"=>"Проверка нулевых элементов. Удалено ".count($elements)." элементов",
		));
    }
	
	
	//ДОБАВЛЕНИЕ INTEGER ВНУТ. ДИАМЕТРА
	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
	$arFilter = Array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, "ACTIVE"=>"Y", "PROPERTY_DIAMETR_VNUTRENNIY_VALUE"=>"м%", "PROPERTY_DIAMETR_VNUTRENNIY_INTEGER"=>false);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
	while($ob = $res->GetNextElement()){ 

		$arFields = $ob->GetFields();  
		$arProps = $ob->GetProperties();
	
		$ELEMENT_ID = $arFields['ID'];  // код элемента
		$PROPERTY_CODE = "DIAMETR_VNUTRENNIY_INTEGER";  // код свойства
		$PROPERTY_VALUE = str_replace('м', '', $arProps['DIAMETR_VNUTRENNIY']['VALUE']);  // значение свойства

		// Установим новое значение для данного свойства данного элемента
		CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array($PROPERTY_CODE => $PROPERTY_VALUE));
		
	
	}
    return "AgentDeleteZeroElements();";
}
function AgentCheckCatalogProps(){
    if(CModule::IncludeModule('iblock')){
    
    
    //ПОИСК ЭЛЕМЕНТОВ ГДЕ ЕСТЬ ЦЕНА ПО РАСПРОДАЖИ, НО НЕ ПРОСТАВЛЕНА АКЦИЯ
    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
    $arFilter = Array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, "!=PROPERTY_FOR_SALE"=>"По акции", ">CATALOG_PRICE_SCALE_".NUMBER_SALE_PRICE=>"0", "");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array('nPageSize' => 100), $arSelect);
    while($ob = $res->GetNextElement()){ 
        $arFields = $ob->GetFields();  
        $arProps = $ob->GetProperties();
        
        $ELEMENT_ID = $arFields['ID'];  // код элемента
        $PROPERTY_CODE = "FOR_SALE";  // код свойства
        $PROPERTY_VALUE = "По акции";  // значение свойства

        // Установим новое значение для данного свойства данного элемента
        CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array($PROPERTY_CODE => $PROPERTY_VALUE));
		
        
    }
    
    
    //ПОИСК ЭЛЕМЕНТОВ ГДЕ ПРОСТАВЛЕНА АКЦИЯ, НО РАСПРОДАЖНОЙ ЦЕНЫ НЕТ
    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
    $arFilter = Array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, "PROPERTY_FOR_SALE"=>"По акции", "CATALOG_PRICE_SCALE_".NUMBER_SALE_PRICE=>false, "");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array('nPageSize' => 100), $arSelect);
    while($ob = $res->GetNextElement()){
        
        $arFields = $ob->GetFields();  
        $arProps = $ob->GetProperties();
        echo $arFields['ID'].'<br>';
        $ELEMENT_ID = $arFields['ID'];  // код элемента
        $PROPERTY_CODE = "FOR_SALE";  // код свойства
        $PROPERTY_VALUE = "";  // значение свойства

        // Установим новое значение для данного свойства данного элемента
        CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array($PROPERTY_CODE => $PROPERTY_VALUE));
		\Bitrix\Main\Diag\Debug::dumpToFile($ELEMENT_ID, "", '/upload/net_akc.txt');
        
    }
    
    
    //ПОИСК ЭЛЕМЕНТОВ ГДЕ ЕСТЬ НАЛИЧИЕ, НО НЕ ПРОСТАВЛЕНА ГАЛОЧКА
    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
    $arFilter = Array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, "!=PROPERTY_IN_STOCK"=>"В наличии", ">CATALOG_QUANTITY"=>"0", "");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array('nPageSize' => 500), $arSelect);
    while($ob = $res->GetNextElement()){ 
        $arFields = $ob->GetFields();  
        $arProps = $ob->GetProperties();
        
        $ELEMENT_ID = $arFields['ID'];  // код элемента
        $PROPERTY_CODE = "IN_STOCK";  // код свойства
        $PROPERTY_VALUE = "В наличии";  // значение свойства
        
        // Установим новое значение для данного свойства данного элемента
        CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array($PROPERTY_CODE => $PROPERTY_VALUE));
        
    }
    
    
    //ПОИСК ЭЛЕМЕНТОВ ГДЕ НЕТ НАЛИЧИЯ, НО ПРОСТАВЛЕНА ГАЛОЧКА
    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
    $arFilter = Array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, "PROPERTY_IN_STOCK"=>"В наличии", "CATALOG_QUANTITY"=>"0", "");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array('nPageSize' => 500), $arSelect);
    while($ob = $res->GetNextElement()){ 
        $arFields = $ob->GetFields();  
        $arProps = $ob->GetProperties();
        
        $ELEMENT_ID = $arFields['ID'];  // код элемента
        $PROPERTY_CODE = "IN_STOCK";  // код свойства
        $PROPERTY_VALUE = "";  // значение свойства
        
        // Установим новое значение для данного свойства данного элемента
        CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array($PROPERTY_CODE => $PROPERTY_VALUE));
		\Bitrix\Main\Diag\Debug::dumpToFile($ELEMENT_ID, "", '/upload/net_v_nal.txt');
        
    }
    

    }
    return "AgentCheckCatalogProps();";
}

function AgentPayment(){

	CModule::IncludeModule(
		'sale'
	);


	$arFilter = Array(
		"PAYED" => "N",
		"STATUS_ID" => "R"
	);

	$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	while ($ar_sales = $db_sales->Fetch())
	{
		$order_id = $ar_sales["ID"];
		$order = \Bitrix\Sale\Order::load($order_id);

		if($ar_sales["COMMENTS"]!=''){
			
			$arDeliv  = explode("$", $row['COMMENTS']);
			$deliv = $arDeliv[1];

			if($deliv!=''){
				/*
				
				$result = \Bitrix\Sale\Internals\OrderChangeTable::getList(array('order'=>array('DATE_CREATE'=>'DESC','ID'=>'DESC'), 'filter'=>array('ORDER_ID'=>$order_id,	'TYPE'=>array('SHIPMENT_REMOVED'))));
	            if($historyItem = $result->fetch()){
					$data = unserialize($historyItem['DATA']);
				}
				
				
				//Коллекция доставок
				$shipmentCollection = $order->getShipmentCollection();
				$deliveryIds = $order->getDeliverySystemId();
				if(end($deliveryIds)){
					$deliver_id = end($deliveryIds);
				}else{
					$deliver_id = $data['DELIVERY_ID'];
				}
		
				//Удаляем старые
				$rsShipment = \Bitrix\Sale\Internals\ShipmentTable::getList(array('filter'=>array('ORDER_ID' => $order_id),));
				while($arShipment=$rsShipment->fetch())

				{
					\Bitrix\Sale\Internals\ShipmentTable::delete($arShipment['ID']);
				}
		
				//Создаем новую
				$shipment = $shipmentCollection->createItem(
					Bitrix\Sale\Delivery\Services\Manager::getObjectById($deliver_id)
				);
				$shipmentItemCollection = $shipment->getShipmentItemCollection();
				$service = \Bitrix\Sale\Delivery\Services\Manager::getById(end($deliveryIds));
				$deliveryData = [
					'DELIVERY_ID' => $service['ID'],
					'DELIVERY_NAME' => $service['NAME'],
					'ALLOW_DELIVERY' => 'Y',
					'PRICE_DELIVERY' => $deliv,
					'CUSTOM_PRICE_DELIVERY' => 'Y'
				];
				$shipment->setFields($deliveryData);
				$order->save();
				*/
			}
		}
		
		//Коллекция оплат
		$paymentCollection = $order->getPaymentCollection();
		$sum = $paymentCollection->getSum();

		if($sum=='0'){
			$payment = $paymentCollection->createItem(
			\Bitrix\Sale\PaySystem\Manager::getObjectById(8)
			);
			$payment->setField("SUM", $order->getPrice());
			$payment->setField("CURRENCY", $order->getCurrency());
			$result = $order->save();
			if (!$result->isSuccess())
			{
				//$result->getErrors();
			}
		}
	}
	return "AgentPayment();";
}
?>
