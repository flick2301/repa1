<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $component
 */

//one css for all system.auth.* forms
$APPLICATION->SetAdditionalCSS("/bitrix/css/main/system.auth/flat/style.css");
?>

<div class="basic-layout__section" style="margin-top: 40px; margin-bottom: 40px;">
<?globalGetTitle()?>
</div>



    <div class="content">
      <div class="container">
        <div class="content__wrapper">
		
		


          <div class="auth__block">
            <div class="auth__box">
              <div class="auth__topic">У меня есть аккаунт</div>
			  <?
if(!empty($arParams["~AUTH_RESULT"])):
	$text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
?>
	<div class="alert alert-danger"><?=nl2br(htmlspecialcharsbx($text))?></div>
<?endif?>

<?
if($arResult['ERROR_MESSAGE'] <> ''):
	$text = str_replace(array("<br>", "<br />"), "\n", $arResult['ERROR_MESSAGE']);
?>
	<div class="alert alert-danger"><?=nl2br(htmlspecialcharsbx($text))?></div>
<?endif?>
              <div class="auth__desc">Если у вас есть учетная запись, войдите используя номер вашего телефона</div>

	<form id="form_lk" class="auth__form" name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">

		<input type="hidden" name="AUTH_FORM" value="Y" />
		<input type="hidden" name="TYPE" value="AUTH" />
<?if (strlen($arResult["BACKURL"]) > 0):?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?endif?>
<?foreach ($arResult["POST"] as $key => $value):?>
		<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
<?endforeach?>

                <div class="auth__top">
                  <div class="auth__name">E-mail</div>
                  <input class="auth__input" type="text" name="USER_LOGIN" id="user-account__login" value="<?=$arResult["LAST_LOGIN"]?>" placeholder="">
                </div>
                <div class="auth__top">
                  <div class="auth__name">Пароль</div>
                  <input class="auth__input" type="text" name="USER_PASSWORD" id="user-account__pass" autocomplete="off" placeholder="">
                </div>
				
<?if($arResult["CAPTCHA_CODE"]):?>
		<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />

		<div class="bx-authform-formgroup-container dbg_captha">
			<div class="bx-authform-label-container">
				<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>
			</div>
			<div class="bx-captcha"><img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></div>
			<div class="bx-authform-input-container">
				<input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" />
			</div>
		</div>
<?endif;?>			
				
                <div class="auth__bot">
                  <input onclick="BX.submit(BX('form_lk'));" class="auth__button" type="submit" value="Войти"><a class="auth__link" href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>">Забыл пароль</a>
                </div>
              </form>
            </div>
            <div class="auth__box">
              <div class="auth__topic">Новый пользователь?</div>
              <div class="auth__desc">Создание учетной записи имеет множество преимуществ:</div>
              <div class="auth__list">
                <div class="auth__item">Быстрая оплата</div>
                <div class="auth__item">Создание списка с адресами</div>
                <div class="auth__item">Удобное отслеживание заказов</div>
                <div class="auth__item">Участие в бонусной программе</div>
              </div><a class="auth__button" href="<?=$arResult["AUTH_REGISTER_URL"]?>">Создать аккаунт</a>
            </div>
          </div>

          </div>
          </div>
          </div>





<script type="text/javascript">
<?if (strlen($arResult["LAST_LOGIN"])>0):?>
try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
<?else:?>
try{document.form_auth.USER_LOGIN.focus();}catch(e){}
<?endif?>
</script>

