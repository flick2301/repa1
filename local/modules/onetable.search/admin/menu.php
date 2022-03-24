<?
IncludeModuleLangFile(__FILE__); // в menu.php точно так же можно использовать языковые файлы

if($APPLICATION->GetGroupRight("table")>"D") // проверка уровня доступа к модулю веб-форм
{
    // сформируем верхний пункт меню

    $MODULE_ID = 'onetable.search';
    $aMenu = array(
        "parent_menu" => "global_menu_services",
        "sort" => 50,
        "text" => 'Поиск вместо Multisearch',
        "title" => '',
        "skip_chain"=>true,
        "url" => "onetable_search.php?lang=".LANGUAGE_ID,
        "icon" => "onetable_search_icon",
        "page_icon" => "",
        "items_id" => $MODULE_ID,
        "module_id"   => $MODULE_ID,
        "more_url" => array('onetable_search.php'),
        "items" => array(


        )
    );
    return $aMenu;
}
// если нет доступа, вернем false
return false;
?>