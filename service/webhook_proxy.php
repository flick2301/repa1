<?php
//require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';


//
    $arStat = array('20452609' => 'DP', '20452603' => 'N', '142' => 'DONE', '20452606' => 'accepted');
    $post = array();
    $post['name'] = $_POST['leads']['status']['0']['name'];
	$post['id'] = $_POST['leads']['status']['0']['name'];
	$tel = $_POST['leads']['status']['0']['custom_fields'];
	foreach($tel as $value){
		if($value['name']=='ТЕЛЕФОН'){
			$post['tel'] = $value['values'][0]['value'];
		}
	}
	
    
	file_put_contents($_SERVER['DOCUMENT_ROOT'].'/service/loghook.txt', print_r($_POST,true));
	
	    if($arStat[$_POST['leads']['status']['0']['status_id']] && $post['tel'] != ''){
		$post['webhook'] = $arStat[$_POST['leads']['status']['0']['status_id']];
		
	$myCurl = curl_init();
curl_setopt_array($myCurl, array(
    CURLOPT_URL => 'https://xn--b1aaib1djz7b.xn--80asehdb/service/webhook.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query($post)
));
$response = curl_exec($myCurl);
curl_close($myCurl);
	
	}
//require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");	  
?>
