<?foreach($arResult["ITEMS"] AS $key=>$item):?>
<div class="contact">
	<div class="contact__wrapper">
		<div class="contact__text">
			<div class="contact__first">
 <strong><?=str_replace(" в ", "<br />в ", $item["NAME"])?></strong>
				<p>
					 <?=$item["PREVIEW_TEXT"]?>
				</p>
			</div>
			<div class="contact__last">
 <?if($item["PROP"]["PHONE"]["VALUE"]):?><a href="tel:<?=$item["PROP"]["PHONE"]["VALUE"]?>" class="contact__phone roistat-phone"><?=str_replace(array("+7", "(", ")"), array("8", "", ""), $item["PROP"]["PHONE"]["VALUE"])?></a><?endif?> 
 <?if($item["PROP"]["SKYPE"]["VALUE"]):?><a href="skype:<?=$item["PROP"]["SKYPE"]["VALUE"]?>" class="contact__skype"><?=$item["PROP"]["SKYPE"]["VALUE"]?></a><?endif?>
			</div>
		</div>
		<div class="contact__map">
			<div id="map<?=($key + 1)?>">
				 <?=$item["DETAIL_TEXT"]?>
			</div>
		</div>
	</div>
</div>
<?endforeach?>