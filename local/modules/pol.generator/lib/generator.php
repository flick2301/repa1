<?php


namespace Pol\Generator;

use \Bitrix\Main\Entity;
use \Bitrix\Main\Type;

class GeneratorTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'generator_keys';
    }

    

    public static function getConnectionName()
    {
        return 'default';
    }

    public static function getMap()
    {
        return array(
            //ID
            new Entity\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
            )),
            //Название
            new Entity\StringField('NAME', array(
                'required' => true,
            )),
                   
            
            //ID раздела
            new Entity\IntegerField('ID_SECTION', array(
                'required' => true,
            )),
			
			//Ключи
            new Entity\StringField('KEYS', array(
                'required' => true,
            )),
            
        );
    }


}