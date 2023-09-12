<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Коды свойств товаров(для умного фильтра)

define("ID_PROPERTY_COUNT", "KOLICHESTVO_V_UPAKOVKE");
define("ID_PROPERTY_TSVET", "TSVET");
define("ID_PROPERTY_DIAMETR", "DIAMETR");
define("ID_PROPERTY_DLINA", "DLINA");
define("ID_PROPERTY_STOCK", "IN_STOCK");
define("ID_PROPERTY_FOR_SALE", "FOR_SALE");
if($_SERVER['HTTP_HOST']=='sale.krep-komp.ru')
	define("ID_SALE_PRICE", "Распродажа");


define("CATALOG_IBLOCK_ID", "17");
const SORTING_IBLOCK_ID = '18';
const ARTICLES_IBLOCK_ID = 16;
const SHOPS_IBLOCK_ID = 19;
const GEOLOCATION_IBLOCK_ID = 23;
define("SALE_SECTION_ID", "1655");
if($_SERVER['HTTP_HOST']=='sale.krep-komp.ru')
	define("NUMBER_SALE_PRICE", "8");
else
	define("NUMBER_SALE_PRICE", "0");
define("NUMBER_BASE_PRICE", "9");
define("ID_BASE_PRICE", "К0 (БАЗОВАЯ НАЧАЛЬНАЯ)");
// id highload-инфоблока Таблицы веса(картинка в саморезах)
define("VES_HB_ID", 5);
// id highload-инфоблока Тех. характеристик(картинка в саморезах)
define("TECH_HB_ID", 4);
// id highload-инфоблока Шаблоны для размеров саморезов(текст)
define("SIZE_HB_ID", 6);
define("URL_MARKETS", "/addresses/");
define("NEW_TEMPL_SECTION", array("1656", "1767", "1831", "2558", '1796', '1878', '1688'));
const ARR_UINTS_MM = array('DIAMETR', 'SHIRINA', 'VYSOTA', 'DLINA');
const ARR_UNITS_SHT = array('KOLICHESTVO_V_UPAKOVKE');
const ARR_UNITS_RAL = array('TSVET');

define("IBLOCK_ID_CERT", "8");
define("KREPEZH_NAME", "Крепеж");
const STORE_ID_KASHIRKA = Array('7', 'г. Москва, Каширское ш., 7к3', 'пн-пт 9:00-19:00; сб 10:00-16:00; вс выходной');
const STORE_ID_KOLEDINO = Array('3', 'МО, округ Подольск, Коледино, 1Вс3, склад #6', 'пн-пт 9:00-18:00; сб-вс выходной', 'МО, округ Подольоск,<br> Коледино, 1Вс3, склад #6');
const STORE_ID_UZHKA = Array('9', 'Москва, 2-й Кабельный проезд, дом 1, блок 2, 1-ый этаж, павильон №106', 'пн-пт 9:00-18:00; сб-вс выходной');
const STORE_ID_SERPUH = Array('10', 'Московская область, город Серпухов, улица Звездная 6а, павильон №3', 'пн-пт 9:00-18:00; сб-вс выходной');
const STORE_ID_KOPTEVSKAYA = Array('111', 'Москва, улица Коптевская 83, корпус 2', 'пн-пт 9:00-18:00; сб-вс выходной');
if($_SERVER['HTTP_HOST']=='spb.krep-komp.ru'){
	global $DEFAULT_STORE_ID; 
	$DEFAULT_STORE_ID= 12;
}elseif($_SERVER['HTTP_HOST']=='novosibirsk.krep-komp.ru'){
	global $DEFAULT_STORE_ID; 
	$DEFAULT_STORE_ID= 3;
}else{
	global $DEFAULT_STORE_ID; 
	$DEFAULT_STORE_ID= 3;
}
const ID_PRICE_5 = '19';
const ID_PRICE_10 = '20';
const ID_PRICE_15 = '21';
const ID_PRICE_20 = '22';
const ID_PRICE_25 = '11';
const ID_PRICE_30 = '12';
const ID_PRICE_35 = '10';

//Платежные системы
const BY_CARD = 8;

const ARR_CODE_CAT_WITH_BOTTOM_CATEGORIES_LIST = ['bolty', 'vinty', 'gayki', 'shayby', 'shpilki'];

