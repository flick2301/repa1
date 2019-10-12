<?php
namespace Pol\Generator\Key;

use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

class KeysTable extends Entity\DataManager
{
	public static function getFilePath()
	{
		return __FILE__;
	}

	public static function getTableName()
	{
		return 'generator_keys';
	}

	public static function getMap()
	{
		 return array(
            //ID
           'ID' => array(
				'data_type' => 'integer',
				'primary' => true,
				'autocomplete' => true,
				'title' => 'ID',
			),
            //Название
           'NAME' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateName'),
				'title' => 'Название',
			),
                   
            
            //ID раздела
            'ID_SECTION' => array(
				'data_type' => 'integer',
				'title' => 'ID Шаблона',
			),
			
			//Название
           'KEYS' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateKeys'),
				'title' => 'Ключи',
			),
			
			
            
        );
	}

	public static function validateCode()
	{
		return array(
			new Entity\Validator\Length(null, 255),
		);
	}
	public static function validateName()
	{
		return array(
			new Entity\Validator\Length(null, 255),
		);
	}
	public static function validateKeys()
	{
		return array(
			new Entity\Validator\Length(null, 255),
		);
	}
	public static function validateValue()
	{
		return array(
			new Entity\Validator\Length(null, 255),
		);
	}
	public static function validateCSite()
	{
		return array(
			new Entity\Validator\Length(null, 255),
		);
	}
	public static function validateCTemplate()
	{
		return array(
			new Entity\Validator\Length(null, 255),
		);
	}
	public static function validateCRequest()
	{
		return array(
			new Entity\Validator\Length(null, 255),
		);
	}
	public static function validateCPhp()
	{
		return array(
			new Entity\Validator\Length(null, 255),
		);
	}

	public function checkFieldsDB(&$arFields,$id = null){
		global $DB,$USER;

		$error = array();

		$userId = $USER->getId();

		if (isset($arFields["CODE"])){
			$arFields["CODE"] = trim($arFields["CODE"]);
			$arFields["CODE"] = strtoupper(str_replace(' ','_',$arFields["CODE"]));
		}

		if (isset($arFields["NAME"]))
			$arFields["NAME"] = trim($arFields["NAME"]);
		if (isset($arFields["VALUE"]))
			$arFields["VALUE"] = trim($arFields["VALUE"]);
		if (isset($arFields["C_REQUEST"]))
			$arFields["C_REQUEST"] = trim($arFields["C_REQUEST"]);
		if (isset($arFields["C_PHP"]))
			$arFields["C_PHP"] = trim($arFields["C_PHP"]);

		if (isset($arFields["C_SITE"]))
			$arFields["C_SITE"] = (is_array($arFields["C_SITE"]) && $arFields["C_SITE"]) ? '#'.implode('#',$arFields["C_SITE"]).'#' : null;

		if (isset($arFields["C_TEMPLATE"]))
			$arFields["C_TEMPLATE"] = (is_array($arFields["C_TEMPLATE"]) && $arFields["C_TEMPLATE"]) ? '#'.implode('#',$arFields["C_TEMPLATE"]).'#' : null;

		$arFields["ACTIVE"] = $arFields["ACTIVE"] <> "Y" ? "N" : "Y";

		if (isset($arFields["SORT"]))
			$arFields["SORT"] = intval($arFields["SORT"]);

		$arFields["MODIFIED_BY"] = $userId;

		if (isset($arFields["CREATED_BY"]))
			$arFields["CREATED_BY"] = $userId;

		if (isset($arFields["CODE"]) && !$arFields["CODE"]){
			$error[] = Loc::getMessage("ERROR_EMPTY_CODE");
		}

		if (isset($arFields["ACTIVE_FROM"]) && strlen($arFields["ACTIVE_FROM"]) > 0	&& !$DB->IsDate($arFields["ACTIVE_FROM"], false, LANG, "FULL")){
			$error[] = Loc::getMessage("ERROR_BAD_ACTIVE_FROM");
		}

		if (isset($arFields["ACTIVE_TO"]) && strlen($arFields["ACTIVE_TO"]) > 0	&& !$DB->IsDate($arFields["ACTIVE_TO"], false, LANG, "FULL")){
			$error[] = Loc::getMessage("ERROR_BAD_ACTIVE_TO");
		}

		if (isset($arFields["TIMESTAMP_X"]) && strlen($arFields["TIMESTAMP_X"]) > 0	&& !$DB->IsDate($arFields["TIMESTAMP_X"], false, LANG, "FULL")){
			$error[] = Loc::getMessage("ERROR_BAD_TIMESTAMP_X");
		}

		if (isset($arFields["DATE_CREATE"]) && strlen($arFields["DATE_CREATE"]) > 0	&& !$DB->IsDate($arFields["DATE_CREATE"], false, LANG, "FULL")){
			$error[] = Loc::getMessage("ERROR_BAD_DATE_CREATE");
		}

		if ($arFields["CODE"]){
			$filter = array('CODE' => $arFields["CODE"]);

			if ($id){
				$filter["!ID"] = $id;
			}

			$beforeRes = self::getList(array(
				'filter' => $filter
			));

			if ($keyRow = $beforeRes->fetch()){
				$error[] = Loc::getMessage("ERROR_DUPLICATE_CODE");
			}
		}

		if (!$error){
			$arFields["TIMESTAMP_X"] = new \Bitrix\Main\Type\DateTime();
			$arFields["DATE_CREATE"] = new \Bitrix\Main\Type\DateTime();
		}

		if ($id){
			unset($arFields["DATE_CREATE"]);
			unset($arFields["CREATED_BY"]);
		}

		return $error;
	}
}