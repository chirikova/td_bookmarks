<?php

namespace TDBookmarks\Entity;

use Bitrix\Main\Entity,
    Bitrix\Main\Entity\DataManager,
    Bitrix\Main\Type;

class BookmarksTable extends DataManager
{
    public static function getTableName()
    {
        return 'td_bookmark';
    }

    public static function getMap()
    {
        return array(
            new Entity\IntegerField('ID', array('primary' => true, 'autocomplete' => true)),
            new Entity\StringField('NAME'),
            new Entity\DatetimeField('DATE_CREATE', array('default_value' => new Type\Datetime)),
            new Entity\StringField('URL'),
            new Entity\TextField('FAVICON'),
            new Entity\TextField('TITLE'),
            new Entity\TextField('META_KEYWORDS'),
            new Entity\TextField('META_DESCRIPTION'),

        );
    }
}
