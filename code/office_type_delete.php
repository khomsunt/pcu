<?php
include "../include/connection.php";
include "../include/function.php";
if ($_POST['office_type_id']>0){
    $sql="delete from office_type where office_type_id=:office_type_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute(['office_type_id'=>$_POST['office_type_id']]);
}
echo $successed;