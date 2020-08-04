<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Доставка");

$scheme = $request->isHttps() ? 'https' : 'http';

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

<?$APPLICATION->SetAdditionalCSS($APPLICATION->GetCurPage()."style.css", true);?>
<?/*<script src="<?=$scheme?>://api-maps.yandex.ru/2.1.50/?load=package.full&lang=<?=$locale?>"></script>*/?>
<?$api_key = htmlspecialcharsbx(Bitrix\Main\Config\Option::get('fileman', 'yandex_map_api_key'));?>
<?$APPLICATION->AddHeadScript("{$scheme}://api-maps.yandex.ru/2.1.50/?load=package.full&lang={$locale}&apikey={$api_key}" );?>
<?$APPLICATION->AddHeadScript($APPLICATION->GetCurPage()."map.js?".rand());?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/scripts/global.scripts.min.js?v=XXXXXXa");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/scripts/jquery.icheck-1.0.2.min.js?v=XXXXXXa");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/assets/scripts/jquery.izimodal-1.6.0.min.js?v=XXXXXXa");?>



            <!--page-heading-->
            <header class="basic-layout__module page-heading">
               <h1 class="page-heading__title"><?$APPLICATION->ShowTitle()?></h1>
            </header>
            <!--page-heading-->



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
 $APPLICATION->GetCurPage()."tab1.php",
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
 $APPLICATION->GetCurPage()."tab2.php",
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
 $APPLICATION->GetCurPage()."tab3.php",
 array(),
 array("SHOW_BORDER" => true, "MODE"=>"php")
);
?>
                  </div>
               </div>
			   
            </div>
            <!--simple-article-->
			
			


<script>var tabs=new Tabby("[data-delivery-tabs]")</script>
   
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>