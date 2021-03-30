<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Page\Asset;
use Bitrix\Main\Application;

Loc::LoadMessages(__FILE__);
?>
<!-- DESKTOP -->
<!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>

	<meta charset="<?=LANG_CHARSET?>">
    <!--<meta http-equiv="Content-Type" content="text/html; charset=<?=LANG_CHARSET?>" />-->
	<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
    <meta name="yandex-verification" content="94ad628889e9793a" />
    <meta name="google-site-verification" content="tCyUZcBpb8WKtkt8O1XsKiMEeBQpIFTPY-N9GDFfIv0" />
    <meta name="apple-mobile-web-app-title" content="Главная страница – Krep-Komp" />
    <meta name="theme-color" content="#0C58CF" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0" />
	<meta name="facebook-domain-verification" content="qyjoyjc6m0agulp5ix7pznx4nhhm22" />
	
<?$APPLICATION->ShowMeta("robots")?>
<title><?$APPLICATION->ShowTitle();?></title>

<?$APPLICATION->ShowMeta("description")?>


    
	<?/*
	<link rel="manifest" href="<?=SITE_TEMPLATE_PATH?>/assets/a-icons/manifest.webmanifest" />
	<link rel="icon" sizes="32x32" href="<?=SITE_TEMPLATE_PATH?>/assets/a-icons/favicon-32.png" />
	<link rel="icon" sizes="96x96" href="<?=SITE_TEMPLATE_PATH?>/assets/a-icons/favicon-96.png" />
	<link rel="icon" sizes="16x16" href="<?=SITE_TEMPLATE_PATH?>/assets/a-icons/favicon-16.png" />
	
	<!--appicons-->
   <link rel="apple-touch-icon" href="<?=SITE_TEMPLATE_PATH?>/assets/a-icons/icon-iphone.png" sizes="60x60" />
   <link rel="apple-touch-icon" href="<?=SITE_TEMPLATE_PATH?>/assets/a-icons/icon-ipad.png" sizes="76x76" />
   <link rel="apple-touch-icon" href="<?=SITE_TEMPLATE_PATH?>/assets/a-icons/icon-iphone@2x.png" sizes="120x120" />
   <link rel="apple-touch-icon" href="<?=SITE_TEMPLATE_PATH?>/assets/a-icons/icon-ipad@2x.png" sizes="152x152" />
   */?>
   
<link rel="apple-touch-icon" sizes="180x180" href="<?=SITE_TEMPLATE_PATH?>/assets/favicon/apple-touch-icon.png">
<link el="icon" type="image/png" sizes="120x120" href="<?=SITE_TEMPLATE_PATH?>/assets/favicon/favicon-120x120.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?=SITE_TEMPLATE_PATH?>/assets/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?=SITE_TEMPLATE_PATH?>/assets/favicon/favicon-16x16.png">
<link rel="manifest" href="<?=SITE_TEMPLATE_PATH?>/assets/favicon/site.webmanifest">
<link rel="mask-icon" href="<?=SITE_TEMPLATE_PATH?>/assets/favicon/safari-pinned-tab.svg" color="#552fec">
<link rel="shortcut icon" href="<?=SITE_TEMPLATE_PATH?>/assets/favicon/favicon.ico">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-config" content="<?=SITE_TEMPLATE_PATH?>/assets/favicon/browserconfig.xml">
<meta name="apple-mobile-web-app-title" content="КРЕП-КОМП">
<meta name="theme-color" content="#ffffff">   
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width initial-scale=1">
	
	
   <?
   $user_agent = $_SERVER["HTTP_USER_AGENT"];
    if (strpos($user_agent, "Safari") !== false) {
		echo '<link href="'.SITE_TEMPLATE_PATH.'/css/safari.css" rel="stylesheet" type="text/css" />';
    }
	?>
   

	<link rel='canonical' href='https://<?=$_SERVER["SERVER_NAME"]?><?=$APPLICATION->GetCurPage(false);?>' />	

  	<!--АНТИСОВЕТНИК-->
	<script data-skip-moving='true'>
