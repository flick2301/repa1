<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");//Зависит от выбранного пункта меню!?>
<?



                $arSelect = Array("*");
                $arFilter = Array("IBLOCK_ID"=>22, "PROPERTY_SITES"=>$_SERVER['HTTP_HOST']);
                $res = CIBlockElement::GetList(Array(), $arFilter, false, array(), $arSelect);
                if($ob = $res->GetNextElement())
                {
                    $arFields = $ob->GetFields();
                    $arProperties = $ob->GetProperties();
                    echo $arProperties["LOCATION"]["VALUE"];
                }
				

				
?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
