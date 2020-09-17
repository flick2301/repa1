<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?

function getSectionCode($url='krepezh', $level=-3){
    $arCode = explode("/", $url);
    if(in_array('catalog', $arCode)){
        $code_sec = $arCode[count($arCode)+$level];
        return $code_sec;
        
    }else{
        return false;
    }
}



function getSectionCount($iblock_id, $section_id){
  if (CModule::IncludeModule("iblock")){ 
  $arFilter = Array('IBLOCK_ID'=>$iblock_id, "SECTION_ID"=>$section_id);
  $db_list = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, true);
  $count=0;
  while($ar_result = $db_list->GetNext())
  {
   $count += CIBlockSection::GetCount(Array("IBLOCK_ID"=>$iblock_id, "SECTION_ID"=>$ar_result["ID"]));
  }
  return $count;
  }
}

?>
