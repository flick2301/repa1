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
				  </div>
            </div>
          </div>
        </div>
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

<tr >
									<th>5%</th>
									<td >от 5 000 руб</td>
								</tr>
								<tr >
									<th>10%</th>
									<td >от 10 000 руб</td>
								</tr>
								<tr>
									<th>15%</th>
									<td >от 15 000 руб</td>
								</tr>
								<tr>
									<th>20%</th>
									<td >от 20 000 руб</td>
								</tr>
								<tr>
									<th>25%</th>
									<td >от 25 000 руб</td>
								</tr>
								<tr>
									<th>30%</th>
									<td >от 100 000 руб</td>
								</tr>
								<tr>
									<th>35%</th>
									<td >от 500 000 руб</td>
								</tr>
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
</body>
</html>