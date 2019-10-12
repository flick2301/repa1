<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Скачать Прайс-лист");
?><? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array()); ?>
<h1 class="s38-title">Скачать прайс-лист</h1><?// подключаем пространство имен класса HighloadBlockTable и даём ему псевдоним HLBT для удобной работы
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
// id highload-инфоблока
const MY_HL_BLOCK_ID = 3;
const MY_HL_BLOCK_META_ID=7;
//подключаем модуль highloadblock
CModule::IncludeModule('highloadblock');
//Напишем функцию получения экземпляра класса:
function GetEntityDataClass($HlBlockId) {
    if (empty($HlBlockId) || $HlBlockId < 1)
    {
        return false;
    }
    $hlblock = HLBT::getById($HlBlockId)->fetch();   
    $entity = HLBT::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();
    return $entity_data_class;
}


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

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>