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
<!--send-a-request-->
<a id="sendform"></a>
<form enctype="multipart/form-data" action="<?=POST_FORM_ACTION_URI?>#sendform" id='<?echo ($arParams['HEADER_FORM']=='Y') ? 'header_feedback_form' : 'feedback_form';?>' method="POST">
<div class="basic-layout__module basic-layout__module--request send-a-request">

    <div class="send-a-request__header">
        <div class="send-a-request__title">Отправить заявку</div>
		
    

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
	
dataLayerSendForm();//Отправка формы в DataLayer	
		
		$(document).ready(function(){
		$('.header-form-feedback').popUp();
		});</script><p><?=$arResult["OK_MESSAGE"]?></p>
	<script type="text/javascript">
	//setTimeout(function() { window.location.href="<?=$APPLICATION->GetCurPage(false)?>" }, 2000);
    window.onload = function() {



        yaCounter29426710.reachGoal('SendMessage');
		//ga('send', 'event', 'Сообщения', 'Отправка сообщение');

    };

	</script>
	<?
       
}else{
?>
    <p class="send-a-request__desc">Просто оставьте свои контактные данные и комментарий. Ваши данные сохранены в соответствии с политикой <a class="underline blue" target="_blank" href="/privacy/">конфиденциальности сайта</a>. А менеджер свяжется с вами в рабочее время и оформит заказ</p>
<?}?>
	</div>


    <?=bitrix_sessid_post()?>
    
        <div class="send-a-request__block send-a-request__block--primary">
            <div class="send-a-request__item">
                <label class="send-a-request__label" for="send-a-request__name"><?=GetMessage("MFT_NAME")?>:</label>
				<input type="text" value="<?=$arResult["AUTHOR_NAME"]?>" name="user_name" class="simple-input send-a-request__input">
            </div>
            <div class="send-a-request__item">
                <label class="send-a-request__label" for="send-a-request__phone"><?=GetMessage("MFT_TELL")?>:</label>
				<input type="text" name="user_tell" value="<?=$arResult["AUTHOR_TELL"]?>" class="simple-input send-a-request__input">
            </div>
            <div class="send-a-request__item">
                <label class="send-a-request__label" for="send-a-request__email"><?=GetMessage("MFT_EMAIL")?>:</label>
				<input type="text" name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>" class="simple-input send-a-request__input">
            </div>
		</div>
        <input type="hidden" value="<?=$_COOKIE["roistat_visit"]?>" name="roistat_visit" id="WEB_FORM_<?=$_COOKIE["roistat_visit"]?>"  class="form__input"> 
        <div class="send-a-request__block send-a-request__block--comment">
            <div class="send-a-request__item">
                <label class="send-a-request__label" for="send-a-request__text"><?=GetMessage("MFT_MESSAGE")?>:</label>
				<textarea name="MESSAGE" class="simple-textarea send-a-request__textarea"><?=$arResult["MESSAGE"]?></textarea>
            </div>
		</div>
<!--	
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
-->

	<div class="send-a-request__footer">

            <input style='display:none;' id='<?echo ($arParams['HEADER_FORM']=='Y') ? 'header_' : '';?>user_file' name="UPLOAD_FILES" type="file">
          <!--  <a href="javascript:void(0)" onclick="$('#<?echo ($arParams['HEADER_FORM']=='Y') ? 'header_' : '';?>user_file').click();" class="white-btn" style="visibility: hidden">Приложенный файл</a>-->
            <a href="javascript:void(0)" onclick="$('#<?echo ($arParams['HEADER_FORM']=='Y') ? 'header_feedback_form' : 'feedback_form';?>').submit();" class="blue-btn main-button send-a-request__submit">Отправить запрос</a>
	</div>

	

	
	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
        
	
</div>   
</form>
<!--send-a-request-->


