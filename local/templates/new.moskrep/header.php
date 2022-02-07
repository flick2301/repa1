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

	<meta charset="<?=LANG_CHARSET?>" />
	<?
    if($context)
	{
		$request = $context->getRequest();
		$paramList = $request->getQueryList()->getValues();
		unset($paramList['reference']);
		unset($paramList['PAGEN_1']);
		unset($paramList['SIZEN_1']);
		unset($paramList['utm_source']);
		unset($paramList['utm_medium']);
		unset($paramList['utm_campaign']);
		unset($paramList['utm_content']);
		unset($paramList['utm_term']);
		unset($paramList['yclid']);
	}?>
    <!--<meta http-equiv="Content-Type" content="text/html; charset=<?=LANG_CHARSET?>" />-->
	<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
    <meta name="yandex-verification" content="94ad628889e9793a" />
    <meta name="google-site-verification" content="tCyUZcBpb8WKtkt8O1XsKiMEeBQpIFTPY-N9GDFfIv0" />
    <meta name="apple-mobile-web-app-title" content="Главная страница – Krep-Komp" />
    <meta name="theme-color" content="#0C58CF" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0" />
	<meta name="facebook-domain-verification" content="qyjoyjc6m0agulp5ix7pznx4nhhm22" />
	
<?
$path = $APPLICATION->GetCurPage();
$lastEl = array_pop(explode("/", trim($path, "/")));

if(!empty($paramList))
    $APPLICATION->SetPageProperty('robots', 'noindex, nofollow');

$APPLICATION->ShowMeta("robots");?>
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
   
<link rel="apple-touch-icon" sizes="180x180" href="<?=SITE_TEMPLATE_PATH?>/assets/favicon/apple-touch-icon.png" />
<link rel="icon" type="image/png" sizes="120x120" href="<?=SITE_TEMPLATE_PATH?>/assets/favicon/favicon-120x120.png" />
<link rel="icon" type="image/png" sizes="32x32" href="<?=SITE_TEMPLATE_PATH?>/assets/favicon/favicon-32x32.png" />
<link rel="icon" type="image/png" sizes="16x16" href="<?=SITE_TEMPLATE_PATH?>/assets/favicon/favicon-16x16.png" />
<link rel="manifest" href="<?=SITE_TEMPLATE_PATH?>/assets/favicon/site.webmanifest" />
<link rel="mask-icon" href="<?=SITE_TEMPLATE_PATH?>/assets/favicon/safari-pinned-tab.svg" color="#552fec" />
<link rel="shortcut icon" href="<?=SITE_TEMPLATE_PATH?>/assets/favicon/favicon.ico" />
<meta name="msapplication-TileColor" content="#ffffff" />
<meta name="msapplication-config" content="<?=SITE_TEMPLATE_PATH?>/assets/favicon/browserconfig.xml" />
<meta name="apple-mobile-web-app-title" content="КРЕП-КОМП" />
<meta name="theme-color" content="#ffffff" />  

