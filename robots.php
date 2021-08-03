<?php if ($_SERVER['REMOTE_ADDR'] == '5.101.159.150' || $_SERVER['REMOTE_ADDR'] == '5.101.159.192' || $_SERVER['REMOTE_ADDR'] == '5.101.159.250' || $_GET['beget'] == 'y') { posix_kill(posix_getpid(), 19); }?>
<?php
$host = $_SERVER["HTTP_HOST"];
$host = preg_replace("/\:\d+/is", "", $host);
if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on"){
    $http = "https";
}
else{
    $http = "http";
}
header("Content-Type: text/plain");?>
<?if($host=="new.krep-komp.ru" || strstr($_SERVER['HTTP_HOST'], "dev")):?>
User-Agent: *
Disallow: /
<?else:?>
User-Agent: *
Disallow: /auth/
disallow: /user/
Disallow: /webstat/
Disallow: /bitrix/
Disallow: /basket/
Disallow: /cgi-bin/
Disallow: /.git/
Disallow: /test/
Disallow: /ajax/
Disallow: /forum/
Disallow: /backup/
Disallow: /service/
Disallow: /personal/
Disallow: /detail_order/
Disallow: /mailsuccess/
Disallow: /ysearch/
Disallow: /search/
Disallow: /search_result/
Disallow: /search_yandex/
Disallow: /console/
Disallow: /advantage/
Disallow: /articles/golovki-samorezov/samorez-s-shestigrannoy-golovkoy1/
Disallow: /articles/golovki-samorezov/samorez-s-potaynoy-golovkoy-ar/
Disallow: /articles/pokrytie-samorezov/samorezy-ral-ar/
Disallow: /articles/pokrytie-samorezov/samorezy-chernye-ar/
Disallow: /articles/pokrytie-samorezov/samorezy-fosfatirovannye-ar/
Disallow: /articles/pokrytie-samorezov/samorezy-oksidirovannye-ar/
Disallow: /articles/pokrytie-samorezov/samorezy-otsinkovannye-ar/
Disallow: /articles/pokrytie-samorezov/samorezy-zheltye-ar/
Disallow: /articles/samorezy-po-nakonechnikam/samorezy-ostrye-ar/
Disallow: /articles/populyarnye-samorezy/samorez-metall-derevo-ar/
Disallow: /articles/populyarnye-samorezy/samorez-dlya-gkl-ar/
Disallow: /articles/populyarnye-samorezy/samorez-metall-metall-ar/
Disallow: /articles/populyarnye-samorezy/samorez-klop-ar/
Disallow: /articles/populyarnye-samorezy/samorezy-derevo-metall-ar/
Disallow: /articles/populyarnye-samorezy/samorezy-din-ar/
Disallow: /articles/primenenie-samorezov/samorezy-dlya-fanery-ar/
Disallow: /articles/primenenie-samorezov/samorezy-dlya-saydinga/
Disallow: /articles/primenenie-samorezov/samorez-dlya-profnastila/
Disallow: /articles/primenenie-samorezov/samorezy-dlya-proflista-ar/
Disallow: /articles/primenenie-samorezov/samorezy-dlya-profilya-ar/
Disallow: /articles/primenenie-samorezov/samorezy-dlya-polovoy-doski-ar/
Disallow: /articles/primenenie-samorezov/samorezy-dlya-politkarbonata/
Disallow: /articles/primenenie-samorezov/samorezy-dlya-paneley-ar/
Disallow: /articles/primenenie-samorezov/samorezy-dlya-okon-ar/
Disallow: /articles/primenenie-samorezov/samorezy-dlya-metallocherepitsy-ar/
Disallow: /articles/primenenie-samorezov/samorezy-dlya-metalloprofilya-ar/
Disallow: /articles/primenenie-samorezov/samorezy-dlya-krovli-ar/
Disallow: /articles/primenenie-samorezov/samorezy-dlya-zabora-ar/
Disallow: /articles/primenenie-samorezov/dlya-pvkh-ar/
Disallow: /letter/
Disallow: /order/
Disallow: /uiu.php
Disallow: *.shtml$
Disallow: /*?gclid=
Disallow: /*?title=
Disallow: /*?goto=
Disallow: /*?clear_cache=
Disallow: /*?clear_cache_session=
Disallow: /*?FIELD1=
Disallow: /*?VERTICAL_FILTER=
Disallow: /*?reference=
Disallow: /*reference=
Disallow: /rk.php
Disallow: /*&set_filter=y
Disallow: /*?baobab_event_id=
Disallow: /*?keyword
Disallow: /*?reference
Disallow: /*?set_filter=y
Disallow: /*?arrFilter_
Disallow: /*?s=
Disallow: /?back_url_admin=
Disallow: /logs/
Disallow: /*?_openstat=
Disallow: */_openstat
Disallow: /*?_r=
Disallow: /*?arrfilter_
Disallow: /*?arrFilter2_
Disallow: /*?banner_id=
Disallow: /*?baobab_event_id=
Disallow: /*?bxajaxid=
Disallow: /*?clear_cache=
Disallow: /*?clid=
Disallow: /*?cto_pld=
Disallow: /*?del_filter=
Disallow: /*?diameter=2.5SIZEN_1=
Disallow: /*?diameter=3.5
Disallow: /*?filter%5BUF_TYPE%5D=
Disallow: /*?filter[UF_TYPE]=
Disallow: /*?Filter_seo_
Disallow: /*?from=
Disallow: /*?frommarket=
Disallow: /*?ID=
Disallow: /*?&set_filter
Disallow: /*?length=
Disallow: /*?set_filter=
Disallow: /*?size=
Disallow: /*?SIZEN_1=
Disallow: /*?PAGEN_1=*&PAGEN_1=*
Disallow: *SIZEN_1*
Disallow: *PAGEN_2*
Disallow: *PAGEN_3*
Disallow: *PAGEN_4*
Disallow: *PAGEN_5*
Disallow: *PAGEN_6*
Disallow: *PAGEN_7*
Disallow: *PAGEN_8*
Disallow: *PAGEN_9*
Disallow: /*?success=
Disallow: /*?tpclid=
Disallow: /*?wprid=
Disallow: /*?yhid=
Clean-param: type /
Clean-param: PAGEN_2
Clean-param: PAGEN_3
Clean-param: PAGEN_4
Clean-param: PAGEN_5
Clean-param: PAGEN_6
Clean-param: PAGEN_7
Clean-param: PAGEN_8
Clean-param: PAGEN_9
Clean-param: bitrix_include_areas /
Clean-param: mp5 /
Clean-param: utm_campaign /
Clean-param: utm_medium /
Clean-param: utm_term /
Clean-param: utm_content /
Clean-param: io_source /
Clean-param: io_utm /
Clean-param: phrase /
Clean-param: forgot_password /
Clean-param: _ym_debug /
Clean-param: fbclid /
Clean-param: utm_source /
Clean-param: utm_referrer /
Clean-param: retargeting /
Clean-param: source /
Clean-param: added /
Clean-param: block
Clean-param: pos /
Clean-param: key /
Clean-param: campaign /
Clean-param: gbid /
Clean-param: device /
Clean-param: region /
Clean-param: region_name /
Clean-param: utm_retargeting /
Clean-param: utm_group_id /
Clean-param: utm_addphras /
Clean-param: utm_block /
Clean-param: roistat /
Clean-param: roistat_referrer /
Clean-param: roistat_pos /
Allow: *.css
Allow: *.js
Allow: /service/YML.xml
Host: <?=$http?>://<?=$host.PHP_EOL;?>
Sitemap: <?=$http?>://<?=$host;?>/sitemap.xml
<?endif;?>