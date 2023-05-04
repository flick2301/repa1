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



	



	

            <!--pages-nav-->
            <div class="basic-layout__module pages-nav">

	<?if ($arResult["NavPageNomer"] > 1):?>

	
	<a class="pages-nav__fast" rel="nofollow" href="<?=$arResult["sUrlPath"]?>" target="_self">В начало</a>
	<!--<link rel="prev" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" />-->
	<ul class="pages-nav__list">
                        <li class="pages-nav__item"><a rel="nofollow" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" target="_self" class="pages-nav__link">&lt;</a>	
			
	<?else:?>
        <a href="#" rel="nofollow" target="_self" class="pages-nav__fast">В начало</a>
          <ul class="pages-nav__list">
	    <li class="pages-nav__item"><a href="#" rel="nofollow" target="_self" class="pages-nav__link">&lt;</a>	
	<?endif?>
         
                
	<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>

		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
                        <li class="pages-nav__item is-active" ><a href="#"  target="_self" class="pages-nav__link"><?=$arResult["nStartPage"]?></a></li>
		<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
                        <li class="pages-nav__item"><a  href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" target="_self" class="pages-nav__link"><?=$arResult["nStartPage"]?></a></li>
		<?else:?>
                        <li class="pages-nav__item"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>" target="_self" class="pages-nav__link"><?=$arResult["nStartPage"]?></a></li>
		<?endif?>
		<?$arResult["nStartPage"]++?>
	<?endwhile?>
                <?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
				<!--<link rel="next" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" />-->
                <li class="pages-nav__item"><a rel="nofollow" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" target="_self" class="pages-nav__link">&gt;</a></li>
                </ul>
                <a rel="nofollow" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>" target="_self" class="pages-nav__fast">В конец</a>
                <?else:?>
		<li class="pages-nav__item"><a rel="nofollow" href="#" class="pages-nav__link">&gt;</a></li>
	        </ul>
        <a rel="nofollow" href="#" target="_self" class="pages-nav__fast">В конец</a>
                <?endif?>
				
            </div>
            <!--pages-nav-->

