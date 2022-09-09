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
?>