<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оплата");
?>
<?
use Bitrix\Main\Application; 
use Bitrix\Main\Web\Cookie; 
?>
<?if(SITE_TEMPLATE_ID=='moskrep'){?>

<?globalGetTitle()?>

            <div class="basic-layout__module simple-article">
               <div class="simple-article__content">
                  <!--payment-option-->
                  <section class="simple-article__section payment-option">
                     <div class="payment-option__header">
                        <h3 class="payment-option__title">Банковской картой через сайт (только для физических лиц)</h3>
                        <p class="payment-option__desc">Вы можете произвести оплату банковской картой через сайт. Перед оплатой через сайт дождитесь связи с нашим менеджером для подтверждения заказ.</p>
                     </div>
                     <div class="payment-option__cover">
                        <img class="payment-option__icon" src="<?=SITE_TEMPLATE_PATH?>/img/i-delivery-01.png" width="53" height="47" alt="Банковской картой через сайт" title="Банковской картой через сайт" />
                     </div>
                  </section>
                  <!--payment-option-->
                  <!--payment-option-->
                  <section class="simple-article__section payment-option">
                     <div class="payment-option__header">
                        <h3 class="payment-option__title">Банковской картой в офисе, в магазине и в ПВЗ (только для физических лиц)</h3>
                        <p class="payment-option__desc">Вы можете произвести оплату банковской картой у нас в офисе, магазине и в пунктах выдачи заказов.</p>
                     </div>
                     <div class="payment-option__cover">
                        <img class="payment-option__icon" src="<?=SITE_TEMPLATE_PATH?>/img/i-delivery-01.png" width="53" height="47" alt="Банковской картой в офисе, в магазине и в ПВЗ" title="Банковской картой в офисе, в магазине и в ПВЗ" />
                     </div>
                  </section>
                  <!--payment-option-->
                  <!--payment-option-->
                  <section class="simple-article__section payment-option">
                     <div class="payment-option__header">
                        <h3 class="payment-option__title">Наличными</h3>
                        <p class="payment-option__desc">Оплатить заказ Вы можете наличными в офисе (на складе) нашей компании или в одном из наших магазинов, пунктов выдачи товара, или водителю-экспедитору при получении заказа.</p>
                     </div>
                     <div class="payment-option__cover">
                        <img class="payment-option__icon" src="<?=SITE_TEMPLATE_PATH?>/img/i-delivery-02.png" width="52" height="47" alt="Наличными" title="Наличными" />
                     </div>
                  </section>
                  <!--payment-option-->
                  <!--payment-option-->
                  <section class="simple-article__section payment-option">
                     <div class="payment-option__header">
                        <h3 class="payment-option__title">Безналичный платеж</h3>
                        <p class="payment-option__desc">После получения заказа Вам выставляется счет на оплату, который Вы оплачиваете через банк. Как только денежные средства поступят на наш расчетный счет, Вы сможете забрать заказ.</p>
                     </div>
                     <div class="payment-option__cover">
                        <img class="payment-option__icon" src="<?=SITE_TEMPLATE_PATH?>/img/i-delivery-03.png" width="41" height="36" alt="Безналичный платеж" title="Безналичный платеж" />
                     </div>
                  </section>
                  <!--payment-option-->
               </div>
            </div>
<?}else{?>

<h1 class="s38-title"><?=$APPLICATION->ShowTitle();?></h1>
<ul class="delivery">
		<li class="delivery__item">
		<div class="delivery__icon">
			<img src="/local/templates/moskrep/img/i-delivery-01.png" alt="">
		</div>
		<div class="delivery__text">
 <strong>Банковской картой через сайт(только для физических лиц)</strong>
			<p>
				Вы можете произвести оплату банковской картой через сайт. Перед оплатой через сайт дождитесь связи с нашим менеджером для подтверждения заказ.
			</p>
		</div>
 </li>
<li class="delivery__item">
		<div class="delivery__icon">
			<img src="/local/templates/moskrep/img/i-delivery-01.png" alt="">
		</div>
		<div class="delivery__text">
 <strong>Банковской картой в офисе, в магазине и в ПВЗ(только для физических лиц)</strong>
			<p>
				Вы можете произвести оплату банковской картой у нас в офисе, магазине и в пунктах выдачи заказов.
			</p>
		</div>
 </li>
		<li class="delivery__item">
		<div class="delivery__icon">
			<img src="/local/templates/moskrep/img/i-delivery-02.png" alt="">
		</div>
		<div class="delivery__text">
 <strong>Наличными</strong>
			<p>
				Оплатить заказ Вы можете наличными в офисе (на складе) нашей компании или в одном из наших магазинов, пунктов выдачи товара, или водителю-экспедитору при получении заказа.
			</p>
		</div>
 </li>
		<li class="delivery__item">
		<div class="delivery__icon">
			<img src="/local/templates/moskrep/img/i-delivery-03.png" alt="">
		</div>
		<div class="delivery__text">
 <strong>Безналичный платеж</strong>
			<p>
				После получения заказа Вам выставляется счет на оплату, который Вы оплачиваете через банк. Как только денежные средства поступят на наш расчетный счет, Вы сможете забрать заказ.
			</p>
		</div>
 </li>
	</ul>



<?}?>			

	<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>