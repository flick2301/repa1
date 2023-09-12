<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
use Bitrix\Main\Loader; 

Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL; 
use Bitrix\Main\Entity;

$hlbl = 11; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch(); 

$entity = HL\HighloadBlockTable::compileEntity($hlblock); 
$entity_data_class = $entity->getDataClass(); 

$rsData = $entity_data_class::getList(array(
			"select" => array("*"),
			"order" => array("ID" => "ASC"),
			"filter" => array("")  // Задаем параметры фильтра выборки
));
while ($arItem = $rsData->Fetch()) {
    $entity_data_class::delete($arItem["ID"]);
}
 
?>

<?
$arProps_for = ['DIAMETR', 'POKRYTIE',  'GOLOVKA', 'KONETS',  'TSVET', 'DLINA'];

foreach($arProps_for as $prop_item)
{
	$prop_ability = "!PROPERTY_".$prop_item;	
	$arSelect = Array("*", "PROPERTY_*");
	$arFilter = Array("IBLOCK_ID"=>SORTING_IBLOCK_ID, "ACTIVE"=>"Y", "!PROPERY_SECTION_LINK"=>false, 'arFilters'=>false);
	$arFilter[$prop_ability]=false;
	//ДИАМЕТР И ДЛИНА СЛИШКОМ МНОГО СОЗДАЮТ ПОСАДОЧНЫХ СТРАНИЦ, ДОЛЖНА СОРТИРОВКА БЫТЬ ТОЛЬКО ПО ОДНОМУ ПАРАМЕТРУ
	if($prop_item == 'DIAMETR' || $prop_item == 'DLINA')
	{
		$prop_disability_code = ($prop_item == 'DIAMETR') ? 'PROPERTY_DLINA' : 'PROPERTY_DIAMETR';
		$arFilter[$prop_disability_code] = false;
	}
	var_dump($arFilter);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement())
	{
		$count++;
		$arFields = $ob->GetFields();
		$id_sort = $arFields['ID'];
		$arProps = $ob->GetProperties();
		echo $arFields['NAME'].'<br>';
		foreach($arProps as $prop)
		{
			if($prop['CODE']=='SECTION_LINK')
			{
				echo $prop['NAME'].' = '.$prop['VALUE'][0].'<br>';
				$section_id = $prop['VALUE'][0];
			}
			elseif($prop['CODE']==$prop_item)
			{
			
				$prop_code = $prop['CODE'];
				$prop_value = $prop['VALUE'];
				echo $prop_code.' = '.$prop_value.'<br>';
			
			}
		
		
		}
		
		$list = CIBlockSection::GetNavChain(false, $arFields["IBLOCK_SECTION_ID"], ['ID', 'NAME', 'DEPTH_LEVEL'], true);
		
		$uf_arresult = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => SORTING_IBLOCK_ID, "ID" => $list[0]['ID']), false, ["UF_DIRECTORY"]);
		if($uf_value = $uf_arresult->GetNext()){
			if(!empty($uf_value["UF_DIRECTORY"])){ //проверяем что поле заполнено
				$directory = $uf_value["UF_DIRECTORY"][0];
				var_dump($uf_value["UF_DIRECTORY"]);				//подменяем ссылку и используем её в дальнейшем
				var_dump($section_id);
			}
		}
	
		
		$ids=[];
	
		$arFilter_cat = ["IBLOCK_ID" => CATALOG_IBLOCK_ID, "SECTION_ID"=>$section_id, 'ACTIVE'=>"Y", "PROPERTY_".$prop_code => $prop_value, "INCLUDE_SUBSECTIONS"=>"Y"];
		$res_cat = CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter_cat, false, false, ['ID', 'NAME']);
		while ($ar_fields = $res_cat->GetNext()) {
			$ids[]=$ar_fields['ID'];
		}
	
		$data = array(
			"UF_SORT_ID"=>$id_sort,
			"UF_CATALOG_SECTION_ID"=>$directory,
			"UF_CATALOG_ELEMENTS"=>$ids,
      
		);
	
		
		$result = $entity_data_class::add($data);
		
		echo '<br>';
 
	}
}	
echo $count;
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>