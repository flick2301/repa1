<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Скачать Прайс-лист");
?>

            <!--page-heading-->
            <header class="basic-layout__module page-heading">
               <h1 class="page-heading__title"><?$APPLICATION->ShowTitle()?></h1>
            </header>
            <!--page-heading-->

<?// подключаем пространство имен класса HighloadBlockTable и даём ему псевдоним HLBT для удобной работы
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
// id highload-инфоблока
const MY_HL_BLOCK_ID = 3;
const MY_HL_BLOCK_META_ID=7;
//подключаем модуль highloadblock
CModule::IncludeModule('highloadblock');



$entity_data_class = GetEntityDataClass(MY_HL_BLOCK_ID);
$rsData = $entity_data_class::getList(array(
   'select' => array('*')
));
$el = $rsData->fetch();?>


            <!--simple-article-->
            <div class="basic-layout__module simple-article">
               <div class="simple-article__content wysiwyg-block">
                  <!--download-file-->
                  <p class="download-file"><img class="download-file__icon" src="<?=SITE_TEMPLATE_PATH?>/assets/design/download-file/xls.svg" width="36" height="36" alt=""><a class="second-button second-button--mini download-file__button" href="/service/krep-komp_price.xls">Скачать прайс продукции</a></p>
                  <!--download-file-->
                  <!--download-file-->
                  <p class="download-file"><img class="download-file__icon" src="<?=SITE_TEMPLATE_PATH?>/assets/design/download-file/xls.svg" width="36" height="36" alt=""><a class="second-button second-button--mini download-file__button" href="/upload/sale.xlsx">Скачать прайс распродажи</a><span class="download-file__date"><?=$el['UF_DATE']?></span></p>
                  <!--download-file-->
               </div>
            </div>
            <!--simple-article-->


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>