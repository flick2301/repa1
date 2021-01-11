<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<?if(CSite::InDir('/rasprodaja-krepeja/')) $title_menu = "Распродажа крепежа";?>
<?if(CSite::InDir('/certificates/')) $title_menu = "Сертификаты";?>
<?if(CSite::InDir('/catalog/')) $catalog_title_menu = "Каталог";?>
<div class="basic-layout__module table-of-contents" id="table-of-contents">
    
    <ul class="table-of-contents__list">
    <?foreach($arResult as $arItem):?>
        
        <?if($arItem['SELECTED']):?>
        <li class="table-of-contents__item" style='color:#676767'><?=$arItem["TEXT"]?></li>
        <?else:?>
        <li class="table-of-contents__item"><a href="<?=$arItem['LINK']?>" title='<?=$arItem["TEXT"]?>' class="table-of-contents__link"><?=$arItem["TEXT"]?></a></li>	
	<?endif;?>
    <?endforeach?>
    </ul>
</div>
<?endif?>


			
			
				
				
					
				
			
			
	