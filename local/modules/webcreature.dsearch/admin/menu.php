<?
IncludeModuleLangFile(__FILE__); // в menu.php точно так же можно использовать языковые файлы

if($APPLICATION->GetGroupRight("generator")>"D") // проверка уровня доступа к модулю веб-форм
{
  // сформируем верхний пункт меню
  
  $aMenu = array(
    "parent_menu" => "global_menu_services", // поместим в раздел "Сервис"
    "sort"        => 100,                    // вес пункта меню
    "url"         => "settings.php?lang=".LANGUAGE_ID."&mid=webcreature.dsearch&mid_menu=1",  // ссылка на пункте меню
    "text"        => GetMessage("DSEARC_MENU_MAIN"),       // текст пункта меню
    "title"       => GetMessage("DSEARCR_MENU_MAIN_TITLE"), // текст всплывающей подсказки
    "icon"        => "dsearch_menu_icon", // малая иконка
    "page_icon"   => "dsearch_page_icon", // большая иконка
	"module_id"   => "webcreature.dsearch",
    "items_id"    => "webcreature.dsearch",  // идентификатор ветви
	
	
    "items"       => array(
	             array(
		            "url" => 'webcreature_dsearch_stat.php'."?lang=".LANG,
		            "more_url" => array('webcreature_dsearch_stat.php'),
		            "text" => getMessage('DSEARCH_MENU_MAIN_TITLE'),
			)
			),          // остальные уровни меню сформируем ниже.
  );

  // вернем полученный список
  return $aMenu;
}
// если нет доступа, вернем false
return false;
?>