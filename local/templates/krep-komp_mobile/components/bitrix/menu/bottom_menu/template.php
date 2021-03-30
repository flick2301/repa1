<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>



<?
$list=1;
foreach($arResult as $arItem):
	if($list==1 || $list%4 ==1)
	{
?>
	<div class="footer__list">
	<?}?>
		<div class="footer__box"><a class="footer__link" href="<?=$arItem['LINK']?>"><?=$arItem["TEXT"]?></a></div>
	<?
	if($list%4 ==0)
	{
	?>
	</div>
	<?}?>
	<?$list++;?>
<?endforeach?>
</div>


