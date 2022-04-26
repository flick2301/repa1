<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

if ($_POST["NAME"] && $_POST["TEXT"]) {
$arEventFields = array(
   "EMAIL" => htmlspecialcharsbx($_POST["EMAIL"]),
   "PHONE" => htmlspecialcharsbx($_POST["PHONE"]),
   "NAME" => htmlspecialcharsbx($_POST["NAME"]),
   "TEXT" => htmlspecialcharsbx($_POST["TEXT"]),
 //'EMAIL_TO' => "kolobets@mail.ru", // email админа в настройках главного модуля
 );
 
 if ($_POST["NICE"]=="Y") $arEventFields["THEME"] = "Понравился сайт";
 else $arEventFields["THEME"] = "Не понравился сайт";
 
 CEvent::Send("GRADE_SITE", SITE_ID, $arEventFields);
	}
?>