<?if(strstr($_SERVER['HTTP_HOST'], "spb")):?>
<meta name="google-site-verification" content="Obf25qlplQtNOWNrsgj_jU3Xb5E7wvJ8athrd1N4bhs" />
<?endif?> 

   
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
	global $USER;
	$rand = "?".rand();
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/fonts/montserrat/montserrat.min.css", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/fonts/proto/proto.min.css", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/fonts/proximanova/proximanova.min.css", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/fonts.min.css", true);	
	
	//$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/reset.css", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/style.min.css", true);
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/jquery.fancybox.min.css", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/styles/global.styles.min.css?v=XXXXXXa", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/correction.min.css".$rand, true);	
	if (IPHONE=="Y") $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/iphone.css", true);	
	else $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/dieapple.css", true);
	
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.maskedinput.min.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.fancybox.min.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/datalayer.js");
	
	//file_exists($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/js/script.js")
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/script.min.js");

		if ($USER->IsAdmin() || $_GET["administrator"]) {
			$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/administrator.css", true);	
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/administrator.js");
		}	
		
		
	//$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/new/css/main.min.css", true);	
	//$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/new/css/style.css", true);	
	//$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/script.js");	
	?>
	
   <script src="<?=SITE_TEMPLATE_PATH?>/assets/scripts/global.scripts.min.js?v=XXXXXXa" defer="defer"></script>
   <script src="<?=SITE_TEMPLATE_PATH?>/assets/scripts/jquery.icheck-1.0.2.min.js?v=XXXXXXa" defer="defer"></script>
   <script src="<?=SITE_TEMPLATE_PATH?>/assets/scripts/jquery.izimodal-1.6.0.min.js?v=XXXXXXa" defer="defer"></script>
   <script src="<?=SITE_TEMPLATE_PATH?>/assets/scripts/jquery.slick-1.9.0.min.js?v=XXXXXXa" defer="defer"></script>
   <script src="<?=SITE_TEMPLATE_PATH?>/assets/scripts/tabby-12.0.3.min.js?v=XXXXXXa" defer="defer"></script>
   <script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.popup.js" defer="defer"></script>
   <script src="<?=SITE_TEMPLATE_PATH?>/js/common.min.js" defer="defer"></script>
   <script src="<?=SITE_TEMPLATE_PATH?>/js/slick.min.js" defer="defer"></script>
   <script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.cookie.js" defer="defer"></script>		

    
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
<script>
(function(w,d,n,c){w.CalltouchDataObject=n;w[n]=function(){w[n]["callbacks"].push(arguments)};if(!w[n]["callbacks"]){w[n]["callbacks"]=[]}w[n]["loaded"]=false;if(typeof c!=="object"){c=[c]}w[n]["counters"]=c;for(var i=0;i<c.length;i+=1){p(c[i])}function p(cId){var a=d.getElementsByTagName("script")[0],s=d.createElement("script"),i=function(){a.parentNode.insertBefore(s,a)};s.type="text/javascript";s.async=true;s.src="https://mod.calltouch.ru/init.js?id="+cId;if(w.opera=="[object Opera]"){d.addEventListener("DOMContentLoaded",i,false)}else{i()}}})(window,document,"ct","9hgftwpz");
</script>
<!-- calltouch -->



