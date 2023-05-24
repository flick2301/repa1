</div>
		
		
		<?if (CSite::InDir('/index.php') && SITE_ID!='s2'){
    ?>
	<div class="basic-layout__sidebar"></div>
<?}?>
		
		
			<?$page_footer_menu = Array(
				"/", 
				"/basket/",
				"/order/",
				"/import/",
                "/test/test-for-egor.php"
			);
			?>
		
<?if (!in_array($APPLICATION->GetCurPage(), $page_footer_menu) && strpos($APPLICATION->GetCurPage(), "/articles/")===false):?>
		<aside class="basic-layout__sidebar">
            <!--table-of-contents-->

	
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

<?endif?>
	
         </aside>
<?endif?>

</div>
		        <?
if (CSite::InDir('/index.php') && SITE_ID!='s2'){
    ?>
	
<div class="basic-layout__section">	


			<div id="banner_block_new">
			<div><div>Полный ассортимент крепежа доступен на складе</div></div>
			<div><div>Получите заказ в этот же день с доставкой по Москве и области</div></div>
			<div><div>"КРЕП-КОМП" - главный оптовый поставщик крепежа в России</div></div>
			</div>	
	
	
	
	
         
</div>
<?}?>
	

	
</main>













<footer class="basic-layout__footer">
    <div class="basic-layout__section">
	
			<div class="footer_partition">
			<div class="footer_left">
				<div class="eshop-panel__brand">
			<!--website-logo-->
			<div class="website-logo">
				<?//$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/company_logo.php"), false, []);?>
				<img class="website-logo__img" alt="Магазин крепежа и метизов «КРЕП-КОМП" title="Магазин крепежа и метизов «КРЕП-КОМП»" src="/local/templates/moskrep/assets/design/website-logo/krep-komp.svg" />
				<a class="website-logo__link" href="<?=($APPLICATION->GetCurPage() != "/") ? '/' : 'javascript::void();'?>">На главную</a>
			</div>
			<!--website-logo-->
			</div>
			
			<div class="shop_name">Интернет магазин крепежа, метизов и инструмента «КРЕП-КОМП»</div>
			<div class="copy copy_desktop">Все права защищены <?=date('Y')?></div>
			</div>	

			<div class="footer_center">
            <div class="website-about__nav">
				<nav class="fast-nav">
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
			</div>			
			</div>
			
			<div class="footer_right">
			<div>
			<div class="dop_menu">
			<!--<div><a href="#">Полльзовательское соглашение</a></div>
			<div><a href="#">Политика конфиденциальности</a></div>
			<div><a href="#">Политика использования Cookie</a></div>-->
			<div><a href="/privacy/">Политика компании</a></div>			
			</div>
			
<div class="phone">			
	<?$APPLICATION->IncludeComponent("d7:contact_shops","phone",Array(
				"IBLOCK_ID" => "19", 
				"CACHE_TYPE" => "A", 
                "CACHE_TIME" => "3600", 
                "CACHE_FILTER" => "N",
				"LIMIT" => 1,	
                    ), false
    );?>	
</div>	

		<div id="social">
		<a class="vk" target="_blank" href="https://vk.com/krep_komp"></a>
		<a class="youtube" target="_blank" href="https://www.youtube.com/channel/UCOKXuIbajRZpYJ4uShRzMYw"></a>
		<a class="instagram" target="_blank" href="https://www.instagram.com/krep_komp/"></a>
		<a class="facebook" target="_blank" href="https://www.facebook.com/ru.krepkomp"></a>
		</div>	
		

<div class="footer-yandex-widget">
<a href="https://clck.yandex.ru/redir/dtype=stred/pid=47/cid=73582/path=dynamic.88x31/*https://market.yandex.ru/shop--krep-komp/557450/reviews"> <img src="https://clck.yandex.ru/redir/dtype=stred/pid=47/cid=73581/path=dynamic.88x31/*https://grade.market.yandex.ru/?id=557450&action=image&size=0" alt="Читайте отзывы покупателей и оценивайте качество магазина КРЕП-КОМП на Яндекс.Маркете" /> </a>
</div>



<div class="sale-order-detail-payment-options-methods-image-element footer-payment-system"></div>

		
		<div class="copy copy_mobile">Все права защищены <?=date('Y')?></div>
			
		</div>
		
			</div>
			</div>
			
			

</div>
</footer>



















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

   


<?global $USER;
CModule::IncludeModule('conversion');
$detect = new \Bitrix\Conversion\Internals\MobileDetect;
	if (!$USER->IsAdmin() && !$detect->isMobile()) include_once $_SERVER["DOCUMENT_ROOT"] . "/include/jivosite.php";?>
	
	

<!-- Roistat BEGIN CODE -->
<script>

window.onRoistatAllModulesLoaded = function () {

document.addEventListener('focusin', function(event) {

if (event.target.closest('.l-ss-c-host-node')) {

window.roistat.emailtracking.enabled = false;

}

});

document.addEventListener('focusout', function(event) {

if (event.target.closest('.l-ss-c-host-node')) {

window.roistat.emailtracking.enabled = true;

}

});

};

</script>
<script>window.roistatCookieDomain = '.krep-komp.ru';</script>
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
                fields: {
                    form: "Оставить заявку"
                }
            });
        })
    });
</script>
        <!-- Roistat END CODE -->
<script>!function(e,t,n,c,o){e[o]=e[o]||function(){(e[o].a=e[o].a||[]).push(arguments)},e[o].h=c,e[o].n=o,e[o].i=1*new Date,s=t.createElement(n),a=t.getElementsByTagName(n)[0],s.async=1,s.src=c,a.parentNode.insertBefore(s,a)}(window,document,"script","https://cdn2.searchbooster.net/scripts/v2/init.js","searchbooster"),searchbooster({"apiKey":"c483a591-b614-482b-b957-7a5bc5ed1d75","apiUrl":"https://api.searchbooster.net/","scriptUrl":"https://cdn2.searchbooster.net/scripts/v2/init.js","initialized":(sb)=>{sb.mount({"selector":"#search-popup","widget":"search-popup","options":{}});}});</script>

</body>
</html>