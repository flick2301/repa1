<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?>
<?php
$curtime = date(H)*60 + (int)date(i);
$offtime = 14*60 + 30;
//echo $curtime;
//echo date(N);

if(strstr($_SERVER['HTTP_HOST'], "spb")) echo 111;
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>