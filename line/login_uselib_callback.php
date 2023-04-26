<?php
session_start();
require_once("../db/connection.php");
require_once("../line/lineLoginLib.php");
require_once("../line/lineConfig.php");

     
// กรณีต้องการดึงค่าเฉพาะ access token ไปใช้งาน
/*$accToken = $LineLogin->requestAccessToken($_GET);
if(isset($accToken) && is_string($accToken)){
    $_SESSION['ses_login_accToken_val'] = $accToken;
}*/
 
// กรณีต้องการดึงค่าเฉพาะ access token และค่าอื่นๆ รวมถึงข้อมูลผู้ใช้ เช่น userId ในไลน์ ไปใช้งาน
$dataToken = $LineLogin->requestAccessToken($_GET, true);
if(!is_null($dataToken) && is_array($dataToken)){
    if(array_key_exists('access_token',$dataToken)){
        $_SESSION['ses_login_accToken_val'] = $dataToken['access_token'];
    }
    if(array_key_exists('refresh_token',$dataToken)){
        $_SESSION['ses_login_refreshToken_val'] = $dataToken['refresh_token'];
    }   
    if(array_key_exists('id_token',$dataToken)){
        $_SESSION['ses_login_userData_val'] = $dataToken['user'];
    }       
}
$LineLogin->redirect('login_uselib.php');
?>