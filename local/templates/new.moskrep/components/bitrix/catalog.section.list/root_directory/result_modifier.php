<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult['SECTIONS'] as $key=>$arSection){
    
    $file = CFile::ResizeImageGet($arSection['DETAIL_PICTURE'] ? $arSection['DETAIL_PICTURE'] :  $arSection['PICTURE']['ID'], array('width'=>$arParams['LIST_PREV_PIC_W_L2'], 'height'=>$arParams['LIST_PREV_PIC_H_L2']), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	
		if ($arSection['DETAIL_PICTURE'])			
			$file['src'] = CFile::GetPath($arSection['DETAIL_PICTURE']);	
    
    if($file['src']):
        $arResult['SECTIONS'][$key]['PICTURE'] = $file;
    else:

		$arSelect = Array("DETAIL_PICTURE");
		$arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "IBLOCK_SECTION_ID"=>$arResult['SECTIONS'][$key]['ID'], "!DETAIL_PICTURE"=>false);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
		if($ob = $res->GetNextElement())
		{	
			$arFields = $ob->GetFields();
			$arResult['SECTIONS'][$key]['PICTURE'] = CFile::ResizeImageGet($arFields['DETAIL_PICTURE'], array('width'=>$arParams['LIST_PREV_PIC_W_L2'], 'height'=>$arParams['LIST_PREV_PIC_H_L2']), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		}	
	
        if (!$arResult['SECTIONS'][$key]['PICTURE']) $arResult['SECTIONS'][$key]['PICTURE']['src'] = '/images/no_image_sec.jpg';  
		
    endif;
	if($arSection['ID']==2312)
		unset($arResult['SECTIONS'][$key]);
    
    
}
?>