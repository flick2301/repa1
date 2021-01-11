<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");?>

<?php
define("ADMIN_MODULE_NAME", "webcreature.dsearch");
$moduleMode = \CModule::IncludeModuleEx(ADMIN_MODULE_NAME);
IncludeModuleLangFile(__FILE__);
if (!$moduleMode){
	echo GetMessage("MODULE_IS_NOT_INSTALL");
	return;
}

$TAGS_RIGHT = $APPLICATION->GetGroupRight(ADMIN_MODULE_NAME);
if ($TAGS_RIGHT == "D")
	$APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));

use \Webcreature\Dsearch\StatTable;
use \Bitrix\Main\Localization\Loc;
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");?>

<?$APPLICATION->AddHeadString('<link href="/local/modules/webcreature.dsearch/css/style.css";  type="text/css" rel="stylesheet" />',true)?>
<?php
		$result = StatTable::getList(array(
            'select'  => array('*'),  
			'order' => array('ID' => 'DESC'),
        ));
		
$arResult = $result->fetchAll();		
?>	

<table class='dsearch_table'>
<tr>
<th>IP</th>
<th><?=Loc::getMessage("DSEARCH_STAT_DATE")?></th>
<th><?=Loc::getMessage("DSEARCH_STAT_NAME")?></th>
<th>#ID</th>
<th><?=Loc::getMessage("DSEARCH_STAT_USER_NAME")?></th>
<th><?=Loc::getMessage("DSEARCH_STAT_COMMENT")?></th>
</tr>	
<?foreach ($arResult AS $val) :?>
<?$i++?>
<tr<?=($i%2==0) ? " class='white'" : ""?>>
<td><?=$val['IP']?></td>
<td><?=$val['DATE']?></td>
<td><?=$val['NAME']?></td>
<td><?=$val['USER_ID']?></td>
<td><?=$val['USER_NAME']?></td>
<td><?=$val['COMMENT']?></td>
</tr>
<?endforeach?>
</table>




<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");?>