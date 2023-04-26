<?php
// error_reporting(E_ALL);
// ini_set('display_errors','On');

if (!isset($_SESSION)){
    session_start();
}
include_once("../db/connection.php");
include_once("../include/function.php");

$requestData= $_REQUEST;
$sql="select user_id from user where cid='".$_POST['cid']."'";
// error_log("sql=".$sql,0);
// echo $sql;
$stmt = $conn->prepare($sql);
$stmt->execute();
$totalData = $stmt->rowCount();
$totalFiltered = $totalData;
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$json_data = [
    "draw" => intval((isset($requestData['draw']))?$requestData['draw']:""),
    "recordsTotal" => intval($totalData),
    "recordsFiltered" => intval( $totalFiltered ),
    "data"            => $data,
];
echo json_encode($json_data,JSON_UNESCAPED_UNICODE);
?>
