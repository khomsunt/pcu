<?php
include "../include/connection.php";
include "../include/function.php";
if ($_POST['user_status_id']>0){
    $sql="delete from user_status where user_status_id=:user_status_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute(['user_status_id'=>$_POST['user_status_id']]);
}
echo $successed;