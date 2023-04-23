<?php
include "../include/connection.php";
$sql = "select * from table01";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// print_r($rows);

$_return = new stdClass();
$_return->status = "success";
$_return->draw = intval((isset($_POST['draw'])) ? $_POST['draw'] : "");
$_return->recordsTotal = 57;
$_return->recordsFiltered = 57;
$_return->data = $rows;

// error_log(json_encode( $_return, JSON_UNESCAPED_UNICODE ),0);

echo json_encode($_return, JSON_UNESCAPED_UNICODE);
