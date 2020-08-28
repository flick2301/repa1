<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$scheme = CMain::isHttps() ? 'https' : 'http';
?>

            <!--page-heading-->
            <header class="basic-layout__module page-heading">
               <h1 class="page-heading__title"><?$APPLICATION->ShowTitle()?></h1>
            </header>
            <!--page-heading-->
			
			

            <!--simple-article-->
            <div class="basic-layout__module simple-article" itemscope itemtype="http://schema.org/Article">
               <div class="simple-article__content wysiwyg-block">

	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<p itemscope itemprop="image" itemtype="http://schema.org/ImageObject"><img itemprop="url contentUrl"
			class="detail_picture"
			border="0"
			src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
			width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
			height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
			alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
			title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
			/>
			<meta itemprop="url" content="<?=$scheme?>://<?=$_SERVER['HTTP_HOST']?><?=$arResult["DETAIL_PICTURE"]["SRC"]?>">
			<meta itemprop="width" content="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>">
			<meta itemprop="height" content="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>">
			</p>
	<?endif?>
<div itemprop="articleBody">	
	<?if(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo str_replace(Array("<p>", "</p>"), Array("", ""), $arResult["DETAIL_TEXT"]);?>
	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
</div>	
	<?
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</noindex>
		</div>
		<?
	}
	
	$month = array(
		"01" => "января",
		"02" => "февраля",
		"03" => "марта",
		"04" => "апреля",
		"05" => "мая",
		"06" => "июня",
		"07" => "июля",
		"08" => "августа",
		"09" => "сентября",
		"10" => "октября",
		"11" => "ноября",
		"12" => "декабря",
	);
	?>
               </div>
		   
               <div class="simple-article__footer">
                  <a class="second-button second-button--mini" href="<?=$arParams["BACK_URL"]?>"><?=GetMessage("T_NEWS_DETAIL_BACK")?></a>
                  <?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?><p class="simple-article__date" itemprop="datePublished" <?/*datetime="<?echo preg_replace("/([0-9]{2})\.([0-9]{2})\.([0-9]{4})/", "\${3}-\${2}-\${1}", $arResult["DISPLAY_ACTIVE_FROM"])?>T16:20:30+00:00"*/?>>Дата публикации: <time datetime="<?echo preg_replace("/([0-9]{2})\.([0-9]{2})\.([0-9]{4})/", "\${3}-\${2}-\${1}", $arResult["DISPLAY_ACTIVE_FROM"])?>"><?echo preg_replace("/([0-9]{2})\.([0-9]{2})\.([0-9]{4})/", "\${1} ". $month["02"]." \${3}", $arResult["DISPLAY_ACTIVE_FROM"])?></time></p><?endif;?>
		
	
               </div>
            </div>
            <!--simple-article-->