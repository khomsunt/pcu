<?php
include "../include/connection.php";
include "../include/function.php";
if ($_POST['road_id']>0){
    $sql="delete from road where road_id=:road_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute(['road_id'=>$_POST['road_id']]);
}
echo $successed;