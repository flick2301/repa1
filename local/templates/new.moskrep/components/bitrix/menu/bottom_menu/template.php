<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

			<div class="fast-nav__title" data-sreader>Доп навигация</div>
				<ul class="fast-nav__list">

<?

foreach($arResult as $arItem):
?>

		
			
				
		    <li class="fast-nav__item"><a href="<?=$arItem['LINK']?>" class="fast-nav__link"><?=$arItem["TEXT"]?></a></li>
	
	
<?endforeach?>




</ul>


<?endif?>