<?php
include "../include/connection.php";
include "../include/function.php";

$sql = "select o.* from office_type o where o.office_type_id=:office_type_id";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute(['office_type_id' => $_POST['office_type_id']]);
$office_type = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($office_type,JSON_UNESCAPED_UNICODE);
?>
