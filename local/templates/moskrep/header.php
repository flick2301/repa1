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
    
       
    
    <meta charset="utf-8">
    <meta name="yandex-verification" content="94ad628889e9793a" />
    <meta name="google-site-verification" content="tCyUZcBpb8WKtkt8O1XsKiMEeBQpIFTPY-N9GDFfIv0" />
    
   <title><?$APPLICATION->ShowTitle();?></title>

	<?$APPLICATION->ShowHead();?>
        <?CJSCore::Init(array('jquery'));?>
	<?
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/reset.css", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/style.css", true);
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/fancybox.css", true);
		
		
		
	?>
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
</head>
<?$APPLICATION->ShowPanel();?>
<body>

    <!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(29426710, "init", {
        id:29426710,
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true,
        ecommerce:"dataLayer"
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/29426710" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
    <?include_once $_SERVER["DOCUMENT_ROOT"] . "/include/GTM.php";?>
    <?include_once $_SERVER["DOCUMENT_ROOT"] . "/include/functions.php";?>
    <header class="header inner">
	<div class="header-wrap-top">
	    <div class="header-logo"><a href="/" title='Купить метизы, крепежные изделия и инструмент в Москве.'><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/company_logo.php"), false, []);?></a></div>
	    <div class="header-search">
                <?if(1){
                $request = Application::getInstance()->getContext()->getRequest();
                $name = $request->getCookieList();
                
                ?>
                    <?if(SITE_ID!='s2'):?>
                <div id='geo_block'>
                <? require_once($_SERVER["DOCUMENT_ROOT"] . "/include/geolocation.php");?>
                </div>
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
);*/?>                          <?$APPLICATION->AddHeadScript('/local/ajax/ajax_search.js');?>

    
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

                <div id='title_sr' style='display: none; position: absolute; top: 156px; width: 570px;' class='title-search-result'>
                </div>
                
		    <div class="header-search__fade"></div>
		</div>
		
		<div class="header-contacts">
                    <?if($_SERVER['HTTP_HOST']!='spb.krep-komp.ru'){?>
						<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/tel_header.php"), false, []);?>
                    <?}else{?>
						<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/tel_header_spb.php"), false, []);?>
                    <?}?>
                    <div class="header-contacts__schedule"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/opening_hours.php"), false, []);?></div>
					<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/email_header.php"), false, []);?>
		</div>
                <div class='header-lk'>
	<?
        global $USER;
        if ($USER->IsAuthorized()){ 
            ?><a href="/personal/" class="lk__btn">Кабинет</a><?
        }else{
            ?><a href="javascript:void(0);" class="login__btn">Вход</a><?
        }
        ?>
                </div>
		<?
		
		$APPLICATION->IncludeComponent(
	        "bitrix:sale.basket.basket.line",
	        "",
	        Array(
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
		"SHOW_TOTAL_PRICE" => "N"
	)
);?>
        
	</div>
	<div class="header-wrap-bottom">
			
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
					
			
	    <nav class="nav-main">
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
		
	    </nav>
	</div>
    </header>
    
<?if($APPLICATION->GetCurPage() !== "/basket/" && $APPLICATION->GetCurPage() !== "/order/" && ERROR_404 != 'Y'):?>    
    <div class="two-column inner">
	<aside class="two-column__left">
           <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "parent", array());?> 
            <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "left_bottom",
            Array(
            "ROOT_MENU_TYPE" => "left_bottom", 
            "MAX_LEVEL" => "1", 
            "CHILD_MENU_TYPE" => "left_bottom", 
            "USE_EXT" => "Y",
            "VIBOR_CATALOG_TABLE" => array(
			
			0 => "2411",
                        1 => "2403",
                        3 => "",
                        )
     )
);?>
                
            <?=$APPLICATION->ShowViewContent("related_menu_element");?>
            <?=$APPLICATION->ShowViewContent('RELINK');?>
            <?=$APPLICATION->ShowViewContent("smart_filter");?>
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
        </aside>
        <div id="basket-root" class="two-column__right">
<?else:?>
        <div id="basket-root" class='two-column reverse inner'>
            
        
       
<?endif;?>
        
       

  