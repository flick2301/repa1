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
    
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="yandex-verification" content="94ad628889e9793a" />
    <meta name="google-site-verification" content="tCyUZcBpb8WKtkt8O1XsKiMEeBQpIFTPY-N9GDFfIv0" />
    
	<meta name="robots" content="index,follow">
    <meta name="apple-mobile-web-app-title" content="Главная страница – Krep-Komp">
    <meta name="theme-color" content="#0C58CF">
    <title><?$APPLICATION->ShowTitle();?></title>

	<?$APPLICATION->ShowHead();?>
        <?CJSCore::Init(array('jquery'));?>
	<?
	//$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/reset.css", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/style.css", true);
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/fancybox.css", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/styles/global.styles.min.css?v=XXXXXXa", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/correction.css", true);
	?>
	
	<link rel="manifest" href="<?=SITE_TEMPLATE_PATH?>/assets/a-icons/manifest.webmanifest">
	<link rel="icon" sizes="32x32" href="<?=SITE_TEMPLATE_PATH?>/assets/a-icons/favicon-32.png">
	<link rel="icon" sizes="96x96" href="<?=SITE_TEMPLATE_PATH?>/assets/a-icons/favicon-96.png">
	<link rel="icon" sizes="16x16" href="<?=SITE_TEMPLATE_PATH?>/assets/a-icons/favicon-16.png">
	
	<!--appicons-->
   <link rel="apple-touch-icon" href="<?=SITE_TEMPLATE_PATH?>/assets/a-icons/icon-iphone.png" sizes="60x60">
   <link rel="apple-touch-icon" href="<?=SITE_TEMPLATE_PATH?>/assets/a-icons/icon-ipad.png" sizes="76x76">
   <link rel="apple-touch-icon" href="<?=SITE_TEMPLATE_PATH?>/assets/a-icons/icon-iphone@2x.png" sizes="120x120">
   <link rel="apple-touch-icon" href="<?=SITE_TEMPLATE_PATH?>/assets/a-icons/icon-ipad@2x.png" sizes="152x152">

	<link rel='canonical' href='https://<?=$_SERVER["SERVER_NAME"]?><?=$APPLICATION->ShowViewContent('page_url');?>' />

    
    <!--[if (lt IE 9)&(!IEMobile 7)]><script src="js/html5support.js"></script><![endif]-->

<script>
  (function(d) {
    var s = d.createElement('script');
    s.defer = true;
    s.src = 'https://multisearch.io/plugin/10771';
    if (d.head) d.head.appendChild(s);
  })(document);
</script>


