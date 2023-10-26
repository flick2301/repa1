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


<div class='callback_form' id='callback_form'>
<div class="box-modal__head">
	  <div class="box-modal__title"></div>
      	  <div onclick="$('.callback_form').hide();" class="popUp-close"></div>
	</div>
<form enctype="multipart/form-data" action="<?=POST_FORM_ACTION_URI?>#sendform" id='phone-request' method="POST">
<div class="basic-layout__module basic-layout__module--request send-a-request phone-request-send">


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
				<input type="text" name="user_phone" placeholder="<?=GetMessage("MFT_TELL")?>" value="<?=$arResult["AUTHOR_TELL"]?>*" class="simple-input send-a-request__input phonemask">
            </div>
			<div class="send-a-request__item">
                <label class="send-a-request__label" for="send-a-request__name"></label>
				<input type="text" name="user_name" placeholder="Имя" value="" class="simple-input">
            </div>
			<div class="send-a-request__item">
				
					<select name="user_face" class="simple-input">
						<option value="Юр. лицо">Юр. лицо</option>
						<option value="Физ. лицо">Физ. лицо</option>
        			</select>
			</div>
            
				<input type="hidden" name="product_name" value="" />
		</div>
        
		
        <div class="send-a-request__block send-a-request__block--comment">
		
<div class="send-a-request__form-result"></div>
    <p class="send-a-request__desc">Оставьте заявку на обратный звонок! Менеджеры свяжутся с Вами в течении 15мин.<br><span style='color:red;'>Все поля обязательны для заполнения!</span></p>

	<div class="send-a-request__footer">
            <input style='display:none;' id='<?echo ($arParams['HEADER_FORM']=='Y') ? 'header_' : '';?>user_file' name="UPLOAD_FILES" type="file">
          <!--  <a href="javascript:void(0)" onclick="$('#<?echo ($arParams['HEADER_FORM']=='Y') ? 'header_' : '';?>user_file').click();" class="white-btn" style="visibility: hidden">Приложенный файл</a>-->
            <div  class="blue-btn main-button send-a-request__submit phone_submit_button">Оставить заявку</div>
			<div class="send-a-request__form-errors-block"><div class="send-a-request__form-errors"></div></div>
	
	</div>	
		
		</div>
	

	
	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">

        
	
    
</div>
</form>
<!--send-a-request-->
</div>


