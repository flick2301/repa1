<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

\Bitrix\Main\UI\Extension::load("ui.fonts.ruble");

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

if (empty($arParams['TEMPLATE_THEME']))
{
	$arParams['TEMPLATE_THEME'] = Main\ModuleManager::isModuleInstalled('bitrix.eshop') ? 'site' : 'blue';
}

if ($arParams['TEMPLATE_THEME'] === 'site')
{
	$templateId = Main\Config\Option::get('main', 'wizard_template_id', 'eshop_bootstrap', $component->getSiteId());
	$templateId = preg_match('/^eshop_adapt/', $templateId) ? 'eshop_adapt' : $templateId;
	$arParams['TEMPLATE_THEME'] = Main\Config\Option::get('main', 'wizard_'.$templateId.'_theme_id', 'blue', $component->getSiteId());
}

if (!empty($arParams['TEMPLATE_THEME']))
{
	if (!is_file($documentRoot.'/bitrix/css/main/themes/'.$arParams['TEMPLATE_THEME'].'/style.css'))
	{
		$arParams['TEMPLATE_THEME'] = 'blue';
	}
}

if (!isset($arParams['DISPLAY_MODE']) || !in_array($arParams['DISPLAY_MODE'], array('extended', 'compact')))
{
	$arParams['DISPLAY_MODE'] = 'extended';
}

$arParams['USE_DYNAMIC_SCROLL'] = isset($arParams['USE_DYNAMIC_SCROLL']) && $arParams['USE_DYNAMIC_SCROLL'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_FILTER'] = isset($arParams['SHOW_FILTER']) && $arParams['SHOW_FILTER'] === 'N' ? 'N' : 'Y';

$arParams['PRICE_DISPLAY_MODE'] = isset($arParams['PRICE_DISPLAY_MODE']) && $arParams['PRICE_DISPLAY_MODE'] === 'N' ? 'N' : 'Y';

if (!isset($arParams['TOTAL_BLOCK_DISPLAY']) || !is_array($arParams['TOTAL_BLOCK_DISPLAY']))
{
	$arParams['TOTAL_BLOCK_DISPLAY'] = array('top');
}

if (empty($arParams['PRODUCT_BLOCKS_ORDER']))
{
	$arParams['PRODUCT_BLOCKS_ORDER'] = 'props,sku,columns';
}

if (is_string($arParams['PRODUCT_BLOCKS_ORDER']))
{
	$arParams['PRODUCT_BLOCKS_ORDER'] = explode(',', $arParams['PRODUCT_BLOCKS_ORDER']);
}

$arParams['USE_PRICE_ANIMATION'] = isset($arParams['USE_PRICE_ANIMATION']) && $arParams['USE_PRICE_ANIMATION'] === 'N' ? 'N' : 'Y';
$arParams['EMPTY_BASKET_HINT_PATH'] = isset($arParams['EMPTY_BASKET_HINT_PATH']) ? (string)$arParams['EMPTY_BASKET_HINT_PATH'] : '/';
$arParams['USE_ENHANCED_ECOMMERCE'] = isset($arParams['USE_ENHANCED_ECOMMERCE']) && $arParams['USE_ENHANCED_ECOMMERCE'] === 'Y' ? 'Y' : 'N';
$arParams['DATA_LAYER_NAME'] = isset($arParams['DATA_LAYER_NAME']) ? trim($arParams['DATA_LAYER_NAME']) : 'dataLayer';
$arParams['BRAND_PROPERTY'] = isset($arParams['BRAND_PROPERTY']) ? trim($arParams['BRAND_PROPERTY']) : '';

if ($arParams['USE_GIFTS'] === 'Y')
{
	$arParams['GIFTS_BLOCK_TITLE'] = isset($arParams['GIFTS_BLOCK_TITLE']) ? trim((string)$arParams['GIFTS_BLOCK_TITLE']) : Loc::getMessage('SBB_GIFTS_BLOCK_TITLE');

	CBitrixComponent::includeComponentClass('bitrix:sale.products.gift.basket');

	$giftParameters = array(
		'SHOW_PRICE_COUNT' => 1,
		'PRODUCT_SUBSCRIPTION' => 'N',
		'PRODUCT_ID_VARIABLE' => 'id',
		'USE_PRODUCT_QUANTITY' => 'N',
		'ACTION_VARIABLE' => 'actionGift',
		'ADD_PROPERTIES_TO_BASKET' => 'Y',
		'PARTIAL_PRODUCT_PROPERTIES' => 'Y',

		'BASKET_URL' => $APPLICATION->GetCurPage(),
		'APPLIED_DISCOUNT_LIST' => $arResult['APPLIED_DISCOUNT_LIST'],
		'FULL_DISCOUNT_LIST' => $arResult['FULL_DISCOUNT_LIST'],

		'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
		'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_SHOW_VALUE'],
		'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],

		'BLOCK_TITLE' => $arParams['GIFTS_BLOCK_TITLE'],
		'HIDE_BLOCK_TITLE' => $arParams['GIFTS_HIDE_BLOCK_TITLE'],
		'TEXT_LABEL_GIFT' => $arParams['GIFTS_TEXT_LABEL_GIFT'],

		'DETAIL_URL' => isset($arParams['GIFTS_DETAIL_URL']) ? $arParams['GIFTS_DETAIL_URL'] : null,
		'PRODUCT_QUANTITY_VARIABLE' => $arParams['GIFTS_PRODUCT_QUANTITY_VARIABLE'],
		'PRODUCT_PROPS_VARIABLE' => $arParams['GIFTS_PRODUCT_PROPS_VARIABLE'],
		'SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'],
		'SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
		'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
		'MESS_BTN_BUY' => $arParams['GIFTS_MESS_BTN_BUY'],
		'MESS_BTN_DETAIL' => $arParams['GIFTS_MESS_BTN_DETAIL'],
		'CONVERT_CURRENCY' => $arParams['GIFTS_CONVERT_CURRENCY'],
		'HIDE_NOT_AVAILABLE' => $arParams['GIFTS_HIDE_NOT_AVAILABLE'],

		'PRODUCT_ROW_VARIANTS' => '',
		'PAGE_ELEMENT_COUNT' => 0,
		'DEFERRED_PRODUCT_ROW_VARIANTS' => \Bitrix\Main\Web\Json::encode(
			SaleProductsGiftBasketComponent::predictRowVariants(
				$arParams['GIFTS_PAGE_ELEMENT_COUNT'],
				$arParams['GIFTS_PAGE_ELEMENT_COUNT']
			)
		),
		'DEFERRED_PAGE_ELEMENT_COUNT' => $arParams['GIFTS_PAGE_ELEMENT_COUNT'],

		'ADD_TO_BASKET_ACTION' => 'BUY',
		'PRODUCT_DISPLAY_MODE' => 'Y',
		'PRODUCT_BLOCKS_ORDER' => isset($arParams['GIFTS_PRODUCT_BLOCKS_ORDER']) ? $arParams['GIFTS_PRODUCT_BLOCKS_ORDER'] : '',
		'SHOW_SLIDER' => isset($arParams['GIFTS_SHOW_SLIDER']) ? $arParams['GIFTS_SHOW_SLIDER'] : '',
		'SLIDER_INTERVAL' => isset($arParams['GIFTS_SLIDER_INTERVAL']) ? $arParams['GIFTS_SLIDER_INTERVAL'] : '',
		'SLIDER_PROGRESS' => isset($arParams['GIFTS_SLIDER_PROGRESS']) ? $arParams['GIFTS_SLIDER_PROGRESS'] : '',
		'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],

		'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
		'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
		'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY']
	);
}

