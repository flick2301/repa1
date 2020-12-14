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
		 $cityName = $location->getCityName();
       
	   
      
       $loc_reg=$location->getRegionName();
	   
	  /* ?><script>console.log('<?var_dump($loc_reg);?>');</script><? */
       if($loc_reg=='Москва'):
            $loc_reg='Москва и МО';
            $loc_reg_id='1';
       elseif($loc_reg=='Санкт-Петербург'):
            $loc_reg='Санкт-Петербург и ЛО';
            $loc_reg_id='2';
       elseif($loc_reg=='Казань'):
            $loc_reg='Казань';
            $loc_reg_id='3';
		elseif($loc_reg=='Нижний Новгород'):
            $loc_reg='Нижний Новгород';
            $loc_reg_id='4';
		elseif($loc_reg=='Воронеж' || $_SERVER['HTTP_HOST']=='voronezh.krep-komp.ru'):
            $loc_reg='Воронеж';
            $loc_reg_id='5';
		elseif($loc_reg=='Владимир'):
            $loc_reg='Владимир';
            $loc_reg_id='6';
		elseif($loc_reg=='Волгоград'):
            $loc_reg='Волгоград';
            $loc_reg_id='7';
		elseif($loc_reg=='Калуга'):
            $loc_reg='Калуга';
            $loc_reg_id='8';
		elseif($loc_reg=='Краснодар'):
            $loc_reg='Краснодар';
            $loc_reg_id='9';
		elseif($loc_reg=='Пенза'):
            $loc_reg='Пенза';
            $loc_reg_id='10';
		elseif($loc_reg=='Пермь'):
            $loc_reg='Пермь';
            $loc_reg_id='11';
		elseif($loc_reg=='Самара'):
            $loc_reg='Самара';
            $loc_reg_id='12';
		elseif($loc_reg=='Саратов'):
            $loc_reg='Саратов';
            $loc_reg_id='13';
		elseif($loc_reg=='Тверь'):
            $loc_reg='Тверь';
            $loc_reg_id='14';
		elseif($loc_reg=='Тула'):
            $loc_reg='Тула';
            $loc_reg_id='15';
		elseif($loc_reg=='Ростов-на-Дону'):
            $loc_reg='Ростов-на-Дону';
            $loc_reg_id='16';
		elseif($loc_reg=='Рязань'):
            $loc_reg='Рязань';
            $loc_reg_id='17';
		elseif($loc_reg=='Ярославль'):
            $loc_reg='Ярославль';
            $loc_reg_id='18';
		elseif($loc_reg=='Смоленск'):
            $loc_reg='Смоленск';
            $loc_reg_id='19';
		elseif($loc_reg=='Екатеринбург'):
            $loc_reg='Екатеринбург';
            $loc_reg_id='20';
       else:
            $loc_reg_id='21';
       endif;
       
       if(1){
       ?>
	   <div class="geolocation<?if(SITE_TEMPLATE_ID=='moskrep'):?> moskrep<?endif?>"><a href='javascript:void(0);'  class="geolocation_link"></a></div>
        <div data-data='<?=$name?>' id="geolocation">
            
            
           
            <div class="geo">
			<div class="box-modal__head">
                <div class="box-modal__title">Ваш регион:</div>
            	<div class="popUp-close"></div>
            </div>
				<ul>
                    
                        <li data-value='1' data-domain='krep-komp.ru'>Москва и МО</li>
                        <li data-value='2' data-domain='spb.krep-komp.ru'>Санкт-Петербург и ЛО</li>
						
								
						
						<li data-value='6' data-domain='vladimir.krep-komp.ru'>Владимир</li>
						<li data-value='7' data-domain='volgograd.krep-komp.ru'>Волгоград</li>
						<li data-value='5' data-domain='voronezh.krep-komp.ru'>Воронеж</li>
						<li data-value='20' data-domain='ekaterinburg.krep-komp.ru'>Екатеринбург</li>
						<li data-value='3' data-domain='kazan.krep-komp.ru'>Казань</li>
						<li data-value='8' data-domain='kaluga.krep-komp.ru'>Калуга</li>
						<li data-value='9' data-domain='krasnodar.krep-komp.ru'>Краснодар</li>
						<li data-value='4' data-domain='nizhniy-novgorod.krep-komp.ru'>Нижний Новгород</li>
						<li data-value='10' data-domain='penza.krep-komp.ru'>Пенза</li>
						<li data-value='11' data-domain='perm.krep-komp.ru'>Пермь</li>
						<li data-value='16' data-domain='rostov-na-donu.krep-komp.ru'>Ростов-на-Дону</li>
						<li data-value='17' data-domain='ryazan.krep-komp.ru'>Рязань</li>
						<li data-value='12' data-domain='samara.krep-komp.ru'>Самара</li>
						<li data-value='13' data-domain='saratov.krep-komp.ru'>Саратов</li>
						<li data-value='19' data-domain='smolensk.krep-komp.ru'>Смоленск</li>
						<li data-value='14' data-domain='tver.krep-komp.ru'>Тверь</li>
						<li data-value='15' data-domain='tula.krep-komp.ru'>Тула</li>
						
						<li data-value='18' data-domain='yaroslavl.krep-komp.ru'>Ярославль</li>
						
						
						
                        <li data-value='21' data-domain='krep-komp.ru'>Другой регион</li>
                    
                </ul>
            </div>
            
		</div>
	
	<script>
    
    $(document).ready(function(){
		
		$('.geolocation .geolocation_link').show();
        
        var getlocation = '<?=$loc_reg?>';
		var id_get = '<?=$_GET['ID']?>';
		var access = '<?=$_GET['access']?>';
		
		
        
		if(id_get!='' && access!=''){
			console.log(access);
			
		}else if($.cookie('geo_id')==null)
		{
			if((location.origin=='https://spb.krep-komp.ru' || location.origin=='http://spb.krep-komp.ru'))
			{
				$.cookie("geo_text", 'Санкт-Петербург и ЛО',{expires:365, path:'/', domain:'spb.krep-komp.ru'});
				$('#geolocation').slideToggle(0);
				$("#geolocation [data-value='2']").addClass("selected-city");
				$.cookie('geo_id', '2',{expires:365, path:'/', domain:'spb.krep-komp.ru'});
				$.cookie("geo_text", 'Санкт-Петербург и ЛО',{expires:365, path:'/', domain:'krep-komp.ru'});
				getlocation='Санкт-Петербург и ЛО';
			}
			else if(location.origin=='https://kazan.krep-komp.ru')
			{
				$.cookie("geo_text", 'Казань',{expires:365, path:'/', domain:'kazan.krep-komp.ru'});
				$('#geolocation').slideToggle(0);
				$("#geolocation option[value='3']").attr("selected", "selected");
				$("#geolocation [data-value='3']").addClass("selected-city");
				$.cookie("geo_text", 'Казань',{expires:365, path:'/', domain:'krep-komp.ru'});
				getlocation='Казань';
			}
			else if(location.origin=='https://nizhniy-novgorod.krep-komp.ru')
			{
				$.cookie("geo_text", 'Нижний Новгород',{expires:365, path:'/', domain:'nizhniy-novgorod.krep-komp.ru'});
				$('#geolocation').slideToggle(0);
				$("#geolocation [data-value='4']").addClass("selected-city");
				$.cookie('geo_id', '4',{expires:365, path:'/', domain:'nizhniy-novgorod.krep-komp.ru'});
				$.cookie("geo_text", 'Нижний Новгород',{expires:365, path:'/', domain:'krep-komp.ru'});
				getlocation='Нижний Новгород';
			}
			else if(location.origin=='https://voronezh.krep-komp.ru')
			{
				$.cookie("geo_text", 'Воронеж',{expires:365, path:'/', domain:'voronezh.krep-komp.ru'});
				$('#geolocation').slideToggle(0);
				$("#geolocation [data-value='5']").addClass("selected-city");
				$.cookie('geo_id', '5',{expires:365, path:'/', domain:'voronezh.krep-komp.ru'});
				$.cookie("geo_text", 'Воронеж',{expires:365, path:'/', domain:'krep-komp.ru'});
				getlocation='Воронеж';
			}
			
			else if(location.origin=='https://vladimir.krep-komp.ru')
			{
				$.cookie("geo_text", 'Владимир',{expires:365, path:'/', domain:'vladimir.krep-komp.ru'});
				$('#geolocation').slideToggle(0);
				$("#geolocation [data-value='6']").addClass("selected-city");
				$.cookie('geo_id', '6',{expires:365, path:'/', domain:'vladimir.krep-komp.ru'});
				$.cookie("geo_text", 'Владимир',{expires:365, path:'/', domain:'krep-komp.ru'});
				getlocation='Владимир';
			}
			else if(location.origin=='https://volgograd.krep-komp.ru')
			{
				$.cookie("geo_text", 'Волгоград',{expires:365, path:'/', domain:'volgograd.krep-komp.ru'});
				$('#geolocation').slideToggle(0);
				$("#geolocation [data-value='7']").addClass("selected-city");
				$.cookie('geo_id', '7',{expires:365, path:'/', domain:'volgograd.krep-komp.ru'});
				$.cookie("geo_text", 'Волгоград',{expires:365, path:'/', domain:'krep-komp.ru'});
				getlocation='Волгоград';
			}
			else if(location.origin=='https://kaluga.krep-komp.ru')
			{
				$.cookie("geo_text", 'Калуга',{expires:365, path:'/', domain:'kaluga.krep-komp.ru'});
				$('#geolocation').slideToggle(0);
				$("#geolocation [data-value='8']").addClass("selected-city");
				$.cookie('geo_id', '8',{expires:365, path:'/', domain:'kaluga.krep-komp.ru'});
				$.cookie("geo_text", 'Калуга',{expires:365, path:'/', domain:'krep-komp.ru'});
				getlocation='Калуга';
			}
			else if(location.origin=='https://krasnodar.krep-komp.ru')
			{
				$.cookie("geo_text", 'Краснодар',{expires:365, path:'/', domain:'krasnodar.krep-komp.ru'});
				$('#geolocation').slideToggle(0);
				$("#geolocation [data-value='9']").addClass("selected-city");
				$.cookie('geo_id', '9',{expires:365, path:'/', domain:'krasnodar.krep-komp.ru'});
				$.cookie("geo_text", 'Краснодар',{expires:365, path:'/', domain:'krep-komp.ru'});
				getlocation='Краснодар';
			}
			else if(location.origin=='https://penza.krep-komp.ru')
			{
				$.cookie("geo_text", 'Пенза',{expires:365, path:'/', domain:'penza.krep-komp.ru'});
				$('#geolocation').slideToggle(0);
				$("#geolocation [data-value='10']").addClass("selected-city");
				$.cookie('geo_id', '10',{expires:365, path:'/', domain:'penza.krep-komp.ru'});
				$.cookie("geo_text", 'Пенза',{expires:365, path:'/', domain:'krep-komp.ru'});
				getlocation='Пенза';
			}
			else if(location.origin=='https://perm.krep-komp.ru')
			{
				$.cookie("geo_text", 'Пермь',{expires:365, path:'/', domain:'perm.krep-komp.ru'});
				$('#geolocation').slideToggle(0);
				$("#geolocation [data-value='11']").addClass("selected-city");
				$.cookie('geo_id', '11',{expires:365, path:'/', domain:'perm.krep-komp.ru'});
				$.cookie("geo_text", 'Пермь',{expires:365, path:'/', domain:'krep-komp.ru'});
				getlocation='Пермь';
			}
			else if(location.origin=='https://samara.krep-komp.ru')
			{
				$.cookie("geo_text", 'Самара',{expires:365, path:'/', domain:'samara.krep-komp.ru'});
				$('#geolocation').slideToggle(0);
				$("#geolocation [data-value='12']").addClass("selected-city");
				$.cookie('geo_id', '12',{expires:365, path:'/', domain:'samara.krep-komp.ru'});
				$.cookie("geo_text", 'Самара',{expires:365, path:'/', domain:'krep-komp.ru'});
				getlocation='Самара';
			}
			else if(location.origin=='https://saratov.krep-komp.ru')
			{
				$.cookie("geo_text", 'Саратов',{expires:365, path:'/', domain:'saratov.krep-komp.ru'});
				$('#geolocation').slideToggle(0);
				$("#geolocation [data-value='13']").addClass("selected-city");
				$.cookie('geo_id', '13',{expires:365, path:'/', domain:'saratov.krep-komp.ru'});
				$.cookie("geo_text", 'Саратов',{expires:365, path:'/', domain:'krep-komp.ru'});
				getlocation='Саратов';
			}
			else if(location.origin=='https://tver.krep-komp.ru')
			{
				$.cookie("geo_text", 'Тверь',{expires:365, path:'/', domain:'tver.krep-komp.ru'});
				$('#geolocation').slideToggle(0);
				$("#geolocation [data-value='14']").addClass("selected-city");
				$.cookie('geo_id', '14',{expires:365, path:'/', domain:'tver.krep-komp.ru'});
				$.cookie("geo_text", 'Тверь',{expires:365, path:'/', domain:'krep-komp.ru'});
				getlocation='Тверь';
			}
			else if(location.origin=='https://tula.krep-komp.ru')
			{
				$.cookie("geo_text", 'Тула',{expires:365, path:'/', domain:'tula.krep-komp.ru'});
				$('#geolocation').slideToggle(0);
				$("#geolocation [data-value='15']").addClass("selected-city");
				$.cookie('geo_id', '15',{expires:365, path:'/', domain:'tula.krep-komp.ru'});
				$.cookie("geo_text", 'Тула',{expires:365, path:'/', domain:'krep-komp.ru'});
				getlocation='Тула';
			}
			else if(location.origin=='https://rostov-na-donu.krep-komp.ru')
			{
				$.cookie("geo_text", 'Ростов-на-Дону',{expires:365, path:'/', domain:'rostov-na-donu.krep-komp.ru'});
				$('#geolocation').slideToggle(0);
				$("#geolocation [data-value='16']").addClass("selected-city");
				$.cookie('geo_id', '16',{expires:365, path:'/', domain:'rostov-na-donu.krep-komp.ru'});
				$.cookie("geo_text", 'Ростов-на-Дону',{expires:365, path:'/', domain:'krep-komp.ru'});
				getlocation='Ростов-на-Дону';
			}
			else if(location.origin=='https://ryazan.krep-komp.ru')
			{
				$.cookie("geo_text", 'Рязань',{expires:365, path:'/', domain:'ryazan.krep-komp.ru'});
				$('#geolocation').slideToggle(0);
				$("#geolocation [data-value='17']").addClass("selected-city");
				$.cookie('geo_id', '17',{expires:365, path:'/', domain:'ryazan.krep-komp.ru'});
				$.cookie("geo_text", 'Рязань',{expires:365, path:'/', domain:'krep-komp.ru'});
				getlocation='Рязань';
			}
			else if(location.origin=='https://yaroslavl.krep-komp.ru')
			{
				$.cookie("geo_text", 'Ярославль',{expires:365, path:'/', domain:'yaroslavl.krep-komp.ru'});
				$('#geolocation').slideToggle(0);
				$("#geolocation [data-value='18']").addClass("selected-city");
				$.cookie('geo_id', '18',{expires:365, path:'/', domain:'yaroslavl.krep-komp.ru'});
				$.cookie("geo_text", 'Ярославль',{expires:365, path:'/', domain:'krep-komp.ru'});
				getlocation='Ярославль';
			}
			else if(location.origin=='https://smolensk.krep-komp.ru')
			{
				$.cookie("geo_text", 'Смоленск',{expires:365, path:'/', domain:'smolensk.krep-komp.ru'});
				$('#geolocation').slideToggle(0);
				$("#geolocation [data-value='19']").addClass("selected-city");
				$.cookie('geo_id', '19',{expires:365, path:'/', domain:'smolensk.krep-komp.ru'});
				$.cookie("geo_text", 'Смоленск',{expires:365, path:'/', domain:'krep-komp.ru'});
				getlocation='Смоленск';
			}
			else if(location.origin=='https://ekaterinburg.krep-komp.ru')
			{
				$.cookie("geo_text", 'Екатеринбург',{expires:365, path:'/', domain:'ekaterinburg.krep-komp.ru'});
				$('#geolocation').slideToggle(0);
				$("#geolocation [data-value='20']").addClass("selected-city");
				$.cookie('geo_id', '20',{expires:365, path:'/', domain:'ekaterinburg.krep-komp.ru'});
				$.cookie("geo_text", 'Екатеринбург',{expires:365, path:'/', domain:'krep-komp.ru'});
				getlocation='Екатеринбург';
			}else{
				$("#geolocation [data-value='1']").addClass("selected-city");
				console.log('moscow');
			}
			console.log('moscow');
		}else
		{
			if((location.origin=='https://spb.krep-komp.ru' || location.origin=='http://spb.krep-komp.ru') && $.cookie('geo_id')!='2'){
				$.cookie("geo_text", null);
				$.cookie("geo_id", null);
				$("#geolocation [data-value='2']").addClass("selected-city");
				$.cookie("geo_text", 'Санкт-Петербург и ЛО',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
				$.cookie("geo_id", '2',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
			}
			if(location.origin=='https://kazan.krep-komp.ru' && $.cookie('geo_id')!='3'){
				$.cookie("geo_text", null);
				$.cookie("geo_id", null);
				$("#geolocation [data-value='3']").addClass("selected-city");
				$.cookie("geo_text", 'Казань',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
				$.cookie("geo_id", '3',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
			}
			if(location.origin=='https://nizhniy-novgorod.krep-komp.ru' && $.cookie('geo_id')!='4'){
				$.cookie("geo_text", null);
				$.cookie("geo_id", null);
				$("#geolocation [data-value='4']").addClass("selected-city");
				$.cookie("geo_text", 'Нижний Новгород',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
				$.cookie("geo_id", '4',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
			}
			if(location.origin=='https://voronezh.krep-komp.ru' && $.cookie('geo_id')!='5'){
				$.cookie("geo_text", null);
				$.cookie("geo_id", null);
				$("#geolocation [data-value='5']").addClass("selected-city");
				$.cookie("geo_text", 'Воронеж',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
				$.cookie("geo_id", '5',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
			}
			
			if(location.origin=='https://vladimir.krep-komp.ru' && $.cookie('geo_id')!='6'){
				$.cookie("geo_text", null);
				$.cookie("geo_id", null);
				$("#geolocation [data-value='6']").addClass("selected-city");
				$.cookie("geo_text", 'Владимир',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
				$.cookie("geo_id", '6',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
			}
			if(location.origin=='https://volgograd.krep-komp.ru' && $.cookie('geo_id')!='7'){
				$.cookie("geo_text", null);
				$.cookie("geo_id", null);
				$("#geolocation [data-value='7']").addClass("selected-city");
				$.cookie("geo_text", 'Волгоград',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
				$.cookie("geo_id", '7',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
			}
			if(location.origin=='https://kaluga.krep-komp.ru' && $.cookie('geo_id')!='8'){
				$.cookie("geo_text", null);
				$.cookie("geo_id", null);
				$("#geolocation [data-value='8']").addClass("selected-city");
				$.cookie("geo_text", 'Калуга',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
				$.cookie("geo_id", '8',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
			}
			if(location.origin=='https://krasnodar.krep-komp.ru' && $.cookie('geo_id')!='9'){
				$.cookie("geo_text", null);
				$.cookie("geo_id", null);
				$("#geolocation [data-value='9']").addClass("selected-city");
				$.cookie("geo_text", 'Краснодар',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
				$.cookie("geo_id", '9',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
			}
			if(location.origin=='https://penza.krep-komp.ru' && $.cookie('geo_id')!='10'){
				$.cookie("geo_text", null);
				$.cookie("geo_id", null);
				$("#geolocation [data-value='10']").addClass("selected-city");
				$.cookie("geo_text", 'Пенза',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
				$.cookie("geo_id", '10',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
			}
			if(location.origin=='https://perm.krep-komp.ru' && $.cookie('geo_id')!='11'){
				$.cookie("geo_text", null);
				$.cookie("geo_id", null);
				$("#geolocation [data-value='11']").addClass("selected-city");
				$.cookie("geo_text", 'Пермь',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
				$.cookie("geo_id", '11',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
			}
			if(location.origin=='https://samara.krep-komp.ru' && $.cookie('geo_id')!='12'){
				$.cookie("geo_text", null);
				$.cookie("geo_id", null);
				$("#geolocation [data-value='12']").addClass("selected-city");
				$.cookie("geo_text", 'Самара',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
				$.cookie("geo_id", '12',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
			}
			if(location.origin=='https://saratov.krep-komp.ru' && $.cookie('geo_id')!='13'){
				$.cookie("geo_text", null);
				$.cookie("geo_id", null);
				$("#geolocation [data-value='13']").addClass("selected-city");
				$.cookie("geo_text", 'Саратов',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
				$.cookie("geo_id", '13',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
			}
			if(location.origin=='https://tver.krep-komp.ru' && $.cookie('geo_id')!='14'){
				$.cookie("geo_text", null);
				$.cookie("geo_id", null);
				$("#geolocation [data-value='14']").addClass("selected-city");
				$.cookie("geo_text", 'Тверь',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
				$.cookie("geo_id", '14',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
			}
			if(location.origin=='https://tula.krep-komp.ru' && $.cookie('geo_id')!='15'){
				$.cookie("geo_text", null);
				$.cookie("geo_id", null);
				$("#geolocation [data-value='15']").addClass("selected-city");
				$.cookie("geo_text", 'Тула',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
				$.cookie("geo_id", '15',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
			}
			if(location.origin=='https://rostov-na-donu.krep-komp.ru' && $.cookie('geo_id')!='16'){
				$.cookie("geo_text", null);
				$.cookie("geo_id", null);
				$("#geolocation [data-value='16']").addClass("selected-city");
				$.cookie("geo_text", 'Ростов-на-Дону',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
				$.cookie("geo_id", '16',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
			}
			if(location.origin=='https://ryazan.krep-komp.ru' && $.cookie('geo_id')!='17'){
				$.cookie("geo_text", null);
				$.cookie("geo_id", null);
				$("#geolocation [data-value='17']").addClass("selected-city");
				$.cookie("geo_text", 'Рязань',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
				$.cookie("geo_id", '17',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
			}
			if(location.origin=='https://yaroslavl.krep-komp.ru' && $.cookie('geo_id')!='18'){
				$.cookie("geo_text", null);
				$.cookie("geo_id", null);
				$("#geolocation [data-value='18']").addClass("selected-city");
				$.cookie("geo_text", 'Ярославль',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
				$.cookie("geo_id", '18',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
			}
			if(location.origin=='https://smolensk.krep-komp.ru' && $.cookie('geo_id')!='19'){
				$.cookie("geo_text", null);
				$.cookie("geo_id", null);
				$("#geolocation [data-value='19']").addClass("selected-city");
				$.cookie("geo_text", 'Смоленск',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
				$.cookie("geo_id", '19',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
			}
			if(location.origin=='https://ekaterinburg.krep-komp.ru' && $.cookie('geo_id')!='20'){
				$.cookie("geo_text", null);
				$.cookie("geo_id", null);
				$("#geolocation [data-value='20']").addClass("selected-city");
				$.cookie("geo_text", 'Екатеринбург',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
				$.cookie("geo_id", '20',{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
			}
		}
			
			
		if(document.location.pathname!='/detail_order/' && location.origin!='https://new.krep-komp.ru')
		{
			if(location.origin=='https://krep-komp.ru' &&  !(id_get!='' && access!=''))
			{
				if(getlocation=='Санкт-Петербург и ЛО' || $.cookie('geo_id')=='2')
					window.location.href = 'https://spb.krep-komp.ru'+location.pathname;
				
				if(getlocation=='Казань' || $.cookie('geo_id')=='3')
					window.location.href = 'https://kazan.krep-komp.ru'+location.pathname;
				
				if(getlocation=='Нижний Новгород' || $.cookie('geo_id')=='4')
					window.location.href = 'https://nizhniy-novgorod.krep-komp.ru'+location.pathname;
				
				if(getlocation=='Воронеж' || $.cookie('geo_id')=='5')
					window.location.href = 'https://voronezh.krep-komp.ru'+location.pathname;
				
				if(getlocation=='Владимир' || $.cookie('geo_id')=='6')
					window.location.href = 'https://vladimir.krep-komp.ru'+location.pathname;
				if(getlocation=='Волгоград' || $.cookie('geo_id')=='7')
					window.location.href = 'https://volgograd.krep-komp.ru'+location.pathname;
				if(getlocation=='Калуга' || $.cookie('geo_id')=='8')
					window.location.href = 'https://kaluga.krep-komp.ru'+location.pathname;
				if(getlocation=='Краснодар' || $.cookie('geo_id')=='9')
					window.location.href = 'https://krasnodar.krep-komp.ru'+location.pathname;
				if(getlocation=='Пенза' || $.cookie('geo_id')=='10')
					window.location.href = 'https://penza.krep-komp.ru'+location.pathname;
				if(getlocation=='Пермь' || $.cookie('geo_id')=='11')
					window.location.href = 'https://perm.krep-komp.ru'+location.pathname;
				if(getlocation=='Самара' || $.cookie('geo_id')=='12')
					window.location.href = 'https://samara.krep-komp.ru'+location.pathname;
				if(getlocation=='Саратов' || $.cookie('geo_id')=='13')
					window.location.href = 'https://saratov.krep-komp.ru'+location.pathname;
				if(getlocation=='Тверь' || $.cookie('geo_id')=='14')
					window.location.href = 'https://tver.krep-komp.ru'+location.pathname;
				if(getlocation=='Тула' || $.cookie('geo_id')=='15')
					window.location.href = 'https://tula.krep-komp.ru'+location.pathname;
				if(getlocation=='Ростов-на-Дону' || $.cookie('geo_id')=='16')
					window.location.href = 'https://rostov-na-donu.krep-komp.ru'+location.pathname;
				if(getlocation=='Рязань' || $.cookie('geo_id')=='17')
					window.location.href = 'https://ryazan.krep-komp.ru'+location.pathname;
				if(getlocation=='Ярославль' || $.cookie('geo_id')=='18')
					window.location.href = 'https://yaroslavl.krep-komp.ru'+location.pathname;
				if(getlocation=='Смоленск' || $.cookie('geo_id')=='19')
					window.location.href = 'https://smolensk.krep-komp.ru'+location.pathname;
				if(getlocation=='Екатеринбург' || $.cookie('geo_id')=='20')
					window.location.href = 'https://ekaterinburg.krep-komp.ru'+location.pathname;

					
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
    
		$('#geolocation, .geolocation_link, #geolocation .box-modal__head .popUp-close, #geolocation .white-btn').click(function() {
    
			$('#geolocation').slideToggle(0);
			return false;
		});
		$('#geolocation li').click(function(e){
       
			$.cookie("geo_text", null);
			$.cookie("geo_id", null);
			$.cookie("geo_text", $(this).text(),{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
			$.cookie("geo_id", $(this).data().value,{expires:365, path:'/', domain:'krep-komp.ru',secure: true});
			
			console.log($(this).data());
			window.location.href = 'https://'+$(this).data().domain+location.pathname;
      
			$('#geolocation').slideToggle(0);
			return false; 
		});
    });
    </script>

<?}
}
?>