<?php
include "../include/connection.php";
$sql = "select * from victim";
if (($_POST['victim_id']) and ($_POST['victim_id']>0)){
    $sql.=" WHERE victim_id=:victim_id";
}
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
if (($_POST['victim_id']) and ($_POST['victim_id']>0)){
    $stmt->execute(['victim_id' => $_POST['victim_id']]);
}else{
    $stmt->execute();
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
