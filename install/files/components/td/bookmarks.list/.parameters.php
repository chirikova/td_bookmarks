<?php
defined('B_PROLOG_INCLUDED') || die;

use Bitrix\Main\Localization\Loc;

$arSorts = Array("ASC"=>GetMessage("TDB_SORT_DESC"), "DESC"=>GetMessage("TDB_SORT_ASC"));
$arSortFields = Array(
		"URL"=>GetMessage("TDB_SORT_URL"),
		"NAME"=>GetMessage("TDB_SORT_NAME"),
		"DATE_CREATE"=>GetMessage("TDB_SORT_DATE_CREATE")
    );
    
$arComponentParameters = array(
    'PARAMETERS' => array(
        'SEF_MODE' => array(
            'details' => array(
                'NAME' => Loc::getMessage('TDB_DETAIL_URL_TEMPLATE'),
                'DEFAULT' => '#BOOKMARKS_ID#/',
                'VARIABLES' => array('BOOKMARKS_ID')
            ),
            'edit' => array(
                'NAME' => Loc::getMessage('TDB_EDIT_URL_TEMPLATE'),
                'DEFAULT' => '#BOOKMARKS_ID#/edit/',
                'VARIABLES' => array('BOOKMARKS_ID')
            ),
            'add' => array(
                'NAME' => Loc::getMessage('TDB_ADD_URL_TEMPLATE'),
                'DEFAULT' => 'add/'
            )
        ),
		"BOOKMARKS_COUNT" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("TDB_COUNT"),
			"TYPE" => "STRING",
			"DEFAULT" => "4",
		),
		"SORT_ORDER" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("TDB_SORT_ORDER"),
			"TYPE" => "LIST",
			"DEFAULT" => "DESC",
			"VALUES" => $arSortFields,
		),
		"SORT_BY" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("TDB_SORT_BY"),
			"TYPE" => "LIST",
			"DEFAULT" => "SORT",
			"VALUES" => $arSorts,
		),
    )
);
