<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Адреса магазинов");
?>
<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array()); ?>
			<h1 class="s38-title"><?=$APPLICATION->ShowTitle();?></h1>
<ul class='delivery_items'>
	<li data-tab='vivoz_1' class='delivery_item active'>Москва и МО</li>
	<li data-tab='vivoz_2' class='delivery_item spb'>Санкт-Петербург</li>

</ul>

<div id='vivoz_2' class='delivery__tabs-list spb'> 

<?require_once($_SERVER["DOCUMENT_ROOT"] . "/kontent-elementa/contact_spb.php");?>

</div>
<div id='vivoz_1' class='delivery__tabs-list active'> 
<p>Забрать груз в пункте самовывоза на Каширском шоссе можно на следующий день. Для этого оформить заказ нужно до 15:00. 

	Суббота и Воскресенье - выходные дни.</p>
			<div class="contact">
				<div class="contact__wrapper">
					<div class="contact__text">
						<div class="contact__first">
							<strong>Магазин и точка выдачи<br> в Москве</strong>
							<p>г. Москва,  Каширское ш., д. 7, корп. 3<br> пн-пт 9:00-18:00;</p>
						</div>
						<div class="contact__last">
							<a href="tel:+7 (499) 350-55-55" class="contact__phone roistat-phone">8 499 350-55-55</a>
							<a href="skype:moskrep1236696" class="contact__skype">moskrep1236696</a>
						</div>
					</div>
					<div class="contact__map">
						<div id="map1"><?include($_SERVER["DOCUMENT_ROOT"].'/include/map1.php');?></div>
					</div>
				</div>
			</div>
                        
			<div class="contact">
				<div class="contact__wrapper">
					<div class="contact__text">
						<div class="contact__first">
							<strong>Склад и интернет-магазин<br> в г. Подольск</strong>
							<p>Россия, Московская область, городской округ Подольск, Коледино, 1Вс3, склад #6<br> пн-пт 9:00-18:00;</p>
						</div>
						<div class="contact__last">
							<a href="tel:+7 (499) 350-55-55" class="contact__phone roistat-phone">8 499 350-55-55</a>
							<a href="skype:moskrep.ru" class="contact__skype">moskrep.ru</a>
						</div>
					</div>
					<div class="contact__map">
						<div id="map2"><?include($_SERVER["DOCUMENT_ROOT"].'/include/map2.php');?></div>
					</div>
				</div>
			</div>
			
			<div class="contact">
				<div class="contact__wrapper">
					<div class="contact__text">
						<div class="contact__first">
							<strong>Магазин и точка выдачи<br> в Москве</strong>
							<p>Москва, 2-й Кабельный проезд, дом 1, блок 2, 1-ый этаж, павильон 106<br> пн-пт 9:00-18:00;</p>
						</div>
						<div class="contact__last">
							<a href="tel:+7 (499) 350-55-55" class="contact__phone roistat-phone">8 499 350-55-55</a>
							<a href="skype:moskrep.ru" class="contact__skype">moskrep.ru</a>
						</div>
					</div>
					<div class="contact__map">
						<div id="map2"><?include($_SERVER["DOCUMENT_ROOT"].'/include/map4.php');?></div>
					</div>
				</div>
			</div>
			
			<div class="contact">
				<div class="contact__wrapper">
					<div class="contact__text">
						<div class="contact__first">
							<strong>Магазин и точка выдачи<br> в Серпухове</strong>
							<p>Московская область, город Серпухов, улица Звездная 6а, павильон №3<br> пн-пт 9:00-18:00;</p>
						</div>
						<div class="contact__last">
							<a href="tel:+7 (499) 350-55-55" class="contact__phone roistat-phone">8 499 350-55-55</a>
							<a href="skype:moskrep.ru" class="contact__skype">moskrep.ru</a>
						</div>
					</div>
					<div class="contact__map">
						<div id="map2"><?include($_SERVER["DOCUMENT_ROOT"].'/include/map5.php');?></div>
					</div>
				</div>
			</div>
			
</div>
			<h2 class="s28-title">ООО «КРЕП-КОМП»</h2>
			<ul class="requisites">
				<li class="requisites__item">
					<span class="requisites__title">Юридический адрес:</span>
					<p class="requisites__info">117534, г. Москва ул. Кировоградская, дом 23А, корпус 1</p>
				</li>
				<li class="requisites__item">
					<span class="requisites__title">Фактический адрес:</span>
					<p class="requisites__info">117534 г. Москва, ул. Кировоградская, дом 23А, корпус 1</p>
				</li>
				<li class="requisites__item">
					<span class="requisites__title">ИНН</span>
					<p class="requisites__info">7726517049</p>
				</li>
				<li class="requisites__item">
					<span class="requisites__title">КПП</span>
					<p class="requisites__info">772601001</p>
				</li>
				<li class="requisites__item">
					<span class="requisites__title">р/сч.</span>
					<p class="requisites__info">40702810900000460880</p>
				</li>
				<li class="requisites__item">
					<span class="requisites__title">к/сч.</span>
					<p class="requisites__info">30101810445250000360</p>
				</li>
				<li class="requisites__item">
					<span class="requisites__title">АКБ</span>
					<p class="requisites__info">Филиал "Корпоративный" ПАО "Совкомбанк"</p>
				</li>
				<li class="requisites__item">
					<span class="requisites__title">ОКПО</span>
					<p class="requisites__info">76390392</p>
				</li>
				<li class="requisites__item">
					<span class="requisites__title">ОГРН</span>
					<p class="requisites__info">1057746185012</p>
				</li>
				<li class="requisites__item">
					<span class="requisites__title">ОКВЭД</span>
					<p class="requisites__info">51.70, 51.54</p>
				</li>
				<li class="requisites__item">
					<span class="requisites__title">ОКАТО</span>
					<p class="requisites__info">45296575000</p>
				</li>
				<li class="requisites__item">
					<span class="requisites__title">БИК</span>
					<p class="requisites__info">044525360</p>
				</li>
			</ul>
                            
                        
                            <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>