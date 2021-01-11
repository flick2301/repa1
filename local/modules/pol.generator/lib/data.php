<?php
namespace Pol\Generator;


class Data{
	protected static $keyEditPage = 'pol_generator_edit_key.php';
	protected static $keyListPage = 'pol_generator_list_keys.php';
        protected static $agentEditPage = 'pol_generator_edit_agent.php';
	protected static $agentListPage = 'pol_generator_list_agent.php';
	protected static $ruleListPage = 'pol_generator_list_rules.php';
	protected static $ruleEditPage = 'pol_generator_edit_rule.php';
        protected static $logListPage = 'pol_generator_list_logs.php';
	protected static $logEditPage = 'pol_generator_edit_log.php';
	

	public static function getPageName($pageType){
		if($pageType == 'edit_key'){
			return self::$keyEditPage;
		}
		if($pageType == 'list_key'){
			return self::$keyListPage;
		}
                if($pageType == 'edit_agent'){
			return self::$agentEditPage;
		}
		if($pageType == 'list_agent'){
			return self::$agentListPage;
		}
		if($pageType == 'list_rules'){
			return self::$ruleListPage;
		}
		if($pageType == 'edit_rule'){
			return self::$ruleEditPage;
		}
                if($pageType == 'list_logs'){
			return self::$logListPage;
		}
		if($pageType == 'edit_log'){
			return self::$logEditPage;
		}
		
		return false;
	}
	
	
		public static function getSiteList(){
		$siteList = array();

		$rsSites = \CSite::GetList($by="sort", $order="desc", Array());
		while ($arSite = $rsSites->Fetch()){
			$siteList[] = $arSite;
		}

		return $siteList;
	}

	public static function getTemplateList(){
		$siteTemplateList = array();
		$rsTemplates = \CSiteTemplate::GetList(array('sort' => 'order'), array(), array("ID", "NAME"));
		while($arTemplate = $rsTemplates->Fetch())
		{
			$siteTemplateList[] = $arTemplate;
		}

		return $siteTemplateList;
	}

	

	

	
}
?>