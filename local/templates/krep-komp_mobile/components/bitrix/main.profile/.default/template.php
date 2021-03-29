<?
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>

<?globalGetTitle()?>


<?ShowError($arResult["strProfileError"]);?>
<?
if ($arResult['DATA_SAVED'] == 'Y')
	ShowNote(GetMessage('PROFILE_DATA_SAVED'));
?>
<script type="text/javascript">
<!--
var opened_sections = [<?
$arResult["opened"] = $_COOKIE[$arResult["COOKIE_PREFIX"]."_user_profile_open"];
$arResult["opened"] = preg_replace("/[^a-z0-9_,]/i", "", $arResult["opened"]);
if (strlen($arResult["opened"]) > 0)
{
	echo "'".implode("', '", explode(",", $arResult["opened"]))."'";
}
else
{
	$arResult["opened"] = "reg";
	echo "'reg'";
}
?>];
//-->

var cookie_prefix = '<?=$arResult["COOKIE_PREFIX"]?>';
</script>
<form method="post" name="form1" id="form_lk" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
<?=$arResult["BX_SESSION_CHECK"]?>
<input type="hidden" name="lang" value="<?=LANG?>" />
<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />


            <!--user-account-->
            <div class="user-account">
               <div class="user-account__item">
                  <label class="user-account__label" for="user-account__name"><?=GetMessage('NAME')?></label>
                  <input class="simple-input user-account__input" type="text" name="NAME" id="user-account__name" value="<?=$arResult["arUser"]["NAME"]?>">
               </div>
               <div class="user-account__item">
                  <label class="user-account__label" for="user-account__surname"><?=GetMessage('LAST_NAME')?></label>
                  <input class="simple-input user-account__input" type="text" name="LAST_NAME" id="user-account__surname" value="<?=$arResult["arUser"]["LAST_NAME"]?>">
               </div>
               <div class="user-account__item">
                  <label class="user-account__label" for="user-account__midname"><?=GetMessage('SECOND_NAME')?></label>
                  <input class="simple-input user-account__input" type="text" name="SECOND_NAME" id="user-account__midname" value="<?=$arResult["arUser"]["SECOND_NAME"]?>">
               </div>
               <div class="user-account__item">
                  <label class="user-account__label" for="user-account__email"><?=GetMessage('EMAIL')?><?if($arResult["EMAIL_REQUIRED"]):?><span class="starrequired">*</span><?endif?></label>
                  <input class="simple-input user-account__input" type="text" name="EMAIL" id="user-account__email" value="<?=$arResult["arUser"]["EMAIL"]?>">
               </div>
               <div class="user-account__item">
                  <label class="user-account__label" for="user-account__personal"><?=GetMessage('PERSONAL_MANAGER')?></label>
                  <input class="simple-input user-account__input" type="text" name="PERSONAL_MANAGER" id="user-account__personal" value="<?=$arResult["arUser"]["PERSONAL_MANAGER"]['UF_NAME']?>">
               </div>			   
               <div class="user-account__footer">
                  <input onclick="BX.submit(BX('form_lk'));" class="main-button main-button--plus user-account__submit" type="button" value="Сохранить">
               </div>
            </div>
            <!--user-account-->

	




	
	<?// ********************* User properties ***************************************************?>
	<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
	<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('user_properties')"><?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></a></div>
	<div id="user_div_user_properties" class="profile-block-<?=strpos($arResult["opened"], "user_properties") === false ? "hidden" : "shown"?>">
	<table class="data-table profile-table">
		<thead>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		</thead>
		<tbody>
		<?$first = true;?>
		<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
		<tr><td class="field-name">
			<?if ($arUserField["MANDATORY"]=="Y"):?>
				<span class="starrequired">*</span>
			<?endif;?>
			<?=$arUserField["EDIT_FORM_LABEL"]?>:</td><td class="field-value">
				<?$APPLICATION->IncludeComponent(
					"bitrix:system.field.edit",
					$arUserField["USER_TYPE"]["USER_TYPE_ID"],
					array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField), null, array("HIDE_ICONS"=>"Y"));?></td></tr>
		<?endforeach;?>
		</tbody>
	</table>
	</div>
	<?endif;?>
	<?// ******************** /User properties ***************************************************?>
	
        
</form>

