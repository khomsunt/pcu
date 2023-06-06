<?php
include "../include/connection.php";
include "../include/function.php";

// print_r($_POST);

// $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
// $successed=$stmt->execute(['road_id' => $_POST['road_id'],'road_stype_id'=>$_POST['road_stype_id'],'climate_id'=>$_POST['climate_id'],'accident_site_detail'=>$_POST['accident_site_detail'],'Km_at'=>$_POST['Km_at'],'moo'=>$_POST['moo'],'tambon_id'=>$_POST['tambon_id'],'ampur_id'=>$_POST['ampur_id'],'changwat_id'=>$_POST['changwat_id']]);

if (isset($_POST['accident_id']) and $_POST['accident_id']>0){
    $accident_id=$_POST['accident_id'];


}else{
    $sql="INSERT INTO `accident` (`accident_id`, `accident_datetime`, `climate_id`, `user_id`, `insert_datetime`, `update_datetime`, `road_id`) VALUES (NULL, '2023-05-01 10:54:20', '1', '1', current_timestamp(), current_timestamp(), '1')";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();
    $accident_id=$con->lastInsertId();

}

$sql="INSERT INTO `accident_site` (`accident_site_id`,`accident_id`,`road_id`, `road_stype_id`, `climate_id`, `accident_site_detail`, `Km_at`, `moo`, `tambon_id`, `ampur_id`, `changwat_id`) VALUES (NULL, '".$accident_id."', '".$_POST['road_id']."', '".$_POST['road_stype_id']."', '".$_POST['climate_id']."', '".$_POST['accident_site_detail']."', '".$_POST['Km_at']."', '".$_POST['moo']."', '".$_POST['ampur_id']."', '".$_POST['ampur_id']."', '".$_POST['changwat_id']."');";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$successed = $stmt->execute();


$_return = new stdClass();
$_return->success = $successed;
$_return->accident_id = $accident_id;

echo json_encode($_return, JSON_UNESCAPED_UNICODE);
