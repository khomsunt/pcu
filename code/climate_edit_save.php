<?php
include "../include/connection.php";
include "../include/function.php";

if ($_POST['climate_id']>0){
    $sql="update climate set 
        climate_name=:climate_name,
        status_id=:status_id
        where 
        climate_id=:climate_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute([
        'climate_name' => $_POST['climate_name'],
        'status_id'=>$_POST['status_id'],
        'climate_id'=>$_POST['climate_id']
    ]);
}else{
    $sql="insert into climate 
    (climate_name, status_id) 
    value 
    (:climate_name, :status_id)";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute([
        'climate_name' => $_POST['climate_name'],
        'status_id'=>$_POST['status_id']
    ]);
}
echo $successed;