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

$jsTemplates = new Main\IO\Directory($documentRoot.$templateFolder.'/js-templates');
/** @var Main\IO\File $jsTemplate */
foreach ($jsTemplates->getChildren() as $jsTemplate)
{
	include($jsTemplate->getPath());
}

$displayModeClass = $arParams['DISPLAY_MODE'] === 'compact' ? ' basket-items-list-wrapper-compact' : '';

if (empty($arResult['ERROR_MESSAGE']))
{
	
    
/*
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
		}*/
		?>

		

		
      <div class="basic-layout__columns">
         <div class="basic-layout__content">	

		 
            <!--catalog-feed-->
            <div class="basic-layout__module catalog-feed">
               <div class="catalog-feed__list">					
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
               </div>
            </div>
            <!--catalog-feed-->						
						
						
            <!--simple-article-->
            <div class="basic-layout__module simple-article">
               <div class="simple-article__content wysiwyg-block">
                  <p>KREP-KOMP - ведущий поставщик и производитель строительного крепежа для розничных, мелкооптовых и оптовых клиентов. С 2005 года мы предлагаем самый широкий ассортимент, доступные цены и гибкую систему скидок.</p>
                  <p>Доставка по Москве в пределах МКАД при заказе от 50000 руб. <strong>БЕСПЛАТНО</strong></p>
                  <h3>Оптовые и накопительные скидки:</h3>
                  <div class="special-table special-table--lite">
                     <table>
                        <tbody>
                           <tr>
                              <th>5%</th>
                              <td>от 20 000 руб</td>
                           </tr>
                           <tr>
                              <th>10%</th>
                              <td>от 100 000 руб</td>
                           </tr>
                           <tr>
                              <th>13%</th>
                              <td>от 500 000 руб</td>
                           </tr>
                           <tr>
                              <th>18%</th>
                              <td>от 1 000 000 руб<br>* скидка предоставляется при условии выполнения ежеквартальных закупкок на сумму от 5 000 000 руб.</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <p>Оформите заказ на сайте, и менеджер пересчитает его стоимость с учётом вашей скидки.</p>
               </div>
            </div>
            <!--simple-article-->
		</div>	
		
		
		
		
		
		         <aside class="basic-layout__sidebar" id="in-cart-total-trigger">
            <!--in-cart-total-->
            <div class="in-cart-total" id="in-cart-total">
               <ul class="in-cart-total__list">
                  <li class="in-cart-total__item">
                     <p class="in-cart-total__name">Общий вес</p>
                     <p class="in-cart-total__text">35.8 кг</p>
                  </li>
                  <li class="in-cart-total__item">
                     <p class="in-cart-total__name">Стоимость</p>
                     <p class="in-cart-total__text">11 736.90 ₽</p>
                  </li>
               </ul>
               <div class="in-cart-total__footer">
                  <a class="main-button main-button--plus in-cart-total__submit" href="/">Оформить заказ</a>
               </div>
            </div>
            <!--in-cart-total-->
         </aside>
		 
			
		<!--/div-->	
		

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
?>