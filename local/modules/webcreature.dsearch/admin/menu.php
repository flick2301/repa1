<?
IncludeModuleLangFile(__FILE__); // � menu.php ����� ��� �� ����� ������������ �������� �����

if($APPLICATION->GetGroupRight("generator")>"D") // �������� ������ ������� � ������ ���-����
{
  // ���������� ������� ����� ����
  
  $aMenu = array(
    "parent_menu" => "global_menu_services", // �������� � ������ "������"
    "sort"        => 100,                    // ��� ������ ����
    "url"         => "settings.php?lang=".LANGUAGE_ID."&mid=webcreature.dsearch&mid_menu=1",  // ������ �� ������ ����
    "text"        => GetMessage("DSEARC_MENU_MAIN"),       // ����� ������ ����
    "title"       => GetMessage("DSEARCR_MENU_MAIN_TITLE"), // ����� ����������� ���������
    "icon"        => "dsearch_menu_icon", // ����� ������
    "page_icon"   => "dsearch_page_icon", // ������� ������
	"module_id"   => "webcreature.dsearch",
    "items_id"    => "webcreature.dsearch",  // ������������� �����
	
	
    "items"       => array(
	             array(
		            "url" => 'webcreature_dsearch_stat.php'."?lang=".LANG,
		            "more_url" => array('webcreature_dsearch_stat.php'),
		            "text" => getMessage('DSEARCH_MENU_MAIN_TITLE'),
			)
			),          // ��������� ������ ���� ���������� ����.
  );

  // ������ ���������� ������
  return $aMenu;
}
// ���� ��� �������, ������ false
return false;
?>