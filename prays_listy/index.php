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


<?globalGetTitle()?>

<?// подключаем пространство имен класса HighloadBlockTable и даём ему псевдоним HLBT для удобной работы




$entity_data_class = GetEntityDataClass(MY_HL_BLOCK_ID);
$rsData = $entity_data_class::getList(array(
   'select' => array('*')
));
while ($el = $rsData->fetch()) {	
	$elem[$el['ID']] = $el;
}?>


            <!--simple-article-->
            <div class="basic-layout__module simple-article">
               <div class="simple-article__content wysiwyg-block">
                  <!--download-file-->
                  <p class="download-file"><img class="download-file__icon" src="<?=SITE_TEMPLATE_PATH?>/assets/design/download-file/xls.svg" width="36" height="36" alt="Скачать прайс продукции" title="Скачать прайс продукции" /><a class="second-button second-button--mini download-file__button" href="<?=$elem[2]["UF_SALE_LINK"]?>">Скачать прайс продукции</a></p>
                  <!--download-file-->
                  <!--download-file-->
                  <p class="download-file"><img class="download-file__icon" src="<?=SITE_TEMPLATE_PATH?>/assets/design/download-file/xls.svg" width="36" height="36" alt="Скачать прайс распродажи" title="Скачать прайс распродажи" /><a class="second-button second-button--mini download-file__button" href="<?=$elem[1]["UF_SALE_LINK"]?>">Скачать прайс распродажи</a><span class="download-file__date"><?=$elem[1]["UF_DATE"]?></span></p>
                  <!--download-file-->
               </div>
            </div>
            <!--simple-article-->


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>