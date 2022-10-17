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
$uri = $APPLICATION->GetCurPage();
?>

<div class="blog">
	<div class="blog__section">
		<a class="blog__section__item <? if($uri == "/articles/") { ?>blog__section__item--active<? } ?>" <? if($uri != "/articles/") { ?>href="/articles/"<? } ?>>Все</a>
			<?
				foreach ($arResult['SECTIONS'] as &$arSection){
			?>
				<a class="blog__section__item <? if($uri == $arSection['SECTION_PAGE_URL']) { ?>blog__section__item--active<? } ?>" <? if($uri != $arSection['SECTION_PAGE_URL']) { ?>href="<?=$arSection['SECTION_PAGE_URL']; ?>"<? } ?>><?=$arSection["NAME"];?></a>
			<? 
				}
			?>
   </div>
</div>
