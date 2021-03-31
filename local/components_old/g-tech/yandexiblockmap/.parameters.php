<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<style>
a{
  color: #666666;
  text-decoration: underline;
}
a:hover{
  color: #840a2d;
}

</style>
<?
$MAP_KEY = '';
$strMapKeys = COPtion::GetOptionString('fileman', 'map_yandex_keys');

$strDomain = $_SERVER['HTTP_HOST'];
$wwwPos = strpos($strDomian, 'www.');
if ($wwwPos === 0)
	$strDomain = substr($strDomain, 4);

if ($strMapKeys)
{
	$arMapKeys = unserialize($strMapKeys);

	if (array_key_exists($strDomain, $arMapKeys))
		$MAP_KEY = $arMapKeys[$strDomain];
}

if(!CModule::IncludeModule("iblock"))
	return;

$arTypesEx = CIBlockParameters::GetIBlockTypes(Array("-"=>" "));

$arIBlocks = Array();
$db_iblock = CIBlock::GetList(Array("SORT"=>"ASC"), Array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:"")));
while($arRes = $db_iblock->Fetch())
	$arIBlocks[$arRes["ID"]] = $arRes["NAME"];

$arProps = Array();
$arProps[] = "";
$db_props = CIBlockProperty::GetList(Array(),Array("IBLOCK_ID"=>$arCurrentValues["IBLOCK_ID"]));
while($arProp = $db_props->Fetch()){
    $arProps[$arProp["ID"]] = $arProp["NAME"];
}


