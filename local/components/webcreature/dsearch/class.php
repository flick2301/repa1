<?php
/**
 * Created by Webcreature.
 * User: Denis Chuchumashev
 * www.webcreature.ru
 * Date: 13.04.2018
 * Time: 9:18
 */


use \Bitrix\Main;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Type;
use \Webcreature\Dsearch\StatTable;
 
class classDsearch extends CBitrixComponent
{

var $result;
var $comment = "";
var $current_page;
var $page_param = "dsearch-result";
var $similar;

    protected function checkModules()
    {
        if (!Main\Loader::includeModule('webcreature.dsearch'))
            throw new Main\LoaderException(Loc::getMessage('DSEARCH_MODULE_NOT_INSTALLED'));
    }

    public function executeComponent()
    {
		
		$this -> checkModules();
		
    $context = \Bitrix\Main\Application::getInstance()->getContext();
    $request = $context->getRequest();
	if ($this->arParams["REQUEST"]) $this->result = $this->arParams["REQUEST"];
    else $this->result = $request->get($this->arParams["SEARCH_VARIABLE"] ? $this->arParams["SEARCH_VARIABLE"] : "result");
	
	if ($this->arParams["ALTER_PAGINATION"]=="Y") $this->page_param = "PAGEN_1";
	
	$this->current_page = $request->get($this->page_param) ? str_replace("page-", "", $request->get($this->page_param)) : 1; //������� ��������
	

        if ($this->arParams["ON_PAGE"]=="Y") echo $this->searchForm();		
		if (!$this->arParams["DESCRIPTION_LEN"]) $this->arParams["DESCRIPTION_LEN"] = 1000;
		
		if ($this->result) {
			$this->arResult["sections"] = $this->section_query();
			$this->arResult["elements"] = $this->element_query();
			
			foreach($this->arResult["sections"] as $val) $this->arResult["result"][] = $val;
			foreach($this->arResult["elements"] as $val) $this->arResult["result"][] = $val;
			
			$this->arResult["count"] = count($this->arResult["result"]);
			
			if ($this->arParams["PAGE_SIZE"] && ($this->arParams["PAGE_SIZE"]<$this->arResult["count"] || $this->arParams["PAGER_SHOW_ALWAYS"]=="Y") && $this->current_page!="all") {
				
				for($i=0; $i<$this->arResult["count"]; $i++) if ($i>=($this->current_page*$this->arParams["PAGE_SIZE"]-$this->arParams["PAGE_SIZE"]) && $i<($this->current_page*$this->arParams["PAGE_SIZE"])) $arResult[] = $this->arResult["result"][$i];
				$this->arResult["result"] = $arResult;
			
			$nav = new \Bitrix\Main\UI\PageNavigation($this->page_param); //������������ ���������
            $nav->allowAllRecords(true)
            ->setPageSize($this->arParams["PAGE_SIZE"])
            ->initFromUri();

            $nav->setRecordCount($this->arResult["count"]);
			$this->arResult["nav"] = $nav;
			

if ($this->arParams["ALTER_PAGINATION"]=="Y") {
//�������������� ������������ ���������			
$navResult = new CDBResult();
// ����� ���������� �������
$navResult->NavPageCount = ceil($this->arResult["count"]/$this->arParams["PAGE_SIZE"]);
// ����� ������� ��������
$navResult->NavPageNomer = $this->current_page;
// ����� ����������. ������������ ��� ������������ ������ �� ��������
$navResult->NavNum = 1;
// ���������� ������� ��������� �� ����� ��������
$navResult->NavPageSize = $this->arParams["PAGE_SIZE"];
// ����� ���������� �������
$navResult->NavRecordCount = $this->arResult["count"];


$this->arResult["alternav"] = $navResult;
}
			}
			
			
if ($this->arResult["count"] && $this->arParams["STAT"]=="Y") $this->saveData();			
		}

        $this->includeComponentTemplate();
    }

	
	public function searchForm() //����� ������
	{
	    return "<form method='get'><input type='text' name='{$this->arParams["SEARCH_VARIABLE"]}' value='{$this->result}' /><input type='submit' value='".Loc::getMessage('SEND')."' /></form><br /><br />";
	}

	
	public function targetArray($source, $target, $exact = false) //�������� ����������
	{
		$source = trim(str_replace(Array(" - ", " / ", " \\ "), Array(" "), $source));
		$sourceArray = explode(" ", $source);
		
		$niddle = Array('LOGIC' => 'AND');
		
		for($i=0; $i<count($sourceArray); $i++) {
		$niddle[$i] = Array('LOGIC' => 'OR');	
			foreach ($target AS $key=>$val) $niddle[$i][$key] = Array("%={$val}" => $exact ? "{$sourceArray[$i]}%" : "%{$sourceArray[$i]}%");
		}		
		
	    return $niddle;		
    }
	
