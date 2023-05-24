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
    
    <meta name="apple-mobile-web-app-title" content="Главная страница – Krep-Komp" />
    <meta name="theme-color" content="#0C58CF" />
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



   
   <?
   $user_agent = $_SERVER["HTTP_USER_AGENT"];
    if (strpos($user_agent, "Safari") !== false) {
		echo '<link href="'.SITE_TEMPLATE_PATH.'/css/safari.css" rel="stylesheet" type="text/css" />';
    }
	?>
   

	<link rel='canonical' href='https://<?=$_SERVER["HTTP_HOST"]?><?=$APPLICATION->GetCurPage(false);?>' />	



    <!-- Roistat BEGIN CODE -->
    <script>
        window.onRoistatAllModulesLoaded = function () {
            document.addEventListener('focusin', function(event) {
                if (event.target.closest('.l-ss-c-host-node')) {
                    window.roistat.emailtracking.enabled = false;
                }
            });
            document.addEventListener('focusout', function(event) {
                if (event.target.closest('.l-ss-c-host-node')) {
                    window.roistat.emailtracking.enabled = true;
                }
            });
        };
    </script>
    <script>window.roistatCookieDomain = 'krep-komp.ru';</script>
    <script>
        (function(w, d, s, h, id) {
            w.roistatProjectId = id; w.roistatHost = h;
            var p = d.location.protocol == "https:" ? "https://" : "http://";
            var u = /^.*roistat_visit=[^;]+(.*)?$/.test(d.cookie) ? "/dist/module.js" : "/api/site/1.0/"+id+"/init?referrer="+encodeURIComponent(d.location.href);
            var js = d.createElement(s); js.charset="UTF-8"; js.async = 1; js.src = p+h+u; var js2 = d.getElementsByTagName(s)[0]; js2.parentNode.insertBefore(js, js2);
        })(window, document, 'script', 'cloud.roistat.com', 'e39376bd761820b5780e54eda70448e1');
    </script>
    <!-- Roistat END CODE -->

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
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/components/bitrix/catalog.section/main_sale/style.css".$rand, true);	
	if (IPHONE=="Y") $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/iphone.css", true);	
	else $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/dieapple.css", true);
	
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.maskedinput.min.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.fancybox.min.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/datalayer.js");
	
	//file_exists($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/js/script.js")
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/script.min.js");


    CJSCore::Init(array("popup"));
    $api_key = htmlspecialcharsbx(Bitrix\Main\Config\Option::get('fileman', 'yandex_map_api_key'));
    Asset::getInstance()->addJs("https://api-maps.yandex.ru/2.1.50/?load=package.full&lang=ru-RU&apikey=$api_key");

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


<!-- calltouch -->
<script>
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
</head>


<body class="basic-layout basic-layout--default" id="basic-layout">
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


