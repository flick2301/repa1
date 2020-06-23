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

CJSCore::Init(array("popup"));
$this->addExternalJs($templateFolder.'/js/scroll.js');
$this->addExternalJs($templateFolder.'/slick/slick.js');
$this->addExternalJs($templateFolder.'/js/slider.js');
$this->addExternalJs($templateFolder.'/js/jquery.qrcode.min.js');
if ($arParams["SECTION_ID"]) $this->addExternalJs($templateFolder.'/js/script_'.$arParams["SECTION_ID"].'.js');

if ($arParams["SECTION_ID"]) $this->addExternalCss($templateFolder."/css/style_".$arParams["SECTION_ID"].".css");
$this->addExternalCss($templateFolder."/slick/slick.css");
$this->addExternalCss($templateFolder."/slick/slick-theme.css");
?>

<?/*<script src="<?=$scheme?>://api-maps.yandex.ru/2.1.50/?load=package.full&lang=<?=$locale?>"></script>*/?>
<?$api_key = htmlspecialcharsbx(Bitrix\Main\Config\Option::get('fileman', 'yandex_map_api_key'));?>
<?$APPLICATION->AddHeadScript("{$scheme}://api-maps.yandex.ru/2.1.50/?load=package.full&lang={$locale}&apikey={$api_key}" );?>

<script>
	if (typeof zoom=='undefined') zoom = [];
	if (typeof center_lat=='undefined') center_lat = [];
	if (typeof center_lon=='undefined') center_lon = [];
	if (typeof shop=='undefined') shop = [];
	if (typeof myPlacemark=='undefined') myPlacemark = [];
	if (typeof myPlacemark2565=='undefined') myPlacemark2565 = [];
	if (typeof myPlacemark2565=='undefined') myPlacemark2631 = [];	
	if (typeof myMap=='undefined') myMap = {};		
	section_id = '<?=$arParams["SECTION_ID"] ? $arParams["SECTION_ID"] : "9999"?>';
	select_city = '<?=$arResult['SELECT']?>';
	zoom[section_id] = '<?=$arResult["ZOOM"] ? $arResult["ZOOM"] : 9;?>';
	center_lat[section_id] = '<?=$arResult["LAT"] ? $arResult["LAT"] : 55.73?>';
	center_lon[section_id] = '<?=$arResult["LON"] ? $arResult["LON"] : 37.75?>';
</script>


<?if($_REQUEST["ID"]):?>
<div id="shop<?=$arParams["SECTION_ID"]?>">
<?foreach($arResult["ITEMS"] AS $key=>$item):?>
<?$APPLICATION->AddChainItem(preg_replace("/\&lt;[A-z\/ ]+\&gt;/", ", ", $item["PROP"]["ADDRESS"]["VALUE"]));?>
<h1 class="s38-title"><?=$item["NAME"]?><br /><?=preg_replace("/\&lt;[A-z\/ ]+\&gt;/", ", ", $item["PROP"]["ADDRESS"]["VALUE"])?></h1>
<table id="current_shop_table<?=$arParams["SECTION_ID"]?>">
<tr>
<th>Время работы</th>
<th>Телефон</th>
<th>Способы оплаты</th>
</tr>

<tr>
<td><?=$item["PREVIEW_TEXT"]?></td>
<td><?=htmlspecialchars_decode($item["PROP"]["PHONE"]["VALUE"])?></td>
<td><?=$item["PROP"]["PAYMENT_NAME"]["NAME"]?></td>
</tr>
</table>

<script>
shop.push({id: <?=$item["ID"]?>, balloon: false,  lat: <?=$item["PROP"]["LAT"]["VALUE"]?>, lon: <?=$item["PROP"]["LON"]["VALUE"]?>, color: '<?if($item["PROP"]["COLOR"]["VALUE"]):?><div class="label" style="background: <?=$item["PROP"]["COLOR"]["VALUE"]?>;"></div><?endif?>', name: '<?=$item["PROP"]["TYPE"]["VALUE"]?>', address: '<?=htmlspecialchars_decode($item["PROP"]["ADDRESS"]["VALUE"])?>', text: '<?=$item["PREVIEW_TEXT"] ? "<br />Режим работы: ".preg_replace("/[^A-zА-я0-9\,:\-\<\> ]+/u", "", $item["PREVIEW_TEXT"]) : ""?><div class="line-btn"><a href="<?=$APPLICATION->GetCurPageParam("ID=".$item["ID"])?>" class="blue-btn">Перейти к магазину</a></div>'});
</script>

<div class="left">
<?if(is_array($item["IMG"])):?>
			<div class="slider slider-for">
<?foreach($item["IMG"] AS $img):?>
<div><a href="<?=$img?>" rel="gallery_card"><img src="<?=$img?>" alt="<?=$item["PROP"]["PAYMENT_NAME"]["NAME"]?>" /></a></div>
<?endforeach?>			
			</div>
<script>img_count = <?=count($item["IMG"]) ? count($item["IMG"]) : 0?></script>			
			<div class="slider slider-nav">			
<?foreach($item["IMG"] AS $img):?>
<div class="box"><img src="<?=$img?>" alt="<?=$item["PROP"]["PAYMENT_NAME"]["NAME"]?>" /></div>
<?endforeach?>			
</div>
<?endif?>
</div>
<div id="map<?=$arParams["SECTION_ID"]?>"></div>