	public function targetArrayFull($source, $target) //�������� ���������� (������ ������������)
	{	
		$niddle = Array('LOGIC' => 'OR');

			foreach ($target AS $key=>$val) {
				$val=="PROPERTY_".$this->arParams["ARTNO"] ? $niddle[] = Array("{$val}" => "{$source}%") : $niddle[] = Array("{$val}" => "{$source}");
				if ($val=="NAME" && preg_match("/[0-9x]+/", $source)) $niddle[] = Array("{$val}" => "% ".str_replace("x", "�", $source)."%");		
			}		

		return $niddle;
    }		
	
	public function targetArrayOld($source, $target) //�������� ����������
	{
		$source = trim(str_replace(Array(" - ", " / ", " \\ "), Array(" "), $source));
		$sourceArray = explode(" ", $source);
		
		$niddle = Array('LOGIC' => 'AND');
		
/*	
	for($i=0; $i<count($sourceArray); $i++) {
		$niddle[$i] = Array('LOGIC' => 'OR');	
			foreach ($target AS $key=>$val) {
				$val=="PROPERTY_".$this->arParams["ARTNO"] ? $niddle[$i][$key] = Array("{$val}" => "{$sourceArray[$i]}%") : $niddle[$i][$key] = Array("{$val}" => "{$sourceArray[$i]}%");
				if ($val=="NAME" && preg_match("/[0-9x]+/", $sourceArray[$i])) $niddle[$i][$key+1000] = Array("{$val}" => "% ".str_replace("x", "�", $sourceArray[$i])."%");
			}		
		}	
*/	

	foreach ($target AS $key=>$val) {
		if ($val=="NAME") $niddle = Array("{$val}" => "%{$source}%");
	}

		return $niddle;
    }	

	
	public function section() //����� � �������
	{	 
		 $result = \Bitrix\Iblock\SectionTable::getList(Array( 
    'select'  => Array('ID', 'IBLOCK_ID', 'NAME', 'PICTURE'),
	'select'  => Array("*"),
    'filter'  => Array('IBLOCK_ID' => $this->arParams["IBLOCK_ID"], "ACTIVE" => "Y", $this->targetArray($this->result, Array("NAME")))
    ));

    while ($arRes = $result->fetch()) $arSections[$arRes["ID"]] = Array(
        "NAME" => $arRes["NAME"],
	    "PICTURE" => CFile::GetPath($arRes["PICTURE"]),
		"PICTURE" => CFile::ResizeImageGet(CFile::GetFileArray($arRes["PICTURE"]), array('width'=>120, 'height'=>90), BX_RESIZE_IMAGE_PROPORTIONAL, true)["src"],
	    "URL" => $this->section_url($arRes["ID"]),
    );
	}	
	
	public function section_query() //����� � ������� Query
	{	 
	    $query = new \Bitrix\Main\Entity\Query(\Bitrix\Iblock\Model\Section::compileEntityByIblock(1)); 
		
		if (count($this->arParams["CATEGORY"])>1 || $this->arParams["CATEGORY"][0]!=0) $filterCategory["ID"] = $this->arParams["CATEGORY"];
		
		$select = Array("NAME");
		$this->arParams["ALT_NAME"] ? $select[]=$this->arParams["ALT_NAME"] : "";
		
$query 
   ->setOrder(array("ID" => "ASC")) 
   ->setFilter( 
      Array('IBLOCK_ID' => $this->arParams["IBLOCK_ID"], "ACTIVE" => "Y", $filterCategory, $this->targetArray($this->result, $select)) 
   ) 
   ->setSelect(
      Array('ID', 'IBLOCK_ID', 'NAME', 'PICTURE', 'DESCRIPTION')
   ) 
   ->setLimit($this->arParams["PAGE_SIZE"] ? $this->arParams["PAGE_SIZE"] : 0); 
   
$result= $query->exec(); 

if (!count($result)) {
	
}



while ($arRes = $result->fetch()) { 
   $arSections[$arRes["ID"]] = Array(
        "NAME" => $arRes["NAME"],
	    "PICTURE" => CFile::GetPath($arRes["PICTURE"]),
		"PICTURE" => CFile::ResizeImageGet(CFile::GetFileArray($arRes["PICTURE"]), array('width'=>120, 'height'=>90), BX_RESIZE_IMAGE_PROPORTIONAL, true)["src"],
	    "URL" => $this->section_url($arRes["ID"]),
		"DESCRIPTION" => $this->description_len($arRes['DESCRIPTION'])
    ); 
}

return $arSections;
	}
	
