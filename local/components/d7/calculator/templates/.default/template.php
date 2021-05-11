<div class="mass-widget">

	<div class="mass-widget__widget-header">
		<div id="mass-widget-cleaner" class="mass-widget-cleaner">x</div>	
		<img class="mass-widget__logo" src="<?=SITE_TEMPLATE_PATH?>/assets/design/website-logo/krep-komp.svg" alt="КРЕП-КОМП" />
	</div>
	
	
	
	<div class="mass-widget__widget-body">

<form id="mass-widget__form" method="POST">	

<?global $USER;
if($arResult["LOG"] && $USER->isAdmin()):?>
<?=$arResult["LOG"]?>
<?endif?>


<div class="mass-widget__form-block">	
		<select class="mass-widget__form-control input-lg mass-widget-loader-select mass-widget-loader-select-type" name="TYPE">
		<option value="" class="mass-option-disabled">- Выберите вид крепежа -</option>
<?foreach($arResult["SECTIONS"] AS $section):?>			
	<option value="<?=$section["ID"]?>" <?if($section["ID"]==$_POST["TYPE"]):?>selected="true"<?endif?>><?=$section["NAME"]?></option>			
<?endforeach?>		
		</select>	
</div>		


<?if(count($arResult["NAMES"])):?>
<div class="mass-widget__form-block">			
<select class="mass-widget__form-control input-lg mass-widget-loader-select" name="NAMES">
<option class="mass-option-disabled" value="">- Выберите стандарт -</option>
<?foreach($arResult["NAMES"] AS $name):?>			
	<option value="<?=$name["ID"]?>" <?if($name["ID"]==$_POST["NAMES"]):?>selected="true"<?endif?>><?=$name["NAME"]?></option>			
<?endforeach?>		
</select>		
</div>
<?endif?>

<?if(count($arResult["DIAMETR_VNUTRENNIY"])):?>
<div class="mass-widget__form-block">	
<select class="mass-widget__form-control input-lg mass-widget-loader-select" name="DIAMETR_VNUTRENNIY">
<option value="" class="mass-option-disabled">- Внутренний диаметр -</option>
<?foreach($arResult["DIAMETR_VNUTRENNIY"] AS $interior_diametr):?>			
	<option value="<?=$interior_diametr?>" <?if($interior_diametr==$_POST["DIAMETR_VNUTRENNIY"]):?>selected="true"<?endif?>><?=$interior_diametr?></option>			
<?endforeach?>	
</select>
</div>
<?endif?>


<?if(count($arResult["DIAMETR"])):?>
<div class="mass-widget__form-block">	
<select class="mass-widget__form-control input-lg mass-widget-loader-select" name="DIAMETR">
<option value="" class="mass-option-disabled">- Выберите диаметр -</option>
<?foreach($arResult["DIAMETR"] AS $diametr):?>			
	<option value="<?=$diametr?>" <?if($diametr==$_POST["DIAMETR"]):?>selected="true"<?endif?>><?=$diametr?></option>			
<?endforeach?>	
</select>
</div>
<?endif?>


<?if(count($arResult["LENGTH"])):?>
<div class="mass-widget__form-block">	
<select class="mass-widget__form-control input-lg mass-widget-loader-select" name="LENGTH">
<option class="mass-option-disabled" value="">- Выберите длину -</option>
<?foreach($arResult["LENGTH"] AS $length):?>			
	<option value="<?=$length?>" <?if($length==$_POST["LENGTH"] || count($arResult["LENGTH"])==1):?>selected="true"<?endif?>><?=$length?></option>			
<?endforeach?>	
</select>
</div>
<?endif?>



<?if($arResult["WEIGHT"]):?>
<div class="mass-widget__mass-one-unit">Масса 1 шт ≈ <?=round($arResult["WEIGHT"] * 1000, 3)?> гр</div>
<div class="mass-widget__form-block">
<label class="mass-count-label">Количество</label>
<input id="mass-widget__count" type="text" class="mass-widget__form-control mass-widget__input-lg mass-count" autocomplete="off" placeholder="0">
</div>
<div class="mass-widget__form-block">
<label class="mass-weight-label">Вес (кг)</label>
<input id="mass-widget__result" type="text" class="mass-widget__form-control mass-widget__input-lg mass-weight" autocomplete="off" placeholder="0">
</div>
<input id="mass-widget__weight" type="hidden" class="unit-weight-value" value="<?=$arResult["WEIGHT"]?>">

<?elseif ($_POST["LENGTH"] || $_POST["DIAMETR_VNUTRENNIY"]):?>
<div class="mass-widget__mass-one-unit">Масса изделия не известна</div>
<?endif?>

</form>


<div id="item_result">
<?$idArray = Array();?>
<?if(count($arResult["ITEMS"])):?>
<?foreach($arResult["ITEMS"] AS $item):?>
<?$idArray[] = $item["ID"]?>
<?if ($item["IBLOCK_SECTION_ID"]) $SECTION_ID = $item["IBLOCK_SECTION_ID"]?>
<?endforeach?>
<?endif?>

		
	
<div class="special-products__list_calculator">
	   <?
            global $arrFilter;
            if (count($idArray)) $arrFilter['ID'] = $idArray;
			else $arrFilter['ID'] = "NONE";
           ?>
		   
        <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"calculator", 
	array(
		"SPLIT" => 1,
		"COMPONENT_TEMPLATE" => "main_sale",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => CATALOG_IBLOCK_ID,
		"SECTION_ID" => $SECTION_ID,
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
		"PAGE_ELEMENT_COUNT" => "4",
		"LINE_ELEMENT_COUNT" => "4",
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
		"DISPLAY_BOTTOM_PAGER" => "N",
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
	</div>

</div>
		
</div>
		
		
		
	<div class="mass-widget__widget-footer">
	</div>
</div>

		