<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?><?

if($APPLICATION->GetCurPage() !== "/basket/" && $APPLICATION->GetCurPage() !== "/order/"):?>    
    
            <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "left_bottom",
            Array(
            "ROOT_MENU_TYPE" => "left_bottom", 
            "MAX_LEVEL" => "1", 
            "CHILD_MENU_TYPE" => "left_bottom", 
            "USE_EXT" => "Y" 
     )
);
endif;?>


</div>
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
			<div class="footer-right">
				<div class="contacts-footer">
					<p class="contacts-footer__slogan">Интернет-магазин крепежа и строитетельного инструмента «Москреп»</p>
					<div class="contacts-footer__phone">Телефон:<br> <a href="phone:<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/telephone.php"), false);?>"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/telephone.php"), false);?></a></div>
					<div class="contacts-footer__mail">e-mail: <a href="mailto:<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/email.php"), false);?>"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/email.php"), false);?></a></div>
				</div>
				<div class="copyright-footer">
					<p>Информация на сайте www.moskrep.ru не является публичной офертой. Указанные цены действуют только при оформлении заказа через интернет-магазин www.moskrep.ru.</p>
					<p>Обнаружив ошибку или неточность в тексте или описании товара, выделите ее и нажмите Shift+Enter.</p>
					<p>© 2002 — 2017<br> «Москреп».Интернет-магазин</p>
				</div>
			</div>
		</div>
	</footer>



<?/*$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.min.js");*/?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/slick.min.js");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.popup.js");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/common.js");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/fancybox.min.js");?>
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