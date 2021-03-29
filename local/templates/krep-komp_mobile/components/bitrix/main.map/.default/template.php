<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!is_array($arResult["arMap"]) || count($arResult["arMap"]) < 1)
	return;

$arRootNode = Array();
foreach($arResult["arMap"] as $index => $arItem)
{
	if ($arItem["LEVEL"] == 0)
		$arRootNode[] = $index;
}

$allNum = count($arRootNode);
$colNum = ceil($allNum / $arParams["COL_NUM"]);

?>
<h3 class="payment-option__title">Разделы сайта</h3>

<table class="map-columns">
<tr>
	<td>
		<ul class="map-level-0">

		<?
		$previousLevel = -1;
		$counter = 0;
		$column = 1;
		foreach($arResult["arMap"] as $index => $arItem):
			$arItem["FULL_PATH"] = htmlspecialcharsbx($arItem["FULL_PATH"], ENT_COMPAT, false);
			$arItem["NAME"] = htmlspecialcharsbx($arItem["NAME"], ENT_COMPAT, false);
			$arItem["DESCRIPTION"] = htmlspecialcharsbx($arItem["DESCRIPTION"], ENT_COMPAT, false);
		?>

			<?if ($arItem["LEVEL"] < $previousLevel):?>
				<?=str_repeat("</ul></li>", ($previousLevel - $arItem["LEVEL"]));?>
			<?endif?>


			<?if ($counter >= $colNum && $arItem["LEVEL"] == 0): 
					$allNum = $allNum-$counter;
					$colNum = ceil(($allNum) / ($arParams["COL_NUM"] > 1 ? ($arParams["COL_NUM"]-$column) : 1));
					$counter = 0;
					$column++;
			?>
				</ul></td><td><ul class="map-level-0">
			<?endif?>

			<?if (array_key_exists($index+1, $arResult["arMap"]) && $arItem["LEVEL"] < $arResult["arMap"][$index+1]["LEVEL"]):?>

				<li><a class="client-widget__link" href="<?=$arItem["FULL_PATH"]?>"><?=$arItem["NAME"]?></a><?if ($arParams["SHOW_DESCRIPTION"] == "Y" && strlen($arItem["DESCRIPTION"]) > 0) {?><div><?=$arItem["DESCRIPTION"]?></div><?}?>
					<ul class="map-level-<?=$arItem["LEVEL"]+1?>">

			<?else:?>

					<li><a class="client-widget__link" href="<?=$arItem["FULL_PATH"]?>"><?=$arItem["NAME"]?></a><?if ($arParams["SHOW_DESCRIPTION"] == "Y" && strlen($arItem["DESCRIPTION"]) > 0) {?><div><?=$arItem["DESCRIPTION"]?></div><?}?></li>

			<?endif?>


			<?
				$previousLevel = $arItem["LEVEL"];
				if($arItem["LEVEL"] == 0)
					$counter++;
			?>

		<?endforeach?>

		<?if ($previousLevel > 1)://close last item tags?>
			<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
		<?endif?>

		</ul>
	</td>
</tr>
</table>

<h3 class="payment-option__title">Разделы каталога</h3>


<div class="catalog_items">
<?
	$IBLOCK_ID = 17;
	$arFilter = Array('IBLOCK_ID'=>$IBLOCK_ID, 'GLOBAL_ACTIVE'=>'Y'); 
	$obSection = CIBlockSection::GetTreeList($arFilter);
	
	
	while($arResult = $obSection->GetNext()){
	   for($i = 0; $i <= ($arResult['DEPTH_LEVEL'] - 2); $i++);
	   
	   
	   if ($i > $old_i) { echo "\n<div class='level level{$i}'>"; $cnt_div++; }
	   elseif ($i < $old_i) {
		   for($end_i = 0; $end_i < ($old_i - $i); $end_i++) { echo "\n</div>"; $cnt_end_div++; }
	   }
		   
		echo "\n".($i==0 ? "</div><div class='level level0'>" : "")."<span></span> <a class='client-widget__link' href='{$arResult['SECTION_PAGE_URL']}'>{$arResult['NAME']}</a><br />"; 
		$old_i = $i;
		unset ($sub);
	}
	
	for($end_i = 0; $end_i < ($cnt_div - $cnt_end_div); $end_i++) echo "\n</div>";
	
?> 
</div>