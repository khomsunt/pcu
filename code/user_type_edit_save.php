<?php
include "../include/connection.php";
include "../include/function.php";

if ($_POST['user_type_id']>0){
    $sql="update user_type set 
        user_type_name=:user_type_name,
        status_id=:status_id
        where 
        user_type_id=:user_type_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute([
        'user_type_name' => $_POST['user_type_name'],
        'status_id'=>$_POST['status_id'],
        'user_type_id'=>$_POST['user_type_id']
    ]);
}else{
    $sql="insert into user_type 
    (user_type_name, status_id) 
    value 
    (:user_type_name, :status_id)";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute([
        'user_type_name' => $_POST['user_type_name'],
        'status_id'=>$_POST['status_id']
    ]);
}
echo $successed;