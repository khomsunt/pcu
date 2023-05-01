<?php
include "../include/connection.php";
include "../include/function.php";

if ($_POST['vehicle_type_id']>0){
    $sql="update vehicle_type set 
        vehicle_type_name=:vehicle_type_name,
        status_id=:status_id
        where 
        vehicle_type_id=:vehicle_type_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute([
        'vehicle_type_name' => $_POST['vehicle_type_name'],
        'status_id'=>$_POST['status_id'],
        'vehicle_type_id'=>$_POST['vehicle_type_id']
    ]);
}else{
    $sql="insert into vehicle_type 
    (vehicle_type_name, status_id) 
    value 
    (:vehicle_type_name, :status_id)";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute([
        'vehicle_type_name' => $_POST['vehicle_type_name'],
        'status_id'=>$_POST['status_id']
    ]);
}
echo $successed;