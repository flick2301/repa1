<?if (CSite::InDir('/index.php') && SITE_ID!='s2'){
		?>				<div class="basic-layout__sidebar"></div>
		<?}?>
		
		
		<?if($APPLICATION->GetCurPage() !== "/")
		{?>
			</div>
		</div>
		<?}?>
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
	




<!--
    <div class="banner">
      <div class="container">
        <div class="banner__wrapper"><a class="banner__block" href=""><img class="banner__img" src="<?=SITE_TEMPLATE_PATH?>/images/banner.png"><img class="banner__mobile" src="<?=SITE_TEMPLATE_PATH?>/images/mobile-banner.png"></a></div>
      </div>
    </div>
-->





	
<?if($APPLICATION->GetCurPage() !== "/")
	{?>
			</div>
		</div>
	</div>
</div>


	<?}?>


				<?=$APPLICATION->ShowViewContent('catalog_desc');?>







	<div class="footer">
      <div class="container">
        <div class="footer__wrapper">
          <div class="footer__left">
            <div class="footer__topside"><a class="footer__logo" href="/"><img class="footer__img" src="<?=SITE_TEMPLATE_PATH?>/images/logo-footer.svg"></a>
              <div class="footer__desc">Интернет-магазин крепежа, метизов и инструмента «КРЕП-КОМП»</div>
            </div>
            <div class="footer__rights">© Все права защищены <?=date('Y')?></div>
          </div>
          <div class="footer__center">
            <div class="footer__menu">
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
			</div>
              
            <div class="footer__payments">
              <div class="footer__payment"><img class="footer__payment__img" src="<?=SITE_TEMPLATE_PATH?>/images/payment/1.svg"></div>
              <div class="footer__payment"><img class="footer__payment__img" src="<?=SITE_TEMPLATE_PATH?>/images/payment/2.svg"></div>
              <div class="footer__payment"><img class="footer__payment__img" src="<?=SITE_TEMPLATE_PATH?>/images/payment/3.svg"></div>
              <!--<div class="footer__payment"><img class="footer__payment__img" src="<?=SITE_TEMPLATE_PATH?>/images/payment/4.svg"></div>
              <div class="footer__payment"><img class="footer__payment__img" src="<?=SITE_TEMPLATE_PATH?>/images/payment/5.svg"></div>-->
            </div>
          </div>
          <div class="footer__right">
            <div class="footer__top">
              <div class="footer__item"><a class="footer__link" href="/">Пользовательское соглашение</a></div>
              <div class="footer__item"><a class="footer__link" href="/">Что такое cookies?</a></div>
              <div class="footer__item"><a class="footer__link" href="/">Программа лояльности</a></div>
            </div>
            <div class="footer__bot"><?$APPLICATION->IncludeComponent("d7:contact_shops","phone",Array(
				"IBLOCK_ID" => "19", 
				"CACHE_TYPE" => "A", 
                "CACHE_TIME" => "3600", 
                "CACHE_FILTER" => "N",
				"LIMIT" => 1,	
                    ), false
    );?>
	
	

