<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock=array();
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
{
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}

$arSorts = Array("ASC"=>GetMessage("POL_CERTIFICATES_DESC_ASC"), "DESC"=>GetMessage("POL_CERTIFICATES_DESC_DESC"));
$arSortFields = Array(
		"ID"=>GetMessage("POL_CERTIFICATES_DESC_FID"),
		"NAME"=>GetMessage("POL_CERTIFICATES_DESC_FNAME"),
		"ACTIVE_FROM"=>GetMessage("POL_CERTIFICATES_DESC_FACT"),
		"SORT"=>GetMessage("POL_CERTIFICATESK_DESC_FSORT"),
		"TIMESTAMP_X"=>GetMessage("POL_CERTIFICATES_DESC_FTSAMP")
	);

$arProperty_LNS = array();
$rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arCurrentValues["IBLOCK_ID"]));
while ($arr=$rsProp->Fetch())
{
	$arProperty[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
	if (in_array($arr["PROPERTY_TYPE"], array("L", "N", "S", "E")))
	{
		$arProperty_LNS[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
	}
}

$arUGroupsEx = Array();
$dbUGroups = CGroup::GetList($by = "c_sort", $order = "asc");
while($arUGroups = $dbUGroups -> Fetch())
{
	$arUGroupsEx[$arUGroups["ID"]] = $arUGroups["NAME"];
}

$arComponentParameters = array(
	"GROUPS" => array(
		"REVIEW_SETTINGS" => array(
			"SORT" => 140,
			"NAME" => GetMessage("POL_CERTIFICATES_REVIEW_SETTINGS"),
		),
		
		
		
	),
	"PARAMETERS" => array(
		"VARIABLE_ALIASES" => Array(
			"SECTION_ID" => Array("NAME" => GetMessage("POL_CERTIFICATES_ID_DESC")),
		),
		"SEF_MODE" => Array(
			"sections" => array(
				"NAME" => GetMessage("POL_CERTIFICATES_PAGE_NEWS"),
				"DEFAULT" => "",
				"VARIABLES" => array(),
			),
                        "items" => array(
				"NAME" => GetMessage("POL_CERTIFICATES_PAGE_NEWS_DETAIL"),
				"DEFAULT" => "#SECTION_ID#/",
				"VARIABLES" => array("SECTION_ID"),
			),
			"items" => array(
				"NAME" => GetMessage("POL_CERTIFICATES_PAGE_NEWS_DETAIL"),
				"DEFAULT" => "#SECTION_ID#/",
				"VARIABLES" => array("SECTION_ID"),
			),
			
		),
		"AJAX_MODE" => array(),
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => "IBLOCK_TYPE",
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => "IBLOCK_ID",
			"TYPE" => "LIST",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
			"ADDITIONAL_VALUES" => "Y",
		),
		"USE_REVIEW" => Array(
			"PARENT" => "REVIEW_SETTINGS",
			"NAME" => "USE_REVIEW",
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"REFRESH" => "Y",
		),
		
		
		
		
		"DATE_FORMAT" => CIBlockParameters::GetDateFormat(GetMessage("T_IBLOCK_DESC_ACTIVE_DATE_FORMAT"), "ADDITIONAL_SETTINGS"),
		
		
		
		
		"SET_TITLE" => Array(),
               "ADD_SECTIONS_CHAIN" => array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("CP_BC_ADD_SECTIONS_CHAIN"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y"
		),
		
		
		"ADD_GROUP_PERMISSIONS" => Array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => "ADD_GROUP_PERMISSIONS",
			"TYPE" => "LIST",
			"VALUES" => $arUGroupsEx,
			"DEFAULT" => Array(1),
			"MULTIPLE" => "Y",
		),
		"CACHE_TIME"  =>  Array("DEFAULT"=>36000000),
            
            "LIST_PREV_PIC_H_L2" => array(
		"NAME" => GetMessage('LIST_PREV_PIC_H_L2'),
		"TYPE" => "STRING",
		"DEFAULT" => "100",
		
	),
            "LIST_PREV_PIC_W_L2" => array(
		"NAME" => GetMessage('LIST_PREV_PIC_W_L2'),
		"TYPE" => "STRING",
		"DEFAULT" => "100",
		
	),
            "ITEMS_PREV_PIC_H" => array(
		"NAME" => GetMessage('LIST_PREV_PIC_H_L2'),
		"TYPE" => "STRING",
		"DEFAULT" => "100",
		
	),
            "ITEMS_PREV_PIC_W" => array(
		"NAME" => GetMessage('LIST_PREV_PIC_W_L2'),
		"TYPE" => "STRING",
		"DEFAULT" => "100",
		
	),
	),
);






?>
