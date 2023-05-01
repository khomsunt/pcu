<?php
include "../include/connection.php";
include "../include/function.php";

if ($_POST['position_id']>0){
    $sql="update position set 
        position_name=:position_name,
        status_id=:status_id
        where 
        position_id=:position_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute([
        'position_name' => $_POST['position_name'],
        'status_id'=>$_POST['status_id'],
        'position_id'=>$_POST['position_id']
    ]);
}else{
    $sql="insert into position 
    (position_name, status_id) 
    value 
    (:position_name, :status_id)";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute([
        'position_name' => $_POST['position_name'],
        'status_id'=>$_POST['status_id']
    ]);
}
echo $successed;