<?php
defined('B_PROLOG_INCLUDED') || die;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

/** @var CBitrixComponentTemplate $this */

?>
<div class="bookmark">
    <div class="bookmark__field">
        <strong><?=Loc::getMessage('TDB_FIELD_DATE')?>:</strong> <?=$arResult['BOOKMARK']['DATE_CREATE']?>
    </div>
    <div class="bookmark__field">
        <strong>Favicon:</strong> <img src="<?=$arResult['BOOKMARK']['FAVICON']?>">
    </div>
    <div class="bookmark__field">
        <strong>URL:</strong> <a href="<?=$arResult['BOOKMARK']['URL']?>"><?=$arResult['BOOKMARK']['URL']?></a>
    </div>
    <div class="bookmark__field">
        <strong><?=Loc::getMessage('TDB_FIELD_NAME')?>:</strong> <?=$arResult['BOOKMARK']['NAME']?>
    </div>
    <div class="bookmark__field">
        <strong><?=Loc::getMessage('TDB_FIELD_TITLE')?>:</strong> <?=$arResult['BOOKMARK']['TITLE']?>
    </div>
    <div class="bookmark__field">
        <strong><?=Loc::getMessage('TDB_FIELD_KEYWORDS')?>:</strong> <?=$arResult['BOOKMARK']['META_KEYWORDS']?>
    </div>
    <div class="bookmark__field">
        <strong><?=Loc::getMessage('TDB_FIELD_DESCRIPTION')?>:</strong> <?=$arResult['BOOKMARK']['META_DESCRIPTION']?>
    </div>
</div>
<?