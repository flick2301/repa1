<?

//Методы такие как $APPLICATION->AddHeadScript() здесь работать не будут, они же загружаются в хедере. А это ajax. Так что
// подключаем файлы простыми тэгами html
$templateFolder = "/local/components/d7/contact_shops/templates/krep-komp.new";
?>

<link href="<?=$templateFolder?>/style.css" type="text/css" rel="stylesheet" />
<link href="<?=$templateFolder?>/slick/slick.css" type="text/css" rel="stylesheet" />
<link href="<?=$templateFolder?>/slick/slick-theme.css" type="text/css" rel="stylesheet" />

<script id="api-map">
        if (typeof zoom=='undefined') zoom = [];
        if (typeof center_lat=='undefined') center_lat = [];
        if (typeof center_lon=='undefined') center_lon = [];
        if (typeof shop=='undefined') shop = [];
        if (typeof myPlacemark=='undefined') myPlacemark = [];
        //if (typeof myPlacemark2565=='undefined') myPlacemark2565 = [];
        //if (typeof myPlacemark2631=='undefined') myPlacemark2631 = [];
        if (typeof myMap=='undefined') myMap = {};
        section_id = '<?=$arParams["SECTION_ID"] ? $arParams["SECTION_ID"] : "9999"?>';
        select_city = '<?=$arResult['SELECT']?>';
        zoom[section_id] = '<?=$arResult["ZOOM"] ? $arResult["ZOOM"] : 9;?>';
        center_lat[section_id] = '<?=$arResult["LAT"] ? $arResult["LAT"] : 55.73?>';
        center_lon[section_id] = '<?=$arResult["LON"] ? $arResult["LON"] : 37.75?>';
        template_url = '<?=$templateFolder?>';

</script>

<div class="win-close" id="close"></div>
<div class="shops">
    <div class="shops__map">
        <div class="shop_map" style='height:450px;'>
            <div id="map"></div>
        </div>

        <div class="shops_cart">
            <div class="product-card__artno-blok">
                <p class="product-card__artno">Артикул: <span class="product-card__state product-card__state_artno"><?=$arResult['PROPERTIES']['CML2_ARTICLE']['VALUE']?></span></p>
            </div>

            <div class="product-card__header product-card__header_vi">
                <img class="product-card__image" src="<?=$arResult["PRODUCT"]["PREVIEW_PICTURE_SRC"]?>" height="150" alt="<?=$arResult["PRODUCT"]["CATALOG_PRODUCT_IBLOCK_ELEMENT_NAME"]?>">
                <h3 class="product-card__title product-card__title_vi"><?=$arResult["PRODUCT"]["CATALOG_PRODUCT_IBLOCK_ELEMENT_NAME"]?></h3>
            </div>


            <?if($arResult['PROPERTIES']["DIAMETR"]["VALUE"] && $arResult['PROPERTIES']["DLINA"]["VALUE"]):?>
                <div class="product-card__content">
                    <div class="product-card__block-size">
                        <p class="product-card__size">Размер (мм): <span class="product-card__state"><?=$arResult['PROPERTIES']["DIAMETR"]["VALUE"]?>x<?=$arResult['PROPERTIES']["DLINA"]["VALUE"]?></span></p>
                    </div>
                </div>
            <?endif?>



            <div class="product-card__footer product-card__footer_vi">
                <p class="product-card__price-block product-card__price-block_vi">Цена (с НДС): <span class="product-card__price product-card__price_vi"><?=$arResult['PRODUCT']['PRICE']['PRICE']?> ₽</span></p>
                <?if($arResult['PRODUCT']['PRICE']['PRICE_FOR_ONE'])
                {?>
                    <p class="product-card__price-block product-card__price-block_vi">Цена за штуку: <span class="product-card__price product-card__price_vi"><?=$arResult['PRODUCT']['PRICE']['PRICE_FOR_ONE']?> ₽</span></p>
                <?}?>

            </div>

        </div>

    </div>


    <script id="push">
        <?foreach($arResult["ITEMS"] AS $key=>$item):?>
            shop.push({id: <?=$item["ID"]?>, balloon: true, lat: <?=$item["PROP"]["LAT"]["VALUE"]?>, lon: <?=$item["PROP"]["LON"]["VALUE"]?>, color: '<?if($item["PROP"]["COLOR"]["VALUE"]):?><div class="label" style="background: <?=$item["PROP"]["COLOR"]["VALUE"]?>;"></div><?endif?>', name: '<?=$item["PROP"]["TYPE"]["VALUE"]?>', address: '<?=htmlspecialchars_decode($item["PROP"]["ADDRESS"]["VALUE"])?>', text: '<?=$item["PREVIEW_TEXT"] ? "<div class=\'type\'>".$item["PROP"]["TYPE"]["VALUE"]."</div><span class=\'preview\'>Режим работы: ".preg_replace("/[^A-zА-я0-9\,:\-\<\> ]+/u", "", $item["PREVIEW_TEXT"]) : ""?></span><div class="line-btn"><a href="/addresses/?ID=<?=$item["ID"]?>" class="blue-btn">Перейти к магазину</a></div>'});
        <?endforeach?>
    </script>


    <div class="shops-list" data-selector="shops-list">
        <div class="head">
            <div class="title-block" data-selector="shops-list-head">
                <p class="city-title" data-behavior="shop-city-title"><?=$arResult["SECTION"]["NAME"] ? $arResult["SECTION"]["NAME"] : "Москва и Московская область";?></p>
            </div>
        </div>


        <div class="list scroll-bold" data-behavior="shops-list-response">
            <div class="scroll-wrap">
                <div class="scroll-content">
            <?php
            foreach($arResult["ITEMS"] AS $key=>$item)
            {?>
                <div class="shop-card" data-behavior="open-shop-detail" data-shop="<?=$item['ID']?>">
                    <div class="shop-address">
                        <div class="metro-dot -noMetro"></div>
                            <a class="shop-address__href" href="/addresses/?ID=<?=$item["ID"]?>"><span class="address"><?=htmlspecialchars_decode($item["PROP"]["ADDRESS"]["VALUE"])?></p></span>
                    </div>
                    <div class="body">
                    <?if($item['PROP']['SKLAD_ID']['VALUE'])
                    {
                        if($item['AMOUNT'])
                        {?>
                            <div class="alerts">
                                <p class="item -success">В магазине <?=$item["AMOUNT"]?> шт., забирайте сегодня</p>
                            </div>
                        <?
                        }else{
                        ?>
                            <div class="alerts">
                                <p class="item -warning">В магазине 0 шт. По предзаказу на завтра</p>
                            </div>
                        <?
                        }
                    }else{
                    ?>
                        <div class="alerts">
                            <p class="item -warning">Пункт выдачи. По предзаказу на завтра</p>
                        </div>
                    <?
                    }
                    ?>

                        <div class="schedule">
                            <div>
                                <span class="text -thin">Режим работы: <?=preg_replace("/[^A-zА-я0-9\,:\-\<\> ]+/u", "", $item["PREVIEW_TEXT"])?></span>
                            </div>
                        </div>
                    </div>
                </div><?php

            }?>

                </div>
            </div>
    <div class="scroll-bar enabled" style="height: calc(2.07403% - 0px); top: calc(0% + 0px);"></div><div class="scroll-under-bar enabled"></div>

        </div>
    </div>


</div>


