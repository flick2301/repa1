<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */
global $APPLICATION;
global $DEFAULT_STORE_ID;
global $arFilter_soput;

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
       
?>
<?include($_SERVER["DOCUMENT_ROOT"]."/include/array_rals.php");?>
<?$ral_in_ar = $arResult['ITEMS'][0]['PROPERTIES']["TSVET"]["VALUE"];?>

<?if(!$_POST['ENUM_LIST']['ELEMENTS'] && !$arParams["DISABLE_HEADER"]=='Y'){?>
<?
if(empty($APPLICATION->GetPageProperty('title')))
	$APPLICATION->SetPageProperty('title', $arResult["NAME"].", цена - купить в интернет-магазине в Москве");?>

<?if(count($arResult['RELINK'])):?>
<?php $this->SetViewTarget('RELINK'); ?>
<!--see-also-widget-->
	<div class="basic-layout__module see-also-widget">
               <h4 class="see-also-widget__title">Сопутствующие товары:</h4>
               <ul class="see-also-widget__list">
				<?foreach($arResult['RELINK'] as $relink):?>
                  <li class="see-also-widget__item">
                     <a class="see-also-widget__link" href="<?=$relink['AKCEPTOR']?>"><?=$relink['ANKOR']?></a>
                  </li>
				<?endforeach;?>
				</ul>
    </div>
	<!--see-also-widget-->

<?php $this->EndViewTarget(); ?>
<?endif;?>
<?php
//Параметр FOR_SEO устанавливается если это раздел справочника, а не каталога
//А значит текст и заголовок(шапка) не берутся из каталога, а из справочника, значит условие FOR_SEO != Y
if($arParams['FOR_SEO']!='Y'){?>

<?globalGetTitle($arResult['META_TITLE'] ? $arResult['META_TITLE'] : $arResult['NAME'])?>


<?if($arResult['DESCRIPTION']):?>
<!--catalog-desc-->
            <div class="basic-layout__module catalog-desc">
               <div class="catalog-desc__cover">
                  <img class="catalog-desc__image" src="<?=$arResult['PICTURE']['SRC']?>" width="226" height="170" alt="<?=$arResult['NAME']?>">
               </div>
               <p class="catalog-desc__about"><?=html_entity_decode($arResult['DESCRIPTION'], ENT_QUOTES, "UTF-8");?></p>
            </div>
<!--catalog-desc-->
<?endif;?>
<?}
	?>

<?}?>
<?
$showTopPager = $arParams["DISPLAY_TOP_PAGER"];
$showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
$showLazyLoad = false;

if ($arParams['PAGE_ELEMENT_COUNT'] > 0 && $navParams['NavPageCount'] > 1)
{
	$showTopPager = $arParams['DISPLAY_TOP_PAGER'];
	$showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
	$showLazyLoad = $arParams['LAZY_LOAD'] === 'Y' && $navParams['NavPageNomer'] != $navParams['NavPageCount'];
}

//ШАПКА ТАБЛИЦЫ
?>



<div id="shops-window"><div class="win"></div></div>
<div class="page_count_panel">

<div class="page_count_panel_viewblock">Показано <?=count($arResult['ITEMS'])?> из <?=$arResult['NAV_RESULT']->NavRecordCount?> товаров</div>



<div class="page_count_panel_block">

<a id="view_wholesale" href="javascript:void(0);" rel="nofollow" class="blue-btn page_count_panel_viewblock_btn">Оптовые скидки</a>


<select name="page_element_count" id="page_element_count">
	<?foreach(PAGE_ELEMENT_COUNT_NEW as $page_element_count)
	{?>
          <option value="<?=$page_element_count?>" <?=($arParams['PAGE_ELEMENT_COUNT'] == $page_element_count) ? 'selected="selected"' : '';?>>Показывать: по <?=$page_element_count?></option>
	<?}?>
</select>
    <?if($arParams["SELECT_PAGE_TEMPLATE"]!="Y"){?>
        <select name="select_template" id="select_template">
            <option value="horizontal_new">Элементы: Таблицей</option>
            <option value="vertical" selected="selected">Элементы: Блоками</option>
        </select>
    <?}?>
