<?php
include "../include/connection.php";
include "../include/function.php";

print_r($_POST);
$sql="INSERT INTO `accident`(`accident_id`, `victim_id`, `prename_code`, `first_name`, `last_name`, `cid`,`user_id`) VALUES (NULL,".$_POST['victim_id'].",".$_SESSION['prename_code'].",".$_SESSION['first_name'].",".$_SESSION['last_name'].",".$_SESSION['cid'].",".$_SESSION['user_id_pcu'].")";
echo $sql;
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$successed=$stmt->execute(['victim_id' => $_POST['victim_id'],'prename_code'=>$_POST['prename_code'],'first_name'=>$_POST['first_name'],'last_name'=>$_POST['last_name'],'cid'=>$_POST['cid'],'user_id'=>$_POST['user_id']]);