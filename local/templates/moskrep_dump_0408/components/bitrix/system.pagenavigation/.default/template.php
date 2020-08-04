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

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryString = str_replace('bxajaxid='.$_REQUEST['bxajaxid'], '', $strNavQueryString);

$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
$strNavQueryStringFull = str_replace('bxajaxid='.$_REQUEST['bxajaxid'], '', $strNavQueryStringFull);
?>



	



	
<div style='display:none;'><?=$strNavQueryString?></div>
	<nav class="catalog-pagination">

	<?if ($arResult["NavPageNomer"] > 1):?>

	
	<a rel="nofollow" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1" target="_self" class="catalog-pagination__first">В начало</a>
									
	<ul class="catalog-pagination__items">
                        <li class="catalog-pagination__item"><a rel="nofollow" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" target="_self" class="catalog-pagination__link catalog-pagination__link--prev"></a>	
			
	<?else:?>
        <a href="#" rel="nofollow" target="_self" class="catalog-pagination__first">В начало</a>
          <ul class="catalog-pagination__items">
	    <li class="catalog-pagination__item"><a href="#" rel="nofollow" target="_self" class="catalog-pagination__link catalog-pagination__link--prev"></a>	
	<?endif?>
         
                
	<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>

		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
                        <li class="catalog-pagination__item" ><a href="#"  target="_self" class="catalog-pagination__link active"><?=$arResult["nStartPage"]?></a></li>
		<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
                        <li class="catalog-pagination__item"><a  href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" target="_self" class="catalog-pagination__link"><?=$arResult["nStartPage"]?></a></li>
		<?else:?>
                        <li class="catalog-pagination__item"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>" target="_self" class="catalog-pagination__link"><?=$arResult["nStartPage"]?></a></li>
		<?endif?>
		<?$arResult["nStartPage"]++?>
	<?endwhile?>
                <?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
                <li class="catalog-pagination__item"><a rel="nofollow" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" target="_self" class="catalog-pagination__link catalog-pagination__link--next"></a></li>
                </ul>
                <a rel="nofollow" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>" target="_self" class="catalog-pagination__last">В конец</a>
                <?else:?>
		<li class="catalog-pagination__item"><a rel="nofollow" href="#" class="catalog-pagination__link catalog-pagination__link--next"></a></li>
	        </ul>
        <a rel="nofollow" href="#" target="_self" class="catalog-pagination__last">В конец</a>
                <?endif?>
                

	





</nav>

