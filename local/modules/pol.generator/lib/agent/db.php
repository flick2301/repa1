<?php
namespace Pol\Generator\Agent;
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

		$res = AgentTable::delete($ID);
		if (!$res->isSuccess()){
			$DB->Rollback();
		}else{
			$DB->Commit();
		}

		global $CACHE_MANAGER;
		$CACHE_MANAGER->ClearByTag("generator_agent");
		return $res;
	}

	public static function getById($ID){
		$res = AgentTable::getById($ID);
		return $res;
	}

	public static function add($arFields){
		

		
		$arAgent = $arFields;

		

		

		$result = AgentTable::Add($arAgent);
		

	

		return $result;
	}

	public static function update($ID,$arFields){
		$result = new Result();
		global $DB;

		

		
		$ID = intval($ID);

	

		
		
		$arAgent = $arFields;

		

	

		$result = AgentTable::Update($ID,$arAgent);
		

		

		global $CACHE_MANAGER;
		$CACHE_MANAGER->ClearByTag("generator_agent");

		
		return $result;
	}

	public static function getList($options){
		$res = AgentTable::getList($options);

		return $res;
	}



	


}