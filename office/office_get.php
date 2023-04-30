<?php
include "../include/connection.php";
include "../include/function.php";

$sql = "select o.* from office o where o.office_id=:office_id";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute(['office_id' => $_POST['office_id']]);
$office = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($office,JSON_UNESCAPED_UNICODE);
?>
