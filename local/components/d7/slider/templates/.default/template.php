<img class="promo-block__image" src="<?=CFile::GetPath($arResult["ITEMS"][0]["PREVIEW_PICTURE"])?>" width="1216" height="496" alt="<?=$arItem["PREVIEW_TEXT"]?>">
<?if($arResult["ITEMS"][0]["PROPERTIES"]["SLIDER_LINK"]["VALUE"]):?>
<a class="promo-block__link" href="<?=$arResult["ITEMS"][0]["PROPERTIES"]["SLIDER_LINK"]["VALUE"]?>">Открыть страницу</a>
<?endif?>
			
