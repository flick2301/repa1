<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Интернет-магазин \"Москреп\"");
$APPLICATION->SetPageProperty("title", "Интернет-магазин \"Москреп\"");
?>

<div style="background: red">

	<?$APPLICATION->IncludeComponent("d7:geolocation","",Array(
				"IBLOCK_ID" => "23", 
				"CACHE_TYPE" => "A", 
                "CACHE_TIME" => "3600", 
                "CACHE_FILTER" => "N"
                    ), false
    );?>

</div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>