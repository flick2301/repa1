<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
header("Content-type: text/xml; charset=utf-8");

class XML_PINBOX
{
	public $response;
	public $sections;
	
	
	public function __construct()
	{
		$this->response = "<?xml version='1.0' encoding='utf-8' standalone='yes'?>\n";
	}
	public function getSections($iblock_id)
	{
		$db_list = \CIBlockSection::GetList(Array("SORT" => "ASC"), ['IBLOCK_ID '=>$iblock_id], true);
		while($arSection = $db_list->GetNext())
		{
			$arR = CIBlockSection::GetNavChain(
				$iblock_id,
				$arSection["ID"]
			);
			$arTree = array();
			while($section = $arR->GetNext())
			{
				$arTree[] = $section['NAME'];
			}
			$this->sections[$arSection["ID"]] = $arTree[1];
		}
		
		
	}
	public function setData($iblock_id)
	{
		$date = date("Y-m-d");
		$this->response .= '<products dateUpd="'.$date.'">';
		
		$month = time() - 3600*24*30; // 30 day
		$arFilter = Array(
			">=DATE_INSERT" => date(
				\CDatabase::DateFormatToPHP(CSite::GetDateFormat("SHORT")), $month
			)
		);
		$db_sales = \CSaleOrder::GetList(
			array("DATE_INSERT" => "ASC"),
			$arFilter,
			false,
			false,
			array("ID", "DATE_INSERT_FORMAT")
		);
		$arOrders = array();
		while ($ar_sales = $db_sales->Fetch()) {
			$arOrders[] = $ar_sales['ID'];
		}
		$arOrderProduct = array();
		foreach ($arOrders as $key => $order_id) {
			$dbBasketItems = \CSaleBasket::GetList(array(), array("ORDER_ID" => $order_id), false, false, array());
			$product = array();
			while ($arItems = $dbBasketItems->Fetch()) {
				$arOrderProduct[$arItems['PRODUCT_ID']][] = 'Y';
			}
			unset($dbBasketItems);
		}
		$arHits = array();
		foreach ($arOrderProduct as $productID => $arProduct) {
			if (count($arProduct) > 2) {
				$arHits[] = $productID;
			}
		}
		
		
			$dbResult = \CIBlockElement::GetList(
				array("SORT" => "ASC"),
				array("IBLOCK_ID" => $iblock_id, "ID"=>$arHits, "ACTIVE"=>"Y", "CATALOG_AVAILABLE"=>'Y'),
				false,
				array(),
				array("*", "CATALOG_GROUP_9")
			);
			while($arResult = $dbResult->GetNextElement())
			{
				
				
				$fields = $arResult->GetFields();
				$props = $arResult->GetProperties();
				$img_url = CFile::GetPath($fields["PREVIEW_PICTURE"]) ?? CFile::GetPath($arSection["PICTURE"]) ?? CFile::GetPath($fields["DETAIL_PICTURE"]);
				$this->response .= '<product>';
				$this->response .= '<id>'.$fields['ID'].'</id>';
				$this->response .= '<title>'.htmlspecialchars($fields['NAME']).'</title>';
				$this->response .= '<price>';
				$this->response .= '<price_info>fix</price_info>';
				$this->response .= '<cost>'.$fields['CATALOG_PRICE_9'].'</cost>';
				$this->response .= '<currency>RUR</currency>';
				$this->response .= '</price>';
				$this->response .= '<rubric>'.strtok($this->sections[$fields['IBLOCK_SECTION_ID']], " ").'</rubric>';
				if($img_url)
					$this->response .= '<photo>https://'.$_SERVER['HTTP_HOST'].$img_url.'</photo>';
				$this->response .= '</product>';
				$this->response .= '<date>'.date("Y-m-d").'</date>';
			}
		
		$this->response .='</products>';

	}
	
}


$pinbox = new XML_PINBOX;
$pinbox->getSections(17);
$pinbox->setData(17);
file_put_contents('xmlfeed.xml', $pinbox->response);

echo $pinbox->response;