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
        array_splice($arResult, $key, 0, array(array("TEXT"=>"Химический анкер", "LINK"=> "/krepezh/ankera/khimicheskiy-anker/", "SELECTED"=> false, "PERMISSION"=>"X",  "IS_PARENT"=> false, "IS_PARENT"=> false, "DEPTH_LEVEL"=>'3'), array("TEXT"=>"Анкер регулировачный", "LINK"=> "/krepezh/ankera/anker-regulirovochnyy/", "SELECTED"=> false, "PERMISSION"=>"X",  "IS_PARENT"=> false, "IS_PARENT"=> false,  "DEPTH_LEVEL"=>'3')));

    }

endforeach;