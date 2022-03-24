<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");

$module_id = 'onetable.search';




use Bitrix\Main\Loader;
use \Bitrix\Main\Application;
use \Bitrix\Main\Entity\Base;
use \Onetable\Search\ElementsTable;





if (!Loader::includeModule('iblock'))
    return;

if (!Loader::includeModule('catalog'))
    return;

if (!Loader::includeModule($module_id))
    return;



$info_module = CModule::CreateModuleObject($module_id);

$context = Application::getInstance()->getContext();
$request = $context->getRequest();

?>
    <link rel="stylesheet" type="text/css" href="<?=$info_module->MODULE_CSS?>">
    <form method="POST" action="<?=$APPLICATION->GetCurPage()?>">
        <input type="hidden" name="_method" value="PUT">
        <input type="submit" value="Загрузить данные в таблицу" />
    </form>

<?php



if($request['clear']=='Y'){
    //чистим ORM таблицу
    Application::getConnection(ElementsTable::getConnectionName())->
    queryExecute('TRUNCATE TABLE '.Base::getInstance('\Onetable\Search\ElementsTable')->getDBTableName());
}elseif($request['_method']=='PUT')
{
    //чистим ORM таблицу
    Application::getConnection(ElementsTable::getConnectionName())->
    queryExecute('TRUNCATE TABLE '.Base::getInstance('\Onetable\Search\ElementsTable')->getDBTableName());

    $obSections = \Bitrix\Iblock\SectionTable::getList(['filter'=>['IBLOCK_ID'=>CATALOG_IBLOCK_ID], 'select'=>['ID','NAME']]);
    while($section = $obSections->fetch())
    {
        $sections[$section['ID']] = $section['NAME'];
    }
    $arSelect = Array("*", "CATALOG_GROUP_".NUMBER_BASE_PRICE, "CATALOG_GROUP_".NUMBER_SALE_PRICE);
    $arFilter = Array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, ">CATALOG_PRICE_SCALE_".NUMBER_BASE_PRICE=>'0', "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        $arProperties = $ob->GetProperties();
        $price = ($arFields['CATALOG_PRICE_'.NUMBER_SALE_PRICE]) ? $arFields['CATALOG_PRICE_'.NUMBER_SALE_PRICE] : $arFields['CATALOG_PRICE_'.NUMBER_BASE_PRICE];
        $picture = (CFile::GetPath($arFields["PREVIEW_PICTURE"])) ? CFile::GetPath($arFields["PREVIEW_PICTURE"]) : '';
        ElementsTable::add(['NAME'=>$arFields['NAME'],
                            'LINK'=>$arFields['DETAIL_PAGE_URL'],
                            'SECTION_NAME'=>$sections[$arFields['IBLOCK_SECTION_ID']],
                            'ARTICLE'=>$arProperties['CML2_ARTICLE']['VALUE'],
                            'PICTURE'=>$picture,
                            'PRICE'=>$price]);


    }
}

//Если только после генерации или при хождении по постраничной навигации - отображаем таблицу
if(ElementsTable::getCount() || strpos($_SERVER['HTTP_REFERER'], 'nav-more-reports')){
    $nav = new \Bitrix\Main\UI\PageNavigation("nav-more-reports");
    $nav->allowAllRecords(true)
        ->setPageSize(50)
        ->initFromUri();
    ?>

    <table class="reports">
        <tr>
            <td>Название</td>
            <td>Адрес</td>
            <td>Название раздела</td>
            <td>Артикул</td>
            <td>Изображение</td>
            <td>Цена</td>


        </tr>
        <?php
        $result = ElementsTable::getList(array(
            'select'=>array('*'),
            'count_total' => true,
            'offset' => $nav->getOffset(),
            'limit' => $nav->getLimit(),
        ));
        if($result->getCount())
            echo 'В листе '.$result->getCount().' строк';
        $nav->setRecordCount($result->getCount());
        $APPLICATION->IncludeComponent(
            "bitrix:main.pagenavigation",
            "",
            array(
                "NAV_OBJECT" => $nav,
                "SEF_MODE" => "N",
            ),
            false
        );

        while ($row = $result->fetch())
        {

            ?>
            <tr>
                <td><?=$row['NAME']?></td>
                <td><?=$row['LINK']?></td>
                <td><?=$row['SECTION_NAME']?></td>
                <td><?=$row['ARTICLE']?></td>
                <td><?=$row['PICTURE']?></td>
                <td><?=$row['PRICE']?></td>


            </tr>
            <?php
        }
        ?>
    </table>
    <div id='nav-culture'></div>
    <?php

}


require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");

?>