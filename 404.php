<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
define("HIDE_SIDEBAR", true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");?>

	
	

	

<div class="notfound">
    <div class="notfound__title">К сожалению, страница, которую вы ищете, не найдена</div>
    <a href="/" class="btn_blue_404">На главную</a>
</div>
<?

$fd = fopen($_SERVER["DOCUMENT_ROOT"]."/service/log_404.txt", 'a') or die("не удалось создать файл");

fwrite($fd, $APPLICATION->GetCurPage().' '.date("m.d.y").'-'.date("H:i:s")."\r\n");
fclose($fd);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>