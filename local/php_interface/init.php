<?php
if(!defined('B_PROLOG_INCLUDED')||B_PROLOG_INCLUDED!==true)die();

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


?>