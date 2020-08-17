<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Карта сайта");
?>

            <!--page-heading-->
            <header class="basic-layout__module page-heading">
               <h1 class="page-heading__title"><?$APPLICATION->ShowTitle()?></h1>
            </header>
            <!--page-heading-->

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