<?
$url = 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/party';
$str = '{ "query": "'.$_REQUEST['INN'].'" }';
$ch = curl_init($url);
            
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $str);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            
curl_setopt ($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Accept: application/json", "Authorization: Token e8f58ae3fe7c34bc1f840d07eca063c871bd9a97"));
$output=curl_exec ($ch);
			
$result = curl_multi_getcontent ($ch);
$datasearch = json_decode($output);
$data_php = array("KPP" => $datasearch->suggestions[0]->data->kpp, "OGRN"=>$datasearch->suggestions[0]->data->ogrn, "NAME"=>$datasearch->suggestions[0]->data->management->name);
$data_json = json_encode($data_php);
echo $data_json;

curl_close ($ch);
			?>