const ID_DELIVERY_DAYTODAY = 36;
const ID_DELIVERY_SUNDAY = 37;
const SHOPS_SPB = 2631;
const SHOPS_NN = 2834;
const SHOPS_KAZ = 2836;
const SHOPS_VOR = 2837;
const ORDER_PROPERTY_DELIVERY_PRICE1 = 48;
const ORDER_PROPERTY_DELIVERY_PRICE2 = 49;
const CURRENT_CITY_CODE = "0000073738";
const CURRENT_CITY_CODE_PODOLSK = "0000177609";
const CURRENT_CITY_CODE_SPB = "0000103664";
const CURRENT_CITY_CODE_YOSHKAR_OLA = "0000576828";
const CURRENT_CITY_CODE_ARHANGELSK = "0000110423";
const CURRENT_CITY_CODE_ASTRAHAN = "0000477579";
const CURRENT_CITY_CODE_BELGOROD = "0000133095";
const CURRENT_CITY_CODE_BRYANSK = "0000278519";
const CURRENT_CITY_CODE_VLADIMIR = "0000312126";
const CURRENT_CITY_CODE_VOLGOGRAD = "0000426112";
const CURRENT_CITY_CODE_VOLOGDA = "0000336617";
const CURRENT_CITY_CODE_VORONEZH = "0000293598";
const CURRENT_CITY_CODE_EKATERINBURG = "0000812044";
const CURRENT_CITY_CODE_IZHEVSK = "0000624093";
const CURRENT_CITY_CODE_KAZAN = "0000550426";
const CURRENT_CITY_CODE_KALININGRAD = "0000354349";
const CURRENT_CITY_CODE_KALUGA = "0000147475";
const CURRENT_CITY_CODE_KRASNODAR = "0000386590";
const CURRENT_CITY_CODE_KURGAN = "0000838330";
const CURRENT_CITY_CODE_KURSK = "0000168097";
const CURRENT_CITY_CODE_LIPETSK = "0000177609";
const CURRENT_CITY_CODE_MAGNITOGORSK = "0000859112";
const CURRENT_CITY_CODE_NABEREZHNIE_CHELNY = "0000552670";
const CURRENT_CITY_CODE_NIZHNIY_NOVGOROD = "0000600317";
const CURRENT_CITY_CODE_NOVOSIBIRSK = "0000949228";
const CURRENT_CITY_CODE_OREL = "0000187229";
const CURRENT_CITY_CODE_ORENBURG = "0000709964";
const CURRENT_CITY_CODE_PENZA = "0000697597";
const CURRENT_CITY_CODE_PERM = "0000670178";
const CURRENT_CITY_CODE_PSKOV = "0000362683";
const CURRENT_CITY_CODE_ROSTOV_NA_DONU = "0000445112";
const CURRENT_CITY_CODE_RYAZAN = "0000197740";
const CURRENT_CITY_CODE_SAMARA = "0000650509";
const CURRENT_CITY_CODE_SARANSK = "0000542813";
const CURRENT_CITY_CODE_SARATOV = "0000776525";
const CURRENT_CITY_CODE_SMOLENSK = "0000207393";
const CURRENT_CITY_CODE_STAVROPOL = "0000509929";
const CURRENT_CITY_CODE_TAMBOV = "0000220223";
const CURRENT_CITY_CODE_TVER = "0000230626";
const CURRENT_CITY_CODE_TULA = "0000250453";
const CURRENT_CITY_CODE_TYUMEN = "0000794760";
const CURRENT_CITY_CODE_UFA = "0000728734";
const CURRENT_CITY_CODE_CHEBOKSARY = "0000638402";
const CURRENT_CITY_CODE_CHELYABINSK = "0000854968";
const CURRENT_CITY_CODE_CHEREPOVEC = "0000336376";
const CURRENT_CITY_CODE_YAROSLAVL = "0000263227";

const GEOLOCATION_MOSCOW = "49002";
const PAGE_ELEMENT_COUNT = Array(20, 35, 50); 
const PAGE_ELEMENT_COUNT_NEW = Array(24, 36, 48);
const RUS_DATE = Array('январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь');