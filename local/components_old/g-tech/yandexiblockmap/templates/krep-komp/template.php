<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<!--<pre><?print_r($arParams)?></pre> -->
<?if($arParams["INCLUDE_FANCYBOX"] == "Y"){?>
<?/*<script src="http://code.jquery.com/jquery-latest.js"></script>*/?>
<script type="text/javascript" src="<?=$templateFolder?>/jquery/fancybox/jquery.fancybox-1.3.1.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?=$templateFolder?>/jquery/fancybox/jquery.fancybox-1.3.1.css" />
<!--[if IE]>
<style type="text/css">
	#fancybox-loading.fancybox-ie div	{ background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=$templateFolder?>/jquery/fancybox/fancy_loading.png', sizingMethod='scale'); }
	.fancybox-ie #fancybox-close		{ background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=$templateFolder?>/jquery/fancybox/fancy_close.png', sizingMethod='scale'); }
	.fancybox-ie #fancybox-title-over	{ background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=$templateFolder?>/jquery/fancybox/fancy_title_over.png', sizingMethod='scale'); zoom: 1; }
	.fancybox-ie #fancybox-title-left	{ background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=$templateFolder?>/jquery/fancybox/fancy_title_left.png', sizingMethod='scale'); }
	.fancybox-ie #fancybox-title-main	{ background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=$templateFolder?>/jquery/fancybox/fancy_title_main.png', sizingMethod='scale'); }
	.fancybox-ie #fancybox-title-right	{ background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=$templateFolder?>/jquery/fancybox/fancy_title_right.png', sizingMethod='scale'); }
	.fancybox-ie #fancybox-left-ico		{ background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=$templateFolder?>/jquery/fancybox/fancy_nav_left.png', sizingMethod='scale'); }
	.fancybox-ie #fancybox-right-ico	{ background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=$templateFolder?>/jquery/fancybox/fancy_nav_right.png', sizingMethod='scale'); }
	.fancybox-ie .fancy-bg { background: transparent !important; }
	.fancybox-ie #fancy-bg-n	{ filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=$templateFolder?>/jquery/fancybox/fancy_shadow_n.png', sizingMethod='scale'); }
	.fancybox-ie #fancy-bg-ne	{ filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=$templateFolder?>/jquery/fancybox/fancy_shadow_ne.png', sizingMethod='scale'); }
	.fancybox-ie #fancy-bg-e	{ filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=$templateFolder?>/jquery/fancybox/fancy_shadow_e.png', sizingMethod='scale'); }
	.fancybox-ie #fancy-bg-se	{ filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=$templateFolder?>/jquery/fancybox/fancy_shadow_se.png', sizingMethod='scale'); }
	.fancybox-ie #fancy-bg-s	{ filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=$templateFolder?>/jquery/fancybox/fancy_shadow_s.png', sizingMethod='scale'); }
	.fancybox-ie #fancy-bg-sw	{ filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=$templateFolder?>/jquery/fancybox/fancy_shadow_sw.png', sizingMethod='scale'); }
	.fancybox-ie #fancy-bg-w	{ filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=$templateFolder?>/jquery/fancybox/fancy_shadow_w.png', sizingMethod='scale'); }
	.fancybox-ie #fancy-bg-nw	{ filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=$templateFolder?>/jquery/fancybox/fancy_shadow_nw.png', sizingMethod='scale'); }
</style>
<![endif]-->
<?}?>
<!--[if lt IE 7]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>
<![endif]-->
<!--[if lt IE 8]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
<![endif]-->
<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->
<?if(true):?>

    <div class="map-iblock-tittle"><?=$arResult['NAME']?></div>
    <div id="YMAP_<?=$arParams['MAP_ID']?>" class="g-tech-yandex-map" style="float:left;height: <?echo $arParams['MAP_HEIGHT'];?>px; width: <?echo $arParams['MAP_WIDTH']?>px; margin-right: 20px;"><?echo GetMessage('MYS_LOADING'.($arParams['WAIT_FOR_EVENT'] ? '_WAIT' : ''));?></div>
<?elseif($arParams["KEY"]!=""):?>
    <script src="http://api-maps.yandex.ru/1.1/index.xml?key=<?=$arParams['KEY']?>&modules=plainstyle"
	type="text/javascript"></script>
    <div class="map-iblock-tittle"><?=$arResult['NAME']?></div>
    <div id="YMAP_<?=$arParams['MAP_ID']?>" class="g-tech-yandex-map" style="float:left;height: <?echo $arParams['MAP_HEIGHT'];?>px; width: <?echo $arParams['MAP_WIDTH']?>px; margin-right: 20px;"><?echo GetMessage('MYS_LOADING'.($arParams['WAIT_FOR_EVENT'] ? '_WAIT' : ''));?></div>
