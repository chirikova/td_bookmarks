<?php
defined('B_PROLOG_INCLUDED') || die;

use Bitrix\Main\Localization\Loc;

/** @var CBitrixComponentTemplate $this */

$bookmarkID = $APPLICATION->IncludeComponent(
	"td:bookmark.detail",
	"",
	Array(
        'BOOKMARKS_ID' => $arResult['VARIABLES']['BOOKMARKS_ID']
	),
	$component
);