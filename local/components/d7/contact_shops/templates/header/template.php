<?foreach($arResult["ITEMS"] AS $key=>$item):?>
	<?if($item["PROP"]["PHONE"]["VALUE"]):?><a href='tel:<?=preg_replace("/^8/", "+7", preg_replace("/[^0-9]*/", "", $item["PROP"]["PHONE"]["VALUE"]))?>' class="header-contacts__phone contact-widget__phone roistat-phone"><?=str_replace(array("+7", "(", ")"), array("8", "", ""), $item["PROP"]["PHONE"]["VALUE"])?></a><?endif?>
	<p class="contact-widget__schedule">Пн–Пт, с 9:00 до 18:00 Мск</p>
	<?if($item["PROP"]["EMAIL"]["VALUE"]):?><a href='mailto:<?=$item["PROP"]["EMAIL"]["VALUE"]?>' class="header-contacts__mail" id='header_mail' ><?=$item["PROP"]["EMAIL"]["VALUE"]?></a><?endif?>
<?endforeach?>


