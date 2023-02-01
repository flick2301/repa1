<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оплата");
?>
<?
use Bitrix\Main\Application; 
use Bitrix\Main\Web\Cookie; 
?>


<?globalGetTitle();?>

            <? require($_SERVER["DOCUMENT_ROOT"]."/include/oplata.php");?>

	<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>