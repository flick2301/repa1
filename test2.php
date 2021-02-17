<?

$_SERVER["DOCUMENT_ROOT"]='/var/www/krep_komp/krep-komp.ru';

require("/var/www/krep_komp/krep-komp.ru/bitrix/modules/main/include/prolog_before.php");


?>
<?

echo date($_SERVER["DOCUMENT_ROOT"]);
\Bitrix\Main\Diag\Debug::dumpToFile(date(DATE_RFC2822), "", '/upload/check_cron.txt');
?>
