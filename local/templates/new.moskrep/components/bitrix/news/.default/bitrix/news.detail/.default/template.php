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

$renderImg = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"] , Array("width" => 980, "height" => 540), BX_RESIZE_IMAGE_EXACT, false);
?>

<?php
if($APPLICATION->GetCurPage()!=$arResult["~DETAIL_PAGE_URL"])
{
    @define("ERROR_404","Y");
    CHTTP::SetStatus("404 Not Found");

    $APPLICATION->SetPageProperty('title', "404 - HTTP not found");
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

$date_created = $arResult["DISPLAY_ACTIVE_FROM"] ? $arResult["DISPLAY_ACTIVE_FROM"] : explode(" ", $arResult["TIMESTAMP_X"])[0];
$date_created_array = explode(".", $date_created);
?>




            <!--simple-article-->
            <div class="basic-layout__module simple-article" itemscope itemtype="http://schema.org/Article">
               <div class="blog--detail">
                   <div class="blog__top">
                       <div class="blog__category" style="background-color:#552FEC;color:#fff;">
                           <?=$arResult["SECTION"]["PATH"][0]["NAME"];?>
                       </div>
                       <h1><?=$arResult["NAME"];?></h1>
                       <div class="blog__botside">
                           <div class="blog__data"><?php echo $date_created_array[0]." ".$month[$date_created_array[1]].' '.$date_created_array[2];?></div>
                           <div class="blog__view"><?=$arResult["SHOW_COUNTERS"];?></div>
                           <!-- Длительность чтения статьи-->
                           <?if($arResult["PROPERTIES"]["read_time"]["VALUE"]):?><div class="blog__time"><?=$arResult["PROPERTIES"]["read_time"]["VALUE"]?></div><?endif?>
                       </div>
                   </div>
                   <div class="blog__bottom">
                       <div class="blog__content">
                           <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
                                   <p><img                                                                                                          class="blog__images"
                                                                                                           border="0"
                                                                                                           src="<?=$renderImg["src"]?>"
                                                                                                           width="980"
                                                                                                           height="540"
                                                                                                           alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
                                                                                                           title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
                                   />

                               </p>
                           <?endif?>
                           <div class="blog__content__wrapper">
                               <div class="blog__socials">
                                   <?
                                   $APPLICATION->IncludeComponent("bitrix:main.share", "left", array(
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
                               </div>

                               <div class="blog__content__bottom">
                                   <?if(strlen($arResult["DETAIL_TEXT"])>0):?>
                                       <?echo $arResult["DETAIL_TEXT"];?>
                                   <?else:?>
                                       <?echo $arResult["PREVIEW_TEXT"];?>
                                   <?endif?>
                               </div>
                           </div>

                       </div>
                       <div class="blog__rightside">
                           <div class="blog__substence">
                               <div class="blog__substence__name">Содержание</div>
                               <div class="blog__substence__list">
                                   <? for($i=0;$i<count($arResult['PROPERTIES']['links']['VALUE']);$i++)
                                       {?>
                                   <a class="blog__substence__link" href="#t<?=$i+1;?>">
                                       <?=$arResult['PROPERTIES']['links']['VALUE'][$i];?>
                                   </a>
                                  <?}?>
                               </div>
                           </div>
                       </div>
                   </div>




	
	
	
	
	
               </div>
		   
               <div class="simple-article__footer">
                  <a class="second-button second-button--mini d-none" href="<?=$arParams["BACK_URL"]?>"><?=GetMessage("T_NEWS_DETAIL_BACK")?></a>
                  <?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?><p class="simple-article__date d-none" itemprop="datePublished" <?/*datetime="<?echo preg_replace("/([0-9]{2})\.([0-9]{2})\.([0-9]{4})/", "\${3}-\${2}-\${1}", $arResult["DISPLAY_ACTIVE_FROM"])?>T16:20:30+00:00"*/?>>Дата публикации: <time datetime="<?echo preg_replace("/([0-9]{2})\.([0-9]{2})\.([0-9]{4})/", "\${3}-\${2}-\${1}", $arResult["DISPLAY_ACTIVE_FROM"])?>"><?echo preg_replace("/([0-9]{2})\.([0-9]{2})\.([0-9]{4})/", "\${1} ". $month["02"]." \${3}", $arResult["DISPLAY_ACTIVE_FROM"])?></time></p><?endif;?>
		
	
               </div>		   
            </div>
            <!--simple-article-->
			
	


	

<?if($arResult["MORE"]):?>




<div class="articles__more">
		<!-- Три последние стоить из этой категории -->
		<div class="articles__more__title">Похожие статьи</div>
		<div class="articles__list">
		
		
		
<?foreach($arResult["MORE"] AS $similar):?>
			<div class="articles__box">
				<a class="articles__top" href="<?=dirname($_SERVER['REAL_FILE_PATH'])?>/<?=$similar["DETAIL_PAGE_URL"]?>">
					<!-- articles__category style заполнятьеся из двух дополнительных свойств раздела цвет фона и цвет текса -->
					<div class="articles__category" style="background-color:<?if($similar["SECTION"]["UF_COLOR"]):?><?=$similar["SECTION"]["UF_COLOR"]?><?else:?>#552FEC<?endif?>;color:<?if($similar["SECTION"]["UF_COLOR2"]):?><?=$similar["SECTION"]["UF_COLOR2"]?><?else:?>#fff<?endif?>;"><?=$similar["SECTION"]["NAME"]?></div>
					<?if($similar["IMG"]):?>
					<img class="articles__img" src="<?=$similar["IMG"]?>" alt="<?=$similar["NAME"]?>">
					<?endif?>
					
					<!-- Сделать у элмента два свойства фото и видео, при отмечении которых появляеться соотвествующая иокнка, если они оба пустые блок не выводить -->
					<div class="articles__options">
						<!-- Появляется если отмечено галка фото -->
						<?if($similar["PROPERTIES"]["photo"]["VALUE"]):?>
						<div class="articles__options__item">
							<img src="<?=$this->GetFolder()?>/img/gallery.svg" alt="Фотогалерея" title="Фотогалерея">
						</div>
						<?endif?>
						<!-- Появляется если отмечено галка видео -->
						<?if($similar["PROPERTIES"]["video"]["VALUE"]):?>
						<div class="articles__options__item">
							<img src="<?=$this->GetFolder()?>/img/video.svg" alt="Видео" title="Видео">
						</div>
						<?endif?>
					</div>
				</a>
				<div class="articles__bottom"><a class="articles__name" href="<?=dirname($_SERVER['REAL_FILE_PATH'])?>/<?=$similar["DETAIL_PAGE_URL"]?>"><?=$similar["NAME"]?></a>
					<div class="articles__desc"><?=$similar["PREVIEW_TEXT"]?></div>
					<div class="articles__botside">
						<div class="articles__data"><?php echo $similar["DATE_FORMAT"][0]." ".$month[$similar["DATE_FORMAT"][1]].' '.$similar["DATE_FORMAT"][2];?></div>
						<div class="articles__view"><?=$similar["SHOW_COUNTER"];?></div>
					</div>
				</div>
			</div>

<?endforeach?>	


</div>
</div>	
<?endif?>		



		
			
			
	
<div style="margin: auto; width: auto; text-align: right;">
<script src="https://yastatic.net/share2/share.js"></script>

</div>
	
			
			
			
			
			
			
			