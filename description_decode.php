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
Main\Loader::includeModule("iblock");


    

  $bs = new CIBlockSection;
  
  $arFilter = Array('IBLOCK_ID'=>5);
  $db_list = CIBlockSection::GetList(Array('SORT'=>'ASC'), $arFilter);
  while($ar_result = $db_list->GetNext()){
  $ID = $ar_result['ID'];
  
  $arFields = Array(

  "DESCRIPTION" => html_entity_decode($ar_result['DESCRIPTION']),
  "DESCRIPTION_TYPE" => 'html'
  
  );

if($ID > 0)
{
  $res = $bs->Update($ID, $arFields);
  echo 'Done<br>';
}
  }



?>
<?  
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>
