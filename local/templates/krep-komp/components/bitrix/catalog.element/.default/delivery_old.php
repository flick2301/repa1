<?
$scheme = CMain::isHttps() ? 'https' : 'http';

switch (LANGUAGE_ID)
{
	case 'ru':
		$locale = 'ru-RU'; break;
	case 'ua':
		$locale = 'ru-UA'; break;
	case 'tk':
		$locale = 'tr-TR'; break;
	default:
		$locale = 'en-US'; break;
}
?>

<?$APPLICATION->SetAdditionalCSS("/delivery/style.css", true);?>
<?/*<script src="<?=$scheme?>://api-maps.yandex.ru/2.1.50/?load=package.full&lang=<?=$locale?>"></script>*/?>
<?$api_key = htmlspecialcharsbx(Bitrix\Main\Config\Option::get('fileman', 'yandex_map_api_key'));?>
<?$APPLICATION->AddHeadScript("{$scheme}://api-maps.yandex.ru/2.1.50/?load=package.full&lang={$locale}&apikey={$api_key}" );?>
<?$APPLICATION->AddHeadScript("/delivery/map.js?".rand());?>


            <div class="basic-layout__module simple-article" id="delivery">
                  <!--simple-article-->
                  <div class="basic-layout__module simple-article">
                     <!--content-tabs-->
               <div class="simple-article__tabs content-tabs">
                  <ul class="content-tabs__list" data-delivery-tabs>
<?if($_SERVER['HTTP_HOST']=='spb.krep-komp.ru'):?>					  
                     <li class="content-tabs__item">
                        <a class="content-tabs__toggle" href="#piter" data-tabby-default>Санкт-Петербург и ЛО</a>
                     </li>
<?elseif($_SERVER['HTTP_HOST']=='nizhniy-novgorod.krep-komp.ru'):?>					 
                   <li class="content-tabs__item">
                        <a class="content-tabs__toggle" href="#nn" data-tabby-default>Нижний Новгород и НО</a>
                     </li>	
<?elseif($_SERVER['HTTP_HOST']=='voronezh.krep-komp.ru'):?>						 
                   <li class="content-tabs__item">
                        <a class="content-tabs__toggle" href="#voron" data-tabby-default>Воронеж и ВО</a>
                     </li>		
<?elseif($_SERVER['HTTP_HOST']=='kazan.krep-komp.ru'):?>						 
                   <li class="content-tabs__item">
                        <a class="content-tabs__toggle" href="#kazan" data-tabby-default>Казань и республика Татарстан</a>
                     </li>	
<?else:?>					 
                     <li class="content-tabs__item">
                        <a class="content-tabs__toggle" href="#moscow" data-tabby-default>Москва и МО</a>
                     </li>	
<?endif?>					 
                     <li class="content-tabs__item">
                        <a class="content-tabs__toggle" href="#russia">Доставка по России</a>
                     </li>
                  </ul>
               </div>
                     <!--content-tabs-->
					 
					 

					 
					 
<?if($_SERVER['HTTP_HOST']=='spb.krep-komp.ru'):?>	
					 
               <div class="simple-article__content" id="piter">
                  <div class="simple-article__section wysiwyg-block">
<?
$APPLICATION->IncludeFile(
 "/delivery/tab2.php",
 array("MAP"=>"Y"),
 array("SHOW_BORDER" => true, "MODE"=>"php")
);
?>
                        </div>
                     </div>
					 
<?elseif($_SERVER['HTTP_HOST']=='nizhniy-novgorod.krep-komp.ru'):?>						 
					 
               <div class="simple-article__content" id="nn">
                  <div class="simple-article__section wysiwyg-block">
<?
$APPLICATION->IncludeFile(
 "/delivery/tab4.php",
 array("MAP"=>"N"),
 array("SHOW_BORDER" => true, "MODE"=>"php")
);
?>
                  </div>
               </div>	
			   
<?elseif($_SERVER['HTTP_HOST']=='voronezh.krep-komp.ru'):?>					   

               <div class="simple-article__content" id="voron">
                  <div class="simple-article__section wysiwyg-block">
<?
$APPLICATION->IncludeFile(
 "/delivery/tab5.php",
 array("MAP"=>"N"),
 array("SHOW_BORDER" => true, "MODE"=>"php")
);
?>
                  </div>
               </div>	
			   
<?elseif($_SERVER['HTTP_HOST']=='kazan.krep-komp.ru'):?>					   

               <div class="simple-article__content" id="kazan">
                  <div class="simple-article__section wysiwyg-block">
<?
$APPLICATION->IncludeFile(
 "/delivery/tab6.php",
 array("MAP"=>"N"),
 array("SHOW_BORDER" => true, "MODE"=>"php")
);
?>
                  </div>
               </div>	
			   
<?else:?>			   

                     <div class="simple-article__content" id="moscow">
                        <div class="simple-article__section wysiwyg-block">
<?
$APPLICATION->IncludeFile(
 "/delivery/tab1.php",
 array("MAP"=>"Y"),
 array("SHOW_BORDER" => true, "MODE"=>"php")
);
?>
                        </div>
                     </div>	

<?endif?>							 
					 
                     <div class="simple-article__content" id="russia">
                        <div class="simple-article__section wysiwyg-block">
<?
$APPLICATION->IncludeFile(
 "/delivery/tab3.php",
 array("MAP"=>"Y"),
 array("SHOW_BORDER" => true, "MODE"=>"php")
);
?>
                        </div>
                     </div>
					 
					 

                  <!--simple-article-->
               </div>