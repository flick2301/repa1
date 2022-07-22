<?php
namespace CatalogHelpers;
use CatalogHelpers\ElementsOnPage;

class  FilterButtonsBuilder
{
    public $sec_builder;
    public $arResult;
    public $arSortSecID;
    public $sorting;


    public function __construct($component = 'section.list', $arResult, $section_id=null)
    {
        $this->arResult = $arResult;
        $this->sec_builder = new \CatalogHelpers\SectionBulder();

        $this->sec_builder->getCurSection();
        $this->sorting = $this->sec_builder->getCurSorting();

        $this->sec_builder->addParameters();

        //если обработка ведется для компонента catalog.section.list (там возможны фильтры на посадочных страницах)
        if($component == 'section.list') {
            $landing_page_code = $sec_builder->curSorting[0]['CODE'] ?? end($this->arResult['SECTION']['SORTING']);

            //ИЩЕМ ФИЛЬТРЫ У ПОСАДОЧНОЙ СТРАНИЦЫ ЕСЛИ НАХОДИМСЯ НА ПОСАДОЧНОЙ
            $arFilter = array('IBLOCK_ID' => SORTING_IBLOCK_ID, 'UF_LANDING_PAGE_CODE' => $landing_page_code);
            $rsSections = \CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter, false, array('*', 'UF_LANDING_PAGE_CODE'));

            if ($arSection = $rsSections->Fetch()) {
                $this->arResult['SORTING']['SECTION_ID'] = $arSection['ID'];
            } else {
                //ЕСЛИ НЕ НАШЛИ ИЩЕМ ФИЛЬТРЫ ПРИКРЕПЛЕННЫЕ К ДИРЕКТОРИИ
                $arFilter = array('IBLOCK_ID' => SORTING_IBLOCK_ID, 'UF_DIRECTORY' => $section_id);
                $rsSections = \CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter, false, array('*', 'UF_DIRECTORY'));
                while ($arSection = $rsSections->Fetch()) {
                    $this->arResult['SORTING']['SECTION_ID'] = $arSection['ID'];
                }
            }

