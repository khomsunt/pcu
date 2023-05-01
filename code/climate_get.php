<?php
include "../include/connection.php";
include "../include/function.php";

$sql = "select o.* from climate o where o.climate_id=:climate_id";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute(['climate_id' => $_POST['climate_id']]);
$climate = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($climate,JSON_UNESCAPED_UNICODE);
?>
