<?php
include "../include/connection.php";
$sql = "select u.*,concat(ifnull(u.prename,''),ifnull(u.user_first_name,''),' ',ifnull(u.user_last_name,'')) as user_name,p.position_name,pl.position_level_name,o.office_name,ut.user_type_name,us.user_status_name from `user` u left join position p on u.position_id=p.position_id left join position_level pl on u.position_level_id=pl.position_level_id left join office o on u.office_id=o.office_id left join user_type ut on u.user_type_id=ut.user_type_id left join user_status us on u.user_status_id=us.user_status_id";
if (($_POST['user_id']) and ($_POST['user_id']>0)){
    $sql.=" WHERE user_id=:user_id";
}
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
if (($_POST['user_id']) and ($_POST['user_id']>0)){
    $stmt->execute(['user_id' => $_POST['user_id']]);
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
