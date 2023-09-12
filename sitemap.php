<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); 
/*$pass = 'Q1rpv8qt2';

if(
    isset($_GET["key"])
    && $_GET["key"] === $pass
    ||
    isset($argv[1])
    && $argv[1] === $pass
){
   $host = COption::GetOptionString("main", "server_name");   
   $link = 'https://'.$host.'/bitrix/admin/seo_sitemap_run.php';
    echo $link;  
   $schet = 0; //просто счетчик для ограничения
   $nextStep = 0;
   $ns = '';
   $id = 1; //ID выгрузки
   
   while($schet <= 15){
      $dataStep = array(
         'lang' => 'ru', 
         'action' => 'sitemap_run',
         'ID' => $id,
         'value' => $nextStep,
         'pid' => $id,
         'NS' => $ns,
         'key' => $pass
      );
            
      $dataStepQuery = http_build_query($dataStep);                        
      $contextStep = stream_context_create(array(
            'http' => array(
               'method' => 'POST',
               'header'=> "Content-type: application/x-www-form-urlencoded",
               'content' => $dataStepQuery
            ),
      ));
      
      $contStart = file_get_contents($link, false, $contextStep);
            
      if(preg_match('/runSitemap/', $contStart)){

         //выбираем данные
         preg_match('/runSitemap\(1,\s([0-9]+),/', $contStart, $arNextStep);
         if(intval($arNextStep[1]) > 0){
            $nextStep = intval($arNextStep[1]);
            preg_match('/{(.*)}/', $contStart, $arPregNs);
            $ns = '';
            if(strlen($arPregNs[0]) > 0 && 
               strpos($arPregNs[0], '{') !== false &&
               strpos($arPregNs[0], '}') !== false
               ){
                  $nsJson = str_replace("'", '"', $arPregNs[0]);
                  $ns = json_decode($nsJson, true);
            }
         }
      }else{
         $schet = 15;
      }
      $schet++;
   }
   echo 'Pass:';
}
*/


function sitemap_gen($sitemap_path, $site_url, $new_path){
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
sitemap_gen('sitemap-iblock-17.xml', 'krep-komp.ru', 'sitemap_dyn.php');
?>