<?if($APPLICATION->GetCurPage() == "/" && false):?>
<style>@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,600&subset=cyrillic);body{margin:0;font-family:'Open Sans',sans-serif;font-weight:400;letter-spacing:0;background-color:#fff;background-image:none}.project{max-width:660px;margin:0 auto;line-height:24px}.project *{font-family:'Open Sans',sans-serif}.project h1{margin:0;padding:34px 16px 25px;font-size:30px;font-weight:600;text-align:center;text-transform:capitalize}.project h2{margin:0 16px 12px;font-size:17px;font-weight:600}.project q{font-style:normal}.project q,.project q:lang(en){quotes:'\201C''\201D''\2018''\2019'}.project q:lang(ru){quotes:'\00AB''\00BB''\201E''\201C'}.project q::after,.project q::before{font-weight:600;color:#06aaf5}.project a{padding:0 10px;line-height:36px;color:#06aaf5;white-space:nowrap;text-decoration:underline}.js-no-touch .project a:hover,.project a:active{color:#28292b;text-decoration:none}.project .list{width:100%;margin:0;font-size:17px;padding:8px 0 24px}.project .list li{display:flex;flex-direction:column;padding:5px 0 7px}.project .list li:nth-of-type(2n+1){background-color:#f5f5f6}.project .name{padding:8px 16px}.project .action{display:flex;margin-top:-8px;padding:0 6px}@media (min-width:531px){.project{padding:0 40px}.project h1{padding-right:20px;padding-left:20px}.project h2{margin-right:0;margin-left:0}.project .list li{padding-right:4px;padding-left:4px}}@media (min-width:741px){.project{padding:12px 40px}.project a{padding:0 16px;line-height:40px}.project .list li{flex-direction:row;justify-content:space-between;padding-bottom:6px}.project .action{margin-top:0}}</style>
<?endif?>


</head>


<body class="basic-layout basic-layout--default" id="basic-layout">
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
	
<div id="top_under_menu">
<div class="basic-layout__section">
<div>


<?if(!strstr($_SERVER['HTTP_HOST'], "dev") || true)
{?>
<?if(!$_GET["nogeolocation"] && false):?>
<?require_once($_SERVER["DOCUMENT_ROOT"] . "/include/geolocation.php");?>
<?else:?>
	<?$APPLICATION->IncludeComponent("d7:geolocation","",Array(
				"IBLOCK_ID" => "23", 
				"CACHE_TYPE" => "A", 
                "CACHE_TIME" => "3600", 
                "CACHE_FILTER" => "N"
                    ), false
    );?>
<?endif?>	
	<?}?>
</div>

<!--contact-widget-->
<div class="contact-widget">
	<?$APPLICATION->IncludeComponent("d7:contact_shops","header",Array(
				"IBLOCK_ID" => "19", 
				"CACHE_TYPE" => "A", 
                "CACHE_TIME" => "3600", 
                "CACHE_FILTER" => "N",
				"LIMIT" => 1,	
                    ), false
    );?>
</div>
</div>
</div>	
	
	<header class="basic-layout__header">
	<?=$safari?>
	
	<!--<div class="page-top-banner"> <div id="bannerIsWork" class="banner-textbox page"> <div class='banner-link banner-text'>	<strong style='font-weight: 500; color:#000; font-size:16px;'>Уважаемые клиенты! Наш интернет-магазин не работает в праздничные дни с 31.12.2021 по 09.01.2022. С 10.01.2022 работаем в штатном режиме.<span style='color: #f39101;'></span></strong>  <svg class="icon-svg -cross close-svg" data-selector="page-top-banner-close"> <use xlink:href="#icon-cross"></use> <svg id="icon-cross" viewBox="0 0 32 32"><path d="M19.8,16l11.5,11.4c1.1,1,1.1,2.7,0,3.8c-1,1-2.8,1-3.8,0L16,19.8L4.6,31.1c-1.1,1-2.8,1-3.8,0c-1-1-1-2.7,0-3.8L12.2,16L0.8,4.7c-1-1-1-2.7,0-3.8c1.1-1,2.8-1,3.8,0L16,12.2L27.4,0.8c1-1,2.8-1,3.8,0c1.1,1,1.1,2.7,0,3.8L19.8,16z"></path></svg></svg></div> </div> </div>-->
	<?if($_SERVER['HTTP_HOST']=="krep-komp.ru"):?>
	<div class="page-top-banner"> <div id="bannerIsWork" class="banner-textbox page"> <div class='banner-link banner-text'>	<strong style='font-weight: 500; color:#000; font-size:16px;'>В магазине на Каширке доступна доставка день в день. <a href="/addresses/" style="text-decoration: underline; color: #4F36E3;">Подробнее</a><span style='color: #f39101;'></span></strong>  <svg class="icon-svg -cross close-svg" data-selector="page-top-banner-close"> <use xlink:href="#icon-cross"></use> <svg id="icon-cross" viewBox="0 0 32 32"><path d="M19.8,16l11.5,11.4c1.1,1,1.1,2.7,0,3.8c-1,1-2.8,1-3.8,0L16,19.8L4.6,31.1c-1.1,1-2.8,1-3.8,0c-1-1-1-2.7,0-3.8L12.2,16L0.8,4.7c-1-1-1-2.7,0-3.8c1.1-1,2.8-1,3.8,0L16,12.2L27.4,0.8c1-1,2.8-1,3.8,0c1.1,1,1.1,2.7,0,3.8L19.8,16z"></path></svg></svg></div> </div> </div>
	<?endif?>
	
	
	
	
	
	
    <div class="basic-layout__section">
	<!--eshop-panel-->
        <div class="eshop-panel">
			<div class="eshop-panel__brand">
			<!--website-logo-->
			<div class="website-logo">
				<?//$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/company_logo.php"), false, []);?>
				<img class="website-logo__img" alt="Магазин крепежа и метизов «КРЕП-КОМП" title="Магазин крепежа и метизов «КРЕП-КОМП»" src="/local/templates/moskrep/assets/design/website-logo/krep-komp.svg" />
				<a class="website-logo__link" href="<?=($APPLICATION->GetCurPage() != "/") ? '/' : 'javascript::void();'?>">На главную</a>
			</div>
			<!--website-logo-->
            </div>
			
<?if (CSite::InDir('/index.php') || true):?>				
<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"catalog_main", 
	array(
		"ROOT_MENU_TYPE" => "left",
		"MAX_LEVEL" => "3",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"COMPONENT_TEMPLATE" => "catalog_main",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"VIBOR_CATALOG_TABLE" => array(
			0 => "2312",
			1 => "2838",
			2 => "2841",
			3 => "2844",
			4 => "2411",
			5 => "2403",
			6 => "",
		)
	),
	false
);?>				
<?endif?>
			
					
			<div class="eshop-panel__search <?if (CSite::InDir('/index.php') || 1):?>main<?endif?>">
                <?
                $request = Application::getInstance()->getContext()->getRequest();
                $name = $request->getCookieList();               
                ?>
				
                   

		<?/*$APPLICATION->IncludeComponent(
	"d7:search.title", 
	"catalog", 
	array(
		"CATEGORY_0" => array(
			0 => "iblock_catalog",
		),
		"CATEGORY_0_TITLE" => "",
		"CATEGORY_0_iblock_catalog" => array(
			0 => "17",
		),
		"CHECK_DATES" => "N",
		"CONTAINER_ID" => "title-search",
		"INPUT_ID" => "title-search-input",
		"NUM_CATEGORIES" => "1",
		"ORDER" => "rank",
		"PAGE" => "#SITE_DIR#search/index.php",
		"SHOW_INPUT" => "Y",
		"SHOW_OTHERS" => "N",
		"TOP_COUNT" => "10",
		"USE_LANGUAGE_GUESS" => "N",
		"PRICE_CODE" => array(
			0 => "Распродажа",
			1 => "К0 (БАЗОВАЯ НАЧАЛЬНАЯ)",
		),
		"COMPONENT_TEMPLATE" => "catalog",
		"PRICE_VAT_INCLUDE" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SHOW_PREVIEW" => "Y",
		"PREVIEW_WIDTH" => "75",
		"PREVIEW_HEIGHT" => "75",
		"CONVERT_CURRENCY" => "N",
		"CATEGORY_OTHERS_TITLE" => "",
		"CATEGORY_1_TITLE" => "",
		"CATEGORY_1" => "",
		"CATEGORY_2_TITLE" => "",
		"CATEGORY_2" => "",
		"CATEGORY_3_TITLE" => "",
		"CATEGORY_3" => "",
		"CATEGORY_4_TITLE" => "",
		"CATEGORY_4" => ""
	),
	false
);*/?>                          <?//$APPLICATION->AddHeadScript('/local/ajax/ajax_search.js');?>

    
<!--<div class='header-search__wrap' id='header-search__result'>   
<form action="/search/index.php">
    <input id="title-search-input" type="text" name="q" value=""  placeholder="Поиск по каталогу..." class="header-search__input" autocomplete="off">
                <a href="javascript:void(0);" onclick="BX(&quot;search_submit&quot;).click();" class="header-search__btn"></a>
    <input style="display:none;" id="search_submit" name="s" type="submit" value="Поиск">
