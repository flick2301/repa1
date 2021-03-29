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

$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/scripts/hc-sticky-2.2.3.min.js?v=XXXXXXa");

$jsTemplates = new Main\IO\Directory($documentRoot.$templateFolder.'/js-templates');
/** @var Main\IO\File $jsTemplate */
foreach ($jsTemplates->getChildren() as $jsTemplate)
{
	include($jsTemplate->getPath());
}

$displayModeClass = $arParams['DISPLAY_MODE'] === 'compact' ? ' basket-items-list-wrapper-compact' : '';

if (empty($arResult['ERROR_MESSAGE']))
{
	?>
	

		<div class="basic-layout__columns basic-layout__columns--reverse basic-layout__columns--special">
            <!--crumbs-nav-->
			<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array());?> 
			<!--crumbs-nav-->
		</div>
		<?global $userEmail;?>
<!-- Criteo Basket/Cart dataLayer -->
<script type='text/javascript'>
        var dataLayer = dataLayer || [];
        dataLayer.push({
            'event': 'crto_basketpage',            
            crto: {             
                'email': '<?=$userEmail?>',                           
                'products': [
				<?foreach($arResult['CITRO'] as $citroItem)
				{
					?>
				{
                    id: '<?=$citroItem["ID"]?>',
                    price: '<?=$citroItem["PRICE"]?>',              
                    quantity: '<?=$citroItem["QUANTITY"]?>'
                },
				<?
				}
				?>
               ]
            }
        });
</script>
<!-- END Criteo Basket/Cart dataLayer -->
      <div class="basic-layout__section">
<?globalGetTitle()?>
      </div>
	  	

		
      <div class="basic-layout__columns" id="basket-root">
         <div class="basic-layout__content">	
		 
		 
	<?if ($arResult['BASKET_ITEM_MAX_COUNT_EXCEEDED'])
	{
		?>
		<div id="basket-item-message">
			<?=Loc::getMessage('SBB_BASKET_ITEM_MAX_COUNT_EXCEEDED', array('#PATH#' => $arParams['PATH_TO_BASKET']))?>
		</div>
		<?
	}?>		 

		 
            <!--catalog-feed-->
            <div class="basic-layout__module catalog-feed">
               <div class="catalog-feed__list" id="basket-item-table">					
			   

               </div>
            </div>
            <!--catalog-feed-->						
						
						
            <!--simple-article-->
            <div class="basic-layout__module simple-article">
               <div class="simple-article__content wysiwyg-block">
                  <p>KREP-KOMP - ведущий поставщик и производитель строительного крепежа для розничных, мелкооптовых и оптовых клиентов. С 2005 года мы предлагаем самый широкий ассортимент, доступные цены и гибкую систему скидок.</p>
                  <p>Доставка по Москве в пределах МКАД при заказе от 50000 руб. <strong>БЕСПЛАТНО</strong></p>
                  <h3>Оптовые скидки:</h3>
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
                           <!--<tr>
                              <th>18%</th>
                              <td>от 1 000 000 руб<br>* скидка предоставляется при условии выполнения ежеквартальных закупкок на сумму от 5 000 000 руб.</td>
                           </tr>-->
                        </tbody>
                     </table>
                  </div>
                  <p>Оформите заказ на сайте, и менеджер пересчитает его стоимость с учётом вашей скидки.</p>
               </div>
            </div>
            <!--simple-article-->
		</div>	
		
		
		
		

		 
		 
		<?
		if (
			$arParams['BASKET_WITH_ORDER_INTEGRATION'] !== 'Y'
			&& in_array('top', $arParams['TOTAL_BLOCK_DISPLAY'])
		)
		{
			?>
			
			
 <aside class="basic-layout__sidebar" id="in-cart-total-trigger">
            <!--in-cart-total-->
            <div class="in-cart-total" id="in-cart-total" data-entity="basket-total-block">
               <ul class="in-cart-total__list" data-entity="basket-checkout-aligner">
                  <li class="in-cart-total__item">
                     <p class="in-cart-total__name">Общий вес</p>
                     <p class="in-cart-total__text"></p>
                  </li>
                  <li class="in-cart-total__item">
                     <p class="in-cart-total__name">Стоимость</p>
                     <p class="in-cart-total__text" data-entity="basket-total-price"></p>
                  </li>
               </ul>
               <div class="in-cart-total__footer">
                  <a onclick="dataLayerToOrder()" class="main-button main-button--plus in-cart-total__submit" data-entity="basket-checkout-button" href="javascript:void(0);">Оформить заказ</a>
               </div>			
            </div>
            <!--in-cart-total-->
         </aside>
			<?
		}
		?>		 





		

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
?></div><br /><br />
