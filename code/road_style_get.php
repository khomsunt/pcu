<?php
include "../include/connection.php";
include "../include/function.php";

$sql = "select o.* from road_style o where o.road_style_id=:road_style_id";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute(['road_style_id' => $_POST['road_style_id']]);
$road_style = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($road_style,JSON_UNESCAPED_UNICODE);
?>
