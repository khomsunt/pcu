<?php
include "../include/connection.php";
include "../include/function.php";
if ($_POST['user_type_id']>0){
    $sql="delete from user_type where user_type_id=:user_type_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute(['user_type_id'=>$_POST['user_type_id']]);
}
echo $successed;