<?php
defined('B_PROLOG_INCLUDED') || die;

use TDBookmarks\Entity\BookmarksTable;
use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

class td_bookmarks extends CModule
{
    const MODULE_ID = 'td_bookmarks';
    var $MODULE_ID = self::MODULE_ID;
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;
    var $strError = '';

    function __construct()
    {
        $arModuleVersion = array();
        include(dirname(__FILE__) . '/version.php');
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        $this->MODULE_NAME = Loc::getMessage('TDB_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('TDB_MODULE_DESCRIPTION');
        $this->PARTNER_NAME = Loc::getMessage('TDB_MODULE_PARTNER_NAME');
        $this->PARTNER_URI = Loc::getMessage('TDB_MODULE_PARTNER_URI');
    }

    function DoInstall()
    {
        ModuleManager::registerModule(self::MODULE_ID);

        $this->InstallDB();
        $this->InstallFiles();
        // $this->InstallEvents();
    }

    function DoUninstall()
    {
        // $this->UnInstallEvents();
        $this->UnInstallFiles();
        $this->UnInstallDB();

        ModuleManager::unRegisterModule(self::MODULE_ID);
    }

    function InstallDB()
    {
        Loader::includeModule(self::MODULE_ID);

        $db = Application::getConnection();

        $bookmarksEntity = BookmarksTable::getEntity();
        if (!$db->isTableExists($bookmarksEntity->getDBTableName())) {
            $bookmarksEntity->createDbTable();
        }
    }

    function UnInstallDB()
    {
        Loader::includeModule(self::MODULE_ID);

        $db = Application::getConnection();

        $bookmarksEntity = BookmarksTable::getEntity();
        if ($db->isTableExists($bookmarksEntity->getDBTableName())) {
            $db->dropTable($bookmarksEntity->getDBTableName());
        }
    }


    function InstallFiles()
    {
        $documentRoot = Application::getDocumentRoot();
        
        CopyDirFiles(
            __DIR__ . '/files/components',
            $documentRoot . '/local/components/',
            true,
            true
        );

        CopyDirFiles(
            __DIR__ . '/files/pub',
            $documentRoot,
            true,
            true
        );

        CUrlRewriter::Add(array(
            'CONDITION' => '#^/bookmarks/#',
            'RULE' => '',
            'ID' => 'td:bookmarks',
            'PATH' => '/bookmarks/index.php',
        ));
    }

    function UnInstallFiles()
    {
        DeleteDirFilesEx('/local/components/td/');

        CUrlRewriter::Delete(array(
            'ID' => 'td:bookmarks',
            'PATH' => '/bookmarks/index.php',
        ));
    }
}