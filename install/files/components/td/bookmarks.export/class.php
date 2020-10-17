<?php
defined('B_PROLOG_INCLUDED') || die;

use TDBookmarks\Entity\BookmarksTable,
    Bitrix\Main\Loader,
    Bitrix\Main\Localization\Loc;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class TDBookmarksListComponent extends CBitrixComponent
{
    private static  $arCols = array();

    public function __construct(CBitrixComponent $component = null)
    {
        parent::__construct($component);
        self::$arCols['A'] = 'URL';
        self::$arCols['B'] = 'DATE_CREATE';
        self::$arCols['C'] = 'NAME';
        self::$arCols['D'] = 'FAVICON';
        self::$arCols['E'] = 'TITLE';
        self::$arCols['F'] = 'META_KEYWORDS';
        self::$arCols['G'] = 'META_DESCRIPTION';
    }

    public function executeComponent()
    {
        global $APPLICATION;
        if (!Loader::includeModule('td_bookmarks')) {
            ShowError(Loc::getMessage('TDB_NO_MODULE'));
            return;
        }

        $sort = array($this->arParams['SORT_ORDER'] => $this->arParams['SORT_BY']);

        $dbBookmarks = BookmarksTable::getList(array(
            "filter" => array(),
            "count_total" => true,
            "order" => $sort
        ));
        if ( $dbBookmarks) {
            $APPLICATION->RestartBuffer();
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $i = 1;
            foreach (self::$arCols as $col => $field) {
                $title = Loc::getMessage("TDB_COL_".$field);
                $sheet->setCellValue($col.$i, $title);
            }

            while($bookmark = $dbBookmarks->fetch()) {
                $i++;
                foreach (self::$arCols as $col => $field) {
                    $value = $bookmark[$field];
                    $sheet->setCellValue($col.$i, $value);
                }
            }
            $writer = new Xlsx($spreadsheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="file.xlsx"');
            $writer->save("php://output");
            die();
        }
    }
}