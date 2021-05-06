<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Application;
?>
<?$APPLICATION->IncludeComponent(
	"d7:calculator",
	".default",
	Array(
		"CACHE_FILTER" => "N",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"IBLOCK_ID" => "17",
		"SECTION_ID" => "1655",
		"SECTIONS" => Array(1831, 1656, 1673, 1768, 1771, 1776)
	)
);?>


