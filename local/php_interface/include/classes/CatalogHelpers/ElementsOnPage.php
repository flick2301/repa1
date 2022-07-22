<?php
namespace CatalogHelpers;

use CatalogHelpers\FilterButtonsBuilder;

class ElementsOnPage
{
    public static function EditFromResult(array $arResult, FilterButtonsBuilder $filterObj=null)
    {
        foreach($arResult['REFERENCE']['ITEM']['PROPS_SORTING'] as $prop)
        {
            if($arResult['REFERENCE']['ITEM']['PROPS_CATALOG_TYPE'][$prop['CODE']] == 'L')
                $arProps[$prop['CODE'].'_VALUE'] = $prop['VALUE'];
            else
                $arProps[$prop['CODE']] = $prop['VALUE'];
        }

        foreach($arProps as $key=>$val)
        {
            $arFilter = ["IBLOCK_ID" => CATALOG_IBLOCK_ID, "SECTION_ID "=>$arResult['REFERENCE']['ITEM']['DIRECTORY'], 'ACTIVE'=>"Y", "PROPERTY_{$key}" => $val];
            $res = \CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter, false, false, ['ID', 'NAME']);
            while ($ar_fields = $res->GetNext()) {
                $ids[]=$ar_fields['ID'];
            }
        }


        return $ids;
    }

    public static function isUnitProperties(array $arResult)
    {
        if($arResult['REFERENCE']['ITEM']['UNITE_PROPERTIES']['VALUE']=='Y')
        {
            return true;
        }else{
            return false;
        }
    }



}
?>