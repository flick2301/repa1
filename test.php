<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?>
<?php
$curtime = date(H)*60 + (int)date(i);
$offtime = 14*60 + 30;
//echo $curtime;
echo date(N);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>