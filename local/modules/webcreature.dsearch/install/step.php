<?

use \Bitrix\Main\Localization\Loc;

if (!check_bitrix_sessid())
	return;

#������ � .settings.php

$cache_type=\Bitrix\Main\Config\Configuration::getInstance()->get('cache');
#������ � .settings.php

if ($ex = $APPLICATION->GetException())
	echo CAdminMessage::ShowMessage(array(
		"TYPE" => "ERROR",
		"MESSAGE" => Loc::getMessage("MOD_INST_ERR"),
		"DETAILS" => $ex->GetString(),
		"HTML" => true,
	));
else 
	echo CAdminMessage::ShowNote(Loc::getMessage("MOD_INST_OK"));

#������ � .settings.php

if(!$cache_type['type'] || $cache_type['type']=='none')
	echo CAdminMessage::ShowMessage(array("MESSAGE"=>Loc::getMessage("WEBCREATURE_DSEARCH_NO_CACHE"),"TYPE"=>"ERROR"));
#������ � .settings.php
?>
<form action="<?echo $APPLICATION->GetCurPage(); ?>">
	<input type="hidden" name="lang" value="<?echo LANGUAGE_ID ?>">
	<input type="submit" name="" value="<?echo Loc::getMessage("MOD_BACK"); ?>">
<form>