            if ($this->arResult['SORTING']['SECTION_ID']) {

                $arFilter = array('IBLOCK_ID' => SORTING_IBLOCK_ID, 'SECTION_ID' => $this->arResult['SORTING']['SECTION_ID']);
                $rsSections = \CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter, false, array('*', 'UF_TOP'));
                while ($arSection = $rsSections->Fetch()) {
                    $this->arResult['SORTING']['SECTIONS'][$arSection['ID']]['NAME'] = $arSection['NAME'];
                    $this->arResult['SORTING']['SECTIONS'][$arSection['ID']]['TOP'] = $arSection['UF_TOP'];
                    $this->arResult['SORTING']['SECTIONS'][$arSection['ID']]['ACTIVE'] = $arSection['ACTIVE'];
                    $this->arSortSecID[] = $arSection['ID'];

                }
            }
        }elseif($component=='section')
        {
            $arFilter = array('IBLOCK_ID' => SORTING_IBLOCK_ID, 'UF_DIRECTORY' => $section_id);
            $rsSections = \CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter, false, array('*', 'UF_DIRECTORY'));
            if($arSection = $rsSections->Fetch()) {
                $this->arResult['SORTING']['SECTION_ID'] = $arSection['ID'];

                $arFilter = array('IBLOCK_ID' => SORTING_IBLOCK_ID, 'SECTION_ID' => $this->arResult['SORTING']['SECTION_ID']);
                $rsSections = \CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter, false, array('*', 'UF_TOP'));
                while ($arSection = $rsSections->Fetch()) {
                    $this->arResult['SORTING']['SECTIONS'][$arSection['ID']]['NAME'] = $arSection['NAME'];
                    $this->arResult['SORTING']['SECTIONS'][$arSection['ID']]['TOP'] = $arSection['UF_TOP'];
                    $this->arSortSecID[] = $arSection['ID'];

                }
            }

        }

        if($this->arResult['SORTING']['SECTION_ID'] && $section_id)
        {
            $this->ButtonsForSortingPage();
        }else{
            $this->ButtonsForSectionPage();
        }

        //АКТИВНЫЕ ФИЛЬТРЫ В ДАННЫЙ МОМЕНТ
        $this->GetActiveButtonsFromURL();
    }




    protected function ButtonsForSortingPage()
    {

        if($this->arSortSecID){
            $arFilter = Array("IBLOCK_ID"=>SORTING_IBLOCK_ID, "ACTIVE"=>"Y", 'IBLOCK_SECTION_ID'=>$this->arSortSecID, '!PROPERTY_VISIBILITY_VALUE'=>'Y');
            $res = \CIBlockElement::GetList(Array('SORT' => 'ASC'), $arFilter, false, false, array('*'));
            while($ob = $res->GetNextElement()){

                $arFields = $ob->GetFields();
                $arProps = $ob->GetProperties();
                $this->arResult['SORTING']['SECTIONS'][$arFields['IBLOCK_SECTION_ID']]['ITEMS'][]=array_merge($arFields, $arProps);

            }
        }

        $arFilter = Array("IBLOCK_ID"=>SORTING_IBLOCK_ID, "ACTIVE"=>"Y", 'IBLOCK_SECTION_ID'=>$this->arResult['SORTING']['SECTION_ID'], '!PROPERTY_VISIBILITY_VALUE'=>'Y');
        $res = \CIBlockElement::GetList(Array('SORT' => 'ASC'), $arFilter, false, false, array('*'));
        while($ob = $res->GetNextElement()){

            $arFields = $ob->GetFields();
            $arProps = $ob->GetProperties();

            $this->arResult['SORTING']['ROOT_ELEMENTS'][$arFields['ID']]=array_merge($arFields, $arProps);

            $this->arResult['SORTING']['ROOT_ELEMENTS'][$arFields['ID']]['PICTURE'] = \CFile::ResizeImageGet($arFields['DETAIL_PICTURE'] ? $arFields['DETAIL_PICTURE'] : $arFields['PREVIEW_PICTURE'], array('width'=>'268', 'height'=>'201'), BX_RESIZE_IMAGE_PROPORTIONAL, true);

            //Отмена сжатия
            if ($arFields['DETAIL_PICTURE'])
                $this->arResult['SORTING']['ROOT_ELEMENTS'][$arFields['ID']]['PICTURE']['src'] = \CFile::GetPath($arFields['DETAIL_PICTURE']);

        }
    }



    protected function ButtonsForSectionPage()
    {
        global $APPLICATION;
        if($this->arSortSecID){
            $arFilter = Array("IBLOCK_ID"=>SORTING_IBLOCK_ID, "ACTIVE"=>"Y", 'IBLOCK_SECTION_ID'=>$this->arSortSecID, '!PROPERTY_VISIBILITY_VALUE'=>'Y');
            $res = \CIBlockElement::GetList(Array('SORT' => 'ASC'), $arFilter, false, false, array('*'));
            while($ob = $res->GetNextElement()){

                $arFields = $ob->GetFields();
                $arProps = $ob->GetProperties();
                $this->arResult['SORTING']['SECTIONS'][$arFields['IBLOCK_SECTION_ID']]['ITEMS'][]=array_merge($arFields, $arProps);

            }
        }

        $resProps = \CIBlock::GetProperties(CATALOG_IBLOCK_ID, Array(), Array());
        while($arProp = $resProps->Fetch()){
            $arProp_catalog[]=$arProp['CODE'];
            $arProp_catalog_type[$arProp['CODE']]=$arProp['PROPERTY_TYPE'];

        }



        $arFilter = Array("IBLOCK_ID"=>SORTING_IBLOCK_ID, "ACTIVE"=>"Y", '=CODE'=>end($this->sorting));
        $res = \CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, array('*'));
        while($ob = $res->GetNextElement()){

            $arFields = $ob->GetFields();
            $arProps = $ob->GetProperties();

            $URL_SORT = false;
            $nav = \CIBlockSection::GetNavChain(false, $arFields["IBLOCK_SECTION_ID"]);

            while($arNav = $nav->GetNext())
            {

                $res_sect = \CIBlockSection::GetList(array("SORT"=>"ASC"), array("IBLOCK_ID"=>SORTING_IBLOCK_ID, 'ID'=>$arNav['ID']), false, Array('CODE', 'UF_DIRECTORY'));
                if($arSect = $res_sect->GetNext()){

                    if($arSect['UF_DIRECTORY']){

                        $code_section = $this->sorting[count($this->sorting)-1];
                        $res_sect = \CIBlockSection::GetList(array("SORT"=>"ASC"), array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, 'ID'=>$arSect['UF_DIRECTORY']), false, Array('ID', 'SECTION_PAGE_URL'));
                        $dir = $APPLICATION->GetCurDir();

                        if($parent_sec_id = $res_sect->GetNext()){
                            $right_url = $parent_sec_id['SECTION_PAGE_URL'].$arFields['CODE'].'/';
                            $right_url2 = $parent_sec_id['SECTION_PAGE_URL'].str_replace("-", "_", $arFields['CODE']).'/';
                            if($parent_sec_id['ID'] == $arSect['UF_DIRECTORY'][0] && ($dir == $right_url || $dir == $right_url2)){

                                $URL_SORT = true;
                            }
                        }

                    }
                }
            }

            if($URL_SORT){
                $this->arResult['REFERENCE']['ITEM']=array_merge($arFields, $arProps);
                if($this->arResult['REFERENCE']['ITEM']['DETAIL_PICTURE']){
                    $this->arResult['REFERENCE']['ITEM']['PICTURE'] = \CFile::ResizeImageGet($this->arResult['REFERENCE']['ITEM']['DETAIL_PICTURE'], array('width'=>'600', 'height'=>'600'), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                }
                foreach($arProps as $val){

                    if(in_array($val['CODE'], $arProp_catalog) && $val['VALUE']!=''){
                        $arProp_sorting[]=$val;
                        $this->arResult['REFERENCE']['ITEM']['PROPS_SORTING'][]=$val;
                    }

                }
                $ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues($this->arResult['REFERENCE']['ITEM']["IBLOCK_ID"],$this->arResult['REFERENCE']['ITEM']['ID']);
                $IPROPERTY  = $ipropValues->getValues();
                $this->arResult['REFERENCE']['ITEM']['ELEMENT_PAGE_TITLE'] = $IPROPERTY['ELEMENT_PAGE_TITLE'];

                //СОПУТСТВУЮЩИЕ РАЗДЕЛЫ
                if(count($this->arResult['REFERENCE']['ITEM']['COMPANION_SECTION']['VALUE'])) {
                    $arFilter = array("IBLOCK_ID" => CATALOG_IBLOCK_ID, 'ID' => $this->arResult['REFERENCE']['ITEM']['COMPANION_SECTION']['VALUE']);
                    $rsSections = \CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter);
                    while ($arSection = $rsSections->GetNext()) {

                        $this->arResult['REFERENCE']['ITEM']['COMPANIONS'][] = array('NAME' => $arSection['NAME'], 'SRC' => $arSection['SECTION_PAGE_URL']);

                    }

                }
                //СОПУТСТВУЮЩИЕ СПРАВОЧНИКИ
                if(count($this->arResult['REFERENCE']['ITEM']['COMPANION_GUIDE']['VALUE'])) {
                    foreach($this->arResult['REFERENCE']['ITEM']['COMPANION_GUIDE']['VALUE'] as $arGuide){
                        $guide = explode("=", $arGuide);
                        $this->arResult['REFERENCE']['ITEM']['COMPANIONS'][] = array('NAME' => $guide[0], 'SRC' => $guide[1]);
                    }

                }

                //ПРОВЕРКА ЧТО ТАБЛИЦА ОБЩАЯ
                if($this->arResult['REFERENCE']['ITEM']["UF_DOP_SETTINGS"])
                {

                    foreach($this->arResult['REFERENCE']['ITEM']["UF_DOP_SETTINGS"]["VALUE_XML_ID"] as $extra_setting)
                    {

                        $_POST['ENUM_LIST'][$extra_setting] = true;
                    }
                }

            }

            //ЕСЛИ ВЫБРАНО НЕСКОЛЬКО РАЗДЕЛОВ БЕЗ СВОЙСТВ
            if(count($this->arResult['REFERENCE']['ITEM']['SECTION_LINK']['VALUE'])>1 && $this->arResult['REFERENCE']['ITEM'][$arProp_sorting[0]['CODE']]['VALUE']=='') {
                $rsResult = \CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "ID" => $this->arResult['REFERENCE']['ITEM']['SECTION_LINK']['VALUE']), false, array("*", "IPROPERTY_VALUES"));
                while ($rSection = $rsResult->GetNext()) {
                    $this->arResult['DOP_SECTIONS'][] = $rSection;
                }

                foreach ($this->arResult['DOP_SECTIONS'] as $key => $arSection) {
                    $file = \CFile::ResizeImageGet($arSection['PICTURE'], array('width' => '278', 'height' => '201'), BX_RESIZE_IMAGE_PROPORTIONAL, true);

                    if ($file['src']):
                        $this->arResult['DOP_SECTIONS'][$key]['PICTURE'] = $file;
                    else:
                        $this->arResult['DOP_SECTIONS'][$key]['PICTURE']['src'] = '/images/no_image_sec.jpg';
                    endif;
                    $ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(5, $arSection['ID']);
                    $this->arResult['DOP_SECTIONS'][$key]['IPROPERTY_VALUES'] = $ipropValues->getValues();

                }
                //НЕСКОЛЬКО РАЗДЕЛОВ И СВОЙСТВА
            }elseif(count($this->arResult['REFERENCE']['ITEM']['SECTION_LINK']['VALUE'])>1 && $this->arResult['REFERENCE']['ITEM'][$arProp_sorting[0]['CODE']]['VALUE']!=''){
                $this->arResult['REFERENCE']['ITEM']['DIRECTORY'] = $this->arResult['SECTIONS'][0]['ID'];

                $GLOBALS['Filter_seo'] = Array();
                $GLOBALS['Filter_seo']['IBLOCK_SECTION_ID']=$this->arResult['REFERENCE']['ITEM']['SECTION_LINK']['VALUE'];
                foreach($arProp_sorting as $arFilt_prop){
                    //ЕСЛИ СВОЙСТВО В КАТАЛОГЕ ТИПА СПИСОК, ТО ФИЛЬТР ДОЛЖЕН БЫТЬ PROPERTY_КОД_VALUE
                    if($arProp_catalog_type[$arFilt_prop['CODE']] == 'L'){
                        $GLOBALS['Filter_seo']["PROPERTY_".$arFilt_prop['CODE']."_VALUE"] = $this->arResult['REFERENCE']['ITEM'][$arFilt_prop['CODE']]['VALUE'];
                    }elseif($arFilt_prop['CODE']=="PO_PRIMENENIYU"){
                        $GLOBALS['Filter_seo']["%PROPERTY_".$arFilt_prop['CODE']."_VALUE"] = $this->arResult['REFERENCE']['ITEM'][$arFilt_prop['CODE']]['VALUE'];
                    }else{
                        $GLOBALS['Filter_seo']["PROPERTY_".$arFilt_prop['CODE']] = $this->arResult['REFERENCE']['ITEM'][$arFilt_prop['CODE']]['VALUE'];
                    }
                }
                //ЕСЛИ ВЫБРАН ОДИН РАЗДЕЛ
            }elseif($this->arResult['REFERENCE']['ITEM']['SECTION_LINK']['VALUE']){

                $this->arResult['REFERENCE']['ITEM']['DIRECTORY']=$this->arResult['REFERENCE']['ITEM']['SECTION_LINK']['VALUE'][0];
                $this->arResult['REFERENCE']['ITEM']['PROPS_CATALOG_TYPE'] = $arProp_catalog_type;

                if(!ElementsOnPage::isUnitProperties($this->arResult)) {
                    $GLOBALS['Filter_seo'] = array();
                    foreach ($arProp_sorting as $arFilt_prop) {
                        //ЕСЛИ СВОЙСТВО В КАТАЛОГЕ ТИПА СПИСОК, ТО ФИЛЬТР ДОЛЖЕН БЫТЬ PROPERTY_КОД_VALUE
                        if ($arProp_catalog_type[$arFilt_prop['CODE']] == 'L') {
                            $GLOBALS['Filter_seo']["PROPERTY_" . $arFilt_prop['CODE'] . "_VALUE"] = explode(';', $this->arResult['REFERENCE']['ITEM'][$arFilt_prop['CODE']]['VALUE']);
                        } elseif ($arFilt_prop['CODE'] == "PO_PRIMENENIYU") {
                            $GLOBALS['Filter_seo']["%PROPERTY_" . $arFilt_prop['CODE']] = explode(';', $this->arResult['REFERENCE']['ITEM'][$arFilt_prop['CODE']]['VALUE']);
                        } else {
                            $GLOBALS['Filter_seo']["PROPERTY_" . $arFilt_prop['CODE']] = explode(';', $this->arResult['REFERENCE']['ITEM'][$arFilt_prop['CODE']]['VALUE']);
                        }
                    }
                }else{
                    $GLOBALS['Filter_seo'] = array('=ID' => ElementsOnPage::EditFromResult($this->arResult));
                }
                //ЕСЛИ ВЫБРАНЫ ТОЛЬКО СВОЙСТВА
            }elseif($this->arResult['REFERENCE']['ITEM'][$arProp_sorting[0]['CODE']]['VALUE']!=''){

                $nav = \CIBlockSection::GetNavChain(false,$arFields['IBLOCK_SECTION_ID']);
                while($arSectionPath = $nav->GetNext()){
                    $arNav[] =  $arSectionPath['ID'];
                }
                $arFilter = array('IBLOCK_ID' => SORTING_IBLOCK_ID, 'ID'=>$arNav);
                $rsSections = \CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter, false, array('*', 'UF_*'));
                while ($arSection = $rsSections->Fetch())
                {
                    if($arSection['UF_DIRECTORY'][0]!='')
                        $this->arResult['REFERENCE']['ITEM']['DIRECTORY'] = $arSection['UF_DIRECTORY'][0];

                }
                $GLOBALS['Filter_seo'] = Array();
                var_dump($arProp_sorting);
                foreach($arProp_sorting as $arFilt_prop){
                    //ЕСЛИ СВОЙСТВО В КАТАЛОГЕ ТИПА СПИСОК, ТО ФИЛЬТР ДОЛЖЕН БЫТЬ PROPERTY_КОД_VALUE
                    if($arProp_catalog_type[$arFilt_prop['CODE']] == 'L'){
                        //$GLOBALS['Filter_seo']["PROPERTY_".$arFilt_prop['CODE']."_VALUE"] = explode(';', $this->arResult['REFERENCE']['ITEM'][$arFilt_prop['CODE']]['VALUE']);
                    }else{
                        //$GLOBALS['Filter_seo']["PROPERTY_".$arFilt_prop['CODE']] = explode(';', $this->arResult['REFERENCE']['ITEM'][$arFilt_prop['CODE']]['VALUE']);
                    }
                }


            }

            //НАЛИЧИЕ У СПРАВОЧНИКА ВЕРХНИХ ПРИЛИНКОВАННЫХ РАЗДЕЛОВ(SECTIONS_TOP)
            if(count($this->arResult['REFERENCE']['ITEM']['SECTIONS_TOP']['VALUE'])>1) {


                $rsResult = \CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "ID" => $this->arResult['REFERENCE']['ITEM']['SECTIONS_TOP']['VALUE']), false, array("*", "IPROPERTY_VALUES"));
                while ($rSection = $rsResult->GetNext()) {
                    $this->arResult['TOP_SECTIONS'][] = $rSection;
                }
                foreach($this->arResult['REFERENCE']['ITEM']['REPLACEMENT']['VALUE'] as $arReplacement){
                    $repl2[] = explode('=', $arReplacement);

                }
                foreach ($this->arResult['TOP_SECTIONS'] as $key => $arSection) {
                    $file = \CFile::ResizeImageGet($arSection['PICTURE'], array('width' => '278', 'height' => '201'), BX_RESIZE_IMAGE_PROPORTIONAL, true);

                    if ($file['src']):
                        $this->arResult['TOP_SECTIONS'][$key]['PICTURE'] = $file;
                    else:
                        $this->arResult['TOP_SECTIONS'][$key]['PICTURE']['src'] = '/images/no_image_sec.jpg';
                    endif;
                    $ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(5, $arSection['ID']);
                    $this->arResult['TOP_SECTIONS'][$key]['IPROPERTY_VALUES'] = $ipropValues->getValues();

                    if(count($repl2)){

                        foreach($repl2 as $rep_val) {
                            $this->arResult['TOP_SECTIONS'][$key]['NAME'] = str_replace($rep_val[0], $rep_val[1], $this->arResult['TOP_SECTIONS'][$key]['NAME']);
                        }
                    }
                }
            }
        }
    }




    protected function GetActiveButtonsFromURL()
    {
        foreach($this->arResult['SORTING']['SECTIONS'] as $key=>$sortSection)
        {
            foreach($sortSection['ITEMS'] as $key_item=>$sort_item)
            {
                if(!empty($sort_item['arFilters']['VALUE']))
                {
                    $get_params = $this->sec_builder->request->getQueryList();

                    $is_active = count(array_intersect_key(array_flip($sort_item['arFilters']['VALUE']), $get_params->getValues())) == count($sort_item['arFilters']['VALUE']) ? 'active' : null;
                    $this->arResult['SORTING']['SECTIONS'][$key]['ITEMS'][$key_item]['IS_ACTIVE']=$is_active;
                    if($is_active)
                        ++$this->arResult['SORTING']['SECTIONS'][$key]['ACTIVES'];

                }
            }
        }
    }
}