<?=$APPLICATION->ShowViewContent("dsearch_line");?>

    <?include_once $_SERVER["DOCUMENT_ROOT"] . "/include/functions.php";?>
	
		<header class="c-header">
			<div class="c-header__container basic-layout__section">
				<div class="c-header__topline">
					<div class="c-header__group">
						<div class="c-header__geo">
							<svg class="c-header__geo-icon" aria-hidden="true" width="9" height="11" viewBox="0 0 9 11" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M4.5 0C2.01868 0 0 1.86296 0 4.15282C0 5.71664 2.2554 8.64258 4.36604 10.8592L4.5 11L4.63366 10.8588C5.65808 9.7763 9 6.09344 9 4.15268C9.00015 1.86296 6.98131 0 4.5 0ZM4.5 5.83361C3.49403 5.83361 2.67858 5.08098 2.67858 4.15268C2.67858 3.22439 3.49403 2.4719 4.5 2.4719C5.50597 2.4719 6.32142 3.22453 6.32142 4.15282C6.32142 5.08112 5.50597 5.83361 4.5 5.83361Z" fill="currentColor"/>
							</svg>            
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
					</div>
					<div class="c-header__group">
						
						<a class="c-header__link accent-color" href="tel:<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/telephone.php"), false);?>">
							<svg class="c-header__link-icon" aria-hidden="true" width="11" height="10" viewBox="0 0 11 10" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M2.639 5.06005C3.33895 5.81244 4.10687 6.50109 4.93337 7.11757C5.21907 7.33325 5.51795 7.52088 5.81244 7.73009C5.83117 7.74882 5.85397 7.76318 5.87913 7.77208C5.90429 7.78098 5.93117 7.78421 5.95778 7.78151C5.98438 7.77882 6.01003 7.77028 6.0328 7.75652C6.05558 7.74276 6.07491 7.72414 6.08935 7.70205C6.45636 7.31815 6.83656 6.94719 7.18819 6.55898C7.37656 6.34167 7.63575 6.19503 7.92176 6.14392C8.20777 6.09282 8.503 6.1404 8.75733 6.2786C9.32872 6.59996 9.89352 6.93641 10.4451 7.29227C10.7059 7.47011 10.8909 7.73596 10.9646 8.03909C11.0384 8.34222 10.9959 8.6614 10.8451 8.9357C10.4539 9.76173 9.69134 9.89114 8.91556 9.98172C8.2189 10.0637 7.55959 9.85879 6.93765 9.59135C5.67109 9.02952 4.49941 8.28112 3.46313 7.37207C2.44447 6.55754 1.5452 5.60898 0.790754 4.55321C0.307265 3.84365 -0.088316 3.08447 0.0171724 2.20884C0.102882 1.45829 0.261114 0.720689 0.988545 0.248363C1.25304 0.0567227 1.58192 -0.0289688 1.90845 0.00868308C2.23497 0.0463349 2.53466 0.204509 2.74668 0.451097C3.16424 0.934206 3.56861 1.43026 3.9576 1.9414C4.15088 2.18515 4.24507 2.49063 4.22192 2.79864C4.19878 3.10666 4.05995 3.39527 3.83234 3.60856C3.74193 3.6955 3.65611 3.78692 3.57521 3.88247C3.26973 4.27284 2.96425 4.65889 2.639 5.06005Z" fill="currentColor"/>
							</svg>              
							<span><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/telephone.php"), false);?></span>
						</a>
						<a class="c-header__link accent-color" href="mailto:<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/email.php"), false);?>">
							<svg class="c-header__link-icon" aria-hidden="true" width="11" height="10" viewBox="0 0 11 10" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M2.639 5.06005C3.33895 5.81244 4.10687 6.50109 4.93337 7.11757C5.21907 7.33325 5.51795 7.52088 5.81244 7.73009C5.83117 7.74882 5.85397 7.76318 5.87913 7.77208C5.90429 7.78098 5.93117 7.78421 5.95778 7.78151C5.98438 7.77882 6.01003 7.77028 6.0328 7.75652C6.05558 7.74276 6.07491 7.72414 6.08935 7.70205C6.45636 7.31815 6.83656 6.94719 7.18819 6.55898C7.37656 6.34167 7.63575 6.19503 7.92176 6.14392C8.20777 6.09282 8.503 6.1404 8.75733 6.2786C9.32872 6.59996 9.89352 6.93641 10.4451 7.29227C10.7059 7.47011 10.8909 7.73596 10.9646 8.03909C11.0384 8.34222 10.9959 8.6614 10.8451 8.9357C10.4539 9.76173 9.69134 9.89114 8.91556 9.98172C8.2189 10.0637 7.55959 9.85879 6.93765 9.59135C5.67109 9.02952 4.49941 8.28112 3.46313 7.37207C2.44447 6.55754 1.5452 5.60898 0.790754 4.55321C0.307265 3.84365 -0.088316 3.08447 0.0171724 2.20884C0.102882 1.45829 0.261114 0.720689 0.988545 0.248363C1.25304 0.0567227 1.58192 -0.0289688 1.90845 0.00868308C2.23497 0.0463349 2.53466 0.204509 2.74668 0.451097C3.16424 0.934206 3.56861 1.43026 3.9576 1.9414C4.15088 2.18515 4.24507 2.49063 4.22192 2.79864C4.19878 3.10666 4.05995 3.39527 3.83234 3.60856C3.74193 3.6955 3.65611 3.78692 3.57521 3.88247C3.26973 4.27284 2.96425 4.65889 2.639 5.06005Z" fill="currentColor"/>
							</svg>              
							<span><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/email.php"), false);?></span>
						</a>
					</div>
				</div>
				<div class="c-header__main">
					<a class="c-header__logo" href="<?=($APPLICATION->GetCurPage() != "/") ? '/' : 'javascript::void();'?>">
						<img class="c-header__logo-img" src="/local/templates/moskrep/assets/design/website-logo/krep-komp.svg" width="152" height="43" alt="Креп-комп">
					</a>
					<div class="c-header__catalog">
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
									"MENU_CACHE_TYPE" => "N",
									"MENU_CACHE_TIME" => "3600",
									"MENU_CACHE_USE_GROUPS" => "N",
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
					</div>
					
					<?
