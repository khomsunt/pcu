<?php
include "../include/connection.php";
include "../include/function.php";

$sql = "select o.* from user_type o where o.user_type_id=:user_type_id";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute(['user_type_id' => $_POST['user_type_id']]);
$user_type = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($user_type,JSON_UNESCAPED_UNICODE);
?>