$arComponentParameters = array(
	'GROUPS' => array(
        'YMAP_PARAM' => Array(
            'NAME' => GetMessage("GROUP_MAP_PARAM_NAME"),
        ),
	),
	'PARAMETERS' => array(
        "IBLOCK_TYPE" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx,
			"DEFAULT" => "news",
			"REFRESH" => "Y",
		),

		"IBLOCK_ID" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"DEFAULT" => '={$_REQUEST["ID"]}',
			"ADDITIONAL_VALUES" => "Y",
			"REFRESH" => "Y",
		),

		'KEY' => array(
			'NAME' => GetMessage('MYMS_PARAM_KEY'),
			'TYPE' => 'STRING',
			'PARENT' => 'YMAP_PARAM',
			'DEFAULT' => $MAP_KEY,
		),

		'INIT_MAP_TYPE' => array(
			'NAME' => GetMessage('MYMS_PARAM_INIT_MAP_TYPE'),
			'TYPE' => 'LIST',
			'VALUES' => array(
				'MAP' => GetMessage('MYMS_PARAM_INIT_MAP_TYPE_MAP'),
				'SATELLITE' => GetMessage('MYMS_PARAM_INIT_MAP_TYPE_SATELLITE'),
				'HYBRID' => GetMessage('MYMS_PARAM_INIT_MAP_TYPE_HYBRID')
			),
			'DEFAULT' => 'MAP',
			'ADDITIONAL_VALUES' => 'N',
			'PARENT' => 'YMAP_PARAM',
		),

		'MAP_WIDTH' => array(
			'NAME' => GetMessage('MYMS_PARAM_MAP_WIDTH'),
			'TYPE' => 'STRING',
			'DEFAULT' => '600',
			'PARENT' => 'YMAP_PARAM',
		),

		'MAP_HEIGHT' => array(
			'NAME' => GetMessage('MYMS_PARAM_MAP_HEIGHT'),
			'TYPE' => 'STRING',
			'DEFAULT' => '500',
			'PARENT' => 'YMAP_PARAM',
		),

		'CONTROLS' => array(
			'NAME' => GetMessage('MYMS_PARAM_CONTROLS'),
			'TYPE' => 'LIST',
			'MULTIPLE' => 'Y',
			'VALUES' => array(
				'TOOLBAR' => GetMessage('MYMS_PARAM_CONTROLS_TOOLBAR'),
				'ZOOM' => GetMessage('MYMS_PARAM_CONTROLS_ZOOM'),
				'SMALLZOOM' => GetMessage('MYMS_PARAM_CONTROLS_SMALLZOOM'),
				'MINIMAP' => GetMessage('MYMS_PARAM_CONTROLS_MINIMAP'),
				'TYPECONTROL' => GetMessage('MYMS_PARAM_CONTROLS_TYPECONTROL'),
				'SCALELINE' => GetMessage('MYMS_PARAM_CONTROLS_SCALELINE')
			),

			'DEFAULT' => array('TOOLBAR', 'ZOOM', 'MINIMAP', 'TYPECONTROL', 'SCALELINE'),
			'PARENT' => 'YMAP_PARAM',
		),

		'OPTIONS' => array(
			'NAME' => GetMessage('MYMS_PARAM_OPTIONS'),
			'TYPE' => 'LIST',
			'MULTIPLE' => 'Y',
			'VALUES' => array(
				'ENABLE_SCROLL_ZOOM' => GetMessage('MYMS_PARAM_OPTIONS_ENABLE_SCROLL_ZOOM'),
				'ENABLE_DBLCLICK_ZOOM' => GetMessage('MYMS_PARAM_OPTIONS_ENABLE_DBLCLICK_ZOOM'),
				'ENABLE_DRAGGING' => GetMessage('MYMS_PARAM_OPTIONS_ENABLE_DRAGGING'),
				'ENABLE_HOTKEYS' => GetMessage('MYMS_PARAM_OPTIONS_ENABLE_HOTKEYS'),
				/*'ENABLE_RULER' => GetMessage('MYMS_PARAM_OPTIONS_ENABLE_RULER'),*/
			),

			'DEFAULT' => array('ENABLE_SCROLL_ZOOM', 'ENABLE_DBLCLICK_ZOOM', 'ENABLE_DRAGGING'),
			'PARENT' => 'YMAP_PARAM',
		),

		'MAP_ID' => array(
			'NAME' => GetMessage('MYMS_PARAM_MAP_ID'),
			'TYPE' => 'STRING',
			'DEFAULT' => '',
			'PARENT' => 'YMAP_PARAM',
		),

        'PLACEICON' => Array(
	        "PARENT" => "YMAP_PARAM",
	        "NAME" => GetMessage('MYMS_PARAM_PLACEMARK_IMAGE'),
	        "TYPE" => "FILE",
	        "FD_TARGET" => "F",
	        "FD_EXT" => "png,gif,jpg,jpeg",
	        "FD_UPLOAD" => true,
	        "FD_USE_MEDIALIB" => true,
	        "FD_MEDIALIB_TYPES" => Array('image'),
	        "DEFAULT" => '',
	        "HIDDEN" => $hidden,
        ),

        'TEMPLATE_EDIT' => array(
			'NAME' => GetMessage('MYMS_PARAM_PLACEMARK_STYLE'),
			'TYPE' => 'CUSTOM',
			'JS_FILE' => '/bitrix/components/g-tech/yandexiblockmap/settings/settings.js',
			'JS_EVENT' => 'OnYandexMapSettingsEdit',
			'JS_DATA' => 'ru||'.GetMessage('MYMS_PARAM_CHECK').'||||'.GetMessage('MYMS_PARAM_GET_KEY').'||'.GetMessage('MYMS_PARAM_YA_KEY_URL'),
			'DEFAULT' => '',
			'PARENT' => 'YMAP_PARAM',
		),

        'MAP_LON_CODE' => Array(
            'NAME' => GetMessage("MYMS_PARAM_LON"),
            'TYPE' => 'LIST',
			'DEFAULT' => '',
            'VALUES' => $arProps,
            'PARENT' => 'YMAP_PARAM',
        ),

        'MAP_LAT_CODE' => Array(
            'NAME' => GetMessage("MYMS_PARAM_LAT"),
            'TYPE' => 'LIST',
			'DEFAULT' => '',
            'VALUES' => $arProps,
            'PARENT' => 'YMAP_PARAM',
        ),

        'ADDR_PROP_ID' => array(
			'NAME' => GetMessage("MYMS_PARAM_ADDR_PROP"),
			'TYPE' => 'LIST',
			'DEFAULT' => '',
            'VALUES' => $arProps,
			'PARENT' => 'YMAP_PARAM',
		),

        'PLAN_PROP_ID' => array(
			'NAME' => GetMessage("MYMS_PARAM_PLAN_PROP"),
			'TYPE' => 'LIST',
			'DEFAULT' => '',
            'VALUES' => $arProps,
			'PARENT' => 'YMAP_PARAM',
		),

        'MARK_PROP_ID' => Array(
            'NAME' => GetMessage('MYMS_PARAM_MARK_INNER'),
            'TYPE' => 'LIST',
            'VALUES' => $arProps,
            'PARENT' => 'YMAP_PARAM',
        ),

        'DIPLAY_PREVIEW_PICTURE' => Array(
            'NAME' => GetMessage("MYMS_PARAM_DISPLAY_PREVIEW"),
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => '',
            'PARENT' => 'YMAP_PARAM',
        ),

        'DISPLAY_ITEM_LIST' => Array(
            'NAME' => GetMessage("MYMS_PARAM_DISPLAY_ITEM_LIST"),
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => '',
            'PARENT' => 'YMAP_PARAM',
        ),

        'ITEM_LIST_ROW_COUNT' => Array(
            'NAME' => GetMessage("MYMS_PARAM_ITEM_LIST_ROW_COUNT"),
            'TYPE' => 'INPUT',
            'DEFAULT' => '',
            'PARENT' => 'YMAP_PARAM',
        ),

        'INCLUDE_FANCYBOX' => Array(
            'NAME' => GetMessage("MYMS_PARAM_INCLUDE_FANCYBOX"),
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => '',
            'PARENT' => 'YMAP_PARAM',
        ),
	),
);
?>