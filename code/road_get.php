<?php
include "../include/connection.php";
include "../include/function.php";

$sql = "select o.* from road o where o.road_id=:road_id";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute(['road_id' => $_POST['road_id']]);
$road = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($road,JSON_UNESCAPED_UNICODE);
?>
