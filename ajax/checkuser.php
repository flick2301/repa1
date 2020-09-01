<?
if (!$_POST['login'] || !$_POST['pass']) die();
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

global $USER;
if (!is_object($USER)) $USER = new CUser;
$arAuthResult = $USER->Login(str_replace(Array("<", ">"), Array("", ""), $_POST['login']), str_replace(Array("<", ">"), Array("", ""), $_POST['pass']), "Y");
$result = $APPLICATION->arAuthResult = $arAuthResult;
if (!is_array($result) && $result==true) {
	
	//echo $result;


global $USER;
   $rsUser = CUser::GetByID($USER->GetId());
	$arUser = $rsUser->Fetch();
   if(isset($arUser["PERSONAL_PHONE"]))
   {
	   $queryUrl = 'https://team.krep-komp.ru/rest/1/rdgiynh922m6xmy9/crm.contact.list';
		$data = array(
			'filter' => array("PHONE" => $arUser["PERSONAL_PHONE"]),
			'select' => array("ID")
		);
		$res = getContact($queryUrl, $data);
		echo $res["result"][0]["ID"];
   }
   else echo "auto";
}