<?php
namespace Pol\Generator\Logs;
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

		$res = LogsTable::delete($ID);
		if (!$res->isSuccess()){
			$DB->Rollback();
		}else{
			$DB->Commit();
		}

		global $CACHE_MANAGER;
		$CACHE_MANAGER->ClearByTag("generator_logs");
		return $res;
	}

	public static function getById($ID){
		$res = LogsTable::getById($ID);
		return $res;
	}

	public static function add($arFields){
		

		
		$arLogs = $arFields;

		

		

		$result = LogsTable::Add($arLogs);
		

	

		return $result;
	}

	public static function update($ID,$arFields){
		$result = new Result();
		global $DB;

		

		
		$ID = intval($ID);

	

		
		
		$arLogs = $arFields;

		

	

		$result = LogsTable::Update($ID,$arLogs);
		

		

		global $CACHE_MANAGER;
		$CACHE_MANAGER->ClearByTag("generator_logs");

		
		return $result;
	}

	public static function getList($options){
		$res = LogsTable::getList($options);

		return $res;
	}



	


}