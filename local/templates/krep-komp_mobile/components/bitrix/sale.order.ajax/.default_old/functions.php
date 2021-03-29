<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Sale\Location\Admin\LocationHelper;
use Bitrix\Main\Localization\Loc;

if (!function_exists('cmpBySort')) {
    function cmpBySort($a, $b)
    {
        if (!isset($a['SORT']) || !isset($b['SORT'])) {
            return -1;
        }

        if ($a['SORT'] == $b['SORT']) {
            return 0;
        }

        return $a['SORT'] > $b['SORT'] ? 1 : -1;
    }
}

if (!function_exists("PrintPropsForm")) {
    function PrintPropsForm($properties, $arResult, $printHide = false)
    {
        if (empty($properties)) {
            return;
        }

        foreach ($properties as $property) {
            $propertyLangTitle = Loc::getMessage('SOAP_' . $property['CODE'] . '_TITLE');
            $propertyLangTitle = strlen($propertyLangTitle) > 0 ? $propertyLangTitle : $property['NAME'];
            $propertyInputTitle = Loc::getMessage('SOAP_' . $property['CODE'] . '_INPUT_TITLE');
            $propertyInputTitle = strlen($propertyInputTitle) > 0 ? $propertyInputTitle : $propertyLangTitle;

            $property['TYPE'] = strtolower($property['TYPE']);

            if (stripos($property['CODE'], 'PHONE') !== false) {
                $property['TYPE'] = 'tel';
            }
            if ($property['IS_EMAIL'] == 'Y') {
                $property['TYPE'] = 'email';
            }
            if ($property["TYPE"] == "select") {
                if ($printHide) {
                    foreach ($property["VARIANTS"] as $variant) {
                        if ($variant["SELECTED"] == "Y") {
                            echo '<input type="hidden" value="' . $variant['VALUE'] . '" name="' . $property['FIELD_NAME'] . '" id="' . $property['FIELD_NAME'] . '">';
                        }
                    }
                    continue;
                }
                ?>

                <div class="form__label form__label_half" data-property-id-row="<?= intval(intval($property["ID"])) ?>">
                    <div class="form__caption"><?= $propertyLangTitle . ($property['REQUIED'] == 'Y' ? '*' : '') ?></div>
                    <div class="custom__select select-form-field">
                        <select name="<?=$property["FIELD_NAME"]?>" id="ORDER_PROPERTY_<?=$property["CODE"]?>" size="<?=$property["SIZE1"]?>">
                            <? foreach($property["VARIANTS"] as $arVariants) { ?>
                                <option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
                            <? } ?>
                        </select>
                    </div>
                </div>

            <? } elseif($property["TYPE"] == "file") { ?>

                <label class="label__file" data-property-id-row="<?= intval(intval($property["ID"])) ?>">
                    <input type="<?= $property['TYPE'] ?>"
                           id="<?= $property['FIELD_NAME'] ?>"
                           name="<?= $property['FIELD_NAME'] ?>"
                           value="<?= $property['VALUE'] ?>">
                    <span class="file__title"><?= $propertyLangTitle ?></span><i></i>
                </label>

            <? } else {
                if ($printHide) {
                    echo '<input type="hidden" value="' . $property['VALUE']
                    . '" name="' . $property['FIELD_NAME']
                    . '" id="ORDER_PROPERTY_' . $property['CODE'] . '" '
                    . '" title="' . $propertyInputTitle . '" '
                    . ($property['REQUIED'] == 'Y' ? 'required-input' : '') . '>';
                    continue;
                }
                $needPreloadCityList = $property['CODE'] == 'CITY' && $_POST['is_ajax_post'] != 'Y';
                ?>

                <label class="form__label form__label_half <?= $needPreloadCityList ? 'form__label_loading' : '' ?>"
                    data-property-id-row="<?= intval(intval($property["ID"])) ?>">
                    <? if($needPreloadCityList) { ?>
                        <div class="loading" style="display: block;">
                            <div class="loading__inner"></div>
                            <div class="loading__txt">Подождите, идет загрузка информации о городах</div>
                        </div>
                    <? } ?>
                    <span class="form__caption"><?= $propertyLangTitle . ($property['REQUIED'] == 'Y' ? '*' : '') ?></span>
                    <input class="form__input <?= $property['TYPE'] == 'tel' ? 'form__input_phone' : '' ?>"
                           title="<?= $propertyInputTitle ?>"
                           type="<?= $property['TYPE'] ?>"
                           id="ORDER_PROPERTY_<?= $property['CODE'] ?>"
                           name="<?= $property['FIELD_NAME'] ?>"
                           value="<?= $property['VALUE'] ?>"
                           size="<?= $property['SIZE1'] ?>"
                           tabindex="<?= $property['SORT'] ?>"
                           data-kladr-id="<?= $arResult['CURRENT_CITY_KLADR_ID'] ?>"
                           <?= $needPreloadCityList ? 'disabled' : '' ?>
                           <?= $property['CODE'] == 'CITY' ? 'autocomplete="off"' : '' ?>
                           <?= $property['REQUIED'] == 'Y' ? 'required-input' : '' ?>>
                </label>

            <?
            }
        }
    }
}