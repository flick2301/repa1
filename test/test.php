<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Интернет-магазин \"Москреп\"");
$APPLICATION->SetPageProperty("title", "Интернет-магазин \"Москреп\"");
?>

<a href="https://clck.yandex.ru/redir/dtype=stred/pid=47/cid=73582/path=dynamic.150x101/*https://market.yandex.ru/shop--krep-komp/557450/reviews"> <img src="https://clck.yandex.ru/redir/dtype=stred/pid=47/cid=73581/path=dynamic.150x101/*https://grade.market.yandex.ru/?id=557450&action=image&size=2" border="0" alt="Читайте отзывы покупателей и оценивайте качество магазина КРЕП-КОМП на Яндекс.Маркете" /> </a>

<?
$APPLICATION->IncludeFile(
	SITE_DIR."/include/calculator.php",
	array("SHOW_BORDER" => true, "MODE"=>"html")
);
?>

<?/*$APPLICATION->IncludeComponent(
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
);*/?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>