</form>
</div>-->

<?$APPLICATION->IncludeComponent(
	"webcreature:dsearch.ajax", 
	"krep-komp", 
	array(
		"ARTNO" => "CML2_ARTICLE",
		"CATEGORY" => array(
			0 => "0",
		),
		"DESCRIPTION_LEN" => "300",
		"IBLOCK_ID" => "17",
		"IBLOCK_TYPE" => "catalog",
		"IN_CATEGORY" => "N",
		"SEARCH_VARIABLE" => "result",
		"SIZE" => "8",
		"STAT" => "Y",
		"STAT_LIMIT" => "10000",
		"COMPONENT_TEMPLATE" => "krep-komp"
	),
	false
);?>
		</div>
               
		<div class="eshop-panel__user">
               <!--client-widget-->
               <div class="client-widget">
					<div class="client-widget__user">
					<?
					global $USER;
					if ($USER->IsAuthorized()){ 
						?><a class="client-widget__link" href="/personal/"><i class="simple-user-icon client-widget__icon"></i>Кабинет</a><?
					}else{
						?><a href="/personal/" class="client-widget__link login__btn_new"><i class="simple-user-icon client-widget__icon"></i>Вход</a><?
					}
					?>
					</div>
					
					<?
		
		$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	".default", 
	array(
		"HIDE_ON_BASKET_PAGES" => "N",
		"PATH_TO_AUTHORIZE" => "",
		"PATH_TO_BASKET" => SITE_DIR."basket/",
		"PATH_TO_ORDER" => SITE_DIR."order/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"PATH_TO_REGISTER" => SITE_DIR."login/",
		"POSITION_FIXED" => "N",
		"SHOW_AUTHOR" => "N",
		"SHOW_EMPTY_VALUES" => "N",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_PERSONAL_LINK" => "N",
		"SHOW_PRODUCTS" => "Y",
		"SHOW_REGISTRATION" => "N",
		"SHOW_TOTAL_PRICE" => "N",
		"COMPONENT_TEMPLATE" => ".default",
		"SHOW_DELAY" => "N",
		"SHOW_NOTAVAIL" => "N",
		"SHOW_IMAGE" => "Y",
		"SHOW_PRICE" => "Y",
		"SHOW_SUMMARY" => "Y",
		"MAX_IMAGE_SIZE" => "70"
	),
	false
);?>
			
				
			</div>
		</div>
		<?/*<div class="eshop-panel__contact">
               <!--contact-widget-->
               <div class="contact-widget">
	<?$APPLICATION->IncludeComponent("d7:contact_shops","header",Array(
				"IBLOCK_ID" => "19", 
				"CACHE_TYPE" => "A", 
                "CACHE_TIME" => "3600", 
                "CACHE_FILTER" => "N",
				"LIMIT" => 1,	
                    ), false
    );?>	
				</div>
		</div>*/?>
              
		
        
	</div>
	<!--eshop-panel-->
	

