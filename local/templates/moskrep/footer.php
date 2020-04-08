
			
		</div>
	</div>
        <?
if (CSite::InDir('/index.php') && SITE_ID!='s2'){
    ?>
	<div class="inner">
		<div class="banner-02"><?$APPLICATION->IncludeComponent(
	"d7:slider",
	"",
	Array(
		"IBLOCK_ID" => "7",
		"IBLOCK_TYPE" => "banners",
		"animSpeed" => "1300",
		"controlNav" => "N",
		"directionNav" => "N",
		"effect" => "fade",
		"height" => "477",
		"pauseOnHover" => "N",
		"pauseTime" => "4000",
		"slices" => "6",
		"startSlide" => "0",
		"text_title" => "",
		"width" => "1170"
	)
);?></div>
    <div class="popular-categories">
	<h2 class="h2-title-s30">Распродажа метизов, строительного крепежа и крепежных изделий</h2>
            <?$APPLICATION->IncludeComponent(
	     "bitrix:catalog.section.list",
	     "main",
	     Array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "N",
		"IBLOCK_ID"=>CATALOG_IBLOCK_ID,
		"IBLOCK_TYPE" => "catalog",
		"SECTION_CODE" => "samorezy",
		"SECTION_FIELDS" => array("",""),
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("",""),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "1",
		"VIEW_MODE" => "LINE"
	         )
            );?>
			
    </div>
    <div class="products-tabs">
	<ul class="products-tabs__items">
	    <!--<li data-tab="tab-1" class="products-tabs__item active">Популярные товары</li>-->
	    <li data-tab="tab-2" class="products-tabs__item active">Товары со скидкой</li>
	    <li data-tab="tab-3" class="products-tabs__item">Новинки</li>
	</ul>
	<!--<div id="tab-1" class="product-tabs-list active">
            
				
	</div>-->
	<div id="tab-2" class="product-tabs-list active">
	   <?
            global $arrFilter;
            $arrFilter['!CATALOG_PRICE_'.NUMBER_SALE_PRICE] = false;
           ?>
        <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"main_sale", 
	array(
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
	</div>
	<div id="tab-3" class="product-tabs-list">
            <?$APPLICATION->IncludeComponent(
	    "bitrix:catalog.section", 
	    "main_sale", 
	    array(
		"COMPONENT_TEMPLATE" => "main_sale",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID"=>CATALOG_IBLOCK_ID,
		
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"INCLUDE_SUBSECTIONS" => "A",
		"SHOW_ALL_WO_SECTION" => "N",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBProp:17:139\",\"DATA\":{\"logic\":\"Equal\",\"value\":20}}]}",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"ELEMENT_SORT_FIELD" => "rand",
		"ELEMENT_SORT_ORDER" => "asc",
		
		"PAGE_ELEMENT_COUNT" => "4",
		"LINE_ELEMENT_COUNT" => "4",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_LIMIT" => "5",
		
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
		
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"ENLARGE_PRODUCT" => "STRICT",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		
	    ),
	    false
         );?>
	</div>
    </div>
</div>
<?}?>
<footer class="footer">
    <div class="footer-wrapper inner">
	<nav class="nav-footer">
	    <?$APPLICATION->IncludeComponent(
        "bitrix:menu",
        "bottom_menu",
        Array(
         "ROOT_MENU_TYPE" => "bottom", 
         "MAX_LEVEL" => "3", 
         "CHILD_MENU_TYPE" => "bottom", 
         "USE_EXT" => "Y" 
     )
);?>
	</nav>
	<div class="contacts-footer">
	    <?if(SITE_ID=='s1'):?>
	    <p class="contacts-footer__slogan">Интернет-магазин крепежа, метизов и инструмента «КРЕП-КОМП»</p>
	    <?elseif(SITE_ID=='s2'):?>
	    <p class="contacts-footer__slogan">Интернет-магазин крепежа, метизов и инструмента «МОСКРЕП»</p>
	    <?endif;?>
            <div class="contacts-footer__phone">Телефон: 
                    <?if($_SERVER['HTTP_HOST']!='spb.krep-komp.ru'){?>
                    <span class="roistat-phone"><?
                    $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/telephone.php"), false);
                    ?></span><?
                    }else{?>
                    <span class="roistat-phone-spb"><?
                    $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/tel_spb.php"), false);?>
                    </span>
                    <?}?>
                </div>
	    <div class="contacts-footer__mail">e-mail: <a class='footer_email' href="mailto:<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/email.php"), false);?>"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/email.php"), false);?></a></div>
	</div>
	<div class="copyright-footer">
	    <?if(SITE_ID=='s1'):?>
	    <p>Информация на сайте krep-komp.ru не является публичной офертой. Указанные цены действуют только при оформлении заказа через интернет-магазин krep-komp.ru.</p>
