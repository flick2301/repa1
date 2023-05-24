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
			);
			?>
		
<?if (!in_array($APPLICATION->GetCurPage(), $page_footer_menu)):?>
		<aside class="basic-layout__sidebar">
            <!--table-of-contents-->

	<?=$APPLICATION->ShowViewContent('RELINK');?>
	<?=$APPLICATION->ShowViewContent("smart_filter");?>

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
	if ($USER->GetID()!=1 && !$_GET['administrator'] && !$detect->isMobile()) include_once $_SERVER["DOCUMENT_ROOT"] . "/include/jivosite.php";?>

</body>
</html>