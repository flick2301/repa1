<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>



<div class="top__catalog">

			<div class="top__catalog__icon">
              <div class="top__catalog__box"><span></span><span></span><span></span></div>
            </div>
			<div class="top__catalog__name">Каталог</div>
			<nav class="catalog_main_menu">
                  <div id="catalog_main_menu">
				  <div class="basic-layout__section">
				  <div class="left">
				  <?/*
				  <div class="sale"><li class="catalog-nav__item" ><a href="/rasprodaja_krepeja/"  class="catalog-nav__lvl1-toggle">Распродажа</a>
				  
				  <div class="item_title">Распродажа</div>
				  
				  				    <div class="catalog-nav__lvl2_new">
									<ul class="catalog-nav__lvl2_new-list">	

        <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"main_sale_menu", 
	array(
		"SPLIT" => 2,
		"COMPONENT_TEMPLATE" => "main_sale",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID"=>CATALOG_IBLOCK_ID,
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "samorezy",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "arrFilter",
		"INCLUDE_SUBSECTIONS" => "A",
		"SHOW_ALL_WO_SECTION" => "N",
		"CUSTOM_FILTER" => "",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"ELEMENT_SORT_FIELD" => "rand",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"PAGE_ELEMENT_COUNT" => "9",
		"LINE_ELEMENT_COUNT" => "9",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		
		"PRICE_CODE" => array(
			0 => "Распродажа",
			1 => "К0 (БАЗОВАЯ НАЧАЛЬНАЯ)",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "Y",
		"BASKET_URL" => "/personal/basket.php",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"DISPLAY_COMPARE" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"COMPATIBLE_MODE" => "Y",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"CURRENCY_ID" => "RUB",
		
	    ),
	    false
        );?>
		
		<?$arrFilter['!CATALOG_PRICE_'.NUMBER_SALE_PRICE]=""?>
		
									</ul>	
									</div>
				  </div>*/?>

<?$limit = 6;?>
<?foreach ($arResult["ITEMS"] AS $key=>$arItem):?>
			<?$cnt = 0; $count = 0;?>
			<li class="catalog-nav__item<?if(!$key):?> first<?endif?>" ><a href="<?=$arItem['LINK']?>"  class="catalog-nav__lvl1-toggle"><span><?=$arItem["TEXT"]?></span></a>
				<!--lvl1-->
				<?foreach ($arItem["ITEMS"] AS $arItem_2):?>
				<?$cnt += (count($arItem_2["ITEMS"]) < $limit ? count($arItem_2["ITEMS"]) : $limit) + 2;?>
				<?
					if (count($arItem_2["ITEMS"])) $arNewItem["ITEMS"][] = $arItem_2;
					else $arNewItem2["ITEMS"][] = $arItem_2;
				?>
				<?endforeach?>
				<?
					if (count($arNewItem["ITEMS"]) && count($arNewItem["ITEMS"])) $arItem["ITEMS"] = array_merge($arNewItem["ITEMS"], $arNewItem2["ITEMS"]);
					unset($arNewItem, $arNewItem2);
				?>
				<div class="item_title"><?=$arItem["TEXT"]?></div>
				<?if ($arItem["IS_PARENT"]):?>
				    <div class="catalog-nav__lvl2_new">
<!--lvl2-->
<ul class="catalog-nav__lvl2_new-list"><div>					
						<?foreach ($arItem["ITEMS"] AS $arItem_2):?><?$cnt_item = 0;?>
						<?if(!count($arItem_2["ITEMS"])) $no_count++; else $no_count = 0;?>
						<?if((($count + 2) > $cnt/4) && (count($arItem_2["ITEMS"]) || $no_count == 1)):?><?$count = 0;?></div><div><?endif?><?$count = $count + 2;?>
<?if (!count($arItem_2["ITEMS"])):?>						
<li class="catalog-nav__lvl3_new-item <?if($count<=2 || $no_count==1):?>margin<?endif?>"><a href="<?=$arItem_2['LINK']?>" class="catalog-nav__lvl3_new-link"><?=$arItem_2["TEXT"]?></a></li>						
<?else:?>
<li class="catalog-nav__lvl2_new-item" >
	<span class="catalog-nav__lvl2_new-item catalog-nav__lvl2_new-item-title" ><a href="<?=$arItem_2['LINK']?>" class="catalog-nav__lvl2_new-toggle"><span><?=$arItem_2["TEXT"]?></span></a></span>						

								<!--lvl3-->
								<div class="catalog-nav__lvl3_new">
										<ul class="catalog-nav__lvl3_new-list">				
						<?foreach ($arItem_2["ITEMS"] AS $arItem_3):?><?$cnt_item++;?><?if ($cnt_item <= $limit) $count++?>
									<li class="catalog-nav__lvl3_new-item <?if($cnt_item > $limit) echo "hide";?>"><a href="<?=$arItem_3['LINK']?>" class="catalog-nav__lvl3_new-link"><?=$arItem_3["TEXT"]?></a></li>						
						<?endforeach?>	
<?if($cnt_item > $limit):?>
<li class="catalog-nav__lvl3_new-item more"><a href="<?=$arItem_2['LINK']?>">Все категории</a></li>
<?endif?>						
										</ul>
								</div>		

</li>	
<?endif?>				
						<?endforeach?>		
</div></ul>						
					</div>
				<?endif?>	
			</li>	
<?endforeach?>


</div>
</div>
</div>
</nav>

</div>	

<?endif?>

