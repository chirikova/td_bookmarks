<?
defined('B_PROLOG_INCLUDED') || die;

require 'vendor/autoload.php';
\Bitrix\Main\Loader::registerAutoLoadClasses(
	"td_bookmarks",
	array(
		"TDBookmarks\Entity\BookmarksTable" => "lib/entity/bookmark.php",
    )
);