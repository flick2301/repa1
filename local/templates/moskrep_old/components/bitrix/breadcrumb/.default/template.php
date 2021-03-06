<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();



global $APPLICATION;

$url = $APPLICATION->GetCurPage();
$arCode = explode("/", $url);
$arCode = array_diff($arCode, array(''));
$url_code_ar = $arCode;
$arCode = array_reverse($arCode);


if(empty($arResult))
	return "";

$strReturn = '';

$sorting_index = 0;
foreach($arCode as $code){
    $arFilter = array(
        "IBLOCK_TYPE" => 'sorting',
        "CODE" => $code
    );
    $ar_element = CIBlockElement::GetList(array('SORT' => 'asc'),$arFilter, array('*'));
    if($item_element = $ar_element->GetNextElement()){

        if($sorting_index==0){$arResult=array();}
        if($sorting_index==0){$link = '';}else{
            array_pop($url_code_ar);
            $link='/'.implode("/", $url_code_ar);
            
        }
        $sorting_index++;


        $arProps = $item_element->GetProperties();
        $arFields = $item_element->GetFields();


        $arResult_sort[] = array('TITLE'=>$arProps['H1']['VALUE'], 'LINK' => $link);
        $arResult['SORT_BLOCK'] = 'Y';
    }elseif($sorting_index!=0){
        $arFilter = array(
            "IBLOCK_TYPE" => 'catalog',
            "CODE" => $code
        );
        $id_ar = CIBlockSection::GetList(array('SORT' => 'asc'),$arFilter);
        $id_sec = $id_ar->GetNext();

        $nav = CIBlockSection::GetNavChain(false, $id_sec['ID']);
        $link='/';

        while($nav_item=$nav->Fetch()){
            $link .=$nav_item['CODE'].'/';
            $arResult[] = array('TITLE'=>$nav_item['NAME'], 'LINK' => $link);
        }
        ?><?
        break;
    }
}
if(count($arResult_sort)){
    $arResult = array_merge($arResult, array_reverse($arResult_sort));
}








//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()


$strReturn .= '<ul itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">';


$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arrow = ($index > 0? ' / ' : '');

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= $arrow.'
			<li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem" class="breadcrumbs__item">
				
				<a itemprop="item" title="'.$title.'" href="'.$arResult[$index]["LINK"].'" target="_self"  class="breadcrumbs__link">
					<span itemprop="name">'.$title.'</span>
				</a>
				
			</li>';
	}
	else
	{
		$strReturn .= $arrow.'
			<li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem" class="breadcrumbs__item">
				
				<span itemprop="name" class="breadcrumbs__last">'.$title.'</span>
				
			</li>';
	}
}

$strReturn .= '</ul>';

return $strReturn;
