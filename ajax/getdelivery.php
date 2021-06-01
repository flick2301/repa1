<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Application;

CModule::IncludeModule('iblock');
CModule::IncludeModule('catalog');

$request = Application::getInstance()->getContext()->getRequest();
$ID = $request->getPost("ID");
$HOST = $request->getPost("HOST");

//ПОЛУЧАЕМ ДОСТУПНОЕ КОЛИЧЕСТВО ТОВАРА НА СКЛАДАХ ПО ID ТОВАРА
if($ID)
{
	$rsStoreProduct = \Bitrix\Catalog\StoreProductTable::getList(array(
		'filter' => array('=PRODUCT_ID'=>$ID,'STORE.ACTIVE'=>'Y'),
		'select' => array('AMOUNT','STORE_ID','STORE_TITLE' => 'STORE.TITLE'),
	));

	while($arStoreProduct=$rsStoreProduct->fetch())
	{
		
		if($arStoreProduct['STORE_ID'] == STORE_ID_KASHIRKA[0])
			$amount['KASHIRKA'] = $arStoreProduct['AMOUNT'];
		if($arStoreProduct['STORE_ID'] == STORE_ID_KOLEDINO[0])
			$amount['KOLEDINO'] = $arStoreProduct['AMOUNT'];
		if($arStoreProduct['STORE_ID'] == STORE_ID_UZHKA[0])
			$amount['UZHKA'] = $arStoreProduct['AMOUNT'];
		if($arStoreProduct['STORE_ID'] == STORE_ID_SERPUH[0])
			$amount['STORE_ID_SERPUH'] = $arStoreProduct['AMOUNT'];
		if($arStoreProduct['STORE_ID'] == 12)
			$amount_SPB = $arStoreProduct['AMOUNT'];
	}
}

//ПОЛУЧАЕМ ИНФОРМАЦИЮ О РЕГИОНАЛЬНОМ СКЛАДЕ В ЗАВИСИМОСТИ ОТ ДОМЕНА
if($HOST)
{
	$rsStore = \Bitrix\Catalog\StoreTable::getList(array(
		'filter' =>['UF_HOST_NAME'=>$HOST],
		'select' => ['*', 'UF_*'],
	));

	if($arStore=$rsStore->fetch())
	{
		$sklad = $arStore;
	}
}

