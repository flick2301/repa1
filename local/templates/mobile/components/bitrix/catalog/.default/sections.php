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


<h1 class="s28-title">Корень каталога</h1>
<ul class='pay-choice pay-choice--padding'>
            <? $APPLICATION->IncludeComponent('bitrix:catalog.section.list', 'main_catalog', [
                'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                'COUNT_ELEMENTS' => $arParams['SECTION_COUNT_ELEMENTS'],
                'TOP_DEPTH' => $arParams['SECTION_TOP_DEPTH'],
                'SECTION_URL' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['section'],
                "SECTION_USER_FIELDS" => array("UF_PIC",""),
                'HIDE_SECTION_NAME' => (isset($arParams['SECTIONS_HIDE_SECTION_NAME']) ? $arParams['SECTIONS_HIDE_SECTION_NAME'] : 'N'),
                'ADD_SECTIONS_CHAIN' => (isset($arParams['ADD_SECTIONS_CHAIN']) ? $arParams['ADD_SECTIONS_CHAIN'] : ''),
                'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                'CACHE_TIME' => $arParams['CACHE_TIME'],
                'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
            ], $component, ['HIDE_ICONS' => 'Y']); ?>
</ul>
 <div class="content-feedback">
		<?$rsSites = CSite::GetByID("s1");
         $arSite = $rsSites->Fetch();?>
        <?$APPLICATION->IncludeComponent(
	"d7:main.feedback",
	"",
	Array(
		"EMAIL_TO" => $arSite["EMAIL"],
		"EVENT_MESSAGE_ID" => array("7"),
		"OK_TEXT" => "Спасибо, ваше сообщение отправлено.",
		"REQUIRED_FIELDS" => array("NAME","EMAIL","MESSAGE"),
		"USE_CAPTCHA" => "N",
                "MOBILE_VERSION" => "Y"
	)
);?> 
	</div>      