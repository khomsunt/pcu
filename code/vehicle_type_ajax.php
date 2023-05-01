<?php
include "../include/connection.php";
$sql = "select c.*,s.status_name from vehicle_type c left join status s on c.status_id=s.status_id";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
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
