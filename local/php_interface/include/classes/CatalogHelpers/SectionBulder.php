<?php
namespace CatalogHelpers;

class SectionBulder
{
    public $arPagesCode;
    public $curSorting;
    public $curSection;
    public $arSections;

    public $httpApp;
    public $context;
    public $request;
    public $requestUri;

    public function __construct()
    {
        $this->httpApp = \Bitrix\Main\Application::getInstance();
        $this->context = $this->httpApp->getContext();
        $this->request = $this->context->getRequest();
        $this->requestUri = $this->request->getRequestUri();
        $uri = new \Bitrix\Main\Web\Uri($this->request->getRequestUri());
        $path = $uri->getPath();
        $arUrl = explode('/', $path);
        $this->arPagesCode = array_diff($arUrl, array(''));
        $this->getCurSection();
    }


    public function getCurSorting()
    {

        $arFilter = array("IBLOCK_ID" => SORTING_IBLOCK_ID, "ACTIVE" => "Y", '=CODE' => $this->arPagesCode);
        $res = \CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter, false, false, array('*'));
        while ($ob = $res->GetNextElement()) {

            $arFields = $ob->GetFields();
            $arProps = $ob->GetProperties();
            $this->curSorting[] = array_merge($arFields, $arProps);

        }

        if (empty($this->curSorting)) {
            $secID = $this->getCurSection();
            $sec_sorting_page = \CIBlockSection::GetList(array(), ["IBLOCK_ID" => SORTING_IBLOCK_ID, "ACTIVE" => "Y", 'UF_DIRECTORY' => $secID], false, array("ID", "UF_*"))->GetNext();
            $arSortingsCurFromUrl = explode('-', end($this->arPagesCode));
            $arFilter = array("IBLOCK_ID" => SORTING_IBLOCK_ID, "ACTIVE" => "Y", "SECTION_ID" => $sec_sorting_page['ID'], "INCLUDE_SUBSECTIONS" => "Y", '?PROPERTY_sef_filter' => implode(" | ", $arSortingsCurFromUrl));
            $res = \CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter, false, false, array('*'));
            while ($ob = $res->GetNextElement()) {

                $arFields = $ob->GetFields();
                $arProps = $ob->GetProperties();
                $this->curSorting[] = array_merge($arFields, $arProps);

            }
        }
        return $this->curSorting;
    }


    public function getCurSection()
    {

        foreach ($this->arPagesCode as $code) {
            $section_id = $section_id ?? false;
            $arFilter = array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "SECTION_ID" => $section_id, "ACTIVE" => "Y", '=CODE' => $code);
            $req = \CIBlockSection::GetList(array(), $arFilter, false, array("ID", "CODE", "SECTION_PAGE_URL"));
            if ($arCurSection = $req->GetNext()) {
                $this->curSection = $arCurSection;
                $section_id = $arCurSection['ID'];
                $this->arSections[] = $arCurSection['CODE'];
            }
        }
        return $this->curSection['ID'];

    }


    public function addParameters()
    {
        $httpApp = \Bitrix\Main\Application::getInstance();
        $context = $httpApp->getContext();
        $server = new \Bitrix\Main\Server($_SERVER);

        foreach ($this->curSorting as $sorting) {
            if (!empty($sorting['arFilters']['VALUE'])) {
                foreach ($sorting['arFilters']['VALUE'] as $key) {
                    $_GET[$key] = 'Y';

                }
                $_GET['set_filter'] = 'Показать';
            }
        }

        $request = new \Bitrix\Main\HttpRequest($server, $_GET, $_POST, $_FILES, $_COOKIE);
        $response = new \Bitrix\Main\HttpResponse($context);
        $context->initialize($request, $response, $server, array('env' => $_ENV));
        $httpApp->setContext($context);
    }


    public function getArrAddress() :array
    {
        foreach($this->arPagesCode as $code)
        {
            if(in_array($code, $this->arSections) || $code==$this->curSorting[0]['CODE'])
            {
                $arrAddress[] = $code;
            }
        }
        return $arrAddress;
    }

    public function isRealAddress() :bool
    {
        $nav = \CIBlockSection::GetNavChain(false, $this->curSorting[0]["IBLOCK_SECTION_ID"]);

        while($arNav = $nav->GetNext())
        {

            $res_sect = \CIBlockSection::GetList(array("SORT"=>"ASC"), array("IBLOCK_ID"=>SORTING_IBLOCK_ID, 'ID'=>$arNav['ID']), false, Array('CODE', 'UF_DIRECTORY'));
            if($arSect = $res_sect->GetNext()){

                if($arSect['UF_DIRECTORY']){

                    $code_section = $this->arPagesCode[array_key_last($this->arPagesCode)];
                    $res_sect = \CIBlockSection::GetList(array("SORT"=>"ASC"), array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, 'ID'=>$arSect['UF_DIRECTORY']), false, Array('ID', 'SECTION_PAGE_URL'));
                    $dir = $this->request->getRequestedPageDirectory();

                    if($parent_sec_id = $res_sect->GetNext()){

                        $right_url = $parent_sec_id['SECTION_PAGE_URL'].$this->curSorting[0]['CODE'];
                        $right_url2 = $parent_sec_id['SECTION_PAGE_URL'].str_replace("-", "_", $this->curSorting[0]['CODE']);
                        if($parent_sec_id['ID'] == $arSect['UF_DIRECTORY'][0] && ($dir == $right_url || $dir == $right_url2)){

                            return true;
                        }
                    }

                }
            }
        }
        return false;
    }



    public function linkBuilder($sort_item, $sortSection)
    {


        $values = [];
        foreach($sort_item['arFilters']['VALUE'] as $value)
        {
            $values[] = $value.'=Y';
        }

        if($sort_item['IS_ACTIVE'] && $sortSection['ACTIVES']==1) {
           if(array_slice($this->arPagesCode, -1)[0] == $this->curSorting[0]['CODE'])
                $link = $this->curSection['SECTION_PAGE_URL']. $this->curSorting[0]['CODE'];
            else
                $link = $this->curSection['SECTION_PAGE_URL'];
        }
        elseif($sort_item['IS_ACTIVE'] && $sortSection['ACTIVES']>1)
        {
            if($sort_item['sef_filter']['VALUE']=='') {
                $link = str_replace($values, '', $this->requestUri);
                $link = str_ireplace('set_filter=%D0%9F%D0%BE%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C', '', $link);
                $link = str_replace(['?&&', '?&&&', '?&', '?&&&&', '?&&&&&'], '?', $link) . '&set_filter=Показать';
                $link = str_replace(['&&', '&&&', '&&&&'], '&', $link);
                $link = str_replace('?&set_filter=Показать', '', $link);
            }else{
                if(stripos($this->requestUri, '-'.$sort_item['sef_filter']['VALUE']))
                    $link = str_replace('-'.$sort_item['sef_filter']['VALUE'], '', $this->requestUri);
                else
                    $link = str_replace($sort_item['sef_filter']['VALUE'].'-', '', $this->requestUri);
            }
        }elseif(!$sort_item['IS_ACTIVE'] && $sortSection['ACTIVES']>1)
        {
            $link = str_ireplace('set_filter=%D0%9F%D0%BE%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C', '',$this->requestUri);

            if(stripos($this->requestUri, '?'))
                $delimiter = $this->requestUri.'&';
            else
                $delimiter = '?';

            if(!empty($sort_item['arFilters']['VALUE'])  && $sort_item['sef_filter']['VALUE']=='')
            {
                $link = $delimiter . implode('&', $values).'&set_filter=Показать';
            }elseif($sort_item['LINK_TARGET']['VALUE'])
            {
                $link = $sort_item['LINK_TARGET']['VALUE'];
            }elseif(!empty($sort_item['arFilters']['VALUE']) && $sort_item['sef_filter']['VALUE'])
            {
                if($_GET['set_filter'] == 'Показать' && !stripos($this->requestUri, '?')) {
                    $link = $this->requestUri;
                    $link = rtrim($link, "/");

                    $link =  $link . '-' . $sort_item['sef_filter']['VALUE'];

                }else{
                    $link = $this->curSection['SECTION_PAGE_URL'].$sort_item['sef_filter']['VALUE'];
                }
            }else
            {
                $link = $this->curSection['SECTION_PAGE_URL'].  $sort_item['CODE'] . '/';
            }

            $link = str_replace(['&&', '&&&', '&&&&'], '&', $link);


        }else{
            if(stripos($this->requestUri, '?'))
                $delimiter = $this->requestUri.'&';
            else
                $delimiter = '?';

            if(!empty($sort_item['arFilters']['VALUE']) && $sort_item['sef_filter']['VALUE']=='')
            {
                $link = $delimiter . implode('&', $values) . '&set_filter=Показать';
            }elseif($sort_item['LINK_TARGET']['VALUE'])
            {
                $link = $sort_item['LINK_TARGET']['VALUE'];
            }elseif(!empty($sort_item['arFilters']['VALUE']) && $sort_item['sef_filter']['VALUE'])
            {
                if($_GET['set_filter'] == 'Показать' && !stripos($this->requestUri, '?')) {
                    $link = $this->requestUri;
                    $link = rtrim($link, "/");

                    $link =  $link . '-' . $sort_item['sef_filter']['VALUE'];

                }else{
                    $link = $this->curSection['SECTION_PAGE_URL'].$sort_item['sef_filter']['VALUE'];
                }
            }else
            {
                $link = $this->curSection['SECTION_PAGE_URL']. $sort_item['CODE'] . '/';
            }

        }

        return $link;
    }


}