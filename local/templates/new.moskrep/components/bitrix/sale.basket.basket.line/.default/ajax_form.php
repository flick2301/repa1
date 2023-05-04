<?$APPLICATION->IncludeComponent(
	"d7:main.feedback", 
	"ajax-position-request", 
	array(
		"EMAIL_TO" => "sale@krep-komp.ru",
		"PAGE_URL" => "https://".$_SERVER["HTTP_HOST"].$APPLICATION->GetCurPage(),
		"EVENT_MESSAGE_ID" => array(
			0 => "284",
			
		),
		"EVENT_NAME" => "REQUEST_TO_POSITION",
		"OK_TEXT" => "Спасибо, ваше сообщение отправлено.",
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
			1 => "EMAIL",
			2 => "MESSAGE",
		),
		"USE_CAPTCHA" => "N",
		"USE_USER_NAME"=>"N",
		"COMPONENT_TEMPLATE" => "ajax-position-request",
		"HEADER_FORM" => "N",
		"MOBILE_VERSION" => "N"
	),
	false
);?>