	public function element() //����� � ���������
	{	 
		 $result = \Bitrix\Iblock\ElementTable::getList(Array( 
    'select'  => Array('ID', 'IBLOCK_ID', 'NAME', 'IBLOCK_SECTION_ID', 'DETAIL_PICTURE'),
	'select'  => Array("*"),
    'filter'  => Array('IBLOCK_ID' => $this->arParams["IBLOCK_ID"], "ACTIVE" => "Y", $this->targetArray($this->result, Array("NAME")))
    ));

    while ($arRes = $result->fetch()) { 
	
	$db_props = CIBlockElement::GetProperty($this->arParams["IBLOCK_ID"], $arRes["ID"], array("sort" => "asc"), Array());
    while($ar_props = $db_props->Fetch()) $arRes["PROPS"][$ar_props["CODE"]]=$ar_props;
	
	    $arRes["SECTION"] = $this->getSectionParams($arRes["IBLOCK_SECTION_ID"]);
		$arRes["SECTION"]["PARAMS"] = $this->getSectionSeoParams($arRes["IBLOCK_SECTION_ID"]);
		
		
		$arElements[$arRes["ID"]] = Array(
            "NAME" => ($arRes["SECTION"]["PARAMS"]["ELEMENT_PAGE_TITLE"] ? "{$arRes["SECTION"]["PARAMS"]["ELEMENT_PAGE_TITLE"]} " : "").$arRes["NAME"],
			"ART" => $arRes["PROPS"][$this->arParams["ARTNO"]]["VALUE"],
	        "PICTURE" => $arRes["DETAIL_PICTURE"] ? CFile::GetPath($arRes["DETAIL_PICTURE"]) : CFile::GetPath($arRes["SECTION"]["PICTURE"]),
			"PICTURE" => $arRes["DETAIL_PICTURE"] ? CFile::ResizeImageGet(CFile::GetFileArray($arRes["DETAIL_PICTURE"]), array('width'=>120, 'height'=>90), BX_RESIZE_IMAGE_PROPORTIONAL, true)["src"] : CFile::ResizeImageGet(CFile::GetFileArray($arRes["SECTION"]["PICTURE"]), array('width'=>120, 'height'=>90), BX_RESIZE_IMAGE_PROPORTIONAL, true)["src"],
	        "URL" => $arRes["SECTION"]["URL"].$arRes["ID"],			
        );
	}
	}	

