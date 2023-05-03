<?php
include "../include/connection.php";
include "../include/function.php";

if ($_POST['map_id']>0){
    $sql="update map set office_code=:office_code, office_name=:office_name, office_type_code=:office_type_code, ampur_fullcode=:ampur_fullcode, tambon_fullcode=:tambon_fullcode where office_id=:office_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute(['office_code' => $_POST['office_code'],'office_name'=>$_POST['office_name'],'office_type_code'=>$_POST['office_type_code'],'ampur_fullcode'=>$_POST['ampur_fullcode'],'tambon_fullcode'=>$_POST['tambon_fullcode'],'office_id'=>$_POST['office_id']]);
}else{
    $sql="insert into map (office_code, office_name, office_type_code, ampur_fullcode, tambon_fullcode) value (:office_code, :office_name, :office_type_code, :ampur_fullcode, :tambon_fullcode)";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute(['office_code' => $_POST['office_code'],'office_name'=>$_POST['office_name'],'office_type_code'=>$_POST['office_type_code'],'ampur_fullcode'=>$_POST['ampur_fullcode'],'tambon_fullcode'=>$_POST['tambon_fullcode']]);
}
echo $successed;