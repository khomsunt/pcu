<?php
include "../include/connection.php";
$sql = "select * from victim where accident_id=:accident_id";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
if (($_POST['accident_id']) and ($_POST['accident_id']>0)){
    $stmt->execute(['accident_id' => $_POST['accident_id']]);
}else{
    $stmt->execute(['accident_id' => 0]);
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