<?if($APPLICATION->GetCurPage() == "/" && false):?>
<style>@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,600&subset=cyrillic);body{margin:0;font-family:'Open Sans',sans-serif;font-weight:400;letter-spacing:0;background-color:#fff;background-image:none}.project{max-width:660px;margin:0 auto;line-height:24px}.project *{font-family:'Open Sans',sans-serif}.project h1{margin:0;padding:34px 16px 25px;font-size:30px;font-weight:600;text-align:center;text-transform:capitalize}.project h2{margin:0 16px 12px;font-size:17px;font-weight:600}.project q{font-style:normal}.project q,.project q:lang(en){quotes:'\201C''\201D''\2018''\2019'}.project q:lang(ru){quotes:'\00AB''\00BB''\201E''\201C'}.project q::after,.project q::before{font-weight:600;color:#06aaf5}.project a{padding:0 10px;line-height:36px;color:#06aaf5;white-space:nowrap;text-decoration:underline}.js-no-touch .project a:hover,.project a:active{color:#28292b;text-decoration:none}.project .list{width:100%;margin:0;font-size:17px;padding:8px 0 24px}.project .list li{display:flex;flex-direction:column;padding:5px 0 7px}.project .list li:nth-of-type(2n+1){background-color:#f5f5f6}.project .name{padding:8px 16px}.project .action{display:flex;margin-top:-8px;padding:0 6px}@media (min-width:531px){.project{padding:0 40px}.project h1{padding-right:20px;padding-left:20px}.project h2{margin-right:0;margin-left:0}.project .list li{padding-right:4px;padding-left:4px}}@media (min-width:741px){.project{padding:12px 40px}.project a{padding:0 16px;line-height:40px}.project .list li{flex-direction:row;justify-content:space-between;padding-bottom:6px}.project .action{margin-top:0}}</style>
<?endif?>


</head>
<?$APPLICATION->ShowPanel();?>
<body class="basic-layout basic-layout--default" id="basic-layout">

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
	<header class="basic-layout__header">
	
	<!--<div class="page-top-banner"> <div id="bannerIsWork" class="banner-textbox page">  <a class="banner-link" href="https://krep-komp.ru/"><p class="banner-text"><strong style='font-weight: 500; position: relative; top: 1px;'>Мы работаем! Принимаем заказы на самовывоз и бесконтактную доставку. <span style='color: #f39101;'></span></strong></p> </a> <svg class="icon-svg -cross" data-selector="page-top-banner-close"> <use xlink:href="#icon-cross"></use> <svg id="icon-cross" viewBox="0 0 32 32"><path d="M19.8,16l11.5,11.4c1.1,1,1.1,2.7,0,3.8c-1,1-2.8,1-3.8,0L16,19.8L4.6,31.1c-1.1,1-2.8,1-3.8,0c-1-1-1-2.7,0-3.8L12.2,16L0.8,4.7c-1-1-1-2.7,0-3.8c1.1-1,2.8-1,3.8,0L16,12.2L27.4,0.8c1-1,2.8-1,3.8,0c1.1,1,1.1,2.7,0,3.8L19.8,16z"></path></svg></svg> </div> </div>-->
    <div class="basic-layout__section">
	<!--eshop-panel-->
        <div class="eshop-panel">
			<div class="eshop-panel__brand">
			<!--website-logo-->
			<div class="website-logo">
				<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/company_logo.php"), false, []);?>
				<a class="website-logo__link" href="/">На главную</a>
			</div>
			<!--website-logo-->
            </div>
			<div class="eshop-panel__search">
                <?if(1){
                $request = Application::getInstance()->getContext()->getRequest();
                $name = $request->getCookieList();
                
                ?>
                    <?if(SITE_ID!='s2'):?>
                
                <? require_once($_SERVER["DOCUMENT_ROOT"] . "/include/geolocation.php");?>
                
                    <?endif;?>
                <?}?>
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
						?><a href="javascript:void(0);" class="client-widget__link login__btn" data-sign-in-form-trigger><i class="simple-user-icon client-widget__icon"></i>Вход</a><?
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
		<div class="eshop-panel__contact">
               <!--contact-widget-->
               <div class="contact-widget">
                    <?if($_SERVER['HTTP_HOST']!='spb.krep-komp.ru'){?>
						<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/tel_header.php"), false, []);?>
                    <?}else{?>
						<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/tel_header_spb.php"), false, []);?>
                    <?}?>
                    <p class="contact-widget__schedule"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/opening_hours.php"), false, []);?></p>
					<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/email_header.php"), false, []);?>
				</div>
		</div>
              
		
        
	</div>
	<!--eshop-panel-->
</div>
	<div class="basic-layout__section">
         <!--website-navbar-->
         <div class="website-navbar">
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
			0 => "1603",
			1 => "1649",
			2 => "1951",
			3 => "2312",
			4 => "2354",
			6 => "2411",
                        7 => "2403",
                        8 => "",
		)
	),
	false
);?>
					
			
			
		</div>
		<div class="website-navbar__primary">
               <!--main-nav-->
               <nav class="main-nav">
                  <h4 class="main-nav__title" data-sreader>Навигация</h4>
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
    
  
    <main class="basic-layout__common">
	<?if($APPLICATION->GetCurPage() !== "/basket/" && $APPLICATION->GetCurPage() !== "/order/"):?>  	
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
      <div class="basic-layout__columns basic-layout__columns--reverse">
         <div class="basic-layout__content">
           
                
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
        
		
		
       

  