<?php
include "../include/connection.php";
include "../include/function.php";
if ($_POST['vehicle_type_id']>0){
    $sql="delete from vehicle_type where vehicle_type_id=:vehicle_type_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute(['vehicle_type_id'=>$_POST['vehicle_type_id']]);
}
echo $successed;