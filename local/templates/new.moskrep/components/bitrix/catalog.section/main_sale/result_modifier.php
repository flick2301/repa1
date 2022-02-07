<?
foreach ($arResult['ITEMS'] as $key=>$item) {
$ar_result = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $item["IBLOCK_SECTION_ID"]), false, $arSelect = array("*", "UF_*"));

if($arSection = $ar_result->GetNext()) {
    $section_picture = $arSection['PICTURE'];
}

		$arResult['ITEMS'][$key]["SMALL_IMG_WEBP"] = \Bas\Pict::getWebp($arResult['ITEMS'][$key]['PREVIEW_PICTURE'] ? $arResult['ITEMS'][$key]['PREVIEW_PICTURE'] : CFile::GetFileArray($section_picture), CFile::ResizeImageGet($arResult['ITEMS'][$key]['PREVIEW_PICTURE']['ID'] ? $arResult['ITEMS'][$key]['PREVIEW_PICTURE']['ID'] : $section_picture, array('width'=>'179px', 'height'=>'134px', BX_RESIZE_IMAGE_PROPORTIONAL, true))['src']);
		$arResult['ITEMS'][$key]["SMALL_IMG_WEBP"] = \Bas\Pict::getWebp($arResult['ITEMS'][$key]['PREVIEW_PICTURE'] ? $arResult['ITEMS'][$key]['PREVIEW_PICTURE'] : CFile::GetFileArray($section_picture));		

		//echo $arResult['ITEMS'][$key]["SMALL_IMG_WEBP"]['WEBP_SRC']."<br />";


if ($section_picture && !$arResult['ITEMS'][$key]['PREVIEW_PICTURE']) $arResult['ITEMS'][$key]['PREVIEW_PICTURE'] = CFile::ResizeImageGet($section_picture, array('width'=>'179px', 'height'=>'134px', BX_RESIZE_IMAGE_PROPORTIONAL, true));
}
?>