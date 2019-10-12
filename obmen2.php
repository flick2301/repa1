<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Bitrix\Main\Loader;
Loader::includeModule("main");
Loader::includeModule("sale");
Loader::includeModule("iblock");



$bs = new CIBlockSection;
$result = json_decode($_POST['data'],true);

 foreach ($result as $key => $value) {
    echo $key.'='.$value.'<br />';
    
   if($value==''){
      continue; 
   } 
    
  $arFilter = Array('IBLOCK_ID'=>5, 'CODE'=>$key);
  $db_list = CIBlockSection::GetList(Array('SORT'=>'ASC'), $arFilter, true);
  while($ar_result = $db_list->GetNext())
  {
    echo $ar_result['ID'].' '.$ar_result['NAME'].'<br>';
    
    $pad='http://moskrep.ru'.$value;
    
 
    $ID = $ar_result['ID'];
  
 


$arPICTURE = $_FILES["PICTURE"];
$arPICTURE["MODULE_ID"] = "iblock";

$arFields = Array(

  "DESCRIPTION" => $pad,
  "PICTURE" => CFile::MakeFileArray( $pad ),
  );

if($ID > 0)
{
  $res = $bs->Update($ID, $arFields);
  echo 'Done<br>';
}


 }
 }

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>