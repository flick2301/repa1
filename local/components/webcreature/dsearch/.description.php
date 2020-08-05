<?
/**
 * Created by Webcreature.
 * User: Denis Chuchumashev
 * www.webcreature.ru
 * Date: 13.04.2018
 * Time: 9:18
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc;

$arComponentDescription = array(
	"NAME" => "Dsearch - ".Loc::getMessage("DSEARCH_SUBNAME"),
	"DESCRIPTION" => Loc::getMessage("DSEARCH_DESCRIPTION"),
	"ICON" => "images/icon.gif",
	"SORT" => 10,
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "webcreature",
		"CHILD" => array(
			"ID" => "dsearch",
			"NAME" => "Dsearch - ".Loc::getMessage("DSEARCH_NAME"),
			"CHILD" => array(
				"ID" => "result",
			),
		),		
	),
	"COMPLEX" => "N",
);

?>