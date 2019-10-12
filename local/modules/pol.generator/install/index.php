<?


use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Config as Conf;
use \Bitrix\Main\Config\Option;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Entity\Base;
use \Bitrix\Main\Application;

Loc::loadMessages(__FILE__);
Class pol_generator extends CModule
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

        $this->MODULE_ID = 'pol.generator';
	$this->MODULE_VERSION = $arModuleVersion["VERSION"];
	$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
	$this->MODULE_NAME = Loc::getMessage("POL_GENERATOR_MODULE_NAME");
	$this->MODULE_SORT = 1;
        $this->SHOW_SUPER_ADMIN_GROUP_RIGHTS='Y';
        $this->MODULE_GROUP_RIGHTS = "Y";
	}

    //Определяем место размещения модуля
    public function GetPath($notDocumentRoot=false)
    {
        if($notDocumentRoot)
            return str_ireplace(Application::getDocumentRoot(),'',dirname(__DIR__));
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

        if(!Application::getConnection(\Pol\Generator\GeneratorTable::getConnectionName())->isTableExists(
            Base::getInstance('\Pol\Generator\GeneratorTable')->getDBTableName()
            )
        )
        {
            Base::getInstance('\Pol\Generator\GeneratorTable')->createDbTable();
        }
        
        if(!Application::getConnection(\Pol\Generator\Agent\AgentTable::getConnectionName())->isTableExists(
            Base::getInstance('\Pol\Generator\Agent\AgentTable')->getDBTableName()
            )
        )
        {
            Base::getInstance('\Pol\Generator\Agent\AgentTable')->createDbTable();
        }
		
	if(!Application::getConnection(\Pol\Generator\Rules\RulesTable::getConnectionName())->isTableExists(
            Base::getInstance('\Pol\Generator\Rules\RulesTable')->getDBTableName()
            )
        )
        {
            Base::getInstance('\Pol\Generator\Rules\RulesTable')->createDbTable();
        }
        
        if(!Application::getConnection(\Pol\Generator\Logs\LogsTable::getConnectionName())->isTableExists(
            Base::getInstance('\Pol\Generator\Logs\LogsTable')->getDBTableName()
            )
        )
        {
            Base::getInstance('\Pol\Generator\Logs\LogsTable')->createDbTable();
        }

        
    }

    function UnInstallDB()
    {
        Loader::includeModule($this->MODULE_ID);

        Application::getConnection(\Pol\Generator\GeneratorTable::getConnectionName())->
            queryExecute('drop table if exists '.Base::getInstance('\Pol\Generator\GeneratorTable')->getDBTableName());
			
			Application::getConnection(\Pol\Generator\Rules\RulesTable::getConnectionName())->
            queryExecute('drop table if exists '.Base::getInstance('\Pol\Generator\Rules\RulesTable')->getDBTableName());
                        
                        Application::getConnection(\Pol\Generator\Agent\AgentTable::getConnectionName())->
            queryExecute('drop table if exists '.Base::getInstance('\Pol\Generator\Agent\AgentTable')->getDBTableName());
                        
                        
                        Application::getConnection(\Pol\Generator\Logs\LogsTable::getConnectionName())->
            queryExecute('drop table if exists '.Base::getInstance('\Pol\Generator\Logs\LogsTable')->getDBTableName());

        

        Option::delete($this->MODULE_ID);
    }

	function InstallEvents()
	{
        \Bitrix\Main\EventManager::getInstance()->registerEventHandler($this->MODULE_ID, 'TestEventGenerator', $this->MODULE_ID, '\Pol\Generator\Event', 'eventHandler');
	}

	function UnInstallEvents()
	{
        \Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler($this->MODULE_ID, 'TestEventGenerator', $this->MODULE_ID, '\Pol\Generator\Event', 'eventHandler');
	}

	function InstallFiles($arParams = array())
	{
        

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
            CAgent::AddAgent(
                "\Pol\Generator\Generation::agent_generator();",  // имя функции
                "pol.generator",                // идентификатор модуля
                "N",                      // агент не критичен к кол-ву запусков
                86400,                    // интервал запуска - 1 сутки
                "",                       // дата первой проверки - текущее
                "Y",                      // агент активен
                "",                       // дата первого запуска - текущее
                30
            );

           
        }
        else
        {
            $APPLICATION->ThrowException(Loc::getMessage("POL_GENERATOR_INSTALL_ERROR_VERSION"));
        }

        $APPLICATION->IncludeAdminFile(Loc::getMessage("POL_GENERATOR_INSTALL_TITLE"), $this->GetPath()."/install/step.php");
	}

	function DoUninstall()
	{
        global $APPLICATION;

        $context = Application::getInstance()->getContext();
        $request = $context->getRequest();
        CAgent::RemoveModuleAgents("pol.generator");
        
        if($request["step"]<2)
        {
            $APPLICATION->IncludeAdminFile("Удаление модуля", $this->GetPath()."/install/unstep1.php");
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