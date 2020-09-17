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

<div id="tab-4" class="card__tabs-list" style="margin-top: 0px;">
<ul class='delivery_items'>
	<li data-tab='tab_1' class='delivery_item active'>Москва и МО</li>
	<li data-tab='tab_2' class='delivery_item spb'>Санкт-Петербург и ЛО</li>
	<li data-tab='tab_3' class='delivery_item'>Доставка по России</li>
</ul>

<?$APPLICATION->SetAdditionalCSS("/delivery/style.css", true);?>

<?/*<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script src="/delivery/map.js?<?=rand()?>" type="text/javascript"></script>*/?>

<?$api_key = htmlspecialcharsbx(Bitrix\Main\Config\Option::get('fileman', 'yandex_map_api_key'));?>
<?$APPLICATION->AddHeadScript("{$scheme}://api-maps.yandex.ru/2.1.50/?load=package.full&lang={$locale}&apikey={$api_key}" );?>
<?$APPLICATION->AddHeadScript("/delivery/map.js?".rand());?>
  
<div id='tab_1' class='delivery__tabs-list active'>
<?
$APPLICATION->IncludeFile(
 "/delivery/tab1.php",
 array(),
 array("SHOW_BORDER" => true, "MODE"=>"php")
);
?>
</div>


<div id='tab_2' class='delivery__tabs-list spb'>
<?
$APPLICATION->IncludeFile(
 "/delivery/tab2.php",
 array(),
 array("SHOW_BORDER" => true, "MODE"=>"php")
);
?>
</div>


<div id='tab_3' class='delivery__tabs-list'>
<?
$APPLICATION->IncludeFile(
 "/delivery/tab3.php",
 array(),
 array("SHOW_BORDER" => true, "MODE"=>"php")
);
?>
</div>

</div>

