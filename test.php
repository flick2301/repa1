<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?>

<?if(IPHONE=="Y"):?>
IPHONE
<?endif?>

<?if(IPHONE=="N"):?>
...
<?endif?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>