\CJSCore::Init(array('fx', 'popup', 'ajax'));
Main\UI\Extension::load(['ui.mustache']);

$this->addExternalCss('/bitrix/css/main/bootstrap.css');
$this->addExternalCss($templateFolder.'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css');

$this->addExternalJs($templateFolder.'/js/action-pool.js');
$this->addExternalJs($templateFolder.'/js/filter.js');
$this->addExternalJs($templateFolder.'/js/component.js');

$mobileColumns = isset($arParams['COLUMNS_LIST_MOBILE'])
	? $arParams['COLUMNS_LIST_MOBILE']
	: $arParams['COLUMNS_LIST'];
$mobileColumns = array_fill_keys($mobileColumns, true);

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
					$retail_ids[] = $citroItem["ID"];
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
			<div data-retailrocket-markup-block="63591ca11e03932729114a43" data-products="<?=implode(",", $retail_ids)?>"></div>
			<div data-retailrocket-markup-block="63591caf1e03932729114a44" data-products="<?=implode(",", $retail_ids)?>"></div>
						
            <!--simple-article-->
            <div class="basic-layout__module simple-article">
               <div class="simple-article__content wysiwyg-block">
                  <p>KREP-KOMP - ведущий поставщик и производитель строительного крепежа для розничных, мелкооптовых и оптовых клиентов. С 2005 года мы предлагаем самый широкий ассортимент, доступные цены и гибкую систему скидок.</p>
                  <p>Доставка по Москве в пределах МКАД при заказе от 50000 руб. <strong>БЕСПЛАТНО</strong></p>
                  
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
			<br>
			<div class='simple-article__content wysiwyg-block'>
			<h3>Оптовые скидки:</h3>
			<div class="special-table special-table--lite">
      <table>
      <tbody>
       <tr>
									<th>5%</th>
									<td>от 5 000 руб</td>
								</tr>
								<tr>
									<th>10%</th>
									<td>от 10 000 руб</td>
								</tr>
								<tr>
									<th>15%</th>
									<td>от 15 000 руб</td>
								</tr>
								<tr>
									<th>20%</th>
									<td>от 20 000 руб</td>
								</tr>
								<tr>
									<th>25%</th>
									<td>от 25 000 руб</td>
								</tr>
								<tr>
									<th>30%</th>
									<td>от 100 000 руб</td>
								</tr>
								<tr>
									<th>35%</th>
									<td>от 500 000 руб</td>
								</tr>
       <!--<tr>
        <th>18%</th>
        <td>от 1 000 000 руб<br>* скидка предоставляется при условии выполнения ежеквартальных закупкок на сумму от 5 000 000 руб.</td>
       </tr>-->
      </tbody>
      </table>
     </div>
	 </div>
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
