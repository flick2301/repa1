<?php
namespace D7;
use Bitrix\Main\Engine\ActionFilter\Authentication;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();



class ContactShopsClass extends \CBitrixComponent implements \Bitrix\Main\Engine\Contract\Controllerable
{
    public function configureActions(): array
    {
        return [
            'ajaxRequest' => [
                'prefilters' => [

                ],
            ],
        ];
    }

    public function onPrepareComponentParams($arParams)
    {

        return $arParams; // TODO: Change the autogenerated stub
    }

    public function executeComponent()
    {
        return parent::executeComponent();
    }

    public function ajaxRequestAction($iblock_id, $product_id)
    {
        //Смешанный код из component.php + дополнительный
        if(\CModule::IncludeModule('iblock')){

            ob_start();

            \CModule::IncludeModule("catalog");
            $this->arParams["IBLOCK_ID"]=$iblock_id;
            $this->arParams["PRODUCT_ID"]=$product_id;

            $arFilter = array("IBLOCK_ID" => $this->arParams["IBLOCK_ID"], "ACTIVE" => "Y", "CODE"=>$_SERVER['HTTP_HOST']);
            $arSelect = array("ID", "IBLOCK_ID", "NAME", "CODE");
            $rsSect = \CIBlockSection::GetList(Array(), $arFilter, false, $arSelect, Array("iNumPage"=>1));
            if ($arSection = $rsSect->GetNext()) {
                if ($arSection["ID"]) $this->arParams["SECTION_ID"] = $arSection["ID"];
            }

           $i = $lat = $lon = $center_count = $lat_max = $lat_min = $lon_max = $lon_min = 0;

           $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "DETAIL_TEXT", "IBLOCK_SECTION_ID", "PROPERTY_*");
           $arFilter = Array("IBLOCK_ID"=>$this->arParams["IBLOCK_ID"], "ACTIVE"=>"Y", "SECTION_ID"=>"");
           $this->arParams["SECTION_ID"] ? $arFilter['SECTION_ID'] = $this->arParams["SECTION_ID"] : "";

           if ($_REQUEST["ID"]) $arFilter['ID'] = $_REQUEST["ID"];

           $res = \CIBlockElement::GetList(Array("SORT"=>"ASC", "ID"=>"ASC"), $arFilter, false, $this->arParams["LIMIT"] ? Array("nPageSize"=>$this->arParams["LIMIT"]) : Array(), $arSelect);
           while($ob = $res->GetNextElement())
           {
               $this->arResult["ITEMS"][$i] = $ob->GetFields();
               $this->arResult["ITEMS"][$i]['PROP'] = $ob->GetProperties();
               $amount = \Bitrix\Catalog\StoreProductTable::getList([
                   'filter' => [
                       'PRODUCT_ID' => $this->arParams["PRODUCT_ID"],
                       'STORE_ID'=>$this->arResult["ITEMS"][$i]['PROP']['SKLAD_ID']['VALUE'],
                   ],
                   'select'=>['*'],
               ])->fetch();
               $this->arResult["ITEMS"][$i]['AMOUNT'] = $amount['AMOUNT'];

               $dbProperty = \CIBlockElement::getProperty(
          CATALOG_IBLOCK_ID,
                   $this->arParams["PRODUCT_ID"], array("sort", "asc"),
                   array()
               );

               while ($arProperty = $dbProperty->GetNext()) {
                   $this->arResult["PROPERTIES"][$arProperty['CODE']] = $arProperty;
               }

               $this->arResult['PRODUCT'] = \Bitrix\Catalog\ProductTable::getByPrimary($this->arParams["PRODUCT_ID"], ['select'=>['*', 'IBLOCK_ELEMENT.NAME', 'IBLOCK_ELEMENT.PREVIEW_PICTURE']])->fetch();
               $this->arResult['PRODUCT']['PREVIEW_PICTURE_SRC'] = \CFile::GetPath($this->arResult['PRODUCT']['CATALOG_PRODUCT_IBLOCK_ELEMENT_PREVIEW_PICTURE']);
               $this->arResult['PRODUCT']['PRICE']=\Bitrix\Catalog\PriceTable::getList(['filter'=>['PRODUCT_ID'=>$this->arParams["PRODUCT_ID"]]])->fetch();
               if($this->arResult["PROPERTIES"]['KOLICHESTVO_V_UPAKOVKE']['VALUE'])
                   $this->arResult['PRODUCT']['PRICE']['PRICE_FOR_ONE'] = round($this->arResult['PRODUCT']['PRICE']['PRICE']/$this->arResult["PROPERTIES"]['KOLICHESTVO_V_UPAKOVKE']['VALUE'], 2);

               $payment = \CIBlockElement::GetByID($this->arResult["ITEMS"][$i]['PROP']["PAYMENT"]["VALUE"]);
               $this->arResult["ITEMS"][$i]['PROP']["PAYMENT_NAME"] =  $payment->GetNext();
               if ($this->arResult["ITEMS"][$i]['PROP']["LAT"]["VALUE"] && $this->arResult["ITEMS"][$i]['PROP']["LON"]["VALUE"]) {
                   $lat += $this->arResult["ITEMS"][$i]['PROP']["LAT"]["VALUE"];
                   $lon += $this->arResult["ITEMS"][$i]['PROP']["LON"]["VALUE"];
                   if (!$lat_min || $lat_min > $this->arResult["ITEMS"][$i]['PROP']["LAT"]["VALUE"]) $lat_min = $this->arResult["ITEMS"][$i]['PROP']["LAT"]["VALUE"];
                   if (!$lat_max || $lat_max < $this->arResult["ITEMS"][$i]['PROP']["LAT"]["VALUE"]) $lat_max = $this->arResult["ITEMS"][$i]['PROP']["LAT"]["VALUE"];
                   if (!$lon_min || $lon_min > $this->arResult["ITEMS"][$i]['PROP']["LON"]["VALUE"]) $lon_min = $this->arResult["ITEMS"][$i]['PROP']["LON"]["VALUE"];
                   if (!$lon_max || $lon_max < $this->arResult["ITEMS"][$i]['PROP']["LON"]["VALUE"]) $lon_max = $this->arResult["ITEMS"][$i]['PROP']["LON"]["VALUE"];
                   $center_count++;
               }
               if($this->arResult["ITEMS"][$i]['PROP']["SHEME_IMG"]["VALUE"]) $this->arResult["ITEMS"][$i]["SCHEME"] = \CFile::GetPath($this->arResult["ITEMS"][$i]['PROP']["SHEME_IMG"]["VALUE"]);
               if($this->arResult["ITEMS"][$i]['PROP']["VIDEO"]["VALUE"]) $this->arResult["ITEMS"][$i]["VIDEO"] = \CFile::GetPath($this->arResult["ITEMS"][$i]['PROP']["VIDEO"]["VALUE"]);

               if (is_array($this->arResult["ITEMS"][$i]['PROP']["PHOTO"]["VALUE"])) {
                   foreach($this->arResult["ITEMS"][$i]['PROP']["PHOTO"]["VALUE"] AS $img) {
                            $this->arResult["ITEMS"][$i]["IMG"][] = \CFile::GetPath($img);
                   }
               }

               if ($_REQUEST["ID"]) $this->arResult['SELECT'] = $this->arParams["SECTION_ID"];
                    $i++;
          }

          if ($_REQUEST["ID"]) { //Заголовки
              $ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues($this->arParams["IBLOCK_ID"], $_REQUEST["ID"]);
              $IPROPERTY  = $ipropValues->getValues();
              $arResult["META" . $_REQUEST["ID"]]["ELEMENT_META_TITLE"] = $IPROPERTY["ELEMENT_META_TITLE"];
              $arResult["META" . $_REQUEST["ID"]]["ELEMENT_META_DESCRIPTION"] = $IPROPERTY["ELEMENT_META_DESCRIPTION"];
              $arResult["META" . $_REQUEST["ID"]]["ELEMENT_PAGE_TITLE"] = $IPROPERTY["ELEMENT_PAGE_TITLE"];
          }

          if ($center_count) {
              $this->arResult["LAT"] = $lat / $center_count;
              $this->arResult["LON"] = $lon / $center_count;
          }

          $zoom_lon = ($this->arResult["LON"] - $lon_min) + ($lon_max - $this->arResult["LON"]);
          $zoom_lat = ($this->arResult["LAT"] - $lat_min) + ($lat_max - $this->arResult["LAT"]);

          $zoom = $zoom_lon < $zoom_lat ? $zoom_lat : $zoom_lon;

          if (count($this->arResult["ITEMS"])==1) $this->arResult["ZOOM"] = 15;
          else $this->arResult["ZOOM"] = round(pi() * 2 / $zoom) + 1;

          $this->arResult["SECTION"] = $arSection;


        }


        if ($_REQUEST["ID"]) {
            if ($this->arResult["META" . $_REQUEST["ID"]]["ELEMENT_META_TITLE"]) $APPLICATION->SetPageProperty("title", $this->arResult["META" . $_REQUEST["ID"]]["ELEMENT_META_TITLE"]);
            if ($this->arResult["META" . $_REQUEST["ID"]]["ELEMENT_META_DESCRIPTION"]) $APPLICATION->SetPageProperty("description", $this->arResult["META" . $_REQUEST["ID"]]["ELEMENT_META_DESCRIPTION"]);
        }

        $this->IncludeComponentTemplate('ajax_lite', '/local/components/d7/contact_shops/templates/krep-komp.new');

        return ob_get_clean();
    }
}