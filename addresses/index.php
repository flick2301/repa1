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


	<?$APPLICATION->IncludeComponent("d7:contact_shops",".default",Array(
				"IBLOCK_ID" => "19", 
				"CACHE_TYPE" => "A", 
                "CACHE_TIME" => "3600", 
                "CACHE_FILTER" => "N" 
                    ), false
    );?>	
			
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