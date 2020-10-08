<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arParams['KEY'] = trim($arParams['KEY']);

$arParams['MAP_ID'] =
	(strlen($arParams["MAP_ID"])<=0 || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["MAP_ID"])) ?
	'MAP_'.RandString() : $arParams['MAP_ID'];

$arResult = Array();
$arResult['PLACEMARKS'] = Array();

if($arParams['IBLOCK_ID']){
    if(!CModule::IncludeModule("iblock"))
        return;

    #select fields
    $arrSelect = Array(
        "IBLOCK_ID",
        "ID",
        "NAME",
        "DETAIL_PAGE_URL",
        "PREVIEW_TEXT",
        "PREVIEW_PICTURE",
        "PROPERTY_".$arParams['ADDR_PROP_ID'],
        "PROPERTY_".$arParams['PLAN_PROP_ID'],
        "PROPERTY_".$arParams['MAP_LON_CODE'],
        "PROPERTY_".$arParams['MAP_LAT_CODE'],
        "PROPERTY_".$arParams['MARK_PROP_ID'],
    );

    #where definition
    $arrFilter = Array(
        "IBLOCK_ID" => $arParams['IBLOCK_ID'],
        "ACTIVE" =>"Y",
    );

    #select elements
    $db_res = CIBlockElement::GetList(Array(),$arrFilter,false,false,$arrSelect);
    while($item = $db_res->GetNext()){
        ?>
        
        <?
        $res = CIBlock::GetByID($item['IBLOCK_ID']);
        if($ar_res = $res->GetNext())
            $arResult["NAME"] = $ar_res['NAME'];
        $arResult['PLACEMARKS'][] = Array(
            "IBLOCK_ID"       => $item['IBLOCK_ID'],
            "ID"              => $item['ID'],
            "NAME"            => $item['NAME'],
            "PREVIEW_TEXT"    => $item['PREVIEW_TEXT'],
            "PREVIEW_PICTURE" => CFile::GetFileArray($item["PREVIEW_PICTURE"]),
            "DETAIL_PAGE_URL" => $item['DETAIL_PAGE_URL'],
            "ADDRESS"         => $item['PROPERTY_'.$arParams['ADDR_PROP_ID']."_VALUE"],
            "PLAN"            => $item['PROPERTY_'.$arParams['PLAN_PROP_ID']."_VALUE"],
            "MAP_LON"         => $item['~PROPERTY_'.$arParams['MAP_LAT_CODE']."_VALUE"],
            "MAP_LAT"         => $item['~PROPERTY_'.$arParams['MAP_LON_CODE']."_VALUE"],
            "ICON_TITLE"      => $item['~PROPERTY_'.$arParams['MARK_PROP_ID']."_VALUE"],
        );
    }
}

$arParams['INIT_MAP_LON'] = floatval($arParams['INIT_MAP_LON']);
$arParams['INIT_MAP_LON'] = $arParams['INIT_MAP_LON'] ? $arParams['INIT_MAP_LON'] : 37.64;
$arParams['INIT_MAP_LAT'] = floatval($arParams['INIT_MAP_LAT']);
$arParams['INIT_MAP_LAT'] = $arParams['INIT_MAP_LAT'] ? $arParams['INIT_MAP_LAT'] : 55.76;
$arParams['INIT_MAP_SCALE'] = intval($arParams['INIT_MAP_SCALE']);
$arParams['INIT_MAP_SCALE'] = $arParams['INIT_MAP_SCALE'] ? $arParams['INIT_MAP_SCALE'] : 10;

$arResult['ALL_MAP_TYPES'] = array('MAP', 'SATELLITE', 'HYBRID');
$arResult['ALL_MAP_OPTIONS'] = array('ENABLE_SCROLL_ZOOM' => 'ScrollZoom', 'ENABLE_DBLCLICK_ZOOM' => 'DblClickZoom', 'ENABLE_DRAGGING' => 'Dragging', 'ENABLE_HOTKEYS' => 'HotKeys', 'ENABLE_RULER' => 'Ruler');
$arResult['ALL_MAP_CONTROLS'] = array('TOOLBAR' => 'ToolBar', 'ZOOM' => 'Zoom', 'SMALLZOOM' => 'SmallZoom', 'MINIMAP' => 'MiniMap', 'TYPECONTROL' => 'TypeControl', 'SCALELINE' => 'ScaleLine');

if (!$arParams['INIT_MAP_TYPE'] || !in_array($arParams['INIT_MAP_TYPE'], $arResult['ALL_MAP_TYPES']))
	$arParams['INIT_MAP_TYPE'] = 'MAP';

if (!is_array($arParams['OPTIONS']))
	$arParams['OPTIONS'] = array('ENABLE_SCROLL_ZOOM', 'ENABLE_DBLCLICK_ZOOM', 'ENABLE_DRAGGING');
else
{
	foreach ($arParams['OPTIONS'] as $key => $option)
	{
		if (!$arResult['ALL_MAP_OPTIONS'][$option])
			unset($arParams['OPTIONS'][$key]);
	}

	$arParams['OPTIONS'] = array_values($arParams['OPTIONS']);
}

if (!is_array($arParams['CONTROLS']))
	$arParams['CONTROLS'] = array('TOOLBAR', 'ZOOM', 'MINIMAP', 'TYPECONTROL', 'SCALELINE');
else
{
	foreach ($arParams['CONTROLS'] as $key => $control)
	{
		if (!$arResult['ALL_MAP_CONTROLS'][$control])
			unset($arParams['CONTROLS'][$key]);
	}

	$arParams['CONTROLS'] = array_values($arParams['CONTROLS']);
}

$arParams['MAP_WIDTH'] = trim($arParams['MAP_WIDTH']);
if (ToUpper($arParams['MAP_WIDTH']) != 'AUTO' && substr($arParams['MAP_WIDTH'], -1, 1) != '%')
{
	$arParams['MAP_WIDTH'] = intval($arParams['MAP_WIDTH']);
	if ($arParams['MAP_WIDTH'] <= 0) $arParams['MAP_WIDTH'] = 600;
	#$arParams['MAP_WIDTH'] .= 'px';
}

$arParams['MAP_HEIGHT'] = trim($arParams['MAP_HEIGHT']);
if (substr($arParams['MAP_HEIGHT'], -1, 1) != '%')
{
	$arParams['MAP_HEIGHT'] = intval($arParams['MAP_HEIGHT']);
	if ($arParams['MAP_HEIGHT'] <= 0) $arParams['MAP_HEIGHT'] = 500;
	#$arParams['MAP_HEIGHT'] .= 'px';
}

$this->IncludeComponentTemplate();
?>

