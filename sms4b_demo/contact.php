<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

use \Bitrix\Main\Localization\Loc;

Loc::loadLanguageFile(__FILE__);

$GLOBALS['APPLICATION']->SetTitle(Loc::getMessage('SMS4B_CONTACTS_SMS_TITLE'));
?>

    <div style="margin:10px">
        <? $APPLICATION->IncludeComponent(
            "rarus.sms4b:sms.send_contacts",
            "",
            Array()
        ); ?>

    </div>

<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>