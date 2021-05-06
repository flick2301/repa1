<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Калькулятор");
$APPLICATION->SetTitle("Калькулятор");
?>

<?
$APPLICATION->IncludeFile(
  "/ajax/calculator.php",
  array("SHOW_BORDER" => true, "MODE"=>"php")
);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>