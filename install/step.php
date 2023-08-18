<?php
if (!check_bitrix_sessid()) return;

IncludeModuleLangFile(__FILE__);

if ($ex = $GLOBALS['APPLICATION']->GetException()) {
    CAdminMessage::ShowMessage([
        'TYPE' => 'ERROR',
        'MESSAGE' => GetMessage('MOD_INST_ERR'),
        'DETAILS' => $ex->GetString(),
        'HTML' => true,
    ]);
} else {
    CAdminMessage::ShowNote(GetMessage('MOD_INST_OK'));
    CAdminMessage::ShowMessage([
        'TYPE' => 'WARNING',
        'MESSAGE' => GetMessage('SETTINGS_REMINDER'),
        'DETAILS' => '',
        'HTML' => true,
    ]);
    ?>
    <a href="/bitrix/admin/settings.php?lang=<?= LANGUAGE_ID ?>&mid=intensa.sentry">
        <input type="button" value="<?= GetMessage('GOTO_SETTINGS'); ?>">
    </a>
<? } ?>