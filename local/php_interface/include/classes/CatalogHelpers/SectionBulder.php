<?php
namespace CatalogHelpers;

class SectionBulder
{
    public $arPagesCode;
    public $curSorting;
    public $curSection;

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
        while($ob = $res->GetNextElement()) {

            $arFields = $ob->GetFields();
            $arProps = $ob->GetProperties();
            $this->curSorting[] = array_merge($arFields, $arProps);

        }

        if(empty($this->curSorting))
        {
            $secID = $this->getCurSection();
            $sec_sorting_page = \CIBlockSection::GetList(array(), ["IBLOCK_ID" => SORTING_IBLOCK_ID, "ACTIVE" => "Y", 'UF_DIRECTORY'=>$secID], false, array("ID", "UF_*"))->GetNext();
            $arSortingsCurFromUrl = explode('-', end($this->arPagesCode));
            $arFilter = array("IBLOCK_ID" => SORTING_IBLOCK_ID, "ACTIVE" => "Y", "SECTION_ID"=>$sec_sorting_page['ID'], "INCLUDE_SUBSECTIONS"=>"Y", '?PROPERTY_sef_filter' => implode(" | ", $arSortingsCurFromUrl));
            $res = \CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter, false, false, array('*'));
            while($ob = $res->GetNextElement()) {

                $arFields = $ob->GetFields();
                $arProps = $ob->GetProperties();
                $this->curSorting[] = array_merge($arFields, $arProps);

            }
        }
        return $this->curSorting;
    }



    public function getCurSection()
    {

        $arFilter = array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "ACTIVE" => "Y", '=CODE' => array_reverse($this->arPagesCode));
        $req = \CIBlockSection::GetList(array(), $arFilter, false, array("ID", "CODE", "SECTION_PAGE_URL"));
        if($arCurSection = $req->GetNext())
        {
            $this->curSection=$arCurSection;
            return $arCurSection['ID'];
        }

    }


    public function addParameters()
    {
        $httpApp = \Bitrix\Main\Application::getInstance();
        $context = $httpApp->getContext();
        $server = new \Bitrix\Main\Server($_SERVER);

        foreach($this->curSorting as $sorting) {
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



    public function linkBuilder($sort_item, $sortSection)
    {


        $values = [];
        foreach($sort_item['arFilters']['VALUE'] as $value)
        {
            $values[] = $value.'=Y';
        }

        if($sort_item['IS_ACTIVE'] && $sortSection['ACTIVES']==1) {
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