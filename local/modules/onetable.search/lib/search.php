<?php


namespace Onetable\Search;

use \Bitrix\Main\Entity;
use \Bitrix\Main\Type;

class ElementsTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'onetable_search';
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
            //Name
            new Entity\StringField('NAME', array(
                'data_type' => 'string',
                'required' => true,
            )),


            //Link
            new Entity\StringField('LINK', array(
                'data_type' => 'string',

            )),

            //Section Name
            new Entity\StringField('SECTION_NAME', array(
                'data_type' => 'string',

            )),

            //Article
            new Entity\StringField('ARTICLE', array(
                'data_type' => 'string',

            )),

            //PICTURE
            new Entity\StringField('PICTURE', array(
                'data_type' => 'string',

            )),

            //Price
            new Entity\FloatField('PRICE', array(
                'data_type' => 'float',

            )),


        );
    }


}