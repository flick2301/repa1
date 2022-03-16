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


<?if($arParams["DISPLAY_TOP_PAGER"]=="Y" && $arParams["PAGE_SIZE"] && ($arParams["PAGE_SIZE"]<$arResult["count"] || $arParams["PAGER_SHOW_ALWAYS"]=="Y")):?>
<div class="top_pagenavigation">
<?
if($arParams["ALTER_PAGINATION"]!="Y") {
$APPLICATION->IncludeComponent(
   "bitrix:main.pagenavigation",
   $arParams["PAGER_TEMPLATE"],
   array(
      "TITLE" => $arParams["PAGER_TITLE"],
      "NAV_OBJECT" => $arResult["nav"],
      "SEF_MODE" => "N",
	  "SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"]
   ),
   false
);
} else {
$APPLICATION->IncludeComponent('bitrix:system.pagenavigation', $arParams["PAGER_TEMPLATE"], array(
    'NAV_RESULT' => $arResult["alternav"],
));
}
?>
</div>
<?endif?>

<div class="dsearch_result">

<?php 
	foreach ($arResult["result"] AS $val) {
		$text[]="<tr onclick=\"window.open('{$val['URL']}', '_blank');\"><td class='search_result_start'>".($val['PICTURE'] ? "<div class='dsearch_result_imgblock'><img alt='{$val['NAME']}' src='{$val['PICTURE']}' /></div>" : "")."</td><td class='search_result_end'><b>{$val['NAME']}</b>".($arParams["ARTNO"] && $val['ART'] ? " (".Loc::getMessage("DSEARCH_ARTNO").": ".trim($val['ART']).")" : "")."<br />
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
	elseif (!$_GET[$arParams["SEARCH_VARIABLE"]]) echo "<div class='title alert error'>".Loc::getMessage("DSEARCH_NOT_SEND").".</div>";
	else echo "<div class='title alert error'>".Loc::getMessage("DSEARCH_NOT_FOUND").".</div>";
?>

</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]=="Y" && $arParams["PAGE_SIZE"] && ($arParams["PAGE_SIZE"]<$arResult["count"] || $arParams["PAGER_SHOW_ALWAYS"]=="Y")):?>
<div class="bottom_pagenavigation">
<?
if($arParams["ALTER_PAGINATION"]!="Y") {
$APPLICATION->IncludeComponent(
   "bitrix:main.pagenavigation",
   $arParams["PAGER_TEMPLATE"],
   array(
      "TITLE" => $arParams["PAGER_TITLE"],
      "NAV_OBJECT" => $arResult["nav"],
      "SEF_MODE" => "N",
	  "SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"]
   ),
   false
);
} else {
$APPLICATION->IncludeComponent('bitrix:system.pagenavigation', $arParams["PAGER_TEMPLATE"], array(
    'NAV_RESULT' => $arResult["alternav"],
));
}
?>
</div>
<?endif?>