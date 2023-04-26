<?php
// error_reporting(E_ALL);
// ini_set('display_errors','On');

if (!isset($_SESSION)){
    session_start();
}
require_once("../db/connection.php");
include_once("../include/function.php");
require_once("../line/function.php");
require_once("../line/lineLoginLib.php");
require_once("../line/lineConfig.php");
 
// session_destroy();

header("Cache-Control: max-age=0; no-cache; no-store; must-revalidate");

if(!isset($_SESSION['ses_login_accToken_val'])){    
    $LineLogin->authorize(); 
    exit;
}

if(isset($_POST['lineLogout'])){
    // userLog($_SESSION['user_id'],$_SESSION['line_id'],'logout','');
    unset(
        $_SESSION['ses_login_accToken_val'],
        $_SESSION['ses_login_refreshToken_val'],
        $_SESSION['ses_login_userData_val'],
        $_SESSION['line_login_userData_'.$projectName],
        $_SESSION['user_id'],
        $_SESSION['user_first_name'],
        $_SESSION['user_last_name'],
        $_SESSION['position_name'],
        $_SESSION['user_picture'],
        $_SESSION['main_office_id'],
        $_SESSION['office_id'],
        $_SESSION['office_type_id'],
        $_SESSION['office_relation'],
        $_SESSION['office_relation_description'],
        $_SESSION['office_name'],
        $_SESSION['user_type_id'],
        $_SESSION['homepage'],
        $_SESSION['homepage_params'],
        $_SESSION['speech2text_auto_on'],
        $_SESSION['user_status_id'],
        $_SESSION['line_id'],
        $_SESSION['history']
    );  
    $LineLogin->revokeToken($accToken);
    // $LineLogin->redirect("login_uselib.php");
}


// print_r($_GET);

?>
<!doctype html>
<html lang="en">
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="../js/function.js"></script>
    </head>
<body class="body">
    <div class="container content-container text-center">
        <?php
        if(isset($_POST['lineLogout'])){
            if (isset($_POST['page'])){
                ?>
                <script>
                    console.log("redirect to ../");
                    redirect("../", data = {page: '<?php echo $_POST['page']; ?>'});
                </script>
                <?php                
            }else{
                ?>
                <script>
                    console.log("reload to ../");
                    window.location.replace("../");
                </script>
                <?php
            }
        }else{
            include_once("../line/loginCheck.php");
        }
        ?>
    </div>
</body>
</html>
