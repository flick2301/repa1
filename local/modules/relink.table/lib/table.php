<?php


namespace Relink\Table;

use \Bitrix\Main\Entity;
use \Bitrix\Main\Type;

class LinksTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'relink_table';
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
            //Анкор (текст ссылки)
            new Entity\StringField('ANKOR', array(
                'data_type' => 'string',
                'required' => true,
            )),
                   
            
            //Акцептор (страница, куда ссылается ссылка)
            new Entity\StringField('AKCEPTOR', array(
                'data_type' => 'string',
                
            )),
			
		//Донор (страница, где находится ссылка)
            new Entity\StringField('DONOR', array(
                'data_type' => 'string',
                
            )),
            
            	//ID Донора (страница, где находится ссылка)
            new Entity\StringField('DONOR_ID', array(
                'data_type' => 'integer',
                
            )),
            
            
        );
    }


}