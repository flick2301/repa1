<?
define("STOP_STATISTICS", true);
if (array_key_exists('site_id', $_REQUEST) && is_string($_REQUEST['site_id'])){
   $siteId = $_REQUEST['site_id'];
   if($siteId !== '' && preg_match('/^[a-z0-9_]{2}$/i', $siteId) === 1){
      define('SITE_ID', $siteId);
   }
}

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

//подключаем нужные модули
use Bitrix\Main\Loader,
   Bitrix\Main\Application,
   Bitrix\Currency,
   Bitrix\Sale\DiscountCouponsManager;

Loader::includeModule('iblock');
Loader::includeModule('sale');
Loader::includeModule('catalog');
CUtil::JSPostUnescape();

if (!check_bitrix_sessid() || $_SERVER["REQUEST_METHOD"] != "POST") return;

$arRes = array();

if (isset($_POST["action"]) && strlen($_POST["action"]) > 0){
   $arRes = 'hello world';
}
$APPLICATION->RestartBuffer();
header('Content-Type: application/json; charset='.LANG_CHARSET);   
echo CUtil::PhpToJSObject($arRes);
die();
?>