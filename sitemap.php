<?php
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
		'<?=\$host?>',
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