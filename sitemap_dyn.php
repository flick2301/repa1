<?header("Content-Type: text/xml");?>
<?php
$sitemap = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$file = str_replace('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', '', file_get_contents('./sitemap-files.xml', true));
$result = str_replace('</urlset>', '', $file);
$sitemap .= $result;
$file = str_replace('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', '', file_get_contents('./sitemap-iblock-17.xml', true));
$result = str_replace('</urlset>', '', $file);
$sitemap .= $result;
$file = str_replace('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', '', file_get_contents('./sitemap-iblock-16.xml', true));
$result = str_replace('</urlset>', '', $file);
$sitemap .= $result;
$file = str_replace('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', '', file_get_contents('./sitemap-iblock-8.xml', true));
$result = str_replace('</urlset>', '', $file);
$sitemap .= $result;
$sitemap .= '</urlset>';
$sitemap = str_replace('krep-komp.ru', $_SERVER[HTTP_HOST], $sitemap);
echo $sitemap;?>
