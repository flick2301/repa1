<?
GLOBAL $lastModified;
$m = $arResult['TIMESTAMP_X'] ? $arResult['TIMESTAMP_X'] : $arResult['DATE_CREATE'];

if (!$m){
    $lastModified = strtotime(date("D, d M Y H:i:s", filectime($_SERVER['SCRIPT_FILENAME'])));
}else{
    $lastModified = MakeTimeStamp($m);
}