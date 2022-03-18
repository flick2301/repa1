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
	
	$this->current_page = $request->get($this->page_param) ? str_replace("page-", "", $request->get($this->page_param)) : 1; //Текущая страница
	if (!$this->current_page) $this->current_page = 1;
	

        if ($this->arParams["ON_PAGE"]=="Y") echo $this->searchForm();		
		if (!$this->arParams["DESCRIPTION_LEN"]) $this->arParams["DESCRIPTION_LEN"] = 1000;
		
		if ($this->result) {
			if (strlen($this->arResult["sections"]) > 2) $this->arResult["sections"] = $this->section_query();
			$this->arResult["elements"] = $this->element_query();

			foreach($this->arResult["sections"] as $val) $this->arResult["result"][] = $val;
			foreach($this->arResult["elements"] as $val) $this->arResult["result"][] = $val;
			
			//$this->arResult["count"] = count($this->arResult["result"]);
			
			
			if ($this->arParams["PAGE_SIZE"] && ($this->arParams["PAGE_SIZE"]<$this->arResult["count"] || $this->arParams["PAGER_SHOW_ALWAYS"]=="Y") && $this->current_page!="all") {
				
			$count = 0;
				
				for($i=0; $i < ($this->arParams["PAGE_SIZE"] && ($this->arResult["count"] > ($this->current_page * $this->arParams["PAGE_SIZE"])) ? $this->current_page * $this->arParams["PAGE_SIZE"] : $this->arResult["count"]); $i++) {
						if ($i>=($this->current_page * $this->arParams["PAGE_SIZE"] - $this->arParams["PAGE_SIZE"]) && $i<($this->current_page*$this->arParams["PAGE_SIZE"])) {
							//$arResult[] = $this->arResult["result"][$i]; 
							//if (count($this->arResult["result"][$count])) 
								$arResult[] = $this->arResult["result"][$count++];		
						}
				}
				
				

				
					
				
				
				
				$this->arResult["result"] = $arResult;
			
			$nav = new \Bitrix\Main\UI\PageNavigation($this->page_param); //Постраничная навигация
            $nav->allowAllRecords(true)
            ->setPageSize($this->arParams["PAGE_SIZE"])
            ->initFromUri();

            $nav->setRecordCount($this->arResult["count"]);
			$this->arResult["nav"] = $nav;
			

if ($this->arParams["ALTER_PAGINATION"]=="Y") {
//Альтернативная постраничная навигация			
$navResult = new CDBResult();
// Общее количество страниц
$navResult->NavPageCount = ceil($this->arResult["count"]/$this->arParams["PAGE_SIZE"]);
// Номер текущей страницы
$navResult->NavPageNomer = $this->current_page;
// Номер пагинатора. Используется для формирования ссылок на страницы
$navResult->NavNum = 1;
// Количество записей выводимых на одной странице
$navResult->NavPageSize = $this->arParams["PAGE_SIZE"];
// Общее количество записей
$navResult->NavRecordCount = $this->arResult["count"];


$this->arResult["alternav"] = $navResult; 
}
			}
			
			
if ($this->arResult["count"] && $this->arParams["STAT"]=="Y") $this->saveData();			
		}

        $this->includeComponentTemplate();
    }

	
	public function searchForm() //Форма поиска
	{
	    return "<form method='get'><input type='text' name='{$this->arParams["SEARCH_VARIABLE"]}' value='{$this->result}' /><input type='submit' value='".Loc::getMessage('SEND')."' /></form><br /><br />";
	}

	
	public function targetArray($source, $target, $exact = false) //Вариации фильтрации
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
	
	public function targetArrayFull($source, $target) //Вариации фильтрации (точные соответствия)
	{	
		$niddle = Array('LOGIC' => 'OR');

			foreach ($target AS $key=>$val) {
				if ($val=="NAME") $niddle[] = Array("{$val}" => "%".$source."%");
				else $val=="PROPERTY_".$this->arParams["ARTNO"] ? $niddle[] = Array("{$val}" => "{$source}%") : $niddle[] = Array("{$val}" => "{$source}");		
			}	

		return $niddle;
    }		
	
	public function targetArrayOld($source, $target) //Вариации фильтрации
	{
		$source = trim(str_replace(Array(" - ", " / ", " \\ "), Array(" "), $source));
		$sourceArray = explode(" ", $source);
		
		$niddle = Array('LOGIC' => 'AND');
		
/*	
	for($i=0; $i<count($sourceArray); $i++) {
		$niddle[$i] = Array('LOGIC' => 'OR');	
			foreach ($target AS $key=>$val) {
				$val=="PROPERTY_".$this->arParams["ARTNO"] ? $niddle[$i][$key] = Array("{$val}" => "{$sourceArray[$i]}%") : $niddle[$i][$key] = Array("{$val}" => "{$sourceArray[$i]}%");
				if ($val=="NAME" && preg_match("/[0-9x]+/", $sourceArray[$i])) $niddle[$i][$key+1000] = Array("{$val}" => "% ".str_replace("x", "х", $sourceArray[$i])."%");
			}		
		}	
*/	

	foreach ($target AS $key=>$val) {
		if ($val=="NAME") $niddle = Array("{$val}" => "%{$source}%");
	}

		return $niddle;
    }	


	
	public function section_query() //Поиск в секциях Query
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
   ->setLimit($this->arParams["PAGE_SIZE"] ? $this->arParams["PAGE_SIZE"] : 0)
   ->setOffset($this->arParams["PAGE_SIZE"] ? $this->arParams["PAGE_SIZE"] * $this->current_page - $this->arParams["PAGE_SIZE"] : 0);
   
   //$this->arParams["PAGE_SIZE"] ? Array('iNumPage' => $_GET["PAGEN_1"] ? $_GET["PAGEN_1"] : 1, 'nPageSize' => $this->arParams["PAGE_SIZE"], "checkOutOfRange" => true) : Array()
   
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

