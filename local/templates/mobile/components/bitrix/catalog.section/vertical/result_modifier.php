<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// подключаем пространство имен класса HighloadBlockTable и даём ему псевдоним HLBT для удобной работы
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;

//подключаем модуль highloadblock
CModule::IncludeModule('highloadblock');
//Напишем функцию получения экземпляра класса:
function GetEntityDataClass($HlBlockId) {
    if (empty($HlBlockId) || $HlBlockId < 1)
    {
        return false;
    }
    $hlblock = HLBT::getById($HlBlockId)->fetch();   
    $entity = HLBT::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();
    return $entity_data_class;
}



$nav = CIBlockSection::GetNavChain(false, $arResult['ID']);
while($nw = $nav->Fetch()){
    $arTempID[]=$nw['ID'];
    $arTempName[]=$nw['NAME'];
}
$arFilter = array('IBLOCK_ID' => IBLOCK_ID_CERT, "UF_SEC_CAT"=>$arTempID);
$rsSections = CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter, false, array("*", "UF_*"));
if($arSection = $rsSections->GetNext())
{
    
    $arResult['CERT_URL'] = $arSection['SECTION_PAGE_URL'];

}

$rsResult = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arResult["ID"]), false, array("UF_*"));
if($arSection = $rsResult->GetNext()) { 
    
    $arResult['UF_TECH_ID'] = $arSection["UF_TECH"];
    $arResult['UF_VES_TABLE_ID'] = $arSection["UF_VES_TABLE"];
    $arResult["UF_RELATED"] = $arSection["UF_RELATED"];
}
						

$entity_data_class = GetEntityDataClass(TECH_HB_ID);
$rsData = $entity_data_class::getList(array(
   'filter' => array("ID"=>$arResult['UF_TECH_ID'],)
));
$el = $rsData->fetch();
$arResult['UF_TECH_FILE'] = CFile::GetPath($el['UF_FILE']);

$entity_data_class = GetEntityDataClass(VES_HB_ID);
$rsData = $entity_data_class::getList(array(
   'filter' => array("ID"=>$arResult['UF_VES_TABLE_ID'],)
));
$el = $rsData->fetch();
$arResult['UF_VES_TABLE_FILE'] = CFile::GetPath($el['UF_FILE']);





foreach($arResult['ITEMS'] as $key=>$arItem){
    if(isset($arItem['PREVIEW_PICTURE']['ID'])){
      $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>150, 'height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    }else{
      $file = CFile::ResizeImageGet($arResult['PICTURE']['ID'], array('width'=>150, 'height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, true);  
    }
    $arResult['ITEMS'][$key]['PREVIEW_PICTURE'] = $file;
    
}

