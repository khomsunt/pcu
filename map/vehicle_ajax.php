<?php
include "../include/connection.php";
$sql = "select * from vehicle where vehicle_id=:vehicle_id";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
if (($_POST['vehicle_id']) and ($_POST['vehicle_id']>0)){
    $stmt->execute(['vehicle_id' => $_POST['vehicle_id']]);
}else{
    $stmt->execute(['vehicle_id' => 0]);
}
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total_rows=count($rows);

// print_r($rows);

$_return = new stdClass();
$_return->status = "success";
$_return->draw = intval((isset($_POST['draw'])) ? $_POST['draw'] : "");
$_return->recordsTotal = $total_rows;
$_return->recordsFiltered = $total_rows;
$_return->data = $rows;

// error_log(json_encode( $_return, JSON_UNESCAPED_UNICODE ),0);

echo json_encode($_return, JSON_UNESCAPED_UNICODE);