	public function element_query() //����� � ��������� Query
	{
		if (count($this->arParams["CATEGORY"])>1 || $this->arParams["CATEGORY"][0]!=0) $filterCategory["IBLOCK_SECTION_ID"] = $this->arParams["CATEGORY"];
				
        $arSelect = Array("ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "DETAIL_TEXT", "PROPERTY_*");

        $arFilter = Array("IBLOCK_ID"=>$this->arParams["IBLOCK_ID"], "ACTIVE"=>"Y", $filterCategory, $this->targetArrayFull($this->result, Array("NAME", "PROPERTY_".$this->arParams["ARTNO"])));
        $res = CIBlockElement::GetList(Array(), $arFilter, false, $this->arParams["PAGE_SIZE"] ? Array("nTopCount" => $this->arParams["PAGE_SIZE"]) : Array(), $arSelect);
		if (!$res->SelectedRowsCount()) {
			$this->arResult["SIMILAR"] = 1;
			$arFilter = Array("IBLOCK_ID"=>$this->arParams["IBLOCK_ID"], "ACTIVE"=>"Y", $filterCategory, $this->targetArrayOld($this->result, Array("NAME", "PROPERTY_".$this->arParams["ARTNO"])));
			$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
		}

        while($ob = $res->GetNextElement()){
        $arFields = $ob->GetFields();  
        $arProps = $ob->GetProperties();
		$arSecion = $this->getSectionParams($arFields["IBLOCK_SECTION_ID"]);
		$old_price = CPrice::GetBasePrice($arFields["ID"]);
		$price = $this->getFinalPriceInCurrency($arFields["ID"]);		
		  
		$arElements[$arFields["ID"]] = Array(
        "NAME" => ($arSecion["ELEMENT_PAGE_TITLE"] && $this->arParams["ELEMENT_PAGE_TITLE"]=="Y" ? "{$arSecion["ELEMENT_PAGE_TITLE"]} " : "").$arFields["NAME"],
		"ART" => $arProps[$this->arParams["ARTNO"]]["VALUE"],
	    "PICTURE" => $arFields["DETAIL_PICTURE"] ? CFile::GetPath($arFields["DETAIL_PICTURE"]) : $arSecion["PICTURE"],
		"PICTURE" => $arFields["DETAIL_PICTURE"] ? CFile::ResizeImageGet(CFile::GetFileArray($arFields["DETAIL_PICTURE"]), array('width'=>120, 'height'=>90), BX_RESIZE_IMAGE_PROPORTIONAL, true)["src"] : CFile::ResizeImageGet(CFile::GetFileArray($arSecion["PICTURE"]), array('width'=>120, 'height'=>90), BX_RESIZE_IMAGE_PROPORTIONAL, true)["src"],
	    "URL" => $arFields["DETAIL_PAGE_URL"],
		"DESCRIPTION" => $arFields["DETAIL_TEXT"] ? $arFields["DETAIL_TEXT"] : $arSecion["DESCRIPTION"],
		"OLD_PRICE" => CurrencyFormat($old_price["PRICE"], "RUB"),
		"PRICE" => CurrencyFormat($price["FINAL_PRICE"], "RUB"),		
        );
	    }
	return $arElements;	
	}
	
function getFinalPriceInCurrency($item_id, $cnt = 1, $getName="N", $sale_currency = 'RUB') { //����

    global $USER;

    // ���������, ����� �� ����� �������� �����������?
    if(CCatalogSku::IsExistOffers($item_id)) {

        // �������� ����� ���� ����� �������� �����������
        $res = CIBlockElement::GetByID($item_id);

        if($ar_res = $res->GetNext()) {
            $productName = $ar_res["NAME"];
            if(isset($ar_res['IBLOCK_ID']) && $ar_res['IBLOCK_ID']) {

                // ���� ��� �������� �����������
                $offers = CIBlockPriceTools::GetOffersArray(array(
                    'IBLOCK_ID' => $ar_res['IBLOCK_ID'],
                    'HIDE_NOT_AVAILABLE' => 'Y',
                    'CHECK_PERMISSIONS' => 'Y'
                ), array($item_id), null, null, null, null, null, null, array('CURRENCY_ID' => $sale_currency), $USER->getId(), null);

                foreach($offers as $offer) {

                    $price = CCatalogProduct::GetOptimalPrice($offer['ID'], $cnt, $USER->GetUserGroupArray(), 'N');
                    if(isset($price['PRICE'])) {

                        $final_price = $price['PRICE']['PRICE'];
                        $currency_code = $price['PRICE']['CURRENCY'];

                        // ���� ������ � ����������� ��������� � ������ ���������
                        $arDiscounts = CCatalogDiscount::GetDiscountByProduct($item_id, $USER->GetUserGroupArray(), "N");
                        if(is_array($arDiscounts) && sizeof($arDiscounts) > 0) {
                            $final_price = CCatalogProduct::CountPriceWithDiscount($final_price, $currency_code, $arDiscounts);
                        }

                        // ����� �����, ���������� ��������� ��������
                        break;
                    }

                }
            }
        }

    } else {

        // ������� �����, ��� �������� ����������� (��� ���������� ������� $cnt)
        $price = CCatalogProduct::GetOptimalPrice($item_id, $cnt, $USER->GetUserGroupArray(), 'N');

        // �������� ����?
        if(!$price || !isset($price['PRICE'])) {
            return false;
        }

        // ������ ��� ������, ���� �����
        if(isset($price['CURRENCY'])) {
            $currency_code = $price['CURRENCY'];
        }
        if(isset($price['PRICE']['CURRENCY'])) {
            $currency_code = $price['PRICE']['CURRENCY'];
        }

        // �������� �������� ����
        $final_price = $price['RESULT_PRICE']['UNROUND_DISCOUNT_PRICE'];

        // ���� ������ � ������������� ���� ������ � �� ������
        $arDiscounts = CCatalogDiscount::GetDiscountByProduct($item_id, $USER->GetUserGroupArray(), "N", 2);
        if(is_array($arDiscounts) && sizeof($arDiscounts) > 0) {
            $final_price = CCatalogProduct::CountPriceWithDiscount($final_price, $currency_code, $arDiscounts);
        }

        if($getName=="Y"){
            $res = CIBlockElement::GetByID($item_id);
            $ar_res = $res->GetNext();
            $productName = $ar_res["NAME"];
        }

    }

    // ���� ����������, ������������ � ������ ������
    if($currency_code != $sale_currency) {
        $final_price = CCurrencyRates::ConvertCurrency($final_price, $currency_code, $sale_currency);
    }

    $arRes = array(
        "PRICE"=>$price['PRICE']['PRICE'],
        "FINAL_PRICE"=>$final_price,
        "CURRENCY"=>$sale_currency,
        "DISCOUNT"=>$arDiscounts,
    );

    if($productName!="")
        $arRes['NAME']= $productName;

    return $arRes;

}	
	
	public function getSectionParams($id) { //��������� ������
		 $result = \Bitrix\Iblock\SectionTable::getList(Array( 
    'select'  => Array('ID', 'IBLOCK_ID', 'NAME', 'PICTURE', 'DESCRIPTION'),
    'filter'  => Array('IBLOCK_ID' => $this->arParams["IBLOCK_ID"], "ACTIVE" => "Y", "ID" => "{$id}")
    ));

    $arRes = $result->fetch(); 
	
$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($this->arParams["IBLOCK_ID"],$id);
$IPROPERTY  = $ipropValues->getValues();
	
	$arSections = Array(
        "NAME" => $arRes["NAME"],
	    "PICTURE" => CFile::GetPath($arRes["PICTURE"]),
	    "URL" => $this->section_url($arRes["ID"]),
		"ELEMENT_PAGE_TITLE" => $IPROPERTY['ELEMENT_PAGE_TITLE'],
		"DESCRIPTION" => $this->description_len($arRes['DESCRIPTION'])
    );
return $arSections;
	}
	
	public function getSectionSeoParams($id) { //SEO ��������� ������
		$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($this->arParams["IBLOCK_ID"], $id);
        $IPROPERTY  = $ipropValues->getValues();
		
		return $IPROPERTY;
	}	

	public function section_url($id) //URL ������
	{
         $nav = CIBlockSection::GetNavChain($this->arParams["IBLOCK_ID"], $id, array(), false);
		 while ($arSection = $nav->GetNext()) {
			 $url.="{$arSection["CODE"]}/";
		 }
		 return "/{$url}";
	}	
	 
	public function description_len($text) { //������� ������
	    $text = preg_replace("/<a.*\/a>/i", "", $text);

        $description_text = strip_tags($text);	
        $description_len = strlen($description_text); 			
        $max_len = $this->arParams["DESCRIPTION_LEN"];

        if ($description_len > $max_len) {
        $description_text = trim(substr($description_text, 0, $max_len));
        $description_text = preg_replace("/ [A-z�-�\,\.\-_!\$]*$/", "", $description_text);
		$description_text = str_replace(Array("&nbsp;", "&nbsp"), " ", $description_text);
		$description_text = preg_replace("/[ \.\,]+$/", "", $description_text)."...";
        //$description_text = iconv('windows-1251', 'utf-8//IGNORE', iconv('utf-8', 'windows-1251//IGNORE', $description_text));
		
	
		$description_text = preg_replace("/[  ]+/", " ", trim($description_text));
		if (stristr(LANG_CHARSET, "utf") && strstr(LANG_CHARSET, "8")) $description_text=preg_replace('/[^A-Za-z�-��-�0-9\- *\&;\.\,:\(\)]/u', '', $description_text);
		else $description_text=preg_replace('%[^A-Za-z�-��-�0-9\- *\&;\.\,:\(\)]%', '', $description_text);
        }
        return $description_text;
    }

 public function saveData(){ //����������
		
		return;
        //echo $this->result;
		
		if ($this->arParams["STAT_LIMIT"]<1 || !$this->arParams["STAT_LIMIT"]) $this->arParams["STAT_LIMIT"] = 10000;
		
		$result = StatTable::getList(array(
            'select'  => array('*'),  
			'order' => array('ID' => 'DESC'),
        ));
		
		$arResult = $result->fetchAll();
		
		if (count($arResult)>30) StatTable::delete($arResult[count($arResult)-1]["ID"]);
		$ip = $_SERVER['HTTP_X_REAL_IP'] ? $_SERVER['HTTP_X_REAL_IP'] : $_SERVER['REMOTE_ADDR'];
		
		
		if ($arResult[0]['NAME']!=$this->result || $arResult[0]['IP']!=$ip) {
		if ($this->arParams["REQUEST"]) $this->comment.="- ������������� ������ ";
		if (MOBILE=='pda') $this->comment.="- ��������� ������ ";
	
		 StatTable::add(array(
            'NAME' => $this->result,
            'IP' => $ip,
			'USER_ID' => CUser::GetID() ? CUser::GetID() : "",
			'USER_NAME' => CUser::GetLogin() ? CUser::GetLogin() : "",
			'COMMENT' => $this->comment,
        ));
    }	
	}
	 
};