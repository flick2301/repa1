<?php
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */

?>

<a name="sendform"></a>

<?if($arParams['MOBILE_VERSION']=='Y'):?>
    <h2 class="s22-title">Отправить заявку</h2>
<?else:?>
    <div class="box-modal__head mfeedback">
	<div class="box-modal__title">Отправить заявку</div>
	<div class="popUp-close"></div>
    </div>
<?endif;?>
<?if(!empty($arResult["ERROR_MESSAGE"]))
{
    foreach($arResult["ERROR_MESSAGE"] as $v)
	{
		?><div class='header-form-feedback'><?
	ShowError($v);
		?></div>
		<script>
		$(document).ready(function(){
		$('.header-form-feedback').popUp();
		});</script><?
	}
}
if(strlen($arResult["OK_MESSAGE"]) > 0)
{
    ?><div class='header-form-feedback'><?=$arResult["OK_MESSAGE"]?></div>
		<script>
		$(document).ready(function(){
		$('.header-form-feedback').popUp();
		});</script><p><?=$arResult["OK_MESSAGE"]?></p>
	<script type="text/javascript">
	//setTimeout(function() { window.location.href="<?=$APPLICATION->GetCurPage(false)?>" }, 2000);
    window.onload = function() {



        yaCounter29426710.reachGoal('SendMessage');
		ga('send', 'event', 'Сообщения', 'Отправка сообщение');

    };

	</script>
	<?
       
}else{
?>
    <p>Просто оставьте свои контактные данные и комментарий. Ваши данные сохранены в соответствии с политикой <a href="javascript:void(0);">конфиденциальности сайта</a>. А менеджер свяжется с вами в рабочее время и оформит заказ</p>
<?}?>


<form enctype="multipart/form-data" action="<?=POST_FORM_ACTION_URI?>#sendform" id='<?echo ($arParams['HEADER_FORM']=='Y') ? 'header_feedback_form' : 'feedback_form';?>' method="POST">
    <?=bitrix_sessid_post()?>
    <div class="feedback-form">
        <div class="feedback-form__left">
            <label class="feedback-form__label">
		<span class="feedback-form__title"><?=GetMessage("MFT_NAME")?>:</span>
		<input type="text" value="<?=$arResult["AUTHOR_NAME"]?>" name="user_name" class="form__input">
            </label>
            <label class="feedback-form__label">
		<span class="feedback-form__title"><?=GetMessage("MFT_TELL")?>:</span>
		<input type="text" name="user_tell" value="<?=$arResult["AUTHOR_TELL"]?>" class="form__input">
            </label>
            <label class="feedback-form__label">
		<span class="feedback-form__title"><?=GetMessage("MFT_EMAIL")?>:</span>
		<input type="text" name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>" class="form__input">
            </label>
	</div>
        <input type="hidden" value="<?=$_COOKIE["roistat_visit"]?>" name="roistat_visit" id="WEB_FORM_<?=$_COOKIE["roistat_visit"]?>"  class="form__input"> 
        <div class="feedback-form__right">
            <label class="feedback-form__label">
		<span class="feedback-form__title"><?=GetMessage("MFT_MESSAGE")?>:</span>
		<textarea name="MESSAGE" class="form__textarea"><?=$arResult["MESSAGE"]?></textarea>
            </label>
	</div>
	
<div class="feedback-form__center">	
	<?$APPLICATION->IncludeComponent("bitrix:main.file.input", "moskrep",
   array(
                       "INPUT_NAME"=>"DOPFILE",
                       "MULTIPLE"=>"Y",
                       "MODULE_ID"=>"iblock",
                       "MAX_FILE_SIZE"=>"10485760",//25000000 25mb
                       "ALLOW_UPLOAD"=>"F", 
					   "ALLOW_UPLOAD_EXT"=>"doc,docx,pdf,jpg,jpeg,png,bmp,xml,xls,xlsx,txt,html",
                       "INPUT_CAPTION" => "Добавить файлы",
                       "INPUT_VALUE" => $_POST["DOPFILE"]
                     ),
                     false
);?>	
</div>

	<div class="feedback-form__bottom">

            <input style='display:none;' id='<?echo ($arParams['HEADER_FORM']=='Y') ? 'header_' : '';?>user_file' name="UPLOAD_FILES" type="file">
            <a href="javascript:void(0)" onclick="$('#<?echo ($arParams['HEADER_FORM']=='Y') ? 'header_' : '';?>user_file').click();" class="white-btn" style="visibility: hidden">Приложенный файл</a>
            <a href="javascript:void(0)" onclick="$('#<?echo ($arParams['HEADER_FORM']=='Y') ? 'header_feedback_form' : 'feedback_form';?>').submit();" class="blue-btn">Отправить запрос</a>
	</div>

	

	
	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
        
	
    </div>
</form>



