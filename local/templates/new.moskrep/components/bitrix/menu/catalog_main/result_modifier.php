<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arFilter = array('IBLOCK_ID' => CATALOG_IBLOCK_ID, 'ID'=>$arParams['VIBOR_CATALOG_TABLE']);
$rsSections = CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter);
while ($arSection = $rsSections->Fetch())
{
    $arText[]=$arSection['NAME'];
}
$delete=true;

foreach($arResult as $key=>$arItem):
    if($arItem['DEPTH_LEVEL'] == 1):
        $delete=false;
    endif;
    if($arItem['DEPTH_LEVEL'] == 1 && in_array($arItem['TEXT'], $arText)):
      $delete=true;  
    endif;
    if($delete)
        unset($arResult[$key]);
    if($arItem['LINK']=='/krepezh/ankera/anker_shpilka/'){
        array_splice($arResult, $key, 0, array(array("TEXT"=>"Химический анкер", "LINK"=> "/krepezh/ankera/khimicheskiy_anker/", "SELECTED"=> false, "PERMISSION"=>"X",  "IS_PARENT"=> false, "IS_PARENT"=> false, "DEPTH_LEVEL"=>'3'), array("TEXT"=>"Анкер регулировочный", "LINK"=> "/krepezh/ankera/anker_regulirovochnyy/", "SELECTED"=> false, "PERMISSION"=>"X",  "IS_PARENT"=> false, "IS_PARENT"=> false,  "DEPTH_LEVEL"=>'3')));

    }

endforeach;


$level1 = 0;
foreach($arResult as $arItem) {
	if($arItem['TEXT']=='Шурупы')
	{
		$arItem["DEPTH_LEVEL"]=2;
	}
	if ($arItem["DEPTH_LEVEL"]==1) {
		$level1++;
		$level2 = 0;
		$level3 = 0;
		$arResult["ITEMS"][$level1 - 1] = $arItem;
	}
	elseif ($arItem["DEPTH_LEVEL"]==2) {
		$level2++;
		$level3 = 0;
		$arResult["ITEMS"][$level1 - 1]["ITEMS"][$level2 - 1] = $arItem;
	}
	elseif ($arItem["DEPTH_LEVEL"]==3) {
		$level3++;
		$arResult["ITEMS"][$level1 - 1]["ITEMS"][$level2 - 1]["ITEMS"][$level3 - 1] = $arItem;
	}	
}