<?
function widgetGetNames($arParams, $SECTION_ID, $arResultLog = "") { 
	
	$arResult["LOG"] = $arResultLog;
	$arResult["NAMES"] = Array();
	
								//$arResult["LOG"] = $arResultLog.$SECTION_ID."<br />";	

		$arSort = array("SORT" => "ASC", "ID" => "ASC");
		$arFilter = array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y", "ELEMENT_SUBSECTIONS" => "N");
		$arFilter["SECTION_ID"] = $SECTION_ID;
        $arSelect = array("ID", "IBLOCK_ID", "NAME", "CODE");
		$rsSect = CIBlockSection::GetList($arSort, $arFilter, true, $arSelect, Array("nPageSize"=>50));
		while ($arSect = $rsSect->GetNext()) { 
		
			//$arResult["LOG"] .= $arSect['NAME']."-".$arSect['ELEMENT_CNT']."<br />";
			
			if (!$arSect['ELEMENT_CNT'] && $SECTION_ID == $_POST["TYPE"]) {
								$arResult["LOG"] .= $arResultFunction[1];
								$arResultFunction = widgetGetNames($arParams, $arSect['ID'], $arResult["LOG"]);
				$arResult["NAMES"] = array_merge($arResult["NAMES"], $arResultFunction[0]);
				} 
			else {$arResult["NAMES"][] = $arSect;};
		}
				
	return Array($arResult["NAMES"], $arResult["LOG"]);
}  
?>