<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оплата");
?><? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array()); ?>
<?
use Bitrix\Main\Application; 
use Bitrix\Main\Web\Cookie; 

?>
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
	</ul><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>