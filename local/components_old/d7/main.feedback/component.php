<?php
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */

$arResult["PARAMS_HASH"] = md5(serialize($arParams).$this->GetTemplateName());

$arParams["USE_CAPTCHA"] = (($arParams["USE_CAPTCHA"] != "N" && !$USER->IsAuthorized()) ? "Y" : "N");
$arParams["EVENT_NAME"] = trim($arParams["EVENT_NAME"]);
if($arParams["EVENT_NAME"] == '')
	$arParams["EVENT_NAME"] = "FEEDBACK_FORM";
$arParams["EMAIL_TO"] = trim($arParams["EMAIL_TO"]);
if($arParams["EMAIL_TO"] == '')
	$arParams["EMAIL_TO"] = COption::GetOptionString("main", "email_from");
$arParams["OK_TEXT"] = trim($arParams["OK_TEXT"]);
if($arParams["OK_TEXT"] == '')
	$arParams["OK_TEXT"] = GetMessage("MF_OK_MESSAGE");

if($_SERVER["REQUEST_METHOD"] == "POST"  && (!isset($_POST["PARAMS_HASH"]) || $arResult["PARAMS_HASH"] === $_POST["PARAMS_HASH"]))
{
	$arResult["ERROR_MESSAGE"] = array();
	if(check_bitrix_sessid())
	{
            
		if(empty($arParams["REQUIRED_FIELDS"]) || !in_array("NONE", $arParams["REQUIRED_FIELDS"]))
		{
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])) && strlen($_POST["user_name"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_NAME");		
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])) && strlen($_POST["user_email"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_EMAIL");
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])) && strlen($_POST["MESSAGE"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_MESSAGE");
		}
		if(strlen($_POST["user_email"]) > 1 && !check_email($_POST["user_email"]))
			$arResult["ERROR_MESSAGE"][] = GetMessage("MF_EMAIL_NOT_VALID");
		if($arParams["USE_CAPTCHA"] == "Y")
		{
			$captcha_code = $_POST["captcha_sid"];
			$captcha_word = $_POST["captcha_word"];
			$cpt = new CCaptcha();
			$captchaPass = COption::GetOptionString("main", "captcha_password", "");
			if (strlen($captcha_word) > 0 && strlen($captcha_code) > 0)
			{
				if (!$cpt->CheckCodeCrypt($captcha_word, $captcha_code, $captchaPass))
					$arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTCHA_WRONG");
			}
			else
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTHCA_EMPTY");

		}
                  
		if(empty($arResult["ERROR_MESSAGE"]))
		{
  
  foreach($_POST['DOPFILE'] AS $dopfile) $FILES[] = CFile::GetPath($dopfile);
                
			$arFields = Array(
				"AUTHOR" => $_POST["user_name"],
				"AUTHOR_EMAIL" => $_POST["user_email"],
                                "AUTHOR_TELL" => $_POST["user_tell"],
				"EMAIL_TO" => $arParams["EMAIL_TO"],
				"TEXT" => $_POST['MESSAGE'],
				"ROISTAT" => $_POST["roistat_visit"],
                                //"FILES" => $_POST['DOPFILE'])
                               
			);
			
			
	

//ROISTAT	
$FILES["TEXT"] = $_POST['MESSAGE'];
$roistatData = array(
'roistat' => isset($_COOKIE['roistat_visit']) ? $_COOKIE['roistat_visit'] : 'no_cookie',
'key' => 'MTg3NjQ5OjExMjYzODo4ZTkzNzEzOGRlZTAwZjE1NjYwMzRlNTRjNzYwZGI3YQ==', // Ключ для интеграции с CRM, указывается в настройках интеграции с CRM.
'title' => 'Заявка с сайта', // Название сделки
'comment' => $FILES, // Комментарий к сделке
'name' => $_POST["user_name"], // Имя клиента
'email' => $_POST["user_email"], // Email клиента
'phone' => $_POST["user_tell"], // Номер телефона клиента
'order_creation_method' => '', // Способ создания сделки
'is_need_callback' => '0', // После создания в Roistat заявки, Roistat инициирует обратный звонок на номер клиента, если значение параметра равно 1 и в Ловце лидов включен индикатор обратного звонка.
'callback_phone' => '<Номер для переопределения>', // Переопределяет номер, указанный в настройках обратного звонка.
'sync' => '0', // 
'is_need_check_order_in_processing' => '0', // Включение проверки заявок на дубли
'is_need_check_order_in_processing_append' => '1', // Если создана дублирующая заявка, в нее будет добавлен комментарий об этом
'fields' => array(
// Массив дополнительных полей. Если дополнительные поля не нужны, оставьте массив пустым.
// Примеры дополнительных полей смотрите в таблице ниже.
//"charset" => "Windows-1251", // Сервер преобразует значения полей из указанной кодировки в UTF-8.
),
);

file_get_contents("https://cloud.roistat.com/api/proxy/1.0/leads/add?".http_build_query($roistatData));	
unset($FILES["TEXT"]);





            $no_spam=true;
            if (preg_match('/[^а-я ]+/msiu', $_POST["user_name"])) {
                $no_spam = false;
            }

            if($no_spam):
			if(!empty($arParams["EVENT_MESSAGE_ID"]))
			{
				foreach($arParams["EVENT_MESSAGE_ID"] as $v)
					if(IntVal($v) > 0) {
						//CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields, "N", IntVal($v), $FILES);
						
						if ($_FILES['UPLOAD_FILES']['name'] && $_FILES['UPLOAD_FILES']['tmp_name']) {
							$send_file = $_SERVER["DOCUMENT_ROOT"].'/service/send/'.basename($_FILES['UPLOAD_FILES']['name']);
							if (copy($_FILES['UPLOAD_FILES']['tmp_name'], $send_file)) {
							CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields, "N", IntVal($v), array($send_file));
							unlink($send_file);
							}
						}
						else CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields, "N", IntVal($v));
					
					//file_put_contents($_SERVER["DOCUMENT_ROOT"].'/service/text.txt', print_r($arParams["EVENT_NAME"], true).$_FILES['UPLOAD_FILES']['tmp_name']);
					}
			}
			else
				CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields);
			endif;
			$_SESSION["MF_NAME"] = htmlspecialcharsbx($_POST["user_name"]);
			$_SESSION["MF_EMAIL"] = htmlspecialcharsbx($_POST["user_email"]);
                        $_SESSION["MF_TELL"] = htmlspecialcharsbx($_POST["user_tell"]);
			LocalRedirect($APPLICATION->GetCurPageParam("success=".$arResult["PARAMS_HASH"], Array("success")));
		}
		
		$arResult["MESSAGE"] = htmlspecialcharsbx($_POST["MESSAGE"]);
		$arResult["AUTHOR_NAME"] = htmlspecialcharsbx($_POST["user_name"]);
		$arResult["AUTHOR_EMAIL"] = htmlspecialcharsbx($_POST["user_email"]);
                $arResult["AUTHOR_TELL"] = htmlspecialcharsbx($_POST["user_tell"]);
	}
	else
		$arResult["ERROR_MESSAGE"][] = GetMessage("MF_SESS_EXP");
}
elseif($_REQUEST["success"] == $arResult["PARAMS_HASH"])
{
	$arResult["OK_MESSAGE"] = $arParams["OK_TEXT"];
        
}

if(empty($arResult["ERROR_MESSAGE"]))
{
	if($USER->IsAuthorized())
	{
		$arResult["AUTHOR_NAME"] = $USER->GetFormattedName(false);
		$arResult["AUTHOR_EMAIL"] = htmlspecialcharsbx($USER->GetEmail());
	}
	else
	{
		if(strlen($_SESSION["MF_NAME"]) > 0)
			$arResult["AUTHOR_NAME"] = htmlspecialcharsbx($_SESSION["MF_NAME"]);
		if(strlen($_SESSION["MF_EMAIL"]) > 0)
			$arResult["AUTHOR_EMAIL"] = htmlspecialcharsbx($_SESSION["MF_EMAIL"]);
                if(strlen($_SESSION["MF_TELL"]) > 0)
			$arResult["AUTHOR_TELL"] = htmlspecialcharsbx($_SESSION["MF_TELL"]);
	}
}

if($arParams["USE_CAPTCHA"] == "Y")
	$arResult["capCode"] =  htmlspecialcharsbx($APPLICATION->CaptchaGetCode());

$this->IncludeComponentTemplate();
