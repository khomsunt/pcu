<?php
error_reporting(E_ALL);
ini_set('display_errors','On');

// print_r($_POST);
if (!isset($_SESSION)){
    session_start();
}
require_once("../db/connection.php");
include_once("../include/function.php");

$datetime = date("Y-m-d H:i:s");
if (isset($_POST['user_id'])){
    $sql = "UPDATE user SET 
                callsign='".$_POST['callsign']."',
                prename='".$_POST['prename']."',
                cid='".$_POST['cid']."',
                user_first_name='".$_POST['user_first_name']."',
                user_last_name='".$_POST['user_last_name']."',
                office_id='".$_POST['office_id']."',
                position_id='".$_POST['position_id']."',
                position_level_id='".$_POST['position_level_id']."',
                tel='".$_POST['tel']."',
                address='".$_POST['address']."'".((($_SESSION['user_type_id']==1 or $_SESSION['user_type_id']==2) and ($_SESSION['user_status_id']==5))?",user_type_id='".$_POST['user_type_id']."',ambulance_id='".$_POST['ambulance_id']."',user_status_id='".$_POST['user_status_id']."'":"")."
            WHERE user_id='".$_POST['user_id']."'";
    $result = $conn->prepare($sql);
    $result->execute();
    $data['user_id']=$_POST['user_id'];

    $result=["result"=>"ok","action"=>"loadpage","message"=>$data];

}else{
    $sql = "INSERT into user (
                callsign,
                prename,
                cid,
                password,
                user_first_name,
                user_last_name,
                office_id,
                position_id,
                position_level_id,
                line_id,
                picture,
                tel,
                address,
                insert_date_time
            )
            VALUE (
                '" . $_POST['callsign'] . "',
                '" . $_POST['prename'] . "',
                '" . $_POST['cid'] . "',
                md5('" . $_POST['password'] . "'),
                '" . $_POST['user_first_name'] . "',
                '" . $_POST['user_last_name'] . "',
                '" . $_POST['office_id'] . "',
                '" . $_POST['position_id'] . "',
                '" . $_POST['position_level_id'] . "',
                '" . $_POST['line_id'] . "',
                '" . $_POST['picture'] . "',
                '" . $_POST['tel'] . "',
                '" . $_POST['address'] . "',
                '" . $datetime."')";
    $result = $conn->prepare($sql);
    $result->execute();
    $user_id = $conn->lastInsertId();
    $data['user_id']=$user_id;
    
    $result=["result"=>"ok","action"=>"logout","message"=>$data];

}
echo json_encode($result,JSON_UNESCAPED_UNICODE);

// userLog($_POST['user_id'],$_POST['line_id'],'Insert user',$sql);
?>


