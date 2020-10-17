<?php
defined('B_PROLOG_INCLUDED') || die;

use Bitrix\Main\Loader,
    Bitrix\Main\Localization\Loc,
    Bitrix\Main\Application;


/** @var CBitrixComponentTemplate $this */

$context = Application::getInstance()->getContext();
$request = $context->getRequest();
$sort_order = $request->get("sort") ? : $arParams["SORT_ORDER"];
$sort_by = $request->get("by") ? : $arParams["SORT_BY"];
/** @var CBitrixComponentTemplate $this */

?>
<div class="bookmarks">
    <div class="bookmarks__controls">
        <div class="bookmarks__sort">
            <ul>
                <li><a href="<?=$arParams['SEF_URL']['LIST']?>?sort=URL&by=ASC" class="bookmarks__sort__link <?=($sort_order == 'URL' && $sort_by == 'ASC' ? ' selected' : '')?>"><?=Loc::getMessage('TDB_SORT_URL_ASC');?></a></li>
                <li><a href="<?=$arParams['SEF_URL']['LIST']?>?sort=URL&by=DESC" class="bookmarks__sort__link <?=($sort_order == 'URL' && $sort_by == 'DESC' ? ' selected' : '')?>"><?=Loc::getMessage('TDB_SORT_URL_DESC');?></a></li>
                <li><a href="<?=$arParams['SEF_URL']['LIST']?>?sort=NAME&by=ASC" class="bookmarks__sort__link <?=($sort_order == 'NAME' && $sort_by == 'ASC' ? ' selected' : '')?>"><?=Loc::getMessage('TDB_SORT_NAME_ASC');?></a></li>
                <li><a href="<?=$arParams['SEF_URL']['LIST']?>?sort=NAME&by=DESC" class="bookmarks__sort__link <?=($sort_order == 'NAME' && $sort_by == 'DESC' ? ' selected' : '')?>"><?=Loc::getMessage('TDB_SORT_NAME_DESC');?></a></li>
                <li><a href="<?=$arParams['SEF_URL']['LIST']?>?sort=DATE_CREATE&by=ASC" class="bookmarks__sort__link <?=($sort_order == 'DATE_CREATE' && $sort_by == 'ASC' ? ' selected' : '')?>"><?=Loc::getMessage('TDB_SORT_DATE_CREATE_ASC');?></a></li>
                <li><a href="<?=$arParams['SEF_URL']['LIST']?>?sort=DATE_CREATE&by=DESC" class="bookmarks__sort__link <?=($sort_order == 'DATE_CREATE' && $sort_by == 'DESC' ? ' selected' : '')?>"><?=Loc::getMessage('TDB_SORT_DATE_CREATE_DESC');?></a></li>
            </ul>
        </div>
        <div class="bookmarks__buttons">
            <a href="<?=$arParams['SEF_URL']['ADD']?>" class="bookmarks__buttons--add"><?=Loc::getMessage('TDB_ADD_BOOKMARK');?></a>
            <?
            if (count($arResult['BOOKMARKS']) > 0) {
                ?>
                <a href="<?=$arParams['SEF_URL']['EXPORT']?>" class="bookmarks__buttons--export"><?=Loc::getMessage('TDB_EXPORT_BOOKMARKS');?></a>
                <?
            }
            ?>
        </div>
    </div>
    <?
    if (count($arResult['BOOKMARKS']) > 0) 
    {
        ?>
        <div class="bookmarks__list">
            <?
            foreach($arResult['BOOKMARKS'] as $arItem) 
            {
                ?>
                <div class="bookmarks__list__item">
                    <div class="bookmark__title">
                        <a href="<?=$arItem['DETAIL_URL']?>"><?=Loc::getMessage('TDB_BOOKMARK_TITLE', array('#ID#' => $arItem['ID']))?></a>
                    </div>
                    <div class="bookmark__field">
                        <strong><?=Loc::getMessage('TDB_FIELD_DATE')?>:</strong> <?=$arItem['DATE_CREATE']?>
                    </div>
                    <div class="bookmark__field">
                        <strong>Favicon:</strong> <img src="<?=$arItem['FAVICON']?>">
                    </div>
                    <div class="bookmark__field">
                        <strong>URL:</strong> <a href="<?=$arItem['URL']?>"><?=$arItem['URL']?></a>
                    </div>
                    <div class="bookmark__field">
                        <strong><?=Loc::getMessage('TDB_FIELD_NAME')?>:</strong> <?=$arItem['NAME']?>
                    </div>
                </div>
                <?
            }
            ?>
        </div>
        <?
    }
    ?>
</div>
<?
if ($arResult['PAGINATION']) 
{
    $APPLICATION->IncludeComponent(
    "bitrix:main.pagenavigation",
    "",
    array(
        "NAV_OBJECT" => $arResult['PAGINATION'],
        "SEF_MODE" => $arParams['SEF_MODE'],
    ),
    false
    );
}