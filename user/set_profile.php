<?php
require_once "../include/connection.php";
require_once "../include/function.php";

if ($_SESSION['user_id_' . $config['projectname']] > 0) {
    $sql = "REPLACE into user_profile (user_id,user_profile_key,user_profile_value) value (:user_id,:user_profile_key,:user_profile_value)";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute(['user_id' => $_SESSION['user_id_' . $config['projectname']], 'user_profile_key' => $_POST['user_profile_key'], 'user_profile_value' => $_POST['user_profile_value']]);

    include "../user/get_profile.php";
}
