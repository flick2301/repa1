<?
if (!$_POST['email']) die();
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

$filter = Array
(
    "ACTIVE"              => "Y",
    "EMAIL"               => str_replace(Array("<", ">"), Array("", ""), $_POST['email']),
);
$rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $filter); // выбираем пользователей
$is_filtered = $rsUsers->is_filtered; // отфильтрована ли выборка ?
$rsUsers->NavStart(1); // разбиваем постранично по 50 записей
echo $rsUsers->NavPrint(GetMessage("PAGES")); // печатаем постраничную навигацию
while($rsUsers->NavNext(true, "f_")) echo true;	
