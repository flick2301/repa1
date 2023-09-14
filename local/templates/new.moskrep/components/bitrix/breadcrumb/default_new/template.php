<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Context;

$server = Context::getCurrent()->getServer();

global $APPLICATION;
global $USER;
global $sec_builder;

$url = $APPLICATION->GetCurPage();
$arCode = explode("/", $url);
$arCode = array_diff($arCode, array(''));
$url_code_ar = $arCode;
$arCode = array_reverse($arCode);

if(empty($arResult))
	return "";

$strReturn = '';
$url_of_page = $arResult[count($arResult)-1]['LINK'];
$url_of_page_from_builder = $sec_builder->curSection['SECTION_PAGE_URL'];
$code = $sec_builder->curSorting[0]['CODE'] ?? $arCode[0];

if($url_of_page != $url_of_page_from_builder) {
//БЛОК СОСТАВЛЕНИЯ НАВИГАЦИОННОЙ ЦЕПОЧКИ ДЛЯ ВИРТУАЛЬНОГО(НЕСУЩЕСТВУЮЩЕГО) КАТАЛОГА( ПРИСОЕДИНЕННОЙ К КАТАЛОГУ ИЗ 1С)
    $arFilter = array("IBLOCK_ID" => SORTING_IBLOCK_ID, 'IBLOCK_SECTION_ID' => $sec_builder->curSorting[0]['IBLOCK_SECTION_ID'], "=CODE" => $code);
    $ar_element = CIBlockElement::GetList(array('SORT' => 'asc'), $arFilter, array('*'));

    if ($item_element = $ar_element->GetNextElement()) {

        if ($sorting_index == 0) {
            $arResult = array();
            $link = '';
        } else {
            array_pop($url_code_ar);
            $link = '/' . implode("/", $url_code_ar);

        }
        $sorting_index++;


        $arProps = $item_element->GetProperties();
        $arFields = $item_element->GetFields();


        $arResult_sort[] = array('TITLE' => $arProps['H1']['VALUE'], 'LINK' => $link);


        $nav = CIBlockSection::GetNavChain(false, $arFields["IBLOCK_SECTION_ID"]);
        while ($arNav = $nav->GetNext()) {

            $res_sect = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => SORTING_IBLOCK_ID, 'ID' => $arNav['ID']), false, array('CODE', 'UF_DIRECTORY'));
            if ($arSect = $res_sect->GetNext()) {

                if ($arSect['UF_DIRECTORY']) {
                    //ПОДКЛЮЧАЕМ ЦЕПОЧКУ КАТАЛОГА 1С
                    $arFilter = array(
                        "IBLOCK_TYPE" => 'catalog',
                        "ID" => $arSect['UF_DIRECTORY']
                    );
                    $id_ar = CIBlockSection::GetList(array('SORT' => 'asc'), $arFilter);
                    $id_sec = $id_ar->GetNext();

                    $nav2 = CIBlockSection::GetNavChain(false, $id_sec['ID']);
                    $link = '/';

                    while ($nav_item = $nav2->Fetch()) {
                        $link .= $nav_item['CODE'] . '/';
                        $arResult[] = array('TITLE' => $nav_item['NAME'], 'LINK' => $link);
                    }


                }
            }
        }
    }
    if (count($arResult_sort)) {
        $arResult = array_merge($arResult, array_reverse($arResult_sort));
    }
}
//БЛОК СОСТАВЛЕНИЯ НАВИГАЦИОННОЙ ЦЕПОЧКИ ДЛЯ ВИРТУАЛЬНОГО(НЕСУЩЕСТВУЮЩЕГО) КАТАЛОГА (КОНЕЦ)



//ДЛЯ РАСПРОДАЖИ УБИРАЕМ ЛИШНЮЮ ХЛЕБНУЮ КРОШКУ (КРЕПЕЖ)
foreach($arResult as $key=>$bread)
{
	if($bread['TITLE']=="Распродажа крепежа")
	{
		unset($arResult[$key+1]);
		$arResult=array_values($arResult);
		break;
	}
}
//ДЛЯ РАСПРОДАЖИ УБИРАЕМ ЛИШНЮЮ ХЛЕБНУЮ КРОШКУ (КРЕПЕЖ) (КОНЕЦ)


//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()


$strReturn .= '<ul class="crumbs-nav">';

$schema = '<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "BreadcrumbList", 
  "itemListElement": [';

$itemSize = count($arResult);


for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	//$arrow = ($index > 0? ' / ' : '');

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= $arrow.'
			<li class="crumbs-nav__item">
				
				<a  title="'.$title.'" href="'.$arResult[$index]["LINK"].'" target="_self"  class="crumbs-nav__page crumbs-nav__page--link">
				<span>
					'.$title.'
				</span>
				<meta  content="'.($index + 1).'" />
				</a>
				
			</li>';
			$pos++;
			$schema .= '{
    "@type": "ListItem", 
    "position": '.$pos.', 
    "name": "'.$title.'",
    "item": "'.$arResult[$index]["LINK"].'"  
  },';
	}
	else
	{
		$strReturn .= $arrow.'
			<li class="crumbs-nav__item">
				
				<p  class="crumbs-nav__page crumbs-nav__page--last">'.$title.'</p>
				<meta content="'.($index + 1).'" />				
			</li>';
			$pos++;
			$schema .= '{
    "@type": "ListItem", 
    "position": '.$pos.', 
    "name": "'.$title.'",
    "item": "'.$arResult[$index]["LINK"].'"  
  },';
	}
}

$strReturn .= '</ul>';

$schema .=']
}
</script>';
$strReturn .=$schema;
return $strReturn;
