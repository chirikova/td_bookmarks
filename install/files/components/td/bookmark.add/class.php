<?php
defined('B_PROLOG_INCLUDED') || die;

use TDBookmarks\Entity\BookmarksTable,
    Bitrix\Main\Context,
    Bitrix\Main\Error,
    Bitrix\Main\ErrorCollection,
    Bitrix\Main\Loader,
    Bitrix\Main\Localization\Loc;

class TDBookmarksAddComponent extends CBitrixComponent
{
    const FORM_ID = 'TDB_ADD';

    private $errors;

    public function __construct(CBitrixComponent $component = null)
    {
        parent::__construct($component);

        $this->errors = new ErrorCollection();
    }

    public function executeComponent()
    {
        global $APPLICATION;

        if (!Loader::includeModule('td_bookmarks')) {
            ShowError(Loc::getMessage('TDB_NO_MODULE'));
            return;
        }

        $APPLICATION->SetTitle(Loc::getMessage('TDB_TITLE_DEFAULT'));

        if (self::formSubmitted()) {
            $savedBookmarkId = $this->processSave();
            if ($savedBookmarkId > 0) {
                LocalRedirect($this->getRedirectUrl($savedBookmarkId));
            }
        }

        $this->arResult =array(
            'FORM_ID' => self::FORM_ID,
            'BACK_URL' => $this->getRedirectUrl(),
            'ERRORS' => $this->errors,
        );

        $this->includeComponentTemplate();
    }

    private function processSave()
    {
        $context = Context::getCurrent();
        $request = $context->getRequest();
        $url = $request->get('URL');
        
        $this->errors = self::validateURL($url);

        if (!$this->errors->isEmpty()) {
            return false;
        }

        $bookmark = self::getBookmark($url);

        if (is_array($bookmark)) {
            $bookmark['URL'] = $url;
            $result = BookmarksTable::add($bookmark);
        }

        if (!$result->isSuccess()) {
            $this->errors->add($result->getErrors());
        }

        return $result->isSuccess() ? $result->getId() : false;
    }

    private static function formSubmitted()
    {
        $context = Context::getCurrent();
        $request = $context->getRequest();
        $add_bookmark = $request->getPost('add_bookmark');
        return !empty($add_bookmark);
    }

    private function getBookmark($url)
    {
        $doc = new DOMDocument();
        $doc->strictErrorChecking = FALSE;
        $doc->loadHTML(file_get_contents($url));

        $xml = simplexml_import_dom($doc);
        $favicon = $xml->xpath('//link[@rel="shortcut icon"]');
        if (!$favicon) {
            $arUrl = parse_url($url);
            $bookmark['FAVICON'] = $arUrl['scheme'].'://'.$arUrl['host'].'/favicon.ico';
        }else {
            if (filter_var($favicon[0]['href'], FILTER_VALIDATE_URL))
                $bookmark['FAVICON'] = $favicon[0]['href'];
            else {
                $arUrl = parse_url($url);
                $bookmark['FAVICON'] = $arUrl['scheme'].'://'.$arUrl['host'].$favicon[0]['href'];
            }
        }

        $title = $doc->getElementsByTagName("title");
        if ($title->length > 0) {
            $bookmark['TITLE'] = $title->item(0)->textContent;
        }

        $h1 = $doc->getElementsByTagName("h1");
        if ($h1->length > 0) {
            $bookmark['NAME'] = $h1->item(0)->textContent;
        }else {
            $bookmark['NAME'] = $bookmark['TITLE'];
        }

        $arMeta = $doc->getElementsByTagName('meta');
        foreach ($arMeta as $meta) {
            if (strtolower($meta->getAttribute('name')) == 'description') {
                $bookmark['META_DESCRIPTION'] = $meta->getAttribute('content');
            }
            if (strtolower($meta->getAttribute('name')) == 'keywords') {
                $bookmark['META_KEYWORDS'] = $meta->getAttribute('content');
            }
        }
        return $bookmark;
    }

    private static function validateURL($url)
    {
        $errors = new ErrorCollection();

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            $errors->setError(new Error(Loc::getMessage('TDB_URL_NOT_VALID')));
        }

        if (empty($url)) {
            $errors->setError(new Error(Loc::getMessage('TDB_URL_EMPTY')));
        }

        $dbBookmarks = BookmarksTable::getList(array(
            "filter" => array('URL' => $url)
        ));
        if ($bookmarks = $dbBookmarks->fetch()) {
            $errors->setError(new Error(Loc::getMessage('TDB_URL_EXISTS')));
        }

        $headers = get_headers($url);
        if ($headers[0] != 'HTTP/1.1 200 OK') {
            $errors->setError(new Error(Loc::getMessage('TDB_URL_UNAVAILABLE')));
        }

        return $errors;
    }

    private function getRedirectUrl($savedBookmarkId = null)
    {
        $context = Context::getCurrent();
        $request = $context->getRequest();

        if (!empty($savedBookmarkId)) {
            return CComponentEngine::makePathFromTemplate(
                $this->arParams['SEF_URL']['DETAIL'],
                array('BOOKMARKS_ID' => $savedBookmarkId)
            );
        } 
    }
}