<?
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Config as Conf;
use \Bitrix\Main\Config\Option;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Entity\Base;
use \Bitrix\Main\Application;

require($_SERVER["DOCUMENT_ROOT"]."/local/modules/relink.table/lib/table.php");

IncludeModuleLangFile(__FILE__);
Class relink_table extends CModule
{
	const MODULE_ID = 'relink.table';
	var $MODULE_ID = 'relink.table'; 
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME = 'Загрузка перелинковки';
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $strError = '';
        
        var $exclusionAdminFiles;

	function __construct()
	{
            $this->exclusionAdminFiles=array(
            '..',
            '.',
            'menu.php',
            'operation_description.php',
            'task_description.php'
        );
		$arModuleVersion = array();
		include(dirname(__FILE__)."/version.php");
		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		$this->MODULE_NAME = GetMessage("relink.table_MODULE_NAME");
		$this->MODULE_DESCRIPTION = GetMessage("relink.table_MODULE_DESC");
		$this->PARTNER_URI = GetMessage("relink.table_PARTNER_URI");
                
                $this->MODULE_CSS = '/local/modules/'.$this->MODULE_ID.'/css/style.css';
	}
        
        //Определяем место размещения модуля
    public function GetPath($notDocumentRoot=false)
    {
        if($notDocumentRoot)
            return str_ireplace(Application::getDocumentRoot(),'',dirname(__DIR__));
        else
            return dirname(__DIR__);
    }

	function InstallDB($arParams = array())
	{
		
                
                 Loader::includeModule(self::MODULE_ID);

                if(!Application::getConnection(\Relink\Table\LinksTable::getConnectionName())->isTableExists(
                    Base::getInstance('\Relink\Table\LinksTable')->getDBTableName()
                    )
                )
                {
                    Base::getInstance('\Relink\Table\LinksTable')->createDbTable();
                }
                
               
                
               
	}

	function UnInstallDB($arParams = array())
	{
		
                
                Loader::includeModule(self::MODULE_ID);

                Application::getConnection(\Relink\Table\LinksTable::getConnectionName())->
                    queryExecute('drop table if exists '.Base::getInstance('\Relink\Table\LinksTable')->getDBTableName());
			
		Option::delete(self::MODULE_ID);
                
                
                
               
	}

	function InstallEvents()
	{
		return true;
	}

	function UnInstallEvents()
	{
		return true;
	}

	function InstallFiles($arParams = array())
	{
        

        if (\Bitrix\Main\IO\Directory::isDirectoryExists($path = $this->GetPath() . '/admin'))
        {
            CopyDirFiles($this->GetPath() . "/install/admin/", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin"); //если есть файлы для копирования
            
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
                \Bitrix\Main\ModuleManager::registerModule(self::MODULE_ID);
		$this->InstallFiles();
		$this->InstallDB();
		
	}

	function DoUninstall()
	{
		global $APPLICATION;
		
		$this->UnInstallDB();
		$this->UnInstallFiles();
                \Bitrix\Main\ModuleManager::unRegisterModule(self::MODULE_ID);
	}
}
?>
