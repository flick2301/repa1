<?foreach($arResult["ITEMS"] AS $key=>$item):?>

 

	<div class="call-back b24-web-form-popup-btn-2 top__chat">Заказать звонок</div>




	<?if($item["PROP"]["PHONE"]["VALUE"]):?><a href='tel:<?=preg_replace("/^8/", "+7", preg_replace("/[^0-9]*/", "", $item["PROP"]["PHONE"]["VALUE"]))?>' class="top__phone roistat-phone"><?=str_replace(array("+7", "(", ")"), array("8", "", ""), $item["PROP"]["PHONE"]["VALUE"])?></a><?endif?>
	
	<?if($item["PROP"]["EMAIL"]["VALUE"]):?><a href='mailto:<?=$item["PROP"]["EMAIL"]["VALUE"]?>' class="top__phone" id='header_mail_mobile' ><?=$item["PROP"]["EMAIL"]["VALUE"]?></a><?endif?>



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

