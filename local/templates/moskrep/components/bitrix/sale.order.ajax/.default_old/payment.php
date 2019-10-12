<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Localization\Loc;

if ($arResult['ORDER_STEP'] != 3) {
    return;
}
?><?

		 
			
			
$arID = array();

$arBasketItems = array();

$dbBasketItems = CSaleBasket::GetList(
     array(
                "NAME" => "ASC",
                "ID" => "ASC"
             ),
     array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "ORDER_ID" => "NULL"
             ),
     false,
     false,
     array("ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "PRODUCT_PROVIDER_CLASS")
             );
while ($arItems = $dbBasketItems->Fetch())
{
     if ('' != $arItems['PRODUCT_PROVIDER_CLASS'] || '' != $arItems["CALLBACK_FUNC"])
     {
          CSaleBasket::UpdatePrice($arItems["ID"],
                                 $arItems["CALLBACK_FUNC"],
                                 $arItems["MODULE"],
                                 $arItems["PRODUCT_ID"],
                                 $arItems["QUANTITY"],
                                 "N",
                                 $arItems["PRODUCT_PROVIDER_CLASS"]
                                 );
          $arID[] = $arItems["ID"];
     }
}
if (!empty($arID))
     {
     $dbBasketItems = CSaleBasket::GetList(
     array(
          "NAME" => "ASC",
          "ID" => "ASC"
          ),
     array(
          "ID" => $arID,
        "ORDER_ID" => "NULL"
          ),
        false,
        false,
        array("ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "DELAY", "CAN_BUY", "PRICE", "WEIGHT", "PRODUCT_PROVIDER_CLASS", "NAME")
                );
				?><div class='basket'><div class="basket__head" style='width:830px;'>
            <div class="basket__cell basket__cell_photo" style='width:560px;'>Товар</div>
                   
                    <div class="basket__cell basket__cell_amount">Количество</div>
                    <div class="basket__cell basket__cell_price">Цена</div>
					<div class="basket__cell basket__cell_price">Итого</div>
                   
            </div>
			<ul id='basket_items' class='basket__list'><?
while ($arItems = $dbBasketItems->Fetch())
{

    
    ?><li class='basket__entry basket_items__row amountControl' style='height:40px; width:830px;'>
	  
						<div class="basket__cell basket__cell_name" style='padding:0px; width:390px;'>
                           <?=$arItems['NAME']?>
                        </div>
						<div class="basket__cell basket__cell_amount" style='width:200px;'>
                            <?=$arItems['QUANTITY']?>
                        </div>
						<div class="basket__cell basket__cell_price" style='width:120px;'><? echo (int)$arItems['PRICE'];?> руб.</div>
						<div class="basket__cell basket__cell_price" style='width:120px;'><? echo (int)$arItems['PRICE']*$arItems['QUANTITY'];?> руб.</div><?
						$cart_num+=$arItems['QUANTITY'];
						$cart_sum+=$arItems['PRICE']*$arItems['QUANTITY'];

	?><li><?
}
?>
<li class='basket__entry basket_items__row amountControl' style='height:40px; width:830px;'>
<div class="basket__cell basket__cell_name" style='padding:0px; width:390px;'>
                           Стоимость доставки
                        </div>
						<div class="basket__cell basket__cell_amount" style='width:200px;'></div>
						<div class="basket__cell basket__cell_price" style='width:120px;'></div>
						<div class="basket__cell basket__cell_price" style='width:120px;'><? echo (int)$arResult['DELIVERY_PRICE'];?> руб.</div>
						</li>

</ul></div><?
}
// Печатаем массив, содержащий актуальную на текущий момент корзину

//print_r($arBasketItems);
?>
<div class="checkout__title">В вашей корзине  <?=$cart_num?> товаров. Сумма заказа с доставкой <?echo (int)$cart_sum+(int)$arResult['DELIVERY_PRICE'];?> рублей</span></div>
<br>
<div class="checkout__title">Выберите способ оплаты:</div>
<? if (!empty($arResult["PAY_SYSTEM"])) { ?>
    <div class="checkout__pay-type">
        <ul class="type__list">
            <? foreach ($arResult["PAY_SYSTEM"] as $payment) { ?>
                <li class="type__entry">
                    <label class="radio__custom">
                        <input type="radio" class="custom__input"
                               id="ID_PAY_SYSTEM_ID_<?= $payment["ID"] ?>" name="PAY_SYSTEM_ID"
                               value="<?= $payment["ID"] ?>"
                            <?= $payment["CHECKED"] == "Y" ? 'checked' : '' ?>>
                        <span class="custom__title"><?= $payment["PSA_NAME"]; ?></span>
                    </label>
                    <? if ($payment['CODE'] == 'BILL' && !empty($arResult["ORDER_PROP"]["BILL_FILE"])) { ?>
                        <? PrintPropsForm($arResult["ORDER_PROP"]["BILL_FILE"]); ?>
                    <? } ?>
                </li>
            <? } ?>
        </ul>
    </div>
<? } ?>

