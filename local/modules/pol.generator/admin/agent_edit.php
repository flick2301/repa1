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
	array("DIV" => "edit1", "TAB" => getMessage("AGENT_TAB_NAME"), "ICON"=>"", "TITLE"=>getMessage("AGENT_TAB_NAME")),
	array("DIV" => "edit2", "TAB" => getMessage("AGENT_CONDITIONS_TAB_NAME"), "ICON"=>"", "TITLE" => getMessage("AGENT_CONDITIONS_TAB_TITLE")),
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
	$res = Pol\Generator\Agent\DB::delete($ID);

	if ($res->isSuccess()){
		LocalRedirect("/bitrix/admin/".Pol\Generator\Data::getPageName('list_agent')."?lang=".LANG);
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
		
		"ID_IBLOCK"=>$ID_IBLOCK,
		"ID_SECTION"           => $ID_SECTION,
		"ID_RULES"           => $ID_RULES,
		"ID_KEYS"           => $ID_KEYS,
		
	);

	if($ID > 0)
	{
		if ($bCopy){
			$res = Pol\Generator\Agent\DB::add($arFields);
			if ($res->isSuccess()){
				$ID = $res->getId();
			}
		}else{
			$res = Pol\Generator\Agent\DB::update($ID,$arFields);
		}

		if ($res->isSuccess()){
			$success = true;
		}else{
			$message = new CAdminMessage(implode("<br>", $res->getErrorMessages()));
		}
	}
	else
	{
		$res = Pol\Generator\Agent\DB::Add($arFields);
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
			LocalRedirect("/bitrix/admin/".Pol\Generator\Data::getPageName('edit_agent')."?ID=".$ID."&mess=ok&lang=".LANG."&".$tabControl->ActiveTabParam());
		}
		else{
			if($request->get('back_url')){
				LocalRedirect($request->get('back_url'));
			}
			LocalRedirect("/bitrix/admin/".Pol\Generator\Data::getPageName('list_agent')."?lang=".LANG);
		}

	}
	else
	{
		if($e = $APPLICATION->GetException())
			$message = new CAdminMessage(GetMessage("agent_ERROR_SAVE"), $e);
		$bVarsFromForm = true;
	}
}

$dataKeysMap = Pol\Generator\Agent\AgentTable::getMap();

$res = Pol\Generator\Agent\DB::getById($ID);

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
		"TEXT"  => GetMessage("AGENT_TITLE"),
		"TITLE" => GetMessage("AGENT_TITLE"),
		"LINK"  => Pol\Generator\Data::getPageName('list_agent')."?lang=".LANG,
		"ICON"  => "btn_list",
	);

if($ID > 0){
	$aMenu[] = array("SEPARATOR"=>"Y");

	$aMenu[] = array(
		"TEXT"=>GetMessage("COPY_AGENT"),
		"TITLE"=>GetMessage("COPY_AGENT"),
		"LINK"=> Pol\Generator\Data::getPageName('edit_agent')."?ID=".$ID."&action=copy&lang=".LANG,
		"ICON"=>"btn_copy",
	);

	$arSubMenu = array();
	$arSubMenu[] = array(
		"TEXT"  => GetMessage("AGENT_ADD"),
		"TITLE" => GetMessage("AGENT_ADD"),
		"LINK"  => Pol\Generator\Data::getPageName('edit_agent')."?lang=".LANG,
		"ICON"  => "new",
	);
	$arSubMenu[] = array(
		"TEXT"  => GetMessage("AGENT_DEL"),
		"TITLE" => GetMessage("AGENT_DEL"),
		"LINK"  => "javascript:if(confirm('".GetMessage("AGENT_DEL_CONFIRM")."')) ".
			"window.location='".Pol\Generator\Data::getPageName('edit_agent')."?ID=".$ID."&action=delete&lang=".LANG."&".bitrix_sessid_get()."';",
		"ICON"  => "delete",
	);

	$aMenu[] = array(
		"TEXT"=>GetMessage("AGENT_ACTIONS"),
		"TITLE"=>GetMessage("AGENT_ACTIONS"),
		"LINK"=>"",
		"MENU" => $arSubMenu,
		"ICON"=>"btn_new",
	);

}
$context = new CAdminContextMenu($aMenu);
$context->Show();

