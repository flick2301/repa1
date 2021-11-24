<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
$CITY = htmlspecialchars($_REQUEST["city"]);
$IBLOCK_ID = htmlspecialchars($_REQUEST["iblock_id"]);

if (!$CITY || !$IBLOCK_ID) die();

		$arSelect = Array("ID", "IBLOCK_ID", "NAME", "SORT", "PREVIEW_TEXT", "DETAIL_TEXT", "IBLOCK_SECTION_ID", "PROPERTY_*");
		$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID, "ACTIVE"=>"Y", "SECTION_ID"=>"", "NAME"=>"{$CITY}%");

		
		$res = CIBlockElement::GetList(Array("SORT"=>"ASC", "NAME"=>"ASC"), $arFilter, false, Array(), $arSelect);
		while($ob = $res->GetNextElement())
		{
			$arr = $ob->GetFields();
			$arResult["ITEMS"][$arr["ID"]] = $ob->GetFields();
			$arResult["ITEMS"][$arr["ID"]]['PROP'] = $ob->GetProperties();
			echo "<li rel='".($arResult["ITEMS"][$arr["ID"]]["PROP"]["NAME"]["VALUE"] ? $arResult["ITEMS"][$arr["ID"]]["PROP"]["NAME"]["VALUE"] : $arResult["ITEMS"][$arr["ID"]]["NAME"])."' data-value='{$arResult["ITEMS"][$arr["ID"]]["ID"]}' data-domain='{$arResult["ITEMS"][$arr["ID"]]["PROP"]["DOMAIN"]["VALUE"]}'>{$arResult["ITEMS"][$arr["ID"]]["NAME"]}</li>";
		}		
?>