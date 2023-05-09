<?php
include "../include/connection.php";
$sql = "select o.*,ot.office_type_name,t.tambon_name from office o left join office_type ot on o.office_type_code=ot.office_type_code left join tambon t on o.tambon_fullcode=t.tambon_fullcode";
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
