<?php

// Roistat BEGIN CODE

use Bitrix\Main\Event;
use Bitrix\Sale;
use Bitrix\Sale\Delivery\Services\Manager;

require_once __DIR__ . '/roistat_send.php';

$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler('sale', 'OnSaleOrderSaved', 'rsOnAddOrder');

function rsOnAddOrder(Event $event) {
    if(!$event->getParameter('IS_NEW')) return;
    /** @var Sale\Order $order */
    $order              = $event->getParameter('ENTITY');
    $order_id           = $order->getId();
    $basket             = $order->getBasket();
    $propertyCollection = $order->getPropertyCollection();

    $products = array();
    $items  = $basket->getBasketItems();
    foreach ($items as $item) {
        $products[] = array(
            'id' => $item->getId(),
            'name'  => $item->getField('NAME'),
            'price' => $item->getPrice(),
            'count' => $item->getQuantity(),
        );
    }
    $list = null;
    foreach($basket->getListOfFormatText() as $item) {
        $list .= $item."\n";
    }

    $price       = $order->getPrice();
    $discount    = $order->getDiscountPrice();
    $description = $order->getField('USER_DESCRIPTION');
    $userName  = null;
    $phone     = null;
    $email     = null;
    $address   = null;
    $location  = null;
    $city      = null;
    $index     = null;
    $sdek      = null;
    $type_delivery = null;

    foreach ($propertyCollection as $property) {
        $code  = $property->getField('CODE');
        $value = $property->getValue();

        switch($code) {
            case 'PPHONE':
                $phone = $value;
                break;
            case 'EMAIL':
                $email = $value;
                break;
            case 'FIO':
                $userName = $value;
                break;
            case 'CONTACT_PERSON':
                $userName = $value;
                break;
            case 'LOCATION':
                $location = CSaleLocation::GetByID(CSaleLocation::getLocationIDbyCODE($value));
                break;
            case 'ADDRESS':
                $address = $value;
                break;
            case 'ZIP':
                $index = $value;
                break;
            case 'CITY':
                $city = $value;
                break;
            case 'IPOLSDEK_CNTDTARIF':
                $sdek = $value;
                break;
            case 'RUSSIANPOST_TYPEDLV	':
                $type_delivery = $value;
                break;
        }
    }

    $paymentCollection = $order->getPaymentCollection();
    $paymentName = $paymentCollection['0']->getPaymentSystemName();
    $deliverySystemId = $order->getDeliverySystemId();
    $managerById = Manager::getById($deliverySystemId['0']);
    $deliveryName = $managerById['NAME'];
    $form_name = "Корзина";

    $comment = "{$description} \n";

    $comment .= "\n\nСписок товаров:\n".
        "{$list}\n\n".
        "Способ доставки: {$deliveryName}\n".
        "Способ оплаты: {$paymentName}\n".
        "Рассчитанный тариф СДЭК: {$sdek}\n".
        "Тип доставки (Для официального модуля Почты России): {$type_delivery}\n";

    if ($order->getDeliveryPrice() > 0) {
        $comment .= 'Доставка - '.number_format($order->getDeliveryPrice(),0,'',' ')." руб\n";
    }

    if ($discount > 0) {
        $comment .= 'Скидка - '.number_format($discount,0,'',' ')." руб\n";
    }
    $comment .= "Итого - {$price} руб";

    $roistatData = array(
        'comment' => $comment,
        'title' => $form_name,
        'name'    => $userName,
        'email'   => $email,
        'phone'   => $phone,
        'fields' => array(
            "roistat_marker" => isset($_COOKIE['roistat_marker']) ? $_COOKIE['roistat_marker'] : "-",
            "location" => $location,
            "adress" => $address,
            "order_city" => $city,
            "shipping_method" => $deliveryName,
            "payment_method" => $paymentName,
            "price" => $price,
            "price_delivery" => $order->getDeliveryPrice(),
            "discount" =>  $discount,
            "products" => $products,
            "comment" => $description,
            'form'  => $form_name,
            'order_num' =>  $order_id,
            'referrer'  =>  '{referrer}',
            'landingPage'  =>  '{landingPage}',
            'source'  =>  '{source}',
            'utmSource'  =>  '{utmSource}',
            'utmMedium'  =>  '{utmMedium}',
            'utmCampaign'  =>  '{utmCampaign}',
            'utmTerm'  =>  '{utmTerm}',
            'utmContent'  =>  '{utmContent}',
            'city'  =>  '{city}',

        ),
    );

    $roistat = new Roistat();
    $roistat->setSiteName('krep-komp.ru');
    $roistat->sendLead($roistatData);
}