<div class="footer-yandex-widget">
<a href="https://clck.yandex.ru/redir/dtype=stred/pid=47/cid=73582/path=dynamic.88x31/*https://market.yandex.ru/shop--krep-komp/557450/reviews"> <img src="https://clck.yandex.ru/redir/dtype=stred/pid=47/cid=73581/path=dynamic.88x31/*https://grade.market.yandex.ru/?id=557450&action=image&size=0" border="0" alt="Читайте отзывы покупателей и оценивайте качество магазина КРЕП-КОМП на Яндекс.Маркете" /> </a>
</div>

	
              <div class="footer__socials"><a class="footer__social" target="_blank" href="https://vk.com/krep_komp">
                  <svg viewBox="0 0 29 30" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21.952 10.957c.114-.375 0-.65-.54-.65h-1.786c-.455 0-.663.238-.777.5 0 0-.908 2.193-2.195 3.616-.416.414-.606.544-.832.544-.113 0-.278-.13-.278-.506v-3.504c0-.45-.131-.65-.51-.65h-2.808c-.283 0-.454.208-.454.406 0 .426.643.525.71 1.726v2.604c0 .57-.104.675-.332.675-.606 0-2.079-2.202-2.953-4.723-.17-.49-.342-.688-.798-.688H6.613c-.511 0-.613.239-.613.5 0 .47.605 2.793 2.82 5.867 1.476 2.099 3.555 3.236 5.448 3.236 1.135 0 1.275-.252 1.275-.688v-1.586c0-.505.109-.607.468-.607.264 0 .719.132 1.779 1.143 1.21 1.2 1.41 1.738 2.09 1.738h1.787c.51 0 .765-.253.618-.752-.16-.496-.739-1.218-1.506-2.073-.417-.487-1.04-1.011-1.23-1.274-.265-.338-.189-.487 0-.787 0 0 2.177-3.035 2.403-4.067z"></path>
                  </svg></a><a class="footer__social" target="_blank" href="https://www.youtube.com/channel/UCOKXuIbajRZpYJ4uShRzMYw">
                  <svg viewBox="0 0 29 30" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 9.30664L21 15.3066L11 21.3066V9.30664Z"></path>
                  </svg></a>
				  <!--
				  <a class="footer__social" target="_blank" href="https://www.instagram.com/krep_komp/">
                  <svg viewBox="0 0 29 30" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.5009 5.30664C11.9208 5.30664 11.597 5.31792 10.5837 5.36404C9.57232 5.41035 8.88198 5.57046 8.27793 5.80539C7.6531 6.04804 7.12307 6.37262 6.59503 6.90086C6.06658 7.4289 5.742 7.95892 5.49856 8.58355C5.26303 9.18779 5.10272 9.87832 5.0572 10.8893C5.01188 11.9026 5 12.2266 5 14.8066C5 17.3867 5.01148 17.7095 5.0574 18.7228C5.10391 19.7342 5.26402 20.4245 5.49876 21.0285C5.7416 21.6534 6.06619 22.1834 6.59443 22.7114C7.12228 23.2399 7.65231 23.5652 8.27674 23.8079C8.88119 24.0428 9.57172 24.2029 10.5829 24.2492C11.5962 24.2954 11.9198 24.3066 14.4997 24.3066C17.08 24.3066 17.4028 24.2954 18.4161 24.2492C19.4275 24.2029 20.1186 24.0428 20.7231 23.8079C21.3477 23.5652 21.8769 23.2399 22.4048 22.7114C22.9332 22.1834 23.2578 21.6534 23.5012 21.0287C23.7348 20.4245 23.8951 19.734 23.9426 18.723C23.9881 17.7097 24 17.3867 24 14.8066C24 12.2266 23.9881 11.9028 23.9426 10.8895C23.8951 9.87812 23.7348 9.18779 23.5012 8.58374C23.2578 7.95892 22.9332 7.4289 22.4048 6.90086C21.8763 6.37242 21.3479 6.04784 20.7225 5.80539C20.1168 5.57046 19.4261 5.41035 18.4147 5.36404C17.4014 5.31792 17.0788 5.30664 14.4979 5.30664H14.5009ZM13.6487 7.01862C13.9016 7.01822 14.1838 7.01862 14.5009 7.01862C17.0374 7.01862 17.3381 7.02772 18.3397 7.07324C19.266 7.1156 19.7687 7.27037 20.1036 7.4004C20.5469 7.57259 20.863 7.77842 21.1953 8.11092C21.5278 8.44342 21.7336 8.76009 21.9062 9.20342C22.0362 9.5379 22.1912 10.0406 22.2334 10.9669C22.2789 11.9683 22.2888 12.2691 22.2888 14.8045C22.2888 17.3398 22.2789 17.6406 22.2334 18.6421C22.191 19.5683 22.0362 20.071 21.9062 20.4055C21.734 20.8488 21.5278 21.1645 21.1953 21.4968C20.8628 21.8293 20.5471 22.0352 20.1036 22.2073C19.7691 22.338 19.266 22.4923 18.3397 22.5347C17.3383 22.5802 17.0374 22.5901 14.5009 22.5901C11.9642 22.5901 11.6635 22.5802 10.6621 22.5347C9.7358 22.4919 9.23309 22.3372 8.89801 22.2071C8.45467 22.035 8.138 21.8291 7.8055 21.4966C7.47299 21.1641 7.26716 20.8482 7.09457 20.4047C6.96454 20.0702 6.80957 19.5675 6.76741 18.6413C6.72189 17.6398 6.71279 17.339 6.71279 14.8021C6.71279 12.2652 6.72189 11.9659 6.76741 10.9645C6.80977 10.0382 6.96454 9.53553 7.09457 9.20065C7.26676 8.75732 7.47299 8.44065 7.8055 8.10815C8.138 7.77565 8.45467 7.56982 8.89801 7.39723C9.23289 7.26661 9.7358 7.11223 10.6621 7.06968C11.5384 7.0301 11.8781 7.01822 13.6487 7.01624V7.01862ZM19.572 8.59602C18.9426 8.59602 18.432 9.10605 18.432 9.73562C18.432 10.365 18.9426 10.8756 19.572 10.8756C20.2013 10.8756 20.712 10.365 20.712 9.73562C20.712 9.10624 20.2013 8.59602 19.572 8.59602ZM14.5009 9.92799C11.8066 9.92799 9.62219 12.1124 9.62219 14.8066C9.62219 17.5009 11.8066 19.6843 14.5009 19.6843C17.1952 19.6843 19.3788 17.5009 19.3788 14.8066C19.3788 12.1124 17.1952 9.92799 14.5009 9.92799ZM14.5009 11.64C16.2497 11.64 17.6676 13.0577 17.6676 14.8066C17.6676 16.5554 16.2497 17.9733 14.5009 17.9733C12.7519 17.9733 11.3342 16.5554 11.3342 14.8066C11.3342 13.0577 12.7519 11.64 14.5009 11.64Z"></path>
                  </svg></a><a class="footer__social" target="_blank" href="https://www.facebook.com/ru.krepkomp">
                  <svg viewBox="0 0 29 30" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.8467 23.3066V15.5647H18.5122L18.9084 12.5335H15.8467V10.6028C15.8467 9.7281 16.0954 9.12923 17.3766 9.12923H19V6.42675C18.2105 6.34362 17.4161 6.30395 16.6218 6.30678C14.2657 6.30678 12.6481 7.71612 12.6481 10.3034V12.5279H10V15.5591H12.6539V23.3066H15.8467Z"></path>
                  </svg></a>
				  <a class="footer__social" target="_blank" href="/">
                  <svg viewBox="0 0 29 30" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.1274 9.53995C18.6828 8.10056 16.7619 7.30749 14.7156 7.30664C10.4987 7.30664 7.06587 10.7223 7.06416 14.9209C7.06416 16.2628 7.41614 17.5724 8.08515 18.7276L7.00024 22.6726L11.0561 21.6132C12.1742 22.2197 13.4321 22.5395 14.7122 22.5403H14.7156C18.9317 22.5403 22.3645 19.1246 22.3662 14.926C22.3662 12.892 21.5719 10.9793 20.1274 9.53995ZM14.7156 21.2553H14.7131C13.5719 21.2544 12.4529 20.9499 11.4762 20.3723L11.2444 20.2349L8.83769 20.8634L9.47943 18.5283L9.32858 18.2891C8.69195 17.2815 8.35617 16.1169 8.35617 14.9209C8.35787 11.4314 11.2103 8.59251 14.7182 8.59251C16.4167 8.59336 18.013 9.25241 19.2138 10.4484C20.4137 11.6452 21.0751 13.2347 21.0742 14.926C21.0725 18.4155 18.2201 21.2553 14.7156 21.2553ZM18.2039 16.5147C18.0121 16.4188 17.0729 15.9591 16.8974 15.8955C16.7227 15.8319 16.5957 15.8005 16.4678 15.9905C16.34 16.1805 15.9735 16.6088 15.8619 16.7361C15.7502 16.8633 15.6386 16.8786 15.4477 16.7836C15.2568 16.6886 14.6406 16.4876 13.9102 15.8395C13.3418 15.3349 12.9583 14.7123 12.8466 14.5214C12.735 14.3306 12.8347 14.2279 12.931 14.133C13.0171 14.0481 13.1219 13.9107 13.2174 13.7996C13.3128 13.6885 13.3444 13.6096 13.4083 13.4824C13.4722 13.3552 13.4407 13.244 13.3921 13.149C13.3444 13.0532 12.9617 12.1168 12.8023 11.7359C12.6481 11.367 12.4904 11.4162 12.3728 11.4111C12.262 11.406 12.1342 11.4043 12.0072 11.4043C11.8793 11.4043 11.6723 11.4518 11.4967 11.6418C11.3211 11.8326 10.8277 12.2924 10.8277 13.2288C10.8277 14.1652 11.5129 15.0702 11.6083 15.1974C11.7038 15.3247 12.9566 17.2458 14.8741 18.0703C15.3309 18.2662 15.6872 18.3833 15.9642 18.4715C16.4218 18.6165 16.8386 18.5953 17.1684 18.547C17.5357 18.4927 18.2993 18.0873 18.4587 17.6428C18.6181 17.1983 18.6181 16.8175 18.5703 16.7378C18.5226 16.658 18.3939 16.6097 18.2039 16.5147Z"></path>
                  </svg></a><a class="footer__social" target="_blank" href="/">
                  <svg viewBox="0 0 29 30" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.4333 9.38242L7.67265 14.0763C6.80179 14.4099 6.80683 14.8733 7.51288 15.08L10.789 16.0549L18.3691 11.4928C18.7275 11.2848 19.055 11.3967 18.7858 11.6246L12.6445 16.9117H12.643L12.6445 16.9123L12.4185 20.1336C12.7495 20.1336 12.8956 19.9887 13.0813 19.8178L14.6726 18.3417L17.9826 20.6739C18.5929 20.9945 19.0312 20.8297 19.1831 20.1349L21.3559 10.3669C21.5783 9.51629 21.0155 9.13114 20.4333 9.38242Z"></path>
                  </svg></a>--></div>
            </div>
          </div>
        </div>
      </div>
    </div>












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


</div>


<div id="wholesale-block">
<div class="wholesale-block">
<div class="wholesale-block__top">
<div class="wholesale-block__title">Получите скидку<br />на оптовый заказ!</div>

<div class="wholesale-block__table-block">
<table class="wholesale-block__table" rules="all">
<tr><td>5%</td><td>от 20 000 руб</td></tr>
<tr><td>10%</td><td>от 100 000 руб</td></tr>
<tr><td>15%</td><td>от 500 000 руб</td></tr>
</table>
</div>
</div>
<div class="wholesale-block__bottom">
<a class="wholesale-block__discover" href="/vashi_skidki/" target="_blank">Узнать подробнее</a>
</div>
</div>
</div>
<!-- Roistat BEGIN CODE -->
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
        <!-- Roistat END CODE -->
</body>
</html>