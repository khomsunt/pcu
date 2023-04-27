<?php
require_once "../include/connection.php";
require_once "../include/function.php";

if ($_SESSION['user_id_' . $config['projectname']] > 0) {
    include "../user/get_profile_data.php";
    echo json_encode($user_profile);
}
