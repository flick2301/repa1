<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?>
<?
            $limit = 10000;
            $page = 0;

            $order = ['ID' => 'desc'];
			$filter = [
				'DELIVERY_ID' => [2, 28, 24, 20],
				[
					'LOGIC' => 'OR',
					'!=PROPERTY_VAL_BY_CODE_ADDRESS' => false,
					'!=USER_DESCRIPTION' => false
				],
			];
            $select = [
                'ID',
                'DATE_INSERT',
                'PRICE',
                'CURRENCY',
                'PROPERTY_VAL_BY_CODE_FIO',
				'PROPERTY_VAL_BY_CODE_LOCATION',
				'PROPERTY_VAL_BY_CODE_ADDRESS',
				'DELIVERY_ID',
				'USER_DESCRIPTION',
            ];


            $orders = \CSaleOrder::GetList(
                $order,
                $filter,
                false,
                [
                    'nPageSize' => $limit,
                    'iNumPage'  => $page
                ],
                $select,
                []
            );
			
			//echo $orders->SelectedRowsCount();
			
			 while($arOrder = $orders->Fetch()) {
				 if (!$arOrder["PROPERTY_VAL_BY_CODE_ADDRESS"] && !$arOrder["USER_DESCRIPTION"]) continue;
				 $location = CSaleLocation::GetByID($arOrder["PROPERTY_VAL_BY_CODE_LOCATION"]);
				 echo "#{$arOrder["ID"]} ".$arOrder["DATE_INSERT"]." "."{$location["COUNTRY_NAME_ORIG"]}".($location["REGION_NAME_ORIG"] ? ", ".$location["REGION_NAME_ORIG"] : "").($location["CITY_NAME_ORIG"] ? ", ".$location["CITY_NAME_ORIG"] : "")."<br />".($arOrder["PROPERTY_VAL_BY_CODE_ADDRESS"] ? $arOrder["PROPERTY_VAL_BY_CODE_ADDRESS"] : $arOrder["USER_DESCRIPTION"])."<br /><br />";
        }
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>