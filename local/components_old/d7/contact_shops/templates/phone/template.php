<?foreach($arResult["ITEMS"] AS $key=>$item):?>
	<?if($item["PROP"]["PHONE"]["VALUE"]):?><a href='tel:<?=preg_replace("/^8/", "+7", preg_replace("/[^0-9]*/", "", $item["PROP"]["PHONE"]["VALUE"]))?>' class="project-contact__link roistat-phone-spb"><?=str_replace(array("+7", "(", ")"), array("8", "", ""), $item["PROP"]["PHONE"]["VALUE"])?></a><?endif?>
<?endforeach?>
