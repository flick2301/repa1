<?

//Напишем функцию получения экземпляра класса:
function GetEntityDataClass($HlBlockId) {
	//подключаем модуль highloadblock
CModule::IncludeModule('highloadblock');
    if (empty($HlBlockId) || $HlBlockId < 1)
    {
        return false;
    }
    $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById($HlBlockId)->fetch();   
    $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();
    return $entity_data_class;
}

function getContact($url, $data)
{
    $queryUrl = $url;
    $queryData = http_build_query($data);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $queryUrl,
        CURLOPT_POSTFIELDS => $queryData,
    ));
    $date = curl_exec($curl);
    curl_close($curl);
    return json_decode($date, true);
}

//Вывести заголовок
function globalGetTitle($title = "", $template="new.moskrep") {
	
	global $APPLICATION;
	
	if($template == "new.moskrep")
	{
		echo "<!--page-heading-->
			<div class=\"basic-layout__module page-heading\">             
			<h1>{$title}"; 
			
		if (!$title) echo $APPLICATION->GetTitle();
			
		echo "</h1>
            </div>
			<!--page-heading-->";
	}elseif($template == "krep-komp")
	{
		echo "<div class='content__title'>";
		if (!$title) $APPLICATION->ShowTitle();
		else echo $title;
		echo "</div>";
	}
}

function getSalesFromPriceNew($price, $currency, $items)
{
	if(CModule::IncludeModule("catalog")){
	$sale = 0;
	if($price > 5000 && $price < 10000)
		$catalog_group_id = ID_PRICE_5;
	if($price > 10000 && $price < 15000)
		$catalog_group_id = ID_PRICE_10;
	if($price > 15000 && $price < 20000)
		$catalog_group_id = ID_PRICE_15;
	if($price > 20000 && $price < 25000)
		$catalog_group_id = ID_PRICE_20;
	if($price > 25000 && $price < 100000)
		$catalog_group_id = ID_PRICE_25;
	if($price > 100000 && $price < 500000)
		$catalog_group_id = ID_PRICE_30;
	if($price > 500000)
		$catalog_group_id = ID_PRICE_35;
	
	foreach($items as $item)
	{
		
		$db_item_price = CPrice::GetList(array(), array("PRODUCT_ID" => $item['PRODUCT_ID'], "CATALOG_GROUP_ID" => $catalog_group_id));
		
		while ($ar_item_price = $db_item_price->Fetch())
		{
			
			$price_new += $ar_item_price["PRICE"]*$item['QUANTITY'];
	
		}
	}
	$price_new = CurrencyFormat($price_new, $currency);
	$sale = CurrencyFormat($sale, $currency);
	}
	return $price_new;
}


function getSalesFromPrice($price, $currency, $items)
{
	$sale = 0;
	if($price > 5000 && $price < 10000)
		$sale = $price * 0.05;
	if($price > 10000 && $price < 15000)
		$sale = $price * 0.1;
	if($price > 15000 && $price < 20000)
		$sale = $price * 0.15;
	if($price > 20000 && $price < 25000)
		$sale = $price * 0.2;
	if($price > 25000 && $price < 100000)
		$sale = $price * 0.25;
	if($price > 100000 && $price < 500000)
		$sale = $price * 0.3;
	if($price > 500000)
		$sale = $price * 0.35;
	$price_new = CurrencyFormat($price-$sale, $currency);
	$sale = CurrencyFormat($sale, $currency);
	return $price_new;
}

function getSalesPersent($price)
{
	$percent = 0;
	global $USER;
	if(!$USER->IsAuthorized()){
		if($price > 5000 && $price < 10000)
			$percent = 5;
		if($price > 10000 && $price < 15000)
			$percent = 10;
		if($price > 15000 && $price < 20000)
			$percent = 15;
		if($price > 20000 && $price < 25000)
			$percent = 20;
		if($price > 25000 && $price < 100000)
			$percent = 25;
		if($price > 100000 && $price < 500000)
			$percent = 30;
		if($price > 500000)
			$percent = 35;
	}
	
	return $percent;
}


function sitemap_gen(){
	$sitemap_path = 'sitemap-iblock-17.xml';
	$site_url = 'krep-komp.ru';
	$new_path = 'sitemap_dyn.php';
	
	if (substr($sitemap_path, 0, 1) != '/'){
		$sitemap_path = '/'.$sitemap_path;
	}
	$sitemap_path = $_SERVER["DOCUMENT_ROOT"].$sitemap_path;
	if (substr($new_path, 0, 1) != '/'){
		$new_path = '/'.$new_path;
	}
	$new_path = $_SERVER["DOCUMENT_ROOT"].$new_path;

	$dyn_sitemap = '<?'.PHP_EOL.'$host = preg_replace("/\:\d+/is", "", $_SERVER["HTTP_HOST"]);'.PHP_EOL.
		'if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on"){'.PHP_EOL.
		'	$http = "https";'.PHP_EOL.
		'}'.PHP_EOL.
		'else{'.PHP_EOL.
		'	$http = "http";'.PHP_EOL.
		'}'.PHP_EOL.
		'header("Content-Type: text/xml");'.PHP_EOL;

	$sitemap = file_get_contents($sitemap_path);
	if (!$sitemap){
		return false;
	}

	// замены
	$search = Array(
		$site_url,
		'http:',
		'https:',
	);
	$replace = Array(
		'<?=$host?>',
		'<?=$http?>:',
		'<?=$http?>:'
	);

	$sitemap = str_replace($search, $replace, $sitemap);

	$sitemap = preg_replace('/(\<\?xml[^\>]+\>)/i', "echo '$1';?>".PHP_EOL, $sitemap);

	$dyn_sitemap .= $sitemap;

	if (!file_put_contents($new_path, $dyn_sitemap)){
		return false;
	}
	return true;
}

function canonnical()
{
	global $APPLICATION;
        ob_start();

        if($APPLICATION->GetProperty('element') == true) {
            echo "<link rel='canonical' href='https://".$_SERVER["HTTP_HOST"].$APPLICATION->GetCurPage(false)."' />";
        } else {
            echo "<link rel='canonical'  href='https://".$_SERVER["HTTP_HOST"].$APPLICATION->GetCurPageParam()."' />";
        }
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
}

?>