<?php
include "../include/connection.php";
include "../include/function.php";

if ($_POST['user_id']>0){
    $sql="update user set 
        prename=:prename, 
        user_first_name=:user_first_name, 
        user_last_name=:user_last_name, 
        cid=:cid, 
        position_id=:position_id, 
        position_level_id=:position_level_id, 
        office_id=:office_id, 
        user_type_id=:user_type_id, 
        user_status_id=:user_status_id 
        where 
        user_id=:user_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute([
        'prename' => $_POST['prename'],
        'user_first_name'=>$_POST['user_first_name'],
        'user_last_name'=>$_POST['user_last_name'],
        'cid'=>$_POST['cid'],
        'position_id'=>$_POST['position_id'],
        'position_level_id'=>$_POST['position_level_id'],
        'office_id'=>$_POST['office_id'],
        'user_type_id'=>$_POST['user_type_id'],
        'user_status_id'=>$_POST['user_status_id'],
        'user_id'=>$_POST['user_id']
    ]);
}else{
    $sql="insert into user 
    (prename, user_first_name, user_last_name, cid, position_id,position_level_id,office_id,user_type_id,user_status_id) 
    value 
    (:prename, :user_first_name, :user_last_name, :cid, :position_id,:position_level_id,:office_id,:user_type_id,:user_status_id)";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute([
        'prename' => $_POST['prename'],
        'user_first_name'=>$_POST['user_first_name'],
        'user_last_name'=>$_POST['user_last_name'],
        'cid'=>$_POST['cid'],
        'position_id'=>$_POST['position_id'],
        'position_level_id'=>$_POST['position_level_id'],
        'office_id'=>$_POST['office_id'],
        'user_type_id'=>$_POST['user_type_id'],
        'user_status_id'=>$_POST['user_status_id']
    ]);
}
echo $successed;