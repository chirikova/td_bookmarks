<?php
defined('B_PROLOG_INCLUDED') || die;

use TDBookmarks\Entity\BookmarksTable,
    Bitrix\Main\Loader,
    Bitrix\Main\Localization\Loc;

class TDBookmarsShowDetailComponent extends CBitrixComponent
{
    const FORM_ID = 'TDB_SHOW';

    public function __construct(CBitrixComponent $component = null)
    {
        parent::__construct($component);
    }

    public function executeComponent()
    {
        global $APPLICATION;

        $APPLICATION->SetTitle(Loc::getMessage('TDB_TITLE_DEFAULT'));

        if (!Loader::includeModule('td_bookmarks')) {
            ShowError(Loc::getMessage('TDB_NO_MODULE'));
            return;
        }
        $dbBookmark = BookmarksTable::getById($this->arParams['BOOKMARKS_ID']);
        if (!$bookmark = $dbBookmark->fetch()) {            
            ShowError(Loc::getMessage('TDB_NOT_FOUND'));
            return;
        }
        else {
            $APPLICATION->SetTitle(Loc::getMessage(
                'TDB_TITLE',
                array(
                    '#ID#' => $bookmark['ID'],
                    '#NAME#' => $bookmark['NAME']
                )
            ));

            $this->arResult = array(
                'BOOKMARK' => $bookmark
            );
            $this->includeComponentTemplate();
        }
    }
}