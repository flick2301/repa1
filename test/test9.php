<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog.php");?>
<?
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Page\Asset;
use Bitrix\Main\Application;

Loc::LoadMessages(__FILE__);
global $APPLICATION;
?>
<script>!function(e,t,n,c,o){e[o]=e[o]||function(){(e[o].a=e[o].a||[]).push(arguments)},e[o].h=c,e[o].n=o,e[o].i=1*new Date,s=t.createElement(n),a=t.getElementsByTagName(n)[0],s.async=1,s.src=c,a.parentNode.insertBefore(s,a)}(window,document,"script","https://cdn2.searchbooster.net/scripts/v2/init.js","searchbooster"),searchbooster({"apiKey":"c483a591-b614-482b-b957-7a5bc5ed1d75","apiUrl":"https://api4.searchbooster.io","scriptUrl":"https://cdn2.searchbooster.net/scripts/v2/init.js","initialized":(sb)=>{sb.mount({"selector":"#search-popup","widget":"search-popup","options":{}});}});</script>
<?
$APPLICATION->IncludeComponent(
	"webcreature:dsearch.ajax", 
	"krep-komp_module", 
	array(
		"ARTNO" => "CML2_ARTICLE",
		"CATEGORY" => array(
			0 => "0",
		),
		"DESCRIPTION_LEN" => "300",
		"IBLOCK_ID" => "17",
		"IBLOCK_TYPE" => "catalog",
		"IN_CATEGORY" => "Y",
		"SEARCH_VARIABLE" => "result",
		"SIZE" => "8",
		"STAT" => "Y",
		"STAT_LIMIT" => "10000",
		"COMPONENT_TEMPLATE" => "krep-komp_module"
	),
	false
);?>
	<?if (CSite::InDir('/index.php') && SITE_ID!='s2'){
    ?>
	<div class="basic-layout__sidebar"></div>
<?}?>
		
		
			<?$page_footer_menu = Array(
				"/", 
				"/basket/",
				"/order/",
				"/import/",
			);
			?>
		
<?if (!in_array($APPLICATION->GetCurPage(), $page_footer_menu) && !preg_match('/test[0-9]*\.php/', $APPLICATION->GetCurPage())):?>
		<aside class="basic-layout__sidebar">
            <!--table-of-contents-->

	<?=$APPLICATION->ShowViewContent('RELINK');?>
	<?=$APPLICATION->ShowViewContent("smart_filter");?>

<?if($APPLICATION->GetCurPage() == "/personal/" || $APPLICATION->GetCurPage() == "/personal/private/" || $APPLICATION->GetCurPage() == "/personal/change_pass/"):?>
<?if($USER->IsAuthorized()):?>
 <div class="contacts__leftside ">
 
					<?$APPLICATION->IncludeComponent(
						"bitrix:menu", 
						"left_bottom_new", 
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
							"COMPONENT_TEMPLATE" => "left_bottom_new",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => array(),
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "N"
							),
						false
					);?>
					
</div>
<?endif?>
<?else:?>
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
			3 => "1655",
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
<?endif?>	
	
         </aside>
<?endif?>

</div>
		        <?
if (CSite::InDir('/index.php') && SITE_ID!='s2'){
    ?>
	
<div class="basic-layout__section">	
	
<?/*	
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
*/?>

			<div id="banner_block_new">
			<div><div>Полный ассортимент крепежа доступен на складе</div></div>
			<div><div>Получите заказ в этот же день с доставкой по Москве и области</div></div>
			<div><div>"КРЕП-КОМП" - главный оптовый поставщик крепежа в России</div></div>
			</div>	
		 
			<!--
			<table id="banner_block">
			<tbody>
			<tr>
			<td><div><div>Полный ассортимент крепежа доступен на складе</div></div></td>
			<td><div><div>Получите заказ в этот же день с доставкой по Москве и области</div></div></td>
			<td><div><div>"КРЕП-КОМП" - главный оптовый поставщик крепежа в России</div></div></td>
			</tr>
			</tbody>
			</table>		
			-->
	

<?/*
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
*/?>	
	
	
	

</div>
<?}?>
	

	
</main>































   



	
	

<!-- Roistat BEGIN CODE -->
<script>window.roistatCookieDomain = 'krep-komp.ru';</script>
<script>
    (function(w, d, s, h, id) {
        w.roistatProjectId = id; w.roistatHost = h;
        var p = d.location.protocol == "https:" ? "https://" : "http://";
        var u = /^.*roistat_visit=[^;]+(.*)?$/.test(d.cookie) ? "/dist/module.js" : "/api/site/1.0/"+id+"/init?referrer="+encodeURIComponent(d.location.href);
        var js = d.createElement(s); js.charset="UTF-8"; js.async = 1; js.src = p+h+u; var js2 = d.getElementsByTagName(s)[0]; js2.parentNode.insertBefore(js, js2);
    })(window, document, 'script', 'cloud.roistat.com', 'e39376bd761820b5780e54eda70448e1');
</script>
<script type="text/javascript">
    (function () {
        var ct_max_wait = 150;
        var ct_wait_attr = setInterval(function () {
            ct_max_wait--;
            if (ct_max_wait < 0) {
                clearInterval(ct_wait_attr);
            }
            try {
                if (!!window.ct && !!window.call_value && !!window.roistat && !!window.roistat.visit) {
                    ct('set_attrs', '{"roistat_visit":' + window.roistat.visit + '}');
                    clearInterval(ct_wait_attr);
                }
            } catch (e) {
                console.log(e)
            }
        }, 200);
    })();
</script>
<script>
    jQuery(document).ready(function ($) {
        $("#feedback_form").bind('submit', function() {
            var name = $("input[name='user_name']",this).val();
            var phone = $("input[name='user_tell']",this).val();
            var email = $("input[name='user_email']",this).val();

            roistatGoal.reach({
                name: name,
                phone: phone,
                email: email,
                leadName: "Оставить заявку",
                is_skip_sending: "1",
                
            });
        })
    });
</script>
        <!-- Roistat END CODE -->

</body>
</html>