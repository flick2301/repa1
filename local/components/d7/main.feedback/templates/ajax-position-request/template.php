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

<div class="send-a-request_success_block">
<div class="send-a-request_success">
<div class="send-a-request_success_info">
<div class="send-a-request_success_info_title">Спасибо за вашу заявку</div>
<div class="send-a-request_success_info_text">Наши менеджеры уже обрабатывают ее</div>
<div class="send-a-request_success_info_choice">спасибо что выбрали нас!</div>
</div>
</div>
</div>

<form enctype="multipart/form-data" action="<?=POST_FORM_ACTION_URI?>#sendform" id='position-request' method="POST">
<div class="basic-layout__module basic-layout__module--request send-a-request">


    <div class="send-a-request__header">
        		
    

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

<?}?>
	</div>


    <?=bitrix_sessid_post()?>
    
        <div class="send-a-request__block send-a-request__block--primary">
            
            <div class="send-a-request__item">
                <label class="send-a-request__label" for="send-a-request__phone"></label>
				<input type="text" name="user_tell" placeholder="<?=GetMessage("MFT_TELL")?>" value="<?=$arResult["AUTHOR_TELL"]?>*" class="simple-input send-a-request__input phonemask">
            </div>
            <div class="send-a-request__item">
                <label class="send-a-request__label" for="send-a-request__email"></label>
				<input required="required" type="text" name="user_email" placeholder="<?=GetMessage("MFT_EMAIL")?>*" value="<?=$arResult["AUTHOR_EMAIL"]?>" class="simple-input send-a-request__input">
            </div>
			
            <div class="send-a-request__item">
                <label class="send-a-request__label" for="send-a-request__text"></label>
				<textarea required="required" name="MESSAGE" placeholder="<?=GetMessage("MFT_MESSAGE")?>" class="simple-textarea send-a-request__textarea"><?=$arResult["MESSAGE"]?></textarea>
            </div>	
				<input type="hidden" name="product_name" value="" />
		</div>
        
		
        <div class="send-a-request__block send-a-request__block--comment">
		
<div class="send-a-request__form-result"></div>
    <p class="send-a-request__desc">Просто оставьте свои контактные данные и комментарий. Ваши данные сохранены в соответствии с политикой <a class="underline blue" target="_blank" href="/privacy/">конфиденциальности сайта</a>. А менеджер свяжется с вами в рабочее время и оформит заказ</p>

	<div class="send-a-request__footer">
            <input style='display:none;' id='<?echo ($arParams['HEADER_FORM']=='Y') ? 'header_' : '';?>user_file' name="UPLOAD_FILES" type="file">
          <!--  <a href="javascript:void(0)" onclick="$('#<?echo ($arParams['HEADER_FORM']=='Y') ? 'header_' : '';?>user_file').click();" class="white-btn" style="visibility: hidden">Приложенный файл</a>-->
            <a href="javascript:void(0)" onclick="if (!$(this).hasClass('disable')) $('#position-request').submit();" class="blue-btn main-button send-a-request__submit">Оставить заявку</a>
			<div class="send-a-request__form-errors-block"><div class="send-a-request__form-errors"></div></div>
	
	</div>	
		
		</div>
	

	
	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">

        
	
    
</div>
</form>
<!--send-a-request-->


