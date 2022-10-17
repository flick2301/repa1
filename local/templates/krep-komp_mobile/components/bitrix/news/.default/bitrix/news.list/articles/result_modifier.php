<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "CODE","UF_COLOR","UF_COLOR2");
$arFilter = Array("IBLOCK_ID" => $arParams['IBLOCK_ID'], "ACTIVE" => "Y");
$res = CIBlockSection::GetList(Array(), $arFilter, false, $arSelect);
while($ob = $res->GetNext()){
	$arResult['SECTIONS'][$ob["ID"]]["NAME"] = $ob["NAME"];
	if($ob["UF_COLOR2"]){
		$arResult['SECTIONS'][$ob["ID"]]["COLOR_TEXT"] = "color:".$ob["UF_COLOR2"].";";
	}
	if($ob["UF_COLOR"]){
		$arResult['SECTIONS'][$ob["ID"]]["COLOR_BG"] = "background-color:".$ob["UF_COLOR"].";";
	}
}







