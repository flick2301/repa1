<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Контакты Креп-Комп");
$APPLICATION->SetPageProperty("keywords", "контакты Креп-Комп");
$APPLICATION->SetPageProperty("description", "Контакты компании Креп-Комп");
$APPLICATION->SetTitle("Контакты");
?>

<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/scripts/global.scripts.min.js?v=XXXXXXa");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/scripts/jquery.icheck-1.0.2.min.js?v=XXXXXXa");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/scripts/jquery.izimodal-1.6.0.min.js?v=XXXXXXa");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."assets/scripts/tabby-12.0.3.min.js?v=XXXXXXa");?>

            <!--simple-article-->
            <div class="basic-layout__module simple-article">
               <!--content-tabs-->
               <div class="simple-article__tabs content-tabs">
                  <ul class="content-tabs__list" data-contact-tabs>
<?if($_SERVER['HTTP_HOST']=='spb.krep-komp.ru'):?>
                     <li class="content-tabs__item">
                        <a class="content-tabs__toggle" href="#piter" data-tabby-default>Санкт-Петербург</a>
                     </li>
                     <li class="content-tabs__item">
                        <a class="content-tabs__toggle" href="#moscow">Москва и МО</a>
                     </li>
<?else:?>				  
                     <li class="content-tabs__item">
                        <a class="content-tabs__toggle" href="#moscow" data-tabby-default>Москва и МО</a>
                     </li>
                     <li class="content-tabs__item">
                        <a class="content-tabs__toggle" href="#piter">Санкт-Петербург</a>
                     </li>
<?endif?>					 
                  </ul>
               </div>
               <!--content-tabs-->
			   
			   
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



<script>var tabs=new Tabby("[data-contact-tabs]")</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>