<!-- <p>Обнаружив ошибку или неточность в тексте или описании товара, выделите ее и нажмите Shift+Enter.</p> -->
	    <p>© 2005 — 2019<br> Интернет-магазин «КРЕП-КОМП» <?=$_SERVER['HTTP_HOST']!='spb.krep-komp.ru' ? 'Москва' : 'Санкт-Петербург';?></p>
	    <?elseif(SITE_ID=='s2'):?>
	    <p>Информация на сайте moskrep.ru не является публичной офертой. Указанные цены действуют только при оформлении заказа через интернет-магазин moskrep.ru.</p>
<!-- <p>Обнаружив ошибку или неточность в тексте или описании товара, выделите ее и нажмите Shift+Enter.</p> -->
	    <p>© 2005 — 2019<br> Интернет-магазин «МОСКРЕП» Москва</p>
	    <?endif;?>
	</div>
    </div>
</footer>

<div style="display: none;">
	<?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form",
	"",
	Array(
		"FORGOT_PASSWORD_URL" => "/personal/?forgot_password=yes",
		"PROFILE_URL" => "/personal/private/",
		"REGISTER_URL" => "/personal/?register=yes",
		"SHOW_ERRORS" => "N"
	)
        );?>
	<div class="box-modal" id="feedback">
        
        </div>
</div>




<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.min.js");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/slick.min.js");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.popup.js");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/fancybox.min.js");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/common.js");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.cookie.js");?>


<?
if (CSite::InDir('/index.php')){
    if(SITE_ID=='s2'){
$APPLICATION->SetPageProperty("title", "Магазин крепежа «МОСКРЕП». Купить метизы, крепежные изделия и инструмент в {{city}}.");
$APPLICATION->SetPageProperty('keywords', "МОСКРЕП, магазин крепежа, метизы купить, купить крепежные изделия, метизы {{city}}, строительный крепеж {{city}}.");
$APPLICATION->SetPageProperty('description', '«МОСКРЕП» - ведущий поставщик строительного крепежа на территории России. Мы продаем крепеж, метизы и инструмент по оптовым/розничным ценам с доставкой по {{city}} и всей России.');
}
        else{
$APPLICATION->SetPageProperty("title", "Магазин крепежа «КРЕП-КОМП». Купить метизы, крепежные изделия и инструмент в {{city}}.");
$APPLICATION->SetPageProperty('keywords', "КРЕП-КОМП, магазин крепежа, метизы купить, купить крепежные изделия, метизы {{city}}, строительный крепеж {{city}}.");
$APPLICATION->SetPageProperty('description', '«КРЕП-КОМП» - ведущий поставщик строительного крепежа на территории России. Мы продаем крепеж, метизы и инструмент по оптовым/розничным ценам с доставкой по {{city}} и всей России.');

            
        }
    }
?>
<?include_once $_SERVER["DOCUMENT_ROOT"] . "/include/roistat.php";?>
<?
$rel_can = $APPLICATION->GetPageProperty('url_canon_relink');
if($rel_can=='Y')
	$APPLICATION->AddViewContent('page_url', str_replace("-", '_', str_replace('index.php', '', $APPLICATION->GetCurPage(true))));
else
	$APPLICATION->AddViewContent('page_url', str_replace('index.php', '', $APPLICATION->GetCurPage(true)));
?>

<!-- BEGIN JIVOSITE INTEGRATION WITH ROISTAT -->
<script type='text/javascript'>
var getCookie = window.getCookie = function (name) {
    var matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
return matches ? decodeURIComponent(matches[1]) : undefined;
};
function jivo_onLoadCallback() {
    jivo_api.setUserToken(getCookie('roistat_visit'));
    }
</script>
<!-- END JIVOSITE INTEGRATION WITH ROISTAT --> 
<script>
        (function(w,d,u){
                var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
                var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
        })(window,document,'https://cdn.bitrix24.ru/b10220929/crm/site_button/loader_1_2qbf44.js');
</script>

</body>
</html>
 