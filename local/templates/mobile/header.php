<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Page\Asset;

Loc::LoadMessages(__FILE__);
?>
<!-- DESKTOP -->
<!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
    
    <?$APPLICATION->ShowHead();?>
	<?
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/reset.css", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/style.css", true);
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/fancybox.css", true);
        
	?>
    
    <!--[if (lt IE 9)&(!IEMobile 7)]><script src="<?=SITE_TEMPLATE_PATH?>/js/html5support.js"></script><![endif]-->
</head>
<?$APPLICATION->ShowPanel();?>
<body>
    <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/functions.php"), false);?>
	<header class="header inner">
		<div class="header-wrap-top">
			<div class="header-logo"><a href="/"><img src="/include/logo_mobile.png"></a></div>
			<?
                        global $USER;
                        if ($USER->IsAuthorized()){ 
                        ?><a href="/personal/" class="lk__btn"><?=$USER->GetFirstName();?></a><?
                         }else{
                         ?><a href="javascript:void(0);" class="login__btn">Вход</a><?
                         }
                        ?>
			<?$APPLICATION->IncludeComponent(
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
			<nav class="nav-main">
				<a href="javascript:void(0);" class="nav-main__btn h-mobile-btn"></a>
				<div class="nav-main__wrap">
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
				<div class="header-fade"></div>
			</nav>
			<div class="header-contacts">
				<a href="javascript:void(0);" class="header-contacts__btn h-mobile-btn"></a>
				<div class="header-contacts__wrap">
					<div class="header-contacts__items">
						<span class="s18-title icon-phone">Контактный телефон</span>
						<a href="phone:<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/telephone.php"), false);?>" class="header-contacts__phone"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/telephone.php"), false);?></a>
						<span class="s18-title">Режим работы:</span>
						<div class="header-contacts__schedule"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/opening_hours.php"), false);?></div>
						<span class="s18-title">Электронная почта:</span>
						<a href="mailto:<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/email.php"), false);?>" class="header-contacts__mail"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/email.php"), false);?></a>
						<span class="s18-title">Адрес магазина:</span>
						<p><?=STORE_ID_KASHIRKA[1]?></p>
						<span class="s18-title">Адрес склада:</span>
						<p><?=STORE_ID_KOLEDINO[3]?></p>
						<a href="#" class="header-feedback__btn blue-btn">Отправить запрос</a>
					</div>
				</div>
			</div>
			<?$APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "",
                            Array(
                                "ROOT_MENU_TYPE" => "left", 
                                "MAX_LEVEL" => "3", 
                                "CHILD_MENU_TYPE" => "left", 
                                "USE_EXT" => "Y" 
                                )
                        );?>
			
			<div class="header-search">
				<a href="#" class="search__btn h-mobile-btn"></a>
				<div class="header-search__wrap">
					<div class="header-search__form">
						<a href="#" class="search__close"></a>
						<input type="text" name="" placeholder="Поиск по каталогу..." class="header-search__input">
						<a href="#" class="header-search__btn"></a>
					</div>
					<div class="header-search__result">
						<div class="result__title result__title--first">Разделы</div>
						<ul class="result__list">
							<li class="result__item"><a href="#" class="result__link"><span class="result__main">Саморезы</span></a></li>
							<li class="result__item"><a href="#" class="result__link"><span class="result__main">Саморезы</span> кровельные</a></li>
							<li class="result__item"><a href="#" class="result__link"><span class="result__main">Саморезы</span> оконные</a></li>
							<li class="result__item"><a href="#" class="result__link"><span class="result__main">Саморезы</span> по дереву</a></li>
							<li class="result__item"><a href="#" class="result__link"><span class="result__main">Саморезы</span> универсальные</a></li>
							<li class="result__item"><a href="#" class="result__link"><span class="result__main">Саморезы</span></a></li>
							<li class="result__item"><a href="#" class="result__link"><span class="result__main">Саморезы</span> кровельные</a></li>
							<li class="result__item"><a href="#" class="result__link"><span class="result__main">Саморезы</span> оконные</a></li>
							<li class="result__item"><a href="#" class="result__link"><span class="result__main">Саморезы</span> по дереву</a></li>
							<li class="result__item"><a href="#" class="result__link"><span class="result__main">Саморезы</span> универсальные</a></li>
						</ul>
						<div class="result__title">Товары из каталога</div>
						<ul class="result__price-list">
							<li class="result__item">
								<a href="#" class="result__link"><span class="result__main">Саморез</span> кровельный цинк, с шайбой EPDM, PT-1, 4,8х19 (4200шт)</a>
								<span class="result__price">7 430 ₽</span>
							</li>
							<li class="result__item">
								<a href="#" class="result__link"><span class="result__main">Саморез</span> кровельный цинк, с шайбой EPDM, PT-1, 4,8х19 (4200шт)</a>
								<span class="result__price">7 430 ₽</span>
							</li>
							<li class="result__item">
								<a href="#" class="result__link"><span class="result__main">Саморез</span> кровельный цинк, с шайбой EPDM, PT-1, 4,8х19 (4200шт)</a>
								<span class="result__price">7 430 ₽</span>
							</li>
							<li class="result__item">
								<a href="#" class="result__link"><span class="result__main">Саморез</span> оконный со сверлом, Жёлтый цинк, под автомат 3,9х13 Kn (25000шт)</a>
								<span class="result__price">7 430 ₽</span>
							</li>
							<li class="result__item">
								<a href="#" class="result__link"><span class="result__main">Саморез</span> оконный со сверлом, Жёлтый цинк, под автомат 3,9х16</a>
								<span class="result__price">7 430 ₽</span>
							</li>
							<li class="result__item">
								<a href="#" class="result__link"><span class="result__main">Саморез</span> кровельный цинк, с шайбой EPDM, PT-1, 4,8х19 (4200шт)</a>
								<span class="result__price">7 430 ₽</span>
							</li>
							<li class="result__item">
								<a href="#" class="result__link"><span class="result__main">Саморез</span> кровельный цинк, с шайбой EPDM, PT-1, 4,8х19 (4200шт)</a>
								<span class="result__price">7 430 ₽</span>
							</li>
							<li class="result__item">
								<a href="#" class="result__link"><span class="result__main">Саморез</span> кровельный цинк, с шайбой EPDM, PT-1, 4,8х19 (4200шт)</a>
								<span class="result__price">7 430 ₽</span>
							</li>
							<li class="result__item">
								<a href="#" class="result__link"><span class="result__main">Саморез</span> оконный со сверлом, Жёлтый цинк, под автомат 3,9х13 Kn (25000шт)</a>
								<span class="result__price">7 430 ₽</span>
							</li>
							<li class="result__item">
								<a href="#" class="result__link"><span class="result__main">Саморез</span> оконный со сверлом, Жёлтый цинк, под автомат 3,9х16</a>
								<span class="result__price">7 430 ₽</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div <?echo ($APPLICATION->GetCurPage() == "/basket/") ? 'id="basket-root"' : '';?> class="content inner">
          <?if(!CSite::InDir('/index.php')):?> 
          <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array());?>
          <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "parent", array());?>
          
          <?endif;?>
