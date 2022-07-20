<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Карта сайта интернет-магазина крепежа и метизов КРЕП-КОМП");
$APPLICATION->SetPageProperty("description", "Карта сайта krep-komp.ru интернет-магазина крепежа и метизов КРЕП-КОМП - самые популярные разделы каталога.");
$APPLICATION->SetTitle("Карта сайта");
?>

<?globalGetTitle()?>

<div class="user_sitemap">			
<?
	$APPLICATION->IncludeComponent( 
		"bitrix:main.map", 
		"", 
		Array( 
			"LEVEL" => "10", 
			"COL_NUM" => "3", 
			"SHOW_DESCRIPTION" => "N", 
			"SET_TITLE" => "Y", 
			"CACHE_TYPE" => "A", 
			"CACHE_TIME" => "3600" 
		) 
	);
?>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>