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
define("ID_SALE_PRICE", "Распродажа");

define("CATALOG_IBLOCK_ID", "17");
const SORTING_IBLOCK_ID = '18';
define("SALE_SECTION_ID", "1655");
define("NUMBER_SALE_PRICE", "8");
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
}
else{
	global $DEFAULT_STORE_ID; 
	$DEFAULT_STORE_ID= 3;
}
const ID_PRICE_5 = '11';
const ID_PRICE_10 = '12';
const ID_PRICE_13 = '10';
const ID_PRICE_18 = '13';

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
const CURRENT_CITY_CODE_SPB = "0000103664";
const GEOLOCATION_MOSCOW = "49002";
const PAGE_ELEMENT_COUNT = Array(20, 35, 50); 
const PAGE_ELEMENT_COUNT_NEW = Array(24, 36, 48); 