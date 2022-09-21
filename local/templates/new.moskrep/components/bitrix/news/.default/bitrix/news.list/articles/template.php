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
            <div class="basic-layout__module simple-article">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "articles_menu",
                    array(
                        "ROOT_MENU_TYPE" => "articles",
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "articles",
                        "USE_EXT" => "Y",
                        "COMPONENT_TEMPLATE" => "articles_menu",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "N",
                        "MENU_CACHE_GET_VARS" => array(
                        ),
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",

                    ),
                    false
                );?>

                <div class="articles__list">
<?foreach($arResult["ITEMS"] as $arItem):?>	
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
                  <div class="articles__box">
                     <!--article-card-->
                      <a class="articles__top" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                          <!-- articles__category style заполнятьеся из двух дополнительных свойств раздела цвет фона и цвет текса -->
                          <div class="articles__category" style="background-color:#552FEC;color:#fff;"><?=$arResult['SECTIONS'][$arItem["IBLOCK_SECTION_ID"]]["NAME"];?></div>
                          <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
                              <img class="articles__img" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
                          <?endif;?>


                          <!-- Сделать у элмента два свойства фото и видео, при отмечении которых появляеться соотвествующая иокнка, если они оба пустые блок не выводить -->
                          <div class="articles__options">
                              <?php if(in_array('photo', $arResult['PROPERTIES'][$arItem['ID']]['photo_and_video']['VALUE_XML_ID']))
                                  {
                                      ?>
                               <!-- Появляется если отмечено галка фото -->
                              <div class="articles__options__item">
                                  <img src="/images/gallery.svg" alt="Фотогалерея" title="Фотогалерея">
                              </div>
                              <?php } ?>
                              <?php if(in_array('video', $arResult['PROPERTIES'][$arItem['ID']]['photo_and_video']['VALUE_XML_ID']))
                                  {
                                      ?>
                              <!-- Появляется если отмечено галка видео -->
                              <div class="articles__options__item">
                                  <img src="/images/video.svg" alt="Видео" title="Видео">
                              </div>
                                  <?php } ?>
                          </div>
                      </a>
                      <div class="articles__bottom"><a class="articles__name" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"];?></a>
                          <div class="articles__desc">
                              <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
                                  <?echo strip_tags($arItem["PREVIEW_TEXT"]);?>
                              <?endif;?>
                          </div>
                          <div class="articles__botside">
                              <div class="articles__data"><?=$arItem["DISPLAY_ACTIVE_FROM"];?></div>
                              <div class="articles__view"><?=$arResult['SHOW_COUNTERS'][$arItem['ID']];?></div>
                          </div>
                      </div>

                     <!--article-card-->
                  </div>	
<?endforeach;?>	   

               </div>
            </div>
			<!--content-feed-->
			
			
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>			