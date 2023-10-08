<?
// подключаем пролог
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\IO;
use Bitrix\Main\Application;

global $mySmartFilter;
global $NavNum;
global $sec_builder;


// массив для категорий и элементов
$array_pages = array();
// простые текстовые страницы
$array_pages[] = array(
    'NAME' => 'Главная страница',
    'URL' => '/',
    'CHANGEFREQ' => 'monthly',
    'PRIORITY' => '0.3',
);
$array_pages[] = array(
    'NAME' => 'Компания',
    'URL' => '/company/contacts/',
    'CHANGEFREQ' => 'monthly',
    'PRIORITY' => '0.3',
);
// ID инфоблоков, разделы и элементы которых попадут в карту сайта
$array_iblocks_id = array(['id_block' => '17', 'changefreq_block' => 'daily1', 'priority_block' => '0.7', 'changefreq_element' => 'always', 'priority_element' => '0.5']);
if (CModule::IncludeModule("iblock")) {
    foreach ($array_iblocks_id as $iblock) {
        // список разделов d7
        $sectionsQuery = new Bitrix\Main\Entity\Query(
            \Bitrix\Iblock\SectionTable::getEntity()
        );
        $sectionsQuery->setSelect(array('ID', 'NAME', 'CODE', 'SECTION_PAGE_URL'  =>  'IBLOCK.SECTION_PAGE_URL'))
            ->setFilter(array('=IBLOCK_ID' => $iblock['id_block'], '=ACTIVE' => "Y"));
        $sections = $sectionsQuery->exec();
        foreach ($sections as $section) {
            $array_pages[] = [
                'NAME' => $section['NAME'],
                'URL' => CIBlock::ReplaceDetailUrl($section['SECTION_PAGE_URL'], $section, true, 'S'),
                'CHANGEFREQ' => $iblock['changefreq_block'],
                'PRIORITY' => $iblock['priority_block'],
            ];
			
        }
		
		//ПОДБИРАЕМ ПОСАДОЧНЫЕ ТОЛЬКО ДЛЯ КРЕПЕЖА
		$db_list = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => 17, "SECTION_ID"=>1655, 'GLOBAL_ACTIVE' => 'Y'), false, Array(), false);
		while($ar_result = $db_list->GetNext())
		{
			$ar_krepezh[] = $ar_result;
			if($ar_result['ID'])
			{
				$db_list_l2 = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => 17, "SECTION_ID"=>$ar_result['ID'], 'GLOBAL_ACTIVE' => 'Y'), false, Array(), false);
				while($ar_result_l2 = $db_list_l2->GetNext())
				{
					$ar_krepezh[] = $ar_result_l2;

					if($ar_result_l2['ID'])
					{
						$db_list_l3 = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => 17, "SECTION_ID"=>$ar_result_l2['ID'], 'GLOBAL_ACTIVE' => 'Y'), false, Array(), false);
						while($ar_result_l3 = $db_list_l3->GetNext())
						{
							$ar_krepezh[] = $ar_result_l3;
						}
					}
				}


			}
		}
		
		
		foreach ($ar_krepezh as $section) {
			
			$filter = new \CatalogHelpers\FilterButtonsBuilder('section', array(), $section['ID']);
			
			foreach($filter->arResult["SORTING"]["SECTIONS"] as $sor_section)
			{
                foreach($sor_section["ITEMS"] as $item) {
							
							$url = null;
//							remove or replace SERVER_NAME
                            if(!empty($item["sef_filter"]["VALUE"]))
                                $url = CIBlock::ReplaceDetailUrl($section['SECTION_PAGE_URL'].$item["sef_filter"]["VALUE"].'/', $section, true, 'S');
                            elseif(!$item["arFilters"]["VALUE"])
                                $url = CIBlock::ReplaceDetailUrl($section['SECTION_PAGE_URL'].$item['CODE'].'/', $section, true, 'S');
							if($url){
								$array_pages[] = [
									'NAME' => $item['NAME'],
									'URL' => $url,
                
								];
							}
							
                        }
            }
		}
        
        // cписок элементов d7
        $elementQuery = new Bitrix\Main\Entity\Query(
            \Bitrix\Iblock\ElementTable::getEntity()
        );
        $elementQuery->setSelect(array('ID', 'NAME', 'CODE', 'DETAIL_PAGE_URL' => 'IBLOCK.DETAIL_PAGE_URL'))
            ->setFilter(array('=IBLOCK_ID' => $iblock['id_block'], '=ACTIVE' => "Y"));
        $elements = $elementQuery->exec();
        foreach ($elements as $element) {
            $array_pages[] = [
                'NAME' => $element['NAME'],
                'URL' => CIBlock::ReplaceDetailUrl($element['DETAIL_PAGE_URL'], $element, true, 'E'),
                'CHANGEFREQ' => $iblock['changefreq_element'],
                'PRIORITY' => $iblock['priority_element'],
            ];
        }
        // // cписок элементов
        // $res = CIBlockElement::GetList(
        //     array(),
        //     array(
        //         "IBLOCK_ID" => $iblock['id_block'],
        //         "ACTIVE" => "Y",
        //     ),
        //     false,
        //     false,
        //     array(
        //         "ID",
        //         "NAME",
        //         "DETAIL_PAGE_URL",
        //     )
        // );
        // while ($ob = $res->GetNext()) {
        //     $array_pages[] = array(
        //         'NAME' => $ob['NAME'],
        //         'URL' => $ob['DETAIL_PAGE_URL'],
        //         'CHANGEFREQ' => $iblock['changefreq_element'],
        //         'PRIORITY' => $iblock['priority_element'],
        //     );
        // }
    }
}
// URL сайта
$site_url = 'https://' . $_SERVER['HTTP_HOST'];
// cоздаём XML документ 
$xml_content = '';
foreach ($array_pages as $key => $value) {
    $xml_content .= '
      <url>
    <loc>' . $site_url . $value['URL'] . '</loc>
    <lastmod>' . date('Y-m-d') . '</lastmod>
        
  </url>
  ';
}
// подготовка к записи
$xml_file = '<?xml version="1.0" encoding="UTF-8"?>
<urlset>
  ' . $xml_content . '
</urlset>
';
// находим/создаем файл для записи
$file = new IO\File(Application::getDocumentRoot() . '/site.xml');
// запись содержимого в файл с заменой
$file->putContents($xml_file);
echo 'Завершен!';