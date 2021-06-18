<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Скачать Прайс-лист");

use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
// id highload-инфоблока
const MY_HL_BLOCK_ID = 3;
const MY_HL_BLOCK_META_ID=7;
//подключаем модуль highloadblock
CModule::IncludeModule('highloadblock');
?>


<?globalGetTitle()?>

<?// подключаем пространство имен класса HighloadBlockTable и даём ему псевдоним HLBT для удобной работы




$entity_data_class = GetEntityDataClass(MY_HL_BLOCK_ID);
$rsData = $entity_data_class::getList(array(
   'select' => array('*')
));
while ($el = $rsData->fetch()) {	
	$elem[$el['ID']] = $el;
}?>

<?
$rand = "?".rand();
$startDate = $endDate = new DateTime();
//$startDate = $startDate->modify('monday this week')->format('d.m.Y');
//$endDate = $endDate->modify('saturday this week')->format('d.m.Y');

$month = Array(
	"01" => "января",
	"02" => "февраля",
	"03" => "марта",
	"04" => "апреля",
	"05" => "мая",
	"06" => "июня",
	"07" => "июля",
	"08" => "августа",
	"09" => "сентября",
	"10" => "октября",
	"11" => "ноября",
	"12" => "декабря",
);

$d1 = $startDate->modify('monday this week')->format('d');
$m1 = $startDate->modify('monday this week')->format('m');
$y1 = $startDate->modify('monday this week')->format('Y');
$d2 = $endDate->modify('saturday this week')->format('d');
$m2 = $endDate->modify('saturday this week')->format('m');
$y2 = $endDate->modify('saturday this week')->format('Y');
if ($m1 == $m2 && $y1 == $y2) $result_date = "{$d1} - {$d2} {$month[$m1]} {$y1} г.";
elseif ($m1 != $m2 && $y1 != $y2) $result_date = "{$d1} {$month[$m1]} {$y1} г. - {$d2} {$month[$m2]} {$y2} г.";
else $result_date = "{$d1} {$month[$m1]} - {$d2} {$month[$m2]} {$y1} г.";
?>

            <!--simple-article-->
            <div class="basic-layout__module simple-article">
               <div class="simple-article__content wysiwyg-block">
                  <!--download-file-->
                  <p class="download-file"><img class="download-file__icon" src="<?=SITE_TEMPLATE_PATH?>/assets/design/download-file/xls.svg" width="36" height="36" alt="Скачать прайс продукции" title="Скачать прайс продукции" /><a class="second-button second-button--mini download-file__button" href="<?=$elem[2]["UF_SALE_LINK"]?>">Скачать прайс продукции</a></p>
                  <!--download-file-->
                  <!--download-file-->
				   <!--<p class="download-file"><img class="download-file__icon" src="<?=SITE_TEMPLATE_PATH?>/assets/design/download-file/xls.svg" width="36" height="36" alt="Скачать прайс распродажи" title="Скачать прайс распродажи" /><a class="second-button second-button--mini download-file__button" href="https://krep-komp.ru/service/get_exel/sale.xlsx<?=$rand?>">Скачать прайс распродажи</a><span class="download-file__date">
				  <?=$result_date?></span></p>-->
                 <p class="download-file"><img class="download-file__icon" src="<?=SITE_TEMPLATE_PATH?>/assets/design/download-file/xls.svg" width="36" height="36" alt="Скачать прайс распродажи" title="Скачать прайс распродажи" /><a class="second-button second-button--mini download-file__button" href="<?=$elem[1]["UF_SALE_LINK"]?>">Скачать прайс распродажи</a><span class="download-file__date"><?=$elem[1]["UF_DATE"]?></span></p>
                  <!--download-file-->
				  
				  		 
							
				  <div class="pricelist-error" id="pricelist-error">
				  <span class="pricelist-error__info">Что делать, если при попытке открыть фаил, MS Excel выдает подобную ошибку?</span><br />
				  
				  <img class="pricelist-error__picture picture_vertical-margin" src="./img/error.jpg" alt="Фаил поврежден, поэтому его нельзя открыть" title="Фаил поврежден, поэтому его нельзя открыть" />
				  </div>
				  
				  <div class="pricelist-info" id="pricelist-info">
				  <div class="pricelist-info__steep"><b>1.</b> Переходим во вкладку <b>Файл > Параметры</b></div>
				  <img class="pricelist-error__picture" src="./img/params.jpg" alt="Файл > Параметры" title="Файл > Параметры" />
				  
				  <div class="pricelist-info__steep"><b>2.</b> Во вкладке <b>Центр управления безопасностью</b> нажать на кнопку <b>Параметры управления безопасностью...</b></div>
				  <img class="pricelist-error__picture" src="./img/security.jpg" alt="Центр управления безопасностью" title="Центр управления безопасностью" />
				  
				  <div class="pricelist-info__steep"><b>3.</b> Во вкладке <b>Защищенный просмотр</b> убрать галочку с пункта <b>Включить защищенный просмотр для файлов из Интернета</b></div>
				  <img class="pricelist-error__picture" src="./img/defence.jpg" alt="Защищенный просмотр" title="Защищенный просмотр" />
				  
				  </div>
				  
				  
               </div>
            </div>
            <!--simple-article-->
			
<script>	
$(document).ready(function() {
	$('#pricelist-error').on('click', function() {
		$('#pricelist-error').hide();
		$('#pricelist-info').slideToggle(300);
	});		
});
</script>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>