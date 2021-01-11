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


    

$bs = new CIBlockSection;
$str = htmlentities(file_get_contents("obmen.txt"));
$arSections = explode("$$$", $str);
foreach($arSections as $sec){
  $prop_sec = explode("|||", $sec);
  
 // echo $prop_sec['0'].':<br>'.$prop_sec['1'].'<br>';
  
  $arFilter = Array('IBLOCK_ID'=>17, 'CODE'=>$prop_sec['0']);
  $db_list = CIBlockSection::GetList(Array('SORT'=>'ASC'), Array('IBLOCK_ID'=>17, 'CODE'=>$prop_sec['0']));
  $ar_result = $db_list->GetNext();
  $ID = $ar_result['ID'];
  
  $text='';
  $det_text='';
  $text=$prop_sec['3'];
  $det_text=$prop_sec['4'];
  $array_meta=array();
  $arMeta = explode("---", $prop_sec['2']);
  foreach($arMeta as $meta_item){
      $meta_tag=explode(":::", $meta_item);
      $array_meta[$meta_tag['0']]=html_entity_decode($meta_tag['1']);
      
  }
  $ipropTemplates = new InheritedProperty\SectionTemplates('17', $ID);
  $ipropTemplates->set($array_meta);
 
  $arFields = Array(

  "DESCRIPTION" => html_entity_decode($text),
  "DESCRIPTION_TYPE" => 'html',
  "PICTURE" => CFile::MakeFileArray( $prop_sec['1'] ),
  "UF_DETAIL_TEXT"=>html_entity_decode($det_text),
  
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
