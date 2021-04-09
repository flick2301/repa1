<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//one css for all system.auth.* forms
$APPLICATION->SetAdditionalCSS("/bitrix/css/main/system.auth/flat/style.css");
?>

<?globalGetTitle()?>


    <div class="content">
      <div class="container">
        <div class="content__wrapper">
		
          <div class="auth__block">
            <div class="auth__box">
			
<?
if(!empty($arParams["~AUTH_RESULT"])):
	$text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
?>
	<div class="alert <?=($arParams["~AUTH_RESULT"]["TYPE"] == "OK"? "alert-success":"alert-danger")?>"><?=nl2br(htmlspecialcharsbx($text))?></div>
<?endif?>

<?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y" && is_array($arParams["AUTH_RESULT"]) &&  $arParams["AUTH_RESULT"]["TYPE"] === "OK"):?>
	<div class="alert alert-success"><?echo GetMessage("AUTH_EMAIL_SENT")?></div>
<?else:?>

<?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
	<div class="alert alert-warning"><?echo GetMessage("AUTH_EMAIL_WILL_BE_SENT")?></div>
<?endif?>



	<form method="post"  id="form_lk" action="<?=$arResult["AUTH_URL"]?>" name="bform" enctype="multipart/form-data">
            <input id="check" name="check" type="hidden" value="" />
<?if($arResult["BACKURL"] <> ''):?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?endif?>
		<input type="hidden" name="AUTH_FORM" value="Y" />
		<input type="hidden" name="TYPE" value="REGISTRATION" />

		
               <div class="user-account__item">
                  <div class="auth__name"><?=GetMessage("AUTH_NAME")?></div>
                  <input class="auth__input" type="text" name="USER_NAME" id="user-account__name" value="<?=$arResult["USER_NAME"]?>">
               </div>	

               <div class="user-account__item">
                  <div class="auth__name"><?=GetMessage("AUTH_LAST_NAME")?></div>
                  <input class="auth__input" type="text" name="USER_LAST_NAME" id="user-account__lastname" value="<?=$arResult["USER_LAST_NAME"]?>">
               </div>	

			    <div class="user-account__item" style="display: none;">
                  <div class="auth__name"><?=GetMessage("AUTH_LOGIN_MIN")?><span class="bx-authform-starrequired">*</span></div>
                  <input class="auth__input" type="text" name="USER_LOGIN" id="user-account__login" value="<?=$arResult["USER_LOGIN"]?>">
               </div>		
			   
			    <div class="user-account__item">
                  <div class="auth__name"><?=GetMessage("AUTH_EMAIL")?><span class="bx-authform-starrequired">*</span></div>
                  <input class="auth__input" type="text" name="USER_EMAIL" id="user-account__email" value="<?=$arResult["USER_EMAIL"]?>">
               </div>			   

			    <div class="user-account__item">
                  <div class="auth__name"><?=GetMessage("AUTH_PASSWORD_REQ")?><span class="bx-authform-starrequired">*</span></div>
                  <input class="auth__input" type="password" name="USER_PASSWORD" id="user-account__pass" value="<?=$arResult["USER_PASSWORD"]?>" autocomplete="off">
               </div>	
<?if($arResult["SECURE_AUTH"]):?>
				<div class="bx-authform-psw-protected" id="bx_auth_secure" style="display:none"><div class="bx-authform-psw-protected-desc"><span></span><?echo GetMessage("AUTH_SECURE_NOTE")?></div></div>	
<script type="text/javascript">
document.getElementById('bx_auth_secure').style.display = '';
</script>
<?endif?>

		<div class="user-account__item">
        <div class="auth__name"><?=GetMessage("AUTH_CONFIRM")?><span class="bx-authform-starrequired">*</span></div>
        <input class="auth__input" type="password" name="USER_CONFIRM_PASSWORD" id="user-account__passconfirm" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" autocomplete="off">	</div>	

