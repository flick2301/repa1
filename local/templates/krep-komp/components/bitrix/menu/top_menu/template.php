<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

			
				<ul class="main-nav__list">

<?

foreach($arResult as $arItem):
?>

		
			
	<?if ($arItem["SELECTED"]):?>			
		    <li class="main-nav__item is-active"><span <?if($arItem['PARAMS']['color']) echo 'style="color:'.$arItem['PARAMS']['color'].'"'?> class="main-nav__link not-decoration"><?=$arItem["TEXT"]?></span></li>
	<?else:?>
			<li class="main-nav__item"><a href="<?=$arItem['LINK']?>" <?if($arItem['PARAMS']['color']) echo 'style="color:'.$arItem['PARAMS']['color'].'"'?> class="main-nav__link"><?=$arItem["TEXT"]?></a></li>
	<?endif?>
	
	
<?endforeach?>




</ul>


<?endif?>