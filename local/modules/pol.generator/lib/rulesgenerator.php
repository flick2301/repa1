<?php


namespace Pol\Generator;

use \Bitrix\Main\Entity;
use \Bitrix\Main\Type;

class RulesTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'generator_rules';
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
                               
            
            //ID раздела
            new Entity\IntegerField('ID_SECTION', array(
                'required' => true,
            )),
			
			//Название товара
            new Entity\StringField('NAME', array(
                'required' => true,
            )),
			
			//КАРТОЧКА ТОВАРА
			
			//Title
            new Entity\StringField('TITLE_CART', array(
                'required' => true,
            )),
			//Keywords
            new Entity\StringField('KEYWORDS_CART', array(
                'required' => true,
            )),
			//Description
            new Entity\StringField('DESCRIPTION_CART', array(
                'required' => true,
            )),
			//Alt
            new Entity\StringField('ALT_CART', array(
                'required' => true,
            )),
			//Title_pic
            new Entity\StringField('TITLE_PIC_CART', array(
                'required' => true,
            )),
			
			
			//КАТАЛОГ ПРОДУКЦИИ
			
			//Title
            new Entity\StringField('TITLE_CAT', array(
                'required' => true,
            )),
			//Keywords
            new Entity\StringField('KEYWORDS_CAT', array(
                'required' => true,
            )),
			//Description
            new Entity\StringField('DESCRIPTION_CAT', array(
                'required' => true,
            )),
			
			
			//МИНИ-КАРТОЧКА ТОВАРА
			
			
			//Alt
            new Entity\StringField('ALT_MINI_CART', array(
                'required' => true,
            )),
			//Title_pic
            new Entity\StringField('TITLE_PIC_MINI_CART', array(
                'required' => true,
            )),
			//Title_href
            new Entity\StringField('TITLE_HREF_MINI_CART', array(
                'required' => true,
            )),
			
			//Меню разделов и хлебные крошки
			
			//Title
			new Entity\StringField('TITLE_MENU', array(
                'required' => true,
            )),
			
			//ШАПКА
			//Alt
            new Entity\StringField('ALT_LOGO', array(
                'required' => true,
            )),

            //ДОПОЛНИТЕЛЬНЫЕ ПОЛЯ
            //ДОПОЛНИТЕЛЬНЫЙ ЗАГОЛОВ
            new Entity\StringField('ROOT_NAME', array(
                'required' => true,
            )),
            //ДОПОЛНИТЕЛЬНОЕ ОПИСАНИЕ
            new Entity\TextField('ROOT_DESCRIPTION', array(
                'required' => true,
            )),


            
        );
    }


}