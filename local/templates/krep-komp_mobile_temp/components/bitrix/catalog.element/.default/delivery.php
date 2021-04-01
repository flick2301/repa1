<?
$scheme = CMain::isHttps() ? 'https' : 'http';

switch (LANGUAGE_ID)
{
	case 'ru':
		$locale = 'ru-RU'; break;
	case 'ua':
		$locale = 'ru-UA'; break;
	case 'tk':
		$locale = 'tr-TR'; break;
	default:
		$locale = 'en-US'; break;
}
?>

<?$APPLICATION->SetAdditionalCSS("/delivery/style.css", true);?>
<?/*<script src="<?=$scheme?>://api-maps.yandex.ru/2.1.50/?load=package.full&lang=<?=$locale?>"></script>*/?>
<?$api_key = htmlspecialcharsbx(Bitrix\Main\Config\Option::get('fileman', 'yandex_map_api_key'));?>
<?$APPLICATION->AddHeadScript("{$scheme}://api-maps.yandex.ru/2.1.50/?load=package.full&lang={$locale}&apikey={$api_key}" );?>
<?$APPLICATION->AddHeadScript("/delivery/map.js?".rand());?>

<?$APPLICATION->SetAdditionalCSS($APPLICATION->GetCurDir()."style.css", true);?> <?/*<script src="<?=$scheme?>://api-maps.yandex.ru/2.1.50/?load=package.full&lang=<?=$locale?>"></script>*/?> 
<?$api_key = htmlspecialcharsbx(Bitrix\Main\Config\Option::get('fileman', 'yandex_map_api_key'));?> 
<?$APPLICATION->AddHeadScript("{$scheme}://api-maps.yandex.ru/2.1.50/?load=package.full&lang={$locale}&apikey={$api_key}" );?> 
<?$APPLICATION->AddHeadScript($APPLICATION->GetCurDir()."map.js?".rand());?> <?globalGetTitle()?> <!--simple-article-->




<!--simple-article-->


            <div class="basic-layout__module simple-article" id="delivery">
                  <!--simple-article-->
                  <div class="basic-layout__module simple-article">

	<?$APPLICATION->IncludeComponent("d7:delivery","krep-komp",Array(
				"IBLOCK_ID" => "22", 
				"CACHE_TYPE" => "A", 
                "CACHE_TIME" => "3600", 
                "CACHE_FILTER" => "N",
				"SHOW_FRAME" => "N"	
                    ), false
    );?>	
					 
				</div>
                  <!--simple-article-->
               
			   </div>
			   