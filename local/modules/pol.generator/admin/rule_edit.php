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
	array("DIV" => "edit1", "TAB" => getMessage("RULE_TAB_NAME"), "ICON"=>"", "TITLE"=>getMessage("RULE_TAB_NAME")),
	array("DIV" => "edit2", "TAB" => getMessage("RULE_TAB_NAME"), "ICON"=>"", "TITLE"=>getMessage("RULE_TAB_NAME")),
	
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
	$res = Pol\Generator\Rules\DB::delete($ID);

	if ($res->isSuccess()){
		LocalRedirect("/bitrix/admin/".Pol\Generator\Data::getPageName('list_rules')."?lang=".LANG);
	}else{
		$message = new CAdminMessage(implode("<br>", $res->getErrorMessages()));
	}

}


if($request->isPost() && ($save != "" || $apply!="") && check_bitrix_sessid()){

	if ($ACTIVE_FROM)
		$ACTIVE_FROM = new \Bitrix\Main\Type\DateTime($ACTIVE_FROM);
	if ($ACTIVE_TO)
		$ACTIVE_TO = new \Bitrix\Main\Type\DateTime($ACTIVE_TO);
echo $ELEMENT_META_TITLE;

    $arFields = Array(
		
		
		"ID_SECTION"           => $ID_SECTION,
		"NAME"           => $NAME,
		"ELEMENT_META_TITLE"           => $ELEMENT_META_TITLE,
		"ELEMENT_META_KEYWORDS"           => $ELEMENT_META_KEYWORDS,
		"ELEMENT_META_DESCRIPTION"           => $ELEMENT_META_DESCRIPTION,
		"ELEMENT_DETAIL_PICTURE_FILE_ALT"           => $ELEMENT_DETAIL_PICTURE_FILE_ALT,
		"ELEMENT_DETAIL_PICTURE_FILE_TITLE"           => $ELEMENT_DETAIL_PICTURE_FILE_TITLE,
		"SECTION_META_TITLE"           => $SECTION_META_TITLE,
		"SECTION_META_KEYWORDS"           => $SECTION_META_KEYWORDS,
		"SECTION_META_DESCRIPTION"           => $SECTION_META_DESCRIPTION,
		"ELEMENT_PREVIEW_PICTURE_FILE_ALT"           => $ELEMENT_PREVIEW_PICTURE_FILE_ALT,
		"ELEMENT_PREVIEW_PICTURE_FILE_TITLE"           => $ELEMENT_PREVIEW_PICTURE_FILE_TITLE,
		"TITLE_HREF_MINI_CART"           => $TITLE_HREF_MINI_CART,
		"TITLE_MENU"           => $TITLE_MENU,
		"ALT_LOGO"           => $ALT_LOGO,
        "ROOT_NAME" => $ROOT_NAME,
        "ROOT_DESCRIPTION" => $ROOT_DESCRIPTION,
		
	);

	if($ID > 0)
	{
		if ($bCopy){
			$res = Pol\Generator\Rules\DB::add($arFields);
			if ($res->isSuccess()){
				$ID = $res->getId();
			}
		}else{
			$res = Pol\Generator\Rules\DB::update($ID,$arFields);
		}

		if ($res->isSuccess()){
			$success = true;
		}else{
			$message = new CAdminMessage(implode("<br>", $res->getErrorMessages()));
		}
	}
	else
	{
		$res = Pol\Generator\Rules\DB::Add($arFields);
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
			LocalRedirect("/bitrix/admin/".Pol\Generator\Data::getPageName('edit_rule')."?ID=".$ID."&mess=ok&lang=".LANG."&".$tabControl->ActiveTabParam());
		}
		else{
			if($request->get('back_url')){
				LocalRedirect($request->get('back_url'));
			}
			LocalRedirect("/bitrix/admin/".Pol\Generator\Data::getPageName('list_rules')."?lang=".LANG);
		}

	}
	else
	{
		if($e = $APPLICATION->GetException())
			$message = new CAdminMessage(GetMessage("RULE_ERROR_SAVE"), $e);
		$bVarsFromForm = true;
	}
}

