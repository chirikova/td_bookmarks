<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Localization\Loc;

$arComponentDescription = array(
	"NAME" => Loc::getMessage("TDB_BOOKMARKS_NAME"),
	"DESCRIPTION" => Loc::getMessage("TDB_BOOKMARKS_DESCRIPTION"),
	"COMPLEX" => "Y",
	"PATH" => array(
		"ID" => "TDB",
		"NAME" => Loc::getMessage("TDB_GROUP_NAME")
	),
);

?>