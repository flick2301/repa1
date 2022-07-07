<div class="faq">
<?foreach($arResult AS $val):?>
<div class="faq__theme">
<div class="faq__topic"><?=$val["NAME"]?></div>
<?foreach($val["ITEMS"] AS $item):?>
<div class="faq__box">
		<div class="faq__name"><?=$item["NAME"]?></div>
		<div class="faq__desc"><?=$item["PREVIEW_TEXT"]?></div>
</div>
<?endforeach?>	
</div>
<?endforeach?>	
</div>