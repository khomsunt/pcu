<?php
include "../include/connection.php";
include "../include/function.php";

print_r($_POST);

$sql="INSERT INTO `accident`(`accident_id`, `victim_id`, `first_name`, `last_name`, `cid`,`user_id`) VALUES (NULL,".$_POST['victim_id'].",".$_POST['first_name'].",".$_POST['last_name'].",".$_POST['cid'].",".$_SESSION['user_id_pcu'].")";
echo $sql;
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$successed=$stmt->execute(['victim_id' => $_POST['victim_id'],'first_name'=>$_POST['first_name'],'last_name'=>$_POST['last_name'],'cid'=>$_POST['cid']]);
