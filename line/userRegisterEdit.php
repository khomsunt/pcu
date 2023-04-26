User register edit
<?php
if (!isset($_SESSION)){
    session_start();
}
include_once("../db/connection.php");
include_once("../include/function.php");
userLog($_SESSION['user_id'],$_SESSION['line_id'],'Open userRegisterEdit.php','');


?>