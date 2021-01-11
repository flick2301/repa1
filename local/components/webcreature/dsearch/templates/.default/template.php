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

//var_dump($arResult);

?>

<div class="dsearch_result">

<?php 
foreach ($arResult["sections"] AS $val) {
		$text[]="<tr onclick=\"window.open('{$val['URL']}', '_blank');\"><td class='search_result_start'><img alt='{$val['NAME']}' src='{$val['PICTURE']}' /></td><td class='search_result_end'><b>{$val['NAME']}</b><br />
		{$val['DESCRIPTION']}</td></tr>";
	}
	
	foreach ($arResult["elements"] AS $val) {
		$text[]="<tr onclick=\"window.open('{$val['URL']}', '_blank');\"><td class='search_result_start'><img alt='{$val['NAME']}' src='{$val['PICTURE']}' /></td><td class='search_result_end'><b>".($val['VALUE'] && strlen($val['NAME'])<=30 ? "{$val['VALUE']} " : '')."{$val['NAME']}</b> (".Loc::getMessage("DSEARCH_ARTNO").": {$val['ART']})<br />
		{$val['DESCRIPTION']}</td></tr>";
	}
	
	if (count($text)) {
		foreach($text AS $val) {
			$i++;
			if ($i>$arResult["START"])
			$res_text.=$val;
		}
		if ($res_text) echo "<table cellpadding='0' cellspacing='0'>{$res_text}</table>";
	}
	else echo "<div class='title alert'>".Loc::getMessage("DSEARCH_NOT_FOUND").".</div>";
?>

</div>