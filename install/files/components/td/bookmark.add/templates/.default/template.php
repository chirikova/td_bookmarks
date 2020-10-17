<?php
defined('B_PROLOG_INCLUDED') || die;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Error;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

/** @var CBitrixComponentTemplate $this */

/** @var ErrorCollection $errors */
$errors = $arResult['ERRORS'];

foreach ($errors as $error) {
    /** @var Error $error */
    ShowError($error->getMessage());
}
?>
<form action="" method="POST" enctype="multipart/form-data">
    <div><label for="url"><?=Loc::getMessage('TDB_URL_FIELD');?></label><input type="text" name="URL" id="url" required="required"></div>
    <input type="submit" name="add_bookmark" value="<?=Loc::getMessage('TDB_ADD_BOOKMARK');?>">
    <?=bitrix_sessid_post()?>
</form>