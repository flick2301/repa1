<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;
if (!\Bitrix\Main\Loader::includeModule('iblock')) {
    throw new SystemException(
        'Ошибка подключения модуля информационных блоков'
    );
}


    
    $arFilter = array(
    "IBLOCK_TYPE"=>'catalog',
    "SECTION_ID" => SALE_SECTION_ID,
);

	
   $section = CIBlockSection::GetList(array('SORT' => 'asc'),$arFilter);
   
	

	while ($sectionOb = $section->GetNext()) {
            
            $arSelect = Array("ID", "NAME", "PROPERTY_FOR_SALE");
            $arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "SECTION_ID"=>$sectionOb['ID'], "INCLUDE_SUBSECTIONS"=>"Y","PROPERTY_FOR_SALE"=>"По акции", "ACTIVE"=>"Y");
            $res = CIBlockElement::GetList(Array(), $arFilter, array(), false, $arSelect);
    if($res == 0)
          continue;
 
		
        $aMenuLinks[] = Array(
		$sectionOb['NAME'],
		$sectionOb['CODE'].'/',
		Array(),
		Array(),
		""
	);
        }

?>