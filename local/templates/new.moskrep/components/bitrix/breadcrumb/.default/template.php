<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Context;

$server = Context::getCurrent()->getServer();

global $APPLICATION;
global $USER;

$url = $APPLICATION->GetCurPage();
$arCode = explode("/", $url);
$arCode = array_diff($arCode, array(''));
$url_code_ar = $arCode;
$arCode = array_reverse($arCode);


if(empty($arResult))
	return "";

$strReturn = '';

$sorting_index = 0;

    $arFilter = array(
        "IBLOCK_TYPE" => 'sorting',
        "CODE" => $arCode[0]
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
        //$arResult['SORT_BLOCK'] = 'Y';
		
		$nav = CIBlockSection::GetNavChain(false, $arFields["IBLOCK_SECTION_ID"]);
		while($arNav = $nav->GetNext())
		{
				
			$res_sect = CIBlockSection::GetList(array("SORT"=>"ASC"), array("IBLOCK_ID"=>SORTING_IBLOCK_ID, 'ID'=>$arNav['ID']), false, Array('CODE', 'UF_DIRECTORY'));
			if($arSect = $res_sect->GetNext()){
					
				if($arSect['UF_DIRECTORY']){
						
					$arFilter = array(
						"IBLOCK_TYPE" => 'catalog',
						"ID" => $arSect['UF_DIRECTORY']
					);
					$id_ar = CIBlockSection::GetList(array('SORT' => 'asc'),$arFilter);
					$id_sec = $id_ar->GetNext();

					$nav2 = CIBlockSection::GetNavChain(false, $id_sec['ID']);
					$link='/';

					while($nav_item=$nav2->Fetch()){
						$link .=$nav_item['CODE'].'/';
						$arResult[] = array('TITLE'=>$nav_item['NAME'], 'LINK' => $link);
					}
					break;
							
				}	
			}
		}
    }elseif($sorting_index!=0){
        /*$arFilter = array(
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
		*/
    }

if(count($arResult_sort)){
    $arResult = array_merge($arResult, array_reverse($arResult_sort));
}








//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()


$strReturn .= '<ul itemscope itemtype="https://schema.org/BreadcrumbList" class="crumbs-nav">';


$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	//$arrow = ($index > 0? ' / ' : '');

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= $arrow.'
			<li itemprop="itemListElement" itemscope
          itemtype="https://schema.org/ListItem" class="crumbs-nav__item">
				
				<a itemprop="item" title="'.$title.'" href="'.$arResult[$index]["LINK"].'" itemtype="https://schema.org/WebPage" itemid="https://'.$server->getHttpHost().$arResult[$index]["LINK"].'" target="_self"  class="crumbs-nav__page crumbs-nav__page--link">
				<span itemprop="name">
					'.$title.'
				</span>
				<meta itemprop="position" content="'.($index + 1).'" />
				</a>
				
			</li>';
	}
	else
	{
		$strReturn .= $arrow.'
			<li itemprop="itemListElement" itemscope
          itemtype="https://schema.org/ListItem" class="crumbs-nav__item">
				
				<p itemprop="name" class="crumbs-nav__page crumbs-nav__page--last">'.$title.'</p>
				<meta itemprop="position" content="'.($index + 1).'" />				
			</li>';
	}
}

$strReturn .= '</ul>';

return $strReturn;