$APPLICATION->IncludeComponent(
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
		"IN_CATEGORY" => "Y",
		"SEARCH_VARIABLE" => "result",
		"SIZE" => "8",
		"STAT" => "Y",
		"STAT_LIMIT" => "10000",
		"COMPONENT_TEMPLATE" => "krep-komp_module"
	),
	false
);?>
					<ul class="c-header__navbar navbar">
						<?
						global $USER;
						if ($USER->IsAuthorized()){ 
						?>
						<li class="navbar__item">
							<a class="navbar__link" href="/personal/">
								<svg class="navbar__icon" aria-hidden="true" width="19" height="21" viewBox="0 0 19 21" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1 20C1 14.9633 5.73846 13.4069 9.43212 13.4069C13.1258 13.4069 18 14.9633 18 20M14.0531 5.53472C14.0531 8.03917 11.9841 10.0694 9.43187 10.0694C6.87964 10.0694 4.81066 8.03917 4.81066 5.53472C4.81066 3.03027 6.87964 1.00001 9.43187 1.00001C11.9841 1.00001 14.0531 3.03027 14.0531 5.53472Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>                
								<span>Кабинет</span>
							</a>
						</li>
						<?}else{?>
						<li class="navbar__item">
							<a class="navbar__link" href="/personal/">
								<svg class="navbar__icon" aria-hidden="true" width="19" height="21" viewBox="0 0 19 21" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1 20C1 14.9633 5.73846 13.4069 9.43212 13.4069C13.1258 13.4069 18 14.9633 18 20M14.0531 5.53472C14.0531 8.03917 11.9841 10.0694 9.43187 10.0694C6.87964 10.0694 4.81066 8.03917 4.81066 5.53472C4.81066 3.03027 6.87964 1.00001 9.43187 1.00001C11.9841 1.00001 14.0531 3.03027 14.0531 5.53472Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>                
								<span>Войти</span>
							</a>
						</li>
						<?}?>
						<li class="navbar__item">
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
						</li>
						
					</ul>
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
		</header>


  
    <main class="basic-layout__common <?$APPLICATION->ShowViewContent('catalogFilterClass');?>">
	<?if($APPLICATION->GetCurPage() !== "/basket/" && $APPLICATION->GetCurPage() !== "/order/" && $APPLICATION->GetCurPage() !== "/import2/" && ($APPLICATION->GetCurPage() !== "/personal/" || $USER->IsAuthorized())):?>  	
	<?if($APPLICATION->GetCurPage() !== "/")
	{
		?>
		<div class="basic-layout__columns basic-layout__columns--reverse basic-layout__columns--special <?if(!strstr($_SERVER["REAL_FILE_PATH"], "catalog") && !strstr($_SERVER["DOCUMENT_URI"], "personal")):?>basic-layout__full<?endif?>">
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



      <div class="basic-layout__columns basic-layout__columns--reverse <?if(!strstr($_SERVER["REAL_FILE_PATH"], "catalog") && !strstr($_SERVER["DOCUMENT_URI"], "personal")):?>basic-layout__full<?endif?>">
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


		
       

  