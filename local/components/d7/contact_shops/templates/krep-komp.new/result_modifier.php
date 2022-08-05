<?
	foreach($arResult["ITEMS"] AS $item) {
		$newResult[$item["PROP"]["TYPE"]["VALUE_ENUM_ID"]][] = $item;
	}
	
$APPLICATION->SetTitle("Адреса ".((count($newResult[581]) && count($newResult)==1 ? "" : "магазинов и "))."точек выдачи в {{city}}");
$APPLICATION->SetPageProperty("basket", "<header class=\"basic-layout__module page-heading\"><h1>Адреса ".((count($newResult[581]) && count($newResult)==1 ? "" : "магазинов и "))."точек выдачи в {{city}}</h1></header>");
echo '<br>';
	
asort($newResult);	
$newResultFinite = Array();

foreach($newResult AS $val) $newResultFinite = array_merge($newResultFinite, $val);

$arResult["ITEMS"] = $newResultFinite;

/*
global $USER;
if ($USER->GetID()==1 || $_GET["administrator"]) {
$newResultFinite = Array();	
array_walk_recursive($newResult, function ($item, $key) use (&$newResultFinite) {
    $newResultFinite[] = $item;    
});



$arResult["ITEMS"] = $newResultFinite;
}
*/


?>