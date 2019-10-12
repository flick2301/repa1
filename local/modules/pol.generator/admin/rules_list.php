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

$context = \Bitrix\Main\Application::getInstance()->getContext();
$request = $context->getRequest();

$sTableID = 'generator_rules';

$oSort = new CAdminSorting($sTableID, "ID", "desc");
$arOrder = (strtoupper($by) === "ID" ? array($by => $order) : array($by => $order, "TIMESTAMP_X" => "desc"));
$lAdmin = new CAdminList($sTableID, $oSort);

function cmpPosition($a, $b)
{
	if ($a["position"] == $b["position"]) {
		return 0;
	}
	return ($a["position"] < $b["position"]) ? -1 : 1;
}

function CheckFilter()
{
	global $FilterArr, $lAdmin;
	foreach ($FilterArr as $f) global $$f;

	return count($lAdmin->arFilterErrors) == 0;
}

$FilterArr = Array(
	"find_id",
	
);

$lAdmin->InitFilter($FilterArr);

if (CheckFilter())
{
	$arFilter = Array(
		"ID"		    => $find_id,
		
	);

	
}
$arFilter = array_filter($arFilter);
$listParams = array();
$listParams["order"] = $arOrder;
if ($arFilter){
	$listParams["filter"] = $arFilter;
}

if($lAdmin->EditAction())
{
	foreach($FIELDS as $ID=>$arFields)
	{
		if(!$lAdmin->IsUpdated($ID))
			continue;

		$DB->StartTransaction();
		$ID = IntVal($ID);
		$rsData = Pol\Generator\Rules\DB::getById($ID);
		if($arData = $rsData->Fetch())
		{
			foreach($arFields as $key=>$value){

				if (in_array($key,array("ACTIVE_TO","ACTIVE_FROM")) && $value){
					$arData[$key]= new \Bitrix\Main\Type\DateTime(ConvertTimeStamp(AddTime(MakeTimeStamp($value), 1, "D"), "FULL"));
				}else{
					$arData[$key] = $value;
				}
			}
			$res = Pol\Generator\Rules\DB::update($ID, $arData);
			if(!$res->isSuccess())
			{
				$lAdmin->AddGroupError(GetMessage("KEY_SAVE_ERROR")." ".implode("<br>", $res->getErrorMessages()), $ID);
			}
		}
		else
		{
			$lAdmin->AddGroupError(GetMessage("KEY_SAVE_ERROR")." ".GetMessage("KEY_DOES_NOT_EXIST"), $ID);
			$DB->Rollback();
		}
		$DB->Commit();
	}
}

if(($arID = $lAdmin->GroupAction()))
{
	if($request->get('action_target') == 'selected')
	{
		$rsData = Pol\Generator\Rules\DB::getList($listParams);
		while($arRes = $rsData->Fetch())
			$arID[] = $arRes['ID'];
	}

	foreach($arID as $ID)
	{
		if(strlen($ID)<=0)
			continue;

		$ID = IntVal($ID);
		switch($request->get('action_button'))
		{
			case "delete":
				@set_time_limit(0);
				$res = Pol\Generator\Rules\DB::delete($ID);
				if(!$res->isSuccess())
				{
					$lAdmin->AddGroupError(GetMessage("KEY_DEL_ERROR"), $ID);
					$lAdmin->AddGroupError($res->getErrorMessages(), $ID);
				}
				break;

			// активация/деактивация
			case "activate":
			case "deactivate":
				$rsData = Pol\Generator\Rules\DB::getById($ID);
				if($rsData->Fetch())
				{
					$arFields["ACTIVE"] = ($request->get('action_button') == "activate" ? "Y" : "N");
					$res = Pol\Generator\Rules\DB::update($ID, $arFields);
					if(!$res->isSuccess())
						$lAdmin->AddGroupError(GetMessage("KEY_SAVE_ERROR")." ".implode("<br>", $res->getErrorMessages()), $ID);
				}
				else
					$lAdmin->AddGroupError(GetMessage("KEY_SAVE_ERROR")." ".GetMessage("KEY_DOES_NOT_EXIST"), $ID);
				break;
		}

	}
}

//ЛЛЛЛЛЛЛЛЛЛЛЛЛЛЛИИИИИИИИИИИИИИИИИИИИИССССССССССССССССССССССТТТТТТТТТТТТТТТТТТТ
$rsData = Pol\Generator\Rules\DB::getList($listParams);

