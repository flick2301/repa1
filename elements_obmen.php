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
use \Bitrix\Iblock\InheritedProperty;


Main\Loader::includeModule('main');
Main\Loader::includeModule('sale');
Main\Loader::includeModule("iblock");


    


$str = htmlentities(file_get_contents("obmen_elements-8.txt"));
$arElements = explode("$$$", $str);
foreach($arElements as $item){
    $prop_item = explode("|||", $item);
  
 // echo $prop_sec['0'].':<br>'.$prop_sec['1'].'<br>';
  
  $arFilter = Array('IBLOCK_ID'=>17, '=PROPERTY_CML2_ARTICLE'=>$prop_item['0']);
  $db_list = CIBlockElement::GetList(Array('SORT'=>'ASC'), $arFilter);
  $ar_result = $db_list->GetNext();
  $ID = $ar_result['ID'];
  
  
  $array_meta=array();
  $arMeta = explode("---", $prop_item['1']);
  foreach($arMeta as $meta_item){
      $meta_tag=explode(":::", $meta_item);
      $array_meta[$meta_tag['0']]=html_entity_decode($meta_tag['1']);
      
  }
  $ipropTemplates = new InheritedProperty\ElementTemplates('17', $ID);
  $ipropTemplates->set($array_meta);
 
 
echo $ID;
  
}


?>
<?  
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>
