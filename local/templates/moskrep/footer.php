</div>
		

		
		<?if (CSite::InDir('/index.php') && SITE_ID!='s2'){
    ?>
	<div class="basic-layout__sidebar"></div>
<?}?>
		
		
			<?$page_footer_menu = Array(
				"/", 
				"/basket/",
				"/order/",
			);
			?>
		
<?if (!in_array($APPLICATION->GetCurPage(), $page_footer_menu)):?>
		<aside class="basic-layout__sidebar">
            <!--table-of-contents-->
		<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"left_bottom", 
	array(
		"ROOT_MENU_TYPE" => "left_bottom",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left_bottom",
		"USE_EXT" => "Y",
		"VIBOR_CATALOG_TABLE" => array(
			0 => "",
			1 => "2411",
			2 => "2403",
			3 => "",
		),
		"COMPONENT_TEMPLATE" => "left_bottom",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
	
	<?=$APPLICATION->ShowViewContent('RELINK');?>
	<?=$APPLICATION->ShowViewContent("smart_filter");?>
         </aside>
<?endif?>

</div>
		        <?
if (CSite::InDir('/index.php') && SITE_ID!='s2'){
    ?>
	
<div class="basic-layout__section">	
	
            <div class="sales-slider__header">
               <h2 class="sales-slider__title">Интернет-магазин строительного крепежа "КРЕП-КОМП"</h2>
            </div>
			
	
         <!--promo-block-->
         <div class="basic-layout__module promo-block">
<?$APPLICATION->IncludeComponent(
	"d7:slider",
	"",
	Array(
		"IBLOCK_ID" => "7",
		"IBLOCK_TYPE" => "banners",
		"animSpeed" => "1300",
		"controlNav" => "N",
		"directionNav" => "N",
		"effect" => "fade",
		"height" => "496",
		"pauseOnHover" => "N",
		"pauseTime" => "4000",
		"slices" => "6",
		"startSlide" => "0",
		"text_title" => "",
		"width" => "1170"
	)
);?>			
         </div>
         <!--promo-block-->	
		 
			<table id="banner_block">
			<tbody>
			<tr>
			<td><div>Полный ассортимент крепежа доступен на складе</div></td>
			<td><div>Получите заказ в этот же день с доставкой по Москве и области</div></td>
			<td><div>"КРЕП-КОМП" - главный оптовый поставщик крепежа в России</div></td>
			</tr>
			</tbody>
			</table>		
	


         <!--sales-slider-->
         <div class="basic-layout__module sales-slider">
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
	<!--sales-slider-->
	
	
	
	
         <!--special-products-->
         <div class="basic-layout__module special-products">
            <!--widget-tabs-->
            <div class="special-products__tabs widget-tabs">
               <ul class="widget-tabs__list" data-tabby-tabs>
                  <li class="widget-tabs__item">
                     <a class="widget-tabs__toggle" href="#sale" data-tabby-default>Товары со скидкой</a>
                  </li>
                  <li class="widget-tabs__item">
                     <a class="widget-tabs__toggle" href="#new">Новинки</a>
                  </li>
               </ul>
            </div>
            <!--widget-tabs-->
			

<div class="special-products__list" id="sale">
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
	
	
	
	<div class="special-products__list" id="new">
            <?$APPLICATION->IncludeComponent(
	    "bitrix:catalog.section", 
	    "main_sale", 
	    array(
		"COMPONENT_TEMPLATE" => "main_sale",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID"=>CATALOG_IBLOCK_ID,
		
		"SECTION_CODE" => "samorezy",
		
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
	

	
</main>
<footer class="basic-layout__footer">
    <div class="basic-layout__section">
	<!--website-about-->
         <div class="website-about">
            <div class="website-about__nav">
				<nav class="fast-nav">
				<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"bottom_menu", 
	array(
		"ROOT_MENU_TYPE" => "bottom",
		"MAX_LEVEL" => "3",
		"CHILD_MENU_TYPE" => "bottom",
		"USE_EXT" => "Y",
		"COMPONENT_TEMPLATE" => "bottom_menu",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
				</nav>
			</div>
			<div class="website-about__info">
				<!--project-contact-->
				<div class="website-about__contact project-contact">
					<?if(SITE_ID=='s1'):?>
						<p class="project-contact__desc">Интернет-магазин крепежа, метизов и инструмента «КРЕП-КОМП»</p>
					<?elseif(SITE_ID=='s2'):?>
						<p class="project-contact__desc">Интернет-магазин крепежа, метизов и инструмента «МОСКРЕП»</p>
					<?endif;?>
					<p class="project-contact__data">Телефон: 
	<?$APPLICATION->IncludeComponent("d7:contact_shops","phone",Array(
				"IBLOCK_ID" => "19", 
				"CACHE_TYPE" => "A", 
                "CACHE_TIME" => "3600", 
                "CACHE_FILTER" => "N",
				"LIMIT" => 1,	
                    ), false
    );?>	                    
					</p>
				</div>
               <!--project-contact-->
               <!--project-copy-->
				<div class="website-about__copy project-copy">
					<?include_once $_SERVER["DOCUMENT_ROOT"] . "/include/disclaimer_footer.php";?>
					<p class="project-copy__text">Информация на сайте krep-komp.ru не является публичной офертой. Указанные цены действуют только при оформлении заказа через интернет-магазин krep-komp.ru</p>
					<p class="project-copy__text">© 2005 – 2020 Интернет-магазин «КРЕП-КОМП» <?$APPLICATION->IncludeFile("/include/city.php", array(), array("SHOW_BORDER" => true, "MODE"=>"php"));?></p>
					<p class="privacy"><a class="blue underline" href="/privacy/">Политика компании</a></p>
				</div>
               <!--project-copy-->
			   
		<div id="social">
		<a class="vk" target="_blank" href="https://vk.com/krep_komp"></a>
		<a class="youtube" target="_blank" href="https://www.youtube.com/channel/UCOKXuIbajRZpYJ4uShRzMYw"></a>
		<a class="instagram" target="_blank" href="https://www.instagram.com/krep_komp/"></a>
		<a class="facebook" target="_blank" href="https://www.facebook.com/krep.komp.ru"></a>
		</div>		
    </div>			   
			</div>
        </div>
        <!--website-about-->
		
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




<?//$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.min.js");?>
<?//$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/slick.min.js");?>
<?//$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.popup.js");?>
<?//$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/fancybox.min.js");?>
<?//$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/common.js");?>
<?//$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.cookie.js");?>

<?//$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/scripts/jquery-3.4.1.min.js");?>
<?//$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/scripts/global.scripts.min.js?v=XXXXXXa");?>
<?//$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/scripts/jquery.icheck-1.0.2.min.js?v=XXXXXXa");?>
<?//$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/scripts/jquery.izimodal-1.6.0.min.js?v=XXXXXXa");?>
<?//$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/scripts/jquery.slick-1.9.0.min.js?v=XXXXXXa");?>
<?//$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/scripts/tabby-12.0.3.min.js?v=XXXXXXa");?>






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

   


<?global $USER; if ($USER->GetID()!=1) include_once $_SERVER["DOCUMENT_ROOT"] . "/include/jivosite.php";?>
<!-- Roistat BEGIN CODE -->
        <script>
            (function(w, d, s, h, id) {
                w.roistatProjectId = id; w.roistatHost = h;
                var p = d.location.protocol == "https:" ? "https://" : "http://";
                var u = /^.*roistat_visit=[^;]+(.*)?$/.test(d.cookie) ? "/dist/module.js" : "/api/site/1.0/"+id+"/init?referrer="+encodeURIComponent(d.location.href);
                var js = d.createElement(s); js.charset="UTF-8"; js.async = 1; js.src = p+h+u; var js2 = d.getElementsByTagName(s)[0]; js2.parentNode.insertBefore(js, js2);
            })(window, document, 'script', 'cloud.roistat.com', 'e39376bd761820b5780e54eda70448e1');
        </script>
        <!-- Roistat END CODE -->
</body>
</html>