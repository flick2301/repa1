<?php
namespace Pol\Generator\Logs;

use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

class LogsTable extends Entity\DataManager
{
	public static function getFilePath()
	{
		return __FILE__;
	}

	public static function getTableName()
	{
		return 'generator_logs';
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
                         
                     //ID раздела
            'IBLOCK_ID' => array(
				'data_type' => 'integer',
				'title' => 'ID Инфоблока',
			),
            
            //ID раздела
            'ID_SECTION' => array(
				'data_type' => 'integer',
				'title' => 'ID Раздела',
			),
			
	//ID раздела
            'ID_RULE' => array(
				'data_type' => 'integer',
				'title' => 'ID Правила',
			),
			
			
	//ID раздела
            'ID_KEY' => array(
				'data_type' => 'integer',
				'title' => 'ID Ключей',
			),
			
		
        );
	}


	public static function validateName()
	{
		return array(
			new Entity\Validator\Length(null, 255),
		);
	}



}