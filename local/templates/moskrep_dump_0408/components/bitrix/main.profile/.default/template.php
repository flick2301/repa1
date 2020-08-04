<?
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>

<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array());?>

<h1 class="s38-title"><?=$APPLICATION->ShowTitle();?></h1>

<div class="lk-form">

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



	
	
	<label class="lk-form__label">
            <span class="lk-form__title"><?=GetMessage('NAME')?>:</span>
            <input type="text" name="NAME" value="<?=$arResult["arUser"]["NAME"]?>" class="form__input">
	</label>
        <label class="lk-form__label">
            <span class="lk-form__title"><?=GetMessage('LAST_NAME')?>:</span>
            <input type="text" name="LAST_NAME" value="<?=$arResult["arUser"]["LAST_NAME"]?>" class="form__input">
	</label>
        <label class="lk-form__label">
            <span class="lk-form__title"><?=GetMessage('SECOND_NAME')?>:</span>
            <input type="text" name="SECOND_NAME" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" class="form__input">
	</label>
        <label class="lk-form__label">
            <span class="lk-form__title"><?=GetMessage('EMAIL')?><?if($arResult["EMAIL_REQUIRED"]):?><span class="starrequired">*</span><?endif?></span>
            <input type="text" name="EMAIL" value="<?=$arResult["arUser"]["EMAIL"]?>" class="form__input">
	</label>
	<label class="lk-form__label">
            <span class="lk-form__title"><?=GetMessage('PERSONAL_MANAGER')?></span>
            <input type="text" name="PERSONAL_MANAGER" value="<?=$arResult["arUser"]["PERSONAL_MANAGER"]['UF_NAME']?>" class="form__input" disabled>
	</label>
	
	




	
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
	
        <a href="javascript:void(0);" onclick="BX.submit(BX('form_lk'));"class="blue-btn lk-form__btn">Сохранить</a>
</form>

</div>