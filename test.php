<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Интернет-магазин \"Москреп\"");
$APPLICATION->SetPageProperty("title", "Интернет-магазин \"Москреп\"");
?>

<?$APPLICATION->IncludeComponent(
	"d7:main.feedback", 
	"ajax-file-krep-komp", 
	array(
		"EMAIL_TO" => "kolobets@mail.ru",
		"EVENT_MESSAGE_ID" => array(
			0 => "7",
		),
		"OK_TEXT" => "Спасибо, ваше сообщение отправлено.",
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
			1 => "EMAIL",
			2 => "MESSAGE",
		),
		"USE_CAPTCHA" => "N",
		"COMPONENT_TEMPLATE" => "krep-komp",
		"HEADER_FORM" => "N",
		"MOBILE_VERSION" => "N"
	),
	false
);?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>