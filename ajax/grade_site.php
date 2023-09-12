<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Application;

$context = Application::getInstance()->getContext();
$request = $context->getRequest();
$referer = $request->getHeaders()->get('referer');

$server = "<table>";
foreach($_SERVER AS $key=>$val) {
	$server.="<tr><td>".htmlspecialcharsbx($key).": ".htmlspecialcharsbx($val)."</td></tr>";
}
$server .= "</table>";


if ($_POST["GNAME"] && $_POST["GTEXT"]) {
$arEventFields = array(
   "GEMAIL" => htmlspecialcharsbx($_POST["GEMAIL"]),
   "GPHONE" => htmlspecialcharsbx($_POST["GPHONE"]),
   "GNAME" => htmlspecialcharsbx($_POST["GNAME"]),
   "GTEXT" => htmlspecialcharsbx($_POST["GTEXT"]),
   "GORDERID" =>htmlspecialcharsbx($_POST["GORDERID"]),
   "GREFERER" => htmlspecialcharsbx($referer),
 //'EMAIL_TO' => "kolobets@mail.ru", // email админа в настройках главного модуля
 );
 
 if ($_POST["GNICE"]=="Y") $arEventFields["GTHEME"] = "Понравился сайт";
 else $arEventFields["GTHEME"] = "Не понравился сайт";
 
 if (!$_SERVER["HTTP_CONNECTION"]) CEvent::Send("GRADE_SITE", SITE_ID, $arEventFields);
}
?>