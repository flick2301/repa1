<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Адреса магазинов в {{city}}");
$APPLICATION->SetTitle("Адреса магазинов в {{city}}");
?><!--simple-article-->
<div class="basic-layout__module simple-article">

	 <?if(!$_REQUEST["ID"]):?> <?globalGetTitle()?> <?endif?>
	<div id="moscow" class="delivery__tabs-list active">
	
	<p>Выдача заказов осуществляется на следующий день после 13.00 при условии оформления заказа до 17.30 предыдущего дня.</p>
	
		 <?if(!$_REQUEST["ID"] && $_SERVER['HTTP_HOST']=='krep-komp.ru'):?>
		<ul>
			 <b>Магазин на Каширском шоссе:</b> 
			 <li>При оформлении заказа до 10.30, заказ можно забрать после 13.30 текущего дня;</li>
			 <li>При оформлении заказа с 10.30 до 14.30, заказ можно забрать после 16.30 текущего дня;</li>
			 <li>При оформлении заказа после 14.30, заказ можно забрать на следующий день после 13.30.</li>
		</ul><br />
		 <?endif?> 
 
		 
	<?$APPLICATION->IncludeComponent(
	"d7:contact_shops",
	"krep-komp.new",
	Array(
		"CACHE_FILTER" => "N",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"IBLOCK_ID" => "19"
	)
);?>
	</div>
	
	
	<div class="simple-article__content">
 <article class="simple-article__section wysiwyg-block">
		<h2>ООО «КРЕП-КОМП»</h2>
		 <!--bank-details-->
		<div class="bank-details">
			<ul class="bank-details__list">
				<li class="bank-details__item">
				<p class="bank-details__name">
					Юридический адрес:
				</p>
				<p class="bank-details__data">
					117519, г. Москва, Варшавское шоссе, 148, этаж 5, офис 501
				</p>
 </li>
				<li class="bank-details__item">
				<p class="bank-details__name">
					Фактический адрес:
				</p>
				<p class="bank-details__data">
					117519, г. Москва, Варшавское шоссе, 148, этаж 5, офис 501
				</p>
 </li>
				<li class="bank-details__item">
				<p class="bank-details__name">
					ИНН
				</p>
				<p class="bank-details__data">
					7726517049
				</p>
 </li>
				<li class="bank-details__item">
				<p class="bank-details__name">
					КПП
				</p>
				<p class="bank-details__data">
					772601001
				</p>
 </li>
				<li class="bank-details__item">
				<p class="bank-details__name">
					р/сч.
				</p>
				<p class="bank-details__data">
					40702810900000460880
				</p>
 </li>
				<li class="bank-details__item">
				<p class="bank-details__name">
					к/сч.
				</p>
				<p class="bank-details__data">
					30101810445250000360
				</p>
 </li>
				<li class="bank-details__item">
				<p class="bank-details__name">
					АКБ
				</p>
				<p class="bank-details__data">
					Филиал "Корпоративный" ПАО "Совкомбанк"
				</p>
 </li>
				<li class="bank-details__item">
				<p class="bank-details__name">
					ОКПО
				</p>
				<p class="bank-details__data">
					76390392
				</p>
 </li>
				<li class="bank-details__item">
				<p class="bank-details__name">
					ОГРН
				</p>
				<p class="bank-details__data">
					1057746185012
				</p>
 </li>
				<li class="bank-details__item">
				<p class="bank-details__name">
					ОКВЭД
				</p>
				<p class="bank-details__data">
					51.70, 51.54
				</p>
 </li>
				<li class="bank-details__item">
				<p class="bank-details__name">
					ОКАТО
				</p>
				<p class="bank-details__data">
					45296575000
				</p>
 </li>
				<li class="bank-details__item">
				<p class="bank-details__name">
					БИК
				</p>
				<p class="bank-details__data">
					044525360
				</p>
 </li>
			</ul>
		</div>
		 <!--bank-details--> </article>
	</div>
</div>
<!--simple-article--><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>