$rsData = new CAdminResult($rsData, $sTableID);

$rsData->NavStart();

$lAdmin->NavText($rsData->GetNavPrint(getMessage("KEYS_NAV_TEXT")));

$arUsersCache = array();

$columns = Pol\Generator\Rules\RulesTable::getMap();

//IIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII
$defaultHeaders = array("ID" => 100, "ID_SECTION"=>200, "NAME"=>300, "TITLE_CART"=>400, "KEYWORDS_CART"=>500, "DESCRIPTION_CART"=>600, "ALT_CART"=>700, "TITLE_PIC_CART"=>800, "TITLE_CAT"=>900, "KEYWORDS_CAT"=>1000, "DESCRIPTION_CAT"=>1100, "ALT_MINI_CART"=>1200, "TITLE_PIC_MINI_CART"=>1300, "TITLE_HREF_MINI_CART"=>1400, "TITLE_MENU"=>1500, "ALT_LOGO"=>1500, "ROOT_NAME"=>1600, "ROOT_DESCRIPTION"=>1700);
$headers = array();
foreach($columns as $key=>$head){
	

	$headers[] = array(
		"id"       => $key,
		"content"  => array_pop($head),
		
		
	);
}




if ($headers){
	usort($headers, "cmpPosition");
	$lAdmin->AddHeaders($headers);
}



while($arRes = $rsData->NavNext(true, "f_")):

	

	$row =& $lAdmin->AddRow($f_ID, $arRes);

	

	$arActions = Array();

	$arActions[] = array(
		"ICON"=>"edit",
		"DEFAULT"=>true,
		"TEXT"=> "Изменить",
		"ACTION"=>$lAdmin->ActionRedirect(Pol\Generator\Data::getPageName('edit_rule')."?ID=".$f_ID.'&lang='.LANG)
	);

	

	

	

	$arActions[] = array(
		"ICON"=>"delete",
		"TEXT"=>"Удалить",
		"ACTION"=>"if(confirm('".GetMessage('DEL_CONF')."')) ".$lAdmin->ActionDoGroup($f_ID, "delete")
	);


	

	$row->AddActions($arActions);

endwhile;

//IIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII

$lAdmin->AddFooter(
	array(
		array("title"=>GetMessage("MAIN_ADMIN_LIST_SELECTED"), "value"=>$rsData->SelectedRowsCount()),
		array("counter"=>true, "title"=>GetMessage("MAIN_ADMIN_LIST_CHECKED"), "value"=>"0"),
	)
);

$lAdmin->AddGroupActionTable(Array(
	"delete"=>GetMessage("MAIN_ADMIN_LIST_DELETE"),
	"activate"=>GetMessage("MAIN_ADMIN_LIST_ACTIVATE"),
	"deactivate"=>GetMessage("MAIN_ADMIN_LIST_DEACTIVATE"),
));

$aContext = array(
	array(
		"TEXT"=> GetMessage("KEY_ADD_TITLE"),
		"LINK"=> Pol\Generator\Data::getPageName('edit_rule')."?lang=".LANG,
		"TITLE"=>GetMessage("KEY_ADD_TITLE"),
		"ICON"=>"btn_new",
	),
);

$lAdmin->AddAdminContextMenu($aContext);

$lAdmin->CheckListMode();

$APPLICATION->SetTitle(GetMessage("KEYS_TITLE"));
//КОНЕЦ ЛЛЛЛЛЛЛЛЛЛЛЛЛЛЛИИИИИИИИИИИИИИИИИИИИИССССССССССССССССССССССТТТТТТТТТТТТТТТТТТТ

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");?>


<?

if ($moduleMode == 2){
	echo BeginNote();
	echo GetMessage("DEMO_INFO");
	echo EndNote();
}

$oFilter = new CAdminFilter(
	$sTableID."_filter",
	array(
		"ID",
		
	)
);
?>

<form name="find_form" method="get" action="<?echo $APPLICATION->GetCurPage();?>">
	<?$oFilter->Begin();?>
	<tr>
		<td><?="ID"?>:</td>
		<td>
			<input type="text" name="find_id" size="47" value="<?echo htmlspecialchars($find_id)?>">
		</td>
	</tr>
	
	<?
	$oFilter->Buttons(array("table_id"=>$sTableID,"url"=>$APPLICATION->GetCurPage(),"form"=>"find_form"));
	$oFilter->End();
	?>
</form>
<?
	$lAdmin->DisplayList();
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");?>