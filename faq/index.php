<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Вопрос ответ");
$APPLICATION->SetTitle("Вопрос ответ");
?>

<?globalGetTitle()?>

	<?$APPLICATION->IncludeComponent("webcreature:faq",".default", Array(
				"IBLOCK_ID" => "24", 
				"CACHE_TYPE" => "A", 
                "CACHE_TIME" => "3600", 
                "CACHE_FILTER" => "N",
                    ), false
                );?>
				
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>