(function(d) {
var ref=d.getElementsByTagName('script')[0]; 
var js, id='3356a6aae65d7a48c0f5f36187171be6';
if (d.getElementById(id)) return;
js=d.createElement('script'); js.id=id;js.async=false;
js.src='https://antisovetnic.ru/anti/'+escape(id);
ref.parentNode.insertBefore(js, ref);}(document));
</script>
	<!--АНТИСОВЕТНИК-->  

<?if(strstr($_SERVER['HTTP_HOST'], "spb")):?>
<?
$APPLICATION->IncludeFile(
 "/include/counters_header_spb.php",
 array(),
 array("SHOW_BORDER" => true, "MODE"=>"php")
);
?>
<?else:?>
<?
$APPLICATION->IncludeFile(
 "/include/counters_header.php",
 array(),
 array("SHOW_BORDER" => true, "MODE"=>"php")
);
?>
<?endif?>       
    


<?$APPLICATION->ShowCSS()?>
<?$APPLICATION->ShowHeadStrings()?>
        <?CJSCore::Init(array('jquery3'));?>
	<?
	$rand = "?".rand();
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/fonts/montserrat/montserrat.css", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/fonts/proto/proto.css", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/fonts/proximanova/proximanova.css", true);	
	
	//$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/reset.css", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/style.css", true);
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/jquery.fancybox.min.css", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/styles/global.styles.min.css?v=XXXXXXa", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/correction.css".$rand, true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/main.min.css", true);	
	if (IPHONE=="Y") $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/iphone.css", true);	
	else $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/dieapple.css", true);
	
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.maskedinput.min.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.fancybox.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/datalayer.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/script.js");
	
		global $USER;
		if ($USER->GetID()==1 || $_GET["administrator"]) {
			$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/administrator.css", true);	
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/administrator.js");
		}	
		
		
	//$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/new/css/main.min.css", true);	
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/new/css/style.css", true);	
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/script.js");	
	?>
	
   <script src="<?=SITE_TEMPLATE_PATH?>/assets/scripts/global.scripts.min.js?v=XXXXXXa" defer="defer"></script>
   <script src="<?=SITE_TEMPLATE_PATH?>/assets/scripts/jquery.icheck-1.0.2.min.js?v=XXXXXXa" defer="defer"></script>
   <script src="<?=SITE_TEMPLATE_PATH?>/assets/scripts/jquery.izimodal-1.6.0.min.js?v=XXXXXXa" defer="defer"></script>
   <script src="<?=SITE_TEMPLATE_PATH?>/assets/scripts/jquery.slick-1.9.0.min.js?v=XXXXXXa" defer="defer"></script>
   <script src="<?=SITE_TEMPLATE_PATH?>/assets/scripts/tabby-12.0.3.min.js?v=XXXXXXa" defer="defer"></script>
   <script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.popup.js" defer="defer"></script>
   <script src="<?=SITE_TEMPLATE_PATH?>/js/common.js" defer="defer"></script>
   <script src="<?=SITE_TEMPLATE_PATH?>/js/slick.min.js" defer="defer"></script>
   <script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.cookie.js" defer="defer"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/main.js" defer="defer"></script>   

    
    <!--[if (lt IE 9)&(!IEMobile 7)]><script src="js/html5support.js"></script><![endif]-->

<script>
  (function(d) {
    var s = d.createElement('script');
    s.defer = true;
    s.src = 'https://multisearch.io/plugin/10771';
    if (d.head) d.head.appendChild(s);
  })(document);
</script>

