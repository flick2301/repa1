<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Сертификаты соответствия на крепеж и метизы");
$APPLICATION->SetPageProperty("keywords", "сертификаты, крепеж, строительный крепеж, крепежные изделия, москреп, метизы, саморезы, анкера, дюбеля, анкерные болты, гвозди, абразивы, инструменты");
$APPLICATION->SetPageProperty("description", "Сертификаты на крепежные изделия от производителя КРЕП-КОМП в интернет-магазине крепежа и метизов с доставкой по Москве, Московской области и всей России");
$APPLICATION->SetTitle("Сертификаты соответствия");
?><?$APPLICATION->IncludeComponent(
	"d7:certificates",
	".default",
	array(
	"ADD_GROUP_PERMISSIONS" => array(	// ADD_GROUP_PERMISSIONS
			0 => "1",
		),
		"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "Y",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"COMPONENT_TEMPLATE" => ".default",
		"DATE_FORMAT" => "d.m.Y",
		"IBLOCK_ID" => "8",	// IBLOCK_ID
		"IBLOCK_TYPE" => "certificates",	// IBLOCK_TYPE
		"ITEMS_PREV_PIC_H" => "370",	// Высота картинки раздела
		"ITEMS_PREV_PIC_W" => "370",	// Ширина картинки для раздела
		"LIST_PREV_PIC_H_L2" => "201",	// Высота картинки раздела
		"LIST_PREV_PIC_W_L2" => "268",	// Ширина картинки для раздела
		"SEF_FOLDER" => "/certificates/",	// Каталог ЧПУ (относительно корня сайта)
		"SEF_MODE" => "Y",	// Включить поддержку ЧПУ
		"SEF_URL_TEMPLATES" => array(
			"sections" => "/certificates/#SECTION_CODE#/",
			"items" => "#SECTION_CODE_PATH#/",
		),
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"USE_REVIEW" => "N",	// USE_REVIEW
	)
);?> <?
$rsSites = CSite::GetByID("s1");
$arSite = $rsSites->Fetch();

?>
<div class="content-feedback" style="display: none;">
    <?$APPLICATION->IncludeComponent(
	"d7:main.feedback",
	"",
	array(
            "EMAIL_TO" => "moskrep-market@yandex.ru",	// E-mail, на который будет отправлено письмо
            "EVENT_MESSAGE_ID" => array(	// Почтовые шаблоны для отправки письма
		0 => "7",
		1 => "85",
            ),
            "OK_TEXT" => "Спасибо, ваше сообщение отправлено! Наши операторы свяжутся с вами в ближайшее время.",	// Сообщение, выводимое пользователю после отправки
            "REQUIRED_FIELDS" => array(	// Обязательные поля для заполнения
		0 => "NAME",
		1 => "EMAIL",
		2 => "MESSAGE",
            ),
            "USE_CAPTCHA" => "N",	// Использовать защиту от автоматических сообщений (CAPTCHA) для неавторизованных пользователей
	)
    );?>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>