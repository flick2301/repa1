<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<!--Мобильное меню каталога-->
<div class="mobile__link--catalog">Каталог</div>
<div class="mobile__menu mobile__ul--main">
    <div class="mobile__back mobile__back--main">&lt; Назад</div>          
		
<?$previousLevel = 0;?>
<?foreach ($arResult AS $key=>$arItem):?>
	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</div></div>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>
	
	<?if ($arItem["IS_PARENT"])
	{ 
		if ($arItem["DEPTH_LEVEL"]==1) $parent = true;?>
		<div class="mobile__link mobile__item--drop">
            <div class="mobile__link--parent"><span class="mobile__text"><?=$arItem["TEXT"]?></span></div>
            <div class="mobile__ul">
                  <div class="mobile__back">&lt; Назад</div>
					
	<?}else{
		if ($arItem["DEPTH_LEVEL"]==1) $parent = false;?>
		<a class="mobile__link" href="<?=$arItem['LINK']?>"><span class="mobile__text"><?=$arItem["TEXT"]?></span></a>
	<?}?>
	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
	
		
<?endforeach?>

<?if($parent):?>
</div></div>
<?endif?>

</div>

<!--Мобильное меню каталога-->
<?endif?>

