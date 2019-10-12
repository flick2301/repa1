<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @var array $arParams
 * @var array $arResult
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @global CDatabase $DB
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $templateFile
 * @var string $templateFolder
 * @var string $componentPath
 * @var CBitrixComponent $component
 */
$this->setFrameMode(true);


?>

<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "sale", array()); ?>
            <? $APPLICATION->IncludeComponent('bitrix:catalog.section.list', 'sale1', [
                'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                'COUNT_ELEMENTS' => $arParams['SECTION_COUNT_ELEMENTS'],
                'TOP_DEPTH' => $arParams['SECTION_TOP_DEPTH'],
                'SECTION_URL' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['section'],
                "SECTION_USER_FIELDS" => array("UF_PIC",""),
                "SECTION_ID" => SALE_SECTION_ID,
                'HIDE_SECTION_NAME' => (isset($arParams['SECTIONS_HIDE_SECTION_NAME']) ? $arParams['SECTIONS_HIDE_SECTION_NAME'] : 'N'),
                'ADD_SECTIONS_CHAIN' => "Y",
                'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                'CACHE_TIME' => $arParams['CACHE_TIME'],
                'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
            ], $component, ['HIDE_ICONS' => 'Y']); ?>
       