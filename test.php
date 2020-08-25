<?
//if (!$_POST['login'] || !$_POST['pass']) die();
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

global $USER;
if (!is_object($USER)) $USER = new CUser;

$arAuthResult = $USER->Login("kolobets", "DENIS1980");
$result = $APPLICATION->arAuthResult = $arAuthResult;
if (!is_array($result) && $result==true) echo $result;
