<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Ваши скидки");
?>
<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array()); ?>
<h1 class="s38-title">Ваши скидки</h1>
<p class='info-paragraph'>KREP-KOMP - ведущий поставщик и производитель строительного крепежа для розничных, мелкооптовых и оптовых клиентов. С 2005 года мы предлагаем самый широкий ассортимент, доступные цены и гибкую систему скидок.</p>
<p class='info-paragraph'>Доставка по Москве в пределах МКАД при заказе от 50000 руб. <b>БЕСПЛАТНО</b></p>
<p class='info-paragraph'>Оптовые и накопительные скидки:</p>
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
		<td ><b>13%</b></td>
		<td >от 500 000 руб</td>
	</tr>
	<tr>
		<td ><b>18%</b></td>
		<td >от 1 000 000 руб<br>* скидка предоставляется при условии выполнения ежеквартальных закупкок на сумму от 5 000 000 руб.</td>
	</tr>
</table>

<p class='info-paragraph'>Оформите заказ на сайте, и менеджер пересчитает его стоимость с учётом вашей скидки.</p>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>