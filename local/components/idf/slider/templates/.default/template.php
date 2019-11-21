<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	// PR($arResult);
?>
    <link rel="stylesheet" href="<?=$this->GetFolder()?>/nivo-slider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?=$this->GetFolder()?>/style.css" type="text/css" media="screen" />
	
<div id="slider-wrapper" style="height: 246px;">
	<div id="slider" class="nivoSlider">
	<? foreach($arResult["ITEMS"] as $arItem){?>

<?if($arItem["PROPERTIES"]["SLIDER_LINK"]["VALUE"]):?>
	<a href="<?=$arItem["PROPERTIES"]["SLIDER_LINK"]["VALUE"]?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["src"]?>" alt="" title="<?=$arItem["PREVIEW_TEXT"]?>" /></a>
<?else:?>
	<img src="<?=$arItem["PREVIEW_PICTURE"]["src"]?>" alt="" title="<?=$arItem["PREVIEW_TEXT"]?>" />
<?endif?>		
		
	<?}?>
	</div>
<!-- default title -->
<div id="htmlcaption" class="nivo-html-caption">
	<span><?=$arResult["text_title"]?></span>
</div>

</div>


<script type="text/javascript" src="<?=$this->GetFolder()?>/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#slider').nivoSlider({
		  effect: '<?=$arResult["effect"]?>', // Specify sets like: 'boxRainGrow, fold,fade,sliceDown'
		  slices: <?=$arResult["slices"]?>, // For slice animations
		  // boxCols: 4, // For box animations
		  // boxRows: 4, // For box animations
		  animSpeed: <?=$arResult["animSpeed"]?>, // Slide transition speed
		  pauseTime: <?=$arResult["pauseTime"]?>, // How long each slide will show
		  startSlide: <?=$arResult["startSlide"]?>, // Set starting Slide (0 index)
		  directionNav: <? if($arResult["directionNav"] == "Y"){?>true<?}else{?>false<?}?>, // Next & Prev navigation
		  controlNav: <? if($arResult["controlNav"] == "Y"){?>true<?}else{?>false<?}?>, // 1,2,3... navigation
		  // controlNavThumbs: false, // Use thumbnails for Control Nav
		  pauseOnHover: <? if($arResult["pauseOnHover"] == "Y"){?>true<?}else{?>false<?}?>, // Stop animation while hovering
		  manualAdvance: false, // Force manual transitions
		  // prevText: 'Prev1', // Prev directionNav text
		  // nextText: 'Next2', // Next directionNav text
		  // randomStart: false, // Start on a random slide
		  // beforeChange: function(){}, // Triggers before a slide transition
		  // afterChange: function(){}, // Triggers after a slide transition
		  // slideshowEnd: function(){}, // Triggers after all slides have been shown
		  // lastSlide: function(){}, // Triggers when last slide is shown
		  // afterLoad: function(){} // Triggers when slider has loaded
	});
});
</script>