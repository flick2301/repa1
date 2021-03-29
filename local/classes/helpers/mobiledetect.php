<?php
 
namespace Olepro\Classes\Helpers;
 
require $_SERVER['DOCUMENT_ROOT'] . '/local/classes/inc/Mobile_Detect.php';
 
class MobileDetect extends \Mobile_Detect {
 
    /** @var \Mobile_Detect */
    protected static $instance;
 
    /**
     * @return \Mobile_Detect
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
 
        return self::$instance;
    }
 
}