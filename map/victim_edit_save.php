<?php
include "../include/connection.php";
include "../include/function.php";

// print_r($_POST);

// $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
// $successed=$stmt->execute(['victim_id' => $_POST['victim_id'],'prename_id'=>$_POST['prename_id'],'first_name'=>$_POST['first_name'],'last_name'=>$_POST['last_name'],'cid'=>$_POST['cid']]);

if (isset($_POST['accident_id']) and $_POST['accident_id']>0){
    $accident_id=$_POST['accident_id'];


}else{
    $sql="INSERT INTO `accident` (`accident_id`, `accident_datetime`, `climate_id`, `user_id`, `insert_datetime`, `update_datetime`, `road_id`) VALUES (NULL, '2023-05-01 10:54:20', '1', '1', current_timestamp(), current_timestamp(), '1')";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();
    $accident_id=$con->lastInsertId();

}

$sql="INSERT INTO `victim` (`victim_id`, `accident_id`, `cid`, `prename_id`, `first_name`, `last_name`) VALUES (NULL, '".$accident_id."', '".$_POST['cid']."', '".$_POST['prename_id']."', '".$_POST['first_name']."', '".$_POST['last_name']."');";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$successed = $stmt->execute();


$_return = new stdClass();
$_return->success = $successed;
$_return->accident_id = $accident_id;

echo json_encode($_return, JSON_UNESCAPED_UNICODE);