<?if($arResult["SECURE_AUTH"]):?>		
<div class="bx-authform-psw-protected" id="bx_auth_secure_conf" style="display:none"><div class="bx-authform-psw-protected-desc"><span></span><?echo GetMessage("AUTH_SECURE_NOTE")?></div></div>	
<script type="text/javascript">
document.getElementById('bx_auth_secure_conf').style.display = '';
</script>
<?endif?>

<br />	



<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
	<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>

		<div class="bx-authform-formgroup-container">
			<div class="bx-authform-label-container"><?if ($arUserField["MANDATORY"]=="Y"):?><span class="bx-authform-starrequired">*</span><?endif?><?=$arUserField["EDIT_FORM_LABEL"]?></div>
			<div class="bx-authform-input-container">
<?
$APPLICATION->IncludeComponent(
	"bitrix:system.field.edit",
	$arUserField["USER_TYPE"]["USER_TYPE_ID"],
	array(
		"bVarsFromForm" => $arResult["bVarsFromForm"],
		"arUserField" => $arUserField,
		"form_name" => "bform"
	),
	null,
	array("HIDE_ICONS"=>"Y")
);
?>
			</div>
		</div>

	<?endforeach;?>
<?endif;?>





<?if ($arResult["USE_CAPTCHA"] == "Y"):?>

		<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />

		<div class="bx-authform-formgroup-container">
			<div class="bx-authform-label-container">
				<span class="bx-authform-starrequired">*</span><?=GetMessage("CAPTCHA_REGF_PROMT")?>
			</div>
			<div class="bx-captcha"><img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></div>
			<div class="user-account__item">
				<input type="text" id="captcha_word_registration" style="max-width: 180px;" class="auth__input" name="captcha_word" maxlength="50" value="" autocomplete="off"/>
			</div>
		</div>

<?endif?>
		<div class="bx-authform-formgroup-container">
			<div class="bx-authform-label-container">
			</div>
			<div class="bx-authform-input-container">
				<?$APPLICATION->IncludeComponent("bitrix:main.userconsent.request", "",
					array(
						"ID" => COption::getOptionString("main", "new_user_agreement", ""),
						"IS_CHECKED" => "Y",
						"AUTO_SAVE" => "N",
						"IS_LOADED" => "Y",
						"ORIGINATOR_ID" => $arResult["AGREEMENT_ORIGINATOR_ID"],
						"ORIGIN_ID" => $arResult["AGREEMENT_ORIGIN_ID"],
						"INPUT_NAME" => $arResult["AGREEMENT_INPUT_NAME"],
						"REPLACE" => array(
							"button_caption" => GetMessage("AUTH_REGISTER"),
							"fields" => array(
								rtrim(GetMessage("AUTH_NAME"), ":"),
								rtrim(GetMessage("AUTH_LAST_NAME"), ":"),
								rtrim(GetMessage("AUTH_LOGIN_MIN"), ":"),
								rtrim(GetMessage("AUTH_PASSWORD_REQ"), ":"),
								rtrim(GetMessage("AUTH_EMAIL"), ":"),
							)
						),
					)
				);?>
			</div>
		</div>


		<div class="bx-authform-description-container">
			<?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?>
		</div>

		<div class="bx-authform-description-container">
			<span class="bx-authform-starrequired">*</span><?=GetMessage("AUTH_REQ")?>
		</div>
		
                <div class="auth__bot">
                  <input onclick="document.getElementById('check').value = 'stopSpam_yes';" class="auth__button" type="submit" name="Register" value="<?=GetMessage("AUTH_REGISTER")?>"><a class="auth__link" href="<?=$arResult["AUTH_AUTH_URL"]?>"><?=GetMessage("AUTH_AUTH")?></a>
                </div>		

	</form>
	

<script type="text/javascript">
document.bform.USER_NAME.focus();
</script>

<?endif?>			
</div>			
</div>

</div>
</div>
</div>












