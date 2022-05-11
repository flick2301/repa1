<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>
<div class='catalog-feed__list'>
	<?
    foreach ($arResult['SECTIONS'] as &$arSection)
    {
		$arSection['NEW_NAME'] = $arSection['UF_SHORT_NAME'] ? $arSection['UF_SHORT_NAME'] : $arSection['NAME'];
		$arayName = explode(" ", $arSection['NEW_NAME']);
		$smallText = false;
		foreach ($arayName as $val) { 
			if (strlen($val) > 13) {
				$smallText = true;
				$half = strlen($val)/2;
				$second_half = mb_substr($val, 13);
				$val = mb_substr($val, 0, 13)." ".$second_half;
			}
			$arSection['SPLIT_NAME'] .= $val." ";			
			};
			
			$arSection['SPLIT_NAME'] = trim($arSection['SPLIT_NAME']);
			
			if ($arSection['SPLIT_NAME']) $arSection['NEW_NAME'] = $arSection['SPLIT_NAME']
    ?>
	<div class="catalog-feed__item catalog-feed__item__withpic <?if(!$arSection['DETAIL_PICTURE']):?>catalog-feed__item__white<?endif?>">
		<!--catalog-card-->
        <section class="catalog-card">
            <div class="div_flex_h3 catalog-card__title"><a href="<?=$arSection['UF_SYM_LINK'] ? $arSection['UF_SYM_LINK'] : $arSection['SECTION_PAGE_URL']?>" target="_self" title='<?=$arSection['IPROPERTY_VALUES']['SECTION_META_TITLE']?>' class="catalog-card__link" <?if($smallText && false):?>style="font-size: 12px;"<?endif?> onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($arSection['NAME']))?>');"><?=$arSection["NEW_NAME"]?></a></div>
            <div class="catalog-card__cover <?if(!$arSection['DETAIL_PICTURE']):?>catalog-card__cover__white<?endif?>">
                <img class="catalog-card__image" width="262" height="197" src="<?=$arSection["SMALL_IMG_WEBP"]['WEBP_SRC'] ? $arSection["SMALL_IMG_WEBP"]['WEBP_SRC'] : $arSection['PICTURE']['src']?>" alt="<?=$arSection['IPROPERTY_VALUES']['SECTION_META_TITLE']?>">
            </div>
            
        </section>
		<!--catalog-card-->
	</div>
	<?}?>
</div>