<?
IncludeModuleLangFile(__FILE__); // в menu.php точно так же можно использовать языковые файлы

if($APPLICATION->GetGroupRight("table")>"D") // проверка уровня доступа к модулю веб-форм
{
  // сформируем верхний пункт меню
  
  $MODULE_ID = 'relink.table';
		$aMenu = array(
			"parent_menu" => "global_menu_services",
			"sort" => 50,
			"text" => 'Загрузка перелинковки',
			"title" => '',
                        "skip_chain"=>true,
			"url" => "relink_table_admin.php?lang=".LANGUAGE_ID,
			"icon" => "relink_table_icon",
			"page_icon" => "",
			"items_id" => $MODULE_ID,
                        "module_id"   => $MODULE_ID,
			"more_url" => array('relink_table_admin.php'),
			"items" => array(
							array(
								"url" => "relink_table_control_admin.php?lang=".LANGUAGE_ID,
								//"more_url" => array('pol_generator_edit_key.php',"pol_generator_list_keys.php"),
								"text" => 'Проверка адресов АНКОРОВ',
							),
				)
		);
  return $aMenu;
}
// если нет доступа, вернем false
return false;
?>