<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

$url = $APPLICATION->GetCurPage();
$arCode = explode("/", $url);

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';


$arFilter = array(
    "IBLOCK_TYPE" => 'sorting',
    "CODE" => $arCode[count($arCode)-2]
    );
$ar_element = CIBlockElement::GetList(array('SORT' => 'asc'),$arFilter, array('*'));

if($item_element = $ar_element->GetNextElement()){
    
    
        $arFilter = array(
                        "IBLOCK_TYPE" => 'catalog',
                        "CODE" => $arCode[count($arCode)-3]
                    );
        $id_ar = CIBlockSection::GetList(array('SORT' => 'asc'),$arFilter);
        $id_sec = $id_ar->GetNext();
        $arResult[] = array('TITLE'=>$id_sec['NAME'], 'LINK' => $id_sec['SECTION_PAGE_URL']);
        $arResult[]= array('TITLE'=>$GLOBALS['UF_H1'], 'LINK'=>$url);
    
    
    
    $arResult['SORT_BLOCK'] = 'Y';
}

//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()





	


$itemSize = count($arResult);
if($itemSize>2):
    $link_index=$itemSize-3;
else:
    $link_index=$itemSize-2; 
endif;
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arrow = ($index > 0? ' / ' : '');
        

	if($arResult[$index]["LINK"] <> "" && $index == $link_index)
	{
		$strReturn = '<a href="'.$arResult[$index]["LINK"].'" class="back-link" data='.$index.'>'.$title.'</a>';
        }
	
}


return $strReturn;
