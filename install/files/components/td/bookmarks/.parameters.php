<?php
defined('B_PROLOG_INCLUDED') || die;

use Bitrix\Main\Localization\Loc;

$arSorts = Array("ASC"=>Loc::getMessage("TDB_SORT_DESC"), "DESC"=>Loc::getMessage("TDB_SORT_ASC"));
$arSortFields = Array(
		"URL"=>Loc::getMessage("TDB_SORT_URL"),
		"NAME"=>Loc::getMessage("TDB_SORT_NAME"),
		"DATE_CREATE"=>Loc::getMessage("TDB_SORT_DATE_CREATE")
    );
    
$arComponentParameters = array(
    'PARAMETERS' => array(
        'SEF_MODE' => array(
            'details' => array(
                'NAME' => Loc::getMessage('TDB_DETAIL_URL_TEMPLATE'),
                'DEFAULT' => 'bookmark/#BOOKMARKS_ID#/',
                'VARIABLES' => array('BOOKMARKS_ID')
            ),
            'add' => array(
                'NAME' => Loc::getMessage('TDB_ADD_URL_TEMPLATE'),
                'DEFAULT' => 'add/'
            )
        ),
		"BOOKMARKS_COUNT" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => Loc::getMessage("TDB_COUNT"),
			"TYPE" => "STRING",
			"DEFAULT" => "4",
		),
		"SORT_ORDER" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => Loc::getMessage("TDB_SORT_ORDER"),
			"TYPE" => "LIST",
			"DEFAULT" => "DESC",
			"VALUES" => $arSortFields,
		),
		"SORT_BY" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => Loc::getMessage("TDB_SORT_BY"),
			"TYPE" => "LIST",
			"DEFAULT" => "SORT",
			"VALUES" => $arSorts,
		),
    )
);
