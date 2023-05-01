<?php
include "../include/connection.php";
include "../include/function.php";
if ($_POST['road_style_id']>0){
    $sql="delete from road_style where road_style_id=:road_style_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $successed=$stmt->execute(['road_style_id'=>$_POST['road_style_id']]);
}
echo $successed;