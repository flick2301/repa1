<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Контакты КРЕП-КОМП");
$APPLICATION->SetPageProperty("keywords", "контакты Креп-Комп");
$APPLICATION->SetPageProperty("description", "Контакты компании Креп-Комп");
$APPLICATION->SetTitle("Контакты");
?>
<link rel="stylesheet" href="style.css">


<?globalGetTitle()?>

            <!--simple-article-->
            <div class="basic-layout__module simple-article">
			   
			   
				<div class="shops__list">
				
				<?if($_SERVER['HTTP_HOST']=='spb.krep-komp.ru')
				{?>
					<div class="shops__box">
						<div class="shops__topic">ОТДЕЛ   ПРОДАЖ</div>
						<div class="shops__address">Сделать заказ или уточнить наличие:</div>
						<div class="shops__address">Телефон: <a href='tel:+7 (812) 309-95-45'>+7 (812) 309-95-45</a></div>
						<div class="shops__time">Пн-Пт.  с  9:00 – 18:00</div> Почта: <a class="shops__email" href="mailto:spb@krep-komp.ru">spb@krep-komp.ru</a>
					</div>
				<?}elseif($_SERVER['HTTP_HOST']=='novosibirsk.krep-komp.ru')
				{?>
					<div class="shops__box">
						<div class="shops__topic">ОТДЕЛ   ПРОДАЖ</div>
						<div class="shops__address">Сделать заказ или уточнить наличие:</div>
						<div class="shops__address">Телефон: <a href='tel:+7 (383) 280-48-35'>+7 (383) 280-48-35</a></div>
						<div class="shops__time">Пн-Пт.  с  9:00 – 18:00</div> Почта: <a class="shops__email" href="mailto:novosibirsk@krep-komp.ru">novosibirsk@krep-komp.ru</a>
					</div><?}else{?>
					<div class="shops__box">
						<div class="shops__topic">ОТДЕЛ   ПРОДАЖ</div>
						<div class="shops__address">Сделать заказ или уточнить наличие:</div>
						<div class="shops__address">Телефон: <a href='tel:+7 (499) 350-55-55'>+7 (499) 350-55-55</a></div>
						<div class="shops__time">Пн-Пт.  с  9:00 – 18:00  по  Мск. Времени.</div> Почта: <a class="shops__email" href="mailto:sale@krep-komp.ru">sale@krep-komp.ru</a>
					</div>
				<?}?>
				
				<?if($_SERVER['HTTP_HOST']=='spb.krep-komp.ru')
				{?>				
					<div class="shops__box">
						<div class="shops__topic">ОТДЕЛ СНАБЖЕНИЯ  (ЗАКУПКИ)</div>
						
						<div class="shops__address">Телефон: <a href='tel:+7 (812) 309-95-45'>+7 (812) 309-95-45</a>  (доб. 107,  101,  133)						
						</div>
						<div class="shops__time">Пн-Пт.  с  9:00 – 18:00</div> Почта: <a class="shops__email" href="mailto:snab@krep-komp.ru">snab@krep-komp.ru</a>
					</div>
				<?}else{?>
					
					<div class="shops__box">
						<div class="shops__topic">ОТДЕЛ СНАБЖЕНИЯ  (ЗАКУПКИ)</div>
						
						<div class="shops__address">Телефон: <a href='tel:+7 (499) 350-55-55'>+7 (499) 350-55-55</a>   (доб. 107,  101,  133)<br>
							<a href='tel:+7 (499)  350-47-84'>+7 (499)  350-47-84</a>
						</div>
						<div class="shops__time">Пн-Пт.  с  9:00 – 18:00  по  Мск. Времени.</div> Почта: <a class="shops__email" href="mailto:snab@krep-komp.ru">snab@krep-komp.ru</a>
					</div>
				<?}?>
				
				
				<?if($_SERVER['HTTP_HOST']=='spb.krep-komp.ru')
				{?>	
					<div class="shops__box">
						<div class="shops__topic">БУХГАЛТЕРИЯ</div>
						<div class="shops__address">Для актов-сверок:</div>
						Телефон: <a href='tel:+7 (812) 309-95-45'>+7 (812) 309-95-45</a>  (доб. 153)<br>
						Почта: <a class="shops__email" href="mailto:buh3@krep-komp.ru">buh3@krep-komp.ru</a>
					</div>
				<?}elseif($_SERVER['HTTP_HOST']=='pskov.krep-komp.ru')
				{?>	
					<div class="shops__box">
						<div class="shops__topic">БУХГАЛТЕРИЯ</div>
						<div class="shops__address">Для актов-сверок:</div>
						Телефон: <a href='tel:+7 (812) 309-95-45'>+7 (812) 309-95-45</a>  (доб. 153)<br>
						Почта: <a class="shops__email" href="mailto:buh3@krep-komp.ru">buh3@krep-komp.ru</a>
					</div>
				<?}else{?>	
					
					<div class="shops__box">
						<div class="shops__topic">БУХГАЛТЕРИЯ</div>
						<div class="shops__address">Для актов-сверок:</div>
						Почта: <a class="shops__email" href="mailto:docs@krep-komp.ru">docs@krep-komp.ru</a>
					</div>
				<?}?>

				<?if($_SERVER['HTTP_HOST']=='spb.krep-komp.ru')
				{?>
					<div class="shops__box">
						<div class="shops__topic">ОТДЕЛ ТРАНСПОРТНОЙ ЛОГИСТИКИ</div>
						<div class="shops__address">Телефон: <a href='tel:+7 (812) 309-95-45'>+7 (812) 309-95-45</a>  (доб. 139)
							
						</div>
						
					</div>
				<?}else{?>	
					<div class="shops__box">
						<div class="shops__topic">ОТДЕЛ ТРАНСПОРТНОЙ ЛОГИСТИКИ</div>
						<div class="shops__address">Телефон: <a href='tel:+7 (499) 350-55-55'>+7 (499) 350-55-55</a>  (доб. 123)<br>
							<a href='tel:+7 (499) 350-46-31'>+7 (499) 350-46-31</a>
						</div>
						Почта: <a class="shops__email" href="mailto:logist@krep-komp.ru">logist@krep-komp.ru</a>
					</div>
				<?}?>

				
					<div class="shops__box">
						<div class="shops__topic">ПО ОБЩИМ ВОПРОСАМ</div>
						Почта: <a class="shops__email" href="mailto:info@krep-komp.ru">info@krep-komp.ru</a>
					</div>
					
					<div class="shops__box">
						<div class="shops__topic">ГЕНЕРАЛЬНЫЙ ДИРЕКТОР</div>
						Почта: <a class="shops__email" href="mailto:krepkomp@hotmail.com">krepkomp@hotmail.com</a>
					</div>
				</div>
			   
			   
			   
               	

               <div class="simple-article__content">
                  <article class="simple-article__section wysiwyg-block">
                     <h2>ООО «КРЕП-КОМП»</h2>
                     <!--bank-details-->
                     <div class="bank-details">
                        <ul class="bank-details__list">
                           <li class="bank-details__item">
                              <p class="bank-details__name">Юридический адрес:</p>
							  <p class="bank-details__data">117519, г. Москва, вн. тер. г. муниципальный округ Чертаново Южное, ш. Варшавское, д. 148,  этаж 3, помещ. 310</p>
                              <!--<p class="bank-details__data">117519, г. Москва, Варшавское шоссе, 148,  этаж 3, офис 310</p>-->
                           </li>
                           <li class="bank-details__item">
                              <p class="bank-details__name">Фактический адрес:</p>
                              <p class="bank-details__data">117519, г. Москва, Варшавское шоссе, 148</p>
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





<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>