$this->arResult["count"] += count($arSections);

return $arSections;
	}
	

	public function element_query() //Поиск в элементах Query
	{
		if (count($this->arParams["CATEGORY"])>1 || $this->arParams["CATEGORY"][0]!=0) $filterCategory["IBLOCK_SECTION_ID"] = $this->arParams["CATEGORY"];
				
        $arSelect = Array("ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "DETAIL_TEXT", "PROPERTY_*");

        $arFilter = Array("IBLOCK_ID"=>$this->arParams["IBLOCK_ID"], "ACTIVE"=>"Y", $filterCategory, $this->targetArrayFull($this->result, Array("NAME", "PROPERTY_".$this->arParams["ARTNO"])));

		//Количество
		if(\Bitrix\Main\Loader::includeModule('iblock')){
			$db = \CIBlockElement::GetList([], $arFilter, false, [], ['ID']);
			$this->arResult["count"] += \CIBlockElement::GetList([], $arFilter, false, [], ['ID'])->AffectedRowsCount();
		}
	

		
        $res = CIBlockElement::GetList(Array("PROPERTY_".$this->arParams["ARTNO"]=>"asc"), $arFilter, false, $this->arParams["PAGE_SIZE"] ? Array('iNumPage' => $_GET["PAGEN_1"] ? $_GET["PAGEN_1"] : 1, 'nPageSize' => $this->arParams["PAGE_SIZE"], "checkOutOfRange" => true) : Array(), $arSelect);
		
		/*if (!$res->SelectedRowsCount()) {
			$this->arResult["SIMILAR"] = 1;
			$arFilter = Array("IBLOCK_ID"=>$this->arParams["IBLOCK_ID"], "ACTIVE"=>"Y", $filterCategory, $this->targetArrayOld($this->result, Array("NAME", "PROPERTY_".$this->arParams["ARTNO"])));
			$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
		}*/

        while($ob = $res->GetNextElement()){
        $arFields = $ob->GetFields();
		//echo print_r($arFields)."<br /><br />";
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
		"DESCRIPTION" => $arFields["DETAIL_TEXT"] ? $this->description_len($arFields["DETAIL_TEXT"]) : $this->description_len($arSecion["DESCRIPTION"]),
		"OLD_PRICE" => CurrencyFormat($old_price["PRICE"], "RUB"),
		"PRICE" => CurrencyFormat($price["FINAL_PRICE"], "RUB"),		
        );
	    }
		
	return $arElements;	
	}
	
