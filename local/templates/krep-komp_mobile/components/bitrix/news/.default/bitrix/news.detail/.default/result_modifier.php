<?php
	if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	
	\Bitrix\Main\Loader::includeModule('dev2fun.opengraph');
	\Dev2fun\Module\OpenGraph::Show($arResult['ID'],'element');

	
	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "CODE","UF_COLOR","UF_COLOR2");
	$arFilter = Array("IBLOCK_ID" => $arParams['IBLOCK_ID'], "ID" => $arResult["SECTION"]["PATH"][0]["ID"]);
	$res = CIBlockSection::GetList(Array(), $arFilter, false, $arSelect);
	while($ob = $res->GetNext()){
		$arResult['SECTIONS']["NAME"] = $ob["NAME"];
		if($ob["UF_COLOR2"]){
			$arResult['SECTIONS']["COLOR_TEXT"] = "color:".$ob["UF_COLOR2"].";";
		}
		if($ob["UF_COLOR"]){
			$arResult['SECTIONS']["COLOR_BG"] = "background-color:".$ob["UF_COLOR"].";";
		}
	}
	
	
	
	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
	$arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "ID"=>$arResult['ID']);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
	if($ob = $res->GetNextElement()){
		$arFields = $ob->GetFields();
		$arResult['PROPERTIES'] = $ob->GetProperties();
	}
	
	if($arResult["PROPERTIES"]["similar_articles"]["VALUE"]){
		$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT", "IBLOCK_SECTION_ID", "SHOW_COUNTER", "DATE_ACTIVE_FROM", "DATE_CREATE", "DETAIL_PAGE_URL", "PROPERTY_*");
		$arFilter = Array("IBLOCK_ID"=>16, "ACTIVE"=>"Y", "ID"=>$arResult["PROPERTIES"]["similar_articles"]["VALUE"]);
		$res = CIBlockElement::GetList(Array("RAND" => "ASC"), $arFilter, false, Array("nPageSize"=>3), $arSelect);
		while($ob = $res->GetNextElement()){ 
			$arFields = $ob->GetFields();  
			$arProps = $ob->GetProperties();
			$arResult["MORE"][$arFields["ID"]] = $arFields;
			$arResult["MORE"][$arFields["ID"]]["PROPERTIES"] = $arProps;
			if ($arFields["IBLOCK_SECTION_ID"]) {
				$arSectionFilter = Array('IBLOCK_ID'=>16, 'ID'=>$arFields["IBLOCK_SECTION_ID"]);
				$arSectionSelect = Array("NAME", "UF_COLOR", "UF_COLOR2");
				$db_list = CIBlockSection::GetList(Array(), $arSectionFilter, false, $arSectionSelect);
				$db_list->NavStart(1);
				if($ar_result = $db_list->GetNext())
				{
					$arResult["MORE"][$arFields["ID"]]["SECTION"] = $ar_result;
				}
				if($arFields["PREVIEW_PICTURE"])  
					$arResult["MORE"][$arFields["ID"]]["IMG"] = CFile::GetPath($arFields["PREVIEW_PICTURE"]);
				$arResult["MORE"][$arFields["ID"]]["DATE"] = $arFields["DATE_ACTIVE_FROM"] ? $arFields["DATE_ACTIVE_FROM"] : $arFields["DATE_CREATE"];
				$arResult["MORE"][$arFields["ID"]]["DATE"] = explode(" ", $arResult["MORE"][$arFields["ID"]]["DATE"])[0];
				$arResult["MORE"][$arFields["ID"]]["DATE_FORMAT"] = explode(".", $arResult["MORE"][$arFields["ID"]]["DATE"]);
			}
		}
	}
