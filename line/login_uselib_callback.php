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
    $accToken = $_SESSION['ses_login_accToken_val_' . $config['projectname']];
    if ($LineLogin->verifyToken($accToken)) {
        $userInfo = $LineLogin->userProfile($accToken, true);

        $sql = "select * from user where line_id=:line_id";
        $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $stmt->execute(['line_id' => $_SESSION['line_login_userData_' . $config['projectname']]['userId']]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $a_displayName = explode(" ", $_SESSION['line_login_userData_' . $config['projectname']]['displayName']);
        if ($user['user_id'] > 0) {
            $sql = "update user set picture=:picture where user_id=:user_id";
            $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $stmt->execute([
                'picture' => $_SESSION['line_login_userData_' . $config['projectname']]['pictureUrl'],
                'user_id' => $user['user_id'],
            ]);
            $_SESSION['user_id_' . $config['projectname']] = $user['user_id'];
        } else {
            $sql = "insert into user (line_id,user_first_name,user_last_name,picture) value (:line_id,:displayName_first_name,:displayName_last_name,:picture)";
            $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $stmt->execute([
                'line_id' => $_SESSION['line_login_userData_' . $config['projectname']]['userId'],
                'displayName_first_name' => $a_displayName[0],
                'displayName_last_name' => ($a_displayName[1]) ? $a_displayName[1] : "",
                'picture' => $_SESSION['line_login_userData_' . $config['projectname']]['pictureUrl'],
            ]);
            $_SESSION['user_id_' . $config['projectname']] = $con->lastInsertId();
        }
    }
}

$LineLogin->redirect('../main/');
