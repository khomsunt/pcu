<?php
include "../include/connection.php";
include "../include/function.php";
if ($_POST['position_id']>0){
    $sql="delete from position where position_id=:position_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute(['position_id'=>$_POST['position_id']]);
}
echo $successed;