<?else:?>
    <?ShowError(GetMessage("NO_KEY_TITLE"));?>
<?endif;?>
<script>
$(document).ready(function(){
    $('a.pic').fancybox({
		'transitionIn': 'elastic',
		'transitionOut': 'elastic',
		'speedIn': 600,
		'speedOut': 400,
		'overlayShow': false,
		'cyclic' : true,
		'padding': 20,
		'titlePosition': 'over',
		'onComplete': function() {
			$("#fancybox-title").css({ 'top': '100%', 'bottom': 'auto' });
		}
	});
});
</script>


<?global $mapId;
$mapId = $arParams['MAP_ID'];
$APPLICATION->AddHeadScript($this->GetFolder()."/js/map.js" );
?>
<script>

var arMarks = new Array();
var arItems = new Array();

YMaps.jQuery(function (){
    map_<?=$arParams['MAP_ID']?> = new YMaps.Map(YMaps.jQuery("#YMAP_<?=$arParams['MAP_ID']?>"));
    map_<?=$arParams['MAP_ID']?>.setCenter(new YMaps.GeoPoint(30.35, 59.90), 11);
    <?
    foreach($arResult['ALL_MAP_OPTIONS'] as $option => $method){
	    if (in_array($option, $arParams['OPTIONS'])):?>
        	map_<?=$arParams['MAP_ID']?>.enable<?echo $method?>();
        <?else:?>
	        map_<?=$arParams['MAP_ID']?>.disable<?echo $method?>();
        <?endif;
    }
    foreach($arResult['ALL_MAP_CONTROLS'] as $control => $method){
	    if (in_array($control, $arParams['CONTROLS'])):
            if($control == "TOOLBAR"):?>
                var toolbar = new YMaps.ToolBar();

            // Создание кнопки-флажка
            var button = new YMaps.ToolBarToggleButton({
                icon: "<?=$templateFolder?>/images/icon-fullscreen.png",
                hint: "<?=GetMessage('UNROLL_KEY_TITLE')?>"
            });

            // Если кнопка активна, то карта разворачивается во весь экран
            YMaps.Events.observe(button, button.Events.Select, function () {
                setSize(0,0,true);
            });

            // Если кнопка неактивна, то карта принимает фиксированный размер
            YMaps.Events.observe(button, button.Events.Deselect, function () {
                setSize(<?=$arParams['MAP_WIDTH']?>, <?=$arParams['MAP_HEIGHT']?>,false);
            });

            // Функция устанавливает новые размеры для карты
            function setSize (newWidth, newHeight, full) {
                if(full){
                    YMaps.jQuery("#YMAP_<?=$arParams['MAP_ID']?>").css("width","");
                    YMaps.jQuery("#YMAP_<?=$arParams['MAP_ID']?>").css("height","");
                    YMaps.jQuery("#YMAP_<?=$arParams['MAP_ID']?>").css("position","fixed");
                    YMaps.jQuery("#YMAP_<?=$arParams['MAP_ID']?>").css("left",0);
                    YMaps.jQuery("#YMAP_<?=$arParams['MAP_ID']?>").css("top",0);
                    YMaps.jQuery("#YMAP_<?=$arParams['MAP_ID']?>").css("z-index",1000);
                }else{
                    YMaps.jQuery("#YMAP_<?=$arParams['MAP_ID']?>").css("width",newWidth);
                    YMaps.jQuery("#YMAP_<?=$arParams['MAP_ID']?>").css("height",newHeight);
                    YMaps.jQuery("#YMAP_<?=$arParams['MAP_ID']?>").css("position","relative");
                    YMaps.jQuery("#YMAP_<?=$arParams['MAP_ID']?>").css("z-index",500);
                }

                map_<?=$arParams['MAP_ID']?>.redraw();
            }

            // Добавление кнопки на панель инструментов
            toolbar.add(button);

            // Добавление панели инструментов на карту
            map_<?=$arParams['MAP_ID']?>.addControl(toolbar);
            <?else:?>
        	    map_<?=$arParams['MAP_ID']?>.addControl(new YMaps.<?echo $method?>());
            <?endif;?>
        <?endif;
    }?>
    <?
    $count = 0;
    foreach($arResult["PLACEMARKS"] as $key => $placemark):?>
        // Создание шаблона для содержимого балуна
        var templateStr = "<div id=\"boloonInfo\">$[title]<div style=\"clear:both;border-top:1px dotted #ccc;margin:5px 0;\"></div>";
        <?if($arParams['DIPLAY_PREVIEW_PICTURE']=="Y" && is_array($placemark['PREVIEW_PICTURE'])):?>
            templateStr += "<img src=$[imgSrc] style=\"float: left; margin-right: 10px;\">";
        <?endif;?>
        templateStr += "$[content]<br>"
        <?if($arParams['DIPLAY_PREVIEW_PICTURE']=="Y" && is_array($placemark['PREVIEW_PICTURE'])):?>
            templateStr += "<div style=\"clear: both; height: 10px; width: 100%;\"></div>";
        <?endif;?>
        templateStr += "<div style=\"float: right;\">";
        <?if($placemark['PLAN']!=""):?>
            templateStr += "<a id=\"pic\" onclick=\"$.fancybox(this);return false;\" href=\"$[imgUrl]\" target=\"blank\"><?=GetMessage('PLAN_URL_TITLE')?></a>&nbsp;";
        <?endif;?>
        templateStr += "<a href=\"$[detailUrl]\"><?=GetMessage('DETAIL_URL_TITLE')?></a></div></div>";
        //Создане стиля метки
        <?if($arParams['TEMPLATE_EDIT']):?>
            var s_<?=$key?> = new YMaps.Style("<?=$arParams['TEMPLATE_EDIT']?>");
        <?else:?>
            var s_<?=$key?> = new YMaps.Style();
        <?endif;?>
        <?if($arParams['PLACEICON']):?>
            s_<?=$key?>.iconStyle = new YMaps.IconStyle();
            s_<?=$key?>.iconStyle.href = "<?=$arParams['PLACEICON']?>";
            <?
            $imageInfo = getimagesize($_SERVER['DOCUMENT_ROOT'].$arParams['PLACEICON']);
            list($width, $height) = $imageInfo;
            ?>
            s_<?=$key?>.iconStyle.size = new YMaps.Point(<?=$width?>, <?=$height?>);
            s_<?=$key?>.iconStyle.offset = new YMaps.Point(-<?=($width/2)?>, -<?=($height/2)?>);
        <?else:?>
            <?if($arParams["MARK_PROP_ID"] && $placemark["ICON_TITLE"]!=""):?>
                s_<?=$key?>.iconContentStyle = new YMaps.IconContentStyle(new YMaps.Template("<?=$placemark['ICON_TITLE']?>"));
            <?else:?>
                s_<?=$key?>.iconContentStyle = new YMaps.IconContentStyle(new YMaps.Template("<?=$placemark['NAME']?>"));
            <?endif;?>
            //s_<?=$key?>.iconContentStyle = new YMaps.IconContentStyle(new YMaps.Template("<div>метка</div>"));
        <?endif;?>
        s_<?=$key?>.balloonContentStyle = new YMaps.BalloonContentStyle(new YMaps.Template(templateStr));
        <?
        $fullImg = CFile::GetPath($placemark['PLAN']);
        if(strlen($placemark['PREVIEW_TEXT'])>0){
            $prev = mysqli_escape_string($placemark['PREVIEW_TEXT']);
        }?>

        <?if($placemark["MAP_LON"] && $placemark["MAP_LAT"]):?>
          var point = new YMaps.GeoPoint(<?=$placemark["MAP_LON"]?>, <?=$placemark["MAP_LAT"]?>);
          var placemark<?=$count?> = new YMaps.Placemark(point, {style: s_<?=$key?>, hasHint: 1});
                <?if($placemark['PLAN']!=""):?>
                    placemark<?=$count?>.imgUrl="<?=$fullImg?>";
                <?endif;?>
                placemark<?=$count?>.detailUrl="<?=$placemark['DETAIL_PAGE_URL']?>";
                placemark<?=$count?>.title="<?=$placemark['ADDRESS']?>";
                <?if($arParams['DIPLAY_PREVIEW_PICTURE'] == "Y" && is_array($placemark['PREVIEW_PICTURE'])):?>
                    <?$img = CFile::ResizeImageGet($placemark['PREVIEW_PICTURE']["ID"],array("width"=>180,"height"=>180),BX_RESIZE_IMAGE_PROPORTIONAL,true);?>
                    placemark<?=$count?>.imgSrc="<?=$img['src']?>";
                <?endif;?>
                placemark<?=$count?>.content="<?=$prev?>";
                placemark<?=$count?>.name="<?=$placemark['NAME']?>";
                arMarks.push(placemark<?=$count?>);
                arItems.push("<?=$placemark["ID"]?>");
                map_<?=$arParams['MAP_ID']?>.addOverlay(placemark<?=$count?>);
                map_<?=$arParams['MAP_ID']?>.setCenter(point);
        <?else:?>
          var geocoder = new YMaps.Geocoder("<?=$placemark['ADDRESS']?>");
          YMaps.Events.observe(geocoder, geocoder.Events.Load, function () {
          // Если объект был найден, то добавляем его на карту
          // и центрируем карту по области обзора найденного объекта
            if (this.length()) {
                geoResult = this.get(0);
                var point = geoResult.getCoordPoint();
                var placemark<?=$count?> = new YMaps.Placemark(point, {style: s_<?=$key?>, hasHint: 1});
                <?if($placemark['PLAN']!=""):?>
                    placemark<?=$count?>.imgUrl="<?=$fullImg?>";
                <?endif;?>
                placemark<?=$count?>.detailUrl="<?=$placemark['DETAIL_PAGE_URL']?>";
                placemark<?=$count?>.title="<?=$placemark['ADDRESS']?>";
                <?if($arParams['DIPLAY_PREVIEW_PICTURE'] == "Y" && is_array($placemark['PREVIEW_PICTURE'])):?>
                    <?$img = CFile::ResizeImageGet($placemark['PREVIEW_PICTURE']["ID"],array("width"=>180,"height"=>180),BX_RESIZE_IMAGE_PROPORTIONAL,true);?>
                    placemark<?=$count?>.imgSrc="<?=$img['src']?>";
                <?endif;?>
                placemark<?=$count?>.content="<?=$prev?>";
                placemark<?=$count?>.name="<?=$placemark['NAME']?>";
                arMarks.push(placemark<?=$count?>);
                arItems.push("<?=$placemark["ID"]?>");
                map_<?=$arParams['MAP_ID']?>.addOverlay(placemark<?=$count?>);
                map_<?=$arParams['MAP_ID']?>.setCenter(point);
            }else {
            }
          });
        <?endif;?>
    <?$count++;
    endforeach;?>
});

