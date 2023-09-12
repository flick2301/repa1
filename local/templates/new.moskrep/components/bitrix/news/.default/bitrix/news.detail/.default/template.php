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
?>

<?php
	if($APPLICATION->GetCurPage()!=$arResult["~DETAIL_PAGE_URL"])
	{
		@define("ERROR_404","Y");
		CHTTP::SetStatus("404 Not Found");
		
		$APPLICATION->SetPageProperty('title', "404 - HTTP not found");
	}	
	$date_created = $arResult["DISPLAY_ACTIVE_FROM"] ? $arResult["DISPLAY_ACTIVE_FROM"] : explode(" ", $arResult["TIMESTAMP_X"])[0];
?>
<!--simple-article-->
<div class="basic-layout__module simple-article">
	<div class="blog--detail">
		<div class="blog__top">
			<div class="blog__category" <? if($arResult['SECTIONS']["COLOR_TEXT"] || $arResult['SECTIONS']["COLOR_BG"]){ ?>style="<?=$arResult['SECTIONS']["COLOR_BG"];?><?=$arResult['SECTIONS']["COLOR_TEXT"];?>"<? } ?>>
				<?=$arResult['SECTIONS']["NAME"];?>
			</div>
			<h1><?=$arResult["NAME"];?></h1>
			<div class="blog__botside">
				<div class="blog__data">
					<?=FormatDate("d F Y", MakeTimeStamp($date_created));?>
				</div>
				<? if($arResult["SHOW_COUNTER"]){ ?>
					<div class="blog__view"><?=$arResult["SHOW_COUNTER"];?></div>
				<? } ?>
				<?if($arResult["PROPERTIES"]["read_time"]["VALUE"]):?>
					<div class="blog__time"><?=$arResult["PROPERTIES"]["read_time"]["VALUE"]?></div>
				<?endif?>
			</div>
		</div>
		<div class="blog__bottom">
			<div class="blog__content">
				<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
					<?
						$renderImg = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"] , Array("width" => 980, "height" => 540), BX_RESIZE_IMAGE_EXACT, false);
					?>
					<img class="blog__images" src="<?=$renderImg["src"]?>" alt="<?=$arResult["NAME"];?>" title="<?=$arResult["NAME"];?>">
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
						<? for($i=0;$i<count($arResult['PROPERTIES']['links']['VALUE']);$i++){ ?>
							<a class="blog__substence__link" href="#t<?=$i+1;?>">
								<?=$arResult['PROPERTIES']['links']['VALUE'][$i];?>
							</a>
						<? } ?>
					</div>
				</div>
			</div>
		</div>
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
				<a class="articles__top" href="<?=$similar["DETAIL_PAGE_URL"]?>">
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
				<div class="articles__bottom"><a class="articles__name" href="<?=$similar["DETAIL_PAGE_URL"]?>"><?=$similar["NAME"]?></a>
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