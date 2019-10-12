<?php
namespace Pol\Generator\Rules;

use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

class RulesTable extends Entity\DataManager
{
	public static function getFilePath()
	{
		return __FILE__;
	}

	public static function getTableName()
	{
		return 'generator_rules';
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
            'ID_SECTION' => array(
				'data_type' => 'integer',
				'title' => 'ID Шаблона',
			),
			
			//Название товара
           'NAME' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateName'),
				'title' => 'Название товара',
			),
			
			
			//КАРТОЧКА ТОВАРА
			
			//Title
           'ELEMENT_META_TITLE' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateName'),
				'title' => 'Title товара',
			),
			
			//Keywords
           'ELEMENT_META_KEYWORDS' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateName'),
				'title' => 'Keywords товара',
			),
			
			//Description товара
           'ELEMENT_META_DESCRIPTION' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateName'),
				'title' => 'Description товара',
			),
			
			//Alt товара
           'ELEMENT_DETAIL_PICTURE_FILE_ALT' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateName'),
				'title' => 'Alt товара',
			),
			
			//Title_pic товара
           'ELEMENT_DETAIL_PICTURE_FILE_TITLE' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateName'),
				'title' => 'Title_pic товара',
			),
			
			
			//КАТАЛОГ ПРОДУКЦИИ
			
			
            //Title каталога
           'SECTION_META_TITLE' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateName'),
				'title' => 'Title каталога',
			),
			//Keywords каталога
           'SECTION_META_KEYWORDS' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateName'),
				'title' => 'Keywords каталога',
			),
			//Description каталога
           'SECTION_META_DESCRIPTION' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateName'),
				'title' => 'Description каталога',
			),
						
			
			//МИНИ-КАРТОЧКА ТОВАРА
			
			//Alt мини-карточки
           'ELEMENT_PREVIEW_PICTURE_FILE_ALT' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateName'),
				'title' => 'Alt мини-карточки',
			),
			//Title_pic мини-карточки
           'ELEMENT_PREVIEW_PICTURE_FILE_TITLE' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateName'),
				'title' => 'Title_pic мини-карточки',
			),
			//Title_href мини-карточки
           'TITLE_HREF_MINI_CART' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateName'),
				'title' => 'Title_href мини-карточки',
			),
			
			//Меню разделов и хлебные крошки
			
			//Title Меню разделов
           'TITLE_MENU' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateName'),
				'title' => 'Title Меню разделов',
			),
			
			//ШАПКА
			//Alt лого
			'ALT_LOGO' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateName'),
				'title' => 'Alt лого',
			),
            //ДОПОЛНИТЕЛЬНЫЕ ПОЛЯ В КАРТОЧКАХ(не СЕО)
             'ROOT_NAME' => array(
                 'data_type' => 'string',
                 'validation' => array(__CLASS__, 'validateName'),
                 'title' => 'Дополнительное название',
             ),

             'ROOT_DESCRIPTION' => array(
                 'data_type' => 'text',
                // 'validation' => array(__CLASS__, 'validateName'),
                 'title' => 'Дополнительное описание',
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