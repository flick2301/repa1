<?
global $request;
$scheme = $request->isHttps() ? 'https' : 'http';

switch (LANGUAGE_ID)
{
	case 'ru':
		$locale = 'ru-RU'; break;
	case 'ua':
		$locale = 'ru-UA'; break;
	case 'tk':
		$locale = 'tr-TR'; break;
	default:
		$locale = 'en-US'; break;
}
?>


<?/*<script src="<?=$scheme?>://api-maps.yandex.ru/2.1.50/?load=package.full&lang=<?=$locale?>"></script>*/?>
<?$api_key = htmlspecialcharsbx(Bitrix\Main\Config\Option::get('fileman', 'yandex_map_api_key'));?>
<?$APPLICATION->AddHeadScript("{$scheme}://api-maps.yandex.ru/2.1.50/?load=package.full&lang={$locale}&apikey={$api_key}" );?>
            
			  
<script>
	template_url = '<?=$this->GetFolder()?>';
</script>			  
			  
			  
			  <div class="contacts__list">
<?foreach($arResult["ITEMS"] AS $key=>$item):?>		
                <div class="contacts__box">
                  <div class="contacts__map">
                    <?//=str_replace(Array(490, 370), Array("100%", "100%"), $item["DETAIL_TEXT"])?>
					<div class="contacts__search contacts__search<?=++$id?>"><div class="contacts__icon" title="Проложить маршрут"></div><textarea placeholder="Откуда ехать" name="form-map-from" class="contacts__from" id="form-map-from-<?=$id?>"></textarea></div>
					<div id="map-<?=$id?>" class="contacts__mapframe"></div>
                  </div>
                  <div class="contacts__left">
                    <div class="contacts__topic"><?=str_replace(" в ", "<br />в ", $item["NAME"])?></div>
                    <div class="contacts__address"><?=$item["PROP"]["ADDRESS"]["~VALUE"]?></div>
                    <div class="contacts__time"><?=strip_tags($item["PREVIEW_TEXT"])?></div>
					<a class="contacts__email" href="mailto:<?=$item["PROP"]["EMAIL"]["VALUE"]?>"><?=$item["PROP"]["EMAIL"]["VALUE"]?></a>
					<?if($item["PROP"]["PHONE"]["VALUE"]):?><a class="contacts__phone" href="tel:<?=str_replace(Array(" ", "-", "(", ")"), "", $item["PROP"]["PHONE"]["VALUE"])?>"><?=str_replace(array("+7", "(", ")"), array("8", "", ""), $item["PROP"]["PHONE"]["VALUE"])?></a><?endif?>
                  </div>
                </div>
				
				<?if($id && $item["PROP"]["LAT"]["VALUE"] && $item["PROP"]["LON"]["VALUE"]):?><script>ymaps.ready(init(<?=$id?>, <?=$item["PROP"]["LAT"]["VALUE"]?>, <?=$item["PROP"]["LON"]["VALUE"]?>));</script><?endif?>
<?endforeach?>				
              </div>