if($request->getPost("PICKUP")=='SHOW'):
	
	$delivery["KASHIRKA"] = ($amount['KASHIRKA'] && $clock<17) ? "Сегодня" : (($amount['KASHIRKA']) ? "Завтра c 9:00" : (($item['STORE'][STORE_ID_KOLEDINO[0]]['AMOUNT']) ? (($clock<17) ? "Сегодня при заказе до 14:30" : "Завтра при заказе до 14:30")  : "Под заказ"));
	$delivery["KOLEDINO"] = ($amount['KOLEDINO'] && $clock<17) ? "Сегодня" : (($amount['KOLEDINO']) ? "Завтра c 9:00" : "Под заказ");
	$delivery["UZHKA"] = ($amount['UZHKA'] && $clock<16) ? "Завтра с 12:00" : (($amount['UZHKA']) ? "Завтра c 12:00" : (($amount['KOLEDINO']) ? (($clock<17) ? "Завтра после 12:00 при заказе до 16:00" : "Завтра после 12:00 при заказе до 16:00") : "Под заказ"));
	$delivery["STORE_ID_SERPUH"] = ($amount['STORE_ID_SERPUH'] && $clock<16) ? "Завтра с 12:00" : (($amount['STORE_ID_SERPUH']) ? "Завтра c 12:00" : (($amount['KOLEDINO']) ? (($clock<17) ? "Завтра после 12:00 при заказе до 16:00" : "Завтра после 12:00 при заказе до 16:00") : "Под заказ"));

	$delivery_new['KASHIRKA'] = $amount['KOLEDINO'] ? '<p>сегодня после 14:00 при заказе до 11:00</p><p>сегодня после 17:00 при заказе до 15:00</p>' : '<p>Уточнить</p>';
	$delivery_new['KOLEDINO'] = $amount['KOLEDINO'] ? '<p><b>сегодня</b></p>' : '<p>Уточнить</p>';
	$delivery_new['UZHKA'] = $amount['KOLEDINO'] ? '<p>завтра после 13:00 при заказе до 18:00</p>' : '<p>Уточнить</p>';
	$delivery_new['STORE_ID_SERPUH'] = $amount['KOLEDINO'] ? '<p>завтра после 13:00 при заказе до 18:00</p>' : '<p>Уточнить</p>';
	$delivery_new['STORE_ID_KOPTEVSKAYA'] = $amount['KOLEDINO'] ? '<p>завтра после 14:00 при заказе до 17:30</p>' : '<p>Уточнить</p>';
	$delivery_SPB = $amount_SPB ? '<p>завтра после 13:00 при заказе до 18:00</p>' : '<p>Уточнить</p>';

	if($_SERVER['HTTP_HOST']=='spb.krep-komp.ru')
	{
		echo '<strong>Самовывоз</strong>
			<p>г. Санкт-Петербург, проспект Энергетиков, 22Л
			Склад и пункт выдачи<br> пн - пт: c 09:00 до 18:00;</p><p>Получение:</p>'.$delivery_SPB;
	}elseif($HOST != 'spb.krep-komp.ru' && $HOST != 'krep-komp.ru' && $sklad)
	{
		echo '<strong>Самовывоз</strong>
		<p>Адрес:<br>'.$sklad['ADDRESS'].'</p><p>Получение:</br>'.$sklad['SCHEDULE'].'</p>';
	}else{
		echo '<strong>Самовывоз</strong>
		<p>'.STORE_ID_KASHIRKA["1"].'<br> '.STORE_ID_KASHIRKA["2"].'</p><p>Получение:</p>'.$delivery_new['KASHIRKA'].'
		
		<div class="separator-block"></div>
		<p>'.STORE_ID_KOLEDINO["1"].'<br> '.STORE_ID_KOLEDINO["2"].'</p><p>Получение:</p>'.$delivery_new['KOLEDINO'].'
		
        <div class="separator-block"></div>
		<p>'.STORE_ID_UZHKA["1"].'<br> '.STORE_ID_UZHKA["2"].'</p><p>Получение:</p>'.$delivery_new['UZHKA'].'
		
		<div class="separator-block"></div>
		<p>'.STORE_ID_KOPTEVSKAYA["1"].'<br> '.STORE_ID_KOPTEVSKAYA["2"].'</p><p>Получение:</p>'.$delivery_new['STORE_ID_KOPTEVSKAYA'].'
		
		<div class="separator-block"></div>
		<p>'.STORE_ID_SERPUH["1"].'<br> '.STORE_ID_SERPUH["2"].'</p><p>Получение:</p>'.$delivery_new['STORE_ID_SERPUH'].'
		';
	}
elseif($request->getPost("DELIVERY")=='SHOW'):
	if($_SERVER['HTTP_HOST']=='spb.krep-komp.ru')
	{
		if($amount_SPB)
			echo '<strong>Доставка</strong><p>Сегодня<br> При заказе до 14:30</p>';
		else
			echo '<strong>Доставка</strong><p>На заказ</p>';
	}else
	{
		if($amount['KOLEDINO'])
		{
			if($HOST != 'krep-komp.ru' && $sklad['UF_DELIVERY_TIME'])
				echo '<strong>Доставка</strong><p>'.$sklad['UF_DELIVERY_TIME'].'</p>';
			else
				echo '<strong>Доставка</strong><p>Сегодня<br> При заказе до 14:30</p>';
		}
		else
			echo '<strong>Доставка</strong><p>На заказ</p>';
	}
		
endif;



