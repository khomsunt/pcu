<?php
include "../include/connection.php";
include "../include/function.php";

$sql = "select o.* from user o where o.user_id=:user_id";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute(['user_id' => $_POST['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($user,JSON_UNESCAPED_UNICODE);
?>
