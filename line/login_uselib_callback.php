<?php
require_once "../include/connection.php";
require_once "../line/lineLoginLib.php";
require_once "../line/lineConfig.php";
$dataToken = $LineLogin->requestAccessToken($_GET, true);
if (!is_null($dataToken) && is_array($dataToken)) {
    if (array_key_exists('access_token', $dataToken)) {
        $_SESSION['ses_login_accToken_val_' . $config['projectname']] = $dataToken['access_token'];
    }
    if (array_key_exists('refresh_token', $dataToken)) {
        $_SESSION['ses_login_refreshToken_val_' . $config['projectname']] = $dataToken['refresh_token'];
    }
    if (array_key_exists('id_token', $dataToken)) {
        $_SESSION['ses_login_userData_val_' . $config['projectname']] = $dataToken['user'];
    }
}
$LineLogin->redirect('../main/index.php');
