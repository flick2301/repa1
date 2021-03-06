<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/local/modules/pol.generator/prolog.php");
$moduleMode = \CModule::IncludeModuleEx(ADMIN_MODULE_NAME);
IncludeModuleLangFile(__FILE__);

if (!$moduleMode){
	echo GetMessage("MODULE_IS_NOT_INSTALL");
	return;
}

$TAGS_RIGHT = $APPLICATION->GetGroupRight(ADMIN_MODULE_NAME);
if ($TAGS_RIGHT == "D")
	$APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));

$aTabs = array(
	array("DIV" => "edit1", "TAB" => getMessage("KEY_TAB_NAME"), "ICON"=>"", "TITLE"=>getMessage("KEY_TAB_NAME")),
	array("DIV" => "edit2", "TAB" => getMessage("KEY_CONDITIONS_TAB_NAME"), "ICON"=>"", "TITLE" => getMessage("KEY_CONDITIONS_TAB_TITLE")),
);

$tabControl = new CAdminTabControl("tabControl", $aTabs);

$ID = intval($ID);
$message = null;
$bVarsFromForm = false;

$context = \Bitrix\Main\Application::getInstance()->getContext();
$request = $context->getRequest();


$bCopy = ($request->get('action') == "copy");

if ($request->getRequestMethod() == 'GET' && $request->getQuery('action') === 'delete' && check_bitrix_sessid())
{
	$res = Pol\Generator\Key\DB::delete($ID);

	if ($res->isSuccess()){
		LocalRedirect("/bitrix/admin/".Pol\Generator\Data::getPageName('list_key')."?lang=".LANG);
	}else{
		$message = new CAdminMessage(implode("<br>", $res->getErrorMessages()));
	}

}


if($request->isPost() && ($save != "" || $apply!="") && check_bitrix_sessid()){

	if ($ACTIVE_FROM)
		$ACTIVE_FROM = new \Bitrix\Main\Type\DateTime($ACTIVE_FROM);
	if ($ACTIVE_TO)
		$ACTIVE_TO = new \Bitrix\Main\Type\DateTime($ACTIVE_TO);

	$arFields = Array(
		
		
		"ID_SECTION"           => $ID_SECTION,
		"NAME"           => $NAME,
		"KEYS"           => $KEYS,
		
	);

	if($ID > 0)
	{
		if ($bCopy){
			$res = Pol\Generator\Key\DB::add($arFields);
			if ($res->isSuccess()){
				$ID = $res->getId();
			}
		}else{
			$res = Pol\Generator\Key\DB::update($ID,$arFields);
		}

		if ($res->isSuccess()){
			$success = true;
		}else{
			$message = new CAdminMessage(implode("<br>", $res->getErrorMessages()));
		}
	}
	else
	{
		$res = Pol\Generator\Key\DB::Add($arFields);
		if ($res->isSuccess()){
			$ID = $res->getId();
			$success = true;
		}else{
			$message = new CAdminMessage(implode("<br>", $res->getErrorMessages()));
		}
	}

	if($success)
	{
		if ($apply != ""){
			LocalRedirect("/bitrix/admin/".Pol\Generator\Data::getPageName('edit_key')."?ID=".$ID."&mess=ok&lang=".LANG."&".$tabControl->ActiveTabParam());
		}
		else{
			if($request->get('back_url')){
				LocalRedirect($request->get('back_url'));
			}
			LocalRedirect("/bitrix/admin/".Pol\Generator\Data::getPageName('list_key')."?lang=".LANG);
		}

	}
	else
	{
		if($e = $APPLICATION->GetException())
			$message = new CAdminMessage(GetMessage("KEY_ERROR_SAVE"), $e);
		$bVarsFromForm = true;
	}
}

$dataKeysMap = Pol\Generator\Key\KeysTable::getMap();

$res = Pol\Generator\Key\DB::getById($ID);

	$arKey = $res->fetch();

//-----------------------------------------------------------------------------------
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
if ($moduleMode == 2){
	echo BeginNote();
	echo GetMessage("DEMO_INFO");
	echo EndNote();
}

$aMenu = array();
$aMenu[] = array(
		"TEXT"  => GetMessage("KEYS_TITLE"),
		"TITLE" => GetMessage("KEYS_TITLE"),
		"LINK"  => Pol\Generator\Data::getPageName('list_key')."?lang=".LANG,
		"ICON"  => "btn_list",
	);