$dataKeysMap = Pol\Generator\Rules\RulesTable::getMap();

$res = Pol\Generator\Rules\DB::getById($ID);

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
		"TEXT"  => GetMessage("RULES_TITLE"),
		"TITLE" => GetMessage("RULES_TITLE"),
		"LINK"  => Pol\Generator\Data::getPageName('list_rules')."?lang=".LANG,
		"ICON"  => "btn_list",
	);

if($ID > 0){
	$aMenu[] = array("SEPARATOR"=>"Y");

	$aMenu[] = array(
		"TEXT"=>GetMessage("COPY_KEY"),
		"TITLE"=>GetMessage("COPY_KEY"),
		"LINK"=> Pol\Generator\Data::getPageName('edit_rule')."?ID=".$ID."&action=copy&lang=".LANG,
		"ICON"=>"btn_copy",
	);

	$arSubMenu = array();
	$arSubMenu[] = array(
		"TEXT"  => GetMessage("RULE_ADD"),
		"TITLE" => GetMessage("RULE_ADD"),
		"LINK"  => Pol\Generator\Data::getPageName('edit_rule')."?lang=".LANG,
		"ICON"  => "new",
	);
	$arSubMenu[] = array(
		"TEXT"  => GetMessage("RULE_DEL"),
		"TITLE" => GetMessage("RULE_DEL"),
		"LINK"  => "javascript:if(confirm('".GetMessage("RULE_DEL_CONFIRM")."')) ".
			"window.location='".Pol\Generator\Data::getPageName('edit_rule')."?ID=".$ID."&action=delete&lang=".LANG."&".bitrix_sessid_get()."';",
		"ICON"  => "delete",
	);

	$aMenu[] = array(
		"TEXT"=>GetMessage("RULE_ACTIONS"),
		"TITLE"=>GetMessage("RULE_ACTIONS"),
		"LINK"=>"",
		"MENU" => $arSubMenu,
		"ICON"=>"btn_new",
	);

}
$context = new CAdminContextMenu($aMenu);
$context->Show();

