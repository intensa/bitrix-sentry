<?php

if (!check_bitrix_sessid()) {
    return;
}

IncludeModuleLangFile(__FILE__);

if ($ex = $GLOBALS['APPLICATION']->GetException())
    CAdminMessage::ShowMessage([
        'TYPE' => 'ERROR',
        'MESSAGE' => GetMessage('MOD_UNINST_ERR'),
        'DETAILS' => $ex->GetString(),
        'HTML' => true,
    ]);
else {
    CAdminMessage::ShowNote(GetMessage('MOD_UNINST_OK'));
}
?>