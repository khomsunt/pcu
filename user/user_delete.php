<?php
include "../include/connection.php";
include "../include/function.php";
if ($_POST['user_id']>0){
    $sql="delete from user where user_id=:user_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute(['user_id'=>$_POST['user_id']]);
}
echo $successed;