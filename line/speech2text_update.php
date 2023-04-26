<?php
// error_reporting(E_ALL);
// ini_set('display_errors','On');

// print_r($_POST);
if (!isset($_SESSION)){
    session_start();
}
require_once("../db/connection.php");
include_once("../include/function.php");

$speech2text_auto_on=(($_SESSION['speech2text_auto_on']=='0')?1:0);

$sql="update user set speech2text_auto_on=".$speech2text_auto_on." where user_id='".$_SESSION['user_id']."'";
$result = $conn->prepare($sql);
$result->execute();

$_SESSION['speech2text_auto_on']=$speech2text_auto_on;

$result=["result"=>"ok","speech2text_auto_on"=>$speech2text_auto_on];
echo json_encode($result,JSON_UNESCAPED_UNICODE);

// userLog($_POST['user_id'],$_POST['line_id'],'Insert user',$sql);
?>


