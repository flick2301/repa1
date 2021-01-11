<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

if (!empty($arResult["DELIVERY"])) {
    if ($arResult['ORDER_STEP'] == 1) {
        ?>

		
        <div class="checkout__delivery-type" <?= $_POST['is_ajax_post'] == 'Y' ? 'style="display: block;"' : '' ?>>
            <ul class="type__list">
                <? foreach ($arResult["DELIVERY"] as $delivery) { ?>
                    <li class="type__entry" <?= in_array($delivery["ID"], [DELIVERY_TRX_FILIAL_MSK_ID, DELIVERY_TRX_FILIAL__SPB_ID, DELIVERY_COURIER_MSK_SPB_ID])
                        ? 'style="display:none;"' : '' ?>>
                        <label class="radio__custom">
                            <input type="radio" class="custom__input" id="DELIVERY_ID_<?= $delivery["ID"] ?>"
                                   name="<?= $delivery["FIELD_NAME"] ?>"
                                   value="<?= $delivery["ID"] ?>"
                                <?= $delivery["CHECKED"] == "Y" ? 'checked' : '' ?>
                                <?= in_array($delivery["ID"], [DELIVERY_TRX_FILIAL_MSK_ID, DELIVERY_TRX_FILIAL__SPB_ID, DELIVERY_COURIER_MSK_SPB_ID]) ? 'disabled' : '' ?>>
                            <span class="custom__title"><?= ($delivery["NAME"]) ?></span>
                        </label>
                    </li>
                <? } ?>
            </ul>
            <button type="button" onclick="submitForm(2);ga('send', 'pageview', '/detali');" class="btn btn_yellow btn_large" id="next_step_btn">Продолжить</button>
        </div>
		
		<script>

    $("#next_step_btn").on("click", function(){
		if($('input[name=DELIVERY_ID]:checked').val() ==27){
			yaCounter24179866.reachGoal('delivery_type_shop');
		}else if($('input[name=DELIVERY_ID]:checked').val() ==25){
			yaCounter24179866.reachGoal('delivery_type_pickup');
		}else if($('input[name=DELIVERY_ID]:checked').val() ==28){
      yaCounter24179866.reachGoal('delivery_type_courier');
	  
		}
		else if($('input[name=DELIVERY_ID]:checked').val() ==29){
      yaCounter24179866.reachGoal('delivery_type_dellin');
	  
		}
		else if($('input[name=DELIVERY_ID]:checked').val() ==32){
      yaCounter24179866.reachGoal('delivery_type_postal');
	  
		}
    });

</script>
		
        <?
    }else{
        $currentDelivery = false;
        foreach ($arResult['DELIVERY'] as $delivery) {
            if ($delivery['CHECKED'] == 'Y') {
                $currentDelivery = $delivery;
                echo '<input type="hidden" name="' . $delivery["FIELD_NAME"] . '" id="DELIVERY_ID_' . $delivery["ID"]
                    . '" value="' . $delivery["ID"] . '" >';
            }
        }

        if ($arResult['ORDER_STEP'] == 3) {
            ?>
            <div class="checkout__title">Ваш город: <?= $arResult['CURRENT_CITY']['VALUE'] ?></div>
            <?
        }

        if ($arResult['ORDER_STEP'] == 2 && $currentDelivery['ID'] == DELIVERY_SHOPLOGISTIC_ID
            && !empty($arResult['CURRENT_CITY'])
        ) {
            ?>
            <div class="pickup">
                <div class="pickup__title">Пункты самовывоза</div>
                <div class="pickup__subtitle">Выберите точку самовывоза</div>
                <div class="pickup__container">
                    <div class="pickup__map">
					
					 <div class="maps-back">
					      <div class="maps-button">
						    <img src="<?=SITE_TEMPLATE_PATH?>/img/images/maps-click.png" alt="Палец">
						    <p>Использовать карту</p>
					     </div>
				       </div>
                        <div class="Gmap" id="pickup-map"></div>
                    </div>
                    <div class="pickup__address">
                        <div class="address__title">Адреса</div>
                        <div class="scroll__wrapper">
                            <div class="scroll__block">
                                <ul class="address__list" pickup-list></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?
        }

        if ($arResult['ORDER_STEP'] == 2) {
            ?>
			
			
					
			
            <div class="checkout__title">Стоимость доставки: <span id="delivery_price" data-default="<?= $arResult['DELIVERY_PRICE'] ?>"><?= $arResult['DELIVERY_PRICE_FORMATED'] ?></span></div>
            <?
        }
		

    }
}
?>

<input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?= $arResult["BUYER_STORE"] ?>" />
