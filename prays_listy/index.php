<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Скачать Прайс-лист");

use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
// id highload-инфоблока
const MY_HL_BLOCK_ID = 3;
const MY_HL_BLOCK_META_ID=7;
//подключаем модуль highloadblock
CModule::IncludeModule('highloadblock');
?>
<?if(SITE_TEMPLATE_ID=='moskrep'){?>
            <!--page-heading-->
            <header class="basic-layout__module page-heading">
               <h1 class="page-heading__title"><?$APPLICATION->ShowTitle()?></h1>
            </header>
            <!--page-heading-->

<?// подключаем пространство имен класса HighloadBlockTable и даём ему псевдоним HLBT для удобной работы




$entity_data_class = GetEntityDataClass(MY_HL_BLOCK_ID);
$rsData = $entity_data_class::getList(array(
   'select' => array('*')
));
$el = $rsData->fetch();?>


            <!--simple-article-->
            <div class="basic-layout__module simple-article">
               <div class="simple-article__content wysiwyg-block">
                  <!--download-file-->
                  <p class="download-file"><img class="download-file__icon" src="<?=SITE_TEMPLATE_PATH?>/assets/design/download-file/xls.svg" width="36" height="36" alt="Скачать прайс продукции" title="Скачать прайс продукции" /><a class="second-button second-button--mini download-file__button" href="/service/krep-komp_price.xls">Скачать прайс продукции</a></p>
                  <!--download-file-->
                  <!--download-file-->
                  <p class="download-file"><img class="download-file__icon" src="<?=SITE_TEMPLATE_PATH?>/assets/design/download-file/xls.svg" width="36" height="36" alt="Скачать прайс распродажи" title="Скачать прайс распродажи" /><a class="second-button second-button--mini download-file__button" href="/upload/sale.xlsx">Скачать прайс распродажи</a><span class="download-file__date"><?=$el['UF_DATE']?></span></p>
                  <!--download-file-->
               </div>
            </div>
            <!--simple-article-->
<?}else{?>

<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array()); ?>
<h1 class="s38-title">Скачать прайс-лист</h1><?// подключаем пространство имен класса HighloadBlockTable и даём ему псевдоним HLBT для удобной работы


$entity_data_class = GetEntityDataClass(MY_HL_BLOCK_ID);
$rsData = $entity_data_class::getList(array(
   'select' => array('*')
));
$el = $rsData->fetch();?>
<div class="sale-category__info" style='margin-top:20px;'>
	<img src='/upload/medialibrary/1eb/excel.png' width='30' style='margin-right:20px;' />
	<a href="/service/krep-komp_price.xls" class="download-excel">Скачать прайс-лист продукции</a>
	<div class="sale-category__date"><span></span></div>
</div>
<div class="sale-category__info" style='margin-top:20px;'>
	<img src='/upload/medialibrary/1eb/excel.png' width='30' style='margin-right:20px;' />
	<a href="/upload/sale.xlsx" class="download-excel">Скачать прайс распродажи</a>
	<div class="sale-category__date"><span><?=$el['UF_DATE']?></span></div>
</div>

<?}?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>