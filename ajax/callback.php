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


if ($_POST["user_name"] && $_POST["user_phone"]) {
$arEventFields = array(
   
   "CCPHONE" => htmlspecialcharsbx($_POST["user_phone"]),
   "CCNAME" => htmlspecialcharsbx($_POST["user_name"]),
   "CFACE"=>htmlspecialcharsbx($_POST["user_face"]),
 );
 

 var_dump($arEventFields);
 CEvent::Send("REQUEST_TO_CALL", SITE_ID, $arEventFields);
}
?>