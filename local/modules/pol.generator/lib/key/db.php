<?php
namespace Pol\Generator\Key;
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

		$res = KeysTable::delete($ID);
		if (!$res->isSuccess()){
			$DB->Rollback();
		}else{
			$DB->Commit();
		}

		global $CACHE_MANAGER;
		$CACHE_MANAGER->ClearByTag("generator_keys");
		return $res;
	}

	public static function getById($ID){
		$res = KeysTable::getById($ID);
		return $res;
	}

	public static function add($arFields){
		

		
		$arKey = $arFields;

		

		

		$result = KeysTable::Add($arKey);
		

	

		return $result;
	}

	public static function update($ID,$arFields){
		$result = new Result();
		global $DB;

		

		
		$ID = intval($ID);

	

		
		
		$arKey = $arFields;

		

	

		$result = KeysTable::Update($ID,$arKey);
		

		

		global $CACHE_MANAGER;
		$CACHE_MANAGER->ClearByTag("generator_keys");

		
		return $result;
	}

	public static function getList($options){
		$res = KeysTable::getList($options);

		return $res;
	}

	public static function getKeysListForPage(){
		global $APPLICATION;

		$url = $APPLICATION->GetCurPage();
		$realFilePath = ($_SERVER["REAL_FILE_PATH"]) ? $_SERVER["REAL_FILE_PATH"] : NULL;

		$cacheId = md5('generator_keys'.$url);
		$cacheDir = "/pol.generator/keys";

		$obCache = new \CPHPCache;
		$cacheTime = \COption::GetOptionInt('pol.generator','TIME_CACHE_SQL_REQUEST');
		if($obCache->InitCache($cacheTime, $cacheId, $cacheDir)){
			$keys = $obCache->GetVars();
		}elseif($obCache->StartDataCache() || \CSite::InDir('/bitrix/')){

			$connection = \Bitrix\Main\Application::getConnection();
			$sqlHelper = $connection->getSqlHelper();
			$KeysTableName = KeysTable::getTableName();
			$PagesTableName = PagesTable::getTableName();

			if ($realFilePath){
				$realFilePath = "'".$sqlHelper->ForSQL($realFilePath)."'";
			}else{
				$realFilePath = "'1=1'";
			}

			if ($KeysTableName && $PagesTableName)
				$sql = "
				SELECT DISTINCT
					K.ID, NAME

				FROM $KeysTableName K

				LEFT JOIN $PagesTableName P_1 ON (P_1.KEY_ID = K.ID	and P_1.SHOW_ON_PAGE='Y')

				LEFT JOIN $PagesTableName P_2 ON (P_2.KEY_ID = K.ID	and P_2.SHOW_ON_PAGE='N' and ('".$sqlHelper->ForSQL($url)."' like concat(P_2.PAGE, '%') or $realFilePath like concat(P_2.PAGE, '%')))

				WHERE
					K.ACTIVE = 'Y'
					and (P_2.ID is null)
					and (P_1.ID is null or '".$sqlHelper->ForSQL($url)."' like concat(P_1.PAGE, '%') or $realFilePath like concat(P_1.PAGE, '%') )
					and (K.ACTIVE_FROM <=now() OR K.ACTIVE_FROM IS NULL)
					and (K.ACTIVE_TO >=now() OR K.ACTIVE_TO IS NULL)
					and (K.C_SITE like '#".$sqlHelper->ForSQL(SITE_ID)."#'  OR K.C_SITE IS NULL)
					and (K.C_TEMPLATE like '#".$sqlHelper->ForSQL(SITE_TEMPLATE_ID)."#' OR K.C_TEMPLATE IS NULL)
					and (K.VALUE IS NOT NULL)
					and (K.CODE IS NOT NULL)
				ORDER BY SORT ASC
					";
			$res = $connection->query($sql);
			$keys = array();
			while($row = $res->fetch()){
				$row = self::prepareDbKeys($row);
				if ($row){
					$keys[$row["CODE"]] = $row;
				}
			}

			global $CACHE_MANAGER;
			$CACHE_MANAGER->StartTagCache($cacheDir);
			$CACHE_MANAGER->RegisterTag("generator_fields");
			$CACHE_MANAGER->EndTagCache();
			$obCache->EndDataCache($keys);

		}
		return $keys;
	}

	public static function getPageList($keyId){
		$res = PagesTable::getList(array(
			"filter" => array("KEY_ID" => $keyId),
			"order" => array("ID" => "asc")
		));

		return $res;
	}

	public function AddPageRecords($keyID,$arFields){
		$result = new Result();

		array_filter($arFields);
		if (!isset($arFields["SHOW_ON"]) && !isset($arFields["SHOW_OFF"])){
			return $result;
		}

		$res = PagesTable::getList(array(
			"filter" => array("KEY_ID"=> $keyID)
		));

		$diff = false;
		$pagesShow = array();
		$pagesNotShow = array();
		while ($row = $res->fetch()){
			$recordSet = true;
			if ($row["SHOW_ON_PAGE"] == "Y"){
				$pagesShow[] = $row["PAGE"];
			}elseif($row["SHOW_ON_PAGE"] == "N"){
				$pagesNotShow[] = $row["PAGE"];
			}
		}

		$errors = self::preparePageFields($arFields);

		foreach($errors as $error){
			$result->addError(new \Bitrix\Main\Entity\EntityError($error));
		}
		if (!$result->isSuccess()){
			return $result;
		}

		if (count($pagesShow) != count($arFields["SHOW_ON"])
			|| count($pagesNotShow) != count($arFields["SHOW_OFF"])
			|| !self::identicalValues($pagesShow, $arFields["SHOW_ON"])
			|| !self::identicalValues($pagesNotShow, $arFields["SHOW_OFF"])
			|| !$recordSet
		)
			$diff = true;

		if ($diff){
			self::deletePagesByKey($keyID);

			foreach($arFields as $keyField => $typeField){
				foreach($typeField as $url){
					$arItem = array(
						"KEY_ID" => $keyID,
						"PAGE" => $url,
						"SHOW_ON_PAGE" => ($keyField == 'SHOW_ON') ? 'Y' : "N",
					);
					$result = PagesTable::Add($arItem);
					if (!$result->isSuccess()){
						return $result;
					}
				}
			}

		}

		return $result;
	}

	protected static function deletePagesByKey($keyID){
		$connection = \Bitrix\Main\Application::getConnection();
		$sqlHelper = $connection->getSqlHelper();
		$tableName = PagesTable::getTableName();
		if ($tableName && $keyID)
			$sql = "DELETE FROM $tableName WHERE KEY_ID = '".$sqlHelper->forSql($keyID)."' ";

		$connection->query($sql);
	}

	public function makeArrayPathFromText(&$arFields){
		$error = array();

		$pattern = "/^\/?([\/\w \.-]*)*\/?$/";
		if (defined("BX_UTF")){
			$pattern .= 'u';
		}
		$arFields = explode("\r\n",$arFields);
		if (count($arFields)){
			$arFields = array_filter($arFields);
			foreach($arFields as $key => $url){
				str_replace(' ', '',$url);
				if (strpos($url,'.') === false && substr($url,'-1') != '/'){
					$url .= '/';
				}

				if (substr($url,0,1) != '/'){
					$url = '/'.$url;
				}

				if (!preg_match($pattern,$url)){
					$error[] = getMessage('ERROR_URL_PATH_ON');
					break;
				}else{
					$arFields[$key] = $url;
				}
			}
		}
		return $error;
	}

	public function preparePageFields(&$arFields){
		$error = array();

		if ($arFields["SHOW_ON"]){
			$error = array_merge($error,self::makeArrayPathFromText($arFields["SHOW_ON"]));
		}
		if ($arFields["SHOW_OFF"]){
			$error = array_merge($error,self::makeArrayPathFromText($arFields["SHOW_OFF"]));
		}

		return $error;
	}

	function identicalValues( $arrayA , $arrayB ) {
		sort( $arrayA );
		sort( $arrayB );
		return $arrayA == $arrayB;
	}

	protected function prepareDbKeys($key){
		if (!$key || !$key["CODE"] || !$key["VALUE"]){
			return false;
		}

		if ($key["C_SITE"]){
			$siteIds = $key["C_SITE"];
			$siteIds = explode("#",$siteIds);
			trimArr($siteIds);
			$siteIds = array_values($siteIds);
		}

		if ($key["C_TEMPLATE"]){
			$siteTemplateIds = $key["C_TEMPLATE"];
			$siteTemplateIds = explode("#",$siteTemplateIds);
			trimArr($siteTemplateIds);
			$siteTemplateIds= array_values($siteTemplateIds);
		}
		
		$return = array(
			"ID" => $key["ID"],
			"ACTIVE" => ($key["ACTIVE"] == "Y" || !isset($key["ACTIVE"])) ? "Y" : "N",
			"CODE" => $key["CODE"],
			"NAME" => $key["NAME"],
			"VALUE" => $key["VALUE"],
			"SET_INFO" => array(
				"LINK" => "/bitrix/admin/".\Shantilab\Metatags\Data::getPageName('edit_key')."?ID={$key["ID"]}",
			),
			"CONDITIONS" => array(
				"REQUEST" => ($key["C_REQUEST"]) ? $key["C_REQUEST"] : "",
				"PHP_EXPRESSION" => $key["C_PHP"],
				"SITE_TEMPLATE_ID" => ($siteTemplateIds) ? $siteTemplateIds : "",
				"SITE" => ($siteIds) ? $siteIds : "",
			)
		);

		return $return;
	}

}