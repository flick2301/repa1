<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Калькулятор веса крепежа и метизов - рассчитать онлайн. КРЕП-КОМП");
$APPLICATION->SetTitle("Калькулятор веса крепежа");
?>
<?globalGetTitle("Калькулятор веса крепежа и метизов");
?>
<?
$APPLICATION->IncludeFile(
  "/ajax/calculator.php",
  array("SHOW_BORDER" => true, "MODE"=>"php")
);
?>
<?$APPLICATION->SetPageProperty("description", "Удобный онлайн калькулятор веса крепежа и метизов. Расчет массы болтов, гвоздей, гаек и других изделий по их характеристикам.");?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>