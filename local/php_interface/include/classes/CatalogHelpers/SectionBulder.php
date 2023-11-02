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
	public $sortin_id_iblock;
	public $catalog_iblock_id=17;
	public $cron;

    public function __construct($cron=false)
    {
		$this->sortin_id_iblock = 18;
		$this->cron = $cron;
		if(!$cron)
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
		}else{
			$uri = new \Bitrix\Main\Web\Uri("/");
			$path = $uri->getPath();
			$arUrl = explode('/', $path);
			$this->arPagesCode = array_diff($arUrl, array(''));
		}
        
    }


    public function getCurSorting($section_id=0)
    {
		if($this->cron)
			$section_id=0;
		elseif(!$section_id)
			$section_id=$this->curSection['ID'];
		
		
        $req = \CIBlockSection::GetList(array(), ["IBLOCK_ID" => $this->sortin_id_iblock, "ACTIVE" => "Y", 'UF_DIRECTORY'=>$section_id], false, array("ID", "UF_*"));
        while($section = $req->GetNext())
        {
            $arSections[]=$section['ID'];
            $req2 = \CIBlockSection::GetList(array(), ["IBLOCK_ID" => $this->sortin_id_iblock, "ACTIVE" => "Y", 'SECTION_ID'=>$section['ID']], false, array("ID"));
            while($sec = $req2->GetNext())
            {
                $arSections[] = $sec['ID'];
            }
        }
		
		if($this->cron)
		{
			$this->arPagesCode="";
		}
        $arFilter = array("IBLOCK_ID" => $this->sortin_id_iblock, "ACTIVE" => "Y", 'IBLOCK_SECTION_ID'=>$arSections, '=CODE' => $this->arPagesCode, 'PROPERTY_arFilters'=>false);
        $res = \CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter, false, false, array('*'));
        while ($ob = $res->GetNextElement()) {
			
            $arFields = $ob->GetFields();
			
            $arProps = $ob->GetProperties();
			if(!$this->cron)
			{
            $this->curSorting[] = array_merge($arFields, $arProps);
			
				$this->isFilterSEF($this->arPagesCode[array_key_last($this->arPagesCode)]);
			}else{
				$curSorting[] = array_merge($arFields, $arProps);
			}				

        }
		
		if(!$this->cron)
		{

        if (empty($this->curSorting)) {
            $secID = $this->getCurSection();

            $sec_sorting_page = \CIBlockSection::GetList(array(), ["IBLOCK_ID" => $this->sortin_id_iblock, "ACTIVE" => "Y", 'UF_DIRECTORY'=>$secID], false, array("ID", "UF_*"))->GetNext();
            $arSortingsCurFromUrl = explode('---', end($this->arPagesCode));
            $arFilter = array("IBLOCK_ID" => $this->sortin_id_iblock, "ACTIVE" => "Y", "SECTION_ID"=>$sec_sorting_page['ID'], "INCLUDE_SUBSECTIONS"=>"Y", 'PROPERTY_sef_filter' => implode(" | ", $arSortingsCurFromUrl));

			if($sec_sorting_page) {
				$res = \CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter, false, false, array('*'));
				while ($ob = $res->GetNextElement()) {

					$arFields = $ob->GetFields();
					$arProps = $ob->GetProperties();
					$this->curSorting[] = array_merge($arFields, $arProps);

				}
			}
        }
		}
		if(!$this->cron)
			return $this->curSorting;
		else
			return $curSorting;
    }
	
	public function setCurSorting($sort_id)
	{
		$arFilter = array("IBLOCK_ID" => $this->sortin_id_iblock, "ACTIVE" => "Y", 'ID'=>$sort_id);
		$res = \CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter, false, false, array('*'));
		while ($ob = $res->GetNextElement()) {
			
			$arFields = $ob->GetFields();
			
			$arProps = $ob->GetProperties();
			$this->curSorting = array_merge($arFields, $arProps);
		}
	}
	
	public function setCurSection($section_id)
	{
		$arFilter = array("IBLOCK_ID" => $this->catalog_iblock_id, "ID" => $section_id, "ACTIVE" => "Y");
		$req = \CIBlockSection::GetList(array(), $arFilter, false, array("ID", "CODE", "SECTION_PAGE_URL"));
		if ($arCurSection = $req->GetNext()) {
			$this->curSection = $arCurSection;
	
		}
	}


    public function getCurSection()
    {

        foreach ($this->arPagesCode as $code) {
            $section_id = $section_id ?? false;
            $arFilter = array("IBLOCK_ID" => $this->catalog_iblock_id, "SECTION_ID" => $section_id, "ACTIVE" => "Y", '=CODE' => $code);
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

    public function isFilterSEF($SEF, $static = false) :bool
    {
        $sec_sorting_page = \CIBlockSection::GetList(array(), ["IBLOCK_ID" => $this->sortin_id_iblock, "ACTIVE" => "Y", 'UF_LANDING_PAGE_CODE'=>$this->curSorting[0]['CODE']], false, array("ID", "UF_*"))->GetNext();
        $arFilter = array("IBLOCK_ID" => $this->sortin_id_iblock, "ACTIVE" => "Y", "SECTION_ID"=>$sec_sorting_page['ID'], "INCLUDE_SUBSECTIONS"=>"Y", '=PROPERTY_sef_filter' => $SEF);

        $res = \CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter, false, false, array('*'));
        if ($ob = $res->GetNextElement()) {

            $arFields = $ob->GetFields();
            $arProps = $ob->GetProperties();
			if(!$static)
				$this->curSorting[] = array_merge($arFields, $arProps);
            return true;

        }
        return false;
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

            $res_sect = \CIBlockSection::GetList(array("SORT"=>"ASC"), array("IBLOCK_ID"=>$this->sortin_id_iblock, 'ID'=>$arNav['ID']), false, Array('CODE', 'UF_DIRECTORY'));
            if($arSect = $res_sect->GetNext()){

                if($arSect['UF_DIRECTORY']){

                    $code_section = $this->arPagesCode[array_key_last($this->arPagesCode)];
                    $res_sect = \CIBlockSection::GetList(array("SORT"=>"ASC"), array("IBLOCK_ID"=>$this->catalog_iblock_id, 'ID'=>$arSect['UF_DIRECTORY']), false, Array('ID', 'SECTION_PAGE_URL'));
                    $dir = $this->request->getRequestedPageDirectory();

                    if($parent_sec_id = $res_sect->GetNext()){

                        $right_url = $parent_sec_id['SECTION_PAGE_URL'].$this->curSorting[0]['CODE'];
                        $right_url2 = $parent_sec_id['SECTION_PAGE_URL'].str_replace("-", "_", $this->curSorting[0]['CODE']);

                        if($parent_sec_id['ID'] == $arSect['UF_DIRECTORY'][0] && ($dir == $right_url || $dir == $right_url2 || $this->isFilterSEF($code_section))){

                            return true;
                        }
                    }

                }
            }
        }
        return false;
    }


    public function curFilterValues()
    {
        $values = [];
        $arFilters = $this->curSorting[1]['arFilters'] ?? $this->curSorting[0]['arFilters'] ?? [];
        foreach($arFilters['VALUE'] as $value)
        {
            $values[] = $value.'=Y';
        }
        return $values;
    }



    public function linkBuilder($sort_item, $sortSection)
    {


        $values = [];
        foreach($sort_item['arFilters']['VALUE'] as $value)
        {
            $values[] = $value.'=Y';
        }

        if($sort_item['IS_ACTIVE'] && $sortSection['ACTIVES']==1) {
           if(!empty($this->curSorting[1]) && array_slice($this->arPagesCode, -2)[0] == $this->curSorting[0]['CODE'])
               $link = $this->curSection['SECTION_PAGE_URL']. $this->curSorting[0]['CODE'].'/';
           elseif(array_slice($this->arPagesCode, -1)[0] == $this->curSorting[0]['CODE'])
               $link = $this->curSection['SECTION_PAGE_URL']. $this->curSorting[0]['CODE'].'/';
           else
                $link = $this->curSection['SECTION_PAGE_URL'];
        }
        elseif($sort_item['IS_ACTIVE'] && $sortSection['ACTIVES']>1)
        {
			
            $link = str_replace($values, '', $this->requestUri);
            $link = str_ireplace('set_filter=%D0%9F%D0%BE%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C', '', $link);
            $link = str_replace(['?&&', '?&&&', '?&', '?&&&&', '?&&&&&'], '?', $link) . '&set_filter=Показать';
            $link = str_replace(['&&', '&&&', '&&&&'], '&', $link);
            $link = str_replace('?&set_filter=Показать', '', $link);

        }elseif(!$sort_item['IS_ACTIVE'] && $sortSection['ACTIVES']>1)
        {
            $link = str_ireplace('set_filter=%D0%9F%D0%BE%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C', '',$this->requestUri);
			
            if(stripos($this->requestUri, '?'))
                $delimiter = $this->requestUri.'&';
            else
                $delimiter = '?';

            if(!empty($sort_item['arFilters']['VALUE'])  && $sort_item['sef_filter']['VALUE']=='')
            {
                $link = $this->curSection['SECTION_PAGE_URL'].$delimiter . implode('&', $values).'&set_filter=Показать';
				
            }elseif($sort_item['LINK_TARGET']['VALUE'])
            {
                $link = $sort_item['LINK_TARGET']['VALUE'];
            }elseif(!empty($sort_item['arFilters']['VALUE']) && $sort_item['sef_filter']['VALUE'])
            {
                if($_GET['set_filter'] == 'Показать' && !stripos($this->requestUri, '?')) {
                    $link = $this->requestUri;
                    $link = rtrim($link, "/");
					//Сейчас ссылки на фильтры состоят из нескольких параметров (длинны и диаментра например) одновременное нажатие невозможно,
					//либо приводит к пустой странице либо к 404 поэтому $link =  $link . '--' . $sort_item['sef_filter']['VALUE']; убираем, оставляем:
                    $link =   $this->curSection['SECTION_PAGE_URL'].$sort_item['sef_filter']['VALUE'].'/';

                }else{
                    if(!empty($this->curSorting[0]['CODE']))
                        $link = $this->curSection['SECTION_PAGE_URL'].$this->curSorting[0]['CODE'].'/'.$sort_item['sef_filter']['VALUE']. '/';
                    else
                        $link = $this->curSection['SECTION_PAGE_URL'].$sort_item['sef_filter']['VALUE']. '/';
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

            if(!empty($this->curSorting[1]) || !empty($this->curSorting[0]['arFilters']['VALUE']))
            {
                if(!empty($this->curSorting[1]))
                    $link = $this->curSection['SECTION_PAGE_URL'].$this->curSorting[0]['CODE'].'/?'.implode('&',$this->curFilterValues()).'&' . implode('&', $values) . '&set_filter=Показать';
                else
                    $link = $this->curSection['SECTION_PAGE_URL'].'?'.implode('&',$this->curFilterValues()).'&' . implode('&', $values) . '&set_filter=Показать';
            }elseif(!empty($sort_item['arFilters']['VALUE']) && $sort_item['sef_filter']['VALUE']=='')
            {
                $link = $delimiter . implode('&', $values) . '&set_filter=Показать';
            }elseif($sort_item['LINK_TARGET']['VALUE'])
            {
                $link = $sort_item['LINK_TARGET']['VALUE'];
            }elseif(!empty($sort_item['arFilters']['VALUE']) && $sort_item['sef_filter']['VALUE'])
            {
                if($_GET['set_filter'] == 'Показать') {
                    //Раньше было возможность выставить два быстрых фильтра, но часто при выборке это пустая страница с товарами, оставляем только один
					//$link = $this->requestUri.'&' . implode('&', $values) . '&set_filter=Показать';
					$link = $this->curSection['SECTION_PAGE_URL'].'?' . implode('&', $values) . '&set_filter=Показать';

                }else{
                    if(!empty($this->curSorting[0]['CODE']))
                        $link = $this->curSection['SECTION_PAGE_URL'].$this->curSorting[0]['CODE'].'/'.$sort_item['sef_filter']['VALUE']. '/';
                    else
                        $link = $this->curSection['SECTION_PAGE_URL'].$sort_item['sef_filter']['VALUE']. '/';
                }
            }else
            {
                $link = $this->curSection['SECTION_PAGE_URL']. $sort_item['CODE'] . '/';
            }

        }

        return $link;
    }


}