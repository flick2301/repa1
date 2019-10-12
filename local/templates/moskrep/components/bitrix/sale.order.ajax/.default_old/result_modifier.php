<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @param array $source */
/** @param array $orderProperties */
/** @param array $defaultProperties */

use Bitrix\Currency\CurrencyTable;
use Bitrix\Iblock\ElementTable;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

include_once $_SERVER["DOCUMENT_ROOT"] . $this->__folder . "/functions.php";

if (empty($arResult['ORDER_STEP'])) {
    $arResult['ORDER_STEP'] = 1;
}
if ($_POST['is_ajax_post'] != 'Y' || empty($_POST['step'])) {
    $arResult['ORDER_STEP'] = 1;
}
if (!empty($_POST['step'])) {
    $arResult['ORDER_STEP'] = $_POST['step'];
}

$currentCountry = false;
$defaultProperties = [];
$hiddenProperties = ['PICKUP', 'CITY_API_ID', 'CITY_KLADR_ID'];
$arResult['ORDER_PROP']['USER_PROPS_BEFORE_TYPE'] = [];
$arResult['ORDER_PROP']['USER_PROPS_HIDDEN'] = [];
$arResult['ORDER_PROP']['USER_PROPS_AFTER_TYPE'] = [];

$arResult['CURRENT_CITY_KLADR_ID'] = '';

foreach ($arResult['ORDER_PROP']['USER_PROPS_N'] as $property) {
    if ($property['CODE'] == 'CITY_KLADR_ID' && !empty($property['VALUE'])) {
        $arResult['CURRENT_CITY_KLADR_ID'] = $property['VALUE'];
    }
    if (in_array($property['CODE'], ['CITY', 'COUNTRY'])) {
        if ($property['CODE'] == 'CITY') {
            $arResult['CURRENT_CITY'] = $property;
        }
        if ($property['CODE'] == 'COUNTRY') {
            foreach ($property["VARIANTS"] as $variant) {
                if ($variant["SELECTED"] == "Y") {
                    $currentCountry = $variant['VALUE'];
                }
            }
        }
        if ($arResult['ORDER_STEP'] == 1) {
            $arResult['ORDER_PROP']['USER_PROPS_BEFORE_TYPE'][] = $property;
        } else {
            $arResult['ORDER_PROP']['USER_PROPS_HIDDEN'][] = $property;
        }
    } elseif ($property['CODE'] == 'BILL_FILE') {
        $arResult['ORDER_PROP']['BILL_FILE'][] = $property;
    } elseif (in_array($property['CODE'], $hiddenProperties)) {
        $arResult['ORDER_PROP']['USER_PROPS_HIDDEN'][] = $property;
    } else {
        if ($arResult['ORDER_STEP'] == 2) {
            $arResult['ORDER_PROP']['USER_PROPS_AFTER_TYPE'][] = $property;
        } else {
            if ($arResult['ORDER_STEP'] == 1) {
                $property['REQUIED'] = 'N';
            }
            $arResult['ORDER_PROP']['USER_PROPS_HIDDEN'][] = $property;
        }
    }
}

$isPostCashPaymentChecked = false;
foreach ($arResult['PAY_SYSTEM'] as $k => $payment) {
    if ($currentCountry != 'ru' && $payment['ID'] == PAYMENT_POST_CASH) {
        $isPostCashPaymentChecked = $payment['CHECKED'] == 'Y';
        unset($arResult['PAY_SYSTEM'][$k]);
    }
}
if ($isPostCashPaymentChecked) {
    foreach ($arResult['PAY_SYSTEM'] as $k => $payment) {
        $arResult['PAY_SYSTEM'][$k]['CHECKED'] = 'Y';
        break;
    }
}

foreach ($arResult['ORDER_PROP']['RELATED'] as $property) {
    if (in_array($property['CODE'], $hiddenProperties)) {
        if ($arResult['ORDER_STEP'] == 1) {
            $property['REQUIED'] = 'N';
        }
        $arResult['ORDER_PROP']['USER_PROPS_HIDDEN'][] = $property;
    } elseif($arResult['ORDER_STEP'] == 3) {
        $arResult['ORDER_PROP']['USER_PROPS_HIDDEN'][] = $property;
    } else {
        $arResult['ORDER_PROP']['USER_PROPS_AFTER_TYPE'][] = $property;
    }
}

uasort($arResult['ORDER_PROP']['USER_PROPS_AFTER_TYPE'], function ($a, $b) {
    return $a['SORT'] - $b['SORT'];
});

$arResult['SHOW_ERRORS'] = !empty($arResult["ERROR"]) && $arResult["USER_VALS"]["FINAL_STEP"] == "Y";

if ($arResult['SHOW_ERRORS']) {
    $rowsToReplace = [
        'Не указан Email для регистрации пользователя' => '',
        'Ошибка регистрации нового пользователя: Неверный E-Mail.' => '',
    ];
    foreach ($arResult["ERROR"] as $k => $error) {
        $error = trim(strip_tags($error));
        $error = str_replace(array_keys($rowsToReplace), array_values($rowsToReplace), $error);
        if (strlen($error) > 0) {
            $arResult["ERROR"][$k] = Loc::getMessage('SOA_FIELD') . ' ' . $error;
        } else {
            unset($arResult["ERROR"][$k]);
        }
    }
}


