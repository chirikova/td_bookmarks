<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Закладки");
?><?$APPLICATION->IncludeComponent(
	"td:bookmarks",
	"",
	Array(
		"BOOKMARKS_COUNT" => "4",
		"SEF_FOLDER" => "/bookmarks/",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => Array("add"=>"add/","export"=>"export/","details"=>"bookmark/#BOOKMARKS_ID#/"),
		"SORT_BY" => "ASC",
		"SORT_ORDER" => "URL"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>