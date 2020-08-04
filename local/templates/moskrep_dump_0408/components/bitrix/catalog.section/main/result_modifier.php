<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$basket = [];
$basketResultSet = CSaleBasket::GetList(
    ['NAME' => 'ASC'],
    ['FUSER_ID' => CSaleBasket::GetBasketUserID(), 'LID' => SITE_ID, 'ORDER_ID' => 'NULL']
);
while (($basketItem = $basketResultSet->fetch())) {
    $arResult['IN_BASKET'][$basketItem['PRODUCT_ID']] = 'Y';
}
