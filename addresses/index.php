<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Адреса магазинов");
?>

<?if(SITE_TEMPLATE_ID=='moskrep'){?>


		
			
			
			
            <!--simple-article-->
            <div class="basic-layout__module simple-article">		
			
			

<?if(!$_REQUEST["ID"]):?>

            <!--page-heading-->
            <header class="basic-layout__module page-heading">
               <h1 class="page-heading__title"><?$APPLICATION->ShowTitle()?></h1>
            </header>
            <!--page-heading-->

<ul class='delivery_items'>
	<li data-tab='vivoz_1' class='delivery_item active'>Москва и МО</li>
	<li data-tab='vivoz_2' class='delivery_item city2565 city2631 spb'>Санкт-Петербург</li>
</ul>
<?endif?>

<div id='vivoz_2' class='delivery__tabs-list city2565 city2631 spb'> 

<?//require_once($_SERVER["DOCUMENT_ROOT"] . "/kontent-elementa/contact_spb.php");?>

	<?$APPLICATION->IncludeComponent("d7:contact_shops","krep-komp",Array(
				"IBLOCK_ID" => "19", 
				"SECTION_ID" => SHOPS_SPB,
				"CACHE_TYPE" => "A", 
                "CACHE_TIME" => "3600", 
                "CACHE_FILTER" => "N" 
                    ), false
    );?>	

</div>


<div id='vivoz_1' class='delivery__tabs-list active'> 
<?if(!$_REQUEST["ID"]):?><p>Забрать груз в пункте самовывоза на Каширском шоссе можно на следующий день. Для этого оформить заказ нужно до 15:00. 

	Суббота и Воскресенье - выходные дни.</p>
<?endif?>

	<?$APPLICATION->IncludeComponent("d7:contact_shops","krep-komp",Array(
				"IBLOCK_ID" => "19", 
				"CACHE_TYPE" => "A", 
                "CACHE_TIME" => "3600", 
                "CACHE_FILTER" => "N" 
                    ), false
    );?>	
			
</div>

               <div class="simple-article__content">
                  <article class="simple-article__section wysiwyg-block">
                     <h2>ООО «КРЕП-КОМП»</h2>
                     <!--bank-details-->
                     <div class="bank-details">
                        <ul class="bank-details__list">
                           <li class="bank-details__item">
                              <p class="bank-details__name">Юридический адрес:</p>
                              <p class="bank-details__data">117519, г. Москва, Варшавское шоссе, 148, этаж 5, офис 501</p>
                           </li>
                           <li class="bank-details__item">
                              <p class="bank-details__name">Фактический адрес:</p>
                              <p class="bank-details__data">117519, г. Москва, Варшавское шоссе, 148, этаж 5, офис 501</p>
                           </li>
                           <li class="bank-details__item">
                              <p class="bank-details__name">ИНН</p>
                              <p class="bank-details__data">7726517049</p>
                           </li>
                           <li class="bank-details__item">
                              <p class="bank-details__name">КПП</p>
                              <p class="bank-details__data">772601001</p>
                           </li>
                           <li class="bank-details__item">
                              <p class="bank-details__name">р/сч.</p>
                              <p class="bank-details__data">40702810900000460880</p>
                           </li>
                           <li class="bank-details__item">
                              <p class="bank-details__name">к/сч.</p>
                              <p class="bank-details__data">30101810445250000360</p>
                           </li>
                           <li class="bank-details__item">
                              <p class="bank-details__name">АКБ</p>
                              <p class="bank-details__data">Филиал &quot;Корпоративный&quot; ПАО &quot;Совкомбанк&quot;</p>
                           </li>
                           <li class="bank-details__item">
                              <p class="bank-details__name">ОКПО</p>
                              <p class="bank-details__data">76390392</p>
                           </li>
                           <li class="bank-details__item">
                              <p class="bank-details__name">ОГРН</p>
                              <p class="bank-details__data">1057746185012</p>
                           </li>
                           <li class="bank-details__item">
                              <p class="bank-details__name">ОКВЭД</p>
                              <p class="bank-details__data">51.70, 51.54</p>
                           </li>
                           <li class="bank-details__item">
                              <p class="bank-details__name">ОКАТО</p>
                              <p class="bank-details__data">45296575000</p>
                           </li>
                           <li class="bank-details__item">
                              <p class="bank-details__name">БИК</p>
                              <p class="bank-details__data">044525360</p>
                           </li>
                        </ul>
                     </div>
                     <!--bank-details-->
                  </article>
               </div>
			   
</div>
<!--simple-article-->			   









<?}else{?>
<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array()); ?>
			<?if(!$_REQUEST["ID"]):?><h1 class="s38-title"><?=$APPLICATION->ShowTitle();?></h1><?endif?>

<?if(!$_REQUEST["ID"]):?>
<ul class='delivery_items'>
	<li data-tab='vivoz_1' class='delivery_item active'>Москва и МО</li>
	<li data-tab='vivoz_2' class='delivery_item city2565 city2631 spb'>Санкт-Петербург</li>
</ul>
<?endif?>

<div id='vivoz_2' class='delivery__tabs-list city2565 city2631 spb'> 
<?require_once($_SERVER["DOCUMENT_ROOT"] . "/kontent-elementa/contact_spb.php");?>
</div>


<div id='vivoz_1' class='delivery__tabs-list active'> 
<?if(!$_REQUEST["ID"]):?><p>Забрать груз в пункте самовывоза на Каширском шоссе можно на следующий день. Для этого оформить заказ нужно до 15:00. 

	Суббота и Воскресенье - выходные дни.</p>
<?endif?>

	<?$APPLICATION->IncludeComponent("d7:contact_shops","krep-komp",Array(
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
					<p class="requisites__info"><?=tplvar("legal_address")?></p>
				</li>
				<li class="requisites__item">
					<span class="requisites__title">Фактический адрес:</span>
					<p class="requisites__info"><?=tplvar("address")?></p>
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
<?}?>                            
                        
                            <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>