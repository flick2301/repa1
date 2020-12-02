<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Интернет-магазин \"Москреп\"");
$APPLICATION->SetPageProperty("title", "Интернет-магазин \"Москреп\"");
?><?$APPLICATION->IncludeComponent(
	"bitrix:catalog.bigdata.products",
	"vertical",
	Array(
		"ACTION_VARIABLE" => "action_cbdp",
		"ADDITIONAL_PICT_PROP_17" => "MORE_PHOTO",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"BASKET_URL" => "/personal/basket.php",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "N",
		"CART_PROPERTIES_17" => array("",""),
		"CONVERT_CURRENCY" => "N",
		"DEPTH" => "5",
		"DETAIL_URL" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#.html",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "17",
		"IBLOCK_TYPE" => "catalog",
		"ID" => $_REQUEST["PRODUCT_ID"],
		"LABEL_PROP_17" => "GOLOVKA",
		"LINE_ELEMENT_COUNT" => "3",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"PAGE_ELEMENT_COUNT" => "30",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array("К0 (БАЗОВАЯ НАЧАЛЬНАЯ)"),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE_17" => array("CML2_MANUFACTURER",""),
		"RCM_TYPE" => "any",
		"SECTION_CODE" => "",
		"SECTION_ELEMENT_CODE" => "",
		"SECTION_ELEMENT_ID" => "",
		"SECTION_ID" => "1657",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_FROM_SECTION" => "Y",
		"SHOW_IMAGE" => "Y",
		"SHOW_NAME" => "Y",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_PRODUCTS_17" => "Y",
		"TEMPLATE_THEME" => "site",
		"USE_PRODUCT_QUANTITY" => "N"
	)
);?>
<?$APPLICATION->IncludeComponent(
	"d7:contact_shops",
	"header",
	Array(
		"CACHE_FILTER" => "N",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"IBLOCK_ID" => "19",
		"LIMIT" => 1
	)
);?><style>.multi-search {
    opacity: 1 !important;
    visibility: visible !important;
}
.multi-wrapper {
    max-width: 1720px !important;
    margin: 63px 40px 25px !important;
    padding: 0 !important;
    width: auto !important;
    border-radius: 24px !important;
    height: auto !important;
    -webkit-transform: none !important;
    -ms-transform: none !important;
    transform: none !important;
    box-shadow: 0 2px 4px rgba(99,99,99,.25)!important;
	
	
	
	display: flex !important;
    flex-wrap: wrap !important;
    width: 100% !important;
    width: 100% !important;
    max-width: 1216px !important;
    margin: 63px auto 0 !important;
    
    transition: max-width .3s,margin .3s !important;
}
.multi-form {
    padding: 0 !important;
    border-radius: 25px 25px 0 0 !important;
    border: 0 !important;
    background: #fff !important;
}
.multi-input {
    height: 52px !important;
    line-height: 26px !important;
    font-size: 18px !important;
    
    padding-left: 38px !important;
    padding-top: 10px !important;
    padding-bottom: 10px !important;
}
.multi-theme-compact .multi-layout {
    margin: 0 !important;
	padding: 0 2%;
    background: #fff;
    /* border-radius: 3px; */
    -webkit-box-shadow: 0 1px 4px rgba(62,57,107,.35);
    box-shadow: 0 1px 4px rgba(62,57,107,.35);
    overflow: hidden;
}
.multi-searchIcon{
	display:none !important;
}
.multi-closeIcon {
    top: 5px !important;
	right:0px !important;
    
}</style>
<script>
/*
$(function() {
	
	var explode = function(){
				
				$('.multi-wrapper').css({'opacity':'1', 'transition':'0.8s'});
			};
  
	window.onhashchange = function(e) { 
		if(e.newURL.indexOf('#/search/') > -1)
		{
			
			setTimeout(explode, 500);
			
			
		}
	}
});
*/
</script><script defer="" src="https://icases.searcherry.ru/widget/app.js"></script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>