</div>
</div>





    <!--catalog-feed-->
    <div class="basic-layout__module catalog-feed">

		<div class="product__list">
	<?
	
    foreach ($arResult['ITEMS'] as $key => $item)
    {
		if($key == 12)
		{
			?><div data-retailrocket-markup-block="63591b951e039327291149d8" data-category-id="<?=$arResult['ID'];?>"></div><?
		}
        
        $price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_SALE_PRICE]['VALUE'] : $item['MIN_PRICE']['VALUE'] ? $item['MIN_PRICE']['VALUE'] : $item['PRICES'][ID_BASE_PRICE]['VALUE'];
        $old_price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_BASE_PRICE]['VALUE'] : 0;
        
        $ar_size = array(
            $item['PROPERTIES']["DIAMETR"]["VALUE"],
            $item['PROPERTIES']["VYSOTA"]["VALUE"],
            $item['PROPERTIES']["SHIRINA"]["VALUE"],
            $item['PROPERTIES']["DLINA"]["VALUE"],
        );
        $size = array_diff($ar_size, ['']);
?>


				


			<div class="product__box">
                     <!--product-card-->
                <div class="product__top">
                    <div class="product__topside">
                        <div class="product__article">Артикул <span><?=$item['PROPERTIES']["CML2_ARTICLE"]["VALUE"]?></span></div>
                        <div class="product__deliveries">
                            <div class="product__delivery card_pickup" data-product="<?=$item['ID']?>">
                                <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 2.453 1.812 5.032l-.312.14V13.5h13V5.172l-.313-.14L8 2.453Zm0 1.094 5.5 2.296V12.5h-1V7h-9v5.5h-1V5.843L8 3.547ZM4.5 8h7v4.5h-7V8Z"></path>
                                </svg>
                                <div class="product__date">Самовывоз: <span><?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT'] ? "Сегодня" : "Под заказ";?></span></div>
                            </div>
                            <div class="product__delivery  card_delivery"  data-product="<?=$item['ID']?>">
                                <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m14.96 8.305-1.5-3.5A.5.5 0 0 0 13 4.5h-1.5v-1A.5.5 0 0 0 11 3H1.5a.5.5 0 0 0-.5.5V12a.5.5 0 0 0 .5.5h1.07a2 2 0 0 0 3.86 0h3.14a2 2 0 0 0 3.86 0h1.07a.5.5 0 0 0 .5-.5V8.5a.499.499 0 0 0-.04-.195ZM11.5 5.5h1.17L13.74 8H11.5V5.5Zm-7 7.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm5.07-1.5H6.43a2 2 0 0 0-3.86 0H2V4h8.5v6.28a1.999 1.999 0 0 0-.93 1.22ZM11.5 13a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm2.5-1.5h-.57A2 2 0 0 0 11.5 10V9H14v2.5Z"></path>
                                </svg>
                                <div class="product__date">Доставка: <span><?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT'] ? "Завтра" : "Под заказ";?></span></div>
                            </div>
                        </div>
                    </div>
                    <a class="product__link" href="<?=$item['DETAIL_PAGE_URL']?>">
                        <img class="product__images" src="<?=$item['PREVIEW_PICTURE']['src']?>" alt="<?=$item['NAME']?>" title="<?=$item['NAME']?>">
                    </a>
                    <a class="product__name" href="<?=$item['DETAIL_PAGE_URL']?>"><?=$item['NAME']?></a>

 					</div>

				<div class="product__bottom">
					<?if(($item['PROPERTIES']["DIAMETR"]["VALUE"] && $item['PROPERTIES']["DLINA"]["VALUE"]) || !empty($item['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE']))
					{?>
                    <div class="product__params">
                    <?if($item['PROPERTIES']["DIAMETR"]["VALUE"] && $item['PROPERTIES']["DLINA"]["VALUE"]):?>
                        <div class="product__param">Размер(мм): <span><?=$item['PROPERTIES']["DIAMETR"]["VALUE"]?>x<?=$item['PROPERTIES']["DLINA"]["VALUE"]?></span></div>
                    <?endif;?>
                    <?if($item['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE']):?>
                        <div class="product__param">Фасовка: <span><?=$item['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE']?> <?=$item['UNIT']?></span></div>
                    <?endif;?>
                    </div>
					<?}?>
                    <?if($item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']):?>
                        <div class="product__availible">
                            <span>В наличии: <?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?> уп.</span>
                        </div>
                    <?else:?>
                        <div class="product__availible product__availible--unavailible">
                            <div class="card_pickup pointer" data-product="<?=$item['ID']?>"><span>Наличие уточнить</span></div>
                        </div>
                    <?endif;?>




                <div class="product__botside">
                    <div class="product__left">
                        <div class="product__tax">цена (с НДС)</div>
                        <div class="product__price"><?echo number_format($price, 2, '.', ' ');?> р.</div>
						<?if(!empty($item['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE']))
						{?>
							<div class="product__price product__price--one"><?echo round($price/$item['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE'], 2);?> р. за <?=$item['UNIT']?></div>
						<?}?>
                    </div>
                    <div class="product__right">
                        <div data-quantity="<?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?>" onmousedown="try { rrApi.addToBasket(<?=$item['ID']?>) } catch(e) {}" data-product="<?=$item['ID']?>" old-price="<?=$price?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>" class="main-button main-button--mini product-card__button product-card__button_round product__buy" href="javascript:void(0);">
                            
                        </div>
                    </div>
                </div>
</div>


					 

						   

                     <!--product-card-->
            </div>
          

                                                   
						
			
			<?
		}
		?>
		<?if($arResult['NAV_RESULT']->NavRecordCount<12)
		{
			?><div data-retailrocket-markup-block="63591b951e039327291149d8" data-category-id="<?=$arResult['ID'];?>"></div><?
		}?>
		</div>

					
	</div>
