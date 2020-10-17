<?php
defined('B_PROLOG_INCLUDED') || die;

use Bitrix\Main\Localization\Loc,
    Bitrix\Main\Application;


/** @var CBitrixComponentTemplate $this */

$context = Application::getInstance()->getContext();
$request = $context->getRequest();
$sort_order = $request->get("sort") ? : $arParams["SORT_ORDER"];
$sort_by = $request->get("by") ? : $arParams["SORT_BY"];

$urlTemplates = array(
    'LIST' => $arResult['SEF_FOLDER'],
    'DETAIL' => $arResult['SEF_FOLDER'] . $arResult['SEF_URL_TEMPLATES']['details'],
    'ADD' => $arResult['SEF_FOLDER'] . $arResult['SEF_URL_TEMPLATES']['add'],
    'EXPORT' => $arResult['SEF_FOLDER'] . $arResult['SEF_URL_TEMPLATES']['export'],
);

$APPLICATION->IncludeComponent(
	"td:bookmarks.list",
	"",
	Array(
        "SORT_ORDER" => $sort_order,
        "SORT_BY" => $sort_by,
        "BOOKMARKS_COUNT" => $arParams["BOOKMARKS_COUNT"],
        "SEF_MODE" => $arParams["SEF_MODE"],
        "SEF_URL" => $urlTemplates
	),
	$component
);