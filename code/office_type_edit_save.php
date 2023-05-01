<?php
include "../include/connection.php";
include "../include/function.php";

if ($_POST['office_type_id']>0){
    $sql="update office_type set 
        office_type_name=:office_type_name,
        status_id=:status_id
        where 
        office_type_id=:office_type_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute([
        'office_type_name' => $_POST['office_type_name'],
        'status_id'=>$_POST['status_id'],
        'office_type_id'=>$_POST['office_type_id']
    ]);
}else{
    $sql="insert into office_type 
    (office_type_name, status_id) 
    value 
    (:office_type_name, :status_id)";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute([
        'office_type_name' => $_POST['office_type_name'],
        'status_id'=>$_POST['status_id']
    ]);
}
echo $successed;