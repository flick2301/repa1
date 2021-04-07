<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<?if(CSite::InDir('/rasprodaja-krepeja/')) $title_menu = "Распродажа крепежа";?>
<?if(CSite::InDir('/certificates/')) $title_menu = "Сертификаты";?>
<?if(CSite::InDir('/catalog/')) $catalog_title_menu = "Каталог";?>

<?
 $icon = Array(
	"/personal/" => "--orders",
	"/personal/private/" => "--settings",
	"/personal/change_pass/" => "--docs",
	"/personal/?logout=yes" => "--exit",
 );
 


if ($arResult["USER"]["NAME"] && $arResult["USER"]["LAST_NAME"]) {
	$fio = ucfirst($arResult["USER"]["NAME"])." ".ucfirst($arResult["USER"]["LAST_NAME"]);
	$initials = ucfirst(mb_substr($arResult["USER"]["NAME"], 0, 1)).ucfirst(mb_substr($arResult["USER"]["LAST_NAME"], 0, 1));
}
elseif ($arResult["USER"]["NAME"]) {
	$fio = ucfirst($arResult["USER"]["NAME"]);
	$initials = ucfirst(mb_substr($arResult["USER"]["NAME"], 0, 1));
}
else {
	$fio = $arResult["USER"]["LOGIN"];
	$initials = ucfirst(mb_substr($arResult["USER"]["LOGIN"], 0, 1));	
}
?>

              <div class="sidebar">
                <div class="sidebar__menu">
                  <div class="sidebar__profile"> 
                    <div class="sidebar__icon"><?=$initials?></div>
                    <div class="sidebar__name"><?=$fio?></div>
                  </div>
    <?foreach($arResult as $arItem):?>		
<?if($arItem["TEXT"]):?>	
                   <div class="sidebar__group"> <a class="sidebar__link <?if($arItem['SELECTED']):?>sidebar__link--active<?endif?> sidebar__link<?=isset($icon[$arItem['LINK']]) ? $icon[$arItem['LINK']] : ""?>" href="<?=$arItem['LINK']?>"><?=$arItem["TEXT"]?></a></div>
<?endif?>				   
    <?endforeach?>				  
                </div>
              </div>
			  

<?endif?>


			
			
				
				
					
				
			
			
	