if($request->get('mess') == "ok" && $ID > 0)
	CAdminMessage::ShowMessage(array("MESSAGE"=>GetMessage("AGENT_SAVED"), "TYPE"=>"OK"));

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
                <span id="hint_ID_IBLOCK"></span><script type="text/javascript">BX.hint_replace(BX('hint_ID_IBLOCK'), '<?=getMessage('ID_IBLOCK_FIELD_HINT')?>');</script>
			<?=$dataKeysMap["ID_IBLOCK"]['title']?>:
            </td>
            <td>
                <select multiple size="2" name="ID_IBLOCK">
                    <?
                    $res = CIBlock::GetList(Array(), Array('TYPE'=>'catalog'), true);
                    while($ar_res = $res->Fetch())
                    {?>
                        <option value="<?=$ar_res['ID']?>"><?=$ar_res['NAME']?> [<?=$ar_res['ID']?>]</option>
                    <?}?>
                </select>
            </td>
	</tr>
	<tr>
		<td>
			<span id="hint_ID_SECTION"></span><script type="text/javascript">BX.hint_replace(BX('hint_ID_SECTION'), '<?=getMessage('VALUE_FIELD_ID_SECTION')?>');</script>
			<?=$dataKeysMap["ID_SECTION"]['title']?>:
		</td>
		<td>
                    <select multiple size="15" name="ID_SECTION">
                        <?
                        $dbIBlockType = CIBlockSection::GetList(array('left_margin' => 'ASC'), array('IBLOCK_ID'=>CATALOG_IBLOCK_ID));
                        while ($arIBlockType = $dbIBlockType->GetNext())
                        {?>
                            <option value="<?=$arIBlockType['ID']?>"><?=$deph_level[$arIBlockType['DEPTH_LEVEL']]?><?=$arIBlockType['NAME']?> [<?=$arIBlockType['ID']?>]</option><?
                        }?>
                    </select>
                    
                    
	</tr>
	<tr>
		<td>
			<span id="hint_ID_RULES"></span><script type="text/javascript">BX.hint_replace(BX('hint_ID_RULES'), '<?=getMessage('VALUE_FIELD_ID_RULES')?>');</script>
			<?=$dataKeysMap["ID_RULES"]['title']?>:
		</td>
		<td>
                    <select multiple size="5" name="ID_RULES">
                    <?$rules = \Pol\Generator\Rules\RulesTable::getList(array(
                        'select' => array('*'),
		
		));
		
		
                    while ($rule_row = $rules->Fetch()){?>
                            <option value="<?=$rule_row['ID_SECTION']?>"><?=$rule_row['NAME']?> [<?=$rule_row['ID_SECTION']?>]</option><?
                        }?>
                    </select>
                </td>
	</tr>
        <tr>
		<td>
			<span id="hint_ID_KEYS"></span><script type="text/javascript">BX.hint_replace(BX('hint_ID_KEYS'), '<?=getMessage('VALUE_FIELD_ID_KEYS')?>');</script>
			<?=$dataKeysMap["ID_KEYS"]['title']?>:
		</td>
		<td><input type="text" name="ID_KEYS" value="<?=htmlspecialcharsbx($arKey["ID_KEYS"]);?>" size="30"></td>
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
		"back_url"=>Pol\Generator\Data::getPageName('edit_agent')."?lang=".LANG,
	)
);
?>

<?$tabControl->End();?>
<?$tabControl->ShowWarnings("post_form", $message);?>

<?echo BeginNote();?>
	<span class="required">*</span> <?= GetMessage("REQUIRED_FIELDS")?>
<?echo EndNote();?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");?>