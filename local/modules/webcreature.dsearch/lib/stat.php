<?php
/**
 * Created by Webcreature.
 * User: Denis Chuchumashev
 * www.webcreature.ru
 * Date: 13.04.2018
 * Time: 9:18
 */

namespace Webcreature\Dsearch;

use \Bitrix\Main\Entity;
use \Bitrix\Main\Type;

class StatTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'stat_dsearch';
    }

    public static function getUfId()
    {
        return 'STAT_DSEARCH';
    }

    /*public static function getConnectionName()
    {
        return 'default';
    }*/

    public static function getMap()
    {
        return array(
            //ID
            new Entity\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
            )),
            //Запрос
            new Entity\StringField('NAME', array(
                'required' => true,
            )),
            //Дата и время
            new Entity\DatetimeField('DATE', array(
                'required' => true,
				'column_name' => 'DATETIME',
                'default_value' => new Type\DateTime
            )),
			//UserID
            new Entity\IntegerField('USER_ID', array(
            )),	
			//UserNAME
            new Entity\StringField('USER_NAME', array(
            )),				
			//IP
            new Entity\StringField('IP', array(
            )),
            new Entity\StringField('COMMENT', array(
            )),
        );
    }

	    //Определяем место размещения модуля
    public function GetPath($notDocumentRoot=false)
    {
        if($notDocumentRoot)
            return str_ireplace($_SERVER["DOCUMENT_ROOT"],'',dirname(__DIR__));
        else
            return dirname(__DIR__);
    }
}