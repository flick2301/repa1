<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @var array $arParams
 * @var array $arResult
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @global CDatabase $DB
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $templateFile
 * @var string $templateFolder
 * @var string $componentPath
 * @var CBitrixComponent $component
 */

include_once $_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/functions.php";

use Bitrix\Main\Localization\Loc;
use Bitrix\Sale\Location\Admin\LocationHelper;
use Bitrix\Sale\Location\TypeTable;
use Bitrix\Main\Page\Asset;



if ($USER->IsAuthorized() || $arParams["ALLOW_AUTO_REGISTER"] == "Y") {
	if ($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y") {
		if (strlen($arResult["REDIRECT_URL"]) > 0) {
			$APPLICATION->RestartBuffer();
			?>
			<script type="text/javascript">
				window.top.location.href = '<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';
			</script>
			<?
			die();
		}
	}
}
?>

<a name="order_form"></a>

<div id="order_form_div" class="checkout">
	<NOSCRIPT>
		<div class="errortext"><?= Loc::getMessage("SOA_NO_JS") ?></div>
	</NOSCRIPT>

	<div class="bx_order_make">
		<?
		if (!$USER->IsAuthorized() && $arParams["ALLOW_AUTO_REGISTER"] == "N") {
			if (!empty($arResult["ERROR"])) {
				foreach ($arResult["ERROR"] as $v) {
					echo ShowError($v);
				}
				echo '<br>';
			} elseif (!empty($arResult["OK_MESSAGE"])) {
				foreach ($arResult["OK_MESSAGE"] as $v) {
					echo ShowNote($v);
				}
                echo '<br>';
			}
		} else {
			if ($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y") {
				if (strlen($arResult["REDIRECT_URL"]) == 0) {
					include_once $_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/confirm.php";
				}
			} else {
	            ?>
                <script type="text/javascript">
                    var kladrToken = '<?= KLADR_TOKEN ?>';
                    var deliveryShoplogisticId = '<?= DELIVERY_SHOPLOGISTIC_ID ?>';
                    var deliveryShoplogisticCourierId = '<?= DELIVERY_SHOPLOGISTIC_COURIER_ID ?>';
                    var deliveryCompanyFilialMskId = '<?= DELIVERY_TRX_FILIAL_MSK_ID ?>';
                    var deliveryCompanyFilialSpbId = '<?= DELIVERY_TRX_FILIAL__SPB_ID ?>';
					var deliveryCourierMscSpb = '<?= DELIVERY_COURIER_MSK_SPB_ID ?>';
                    var deliveryDellinId = '<?= DELIVERY_DELLIN_ID ?>';
                    var deliveryRuspostId = '<?= DELIVERY_RUSPOST_ID ?>';
                </script>

                <form action="<?=$APPLICATION->GetCurPage();?>" method="POST" name="ORDER_FORM" id="ORDER_FORM" enctype="multipart/form-data">
                    <?=bitrix_sessid_post()?>

                    <div id="order_form_content">
                        <? if ($_POST["is_ajax_post"] == "Y") { ?>
                            <? $APPLICATION->RestartBuffer(); ?>
                        <? } ?>

                        <div class="checkout__head">
                            <ul class="head__links">
                                <li class="links__entry <?= $arResult['ORDER_STEP'] == 1 ? 'links__entry_current order_tab__current' : '' ?>" order_tab>
                                <a href="javascript:void(0);" onclick="<?= $arResult['ORDER_STEP'] > 1 ? 'submitForm(1)' : '' ?>" class="links__lnk">Способ доставки</a>
                                </li>
                                <li class="links__entry<?= ($_POST["is_ajax_post"] == "Y" ? '' : ' nohover') . ($arResult['ORDER_STEP'] == 2 ? ' links__entry_current order_tab__current' : '') ?>" order_tab>
                                <a href="javascript:void(0);" onclick="<?= $arResult['ORDER_STEP'] != 2 && $_POST["is_ajax_post"] == "Y" ? 'submitForm(2)' : '' ?>" class="links__lnk">детали заказа</a>
                                </li>
                                <li class="links__entry<?= ($arResult['ORDER_STEP'] == 1 ? ' nohover' : '') . ($arResult['ORDER_STEP'] == 3 ? ' links__entry_current order_tab__current' : '') ?>" order_tab>
                                <a href="javascript:void(0);" onclick="<?= $arResult['ORDER_STEP'] == 2 ? 'submitForm(3)' : '' ?>" class="links__lnk">способ оплаты</a>
                                </li>
                            </ul>
                        </div>

                        <? if ($_REQUEST['PERMANENT_MODE_STEPS'] == 1) { ?>
                            <input type="hidden" name="PERMANENT_MODE_STEPS" value="1" />
                        <? } ?>

                        <?
                        if ($arResult['ORDER_STEP'] == 1) {
                            include_once $_SERVER['DOCUMENT_ROOT'] . $templateFolder . '/properties.php';
                            include_once $_SERVER['DOCUMENT_ROOT'] . $templateFolder . '/delivery.php';
                        } else {
                            include_once $_SERVER['DOCUMENT_ROOT'] . $templateFolder . '/delivery.php';
                            include_once $_SERVER['DOCUMENT_ROOT'] . $templateFolder . '/properties.php';
                        }
                        include_once $_SERVER['DOCUMENT_ROOT'] . $templateFolder . '/payment.php';
                        ?>

                        <p class="system-message_error" id="bx_order_error">
                            <? if ($arResult['SHOW_ERRORS']) {	?>
                                <?= implode('<br>', $arResult["ERROR"]) ?>
                                <script type="text/javascript">
                                    top.BX.scrollToNode(top.BX('bx_order_error'));
                                </script>
                            <? } ?>
                        </p>
                        <br>

                        <?
                        include_once $_SERVER['DOCUMENT_ROOT'] . $templateFolder . '/summary.php';

                        if (strlen($arResult['PREPAY_ADIT_FIELDS']) > 0) {
                            echo $arResult['PREPAY_ADIT_FIELDS'];
                        }
                        ?>

                        <? if ($_POST["is_ajax_post"] == "Y") { ?>
                            <script type="text/javascript">
                                top.BX('confirmorder').value = 'Y';
                                top.BX('profile_change').value = 'N';
                            </script>
                            <? die();
                        } ?>
                    </div>

                    <?
                    $weight = $arResult['ORDER_WEIGHT'];
                    if (empty($weight)) {
                        $weight = 0;
                        foreach ($arResult['GRID']['ROWS'] as $item) {
                            $weight += (int)$item['data']['QUANTITY'];
                        }
                    }
                    ?>
                    <input type="hidden" name="confirmorder" id="confirmorder" value="Y">
                    <input type="hidden" name="profile_change" id="profile_change" value="N">
                    <input type="hidden" name="is_ajax_post" id="is_ajax_post" value="Y">
                    <input type="hidden" name="step" id="step" value="<?= $arResult['ORDER_STEP'] ?>">
                    <input type="hidden" name="order_price" id="order_price" value="<?= $arResult['ORDER_PRICE'] ?>">
                    <input type="hidden" name="order_weight" id="order_weight" value="<?= $weight ?>">
                    <input type="hidden" name="json" value="Y">
                </form>
				<?
			}
		} ?>
	</div>
    


</div>