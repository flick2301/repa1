<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
   
<?if(CSite::InDir('/rasprodaja-krepeja/')) $title_menu = "Распродажа крепежа";?>
<?if(CSite::InDir('/certificates/')) $title_menu = "Сертификаты";?>
<?if(CSite::InDir('/catalog/')) $catalog_title_menu = "Каталог";?>
<nav class="nav-aside">
    <strong class="nav-aside__title"><?=($title_menu) ? $title_menu : ($arResult[0]['ADDITIONAL_LINKS']['PARENT_NAME']) ? $arResult[0]['ADDITIONAL_LINKS']['PARENT_NAME'] : $catalog_title_menu;?></strong>
    <ul class="nav-aside__items">
    <?foreach($arResult as $arItem):?>
        <li class="nav-aside__item"><a href="<?=$arItem['LINK']?>" class="nav-aside__link"><?=$arItem["TEXT"]?></a></li>	
	
    <?endforeach?>
    </ul>
</nav>
<?endif?>


			
			
				
				
					
				
			
			
	