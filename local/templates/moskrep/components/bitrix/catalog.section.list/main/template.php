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


            <div class="sales-slider__list" id="sales-slider__list">
<?foreach ($arResult['SECTIONS'] as &$arSection)
			{
				
                                
				if (true === $arSection['PICTURE'])
					$arSection['PICTURE'] = array(
						'SRC' => $arCurView['EMPTY_IMG'],
						'ALT' => (
							'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							: $arSection["NAME"]
						),
						'TITLE' => (
							'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							: $arSection["NAME"]
						)
					);
?>			
               <div class="sales-slider__item">
                  <!--catalog-card-->
                  <section class="catalog-card catalog-card--lite">
                     <h3 class="catalog-card__title"><a class="catalog-card__link" href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a></h3>
                     <div class="catalog-card__cover">
                        <img class="catalog-card__image" src="<?=$arSection['PICTURE']["SRC"]?>" width="165" height="124" alt="">
                     </div>
                  </section>
                  <!--catalog-card-->
               </div>
			<?} unset($arSection);?>			   
			   </div>

