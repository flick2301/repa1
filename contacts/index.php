<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Контакты Креп-Комп");
$APPLICATION->SetPageProperty("keywords", "контакты Креп-Комп");
$APPLICATION->SetPageProperty("description", "Контакты компании Креп-Комп");
$APPLICATION->SetTitle("Контакты");
?>


<?if(SITE_TEMPLATE_ID=='moskrep'){?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/scripts/global.scripts.min.js?v=XXXXXXa");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/scripts/jquery.icheck-1.0.2.min.js?v=XXXXXXa");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/scripts/jquery.izimodal-1.6.0.min.js?v=XXXXXXa");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."assets/scripts/tabby-12.0.3.min.js?v=XXXXXXa");?>

<?globalGetTitle()?>

            <!--simple-article-->
            <div class="basic-layout__module simple-article">
			   
			   
			   
<?if($_SERVER['HTTP_HOST']=='spb.krep-komp.ru'):?>	
		   
			    <div class="simple-article__content" id="piter">				 							 
                  <!--contact-block-->
 	<?$APPLICATION->IncludeComponent("d7:contact_shops", ".default",Array(
				"IBLOCK_ID" => "19", 
				"SECTION_ID" => SHOPS_SPB,
				"CACHE_TYPE" => "A", 
                "CACHE_TIME" => "3600", 
                "CACHE_FILTER" => "N" 
                    ), false
    );?>	
                  <!--contact-block-->
               </div>
			   
<?elseif($_SERVER['HTTP_HOST']=='nizhniy-novgorod.krep-komp.ru'):?>	

			                 <div class="simple-article__content" id="nijniy">				 							 
                  <!--contact-block-->
 	<?$APPLICATION->IncludeComponent("d7:contact_shops", ".default",Array(
				"IBLOCK_ID" => "19", 
				"SECTION_ID" => SHOPS_NN,
				"CACHE_TYPE" => "A", 
                "CACHE_TIME" => "3600", 
                "CACHE_FILTER" => "N" 
                    ), false
    );?>	
                  <!--contact-block-->
               </div>			   
			   
<?elseif($_SERVER['HTTP_HOST']=='kazan.krep-komp.ru'):?>	

<div class="simple-article__content" id="kazan">				 							 
                  <!--contact-block-->
 	<?$APPLICATION->IncludeComponent("d7:contact_shops", ".default",Array(
				"IBLOCK_ID" => "19", 
				"SECTION_ID" => SHOPS_KAZ,
				"CACHE_TYPE" => "A", 
                "CACHE_TIME" => "3600", 
                "CACHE_FILTER" => "N" 
                    ), false
    );?>	
                  <!--contact-block-->
               </div>		

<?elseif($_SERVER['HTTP_HOST']=='voronezh.krep-komp.ru'):?>	

<div class="simple-article__content" id="voronezh">				 							 
                  <!--contact-block-->
 	<?$APPLICATION->IncludeComponent("d7:contact_shops", ".default",Array(
				"IBLOCK_ID" => "19", 
				"SECTION_ID" => SHOPS_VOR,
				"CACHE_TYPE" => "A", 
                "CACHE_TIME" => "3600", 
                "CACHE_FILTER" => "N" 
                    ), false
    );?>	
                  <!--contact-block-->
               </div>				   
			   
<?else:?>				   
			   
               <div class="simple-article__content" id="moscow">
                  <!--<div class="simple-article__section">
                     <p>Забрать груз в пункте самовывоза на Каширском шоссе можно на следующий день. Для этого оформить заказ нужно до 15:00. Суббота и Воскресенье – выходные дни.</p>
                  </div>-->
				  <!--contact-block-->
	<?$APPLICATION->IncludeComponent("d7:contact_shops",".default",Array(
				"IBLOCK_ID" => "19", 
				"CACHE_TYPE" => "A", 
                "CACHE_TIME" => "3600", 
                "CACHE_FILTER" => "N" 
                    ), false
    );?>	
				  <!--contact-block-->
              </div>
			  
<?endif?>	
	

 

	

	

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

<?$APPLICATION->IncludeComponent(
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
</ul>

<?}?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>