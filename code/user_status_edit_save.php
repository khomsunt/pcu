<?php
include "../include/connection.php";
include "../include/function.php";

if ($_POST['user_status_id']>0){
    $sql="update user_status set 
        user_status_name=:user_status_name,
        status_id=:status_id
        where 
        user_status_id=:user_status_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute([
        'user_status_name' => $_POST['user_status_name'],
        'status_id'=>$_POST['status_id'],
        'user_status_id'=>$_POST['user_status_id']
    ]);
}else{
    $sql="insert into user_status 
    (user_status_name, status_id) 
    value 
    (:user_status_name, :status_id)";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute([
        'user_status_name' => $_POST['user_status_name'],
        'status_id'=>$_POST['status_id']
    ]);
}
echo $successed;