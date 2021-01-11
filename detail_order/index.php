<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Детальная страница заказа");
?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.order.detail",
	"",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ALLOW_INNER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "N",
		"CUSTOM_SELECT_PROPS" => array(""),
		"DISALLOW_CANCEL" => "N",
		"ID" => $ORDER_ID,
		"ONLY_INNER_FULL" => "N",
		"PATH_TO_CANCEL" => "",
		"PATH_TO_COPY" => "",
		"PATH_TO_LIST" => "",
		"PATH_TO_PAYMENT" => SITE_DIR."order/payment/",
		"PICTURE_HEIGHT" => "110",
		"PICTURE_RESAMPLE_TYPE" => "1",
		"PICTURE_WIDTH" => "110",
		"PROP_1" => array(""),
		"PROP_2" => array(""),
		"REFRESH_PRICES" => "N",
		"RESTRICT_CHANGE_PAYSYSTEM" => array("0"),
		"SET_TITLE" => "Y"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>