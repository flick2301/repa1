<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Контакты Креп-Комп");
$APPLICATION->SetPageProperty("keywords", "контакты Креп-Комп");
$APPLICATION->SetPageProperty("description", "Контакты компании Креп-Комп");
$APPLICATION->SetTitle("Контакты");
?><?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"",
Array()
);?>
<h1 class="s38-title"><?=$APPLICATION->ShowTitle();?></h1>
 <?if($_SERVER['HTTP_HOST']=='spb.krep-komp.ru'){?>
<h2 class="s28-title">Контакты офиса в Санкт-Петербурге:</h2>
 <br>
 <a href="tel:+7 812 309-95-45" class="contact__phone roistat-phone-spb">+7 812 309-95-45</a><br>
 <br>
 <a href="mailto:spb@krep-komp.ru" class="contact__email">spb@krep-komp.ru</a><br>
 <?
require_once($_SERVER["DOCUMENT_ROOT"] . "/kontent-elementa/contact_spb.php");
}?>

	<?$APPLICATION->IncludeComponent("d7:contact_shops",".default",Array(
				"IBLOCK_ID" => "19", 
				"CACHE_TYPE" => "A", 
                "CACHE_TIME" => "3600", 
                "CACHE_FILTER" => "N" 
                    ), false
    );?>	

<h2 class="s28-title">ООО «КРЕП-КОМП»</h2>
<ul class="requisites">
	<li class="requisites__item"> <span class="requisites__title">Юридический адрес:</span>
	<p class="requisites__info">
		 <?=tplvar("legal_address")?>
	</p>
 </li>
	<li class="requisites__item"> <span class="requisites__title">Фактический адрес:</span>
	<p class="requisites__info">
		 <?=tplvar("address")?>
	</p>
 </li>
	<li class="requisites__item"> <span class="requisites__title">ИНН</span>
	<p class="requisites__info">
		 7726517049
	</p>
 </li>
	<li class="requisites__item"> <span class="requisites__title">КПП</span>
	<p class="requisites__info">
		 772601001
	</p>
 </li>
	<li class="requisites__item"> <span class="requisites__title">р/сч.</span>
	<p class="requisites__info">
		 40702810900000460880
	</p>
 </li>
	<li class="requisites__item"> <span class="requisites__title">к/сч.</span>
	<p class="requisites__info">
		 30101810445250000360
	</p>
 </li>
	<li class="requisites__item"> <span class="requisites__title">АКБ</span>
	<p class="requisites__info">
		 Филиал "Корпоративный" ПАО "Совкомбанк"
	</p>
 </li>
	<li class="requisites__item"> <span class="requisites__title">ОКПО</span>
	<p class="requisites__info">
		 76390392
	</p>
 </li>
	<li class="requisites__item"> <span class="requisites__title">ОГРН</span>
	<p class="requisites__info">
		 1057746185012
	</p>
 </li>
	<li class="requisites__item"> <span class="requisites__title">ОКВЭД</span>
	<p class="requisites__info">
		 51.70, 51.54
	</p>
 </li>
	<li class="requisites__item"> <span class="requisites__title">ОКАТО</span>
	<p class="requisites__info">
		 45296575000
	</p>
 </li>
	<li class="requisites__item"> <span class="requisites__title">БИК</span>
	<p class="requisites__info">
		 044525360
	</p>
 </li>
</ul><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>