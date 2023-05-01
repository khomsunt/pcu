<?php
include "../include/connection.php";
include "../include/function.php";

if ($_POST['road_id']>0){
    $sql="update road set 
        road_name=:road_name,
        status_id=:status_id
        where 
        road_id=:road_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute([
        'road_name' => $_POST['road_name'],
        'status_id'=>$_POST['status_id'],
        'road_id'=>$_POST['road_id']
    ]);
}else{
    $sql="insert into road 
    (road_name, status_id) 
    value 
    (:road_name, :status_id)";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute([
        'road_name' => $_POST['road_name'],
        'status_id'=>$_POST['status_id']
    ]);
}
echo $successed;