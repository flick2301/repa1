<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

			<h4 class="fast-nav__title" data-sreader>Доп навигация</h4>
				<ul class="fast-nav__list">

<?

foreach($arResult as $arItem):
?>

		
			
				
		    <li class="fast-nav__item"><a href="<?=$arItem['LINK']?>" class="fast-nav__link"><?=$arItem["TEXT"]?></a></li>
	
	
<?endforeach?>




</ul>


<?endif?>