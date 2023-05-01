<?php
include "../include/connection.php";
include "../include/function.php";

$sql = "select o.* from position_level o where o.position_level_id=:position_level_id";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute(['position_level_id' => $_POST['position_level_id']]);
$position_level = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($position_level,JSON_UNESCAPED_UNICODE);
?>
