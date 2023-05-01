<?php
include "../include/connection.php";
include "../include/function.php";
if ($_POST['climate_id']>0){
    $sql="delete from climate where climate_id=:climate_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute(['climate_id'=>$_POST['climate_id']]);
}
echo $successed;