if($ID > 0){
	$aMenu[] = array("SEPARATOR"=>"Y");

	$aMenu[] = array(
		"TEXT"=>GetMessage("COPY_KEY"),
		"TITLE"=>GetMessage("COPY_KEY"),
		"LINK"=> Pol\Generator\Data::getPageName('edit_key')."?ID=".$ID."&action=copy&lang=".LANG,
		"ICON"=>"btn_copy",
	);

	$arSubMenu = array();
	$arSubMenu[] = array(
		"TEXT"  => GetMessage("KEY_ADD"),
		"TITLE" => GetMessage("KEY_ADD"),
		"LINK"  => Pol\Generator\Data::getPageName('edit_key')."?lang=".LANG,
		"ICON"  => "new",
	);
	$arSubMenu[] = array(
		"TEXT"  => GetMessage("KEY_DEL"),
		"TITLE" => GetMessage("KEY_DEL"),
		"LINK"  => "javascript:if(confirm('".GetMessage("KEY_DEL_CONFIRM")."')) ".
			"window.location='".Pol\Generator\Data::getPageName('edit_key')."?ID=".$ID."&action=delete&lang=".LANG."&".bitrix_sessid_get()."';",
		"ICON"  => "delete",
	);

	$aMenu[] = array(
		"TEXT"=>GetMessage("KEY_ACTIONS"),
		"TITLE"=>GetMessage("KEY_ACTIONS"),
		"LINK"=>"",
		"MENU" => $arSubMenu,
		"ICON"=>"btn_new",
	);

}
$context = new CAdminContextMenu($aMenu);
$context->Show();

if($request->get('mess') == "ok" && $ID > 0)
	CAdminMessage::ShowMessage(array("MESSAGE"=>GetMessage("KEY_SAVED"), "TYPE"=>"OK"));

if($message)
	echo $message->Show();
?>
<form method="POST" action="<?echo $APPLICATION->GetCurPage()?>" ENCTYPE="multipart/form-data" name="post_form">
	<?echo bitrix_sessid_post();?>
	<input type="hidden" name="lang" value="<?=LANG?>">
	<?if($ID > 0 && !$bCopy):?>
		<input type="hidden" name="ID" value="<?=$ID?>">
	<?endif;?>
	<?if ($bCopy):?>
		<input type="hidden" name="copyID" value="<?= intval($ID); ?>">
	<?endif?>

	<?$tabControl->Begin();?>
	<?$tabControl->BeginNextTab();?>

	
	
	
	<tr>
		<td>
			<span id="hint_NAME"></span><script type="text/javascript">BX.hint_replace(BX('hint_NAME'), '<?=getMessage('NAME_FIELD_HINT')?>');</script>
			<?=$dataKeysMap["NAME"]['title']?>:
		</td>
		<td><input type="text" name="NAME" value="<?=htmlspecialcharsbx($arKey["NAME"]);?>" size="30"></td>
	</tr>
	<tr>
		<td>
			<span id="hint_ID_SECTION"></span><script type="text/javascript">BX.hint_replace(BX('hint_ID_SECTION'), '<?=getMessage('VALUE_FIELD_ID_SECTION')?>');</script>
			<?=$dataKeysMap["ID_SECTION"]['title']?>:
		</td>
		<td><input type="text" name="ID_SECTION" value="<?=htmlspecialcharsbx($arKey["ID_SECTION"]);?>" size="30"></td>
	</tr>
	<tr>
		<td>
			<span id="hint_KEYS"></span><script type="text/javascript">BX.hint_replace(BX('hint_KEYS'), '<?=getMessage('VALUE_FIELD_KEYS')?>');</script>
			<?=$dataKeysMap["KEYS"]['title']?>:
		</td>
		<td><input type="text" name="KEYS" value="<?=htmlspecialcharsbx($arKey["KEYS"]);?>" size="30"></td>
	</tr>

	<?$tabControl->BeginNextTab();?>





	<tr>
		<td>
			<input type="hidden" name="back_url" value="<?=$request->get("back_url");?>">
		</td>
	</tr>

<?
$tabControl->Buttons(
	array(
		"disabled"=> false,
		"back_url"=>Pol\Generator\Data::getPageName('edit_key')."?lang=".LANG,
	)
);
?>

<?$tabControl->End();?>
<?$tabControl->ShowWarnings("post_form", $message);?>

<?echo BeginNote();?>
	<span class="required">*</span> <?= GetMessage("REQUIRED_FIELDS")?>
<?echo EndNote();?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");?>