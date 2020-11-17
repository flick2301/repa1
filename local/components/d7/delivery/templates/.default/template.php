               <!--content-tabs-->
               <div class="simple-article__tabs content-tabs">
                  <ul class="content-tabs__list" data-delivery-tabs>
				  
			  
<?foreach($arResult["ITEMS"] AS $key=>$item):?>
                     <li class="content-tabs__item">
                        <a class="content-tabs__toggle" href="#<?=$item["CODE"]?>"<?if($key==0):?> data-tabby-default<?endif?>><?=$item["NAME"]?></a>
                     </li>
<?endforeach?>

                  </ul>
               </div>
               <!--content-tabs-->
			   
			   
<?foreach($arResult["ITEMS"] AS $key=>$item):?>			   
			                  <div class="simple-article__content" id="<?=$item["CODE"]?>">
                  <div class="simple-article__section wysiwyg-block">
				  
<?if($item["PROP"]["MAP"]["VALUE"]):?><script>document.addEventListener("DOMContentLoaded", <?=$item["PROP"]["MAP"]["VALUE"]?>);</script><?endif?>

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

<?if($item["PROP"]["MAP"]["VALUE"]):?><div id="<?=str_replace("ready", "map", $item["PROP"]["MAP"]["VALUE"])?>" style="height: 500px;" class="external"></div><?endif?>

                  </div>
               </div>
<?endforeach?>			   