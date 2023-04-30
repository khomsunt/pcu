<?php
include "../include/connection.php";
include "../include/function.php";

if ($_POST['user_id']>0){
    $sql="update user set user_code=:user_code, user_name=:user_name, user_type_code=:user_type_code, ampur_fullcode=:ampur_fullcode, tambon_fullcode=:tambon_fullcode where user_id=:user_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute(['user_code' => $_POST['user_code'],'user_name'=>$_POST['user_name'],'user_type_code'=>$_POST['user_type_code'],'ampur_fullcode'=>$_POST['ampur_fullcode'],'tambon_fullcode'=>$_POST['tambon_fullcode'],'user_id'=>$_POST['user_id']]);
}else{
    $sql="insert into user (user_code, user_name, user_type_code, ampur_fullcode, tambon_fullcode) value (:user_code, :user_name, :user_type_code, :ampur_fullcode, :tambon_fullcode)";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute(['user_code' => $_POST['user_code'],'user_name'=>$_POST['user_name'],'user_type_code'=>$_POST['user_type_code'],'ampur_fullcode'=>$_POST['ampur_fullcode'],'tambon_fullcode'=>$_POST['tambon_fullcode']]);
}
echo $successed;