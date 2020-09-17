<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("MYMV_COMP_NAME"),
	"DESCRIPTION" => GetMessage("MYMV_COMP_DESCRIPTION"),
	"ICON" => "/images/map_view.gif",
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "g-tech",
		"NAME" => GetMessage("MAIN_Y_CONTENT"),
		"CHILD" => array(
			"ID" => "services",
			"NAME" => GetMessage("MAIN_YANDEX_MAP_SERVICE"),
			"SORT" => 10,
			"CHILD" => array(
				"ID" => "news_cmpx",
			),
		)
	),
);

?>