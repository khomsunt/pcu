<?php
include "../include/connection.php";
include "../include/function.php";

if ($_POST['position_level_id']>0){
    $sql="update position_level set 
        position_level_name=:position_level_name,
        status_id=:status_id
        where 
        position_level_id=:position_level_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute([
        'position_level_name' => $_POST['position_level_name'],
        'status_id'=>$_POST['status_id'],
        'position_level_id'=>$_POST['position_level_id']
    ]);
}else{
    $sql="insert into position_level 
    (position_level_name, status_id) 
    value 
    (:position_level_name, :status_id)";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute([
        'position_level_name' => $_POST['position_level_name'],
        'status_id'=>$_POST['status_id']
    ]);
}
echo $successed;