<!-- calltouch -->
<script type="text/javascript">
(function(w,d,n,c){w.CalltouchDataObject=n;w[n]=function(){w[n]["callbacks"].push(arguments)};if(!w[n]["callbacks"]){w[n]["callbacks"]=[]}w[n]["loaded"]=false;if(typeof c!=="object"){c=[c]}w[n]["counters"]=c;for(var i=0;i<c.length;i+=1){p(c[i])}function p(cId){var a=d.getElementsByTagName("script")[0],s=d.createElement("script"),i=function(){a.parentNode.insertBefore(s,a)};s.type="text/javascript";s.async=true;s.src="https://mod.calltouch.ru/init.js?id="+cId;if(w.opera=="[object Opera]"){d.addEventListener("DOMContentLoaded",i,false)}else{i()}}})(window,document,"ct","9hgftwpz");
</script>
<!-- calltouch -->



<?if($APPLICATION->GetCurPage() == "/" && false):?>
<style>@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,600&subset=cyrillic);body{margin:0;font-family:'Open Sans',sans-serif;font-weight:400;letter-spacing:0;background-color:#fff;background-image:none}.project{max-width:660px;margin:0 auto;line-height:24px}.project *{font-family:'Open Sans',sans-serif}.project h1{margin:0;padding:34px 16px 25px;font-size:30px;font-weight:600;text-align:center;text-transform:capitalize}.project h2{margin:0 16px 12px;font-size:17px;font-weight:600}.project q{font-style:normal}.project q,.project q:lang(en){quotes:'\201C''\201D''\2018''\2019'}.project q:lang(ru){quotes:'\00AB''\00BB''\201E''\201C'}.project q::after,.project q::before{font-weight:600;color:#06aaf5}.project a{padding:0 10px;line-height:36px;color:#06aaf5;white-space:nowrap;text-decoration:underline}.js-no-touch .project a:hover,.project a:active{color:#28292b;text-decoration:none}.project .list{width:100%;margin:0;font-size:17px;padding:8px 0 24px}.project .list li{display:flex;flex-direction:column;padding:5px 0 7px}.project .list li:nth-of-type(2n+1){background-color:#f5f5f6}.project .name{padding:8px 16px}.project .action{display:flex;margin-top:-8px;padding:0 6px}@media (min-width:531px){.project{padding:0 40px}.project h1{padding-right:20px;padding-left:20px}.project h2{margin-right:0;margin-left:0}.project .list li{padding-right:4px;padding-left:4px}}@media (min-width:741px){.project{padding:12px 40px}.project a{padding:0 16px;line-height:40px}.project .list li{flex-direction:row;justify-content:space-between;padding-bottom:6px}.project .action{margin-top:0}}</style>
<?endif?>


</head>


<body>

<?$APPLICATION->ShowPanel();?>

<?if(strstr($_SERVER['HTTP_HOST'], "spb")):?>
<?
$APPLICATION->IncludeFile(
 "/include/counters_spb.php",
 array(),
 array("SHOW_BORDER" => true, "MODE"=>"php")
);
?>
<?else:?>
<?
$APPLICATION->IncludeFile(
 "/include/counters.php",
 array(),
 array("SHOW_BORDER" => true, "MODE"=>"php")
);
?>
<?endif?> 



    <?include_once $_SERVER["DOCUMENT_ROOT"] . "/include/functions.php";?>
	
	
	  <div class="mobile">
    <div class="mobile__wrapp">
      <div class="mobile__top">
        <div class="mobile__close"></div>
        <div class="mobile__cities">
          <div class="mobile__city">Москва</div>
        </div>
      </div>
      <?/*<div class="mobile__topside">
        <div class="mobile__profile"><img class="mobile__photo" src="<?=SITE_TEMPLATE_PATH?>/new_images/profile.png">
          <div class="mobile__login">
            <div class="mobile__name">Алексей Иванов</div>
            <div class="mobile__points">11 760 баллов</div>
          </div>
        </div>
        <div class="mobile__rightside">
          <div class="mobile__favorite"></div>
          <div class="mobile__status"></div>
        </div>
      </div>*/?>
      <div class="mobile__bot">

        <a class="mobile__item mobile__item--offer" href="/">Акции</a>
          <div class="mobile__item mobile__item--catalog">
            <div class="mobile__link--catalog">Каталог товаров</div>
            <div class="mobile__menu mobile__ul--main">
              <div class="mobile__back mobile__back--main">< Назад</div><a class="mobile__link" href="/">Крепеж</a><a class="mobile__link" href="/">Крепеж</a>
              <div class="mobile__link mobile__item--drop">
                <div class="mobile__link--parent">Крепеж</div>
                <div class="mobile__ul">
                  <div class="mobile__back">< Назад</div><a class="mobile__link" href="/">Крепеж</a>
                  <div class="mobile__link mobile__item--drop">
                    <div class="mobile__link--parent">Болт</div>
                    <div class="mobile__ul">
                      <div class="mobile__back">< Назад</div><a class="mobile__link" href="/">Крепеж</a>
                      <div class="mobile__link mobile__item--drop">
                        <div class="mobile__link--parent">Болт 2</div>
                        <div class="mobile__ul">
                          <div class="mobile__back">< Назад</div><a class="mobile__link" href="/">Крепеж</a><a class="mobile__link" href="/">Болт 2</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mobile__link" href="/">Сморезы</div>
                </div>
              </div>
              <div class="mobile__link mobile__item--drop">
                <div class="mobile__link--parent">Крепеж</div>
                <div class="mobile__ul">
                  <div class="mobile__back">< Назад</div><a class="mobile__link" href="/">Крепеж</a>
                </div>
              </div>
            </div>
          </div><a class="mobile__item" href="/">Прайс-лист</a><a class="mobile__item" href="/">Сертификаты</a><a class="mobile__item" href="/">Получение и оплата</a><a class="mobile__item" href="/">Контакты</a>

      </div>
    </div>
    <div class="mobile__contacts"><a class="mobile__chat" href="/">Написать в чат</a><a class="mobile__phone" href="tel:84957777775">8 (495) 777 77 75</a></div>
  </div>
  
  
  
  
  
  
  
  
    <div class="shelf">
    <div class="container">
      <div class="shelf__wrapper">
        <div class="shelf__left">
          <div class="shelf__hamburger"><span></span><span></span><span></span></div><a class="shelf__logo" href="/"><img class="shelf__img" src="<?=SITE_TEMPLATE_PATH?>/new_images/logo-mobile.svg"></a>
        </div>
        <div class="shelf__right">
          <div class="shelf__basket"><span>2</span></div>
          <div class="shelf__search"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="shelf__find">
    <form class="shelf__form">
      <div class="shelf__filter">Искать везде</div>
      <input class="shelf__input" type="text" placeholder="Найти товар">
      <input class="shelf__button" type="submit" value="Поиск">
    </form>
  </div>
  
  
  
  
  
<div class="catalog">
    <div class="catalog__bg">
      <div class="container">
        <div class="catalog__wrapper">
          <div class="catalog__leftside">
            <div class="catalog__list">
              <div class="catalog__link catalog__link--offer">Акции</div>
              <div class="catalog__link catalog__link--active">Крепеж</div>
              <div class="catalog__link">Расходные материалы</div>
              <div class="catalog__link">Ручной инструмент</div>
              <div class="catalog__link">Все для сада и огорода</div>
              <div class="catalog__link">Комплектующие для окон</div>
              <div class="catalog__link">Лестницы и стремянки</div>
              <div class="catalog__link">Средства защиты</div>
              <div class="catalog__link">Хозяйственные товары</div>
              <div class="catalog__link">Строительная химия</div>
              <div class="catalog__link">Электроинструмент</div>
              <div class="catalog__link">Стенды</div>
            </div>
          </div>
          <div class="catalog__rightside">
            <div class="catalog__item">
              <div class="catalog__title">Акции</div>
            </div>
            <div class="catalog__item catalog__item--active">
              <div class="catalog__title">Крепеж</div>
              <div class="catalog__roster"><a class="catalog__box" href="/" style="background-image:url(./images/catalog.png);">
                  <div class="catalog__name">Саморезы</div></a><a class="catalog__box" href="/" style="background-image:url(./images/catalog.png);">
                  <div class="catalog__name">Саморезы</div></a><a class="catalog__box" href="/" style="background-image:url(./images/catalog.png);">
                  <div class="catalog__name">Саморезы</div></a><a class="catalog__box" href="/" style="background-image:url(./images/catalog.png);">
                  <div class="catalog__name">Саморезы</div></a><a class="catalog__box" href="/" style="background-image:url(./images/catalog.png);">
                  <div class="catalog__name">Саморезы</div></a><a class="catalog__box" href="/" style="background-image:url(./images/catalog.png);">
                  <div class="catalog__name">Саморезы</div></a><a class="catalog__box" href="/" style="background-image:url(./images/catalog.png);">
                  <div class="catalog__name">Саморезы</div></a><a class="catalog__box" href="/" style="background-image:url(./images/catalog.png);">
                  <div class="catalog__name">Саморезы</div></a><a class="catalog__box" href="/" style="background-image:url(./images/catalog.png);">
                  <div class="catalog__name">Саморезы</div></a><a class="catalog__box" href="/" style="background-image:url(./images/catalog.png);">
                  <div class="catalog__name">Саморезы</div></a><a class="catalog__box" href="/" style="background-image:url(./images/catalog.png);">
                  <div class="catalog__name">Саморезы</div></a><a class="catalog__box" href="/" style="background-image:url(./images/catalog.png);">
                  <div class="catalog__name">Саморезы</div></a><a class="catalog__box" href="/" style="background-image:url(./images/catalog.png);">
                  <div class="catalog__name">Саморезы</div></a><a class="catalog__box" href="/" style="background-image:url(./images/catalog.png);">
                  <div class="catalog__name">Саморезы</div></a><a class="catalog__box" href="/" style="background-image:url(./images/catalog.png);">
                  <div class="catalog__name">Саморезы</div></a><a class="catalog__box" href="/" style="background-image:url(./images/catalog.png);">
                  <div class="catalog__name">Саморезы</div></a></div>
            </div>
            <div class="catalog__item">
              <div class="catalog__title">Расходные материалы</div>
            </div>
            <div class="catalog__item">
              <div class="catalog__title">Ручной инструмент</div>
            </div>
            <div class="catalog__item">
              <div class="catalog__title">Все для сада и огорода</div>
            </div>
            <div class="catalog__item">
              <div class="catalog__title">Комплектующие для окон</div>
            </div>
            <div class="catalog__item">
              <div class="catalog__title">Лестницы и стремянки</div>
            </div>
            <div class="catalog__item">
              <div class="catalog__title">Средства защиты</div>
            </div>
            <div class="catalog__item">
              <div class="catalog__title">Хозяйственные товары</div>
            </div>
            <div class="catalog__item">
              <div class="catalog__title">Строительная химия</div>
            </div>
            <div class="catalog__item">
              <div class="catalog__title">Электроинструмент</div>
            </div>
            <div class="catalog__item">
              <div class="catalog__title">Стенды</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
			
			
			
			
			
			
			
			
			
  <div class="top">
    <div class="container">
      <div class="top__wrapper">
        <div class="top__topside">
          <div class="top__left">
            <div class="top__address">Москва</div>
            <div class="top__price">Прайс-лист</div>
            <div class="top__sertificate">Сертификаты</div>
          </div>
          <div class="top__right">
            <div class="top__payment">
              <div class="top__payment__name">Получение и оплата</div>
            </div>
            <div class="top__contact">Контакты</div>
            <div class="top__chat">Написать в чат</div><a class="top__phone" href="tel:84957777775">8 (495) 777 77 75</a>
          </div>
        </div>
        <div class="top__botside"><a class="top__logo" href="/"><img class="top__img" src="<?=SITE_TEMPLATE_PATH?>/new_images/logo.svg"></a>
          <div class="top__catalog">
            <div class="top__catalog__icon">
              <div class="top__catalog__box"><span></span><span></span><span></span></div>
            </div>
            <div class="top__catalog__name">Каталог</div>
          </div>
          <div class="top__form">
            <div class="top__filter">Искать везде</div>
            <input class="top__input" type="text" placeholder="Найти товар">
            <input class="top__button" type="image" src="<?=SITE_TEMPLATE_PATH?>/new_images/search.svg">
          </div>
          <div class="top__rightside">
            <div class="top__nav top__basket">Корзина<span>2</span></div>
            <!--<div class="top__nav top__favorite">Избранное</div>
            <div class="top__nav top__status">Статус заказа</div>-->
            <div class="top__nav top__login">Войти</div>
          </div>
        </div>
      </div>
    </div>
  </div>			
  
  
  

    









<div class="page">
  
    <main class="basic-layout__common <?$APPLICATION->ShowViewContent('catalogFilterClass');?>">
	<?if($APPLICATION->GetCurPage() !== "/basket/" && $APPLICATION->GetCurPage() !== "/order/" && $APPLICATION->GetCurPage() !== "/import2/"):?>  	
	<?if($APPLICATION->GetCurPage() !== "/")
	{
		?>
		<div class="basic-layout__columns basic-layout__columns--reverse basic-layout__columns--special">
			<div class="basic-layout__content">
            <!--crumbs-nav-->
			<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array());?> 
			<!--crumbs-nav-->
			</div>
			<div class="basic-layout__sidebar basic-layout__sidebar--special">
            <!--back-to-page-->
            <div class="back-to-page">
               <a class="back-to-page__link" href="/"><i class="simple-back-icon back-to-page__icon"></i>Главная страница</a>
            </div>
            <!--back-to-page-->
         </div>
            
		</div>
	<?
	}
	?>
