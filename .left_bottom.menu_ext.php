<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;


$url = $APPLICATION->GetCurPage();

$code = getSectionCode(str_replace("/index.php","",$_SERVER['REAL_FILE_PATH']).$url, -3);
$code_l2 = getSectionCode(str_replace("/index.php","",$_SERVER['REAL_FILE_PATH']).$url, -4);

$sort_element = false;
$res = \Bitrix\Iblock\ElementTable::getList(array('filter'=>array('IBLOCK_ID'=>SORTING_IBLOCK_ID, 'CODE'=>getSectionCode(str_replace("/index.php","",$_SERVER['REAL_FILE_PATH']).$url, -2)), 'select'=>array('*')));
if($arSort = $res->Fetch()){
	$code = $code_l2;
	$sort_element = true;
}




if($code){

if (!\Bitrix\Main\Loader::includeModule('iblock')) {
    throw new SystemException(
        'Ошибка подключения модуля информационных блоков'
    );
}



$arFilter = array(
    "IBLOCK_ID"=>CATALOG_IBLOCK_ID,
    "IBLOCK_TYPE" => 'catalog',
    "CODE" => $code,
    "ACTIVE"=>"Y"
    );
	
	

if(CIBlockSection::GetCount($arFilter)==1){
	if($sort_element)
		$code = getSectionCode(str_replace("/index.php","",$_SERVER['REAL_FILE_PATH']).$url, -4);
	else
		$code = getSectionCode(str_replace("/index.php","",$_SERVER['REAL_FILE_PATH']).$url);
 
 $arFilter = array(
    "IBLOCK_ID"=>CATALOG_IBLOCK_ID,
    "IBLOCK_TYPE" => 'catalog',
    "CODE" => $code,
    "ACTIVE"=>"Y"
    );
 
}

$id_ar = CIBlockSection::GetList(array('SORT' => 'asc'),$arFilter);
$id_sec = $id_ar->GetNext();

$arFilter = array(
    "IBLOCK_ID"=>CATALOG_IBLOCK_ID,
    "IBLOCK_TYPE"=>'catalog',
    "SECTION_ID" => $id_sec['ID'],
    "ACTIVE"=>"Y"
);

$section = CIBlockSection::GetList(array('SORT' => 'asc'),$arFilter, false, array('*', 'UF_SYM_LINK'));
   
	

	while ($sectionOb = $section->GetNext()) {
		if($sectionOb['UF_SYM_LINK'])
			$url_section = $sectionOb['UF_SYM_LINK'];
		else
			$url_section = $sectionOb['SECTION_PAGE_URL'];
        $aMenuLinks[] = Array(
		$sectionOb['NAME'],
		$url_section,
		Array("PARENT_NAME" => $id_sec['NAME']),
		Array(),
		""
	);
		
	}

	if(defined("BX_COMP_MANAGED_CACHE"))
		$GLOBALS["CACHE_MANAGER"]->RegisterTag("iblock_id_new");

}elseif(strripos($url, 'personal') == true){
    $aMenuLinks = Array(
	Array(
		"Мои заказы", 
		"/personal/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Личные данные", 
		"/personal/private/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Сменить пароль", 
		"/personal/change_pass/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Выйти из профиля", 
		"/personal/?logout=yes", 
		Array(), 
		Array(), 
		"" 
	),
	
	
	
);
}else{
    
    $aMenuLinks = Array(
	Array(
		"Распродажа", 
		"/rasprodaja_krepeja/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Сертификаты", 
		"/certificates/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Доставка и оплата", 
		"/delivery/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Адреса магазинов", 
		"/addresses/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Скачать Прайс",
		"/prays_listy/",
		Array(),
		Array(),
		""
	),
	Array(
		"Контакты", 
		"/contacts/", 
		Array(), 
		Array(), 
		"" 
	),
	
);
}

?>