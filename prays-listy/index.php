<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Скачать Прайс-листы на крепеж и метизы - магазин КРЕП-КОМП");
$APPLICATION->SetPageProperty("description", "Прайс-листы, каталог и цены на метизы, крепежные изделия и сопутствующие товары от производителя крепежа - интернет-магазин КРЕП-КОМП. Доставка по России.");
$APPLICATION->SetTitle("Прайс-листы");

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
                  <p class="download-file"><img class="download-file__icon" src="<?=SITE_TEMPLATE_PATH?>/assets/design/download-file/xls.svg" width="36" height="36" alt="Скачать прайс продукции" title="Скачать прайс продукции" /><a rel="nofollow" class="second-button second-button--mini download-file__button" href="<?=$elem[2]["UF_SALE_LINK"]?><?=$rand?>">Скачать прайс продукции</a></p>
                  <!--download-file-->
                  <!--download-file-->
				   <!--<p class="download-file"><img class="download-file__icon" src="<?=SITE_TEMPLATE_PATH?>/assets/design/download-file/xls.svg" width="36" height="36" alt="Скачать прайс распродажи" title="Скачать прайс распродажи" /><a class="second-button second-button--mini download-file__button" href="https://krep-komp.ru/service/get_exel/sale.xlsx<?=$rand?>">Скачать прайс распродажи</a><span class="download-file__date">
				  <?=$result_date?></span></p>-->
                 <p class="download-file"><img class="download-file__icon" src="<?=SITE_TEMPLATE_PATH?>/assets/design/download-file/xls.svg" width="36" height="36" alt="Скачать прайс распродажи" title="Скачать прайс распродажи" /><a rel="nofollow" class="second-button second-button--mini download-file__button" href="<?=$elem[1]["UF_SALE_LINK"]?><?=$rand?>">Скачать прайс распродажи</a><span class="download-file__date"><?=$elem[1]["UF_DATE"]?></span></p>
                  <!--download-file-->
				  
				  <div class='sale_worrning'>
					<svg xmlns="http://www.w3.org/2000/svg" fill="red" width="15px" height="15px" viewBox="-2 0 19 19" class="cf-icon-svg"><path d="m13.842 11.52-4.389 4.388a1.112 1.112 0 0 1-1.567 0l-6.28-6.28a3.027 3.027 0 0 1-.771-1.892l.043-3.681A1.141 1.141 0 0 1 2 2.935L5.67 2.9a3.04 3.04 0 0 1 1.892.773l6.28 6.28a1.112 1.112 0 0 1 0 1.567zM3.826 5.133a.792.792 0 1 0-.792.792.792.792 0 0 0 .792-.792zm6.594 7.348a.554.554 0 0 0 0-.784l-.401-.401a2.53 2.53 0 0 0 .35-.83 1.565 1.565 0 0 0-.397-1.503 1.59 1.59 0 0 0-1.017-.46 2.14 2.14 0 0 0-.75.085h-.002a2.444 2.444 0 0 0-.59.277H7.61a2.677 2.677 0 0 0-.438.357 2.043 2.043 0 0 1-.259.22 1.29 1.29 0 0 1-.329.17h-.002a.835.835 0 0 1-.338.038h-.002a.53.53 0 0 1-.314-.136.539.539 0 0 1-.106-.534 1.54 1.54 0 0 1 .41-.71 1.632 1.632 0 0 1 .23-.165l.03-.019a1.783 1.783 0 0 1 .322-.155.942.942 0 0 1 .325-.06.554.554 0 0 0 0-1.108h-.001a2.058 2.058 0 0 0-.717.132 2.846 2.846 0 0 0-.529.26l-.01.006-.398-.4a.554.554 0 1 0-.784.785l.388.387a2.513 2.513 0 0 0-.347.803 1.644 1.644 0 0 0 .404 1.561 1.622 1.622 0 0 0 .983.456 1.922 1.922 0 0 0 .805-.089 2.372 2.372 0 0 0 .624-.319 3.142 3.142 0 0 0 .398-.339 1.569 1.569 0 0 1 .256-.208 1.381 1.381 0 0 1 .32-.151 1.023 1.023 0 0 1 .348-.038.485.485 0 0 1 .308.139c.05.049.165.165.097.488a1.558 1.558 0 0 1-.413.729 2.476 2.476 0 0 1-.28.219 1.727 1.727 0 0 1-.306.157.687.687 0 0 1-.32.042.554.554 0 1 0-.08 1.106c.052.004.103.005.152.005a1.723 1.723 0 0 0 .685-.134 2.678 2.678 0 0 0 .507-.27l.01-.007.397.398a.555.555 0 0 0 .783 0z"/></svg>
					<span>
						Распродажные цены доступны при заказе от 100 000 руб.
					</span>
				</div>
				  		 
							
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