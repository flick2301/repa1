<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');
CModule::IncludeModule('catalog');

if($_REQUEST['PICKUP']=='SHOW'):
$ID = $_REQUEST['ID'];
$rsStoreProduct = \Bitrix\Catalog\StoreProductTable::getList(array(
    'filter' => array('=PRODUCT_ID'=>$ID,'STORE.ACTIVE'=>'Y'),
    'select' => array('AMOUNT','STORE_ID','STORE_TITLE' => 'STORE.TITLE'),
));

while($arStoreProduct=$rsStoreProduct->fetch())
{
	/*echo '<pre>';
    print_r($arStoreProduct);
	echo '</pre>';
	*/
	if($arStoreProduct['STORE_ID'] == STORE_ID_KASHIRKA[0])
		$amount['KASHIRKA'] = $arStoreProduct['AMOUNT'];
	if($arStoreProduct['STORE_ID'] == STORE_ID_KOLEDINO[0])
		$amount['KOLEDINO'] = $arStoreProduct['AMOUNT'];
	if($arStoreProduct['STORE_ID'] == STORE_ID_UZHKA[0])
		$amount['UZHKA'] = $arStoreProduct['AMOUNT'];
	if($arStoreProduct['STORE_ID'] == STORE_ID_SERPUH[0])
		$amount['STORE_ID_SERPUH'] = $arStoreProduct['AMOUNT'];
}

$delivery["KASHIRKA"] = ($amount['KASHIRKA'] && $clock<17) ? "Сегодня" : (($amount['KASHIRKA']) ? "Завтра c 9:00" : (($item['STORE'][STORE_ID_KOLEDINO[0]]['AMOUNT']) ? (($clock<17) ? "Сегодня при заказе до 14:30" : "Завтра при заказе до 14:30")  : "Под заказ"));
$delivery["KOLEDINO"] = ($amount['KOLEDINO'] && $clock<17) ? "Сегодня" : (($amount['KOLEDINO']) ? "Завтра c 9:00" : "Под заказ");
$delivery["UZHKA"] = ($amount['UZHKA'] && $clock<16) ? "Завтра с 12:00" : (($amount['UZHKA']) ? "Завтра c 12:00" : (($amount['KOLEDINO']) ? (($clock<17) ? "Завтра после 12:00 при заказе до 16:00" : "Завтра после 12:00 при заказе до 16:00") : "Под заказ"));
$delivery["STORE_ID_SERPUH"] = ($amount['STORE_ID_SERPUH'] && $clock<16) ? "Завтра с 12:00" : (($amount['STORE_ID_SERPUH']) ? "Завтра c 12:00" : (($amount['KOLEDINO']) ? (($clock<17) ? "Завтра после 12:00 при заказе до 16:00" : "Завтра после 12:00 при заказе до 16:00") : "Под заказ"));
echo '<strong>Самовывоз</strong>
		<p>'.STORE_ID_KASHIRKA["1"].'<br> '.STORE_ID_KASHIRKA["2"].'</p>
		<p>В наличии: <strong class="icon-nal">'.$amount["KASHIRKA"].' уп.</strong></p>
		<p>Доступно к получению: <strong>'.$delivery["KASHIRKA"].'</strong></p>
		<div class="separator-block"></div>
		<p>'.STORE_ID_KOLEDINO["1"].'<br> '.STORE_ID_KOLEDINO["2"].'</p>
		<p>В наличии: <strong class="icon-nal">'.$amount["KOLEDINO"].' уп.</strong></p>
		<p>Доступно к получению: <strong>'.$delivery["KOLEDINO"].'</strong></p>
        <div class="separator-block"></div>
		<p>'.STORE_ID_UZHKA["1"].'<br> '.STORE_ID_UZHKA["2"].'</p>
		<p>В наличии: <strong class="icon-nal">'.$amount['UZHKA'].' уп.</strong></p>
		<p>Доступно к получению: <strong>'.$delivery["UZHKA"].'</strong></p>
		<div class="separator-block"></div>
		<p>'.STORE_ID_SERPUH["1"].'<br> '.STORE_ID_SERPUH["2"].'</p>
		<p>В наличии: <strong class="icon-nal">'.$amount['STORE_ID_SERPUH'].' уп.</strong></p>
		<p>Доступно к получению: <strong>'.$delivery["STORE_ID_SERPUH"].'</strong></p>';
elseif($_REQUEST['DELIVERY']=='SHOW'):
echo '<strong>Доставка</strong>
										<p>На следующий день<br> При заказе до 16:00</p>';
endif;


