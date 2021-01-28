<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<div class="callback-formblock">



<?=$arResult["FORM_NOTE"]?>

<?if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>
<?
if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y")
{
?>
<div class="callback-formblock-description">
<div class="callback-formblock-description-logo"></div>
<?
/***********************************************************************************
					form header
***********************************************************************************/
if ($arResult["isFormTitle"])
{
?>
	<h3 class="callback-formblock-description-title"><?=$arResult["FORM_TITLE"]?></h3>
<?
} //endif ;

	if ($arResult["isFormImage"] == "Y")
	{
	?>
	<a href="<?=$arResult["FORM_IMAGE"]["URL"]?>" target="_blank" alt="<?=GetMessage("FORM_ENLARGE")?>"><img src="<?=$arResult["FORM_IMAGE"]["URL"]?>" <?if($arResult["FORM_IMAGE"]["WIDTH"] > 300):?>width="300"<?elseif($arResult["FORM_IMAGE"]["HEIGHT"] > 200):?>height="200"<?else:?><?=$arResult["FORM_IMAGE"]["ATTR"]?><?endif;?> hspace="3" vscape="3" border="0" /></a>
	<?//=$arResult["FORM_IMAGE"]["HTML_CODE"]?>
	<?
	} //endif
	?>

			<p><?if ($arResult["isFormErrors"] == "Y"):?><div class="callback-formblock-errortext"><?=$arResult["FORM_ERRORS_TEXT"];?></div><?else:?><?=$arResult["FORM_DESCRIPTION"]?><?endif;?></p>
</div>
	<?
} // endif
	?>

<?
/***********************************************************************************
						form questions
***********************************************************************************/
?>
	
<div class="callback-formblock-questions">	
	<?
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
		if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
		{
			echo $arQuestion["HTML_CODE"];
		}
		else
		{ 
?>
			<div class="callback-formblock-questions-inputblock">
				<?if ($arQuestion["REQUIRED"] == "Y"):?><?//=$arResult["REQUIRED_SIGN"];?><?endif;?>
				<?if ($arQuestion["REQUIRED"] == "Y" && false):?><?$arQuestion["HTML_CODE"] = str_replace("/>", " required='true'/>", $arQuestion["HTML_CODE"])?><?endif;?>
				<?=$arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />".$arQuestion["IMAGE"]["HTML_CODE"] : ""?>
			<?=str_replace("/>", " placeholder='".($arQuestion["CAPTION"]=="Телефон" ? "+7" : $arQuestion["CAPTION"])."'/>", $arQuestion["HTML_CODE"])?>
			</div>
			
	<?
		}
	} //endwhile
	?>
	
	
	
<?
if($arResult["isUseCaptcha"] == "Y")
{
?>
			<?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?>

			<input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" /></td>

			<?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?>
			<input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />

<?
} // isUseCaptcha
?>



				<input class="callback-formblock-submit" rel="SIMPLE_FORM_<?=$arParams["WEB_FORM_ID"]?>" <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
				
				<div class="callback-formblock-consent"><input id="consent_<?=$arParams["WEB_FORM_ID"]?>" type="checkbox" /><label for="consent_<?=$arParams["WEB_FORM_ID"]?>"><span>Соглашаюсь с политикой обработки конфиденциальных данных</span></label></div>
</div>				




<p class="d-none">
<?=$arResult["REQUIRED_SIGN"];?> - <?=GetMessage("FORM_REQUIRED_FIELDS")?>
</p>


<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>

</div>