<!--catalog-feed-->
<?
if ($showBottomPager)
{
	?>
	
		<!-- pagination-container -->
		<?=$arResult['NAV_STRING']?>
		<!-- pagination-container -->
	
	<?
}
?>
<?php echo htmlspecialchars_decode($arParams['SECTIONS_LIST_TEMPLATE']);?>
<?if(!$arParams["DISABLE_HEADER"]=='Y'){?>
<?

if($arResult["UF_RELATED"]){
	?><div class='basic-layout__module page-heading'><h2>Сопутствующие товары</h2></div><?
	$arFilter_soput = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], "SECTION_ID"=>$arResult["UF_RELATED"]);
	foreach($arResult['UF_SOPUT_PROPERTY'] as $soput_property)
	{
		$arProp = explode('=>', $soput_property);
		$arFilter_soput[$arProp[0]] = $arProp[1];
	}
	
			
?>
<div class="catalog-feed__other">
<?
$arFilter = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], "ID"=>$arResult["UF_RELATED"], false, array("*"));
$db_list = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, true);
while($arSection = $db_list->GetNext()) {
    $renderImage = CFile::ResizeImageGet($arSection["PICTURE"], Array("width" => 72, "height" => 72), BX_RESIZE_IMAGE_EXACT, false); 
    ?>
		<div class="catalog-feed__child">
                     <!--category-card-->
                     <div class="category-card">
                        <p class="category-card__title"><a class="category-card__link" href="<?=$arSection['SECTION_PAGE_URL']?>" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($arSection['NAME']))?>')"><?=$arSection['NAME']?></a></p>
                        <div class="category-card__cover">
                           <img class="category-card__image" src="<?=$renderImage['src']?>" width="120" height="76" alt="<?=$arSection['NAME']?>"> 
                        </div>
                     </div>
                     <!--category-card-->
		</div>
	<?
}
?>
</div>
<?}?>
<?if($arResult['UF_DETAIL_TEXT'] && !($_REQUEST['PAGEN_1'] > 1)  && ($_SERVER['HTTP_HOST']=='krep-komp.ru') && empty($arParams['REFERENCE']['DETAIL_TEXT'])):?>
<!--simple-article-->
            <div class="basic-layout__module simple-article">
               <div class="simple-article__content wysiwyg-block">
			   <?=html_entity_decode($arResult['UF_DETAIL_TEXT'], ENT_QUOTES, "UTF-8");?>
			   </div>
            </div>
<!--simple-article-->
<?endif;?>

<br>
<br>
<?}?>
<?if($arResult['UF_INCLUDE_FILE_AFTER_DESC'])
{
	$APPLICATION->IncludeFile(SITE_DIR."/include/".$arResult['UF_INCLUDE_FILE_AFTER_DESC'], array("SHOW_BORDER" => true, "MODE"=>"html"));
}
?>

<?
//НУЖНО ВСТАВИТЬ КАЛЬКУЛЯТОР ДЛЯ ХИМ. КАРТРИДЖЕЙ
if($arResult['ORIGINAL_PARAMETERS']['SECTION_CODE']=='kartridzh')
    $APPLICATION->IncludeFile(SITE_DIR."/include/calculator.php", array("SHOW_BORDER" => true, "MODE"=>"html"));
?>

<?php
if(!empty($arResult["EGOR_SCRIPT_AR"]))
{
    ?>
    <script type="application/ld+json">
        <?=json_encode($arResult["EGOR_SCRIPT_AR"], JSON_UNESCAPED_UNICODE);?>
    </script>
<?php
}
?>

