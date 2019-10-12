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
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>



	



	

	<nav class="catalog-pagination">

	<?if ($arResult["NavPageNomer"] > 1):?>

	
	
									
	<ul class="catalog-pagination__items">
                        <li class="catalog-pagination__item"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" class="catalog-pagination__link catalog-pagination__link--prev"></a>	
			
	<?else:?>
        
          <ul class="catalog-pagination__items">
	    <li class="catalog-pagination__item"><a href="#" class="catalog-pagination__link catalog-pagination__link--prev"></a>	
	<?endif?>
         
                
	<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>

		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
                        <li class="catalog-pagination__item" ><a href="#" class="catalog-pagination__link active"><?=$arResult["nStartPage"]?></a></li>
		<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
                        <li class="catalog-pagination__item"><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="catalog-pagination__link"><?=$arResult["nStartPage"]?></a></li>
		<?else:?>
                        <li class="catalog-pagination__item"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>" class="catalog-pagination__link"><?=$arResult["nStartPage"]?></a></li>
		<?endif?>
		<?$arResult["nStartPage"]++?>
	<?endwhile?>
                <?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
                <li class="catalog-pagination__item"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" class="catalog-pagination__link catalog-pagination__link--next"></a></li>
                </ul>
                
                <?else:?>
		<li class="catalog-pagination__item"><a href="#" class="catalog-pagination__link catalog-pagination__link--next"></a></li>
	        </ul>
        
                <?endif?>
                

	





</nav>

