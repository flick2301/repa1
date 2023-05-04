<?php
use \Bitrix\Main\Loader;

if(!defined('B_PROLOG_INCLUDED')||B_PROLOG_INCLUDED!==true)die();

if ($_GET['PAGEN_1']==='1') {

  LocalRedirect( $APPLICATION->GetCurPageParam("", array("PAGEN_1")) );
  exit();

}

// #
// # События и обработчики
// #
include_once($_SERVER['DOCUMENT_ROOT'].'/local/php_interface/include/handlers.php');
 
// #
// # Агенты
// #
include_once($_SERVER['DOCUMENT_ROOT'].'/local/php_interface/include/agent.php');

// #
// # Функции
// #
include_once($_SERVER['DOCUMENT_ROOT'].'/local/php_interface/include/functions.php');
 
// #
// # Константы
// #
if(strstr($_SERVER['HTTP_HOST'], "dev"))
	include_once($_SERVER['DOCUMENT_ROOT'].'/local/php_interface/include/dev_constants.php');
else
	include_once($_SERVER['DOCUMENT_ROOT'].'/local/php_interface/include/constants.php');

//Классы

Loader::registerAutoLoadClasses(null, array(
    '\Olepro\Classes\Helpers\MobileDetect' => '/local/classes/helpers/mobiledetect.php',
));


//Классы (СВои)
include_once($_SERVER['DOCUMENT_ROOT'].'/local/php_interface/include/classes/autoload.php');

// Roistat BEGIN CODE
include_once __DIR__ . '/roistat/roistat_integration.php';
// Roistat END CODE

/*Выставляем заголовки if-modified-since */
require($_SERVER['DOCUMENT_ROOT'].'/local/libs/if-modified-since.php');


?>