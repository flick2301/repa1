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


<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>


            <!--content-feed-->
            <div class="basic-layout__module content-feed">
               <div class="content-feed__list">
			   
<?foreach($arResult["ITEMS"] as $arItem):?>	
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
                  <div class="content-feed__item">
                     <!--article-card-->
                     <section class="article-card" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <div class="article-card__about">
                           <?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?><h3 class="article-card__title">
						   <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?><a class="article-card__link" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?endif;?>
						   <?=$arItem["NAME"]?>
						   <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?></a><?endif;?>
						   </h3><?endif;?>
                           <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?><p class="article-card__date">
						   <time datetime="<?echo preg_replace("/([0-9]{2})\.([0-9]{2})\.([0-9]{4})/", "\${3}-\${2}-\${1}", $arItem["DISPLAY_ACTIVE_FROM"])?> 10:42">
						  <?echo $arItem["DISPLAY_ACTIVE_FROM"]?></time>
						  </p><?endif;?>
                           <p class="article-card__desc"><?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<?echo $arItem["PREVIEW_TEXT"];?>
		<?endif;?></p>
                           <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
						   <a class="main-button main-button--mini article-card__button" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
						   <?endif;?>
						   Читать статью
						   <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
						   </a>
						   <?endif;?>
                        </div>
                        <div class="article-card__cover">
                           <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
						   <img class="article-card__image" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="301" height="226" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
						   <?endif;?>
                        </div>
                     </section>
                     <!--article-card-->
                  </div>	
<?endforeach;?>	   

               </div>
            </div>
			<!--content-feed-->
			
			
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>			