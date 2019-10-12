<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use \Bitrix\Main;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Type;


Main\Loader::includeModule('main');
Main\Loader::includeModule('sale');

$bs = new CIBlockSection;



// Получаем содержимое потока
//$req = json_decode($str);
$section = SectionTable::getList(
      array(
         "select" => array("ID"),
         "filter" => array("IBLOCK_ID" => 1, "CODE" => "Y"),
         
      )
   );


$ID = 68;

$arPICTURE = $_FILES["PICTURE"];
$arPICTURE["MODULE_ID"] = "iblock";

$arFields = Array(

  "DESCRIPTION" => 'hello',
  "PICTURE" => CFile::MakeFileArray( 'http://moskrep.ru/upload/iblock/cf6/01.jpg' ),
  );

if($ID > 0)
{
  $res = $bs->Update($ID, $arFields);
  echo 'Done<br>';
}
else
{
  $ID = $bs->Add($arFields);
  $res = ($ID>0);
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>