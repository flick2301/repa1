<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;
if (!\Bitrix\Main\Loader::includeModule('iblock')) {
    throw new SystemException(
        'Ошибка подключения модуля информационных блоков'
    );
}


    
    $arFilter = array(
    "IBLOCK_ID"=>IBLOCK_ID_CERT,
    
);

	
   $section = CIBlockSection::GetList(array('SORT' => 'asc'),$arFilter);
   
	

	while ($sectionOb = $section->GetNext()) {
            
            
 
		
        $aMenuLinks[] = Array(
		$sectionOb['NAME'],
		$sectionOb['CODE'].'/',
		Array(),
		Array(),
		""
	);
        }

?>