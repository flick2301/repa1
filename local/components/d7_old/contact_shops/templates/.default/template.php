<?CUtil::InitJSCore( array('ajax' , 'popup' ));?>

<?foreach($arResult AS $key=>$item):?>
<div class="contact">
	<div class="contact__wrapper">
		<div class="contact__text">
			<div class="contact__first">
 <strong><?=str_replace(" в ", "<br />в ", $item["NAME"])?></strong>
				<p>
					<?=$item["PROP"]["ADDRESS"]["VALUE"]?><br />
					<?=$item["PREVIEW_TEXT"]?>
				</p>
			</div>
			
			<?if($item["PROP"]["SCHEME"]["VALUE"]["TEXT"]):?>
<script type="text/javascript">
BX.ready(function(){
   
   var addScheme<?=$item["ID"]?> = new BX.PopupWindow("scheme<?=$item["ID"]?>", null, {
      content: BX('scheme_text<?=$item["ID"]?>'),
      //closeIcon: {right: "10px", top: "0px"},
      titleBar: {content: BX.create("div", {html: '<b>Схема проезда</b>', 'props': {'className': 'scheme-title-bar'}})},
	  autoHide: true,
      zIndex: 0,
      offsetLeft: 0,
      offsetTop: 20,
      draggable: {restrict: false},	  
	  overlay: {backgroundColor: 'black', opacity: '80' },
   }); 
   $('#click_scheme<?=$item["ID"]?>').click(function(){
      addScheme<?=$item["ID"]?>.show(); // появление окна
   });
	BX.bind(BX("scheme<?=$item["ID"]?>"), 'click', function() {addScheme<?=$item["ID"]?>.close();})
});
</script>
			<a id="click_scheme<?=$item["ID"]?>" href="javascript:void(0)" class="scheme">Схема проезда</a>
			<div id="scheme_text<?=$item["ID"]?>" class="scheme_text"><div class="address"><?=$item["PROP"]["ADDRESS"]["VALUE"]?></div><?=htmlspecialcharsBack($item["PROP"]["SCHEME"]["VALUE"]["TEXT"])?></div>
			<?endif?>
			
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