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

?><ul class="popular-categories__items"><?
			foreach ($arResult['SECTIONS'] as &$arSection)
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
				?><li class="popular-categories__item">
				<a
					href="<? echo $arSection['SECTION_PAGE_URL']; ?>"
					class="popular-categories__link"
					
					title="<? echo $arSection['NAME']; ?>"
				>
                                    <div class="popular-categories__img"><img src="<?=$arSection['PICTURE']["SRC"]?>" width="168" alt=""></div>
                                    <span class="popular-categories__title"><? echo $arSection['NAME']; ?></span>
                                </a>
				<?
			}
                        ?></ul><?
			unset($arSection);
			