<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

			
				<ul class="nav-main__items">

<?

foreach($arResult as $arItem):
?>

		
			
				
		    <li class="nav-main__item"><a href="<?=$arItem['LINK']?>" <?if($arItem['PARAMS']['color']) echo 'style="color:'.$arItem['PARAMS']['color'].'"'?> class="nav-main__link"><?=$arItem["TEXT"]?></a></li>
	
	
<?endforeach?>




</ul>


<?endif?>