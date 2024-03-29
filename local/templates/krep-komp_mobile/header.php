<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Page\Asset;
use Bitrix\Main\Application;

Loc::LoadMessages(__FILE__);

global $APPLICATION;
global $phone_global;
global $email_global;
?>
<!-- DESKTOP -->
<!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>

	<meta charset="<?=LANG_CHARSET?>">
    <!--<meta http-equiv="Content-Type" content="text/html; charset=<?=LANG_CHARSET?>" />-->
	<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
    <meta name="yandex-verification" content="94ad628889e9793a" />
    
    <meta name="apple-mobile-web-app-title" content="Главная страница – Krep-Komp" />
    <meta name="theme-color" content="#0C58CF" />
	<meta name="facebook-domain-verification" content="qyjoyjc6m0agulp5ix7pznx4nhhm22" />

	


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
<?
$path = $APPLICATION->GetCurPage();
$lastEl = array_pop(explode("/", trim($path, "/")));

if(!empty($paramList))
    $APPLICATION->SetPageProperty('robots', 'noindex, nofollow');

$APPLICATION->ShowMeta("robots");?>
<title><?$APPLICATION->ShowTitle();?></title>

<?$APPLICATION->ShowMeta("description")?>


    

   
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

   
   <?
   $user_agent = $_SERVER["HTTP_USER_AGENT"];
    if (strpos($user_agent, "Safari") !== false) {
		echo '<link href="'.SITE_TEMPLATE_PATH.'/css/safari.css" rel="stylesheet" type="text/css" />';
    }
	?>
   

	<link rel='canonical' href='https://<?=$_SERVER["SERVER_NAME"]?><?=$APPLICATION->GetCurPage(false);?>' />	

 <?php if (stripos(@$_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false): ?>

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
    
<?endif;?>

<?$APPLICATION->ShowCSS()?>
<?$APPLICATION->ShowHeadStrings()?>
        <?CJSCore::Init(array('jquery3'));?>
	<?
	$rand = "?".rand();
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/fonts/montserrat/montserrat.min.css", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/fonts/proto/proto.min.css", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/fonts/proximanova/proximanova.min.css", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/fonts.min.css", true);	
	
	
	
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/style.min.css", true);
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/jquery.fancybox.min.css", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/styles/global.styles.min.css?v=XXXXXXa", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/correction.min.css".$rand, true);	
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/main.min.css", true);
	if (IPHONE=="Y") $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/iphone.css", true);	
	else $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/dieapple.css", true);
	
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.maskedinput.min.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.fancybox.min.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/datalayer.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/script.min.js");
	
	
		global $USER;
		if ($USER->IsAdmin() || $_GET["administrator"]) {
			$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/administrator.css", true);	
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/administrator.js");
		}	
		
		$rand = "?".rand();
		
		
	
	?>
	<?php if (stripos(@$_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false): ?>
   <script src="<?=SITE_TEMPLATE_PATH?>/assets/scripts/global.scripts.min.js?v=XXXXXXa" defer="defer"></script>
   <script src="<?=SITE_TEMPLATE_PATH?>/assets/scripts/jquery.icheck-1.0.2.min.js?v=XXXXXXa" defer="defer"></script>
   <script src="<?=SITE_TEMPLATE_PATH?>/assets/scripts/jquery.izimodal-1.6.0.min.js?v=XXXXXXa" defer="defer"></script>
   <script src="<?=SITE_TEMPLATE_PATH?>/assets/scripts/jquery.slick-1.9.0.min.js?v=XXXXXXa" defer="defer"></script>
   <script src="<?=SITE_TEMPLATE_PATH?>/assets/scripts/tabby-12.0.3.min.js?v=XXXXXXa" defer="defer"></script>
   <script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.popup.js" defer="defer"></script>
   <script src="<?=SITE_TEMPLATE_PATH?>/js/common.min.js" defer="defer"></script>
   <script src="<?=SITE_TEMPLATE_PATH?>/js/slick.min.js" defer="defer"></script>
   <script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.cookie.js" defer="defer"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/main.js<?=$rand?>" defer="defer"></script>  
	<script src="<?=SITE_TEMPLATE_PATH?>/js/owl.carousel.min.js"></script>
	

    
    <!--[if (lt IE 9)&(!IEMobile 7)]><script src="js/html5support.js"></script><![endif]-->



<!-- calltouch -->
<script type="text/javascript">
(function(w,d,n,c){w.CalltouchDataObject=n;w[n]=function(){w[n]["callbacks"].push(arguments)};if(!w[n]["callbacks"]){w[n]["callbacks"]=[]}w[n]["loaded"]=false;if(typeof c!=="object"){c=[c]}w[n]["counters"]=c;for(var i=0;i<c.length;i+=1){p(c[i])}function p(cId){var a=d.getElementsByTagName("script")[0],s=d.createElement("script"),i=function(){a.parentNode.insertBefore(s,a)};s.type="text/javascript";s.async=true;s.src="https://mod.calltouch.ru/init.js?id="+cId;if(w.opera=="[object Opera]"){d.addEventListener("DOMContentLoaded",i,false)}else{i()}}})(window,document,"ct","9hgftwpz");
</script>
<!-- calltouch -->



<?if($APPLICATION->GetCurPage() == "/" && false):?>
<style>@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,600&subset=cyrillic);body{margin:0;font-family:'Open Sans',sans-serif;font-weight:400;letter-spacing:0;background-color:#fff;background-image:none}.project{max-width:660px;margin:0 auto;line-height:24px}.project *{font-family:'Open Sans',sans-serif}.project h1{margin:0;padding:34px 16px 25px;font-size:30px;font-weight:600;text-align:center;text-transform:capitalize}.project h2{margin:0 16px 12px;font-size:17px;font-weight:600}.project q{font-style:normal}.project q,.project q:lang(en){quotes:'\201C''\201D''\2018''\2019'}.project q:lang(ru){quotes:'\00AB''\00BB''\201E''\201C'}.project q::after,.project q::before{font-weight:600;color:#06aaf5}.project a{padding:0 10px;line-height:36px;color:#06aaf5;white-space:nowrap;text-decoration:underline}.js-no-touch .project a:hover,.project a:active{color:#28292b;text-decoration:none}.project .list{width:100%;margin:0;font-size:17px;padding:8px 0 24px}.project .list li{display:flex;flex-direction:column;padding:5px 0 7px}.project .list li:nth-of-type(2n+1){background-color:#f5f5f6}.project .name{padding:8px 16px}.project .action{display:flex;margin-top:-8px;padding:0 6px}@media (min-width:531px){.project{padding:0 40px}.project h1{padding-right:20px;padding-left:20px}.project h2{margin-right:0;margin-left:0}.project .list li{padding-right:4px;padding-left:4px}}@media (min-width:741px){.project{padding:12px 40px}.project a{padding:0 16px;line-height:40px}.project .list li{flex-direction:row;justify-content:space-between;padding-bottom:6px}.project .action{margin-top:0}}</style>
<?endif?>

<script type="text/javascript">
       //var rrPartnerId = "62cfd1541a701bd78c23c846";   
		var rrPartnerId = "63317aed7477a809c32f22a2";   
       var rrApi = {}; 
       var rrApiOnReady = rrApiOnReady || [];
       rrApi.addToBasket = rrApi.order = rrApi.categoryView = rrApi.view = 
           rrApi.recomMouseDown = rrApi.recomAddToCart = function() {};
       (function(d) {
           var ref = d.getElementsByTagName('script')[0];
           var apiJs, apiJsId = 'rrApi-jssdk';
           if (d.getElementById(apiJsId)) return;
           apiJs = d.createElement('script');
           apiJs.id = apiJsId;
           apiJs.async = true;
           apiJs.src = "//cdn.retailrocket.ru/content/javascript/tracking.js";
           ref.parentNode.insertBefore(apiJs, ref);
       }(document));
    </script>
	<?endif;?>
</head>


<body class="!basic-layout basic-layout--default" id="basic-layout">
<div style='display:none'>
<?$APPLICATION->IncludeComponent("d7:contact_shops","header_krep-komp",Array(
								"IBLOCK_ID" => "19", 
								"CACHE_TYPE" => "A", 
								"CACHE_TIME" => "3600", 
								"CACHE_FILTER" => "N",
								"LIMIT" => 1,	
							), false
						);?>
						</div>
	<!-- scrollTopBtn -->
	<button class="btn-up btn-up--hide" type="button" aria-label="Вернуться в начало страницы">Top</button>

<?$APPLICATION->ShowPanel();?>


<?if(!$_COOKIE['use_cookie']):?>
<?
$APPLICATION->IncludeFile(
 "/include/use_cookie.php",
 array(),
 array("MODE"=>"php")
);
?>
<?endif?>

<?php if (stripos(@$_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false): ?>
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
<?endif;?>

<?=$APPLICATION->ShowViewContent("dsearch_line");?>

    <?include_once $_SERVER["DOCUMENT_ROOT"] . "/include/functions.php";?>
	

	
	
	<?if($_SERVER['HTTP_HOST']=="krep-komp.ru"):?>
	<div class="page-top-banner page-top-banner_mobile"> <div class="banner-textbox page page_mobile"> <div class='banner-link banner-text'>	<strong style='font-weight: 500; color:#000; font-size:16px;'>В магазине на Каширке доступна доставка день в день. <a href="/addresses/" style="text-decoration: underline; color: #4F36E3;">Подробнее</a></strong> </div> </div> </div>
	<?endif?> 
	
	
	
	
	<div class='mobile'>
		<div class='mobile__wrapp'>
			<div class="mobile__top">
				<div class="mobile__close"></div>  
			</div>
			<div class='mobile__bot'>
				
				<div class='mobile__item mobile__item--catalog'>
					<?$APPLICATION->IncludeComponent(
							"bitrix:menu", 
							"catalog_main_mobile", 
							array(
								"ROOT_MENU_TYPE" => "left",
								"MAX_LEVEL" => "4",
								"CHILD_MENU_TYPE" => "left",
								"USE_EXT" => "Y",
								"COMPONENT_TEMPLATE" => "catalog_main_mobile",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_TIME" => "3600",
								"MENU_CACHE_USE_GROUPS" => "Y",
								"MENU_CACHE_GET_VARS" => array(),
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
				<a href='/prays_listy/' class='mobile__item'>Прайс-лист</a>
				<a href='/certificates/' class='mobile__item'>Сертификаты</a>
				<a href='/oplata/' class='mobile__item'>Получение и оплата</a>
				<a href='/addresses/' class='mobile__item'>Адреса магазинов</a>
				<a href='/contacts/' class='mobile__item'>Контакты</a>

								<?$APPLICATION->IncludeComponent("d7:geolocation","mobile_d7",Array(
										"IBLOCK_ID" => "23", 
										"CACHE_TYPE" => "A", 
										"CACHE_TIME" => "3600", 
										"CACHE_FILTER" => "N",
										"SHOPS_IBLOCK_ID" => '19'
									), false
								);?>
				<span class="mobile__item mobile__item_footer">
				
					<a href='tel:<?=$phone_global?>'><?=$phone_global?></a><br/><br/>
					<a href='mailto:<?=$email_global?>'><?=$email_global?></a>
				</span>			
			</div>
		</div>
	</div>
	
	

	<div class="shelf">
		<div class="container">

			<div class="shelf__wrapper">
			
				<div class="shelf__left">
					<div class="shelf__hamburger">
						<span></span>
						<span></span>
						<span></span>
					</div>
					<a class="shelf__logo" href="/">
						<img class="shelf__img" src="<?=SITE_TEMPLATE_PATH?>/images/logo-mobile.svg">
					</a>
				</div>
				<div class="shelf__right">
					<!-- header-tel -->
					<a class="shelf__tel" href="tel:+74993505555">
						<svg class="shelf__tel-icon" aria-hidden="true" width="20" height="20" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M23.1538 10.2166C23.1939 9.05672 22.995 7.90099 22.5695 6.82124C22.144 5.74149 21.5009 4.76081 20.6803 3.94016C19.8596 3.11951 18.8789 2.47643 17.7992 2.0509C16.7194 1.62537 15.5637 1.42648 14.4038 1.46661" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M14.4038 6.46661C17.0288 6.46661 18.1538 7.59161 18.1538 10.2166" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M9.84614 9.23129L4.86538 4.54352L1.66346 7.55709C1.42628 9.78936 1.94807 15.1915 5.93268 18.9417C9.9173 22.6919 15.657 23.183 18.0288 22.9598L21.2307 19.9462L16.25 15.2584L13.7596 17.6023C13.0481 17.6023 11.1981 17.2005 9.49037 15.5933C7.78268 13.986 7.35576 12.2449 7.35576 11.5752L9.84614 9.23129Z" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</a>
					<?
						/*
						$APPLICATION->IncludeComponent(
							"bitrix:sale.basket.basket.line", 
							"mobile", 
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
								"COMPONENT_TEMPLATE" => "mobile",
								"SHOW_DELAY" => "N",
								"SHOW_NOTAVAIL" => "N",
								"SHOW_IMAGE" => "Y",
								"SHOW_PRICE" => "Y",
								"SHOW_SUMMARY" => "Y",
								"MAX_IMAGE_SIZE" => "70"
							),
							false
						);
						*/
						?>
					<div class="shelf__search"></div>
				</div>
			</div>
		</div>
		
<?$APPLICATION->ShowViewContent('catalogFilter');?>
		
	</div>
	
	<!-- bottom mobile navbar -->
	<nav class="mobile-navbar">
		<ul class="mobile-navbar__list" role="list">
			<li class="mobile-navbar__item mobile-navbar__item--dropdown">
			<?
				global $USER;
				if ($USER->IsAuthorized()){ 
			?>
				<a class="mobile-navbar__link mobile-navbar__link" href="/personal/">
					<svg class="mobile-navbar__icon mobile-navbar__icon--account" aria-hidden="true" width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1.94858 21.5C1.94858 16.1319 7.20468 14.4731 11.3019 14.4731C15.399 14.4731 20.8057 16.1319 20.8057 21.5M16.4276 6.08305C16.4276 8.75227 14.1326 10.9161 11.3016 10.9161C8.47054 10.9161 6.17553 8.75227 6.17553 6.08305C6.17553 3.41384 8.47054 1.25001 11.3016 1.25001C14.1326 1.25001 16.4276 3.41384 16.4276 6.08305Z" stroke="#552FEC" stroke-width="2.5" stroke-linecap="round"/>
					</svg>
					<span>Аккаунт</span>
				</a>
				<?}else{?>
				<a class="mobile-navbar__link mobile-navbar__link" href="/personal/">
					<svg class="mobile-navbar__icon mobile-navbar__icon--account" aria-hidden="true" width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1.94858 21.5C1.94858 16.1319 7.20468 14.4731 11.3019 14.4731C15.399 14.4731 20.8057 16.1319 20.8057 21.5M16.4276 6.08305C16.4276 8.75227 14.1326 10.9161 11.3016 10.9161C8.47054 10.9161 6.17553 8.75227 6.17553 6.08305C6.17553 3.41384 8.47054 1.25001 11.3016 1.25001C14.1326 1.25001 16.4276 3.41384 16.4276 6.08305Z" stroke="#552FEC" stroke-width="2.5" stroke-linecap="round"/>
					</svg>
					<span>Вход</span>
				</a>
				<?}?>
				
			</li>
			<li class="mobile-navbar__item">
				<?
		
		$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	"mobile", 
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
		"COMPONENT_TEMPLATE" => "mobile",
		"SHOW_DELAY" => "N",
		"SHOW_NOTAVAIL" => "N",
		"SHOW_IMAGE" => "Y",
		"SHOW_PRICE" => "Y",
		"SHOW_SUMMARY" => "Y",
		"MAX_IMAGE_SIZE" => "70"
	),
	false
);?>
				
			</li>
			<li class="mobile-navbar__item">
				<a class="mobile-navbar__link" href="/addresses/">
					<svg class="mobile-navbar__icon mobile-navbar__icon--store" aria-hidden="true" width="20" height="25" viewBox="0 0 20 25" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M10 1.5C5.24414 1.5 1.375 5.18357 1.375 9.71127C1.375 12.8034 5.69785 18.5887 9.74324 22.9716L10 23.25L10.2562 22.9708C12.2196 20.8304 18.625 13.5484 18.625 9.71099C18.6253 5.18357 14.7559 1.5 10 1.5ZM10 13.0346C8.0719 13.0346 6.50894 11.5465 6.50894 9.71099C6.50894 7.8755 8.0719 6.38762 10 6.38762C11.9281 6.38762 13.4911 7.87577 13.4911 9.71127C13.4911 11.5468 11.9281 13.0346 10 13.0346Z" stroke="#552FEC" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					<span>Магазины</span>
				</a>
			</li>
			<li class="mobile-navbar__item">
				<a class="mobile-navbar__link" href="/vashi-skidki/">
					<svg class="mobile-navbar__icon mobile-navbar__icon--stock" aria-hidden="true" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M17.1801 12.9134L12.7252 17.3682M1.44108 12.8567C1.74202 13.9084 2.55185 14.7182 4.16962 16.336L6.09796 18.2643C8.92253 21.0898 10.3338 22.5 12.0873 22.5C13.8409 22.5 15.2515 21.0894 18.0716 18.2693L18.0767 18.2643C20.9023 15.4408 22.3125 14.0296 22.3125 12.275C22.3125 10.5215 20.9002 9.10926 18.0767 6.28579L16.1483 4.35749C14.5306 2.73975 13.7207 1.92994 12.669 1.62901C11.6159 1.32661 10.4976 1.58491 8.26207 2.10151L6.97263 2.39867C5.09098 2.83232 4.15015 3.04967 3.50543 3.69332C2.86177 4.33803 2.64441 5.27883 2.21075 7.16045L1.91254 8.44986C1.39698 10.6864 1.13972 11.8036 1.44108 12.8567ZM10.3272 7.54558C11.1473 8.36568 11.1473 9.69534 10.3272 10.5154C9.50708 11.3356 8.1774 11.3356 7.35728 10.5154C6.53715 9.69534 6.53715 8.36568 7.35728 7.54558C8.1774 6.72547 9.50708 6.72547 10.3272 7.54558Z" stroke="#552FEC" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					<span>Скидки</span>
				</a>
			</li>
		</ul>
	</nav>

	<div class='top'>
		<div class='container'>		
			<div class='top__wrapper'>
				<div class="top__topside">
					<div class="top__left">
						
						<div class='top__address'>
						<?if(!strstr($_SERVER['HTTP_HOST'], "dev") || true)
						{?>
							
						<?}?>				
						</div>
					</div>
					<div class='top__right'>
					
						<div class="top__payment">
							<div class="top__payment__name"><a href='/delivery/'>Получение и оплата</a></div>
						</div>
						<div class="top__contact"><a href='/contacts/'>Контакты</a></div>
						

						
						<?$APPLICATION->IncludeComponent("d7:contact_shops","header_krep-komp",Array(
								"IBLOCK_ID" => "19", 
								"CACHE_TYPE" => "A", 
								"CACHE_TIME" => "3600", 
								"CACHE_FILTER" => "N",
								"LIMIT" => 1,	
							), false
						);?>
						
					</div>
				</div>	
	
	
				<?=$safari?>
		
    
	
				<div class="top__botside">
				<div class="top__logoblock">
					<a class="top__logo"  href="<?=($APPLICATION->GetCurPage() != "/") ? '/' : 'javascript::void();'?>">
						<img class="top__img" alt="Магазин крепежа и метизов «КРЕП-КОМП" title="Магазин крепежа и метизов «КРЕП-КОМП»" src="<?=SITE_TEMPLATE_PATH?>/images/logo.svg" />
					</a>
			
			
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
								"MENU_CACHE_GET_VARS" => array(),
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
			</div>
			
					<?
						$request = Application::getInstance()->getContext()->getRequest();
						$name = $request->getCookieList();               
					?>
							
					
					<div class="top__form">    

						<?/*$APPLICATION->IncludeComponent(
							"webcreature:dsearch.ajax", 
							"krep-komp_module", 
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
								"COMPONENT_TEMPLATE" => "krep-komp_module"
							),
							false
						);*/?>
					</div>
               
					<div class="top__rightside">
						<div class="top__nav top__login">
						<?
							global $USER;
							if ($USER->IsAuthorized())
							{ 
						?>
								<a href="/personal/">Кабинет</a>
							<?}else{?>
								<a href="/personal/" class="login__btn_new">Вход</a>
							<?}?>
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
	
	

				<div id="filter__catalog">
				<?$APPLICATION->ShowViewContent('catalogFilter');?>
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
			
			</div>
		</div>
	
	</div>
    
  
	<div class='page <?$APPLICATION->ShowViewContent('catalogFilterClass');?>'>
	<?if($APPLICATION->GetCurPage() !== "/")
	{?>
		<div class='content'>
			<div class='container'>
				<div class='content__wrapper'>
	<?}?>
    
	<?if($APPLICATION->GetCurPage() !== "/basket/" && $APPLICATION->GetCurPage() !== "/order/" && $APPLICATION->GetCurPage() !== "/import2/"):?>  	
	<?if($APPLICATION->GetCurPage() !== "/")
	{
		?>
		
		<div class='bread'>
            
			<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array());?> 
			
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

		<?if($APPLICATION->GetCurPage() !== "/" && ($APPLICATION->GetCurPage() !== "/personal/" || $USER->IsAuthorized()))
		{?>
		<div class="filter filter--page">
         
		 
			<div class='filter__block'>
		   
			<?$page_footer_menu = Array("/","/basket/","/order/","/import/");?>
		
			<?if (!in_array($APPLICATION->GetCurPage(), $page_footer_menu) && !preg_match('/test[0-9]*\.php/', $APPLICATION->GetCurPage())):?>

  
<?if($APPLICATION->GetCurPage() == "/personal/" || $APPLICATION->GetCurPage() == "/personal/private/" || $APPLICATION->GetCurPage() == "/personal/change_pass/"):?>
 <div class="contacts__leftside ">
 
					<?$APPLICATION->IncludeComponent(
						"bitrix:menu", 
						"left_bottom_new", 
						array(
							"ROOT_MENU_TYPE" => "left_bottom",
							"MAX_LEVEL" => "1",
							"CHILD_MENU_TYPE" => "left_bottom",
							"USE_EXT" => "Y",
							"VIBOR_CATALOG_TABLE" => array(
								0 => "",
								1 => "2411",
								2 => "2403",
								3 => "",
								),
							"COMPONENT_TEMPLATE" => "left_bottom_new",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => array(),
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "N"
							),
						false
					);?>
					
</div>
<?else:?>

				<div class="filter__leftside">
            

					<?=$APPLICATION->ShowViewContent('RELINK');?>
					<?=$APPLICATION->ShowViewContent("smart_filter");?>
					
					
				</div>					
<?endif?>

					
	

			<?endif?>
				<div class='filter__rightside'>
            <?=$APPLICATION->ShowViewContent("related_menu_element");?>
            <?if($APPLICATION->GetCurPage() == "/catalog/"):
                $APPLICATION->SetPageProperty("title", "Интернет-магазин \"КРЕП-КОМП\"");
            endif;?>

		<?}?>
		
        
        
<?else:?>
        
            
        
       
<?endif;?>
        

		
       

  