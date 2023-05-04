<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
header("Access-Control-Allow-Origin: https://krep-komp.ru");
$APPLICATION->SetTitle("Интернет-магазин \"Москреп\"");
$APPLICATION->SetPageProperty("title", "Интернет-магазин \"Москреп\"");
?>
<?
global $USER;
if(!$USER->IsAuthorized() && ($_SERVER['HTTP_HOST'] == 'dev1.krep-komp.ru' || $_SERVER['HTTP_HOST'] == 'dev2.krep-komp.ru' || $_SERVER['HTTP_HOST'] == 'dev3.krep-komp.ru')){
	$dev_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/bitrix/admin/';
	header('Location: '. $dev_url);
}	
	?>

<?if(SITE_TEMPLATE_ID=='krep-komp_mobile')
	$template='krep-komp';
else
	$template='';?>
<!--intro-slider-->
<div class="basic-layout__module intro-slider">		   
<?$APPLICATION->IncludeComponent(
	"d7:slider_new", 
	$template, 
	array(
		"IBLOCK_TYPE" => "banners",
		"IBLOCK_ID" => "6",
		"width" => "904",
		"height" => "290",
		"effect" => "fold",
		"slices" => "21",
		"animSpeed" => "800",
		"pauseTime" => "8000",
		"startSlide" => "0",
		"directionNav" => "N",
		"controlNav" => "Y",
		"pauseOnHover" => "Y",
		"text_title" => "",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
</div>

<!--intro-slider-->


<div class="main_hits_title">Категории товаров</div>
<div class='category'>
	<div class='container'>
		<div class='category__wrapper'>
			
			<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.section.list",
				"root_directory",
				Array(
					"ADD_SECTIONS_CHAIN" => "Y",
					"CACHE_GROUPS" => "Y",
					"CACHE_TIME" => "36000000",
					"CACHE_TYPE" => "N",
					"COUNT_ELEMENTS" => "Y",
					"IBLOCK_ID" => CATALOG_IBLOCK_ID,
					"IBLOCK_TYPE" => "catalog",
					"SECTION_CODE" => "",
					"SECTION_FIELDS" => array("", ""),
					"SECTION_ID" => "",
					"SECTION_URL" => "",
					"SECTION_USER_FIELDS" => array("", ""),
					"SHOW_PARENT_NAME" => "Y",
					"TOP_DEPTH" => "1",
					"SECTION_USER_FIELDS" => array("UF_PIC",""),
					"VIEW_MODE" => "LINE"
				)
			);?>
		</div>
	</div>
</div>






<?if(SITE_TEMPLATE_ID!='krep-komp_mobile'){?>
	<div data-retailrocket-markup-block="63591b58e931eed4c8088a82"></div>
<?}?>








<?/*
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"main_catalog",
	Array(
		"ADD_SECTIONS_CHAIN" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "Y",
		"IBLOCK_ID" => CATALOG_IBLOCK_ID,
		"IBLOCK_TYPE" => "catalog",
		"SECTION_CODE" => "samorezy",
		"SECTION_FIELDS" => array("", ""),
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("", ""),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "1",
            "SECTION_USER_FIELDS" => array("UF_PIC",""),
		"VIEW_MODE" => "LINE"
	)
);?>
<?}?>
*/?>

<script>$(document).ready(function(){var tabs=new Tabby("[data-tabby-tabs]");});</script>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>