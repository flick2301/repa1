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










<div class="multi-icon multi-closeIcon"><svg class="multi-svg" viewBox="0 0 50 50"><path class="multi-svg-path" d="M37.304 11.282l1.414 1.414-26.022 26.02-1.414-1.413z"></path><path class="multi-svg-path" d="M12.696 11.282l26.022 26.02-1.414 1.415-26.022-26.02z"></path></svg></div>

<div class="dsearch_result_request d-none">Результаты по запросу "<b><?=$arResult["request"]?></b>"</div>

<?=$arResult["ON_PAGE"]?>

<div class="dsearch_result_block">
<?if(count($arResult["category"])) {?>

<div class="dsearch_result_category">
<div class="dsearch_result_category__item active" data-cat="all"><span>Все результаты</span><div class="dsearch_result_category__count"><span><?=$arResult["count"]?></span></div></div>
<?foreach ($arResult["category"] AS $key=>$val):?>
<div class="dsearch_result_category__item" data-cat="category_<?=Cutil::translit($key,"ru", array("replace_space"=>"-","replace_other"=>"-"))?>"><span><?=$key?></span><div class="dsearch_result_category__count"><span><?=count($val)?></span></div></div>
<?endforeach?>
</div>

<div class="dsearch_result_items">
<?foreach ($arResult["category"] AS $key=>$val):?>
<div class="dsearch_result_items__item category_<?=Cutil::translit($key,"ru", array("replace_space"=>"-","replace_other"=>"-"))?>"><div class="dsearch_result_items__name"><div><?=$key?></div>
<div class="multi-icon multi-arrow-rightIcon"><svg class="multi-svg-arrow" viewBox="0 0 50 50"><path class="multi-svg-path" d="M24.7 34.7l-1.4-1.4 8.3-8.3-8.3-8.3 1.4-1.4 9.7 9.7z"></path><path class="multi-svg-path" d="M16 24h17v2H16z"></path></svg></div>
</div>
<div class="dsearch_result_items__body">
<table cellpadding='0' cellspacing='0'>
<tbody>
<?$count=""?>
<?foreach($val AS $item):?>
<?if($count == 4):?>
<tr><td colspan="2"><div class="dsearch_result_items__else" data-cat="category_<?=Cutil::translit($key,"ru", array("replace_space"=>"-","replace_other"=>"-"))?>">Еще <?=count($val)?>...</div></td></tr>
<?endif?>
<?
		$count++;
		echo "<tr ".($count >= 4 ? "class=\"dsearch_result_passive\"" : "")." onclick=\"window.open('{$item['URL']}', '_blank');\"><td class='search_result_start'>".($item['PICTURE'] && file_exists($_SERVER['DOCUMENT_ROOT'].$item['PICTURE']) ? "<div class='dsearch_result_imgblock'><img alt='{$item['NAME']}' src='{$item['PICTURE']}' /></div>" : "")."</td><td class='search_result_end'><b>{$item['NAME']}</b>".($arParams["ARTNO"] && $item['ART'] ? ".<br />".Loc::getMessage("DSEARCH_ARTNO").": ".trim($item['ART'])."" : "")."<br />
		</td></tr>";
?>		
<?endforeach?>
<?unset($$count)?>
<tbody>
</table>
</div>
</div>
<?endforeach?>
</div>
<?
}
	elseif (!$_GET[$arParams["SEARCH_VARIABLE"]] && !$arResult["request"]) echo "<div class='title alert error'>".Loc::getMessage("DSEARCH_NOT_SEND").".</div>";
	else echo "<div class='title alert error'>".Loc::getMessage("DSEARCH_NOT_FOUND").".</div>";
?>	

</div>