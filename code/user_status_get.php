<?php
include "../include/connection.php";
include "../include/function.php";

$sql = "select o.* from user_status o where o.user_status_id=:user_status_id";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute(['user_status_id' => $_POST['user_status_id']]);
$user_status = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($user_status,JSON_UNESCAPED_UNICODE);
?>
