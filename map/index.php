<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
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