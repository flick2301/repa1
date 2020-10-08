<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>

<? $APPLICATION->IncludeComponent(
    "pesapallo:push.subscribe",
    "",
    Array(
        'AJAX_MODE' => 'Y',
    )
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>