<?php
defined('B_PROLOG_INCLUDED') || die;

use TDBookmarks\Entity\BookmarksTable,
    Bitrix\Main\Loader,
    Bitrix\Main\Localization\Loc,
    Bitrix\Main\UI\PageNavigation;

class TDBookmarksListComponent extends CBitrixComponent
{
    public function __construct(CBitrixComponent $component = null)
    {
        parent::__construct($component);
    }

    public function executeComponent()
    {
        if (!Loader::includeModule('td_bookmarks')) {
            ShowError(Loc::getMessage('TDB_NO_MODULE'));
            return;
        }

        $sort = array($this->arParams['SORT_ORDER'] => $this->arParams['SORT_BY']);

        $nav = new PageNavigation("");
        $nav->allowAllRecords(true)
            ->setPageSize($this->arParams['BOOKMARKS_COUNT'])
            ->initFromUri();

        $dbBookmarks = BookmarksTable::getList(array(
            "filter" => array(),
            "order" => $sort,
            "count_total" => true,
            "offset" => $nav->getOffset(),
            "limit" => $nav->getLimit(),
        ));

        while($bookmark = $dbBookmarks->fetch()) {
			$bookmark["~DETAIL_URL"] = CComponentEngine::MakePathFromTemplate($this->arParams["SEF_URL"]['DETAIL'],
				array("BOOKMARKS_ID" => $bookmark["ID"]));
			$bookmark["DETAIL_URL"] = htmlspecialcharsbx($bookmark["~DETAIL_URL"]);
            $bookmarks[] = $bookmark;
        }

        $nav->setRecordCount($dbBookmarks->getCount());

        $this->arResult = array(
            'BOOKMARKS' => $bookmarks,
            'PAGINATION' => $nav,
            'SORT' => $sort
        );

        $this->includeComponentTemplate();
    }
}