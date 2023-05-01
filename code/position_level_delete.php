<?php
include "../include/connection.php";
include "../include/function.php";
if ($_POST['position_level_id']>0){
    $sql="delete from position_level where position_level_id=:position_level_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute(['position_level_id'=>$_POST['position_level_id']]);
}
echo $successed;