<?foreach($arResult["ITEMS"] AS $key=>$item):?>
<div class="mobile">
	<?if($item["PROP"]["EMAIL"]["VALUE"]):?><a href='mailto:<?=$item["PROP"]["EMAIL"]["VALUE"]?>' class="header-contacts__mail" id='header_mail' ></a><?endif?>
	<?if($item["PROP"]["PHONE"]["VALUE"]):?><a href='tel:<?=preg_replace("/^8/", "+7", preg_replace("/[^0-9]*/", "", $item["PROP"]["PHONE"]["VALUE"]))?>' class="header-contacts__phone contact-widget__phone roistat-phone"><?endif?>
</div>
<div class="desktop"> 
	<?if($item["PROP"]["PHONE"]["VALUE"]):?><a href='tel:<?=preg_replace("/^8/", "+7", preg_replace("/[^0-9]*/", "", $item["PROP"]["PHONE"]["VALUE"]))?>' class="header-contacts__phone contact-widget__phone roistat-phone"><?=str_replace(array("+7", "(", ")"), array("8", "", ""), $item["PROP"]["PHONE"]["VALUE"])?></a><?endif?>
	<?if (!strstr($_SERVER['HTTP_HOST'] , "new.")):?> <p class="contact-widget__schedule">Пн–Пт, с 9:00 до 18:00 Мск</p><?endif?>
	<?if($item["PROP"]["EMAIL"]["VALUE"]):?><a href='mailto:<?=$item["PROP"]["EMAIL"]["VALUE"]?>' class="header-contacts__mail" id='header_mail' ><?=$item["PROP"]["EMAIL"]["VALUE"]?></a><?endif?>
</div>	
<?endforeach?>


