<?php
include "../include/connection.php";
include "../include/function.php";

$sql = "select o.* from vehicle_type o where o.vehicle_type_id=:vehicle_type_id";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute(['vehicle_type_id' => $_POST['vehicle_type_id']]);
$vehicle_type = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($vehicle_type,JSON_UNESCAPED_UNICODE);
?>