function showAddress_<?=$arParams['MAP_ID']?> (value) {
            var index;
            for(var i=0; i<arItems.length; i++) {
                if(arItems[i]==value){
                    index = i;
                    break;
                }
            }
            map_<?=$arParams['MAP_ID']?>.panTo(arMarks[index].getCoordPoint());
            arMarks[index].openBalloon();
        }
</script>

<?if($arParams['DISPLAY_ITEM_LIST'] == "Y"):?>
<div style="clear: both; width:100%"></div>
<!--Выводим список объектов   -->
<div class="map-item-list">
<table width="100%" cellspacing="10" cellpadding="0" border="0"><tr>
<?$count = 0;?>
<?$COL_COUNT = $arParams["ITEM_LIST_ROW_COUNT"]?>
<?foreach($arResult["PLACEMARKS"] as $arItem):?>
	<td width="33%" class="map-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>" valign="bottom">
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<?echo $arItem["NAME"]?><br />
			<?else:?>
				<?echo $arItem["NAME"]?><br />
			<?endif;?>
		<?endif;?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<?echo $arItem["PREVIEW_TEXT"];?>
		<?endif;?>
<br>
<?if($arItem["ADDRESS"]):?>
            <a href="javascript:showAddress_<?=$arParams["MAP_ID"]?>('<?=$arItem["ID"]?>');"><?=GetMessage("SHOW_ON_MAP")?></a>
        <?endif;?>

    </td>
    <?$count++;?>
    <?if($count == $COL_COUNT){?>
        </tr><tr>
        <?$count = 0;
    }?>
<?endforeach;?>
</tr></table>
</div>
<?endif;?>





<style>
#YMAP_<?=$arParams['MAP_ID']?>{
  width: 100%;
  height: 100%;
}
div#boloonInfo{
  max-width: <?=($arParams['MAP_WIDTH']-100)?>px;
  width: expression((w = (document.getElementByID("#boloonInfo").width)) > <?=($arParams['MAP_WIDTH'])?> ? '<?=($arParams['MAP_WIDTH']-100)?>px' : w);
}
.baloonContent{
  width: 50px;height: 50px; background: #ccc; float: left;
}
</style>