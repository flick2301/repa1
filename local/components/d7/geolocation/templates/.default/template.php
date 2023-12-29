<?php
global $APPLICATION;
global $USER;        
?>

<?
use Bitrix\Main\Application;
use Bitrix\Main\Loader;

if (Loader::includeModule('rover.geoip')){
    
$request = Application::getInstance()->getContext()->getRequest();
$name = $request->getCookie("geo_text");


         $ip = \Rover\GeoIp\Location::getCurIp();
         $location = \Rover\GeoIp\Location::getInstance($ip);
		 //НУЖНО ПРОВЕРИТЬ НЕОБХОДИМ ЛИ ЭТОТ ЗАПРОС НА ОПРЕДЕЛЕНИЕ ГОРОДА ПО IP АВТОМАТОМ. ВИДИМО СЕРВИСЫ ОШИБАЛИСЬ
		 //$cityName = $location->getCityName();
		//$loc_reg=$location->getRegionName();
	   
      
       
	   

$loc_reg_id = 0;

foreach($arResult["ITEMS"] AS $item) {
		if($loc_reg==$item["NAME"]) {
        $loc_reg = $item["PROP"]["NAME"]["VALUE"];
		$loc_reg_id = $item["ID"];
        break;	
		}
}	
       ?>
	   <div class="geolocation"><a href='javascript:void(0);'  class="geolocation_link"></a></div>
        <div data-data='<?=$name?>' id="geolocation">
            
            
           
            <div class="geo">
			<div class="box-modal__head">
			
			<?if($_COOKIE['geo_id'] && count($arResult["ITEMS"][$_COOKIE['geo_id']])):?>
                <div class="box-modal__title">Ваш город - <?=$arResult["ITEMS"][$_COOKIE['geo_id']]["PROP"]["FULL_NAME"]["VALUE"] ? $arResult["ITEMS"][$_COOKIE['geo_id']]["PROP"]["FULL_NAME"]["VALUE"] : $arResult["ITEMS"][$_COOKIE['geo_id']]["NAME"]?></div>
			<?else:?>	
				<div class="box-modal__title">Выберите регион:</div>
			<?endif?>	
            	<div class="popUp-close"></div>
            </div>
			
			<div class="search_geoitem">
			<input id="input_geoitem" type="text">
			<input id="global-geoitem-search" name="text" type="text" value="" class="global-geosearch__submit" placeholder="" autocomplete="off">
			
			<ul id="result_geo_items">
			</ul>
			
			</div>
			
			<div class="geo_items">
				<ul>
                    
					
<?foreach($arResult["ITEMS"] AS $item):?>
<?if($i >= ceil(count($arResult["ITEMS"])/4)) {$i = 0; echo "</ul><ul>";}?>
<?if($item["PROP"]["VISIBLE"]["VALUE"]):?><?$i++?><li class="<?if($item["SORT"] < 500 || $item["PROP"]['HAVE_STORES']["VALUE"]):?>master<?endif?>" rel='<?=$item["PROP"]["NAME"]["VALUE"] ? $item["PROP"]["NAME"]["VALUE"] : $item["NAME"]?>'  data-value='<?=$item["ID"]?>' data-domain='<?=$item["PROP"]["DOMAIN"]["VALUE"]?>'><?=$item["NAME"]?><?if($item["PROP"]["REGION"]["VALUE"] && false):?><span><?=$item["PROP"]["REGION"]["VALUE"]?></span><?endif?>(<?=$item['SHOPS_COUNT']?>)</li><?endif?>
<?endforeach?>
			
                        <!--1<li data-value='0' data-domain='krep-komp.ru'>Другой регион</li>-->
                    
                </ul>
				</div> 
            </div> 
		</div>
		
		
		
		
		
		
		
	
	<script>
    
    $(document).ready(function(){
		
		$('.geolocation .geolocation_link').show();
        
        var getlocation = '<?=$loc_reg?>';
		var id_get = '<?=htmlspecialchars($_GET['ID'])?>';
		var access = '<?=htmlspecialchars($_GET['access'])?>';
		
		
        
		if(id_get!='' && access!=''){
			//console.log(access);
			
		}
		else if($.cookie('geo_id')==null)
		{
<?foreach($arResult["ITEMS"] AS $item):?>
<?if($item["ID"]!=GEOLOCATION_MOSCOW || true):?>
			if((location.origin=='https://<?=$item["PROP"]["DOMAIN"]["VALUE"]?>' || location.origin=='http://<?=$item["PROP"]["DOMAIN"]["VALUE"]?>'))
			{
				$.cookie("geo_text", '<?=$item["PROP"]["NAME"]["VALUE"] ? $item["PROP"]["NAME"]["VALUE"] : $item["NAME"]?>',{expires:365, path:'/', domain:'<?=$item["PROP"]["DOMAIN"]["VALUE"]?>'});
				$('#geolocation').slideToggle(0);
				$("#geolocation [data-value='<?=$item["ID"]?>']").addClass("selected-city");
				$.cookie('geo_id', '<?=$item["ID"]?>',{expires:365, path:'/', domain:'<?=$item["PROP"]["DOMAIN"]["VALUE"]?>'});
				$.cookie("geo_text", '<?=$item["PROP"]["NAME"]["VALUE"] ? $item["PROP"]["NAME"]["VALUE"] : $item["NAME"]?>',{expires:365, path:'/', domain:'<?=$item["PROP"]["DOMAIN"]["VALUE"]?>'});
				getlocation='<?=$item["PROP"]["NAME"]["VALUE"] ? $item["PROP"]["NAME"]["VALUE"] : $item["NAME"]?>';
				<?=$select = true;?>	
			}
<?endif?>			
<?endforeach?>		
<?if(!$select):?>
				$("#geolocation [data-value='<?=GEOLOCATION_MOSCOW?>']").addClass("selected-city");
<?endif?>		
			
		} else
		{
<?foreach($arResult["ITEMS"] AS $item):?>
<?if($item["ID"]!=GEOLOCATION_MOSCOW):?>
			if((location.origin=='https://<?=$item["PROP"]["DOMAIN"]["VALUE"]?>' || location.origin=='http://<?=$item["PROP"]["DOMAIN"]["VALUE"]?>') && $.cookie('geo_id')!='<?=$item["ID"]?>') {
				$.cookie("geo_text", null);
				$.cookie("geo_id", null);
				$("#geolocation [data-value='<?=$item["ID"]?>']").addClass("selected-city");
				$.cookie("geo_text", '<?=$item["PROP"]["NAME"]["VALUE"] ? $item["PROP"]["NAME"]["VALUE"] : $item["NAME"]?>',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
				$.cookie("geo_id", '<?=$item["ID"]?>',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
			}
<?endif?>
<?endforeach?>				
		}
			
			
		if(document.location.pathname!='/detail_order/' && location.origin!='https://new.krep-komp.ru')
		{
			if(location.origin=='https://krep-komp.ru' &&  !(id_get!='' && access!=''))
			{
				
<?foreach($arResult["ITEMS"] AS $item):?>
		
				if(($.cookie('geo_id')=='<?=$item["ID"]?>') && $.cookie('geo_id')!='<?=GEOLOCATION_MOSCOW?>') {
					
					//$.cookie("geo_id", '<?=GEOLOCATION_MOSCOW?>');
					window.location.href = 'https://<?=$item["PROP"]["DOMAIN"]["VALUE"]?>' + location.pathname;
				}
<?endforeach?>		
					
			}
			
		}
		
		
        if($.cookie("geo_id")){
            $('.geolocation_link').text($.cookie("geo_text"));
            $("#geolocation option[value='"+$.cookie("geo_id")+"']").attr("selected", "selected");
        }else{
			if(getlocation){
				$('.geolocation_link').text(getlocation);
			}else{
				$('.geolocation_link').text('Москва и МО');
			}		  
        }
		
    });
	
url = '<?=$this->GetFolder()?>/ajax.php';	
iblock_id = '<?=$arParams["IBLOCK_ID"]?>';
</script>

<?
}
?>