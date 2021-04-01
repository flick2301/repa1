<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $templateFolder
 * @var string $templateName
 * @var CMain $APPLICATION
 * @var CBitrixBasketComponent $component
 * @var CBitrixComponentTemplate $this
 * @var array $giftParameters
 */

$documentRoot = Main\Application::getDocumentRoot();











$this->addExternalJs($templateFolder.'/js/mustache.js');
$this->addExternalJs($templateFolder.'/js/action-pool.js');
$this->addExternalJs($templateFolder.'/js/filter.js');
$this->addExternalJs($templateFolder.'/js/component.js');

?>

<div class="first-column inner">
			<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array());?>
			<h1 class="s38-title"><?$APPLICATION->ShowTitle();?></h1>
</div>

<?

$jsTemplates = new Main\IO\Directory($documentRoot.$templateFolder.'/js-templates');
/** @var Main\IO\File $jsTemplate */
foreach ($jsTemplates->getChildren() as $jsTemplate)
{
	include($jsTemplate->getPath());
}

$displayModeClass = $arParams['DISPLAY_MODE'] === 'compact' ? ' basket-items-list-wrapper-compact' : '';

if (empty($arResult['ERROR_MESSAGE']))
{
	
    

	if ($arResult['BASKET_ITEM_MAX_COUNT_EXCEEDED'])
	{
		?>
		<div id="basket-item-message">
			<?=Loc::getMessage('SBB_BASKET_ITEM_MAX_COUNT_EXCEEDED', array('#PATH#' => $arParams['PATH_TO_BASKET']))?>
		</div>
		<?
	}
	?>
	
		<?
		if (
			$arParams['BASKET_WITH_ORDER_INTEGRATION'] !== 'Y'
			&& in_array('top', $arParams['TOTAL_BLOCK_DISPLAY'])
		)
		{
			?>
                    <aside class="two-column__left">
					
			<div class="row">
			
				<div class="col-xs-12" data-entity="basket-total-block"></div>
				
			</div>
                    </aside>
			<?
		}
		?>

		

		
                    <div  class="two-column__right"> 				
					
                        <table class="blue-table basket" >
                            <thead class="blue-table__thead">
                                <tr class="blue-table__tr">
                                    <th class="blue-table__th">Наименование товара</th>
                                    <th class="blue-table__th">Цена, руб.</th>
                                    <th class="blue-table__th">Вес / Объём</th>
                                    <th class="blue-table__th">Количество</th>
                                    <th class="blue-table__th">Сумма, руб.</th>
                                    <th class="blue-table__th">Удалить</th>
                                </tr>
                            </thead>
                            <tbody class="blue-table__tbody" id="basket-item-table"></tbody>
                        </table>
						
<p class='info-paragraph'>KREP-KOMP - ведущий поставщик и производитель строительного крепежа для розничных, мелкооптовых и оптовых клиентов. С 2005 года мы предлагаем самый широкий ассортимент, доступные цены и гибкую систему скидок.</p>
<p class='info-paragraph'><?=$_SERVER['HTTP_HOST']=='spb.krep-komp.ru' ? 'Доставка в пределах Санкт-Петербурга при заказе от 50000 руб. <b>БЕСПЛАТНО</b>' : 'Доставка по Москве в пределах МКАД при заказе от 50000 руб. <b>БЕСПЛАТНО</b>';?></p>
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
		

	<?
	if (!empty($arResult['CURRENCIES']) && Main\Loader::includeModule('currency'))
	{
		CJSCore::Init('currency');

		?>
		<script>
			BX.Currency.setCurrencies(<?=CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true)?>);
		</script>
		<?
	}

	$signer = new \Bitrix\Main\Security\Sign\Signer;
	$signedTemplate = $signer->sign($templateName, 'sale.basket.basket');
	$signedParams = $signer->sign(base64_encode(serialize($arParams)), 'sale.basket.basket');
	$messages = Loc::loadLanguageFile(__FILE__);
	?>
	<script>
		BX.message(<?=CUtil::PhpToJSObject($messages)?>);
		BX.Sale.BasketComponent.init({
			result: <?=CUtil::PhpToJSObject($arResult, false, false, true)?>,
			params: <?=CUtil::PhpToJSObject($arParams)?>,
			template: '<?=CUtil::JSEscape($signedTemplate)?>',
			signedParamsString: '<?=CUtil::JSEscape($signedParams)?>',
			siteId: '<?=$component->getSiteId()?>',
			ajaxUrl: '<?=CUtil::JSEscape($component->getPath().'/ajax.php')?>',
			templateFolder: '<?=CUtil::JSEscape($templateFolder)?>'
		});
	</script>
	<?
	
}
else
{
	ShowError($arResult['ERROR_MESSAGE']);
}