<?php
require_once "../include/connection.php";

$sql = "select user_profile_key,user_profile_value from user_profile where user_id=:user_id";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute(['user_id' => $_SESSION['user_id_' . $config['projectname']]]);
$user_profile = $stmt->fetchAll(PDO::FETCH_ASSOC);
