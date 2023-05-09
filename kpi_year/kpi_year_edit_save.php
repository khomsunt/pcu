<?php
include "../include/connection.php";
include "../include/function.php";
error_log(print_r($_POST,true),0);
if ($_POST['office_id']>0){
    $sql="update office set office_code=:office_code, office_name=:office_name, office_type_code=:office_type_code, ampur_fullcode=:ampur_fullcode, tambon_fullcode=:tambon_fullcode where office_id=:office_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute(['office_code' => $_POST['office_code'],'office_name'=>$_POST['office_name'],'office_type_code'=>$_POST['office_type_code'],'ampur_fullcode'=>$_POST['ampur_fullcode'],'tambon_fullcode'=>$_POST['tambon_fullcode'],'office_id'=>$_POST['office_id']]);
}else{
    $sql="insert into office (office_code, office_name, office_type_code, ampur_fullcode, tambon_fullcode) value (:office_code, :office_name, :office_type_code, :ampur_fullcode, :tambon_fullcode)";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute(['office_code' => $_POST['office_code'],'office_name'=>$_POST['office_name'],'office_type_code'=>$_POST['office_type_code'],'ampur_fullcode'=>$_POST['ampur_fullcode'],'tambon_fullcode'=>$_POST['tambon_fullcode']]);
}
echo $successed;