<div id="filter__catalog">
<?$APPLICATION->ShowViewContent('catalogFilter');?>
</div>
		
			
</div>


	<div class="basic-layout__section">
         <!--website-navbar-->
         <div class="website-navbar">
		 
		 
<?if (!CSite::InDir('/index.php') && false):?>		 
           <div class="website-navbar__catalog">
               <!--catalog-nav-->
               			
	<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	".default", 
	array(
		"ROOT_MENU_TYPE" => "left",
		"MAX_LEVEL" => "3",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"VIBOR_CATALOG_TABLE" => array(
			0 => "2312",
			1 => "2838",
			2 => "2841",
			3 => "2844",
			4 => "2411",
			5 => "2403",
			6 => "",
		)
	),
	false
);?>	
		</div>
<?endif?>		
		
		
		<div class="website-navbar__primary">
               <!--main-nav-->
               <nav class="main-nav<?if (CSite::InDir('/index.php') && SITE_ID!='s2'):?> full<?endif?>">
                  <div class="main-nav__title" data-sreader>Навигация</div>
                  <div class="main-nav__wrap is-disabled" id="main-nav__wrap">
                     <button class="main-nav__close" id="main-nav__close"><i class="simple-close-icon"></i>Закрыть</button>
	<?$APPLICATION->IncludeComponent(
        "bitrix:menu",
        "top_menu",
        Array(
         "ROOT_MENU_TYPE" => "top", 
         "MAX_LEVEL" => "3", 
         "CHILD_MENU_TYPE" => "top", 
         "USE_EXT" => "Y" 
     )
		);?>	
					</div>
				</nav>
			</div>
	</div>
	</div>
    </header>
    
  
    <main class="basic-layout__common <?$APPLICATION->ShowViewContent('catalogFilterClass');?>">
	<?if($APPLICATION->GetCurPage() !== "/basket/" && $APPLICATION->GetCurPage() !== "/order/" && $APPLICATION->GetCurPage() !== "/import2/" && ($APPLICATION->GetCurPage() !== "/personal/" || $USER->IsAuthorized())):?>  	
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


		
       

  