<?
$arStatus = CSaleStatus::GetList(
 array("SORT"=>"ASC"),
 array(),
 false,
 false,
 array("*")
);
while($status = $arStatus->Fetch()){
    $arResult['STATUS'][$status['ID']] = $status['NAME'];
}