if($request->get('mess') == "ok" && $ID > 0)
	CAdminMessage::ShowMessage(array("MESSAGE"=>GetMessage("RULE_SAVED"), "TYPE"=>"OK"));

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
			<span id="hint_ELEMENT_META_TITLE"></span><script type="text/javascript">BX.hint_replace(BX('hint_ELEMENT_META_TITLE'), '<?=getMessage('VALUE_FIELD_ELEMENT_META_TITLE')?>');</script>
			<?=$dataKeysMap["ELEMENT_META_TITLE"]['title']?>:
		</td>
		<td><input type="text" name="ELEMENT_META_TITLE" value="<?=htmlspecialcharsbx($arKey["ELEMENT_META_TITLE"]);?>" size="30"></td>
	</tr>
	<tr>
		<td>
			<span id="hint_ELEMENT_META_KEYWORDS"></span><script type="text/javascript">BX.hint_replace(BX('hint_ELEMENT_META_KEYWORDS'), '<?=getMessage('VALUE_FIELD_ELEMENT_META_KEYWORDS')?>');</script>
			<?=$dataKeysMap["ELEMENT_META_KEYWORDS"]['title']?>:
		</td>
		<td><input type="text" name="ELEMENT_META_KEYWORDS" value="<?=htmlspecialcharsbx($arKey["ELEMENT_META_KEYWORDS"]);?>" size="30"></td>
	</tr>
	<tr>
		<td>
			<span id="hint_ELEMENT_META_DESCRIPTION"></span><script type="text/javascript">BX.hint_replace(BX('hint_ELEMENT_META_DESCRIPTION'), '<?=getMessage('VALUE_FIELD_ELEMENT_META_DESCRIPTION')?>');</script>
			<?=$dataKeysMap["ELEMENT_META_DESCRIPTION"]['title']?>:
		</td>
		<td><input type="text" name="ELEMENT_META_DESCRIPTION" value="<?=htmlspecialcharsbx($arKey["ELEMENT_META_DESCRIPTION"]);?>" size="30"></td>
	</tr>
	<tr>
		<td>
			<span id="hint_ELEMENT_DETAIL_PICTURE_FILE_ALT"></span><script type="text/javascript">BX.hint_replace(BX('hint_ELEMENT_DETAIL_PICTURE_FILE_ALT'), '<?=getMessage('VALUE_FIELD_ELEMENT_DETAIL_PICTURE_FILE_ALT')?>');</script>
			<?=$dataKeysMap["ELEMENT_DETAIL_PICTURE_FILE_ALT"]['title']?>:
		</td>
		<td><input type="text" name="ELEMENT_DETAIL_PICTURE_FILE_ALT" value="<?=htmlspecialcharsbx($arKey["ELEMENT_DETAIL_PICTURE_FILE_ALT"]);?>" size="30"></td>
	</tr>
	<tr>
		<td>
			<span id="hint_ELEMENT_DETAIL_PICTURE_FILE_TITLE"></span><script type="text/javascript">BX.hint_replace(BX('hint_ELEMENT_DETAIL_PICTURE_FILE_TITLE'), '<?=getMessage('VALUE_FIELD_ELEMENT_DETAIL_PICTURE_FILE_TITLE')?>');</script>
			<?=$dataKeysMap["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]['title']?>:
		</td>
		<td><input type="text" name="ELEMENT_DETAIL_PICTURE_FILE_TITLE" value="<?=htmlspecialcharsbx($arKey["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]);?>" size="30"></td>
	</tr>
	<tr>
		<td>
			<span id="hint_SECTION_META_TITLE"></span><script type="text/javascript">BX.hint_replace(BX('hint_SECTION_META_TITLE'), '<?=getMessage('VALUE_FIELD_SECTION_META_TITLE')?>');</script>
			<?=$dataKeysMap["SECTION_META_TITLE"]['title']?>:
		</td>
		<td><input type="text" name="SECTION_META_TITLE" value="<?=htmlspecialcharsbx($arKey["SECTION_META_TITLE"]);?>" size="30"></td>
	</tr>
	<tr>
		<td>
			<span id="hint_SECTION_META_KEYWORDS"></span><script type="text/javascript">BX.hint_replace(BX('hint_SECTION_META_KEYWORDS'), '<?=getMessage('VALUE_FIELD_SECTION_META_KEYWORDS')?>');</script>
			<?=$dataKeysMap["SECTION_META_KEYWORDS"]['title']?>:
		</td>
		<td><input type="text" name="SECTION_META_KEYWORDS" value="<?=htmlspecialcharsbx($arKey["SECTION_META_KEYWORDS"]);?>" size="30"></td>
	</tr>
	<tr>
		<td>
			<span id="hint_SECTION_META_DESCRIPTION"></span><script type="text/javascript">BX.hint_replace(BX('hint_SECTION_META_DESCRIPTION'), '<?=getMessage('VALUE_FIELD_SECTION_META_DESCRIPTION')?>');</script>
			<?=$dataKeysMap["SECTION_META_DESCRIPTION"]['title']?>:
		</td>
		<td><input type="text" name="SECTION_META_DESCRIPTION" value="<?=htmlspecialcharsbx($arKey["SECTION_META_DESCRIPTION"]);?>" size="30"></td>
	</tr>
	<tr>
		<td>
			<span id="hint_ELEMENT_PREVIEW_PICTURE_FILE_ALT"></span><script type="text/javascript">BX.hint_replace(BX('hint_ELEMENT_PREVIEW_PICTURE_FILE_ALT'), '<?=getMessage('VALUE_FIELD_ELEMENT_PREVIEW_PICTURE_FILE_ALT')?>');</script>
			<?=$dataKeysMap["ELEMENT_PREVIEW_PICTURE_FILE_ALT"]['title']?>:
		</td>
		<td><input type="text" name="ELEMENT_PREVIEW_PICTURE_FILE_ALT" value="<?=htmlspecialcharsbx($arKey["ELEMENT_PREVIEW_PICTURE_FILE_ALT"]);?>" size="30"></td>
	</tr>
	<tr>
		<td>
			<span id="hint_ELEMENT_PREVIEW_PICTURE_FILE_TITLE"></span><script type="text/javascript">BX.hint_replace(BX('hint_ELEMENT_PREVIEW_PICTURE_FILE_TITLE'), '<?=getMessage('VALUE_FIELD_ELEMENT_PREVIEW_PICTURE_FILE_TITLE')?>');</script>
			<?=$dataKeysMap["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]['title']?>:
		</td>
		<td><input type="text" name="ELEMENT_PREVIEW_PICTURE_FILE_TITLE" value="<?=htmlspecialcharsbx($arKey["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]);?>" size="30"></td>
	</tr>
	<tr>
		<td>
			<span id="hint_TITLE_HREF_MINI_CART"></span><script type="text/javascript">BX.hint_replace(BX('hint_TITLE_HREF_MINI_CART'), '<?=getMessage('VALUE_FIELD_TITLE_HREF_MINI_CART')?>');</script>
			<?=$dataKeysMap["TITLE_HREF_MINI_CART"]['title']?>:
		</td>
		<td><input type="text" name="TITLE_HREF_MINI_CART" value="<?=htmlspecialcharsbx($arKey["TITLE_HREF_MINI_CART"]);?>" size="30"></td>
	</tr>
	<tr>
		<td>
			<span id="hint_TITLE_MENU"></span><script type="text/javascript">BX.hint_replace(BX('hint_TITLE_MENU'), '<?=getMessage('VALUE_FIELD_TITLE_MENU')?>');</script>
			<?=$dataKeysMap["TITLE_MENU"]['title']?>:
		</td>
		<td><input type="text" name="TITLE_MENU" value="<?=htmlspecialcharsbx($arKey["TITLE_MENU"]);?>" size="30"></td>
	</tr>
	<tr>
		<td>
			<span id="hint_ALT_LOGO"></span><script type="text/javascript">BX.hint_replace(BX('hint_ALT_LOGO'), '<?=getMessage('VALUE_FIELD_ALT_LOGO')?>');</script>
			<?=$dataKeysMap["ALT_LOGO"]['title']?>:
		</td>
		<td><input type="text" name="ALT_LOGO" value="<?=htmlspecialcharsbx($arKey["ALT_LOGO"]);?>" size="30"></td>
	</tr>
    <tr>
        <td>
            <span id="hint_ROOT_NAME"></span><script type="text/javascript">BX.hint_replace(BX('hint_ROOT_NAME'), '<?=getMessage('VALUE_FIELD_ROOT_NAME')?>');</script>
            <?=$dataKeysMap["ROOT_NAME"]['title']?>:
        </td>
        <td><input type="text" name="ROOT_NAME" value="<?=htmlspecialcharsbx($arKey["ROOT_NAME"]);?>" size="30"></td>
    </tr>
    <tr>
        <td>
            <span id="hint_ROOT_DESCRIPTION"></span><script type="text/javascript">BX.hint_replace(BX('hint_ROOT_DESCRIPTION'), '<?=getMessage('VALUE_FIELD_ROOT_DESCRIPTION')?>');</script>
            <?=$dataKeysMap["ROOT_DESCRIPTION"]['title']?>:
        </td>
        <td>
		<textarea name="ROOT_DESCRIPTION" value="<?=htmlspecialcharsbx($arKey["ROOT_DESCRIPTION"]);?>" rows='5' cols='40'><?=htmlspecialcharsbx($arKey["ROOT_DESCRIPTION"]);?></textarea></td>
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
		"back_url"=>Pol\Generator\Data::getPageName('edit_rule')."?lang=".LANG,
	)
);
?>

<?$tabControl->End();?>
<?$tabControl->ShowWarnings("post_form", $message);?>

<?echo BeginNote();?>
	<span class="required">*</span> <?= GetMessage("REQUIRED_FIELDS")?>
<?echo EndNote();?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");?>