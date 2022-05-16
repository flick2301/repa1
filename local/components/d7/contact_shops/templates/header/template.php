<?foreach($arResult["ITEMS"] AS $key=>$item):?>
<div class="mobile">
	<?if($item["PROP"]["EMAIL"]["VALUE"]):?><a href='mailto:<?=$item["PROP"]["EMAIL"]["VALUE"]?>' class="header-contacts__mail" id='header_mail_mobile' ></a><?endif?>
	<?if($item["PROP"]["PHONE"]["VALUE"]):?><a href='tel:<?=preg_replace("/^8/", "+7", preg_replace("/[^0-9]*/", "", $item["PROP"]["PHONE"]["VALUE"]))?>' class="header-contacts__phone contact-widget__phone roistat-phone"></a><?endif?>
</div>

<div class="desktop"> 

	<?if (!$_GET["new"] && !strstr($_SERVER['HTTP_HOST'] , "new.") && false):?><?/*if (!strstr($_SERVER['HTTP_HOST'] , "new.")):*/?> <p class="contact-widget__schedule">Пн–Пт, с 9:00 до 18:00 Мск</p><?endif?>

<!--call-back-->
<!--<a class="call-back" href="#callback" rel="callback">
Заказать обратный звонок
</a>-->
<button class="call-back b24-web-form-popup-btn-2 d-none">Заказать звонок</button>



<div class="contact-widget__phonemail">
	<?if($item["PROP"]["PHONE"]["VALUE"]):?><a href='tel:<?=preg_replace("/^8/", "+7", preg_replace("/[^0-9]*/", "", $item["PROP"]["PHONE"]["VALUE"]))?>' class="header-contacts__phone contact-widget__phone roistat-phone"><?=str_replace(array("+7", "(", ")"), array("8", "", ""), $item["PROP"]["PHONE"]["VALUE"])?></a><?endif?>
	
	<?if($item["PROP"]["EMAIL"]["VALUE"]):?><a href='mailto:<?=$item["PROP"]["EMAIL"]["VALUE"]?>' class="header-contacts__mail" id='header_mail' ><?=$item["PROP"]["EMAIL"]["VALUE"]?></a><?endif?>
</div>	

</div>	
<?endforeach?>



