<?php
namespace Pol\Generator\Agent;

use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

class AgentTable extends Entity\DataManager
{
	public static function getFilePath()
	{
		return __FILE__;
	}

	public static function getTableName()
	{
		return 'generator_agent';
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
                             
            //ID Инфоблока
            'ID_IBLOCK' => array(
				'data_type' => 'integer',
				'title' => 'ID Инфоблока',
			),
            //ID раздела
            'ID_SECTION' => array(
				'data_type' => 'integer',
				'title' => 'ID Раздела',
			),
            //ID Шаблона
            'ID_RULES' => array(
				'data_type' => 'integer',
				'title' => 'ID Шаблона',
			),
            //ID раздела
            'ID_KEYS' => array(
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