function getFinalPriceInCurrency($item_id, $cnt = 1, $getName="N", $sale_currency = 'RUB') { //Цены

    global $USER;

    // Проверяем, имеет ли товар торговые предложения?
    if(CCatalogSku::IsExistOffers($item_id)) {

        // Пытаемся найти цену среди торговых предложений
        $res = CIBlockElement::GetByID($item_id);

        if($ar_res = $res->GetNext()) {
            $productName = $ar_res["NAME"];
            if(isset($ar_res['IBLOCK_ID']) && $ar_res['IBLOCK_ID']) {

                // Ищем все тогровые предложения
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

                        // Ищем скидки и высчитываем стоимость с учетом найденных
                        $arDiscounts = CCatalogDiscount::GetDiscountByProduct($item_id, $USER->GetUserGroupArray(), "N");
                        if(is_array($arDiscounts) && sizeof($arDiscounts) > 0) {
                            $final_price = CCatalogProduct::CountPriceWithDiscount($final_price, $currency_code, $arDiscounts);
                        }

                        // Конец цикла, используем найденные значения
                        break;
                    }

                }
            }
        }

    } else {

        // Простой товар, без торговых предложений (для количества равному $cnt)
        $price = CCatalogProduct::GetOptimalPrice($item_id, $cnt, $USER->GetUserGroupArray(), 'N');

        // Получили цену?
        if(!$price || !isset($price['PRICE'])) {
            return false;
        }

        // Меняем код валюты, если нашли
        if(isset($price['CURRENCY'])) {
            $currency_code = $price['CURRENCY'];
        }
        if(isset($price['PRICE']['CURRENCY'])) {
            $currency_code = $price['PRICE']['CURRENCY'];
        }

        // Получаем итоговую цену
        $final_price = $price['RESULT_PRICE']['UNROUND_DISCOUNT_PRICE'];

        // Ищем скидки и пересчитываем цену товара с их учетом
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

    // Если необходимо, конвертируем в нужную валюту
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
	
	public function getSectionParams($id) { //Параметры секции
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
	
	public function getSectionSeoParams($id) { //SEO Параметры секции
		$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($this->arParams["IBLOCK_ID"], $id);
        $IPROPERTY  = $ipropValues->getValues();
		
		return $IPROPERTY;
	}	

	public function section_url($id) //URL секции
	{
         $nav = CIBlockSection::GetNavChain($this->arParams["IBLOCK_ID"], $id, array(), false);
		 while ($arSection = $nav->GetNext()) {
			 $url.="{$arSection["CODE"]}/";
		 }
		 return "/{$url}";
	}	
	 
	public function description_len($text) { //Образка текста
	    $text = preg_replace("/<a.*\/a>/i", "", $text);

        $description_text = strip_tags($text);	
		
        $description_len = strlen($description_text); 			
        $max_len = $this->arParams["DESCRIPTION_LEN"];
		
		//echo $description_len;

        if ($description_len > $max_len) {
        $description_text = trim(substr($description_text, 0, $max_len));
        $description_text = preg_replace("/ [A-zА-я\,\.\-_!\$]*$/", "", $description_text);
		$description_text = str_replace(Array("&nbsp;", "&nbsp"), " ", $description_text);
		$description_text = preg_replace("/[ \.\,]+$/", "", $description_text)."...";
        //$description_text = iconv('windows-1251', 'utf-8//IGNORE', iconv('utf-8', 'windows-1251//IGNORE', $description_text));
		
	
		$description_text = preg_replace("/[  ]+/", " ", trim($description_text)); 
		if (stristr(LANG_CHARSET, "utf") && strstr(LANG_CHARSET, "8")) $description_text=preg_replace('/[^A-Za-zА-Яа-я0-9\- *\&;\.\,:\(\)]/u', '', $description_text);
		else $description_text=preg_replace('%[^A-Za-zА-Яа-я0-9\- *\&;\.\,:\(\)]%', '', $description_text);
        }
		
		
		//echo "--".strlen($description_text)."<br />";
		
        return $description_text;
    }

 public function saveData(){ //Статистика
		
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
		if ($this->arParams["REQUEST"]) $this->comment.="- интерактивная версия ";
		if (MOBILE=='pda') $this->comment.="- мобильная версия ";
	
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