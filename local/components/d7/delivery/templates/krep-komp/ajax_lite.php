<?php
global $APPLICATION;
$templateFolder = "/local/components/d7/delivery/templates/krep-komp";


?>


<link href="<?=$templateFolder?>/style.css" type="text/css" rel="stylesheet" />
<link href="/delivery/style.css" type="text/css" rel="stylesheet" />




<script id="api-map-delivery">

 <?require($_SERVER["DOCUMENT_ROOT"]."/delivery/get_areas.php");?>

<?=$arResult["ITEMS"][0]["PROP"]["MAP"]["VALUE"]?>();

<?require($_SERVER["DOCUMENT_ROOT"]."/delivery/map.js");?>	

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