<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Localization\Loc;
?>

<?if ($arResult['ORDER_STEP'] == 3) { ?>
    <a class="btn btn_black btn_large btn_stepback" href="#" onclick="submitForm(2)">Назад</a>
    <button type="button" class="btn btn_yellow btn_large" onclick="submitForm('Y');yaCounter24179866.reachGoal('podtverdit_zakaz');ga('send', 'pageview', '/oformit');ga('send', 'event', 'button5', 'confirm_order'); return true;" id="ORDER_CONFIRM_BUTTON">
        <?=Loc::getMessage("SOA_TEMPL_BUTTON")?>
    </button>
    <br><br>
    <span style="font-size: 12px; color: #aaa; font-weight: 300">Нажимая на кнопку, вы подтверждаете свое совершеннолетие, соглашаетесь на <a href="/soglasie/" target="_blank" style="text-decoration: underline">обработку персональных данных</a> в соответствии с Условиями, а также вы принимаете условия <a href="/oferta/" target="_blank" style="text-decoration: underline">публичной оферты</a> </span>
<? } elseif ($arResult['ORDER_STEP'] == 2) { ?>
    <a class="btn btn_black btn_large btn_stepback" href="#" onclick="submitForm(1)">Другой способ доставки</a>
    <button type="button" onclick="submitForm(3);yaCounter24179866.reachGoal('step_payment');yaCounter24179866.reachGoal('delivery_complete');ga('send', 'pageview', '/step_payment');" class="btn btn_yellow btn_large" id="next_step_btn">Продолжить</button>
<?}?>
