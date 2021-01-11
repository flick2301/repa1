<?
/**
 * Created by Webcreature.
 * User: Denis Chuchumashev
 * www.webcreature.ru
 * Date: 13.04.2018
 * Time: 9:18
 */


use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Config as Conf;
use \Bitrix\Main\Config\Option;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Entity\Base;
use \Bitrix\Main\Application;

Loc::loadMessages(__FILE__);

Class webcreature_dsearch extends CModule
{
	
var $exclusionAdminFiles;
	
	function __construct()
	{
		$arModuleVersion = array();
		include(__DIR__."/version.php");
		
        $this->exclusionAdminFiles=array(
            '..',
            '.',
            'menu.php',
            'operation_description.php',
            'task_description.php'
        );			

        $this->MODULE_ID = 'webcreature.dsearch';
		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		$this->MODULE_NAME = Loc::getMessage("WEBCREATURE_DSEARCH_MODULE_NAME");
		$this->MODULE_DESCRIPTION = Loc::getMessage("WEBCREATURE_DSEARCH_MODULE_DESC");

		$this->PARTNER_NAME = Loc::getMessage("WEBCREATURE_DSEARCH_PARTNER_NAME");
		$this->PARTNER_URI = Loc::getMessage("WEBCREATURE_DSEARCH_PARTNER_URI");
	}

    //Определяем место размещения модуля
    public function GetPath($notDocumentRoot=false)
    {
        if($notDocumentRoot)
            return str_ireplace($_SERVER["DOCUMENT_ROOT"],'',dirname(__DIR__));
        else
            return dirname(__DIR__);
    }

    //Проверяем что система поддерживает D7
    public function isVersionD7()
    {
        return CheckVersion(\Bitrix\Main\ModuleManager::getVersion('main'), '14.00.00');
    }

    function InstallDB()
    {
        Loader::includeModule($this->MODULE_ID);
		
        if(!Application::getConnection(\Webcreature\Dsearch\StatTable::getConnectionName())->isTableExists(
            Base::getInstance('\Webcreature\Dsearch\StatTable')->getDBTableName()
            )
        )
        {
            Base::getInstance('\Webcreature\Dsearch\StatTable')->createDbTable();
        }		
    }

    function UnInstallDB()
    {
        Loader::includeModule($this->MODULE_ID);

        Application::getConnection(\Webcreature\Dsearch\StatTable::getConnectionName())->
            queryExecute('drop table if exists '.Base::getInstance('\Webcreature\Dsearch\StatTable')->getDBTableName());

        Option::delete($this->MODULE_ID);
    }

	function InstallEvents()
	{
        \Bitrix\Main\EventManager::getInstance()->registerEventHandler('webcreature.dsearch', '\Webcreature\Dsearch\Stat::OnBeforeAdd', $this->MODULE_ID, '\Webcreature\Dsearch\Event', 'eventHandler');
	}

	function UnInstallEvents()
	{
        \Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler('webcreature.dsearch', '\Webcreature\Dsearch\Stat::OnBeforeAdd', $this->MODULE_ID, '\Webcreature\Dsearch\Event', 'eventHandler');
	}

	function InstallFiles()
	{
        $path=$this->GetPath()."/install/components";

        if(\Bitrix\Main\IO\Directory::isDirectoryExists($path))
            CopyDirFiles($path, $_SERVER["DOCUMENT_ROOT"]."/bitrix/components", true, true);
        else
            throw new \Bitrix\Main\IO\InvalidPathException($path);

        if (\Bitrix\Main\IO\Directory::isDirectoryExists($path = $this->GetPath() . '/admin'))
        {
            CopyDirFiles($this->GetPath() . "/install/admin/", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin"); //если есть файлы для копирования
            if ($dir = opendir($path))
            {
                while (false !== $item = readdir($dir))
                {
                    if (in_array($item,$this->exclusionAdminFiles))
                        continue;
                    file_put_contents($_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.$this->MODULE_ID.'_'.$item,
                        '<'.'? require($_SERVER["DOCUMENT_ROOT"]."'.$this->GetPath(true).'/admin/'.$item.'");?'.'>');
                }
                closedir($dir);
            }
        }

        return true;
	}

	function UnInstallFiles()
	{
        \Bitrix\Main\IO\Directory::deleteDirectory($_SERVER["DOCUMENT_ROOT"] . '/bitrix/components/webcreature/dsearch/');
		\Bitrix\Main\IO\Directory::deleteDirectory($_SERVER["DOCUMENT_ROOT"] . '/bitrix/components/webcreature/dsearch.ajax/');

        if (\Bitrix\Main\IO\Directory::isDirectoryExists($path = $this->GetPath() . '/admin')) {
            DeleteDirFiles($_SERVER["DOCUMENT_ROOT"] . $this->GetPath() . '/install/admin/', $_SERVER["DOCUMENT_ROOT"] . '/bitrix/admin');
            if ($dir = opendir($path)) {
                while (false !== $item = readdir($dir)) {
                    if (in_array($item, $this->exclusionAdminFiles))
                        continue;
                    \Bitrix\Main\IO\File::deleteFile($_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/' . $this->MODULE_ID . '_' . $item);
                }
                closedir($dir);
            }
        }
		return true;
	}

	function DoInstall()
	{
		global $APPLICATION;
        if($this->isVersionD7())
        {
            \Bitrix\Main\ModuleManager::registerModule($this->MODULE_ID);

            $this->InstallDB();
            $this->InstallEvents();
            $this->InstallFiles();

            #работа с .settings.php
            $configuration = Conf\Configuration::getInstance();
            $academy_module_d7=$configuration->get('academy_module_d7');
            $academy_module_d7['install']=$academy_module_d7['install']+1;
            $configuration->add('academy_module_d7', $academy_module_d7);
            $configuration->saveConfiguration();
            #работа с .settings.php
        }
        else
        {
            $APPLICATION->ThrowException(Loc::getMessage("WEBCREATURE_DSEARCH_INSTALL_ERROR_VERSION"));
        }
		
		$APPLICATION->IncludeAdminFile(Loc::getMessage("WEBCREATURE_DSEARCH_INSTALL_TITLE"), $this->GetPath()."/install/step.php");
	}

	function DoUninstall()
	{
        global $APPLICATION;

        $context = Application::getInstance()->getContext();
        $request = $context->getRequest();
		
        if($request["step"]<2)
        {
            $APPLICATION->IncludeAdminFile(Loc::getMessage("WEBCREATURE_DSEARCH_UNINSTALL_TITLE"), $this->GetPath()."/install/unstep1.php");
        }
        elseif($request["step"]==2)
        {
            $this->UnInstallFiles();
			$this->UnInstallEvents();

            if($request["savedata"] != "Y")
                $this->UnInstallDB();

            \Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);

            

            $APPLICATION->IncludeAdminFile(Loc::getMessage("POL_GENERATOR_UNINSTALL_TITLE"), $this->GetPath()."/install/unstep2.php");
        }	
	}
}
?>