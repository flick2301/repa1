<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
require($_SERVER["DOCUMENT_ROOT"]."/local/classes/SpreadsheetReader_CSV.php");
$module_id = 'relink.table';




use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
use \Bitrix\Main\Application;
use \Bitrix\Main\Entity\Base;
use Relink\Table\LinksTable;





if (!Loader::includeModule('iblock'))
    return;

if (!Loader::includeModule('catalog'))
    return;

if (!Loader::includeModule($module_id))
    return;



$info_module = CModule::CreateModuleObject($module_id);

$context = Application::getInstance()->getContext();
$request = $context->getRequest();

$file = $request->getFile('TABLE_ID');


?>
<link rel="stylesheet" type="text/css" href="<?=$info_module->MODULE_CSS?>">
<p class="size-20">Загрузите файл excel:</p>
<?php
$arr_file=Array(
"name" => $file['name'],
"size" => $file['size'],
"tmp_name" => $file['tmp_name'],
"type" => "",
"old_file" => "",
"del" => "Y",
"MODULE_ID" => $module_id);

$fid = CFile::SaveFile($arr_file, $module_id);
if (strlen($fid)>0):
    $file_path = CFile::GetPath($fid); 
    echo $file_path;
endif;
?>
<form method = "post" enctype = 'multipart/form-data'>
<?echo CFile::InputFile("TABLE_ID", 20, $str_TABEL_ID);?>
<input type="submit" value="Загрузить">
</form>

<div class="generate_report" onclick="document.getElementById('clear').value='Y'; document.getElementById('form_generate').submit(); return false;"><span>Очистить данные</span></div>
<form method='POST' id="form_generate" action="<?echo $APPLICATION->GetCurPage()?>">

	<input type="hidden" name="lang" value="<?echo LANGUAGE_ID?>">
	<input type="hidden" name="id" value="relink.table">
        <input type='hidden' id='clear' name='clear' value=''>
	
	
	
</form>
<?php



if($request['clear']=='Y'){
    //чистим ORM таблицу
    Application::getConnection(LinksTable::getConnectionName())->
                    queryExecute('TRUNCATE TABLE '.Base::getInstance('\Relink\Table\LinksTable')->getDBTableName());
}elseif($fid>0){
    
   
    
    //чистим ORM таблицу
    Application::getConnection(LinksTable::getConnectionName())->
                    queryExecute('TRUNCATE TABLE '.Base::getInstance('\Relink\Table\LinksTable')->getDBTableName());
    
    //Создаем объект класса SpreadsheetReader_CSV для чтения CSV и заносим данные в массивы( $arXML_ID хранит все XML_ID)
    
    $reader_csv = new SpreadsheetReader_CSV($_SERVER["DOCUMENT_ROOT"].$file_path, array(';', '\n'));
    
        
    
    while($row = $reader_csv->next()){
        
        if(strpos($row['0'], '://')) {

            $code = basename($row['0']);

			
			
            if (strpos($code, '.html')) {
                $code = basename($row['0'], '.html');
                $elementList = \Bitrix\Iblock\ElementTable::getList(array("select" => array('ID', 'IBLOCK_ID'), "filter" => array("=CODE" => $code, 'IBLOCK_ID' => CATALOG_IBLOCK_ID)));
                $element = $elementList->fetch();
                $donor_id = $element['ID'];

            } else {

            $sectionList = \Bitrix\Iblock\SectionTable::getList(array("select" => array('ID', 'IBLOCK_ID'), "filter" => array("=CODE" => $code, 'IBLOCK_ID' => CATALOG_IBLOCK_ID)));
            $section = $sectionList->fetch();
            $donor_id = $section['ID'];
            }
           if($row['1'])
               $akceptor = $row['1'];
           if($row['2'])
               $ankor = $row['2'];
           if($donor_id){
           $result = LinksTable::add(array(
                'ANKOR' => $ankor,
                'AKCEPTOR' => $akceptor,
                'DONOR' => $row['0'],
                'DONOR_ID' => $donor_id,
                
            ));
		   }
           
           
           
        }
        
        
    }
    
   
}

//Если только после генерации или при хождении по постраничной навигации - отображаем таблицу
if(strlen($fid)>0 || $request['nav-more-reports'] || strpos($_SERVER['HTTP_REFERER'], 'nav-more-reports')){
    $nav = new \Bitrix\Main\UI\PageNavigation("nav-more-reports");
    $nav->allowAllRecords(true)
        ->setPageSize(50)
        ->initFromUri();
?>

<table class="reports">
    <tr>
        <td>АНКОР</td>
        <td>АКЦЕПТОР</td>
        <td>ДОНОР</td>
        <td>ДОНОР ID</td>
        
    </tr>
    <?php
    $result = LinksTable::getList(array(
            'select'=>array('*'),
            'count_total' => true,
            'offset' => $nav->getOffset(),
            'limit' => $nav->getLimit(),
        ));
    if($result->getCount())
    echo 'В листе '.$result->getCount().' строк';
    $nav->setRecordCount($result->getCount());
    $APPLICATION->IncludeComponent(
   "bitrix:main.pagenavigation",
   "",
   array(
      "NAV_OBJECT" => $nav,
      "SEF_MODE" => "N",
   ),
   false
);
    
    while ($row = $result->fetch())
    {
        
    ?>
    <tr>
        <td><?=$row['ANKOR']?></td>
        <td><?=$row['AKCEPTOR']?></td>
        <td><?=$row['DONOR']?></td>
        <td><?=$row['DONOR_ID']?></td>
      
       
    </tr>
    <?php
    }
    ?>
</table> 
<div id='nav-culture'></div>
<?php
   
}
 

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");

?>