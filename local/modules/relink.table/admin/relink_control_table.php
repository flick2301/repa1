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
?>
<link rel="stylesheet" type="text/css" href="<?=$info_module->MODULE_CSS?>">
<div class="generate_report" onclick="document.getElementById('clear').value='Y'; document.getElementById('form_relink').submit(); return false;"><span>Очистить данные</span></div>
<div class="generate_report" onclick="document.getElementById('view').value='Y'; document.getElementById('form_relink').submit(); return false;"><span>Вывести список битых ссылок(AKCEPTOR)</span></div>
<form method='POST' id="form_relink" action="<?echo $APPLICATION->GetCurPage()?>">

	<input type="hidden" name="lang" value="<?echo LANGUAGE_ID?>">
	<input type="hidden" name="id" value="relink.table">
    <input type='hidden' id='clear' name='clear' value=''>
	<input type='hidden' id='view' name='view' value=''>
	
	
	
</form>
<?
if($request->get("view")){
	
	$result = LinksTable::getList(array(
            'select'=>array('ID', 'AKCEPTOR'),
            //'count_total' => true,
            //'offset' => $nav->getOffset(),
            //'limit' => $nav->getLimit(),
        ));
	while ($row = $result->fetch())
    {
		$url = $row['AKCEPTOR'];
		$handle = curl_init($url);
		curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

		$response = curl_exec($handle);

		/* Проверка на статус 404 (не найдено). */
		$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
		if($httpCode == 404) {
			echo $row['AKCEPTOR'].'..........'.'404'.'<br />';
		}else{
			//echo $row['AKCEPTOR'].'..........'.'DONE'.'<br />';
		}
		
	}
	curl_close($handle);
	
	
}
?>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");

?>