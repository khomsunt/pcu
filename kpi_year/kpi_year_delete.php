<?php
include "../include/connection.php";
include "../include/function.php";
if ($_POST['office_id']>0){
    $sql="delete from office where office_id=:office_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute(['office_id'=>$_POST['office_id']]);
}
echo $successed;