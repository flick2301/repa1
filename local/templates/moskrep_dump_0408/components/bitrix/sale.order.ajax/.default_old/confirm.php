<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Localization\Loc;
?>

<? if (!empty($arResult["ORDER"])) { ?>
    <table>
        <tbody>
        <tr>
            <td>
                <div class="popup-container">
                    <div class="popup__close"></div>
                    <div class="thanks__title">Спасибо за Ваш заказ.</div>
                    Менеджер свяжется с Вами в ближайшее время для уточнения деталей заказа.<br><br>
                  
                  
					 <a href="<?= CATALOG_DIR ?>" class="btn btn_large btn_black">Вернуться в каталог</a>
                </div>
            </td>
        </tr>
        </tbody>
    </table>

<? } else { ?>

    <h2><?= Loc::getMessage("SOA_TEMPL_ERROR_ORDER") ?></h2>
    <p>
        <?= Loc::getMessage("SOA_TEMPL_ERROR_ORDER_LOST", [
            "#ORDER_ID#" => $arResult["ACCOUNT_NUMBER"]
        ]) ?>
        <?= Loc::getMessage("SOA_TEMPL_ERROR_ORDER_LOST1") ?>
    </p>

<? } ?>



<script>
window.dataLayer = window.dataLayer || [];



	
dataLayer.push({
    "ecommerce": {
        "purchase": {
            "actionField": {
                "id" : "<?=$arResult["ORDER_ID"]?>"
            },
            "products": [
			<?
$arBasketItems = array();

$dbBasketItems = CSaleBasket::GetList(
     array(
          "NAME" => "ASC",
          "ID" => "ASC"
          ),
     array(
         
        "ORDER_ID" => $arResult["ORDER_ID"]
          ),
        false,
        false,
        array("ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "DELAY", "CAN_BUY", "PRICE", "WEIGHT", "PRODUCT_PROVIDER_CLASS", "NAME")
                );
while ($arItems = $dbBasketItems->Fetch())
{?>
                {
                    "id": "<?=$arItems['PRODUCT_ID']?>",
                    "name": "<?=$arItems['NAME']?>",
                    "price": <?=$arItems['PRICE']?>,
					"quantity": <?=$arItems['QUANTITY']?>
                   
                },
<?}?>  
            ]
        }
    }
});

</script>