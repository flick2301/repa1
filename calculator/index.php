<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Калькулятор веса крепежа и метизов	");
$APPLICATION->SetPageProperty("description", "Калькулятор веса крепежа и метизов онлайн – интернет-магазин Креп-Комп.");
$APPLICATION->SetTitle("Калькулятор веса крепежа");
?>

<?
$APPLICATION->IncludeFile(
  "/ajax/calculator.php",
  array("SHOW_BORDER" => true, "MODE"=>"php")
);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>