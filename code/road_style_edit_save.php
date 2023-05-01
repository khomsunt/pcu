<?php
include "../include/connection.php";
include "../include/function.php";

if ($_POST['road_style_id']>0){
    $sql="update road_style set 
        road_style_name=:road_style_name,
        status_id=:status_id
        where 
        road_style_id=:road_style_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute([
        'road_style_name' => $_POST['road_style_name'],
        'status_id'=>$_POST['status_id'],
        'road_style_id'=>$_POST['road_style_id']
    ]);
}else{
    $sql="insert into road_style 
    (road_style_name, status_id) 
    value 
    (:road_style_name, :status_id)";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute([
        'road_style_name' => $_POST['road_style_name'],
        'status_id'=>$_POST['status_id']
    ]);
}
echo $successed;