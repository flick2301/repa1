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

<div class="articles__list news-list">
	<?foreach($arResult["ITEMS"] as $arItem):?>	
	<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="articles__box news-item">
		<!--article-card-->
		<a class="articles__top" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
		
			<!-- articles__category style заполнятьеся из двух дополнительных свойств раздела цвет фона и цвет текса -->
			<div class="articles__category" <? if($arResult['SECTIONS'][$arItem["IBLOCK_SECTION_ID"]]["COLOR_TEXT"] || $arResult['SECTIONS'][$arItem["IBLOCK_SECTION_ID"]]["COLOR_BG"]){?>style="<?=$arResult['SECTIONS'][$arItem["IBLOCK_SECTION_ID"]]["COLOR_TEXT"];?><?=$arResult['SECTIONS'][$arItem["IBLOCK_SECTION_ID"]]["COLOR_BG"];?>"<?}?>>
				<?=$arResult['SECTIONS'][$arItem["IBLOCK_SECTION_ID"]]["NAME"];?>
			</div>
			
			<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
				<?
					$renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], Array("width" => 465, "height" => 350), BX_RESIZE_IMAGE_EXACT); 
				?>
				<img class="articles__img" src="<?=$renderImage["src"]?>" alt="<?=$arItem["NAME"];?>" title="<?=$arItem["NAME"];?>">
			<?endif;?>
			
			<div class="articles__options">
				<? if(!empty($arItem["DISPLAY_PROPERTIES"]["photo"]["VALUE"])){ ?>
					<div class="articles__options__item">
						<img src="/images/gallery.svg" alt="Фотогалерея" title="Фотогалерея">
					</div>
				<? } ?>
				<? if(!empty($arItem["DISPLAY_PROPERTIES"]["video"]["VALUE"])){ ?>
					<div class="articles__options__item">
						<img src="/images/video.svg" alt="Видео" title="Видео">
					</div>
				<? } ?>
			</div>
		</a>
		<div class="articles__bottom">
			<a class="articles__name" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"];?></a>
			<div class="articles__desc">
				<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
					<?echo strip_tags($arItem["PREVIEW_TEXT"]);?>
				<?endif;?>
			</div>
			<div class="articles__botside">
				<div class="articles__data">
					<?=$arItem["DISPLAY_ACTIVE_FROM"] ? $arItem["DISPLAY_ACTIVE_FROM"] : explode(" ", $arItem["TIMESTAMP_X"])[0];?>
				</div>
				<? if($arItem["SHOW_COUNTER"]){ ?>
					<div class="articles__view"><?=$arItem["SHOW_COUNTER"];?></div>
				<? } ?>
			</div>
		</div>
		<!--article-card-->
	</div>	
	<?endforeach;?>	   
</div>

<!--content-feed-->
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>			