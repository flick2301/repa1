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
                           <li class="content-tabs__item">
                              <a class="content-tabs__toggle" href="#moscow" data-tabby-default>Москва и МО</a>
                           </li>
                           <li class="content-tabs__item">
                              <a class="content-tabs__toggle" href="#piter">Санкт-Петербург и ЛО</a>
                           </li>
                           <li class="content-tabs__item">
                              <a class="content-tabs__toggle" href="#russia">Доставка по России</a>
                           </li>
                        </ul>
                     </div>
                     <!--content-tabs-->
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