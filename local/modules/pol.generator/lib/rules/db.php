<?php
namespace Pol\Generator\Rules;
use Bitrix\Main\Entity\Result;

IncludeModuleLangFile(__FILE__);

class DB extends Base{

	public static function delete($ID){
		$rsEvents = GetModuleEvents("pol.generator", "OnKeyDbDelete");
		while ($arEvent = $rsEvents->Fetch())
		{
			if (ExecuteModuleEvent($arEvent, array($ID)) == false){
				$result = new Result();
				return $result;
			}
		}

		global $DB;
		$DB->StartTransaction();

		$res = RulesTable::delete($ID);
		if (!$res->isSuccess()){
			$DB->Rollback();
		}else{
			$DB->Commit();
		}

		global $CACHE_MANAGER;
		$CACHE_MANAGER->ClearByTag("generator_rules");
		return $res;
	}

	public static function getById($ID){
		$res = RulesTable::getById($ID);
		return $res;
	}

	public static function add($arFields){
		

		
		$arRule = $arFields;

		

		

		$result = RulesTable::Add($arRule);
		

	

		return $result;
	}

	public static function update($ID,$arFields){
		$result = new Result();
		global $DB;

		

		
		$ID = intval($ID);

	

		
		
		$arRule = $arFields;

		

	

		$result = RulesTable::Update($ID,$arRule);
		

		

		global $CACHE_MANAGER;
		$CACHE_MANAGER->ClearByTag("generator_rules");

		
		return $result;
	}

	public static function getList($options){
		$res = RulesTable::getList($options);

		return $res;
	}



	


}