<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оптовые скидки");
?>
<? //$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array()); ?>

<?globalGetTitle("Оптовые скидки")?>

            <div class="basic-layout__module simple-article">
               <div class="simple-article__content wysiwyg-block">
			   

<p class='info-paragraph'>Все цены, предоставленные на нашем сайте БАЗОВЫЕ (мелкооптовые).</p>
<p class='info-paragraph'>Для того, чтобы купить саморезы оптом, нужно сделать заказ от 20 000 рублей.</p>
<p class='info-paragraph'>На такие заказы, мы предоставляем следующие скидки:</p>
	   
			   

<style>
	.skid td:first-child{
    width: 50px;
    font-weight: 400;
	text-align:center;
    padding: 14px;
    line-height: 1.25rem;
    font-size: 0.9375rem;
    color: #fff;
    border-right: 1px solid #457fd8;
border-bottom: 1px solid #457fd8;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
		background:#457fd8;
}
.skid td:last-child{
    width: 240px;

    font-weight: 400;
    padding: 14px;
    line-height: 1.25rem;
    font-size: 0.9375rem;
    color: #000;
    border-right: 1px solid #457fd8;
	border-bottom: 1px solid #457fd8;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;

}
	.skid{
		margin-top:20px;
border-top: 1px solid #457fd8;
}
</style>

<table class='skid' >
	<tr >
		<td><b>5%</b></td>
		<td >от 20 000 руб</td>
	</tr>
	<tr >
		<td ><b>10%</b></td>
		<td >от 100 000 руб</td>
	</tr>
	<tr>
		<td ><b>15%</b></td>
		<td >от 500 000 руб</td>
	</tr>
	<!--<tr>
		<td ><b>18%</b></td>
		<td >от 1 000 000 руб<br>* скидка предоставляется при условии выполнения ежеквартальных закупкок на сумму от 5 000 000 руб.</td>
	</tr>-->
</table>

<br />


<p class='info-paragraph'>Скидка сохраняется на месяц, при условии выбора товара на сумму, соответствующей скидки.</p>
<p class='info-paragraph'>Также, для особо крупных клиентов, с оборотом от 5 000 000 рублей в квартал, у нас предусмотрена скидка в 20%. Она закрепляется на квартал, и по итогам нового квартала пересчитывается.</p>
<p class='info-paragraph'>Все цены, предоставленные в нашем прайс-листе и на сайте с НДС.</p>

<?// подключаем пространство имен класса HighloadBlockTable и даём ему псевдоним HLBT для удобной работы
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
// id highload-инфоблока
const MY_HL_BLOCK_ID = 3;
const MY_HL_BLOCK_META_ID=7;
//подключаем модуль highloadblock
CModule::IncludeModule('highloadblock');



$entity_data_class = GetEntityDataClass(MY_HL_BLOCK_ID);
$rsData = $entity_data_class::getList(array(
   'select' => array('*')
));
$el = $rsData->fetch();?>
<div class="sale-category__info" style='margin-top:20px;'>
	<img src='/upload/medialibrary/1eb/excel.png' width='30' style='margin-right:20px;' />
	<a href="/upload/sale.xlsx" class="download-excel">Скачать прайс распродажи</a>
	<div class="sale-category__date"><span><?=$el['UF_DATE']?></span></div>
</div>

</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>