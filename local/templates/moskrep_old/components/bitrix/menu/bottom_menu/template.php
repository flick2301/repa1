<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

			
				<ul class="nav-footer__items">

<?

foreach($arResult as $arItem):
?>

		
			
				
		    <li class="nav-footer__item"><a href="<?=$arItem['LINK']?>" class="nav-footer__link"><?=$arItem["TEXT"]?></a></li>
	
	
<?endforeach?>




</ul>


<?endif?>