<div class="how">
<h2 class="noprint">Как добраться</h2>
<div class="line-btn print_btn noprint">
	    <a href="javascript: void(0);" onclick="window.print();"  class="blue-btn noprint">Распечатать</a>
</div>
<?if($item["SCHEME"] || $item["PROP"]["YOUTUBE"]["VALUE"]["TEXT"] || $item["VIDEO"] || $item["PROP"]["CAR"]["VALUE"]["TEXT"]):?>
<h3>На автомобиле</h3>

<div class="car print">
<?=$item["PROP"]["CAR"]["VALUE"]["TEXT"]?>
</div>

<div id="qr" class="print"></div>

<?if($item["SCHEME"]):?>
	<img class="scheme" src="<?=$item["SCHEME"]?>" alt="<?=preg_replace("/\&lt;[A-z\/ ]+\&gt;/", "", $item["PROP"]["ADDRESS"]["VALUE"])?>" />
<?endif?>

<?if($item["PROP"]["YOUTUBE"]["VALUE"]["TEXT"] || $item["VIDEO"]):?>
<a id="click_scheme<?=$arParams["SECTION_ID"]?>" href="javascript:void(0)" class="scheme_video">Смотреть видео проезда</a>

<div id="scheme_text<?=$arParams["SECTION_ID"]?>" class="scheme_text">
<?if($item["VIDEO"]):?>
<video controls src="<?=$item["VIDEO"]?>"></video>
<?endif?>
<?if($item["PROP"]["YOUTUBE"]["VALUE"]):?><?=htmlspecialchars_decode($item["PROP"]["YOUTUBE"]["~VALUE"]["TEXT"])?><?endif?>
</div>

<?endif?>
<div class="car noprint">
<?=$item["PROP"]["CAR"]["VALUE"]["TEXT"]?>
</div>
<?endif?>

<?if($item["PROP"]["AFOOT"]["VALUE"]["TEXT"]):?>
<h3>Пешком</h3>
<div class="afoot">
<?=$item["PROP"]["AFOOT"]["~VALUE"]["TEXT"]?>
</div>
<?endif?>
</div>

<?endforeach?>
</div>







<?else:?>
<div id="shops<?=$arParams["SECTION_ID"]?>">
<ul class="left">
<?foreach($arResult["ITEMS"] AS $key=>$item):?>
<li rel="<?=$item["ID"]?>" class="item">
<?if($item["PROP"]["COLOR"]["VALUE"]):?><div class="label" style="background: <?=$item["PROP"]["COLOR"]["VALUE"]?>;"></div><?endif?>
<?=htmlspecialchars_decode($item["PROP"]["ADDRESS"]["VALUE"])?><br />
<span>
<?=$item["PROP"]["TYPE"]["VALUE"]?><br />
<span><?=$item["PREVIEW_TEXT"]?></span>
</span>

<div class="line-btn">
	    <a href="<?=$APPLICATION->GetCurPageParam("ID=".$item["ID"])?>" class="blue-btn">Перейти к магазину</a>
</div>
	
</li>
<script>
shop.push({id: <?=$item["ID"]?>, balloon: true, lat: <?=$item["PROP"]["LAT"]["VALUE"]?>, lon: <?=$item["PROP"]["LON"]["VALUE"]?>, color: '<?if($item["PROP"]["COLOR"]["VALUE"]):?><div class="label" style="background: <?=$item["PROP"]["COLOR"]["VALUE"]?>;"></div><?endif?>', name: '<?=$item["PROP"]["TYPE"]["VALUE"]?>', address: '<?=htmlspecialchars_decode($item["PROP"]["ADDRESS"]["VALUE"])?>', text: '<?=$item["PREVIEW_TEXT"] ? "<div class=\'type\'>".$item["PROP"]["TYPE"]["VALUE"]."</div><span class=\'preview\'>Режим работы: ".preg_replace("/[^A-zА-я0-9\,:\-\<\> ]+/u", "", $item["PREVIEW_TEXT"]) : ""?></span><div class="line-btn"><a href="<?=$APPLICATION->GetCurPageParam("ID=".$item["ID"])?>" class="blue-btn">Перейти к магазину</a></div>'});
</script>
<?endforeach?>
</ul>
<div id="map<?=$arParams["SECTION_ID"]?>"></div>
</div>

<table id="shop_table<?=$arParams["SECTION_ID"]?>">
<tr>
<th></th>
<th>Адрес</th>
<th>Тип магазина</th>
<th>Режим работы</th>
</tr>

<?foreach($arResult["ITEMS"] AS $key=>$item):?>
<tr rel="<?=$item["ID"]?>">
<td><div class="label" style="background: <?=$item["PROP"]["COLOR"]["VALUE"]?>;"></div></td>
<td class="blue"><?=htmlspecialchars_decode ($item["PROP"]["ADDRESS"]["VALUE"])?></td>
<td class="nowrap"><?=$item["PROP"]["TYPE"]["VALUE"]?></td>
<td class="nowrap"><?=$item["PREVIEW_TEXT"]?></td>
</tr>
<?endforeach?>
</table>
<?endif?>