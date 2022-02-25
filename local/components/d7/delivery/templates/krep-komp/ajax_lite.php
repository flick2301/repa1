<?php
global $APPLICATION;
$templateFolder = "/local/components/d7/delivery/templates/krep-komp";
?>

<link href="<?=$templateFolder?>/style.css" type="text/css" rel="stylesheet" />
<link href="/delivery/style.css" type="text/css" rel="stylesheet" />
<script id="api-map-delivery">
    /*$.getScript('/delivery/areas.js', function(){
});*/

    $.getScript('/delivery/get_areas.php', function(){
    });

    if(location.hostname=='dev1.krep-komp.ru' || location.hostname=='krep-komp.ru')
        ready();
    else if(location.hostname=='spb.krep-komp.ru')
        ready_spb();
    else if(location.hostname=='nn.krep-komp.ru')
        ready_nn();
    else if(location.hostname=='voron.krep-komp.ru')
        ready_voron();
    var myMap,
        myPolygon = [];

    function ready() {
        ymaps.ready(init);
    }

    function ready_spb() {
        ymaps.ready(init_spb);
    }

    function ready_nn() {
        ymaps.ready(init_nn);
    }

    function ready_pskov() {
        ymaps.ready(init_pskov);
    }

    function ready_voron() {
        ymaps.ready(init_voron);
    }

    function init() {
        myMap = new ymaps.Map("map", {
            center: [55.753559,37.609218],
            zoom: 8,
        }, {
            avoidFractionalZoom: false,
            searchControlProvider: 'yandex#search'
        });
        loadPolygons();
    }

    function init_spb() {
        myMap = new ymaps.Map("map_spb", {
            center: [59.939095, 30.315868],
            zoom: 8,
        }, {
            avoidFractionalZoom: false,
            searchControlProvider: 'yandex#search'
        });
        loadPolygons_spb();
    }

    function init_nn() {
        myMap = new ymaps.Map("map_nn", {
            center: [56.3287, 44.002],
            zoom: 8,
        }, {
            avoidFractionalZoom: false,
            searchControlProvider: 'yandex#search'
        });
        loadPolygons_nn();
    }

    function init_pskov() {
        myMap = new ymaps.Map("map_pskov", {
            center: [57.819274, 28.332460],
            zoom: 8,
        }, {
            avoidFractionalZoom: false,
            searchControlProvider: 'yandex#search'
        });
        //loadPolygons_nn();
    }

    function init_voron() {
        myMap = new ymaps.Map("map_voron", {
            center: [51.660786, 39.200269],
            zoom: 9,
        }, {
            avoidFractionalZoom: false,
            searchControlProvider: 'yandex#search'
        });
        loadPolygons_voron();
    }

    function stopDraw() {
        if (myPolygon.length > 0) {
            $.each(myPolygon, function (i, obj) {
                if (typeof myPolygon[i] == 'object') {
                    obj.editor.stopEditing();
                }
            });
        }
    }


    function addPolygon(coords, numpol, index, num) {

        //console.log(coords);

        /* пробежимся по массиву полигонов и остановим их редактирование */

        if (typeof coords === 'undefined' || !coords.length) {
            coords = [];
        }
        stopDraw();

        myPolygon[numpol] = new ymaps.Polygon(coords, {
            hintContent: numpol
        }, {
            fillColor: '#f00',
            strokeColor: '#d00000',
            fillOpacity: .05,
            outline: true,
            strokeWidth: 1
        });
        myMap.geoObjects.add(myPolygon[numpol]);

        myPolygon[numpol].events.add('hover', function () {
            $('.delivery__td').removeClass('red');
            //if (num) $('.delivery__td:nth-child(' + (num + 1) + ')').addClass('red');
        });

    }
</script>


<div class="win-close" id="close"></div>
<div class="delivery">
    <!--content-tabs-->
    <div class="delivery__tabs" data-delivery-tabs>
        <?foreach($arResult["ITEMS"] AS $key=>$item):?>
            <div class="delivery__tab <?if($key==0):?>delivery__tab--active<?endif?>"><?=$item["NAME"]?></div>
        <?endforeach?>
    </div>
    <!--content-tabs-->



    <div class="delivery__list">
        <?foreach($arResult["ITEMS"] AS $key=>$item):?>
            <div class="delivery__box <?if($key==0):?>delivery__box--active<?endif?>" id="<?=$item["CODE"]?>">
                <div class="delivery__topic"></div>
                <?if($item["PROP"]["MAP"]["VALUE"]):?><script>document.addEventListener("DOMContentLoaded", <?=$item["PROP"]["MAP"]["VALUE"]?>);</script><?endif?>

                <?=$item["PREVIEW_TEXT"]?>
                <?if($item["PROP"]["MAP"]["VALUE"]):?><div id="<?=str_replace("ready", "map", $item["PROP"]["MAP"]["VALUE"])?>" style="height: 500px;" class="external"></div><br /><?endif?>
                <?=$item["DETAIL_TEXT"]?>

                <?if($item["PROP"]["FILE"]["VALUE"]):?>
                    <?
                    $APPLICATION->IncludeFile(
                        "/delivery/".$item["PROP"]["FILE"]["VALUE"],
                        $arParams["SHOW_FRAME"]=="Y" ? array("SHOW_FRAME" => "Y") : "",
                        array("SHOW_BORDER" => true, "MODE"=>"php")
                    );
                    ?>
                <?endif?>



            </div>
        <?endforeach?>
    </div>
</div>