<?if(ERROR_404 != "Y")
{
	?>
<!--Разделы каталога-->
		  <?$APPLICATION->ShowViewContent('catalog_section');?>
<!--Разделы каталога-->	
<?}?>	  

      <div class="basic-layout__columns basic-layout__columns--reverse">
         <div class="basic-layout__content<?if (CSite::InDir('/index.php') && SITE_ID!='s2'):?> full<?endif?>">
		 
           
                
            <?=$APPLICATION->ShowViewContent("related_menu_element");?>
            <?if($APPLICATION->GetCurPage() == "/catalog/"):
                $APPLICATION->SetPageProperty("title", "Интернет-магазин \"КРЕП-КОМП\"");
            endif;?>
			
			
			
            <?if(0):?>            
            <div class="aside-contacts">
	        <div class="aside-contacts__adres-wrap">
		    <h3 class="s22-title">Контактная информация</h3>
		    <span class="aside-contacts__title">Адрес магазина:</span>
		    <p class="aside-contacts__adres"><?=STORE_ID_KASHIRKA[1]?></p>
		    <span class="aside-contacts__title">Адрес склада:</span>
		    <p class="aside-contacts__adres"><?=STORE_ID_KOLEDINO[1]?></p>
		</div>
		<div class="aside-contacts__phone-wrap">
		    <span class="aside-contacts__phone"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/telephone.php"), false);?></span>
		    <a href="<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/telephone.php"), false);?>" class="aside-contacts__mail"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/email.php"), false);?></a>
		    <span class="aside-contacts__schedule"><?=STORE_ID_KASHIRKA[2]?></span>
		    <a href="javascript:void(0)" class="blue-btn aside-contacts__btn">Отправить запрос</a>
		</div>
	    </div>
            <?endif;?>
        
        
<?else:?>
        
            
        
       
<?endif;?>
        
		
		
       
