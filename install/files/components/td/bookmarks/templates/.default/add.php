<?php
defined('B_PROLOG_INCLUDED') || die;

use Bitrix\Main\Localization\Loc;


/** @var CBitrixComponentTemplate $this */

$urlTemplates = array(
    'LIST' => $arResult['SEF_FOLDER'],
    'DETAIL' => $arResult['SEF_FOLDER'] . $arResult['SEF_URL_TEMPLATES']['details'],
    'ADD' => $arResult['SEF_FOLDER'] . $arResult['SEF_URL_TEMPLATES']['add'],
    'EXPORT' => $arResult['SEF_FOLDER'] . $arResult['SEF_URL_TEMPLATES']['export'],
);
$bookmarkID = $APPLICATION->IncludeComponent(
	"td:bookmark.add",
	"",
	Array(
        "SEF_URL" => $urlTemplates
	),
	$component
);