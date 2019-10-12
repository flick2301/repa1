<?
IncludeModuleLangFile(__FILE__); // в menu.php точно так же можно использовать языковые файлы

if($APPLICATION->GetGroupRight("generator")>"D") // проверка уровня доступа к модулю веб-форм
{
  // сформируем верхний пункт меню
  
  $aMenu = array(
    "parent_menu" => "global_menu_services", // поместим в раздел "Сервис"
    "sort"        => 100,                    // вес пункта меню
    "url"         => "settings.php?lang=".LANGUAGE_ID."&mid=pol.generator&mid_menu=1",  // ссылка на пункте меню
    "text"        => GetMessage("GENERATOR_MENU_MAIN"),       // текст пункта меню
    "title"       => GetMessage("GENERATOR_MENU_MAIN_TITLE"), // текст всплывающей подсказки
    "icon"        => "generator_menu_icon", // малая иконка
    "page_icon"   => "generator_page_icon", // большая иконка
	"module_id"   => "pol.generator",
    "items_id"    => "pol.generator",  // идентификатор ветви
	
	
"items"=> array(
	             array(
		            "url" => "pol_generator_list_keys.php?lang=".LANG,
		            "more_url" => array('pol_generator_edit_key.php',"pol_generator_list_keys.php"),
		            "text" => getMessage('MAIN_TAG_MENU_KEYS'),
	            ),
	            array(
		            "url" => 'pol_generator_list_rules.php'."?lang=".LANG,
		            "more_url" => array('pol_generator_edit_rule.php','pol_generator_list_rules.php'),
		            "text" => getMessage('MAIN_TAG_MENU_RULES'),
	            ),
                    array(
		            "url" => 'pol_generator_list_agent.php'."?lang=".LANG,
		            "more_url" => array('pol_generator_edit_agent.php','pol_generator_list_agent.php'),
		            "text" => getMessage('MAIN_TAG_MENU_AGENT'),
	            ),
                    array(
		            "url" => 'pol_generator_list_logs.php'."?lang=".LANG,
		            "more_url" => array('pol_generator_edit_log.php','pol_generator_list_logs.php'),
		            "text" => getMessage('MAIN_TAG_MENU_LOGS'),
	            ),
                ),          // остальные уровни меню сформируем ниже.
  );

  /* далее выберем список веб-форм и добавим для каждой соответствующий пункт меню
  require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/pol.generator/include.php");
  $z = CForm::GetMenuList(array("LID"=>LANGUAGE_ID));
  while ($zr=$z->GetNext())
  {
    if (strlen($zr["MENU"]) > 0)
    {
      // массив каждого пункта формируется аналогично
      $aMenu["items"][] =  array(
        "text" => $zr["MENU"],
        "url"  => "form_result_list.php?lang=".LANGUAGE_ID."&WEB_FORM_ID=".$zr["ID"],
        "icon" => "form_menu_icon",
        "page_icon" => "form_page_icon",
        "more_url"  => array(
            "form_view.php?WEB_FORM_ID=".$zr["ID"],
            "form_result_list.php?WEB_FORM_ID=".$zr["ID"],
            "form_result_edit.php?WEB_FORM_ID=".$zr["ID"],
            "form_result_print.php?WEB_FORM_ID=".$zr["ID"],
            "form_result_view.php?WEB_FORM_ID=".$zr["ID"]
            ),
        "title" => GetMessage("FORM_RESULTS_ALT")
       );
    }
  }
*/
  // если нам нужно добавить ещё пункты - точно так же добавляем элементы в массив $aMenu["items"]
  // ............

  // вернем полученный список
  return $aMenu;
}
// если нет доступа, вернем false
return false;
?>