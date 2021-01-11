<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
?>
<?
if ((CModule::IncludeModule('search'))&&(CModule::IncludeModule('iblock'))){
    $q = $_REQUEST['q'];
    
   /* $obSearch = new CSearch;
    $obSearch->Search(array(
                            "QUERY" => $q,
                            
                            "MODULE_ID" => 'iblock',
                            "CHECK_DATES" => 'Y',
                            "PARAM2" => "5"
                            )
                    );
    $result = array();
    
    
    while ($res = $obSearch->GetNext()){
        $id = $res['ITEM_ID'];
        //если нашли раздел:
        if (strripos($id, 'S')!==false){
               
        
                
        
        }
        //если S-ки нету, то
        else{
                $result_item['TITLE'] = $res['TITLE'];
                $result_item['URL'] = $res['URL'];
                $result_item['BODY_FORMATED'] = $res['BODY_FORMATED']; 
                $result[] = $result_item;
                
        }
        
        
        
    }*/
    $arFilter = Array('IBLOCK_ID'=>CATALOG_IBLOCK_ID, 'GLOBAL_ACTIVE'=>'Y', '%NAME'=>$q);
    $db_list = CIBlockSection::GetList(Array('depth_level'=>'asc'), $arFilter, false, false, Array("nTopCount" => 10));
    
    while($ar_result = $db_list->GetNext())
    {
        $result[]=array('TITLE'=>$ar_result['NAME'], 'URL'=>$ar_result['SECTION_PAGE_URL'], 'BODY_FORMATED'=>'');
    }
    if(count($result)==0):
   $rs= CIBlockElement::GetList (
        Array("RAND" => "ASC"),
        Array("IBLOCK_ID" => CATALOG_IBLOCK_ID, 
              array(
                "LOGIC" => "OR",
                array('%NAME'=>$q),
                array('%PROPERTY_CML2_ARTICLE'=>$q)),
            ),
        false,
        Array ("nTopCount" => 10)
);
    while($ar = $rs->GetNext()) {
    $result[]=array('TITLE'=>$ar['NAME'], 'URL'=>$ar['DETAIL_PAGE_URL'], 'BODY_FORMATED'=>$q);
}
endif;
    
    
    echo json_encode($result);
}
?>