<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';

//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()


$strReturn .= '<ul class="breadcrumbs">';


$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arrow = ($index > 0? ' / ' : '');

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= $arrow.'
			<li class="breadcrumbs__item">
				
				<a href="'.$arResult[$index]["LINK"].'" target="_self"  class="breadcrumbs__link">
					'.$title.'
				</a>
				
			</li>';
	}
	else
	{
		$strReturn .= $arrow.'
			<li class="breadcrumbs__item">
				
				<span class="breadcrumbs__last">'.$title.'</span>
				
			</li>';
	}
}

$strReturn .= '</ul>';

return $strReturn;
