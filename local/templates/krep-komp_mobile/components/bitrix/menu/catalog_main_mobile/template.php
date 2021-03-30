<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<div class="mobile__link--catalog">Каталог</div>
<div class="mobile__menu mobile__ul--main">
    <div class="mobile__back mobile__back--main">&lt; Назад</div>          
		
<?$previousLevel = 0;?>
<?foreach ($arResult AS $key=>$arItem):?>
	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</div></div>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>
	
	<?if ($arItem["IS_PARENT"])
	{?>
		<div class="mobile__link mobile__item--drop">
            <div class="mobile__link--parent"><?=$arItem["TEXT"]?></div>
            <div class="mobile__ul">
                  <div class="mobile__back">&lt; Назад</div>
					
	<?}else{?>
		<a class="mobile__link" href="<?=$arItem['LINK']?>"><?=$arItem["TEXT"]?></a>
	<?}?>
	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
	
		
<?endforeach?>


</div>

<?endif?>

