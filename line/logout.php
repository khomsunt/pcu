<?php
require_once "../include/connection.php";
require_once "../line/lineLoginLib.php";
require_once "../line/lineConfig.php";
unset(
    $_SESSION['ses_login_accToken_val_' . $config['projectname']],
    $_SESSION['ses_login_refreshToken_val_' . $config['projectname']],
    $_SESSION['ses_login_userData_val_' . $config['projectname']],
);
$LineLogin->redirect('../main/');
