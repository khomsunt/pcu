<?php
include "../include/connection.php";
include "../include/function.php";

$sql = "select o.* from position o where o.position_id=:position_id";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute(['position_id' => $_POST['position_id']]);
$position = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($position,JSON_UNESCAPED_UNICODE);
?>
