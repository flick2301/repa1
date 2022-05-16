<?foreach($arResult["ITEMS"] AS $key=>$item):?>

 

	<div class="call-back b24-web-form-popup-btn-2 top__chat">Заказать звонок</div>




	<?if($item["PROP"]["PHONE"]["VALUE"]):?><a href='tel:<?=preg_replace("/^8/", "+7", preg_replace("/[^0-9]*/", "", $item["PROP"]["PHONE"]["VALUE"]))?>' class="top__phone roistat-phone"><?=str_replace(array("+7", "(", ")"), array("8", "", ""), $item["PROP"]["PHONE"]["VALUE"])?></a><?endif?>
	
	<?if($item["PROP"]["EMAIL"]["VALUE"]):?><a href='mailto:<?=$item["PROP"]["EMAIL"]["VALUE"]?>' class="top__phone" id='header_mail_mobile' ><?=$item["PROP"]["EMAIL"]["VALUE"]?></a><?endif?>



<?endforeach?>




