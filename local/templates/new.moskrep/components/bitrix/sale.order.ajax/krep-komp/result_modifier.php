<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arParams
 * @var array $arResult
 * @var SaleOrderAjax $component
 */

$component = $this->__component;
$component::scaleImages($arResult['JS_DATA'], $arParams['SERVICES_IMAGES_SCALING']);

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
        array("ID", "CALLBACK_FUNC", "MODULE", 
              "PRODUCT_ID", "QUANTITY", "DELAY", 
              "CAN_BUY", "PRICE", "WEIGHT")
    );
while ($arItems = $dbBasketItems->Fetch())
{
   //$arResult['IDS'][] = $arItems;
}
foreach($arResult['JS_DATA']['GRID']['ROWS'] as $row)
{
	$arResult['IDS'][] = $row['data'];
}
$discount_price = getSalesFromPriceNew($arResult['JS_DATA']['TOTAL']['ORDER_PRICE'], 'RUB', $arResult['IDS']);

$arResult['JS_DATA']['TOTAL']['DISCOUNT_FROM_FUNCTION'] = $discount_price;