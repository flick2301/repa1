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
<button class="call-back b24-web-form-popup-btn-2">Заказать звонок</button>



<div class="contact-widget__phonemail">
	<?if($item["PROP"]["PHONE"]["VALUE"]):?><a href='tel:<?=preg_replace("/^8/", "+7", preg_replace("/[^0-9]*/", "", $item["PROP"]["PHONE"]["VALUE"]))?>' class="header-contacts__phone contact-widget__phone roistat-phone"><?=str_replace(array("+7", "(", ")"), array("8", "", ""), $item["PROP"]["PHONE"]["VALUE"])?></a><?endif?>
	
	<?if($item["PROP"]["EMAIL"]["VALUE"]):?><a href='mailto:<?=$item["PROP"]["EMAIL"]["VALUE"]?>' class="header-contacts__mail" id='header_mail' ><?=$item["PROP"]["EMAIL"]["VALUE"]?></a><?endif?>
</div>	

</div>	
<?endforeach?>


<script id="bx24_form_button" data-skip-moving="true">
    (function(w,d,u,b){w['Bitrix24FormObject']=b;w[b] = w[b] || function(){arguments[0].ref=u;
        (w[b].forms=w[b].forms||[]).push(arguments[0])};
        if(w[b]['forms']) return;
        var s=d.createElement('script');s.async=1;s.src=u+'?'+(1*new Date());
        var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
    })(window,document,'https://team.krep-komp.ru/bitrix/js/crm/form_loader.js','b24form');

    b24form({"id":"2","lang":"ru","sec":"ts3icb","type":"button","click":""});
</script>

